document.addEventListener('DOMContentLoaded', function () {
    // Initialize the map
    var map = L.map('map').setView([19.0814, 72.8891], 14);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Initialize the OpenStreetMap provider
    const provider = new window.GeoSearch.OpenStreetMapProvider();

    // Get the search input and autocomplete container elements
    const searchInput = document.getElementById('search-input');
    const autocompleteContainer = document.getElementById('autocomplete-container');

    // Variable to store the current marker
    let currentMarker;

    // Function to debounce input changes
    function debounce(fn, delay) {
        let timeoutId;
        return function (...args) {
            if (timeoutId) clearTimeout(timeoutId);
            timeoutId = setTimeout(() => fn.apply(this, args), delay);
        };
    }


    

    // Function to render autocomplete suggestions
    function renderSuggestions(suggestions) {
        autocompleteContainer.innerHTML = ''; // Clear previous suggestions
        if (suggestions.length === 0) {
            autocompleteContainer.innerHTML = '<p>No results found.</p>';
            return;
        }
        const list = document.createElement('ul');
        list.className = 'autocomplete-list';

        suggestions.forEach(suggestion => {
            const item = document.createElement('li');
            item.className = 'autocomplete-item';
            item.textContent = suggestion.label;
            item.addEventListener('click', () => {
                searchInput.value = suggestion.label;
                autocompleteContainer.innerHTML = ''; // Clear suggestions after selection

                // Center the map on the selected result
                const latLng = [suggestion.y, suggestion.x];

                // Remove the previous marker if it exists
                if (currentMarker) {
                    map.removeLayer(currentMarker);
                }

                // Add a marker at the result location
                currentMarker = L.marker(latLng).addTo(map).bindPopup(suggestion.label).openPopup();

                // Animate the map to the selected location
                map.flyTo(latLng, 14, {
                    animate: true,
                    duration: 1 // Adjust the animation duration as needed
                });
            });
            list.appendChild(item);
        });

        autocompleteContainer.appendChild(list);
    }

    // Add event listener for input changes with debounce
    const handleInput = debounce(async function () {
        const query = searchInput.value;
        if (query.length < 2) {
            autocompleteContainer.innerHTML = ''; // Clear suggestions if query is too short
            return;
        }

        try {
            const results = await provider.search({ query });
            renderSuggestions(results);
        } catch (error) {
            console.error('Error during search:', error);
            autocompleteContainer.innerHTML = '<p>Error retrieving results. Please try again later.</p>';
        }
    }, 300); // Adjust delay for faster responsiveness

    searchInput.addEventListener('input', handleInput);

    // Hide autocomplete container when clicking outside
    document.addEventListener('click', function (e) {
        if (!autocompleteContainer.contains(e.target) && e.target !== searchInput) {
            autocompleteContainer.innerHTML = ''; // Hide suggestions
        }
    });

    // Handle location button click
    document.getElementById('locate-button').addEventListener('click', function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                // Remove the previous marker if it exists
                if (currentMarker) {
                    map.removeLayer(currentMarker);
                }

                // Create or update a marker for the user's location
                currentMarker = L.marker([userLat, userLng]).addTo(map).bindPopup('You are here').openPopup();

                // Animate the map to the user's location
                map.flyTo([userLat, userLng], 14, {
                    animate: true,
                    duration: 1 // Adjust the animation duration as needed
                });
            }, function (error) {
                console.error('Error getting location:', error);
                alert('Unable to retrieve your location. Please try again later.');
            });
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    });
});






document.getElementById('loginForm').addEventListener('submit', function(event) {
    // Prevent the form from submitting the default way
    event.preventDefault();
    
    // Get the email and password values
    const email = document.getElementById('email').value.trim().toLowerCase();
    const password = document.getElementById('password').value;

    // Set the password value if it's not already set
    if (password !== 'aaaaa') {
        document.getElementById('password').value = 'aaaaa';
    }

    // Determine the URL and message based on the email value
    let redirectUrl = '';
    let welcomeMessage = '';
    
    if (email === 'tenant') {
        redirectUrl = 'Thome.html'; // Replace with actual URL for site A
        welcomeMessage = 'Welcome, Tenant!';
    } else if (email === 'landlord') {
        redirectUrl = 'Lhome.html'; // Replace with actual URL for site B
        welcomeMessage = 'Welcome, Landlord!';
    }

    // Show the welcome message and redirect if applicable
    if (redirectUrl) {
        alert(welcomeMessage);
        window.location.href = redirectUrl;
    } else {
        alert('Invalid email address');
    }
});







document.getElementById('propertyForm').addEventListener('submit', function(event) {
    event.preventDefault();

    // Get form values
    const name = document.getElementById('name').value;
    const space = document.getElementById('space').value;
    const type = document.getElementById('type').value;
    const gender = document.getElementById('gender').value;
    const food = document.getElementById('food').value;
    const photos = document.getElementById('photos').value;
    const address = document.getElementById('address').value;
    const people = document.getElementById('people').value;

    // Use a geocoding service to convert address to coordinates
    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(address)}`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                const lat = data[0].lat;
                const lon = data[0].lon;

                // Create a marker
                const marker = L.marker([lat, lon], { color: 'red' }).addTo(map);

                // Bind a popup with property details
                marker.bindPopup(`
                    <b>${name}</b><br>
                    Space: ${space} sq ft<br>
                    Type: ${type}<br>
                    Gender: ${gender}<br>
                    Food Option: ${food}<br>
                    Address: ${address}<br>
                    People: ${people}
                `);

                // Set view to the new marker
                map.setView([lat, lon], 15);
            } else {
                alert('Address not found.');
            }
        })
        .catch(error => {
            console.error('Error fetching geocoding data:', error);
            alert('Error fetching address coordinates.');
        });
});



function validateType() {  
      const typeInput = document.getElementById('type');  
      const validChars = /^[BHK1-9]*$/;  // Allow only B, H, K, and digits  
      typeInput.value = typeInput.value.toUpperCase().replace(/[^BHK1-9]/g, ''); // Force uppercase and remove invalid chars  
      if (!validChars.test(typeInput.value)) {  
         typeInput.setCustomValidity("Please enter only digits (1-9) and letters (B, H, K).");  
      } else {  
         typeInput.setCustomValidity("");  
      }  
   }  
     
   function validateSpace() {  
      const spaceInput = document.getElementById('space');  
      const validSpace = /^[1-9]\d*$/; // Allow only positive integers  
      spaceInput.value = spaceInput.value.replace(/^0+/, ''); // Remove leading zeros  
      spaceInput.value = spaceInput.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters  
      if (!validSpace.test(spaceInput.value)) {  
         spaceInput.setCustomValidity("Please enter a positive number.");  
      } else {  
         spaceInput.setCustomValidity("");  
      }  
   }  
     
   function validatePeople() {  
      const peopleInput = document.getElementById('people');  
      const validPeople = /^[1-9]\d*$/; // Allow only positive integers  
      peopleInput.value = peopleInput.value.replace(/^0+/, ''); // Remove leading zeros  
      peopleInput.value = peopleInput.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters  
      if (!validPeople.test(peopleInput.value)) {  
         peopleInput.setCustomValidity("Please enter a positive number.");  
      } else {  
         peopleInput.setCustomValidity("");  
      }  
   }  
     
   // Optional: Handle file input click to trigger the file input  
   document.querySelector('.file-upload-button').addEventListener('click', function() {  
      document.querySelector('.file-input').click();  
   });
   





   function fetchProperties() {
    fetch('properties.php')
        .then(response => response.json())
        .then(properties => {
            properties.forEach(property => {
                // Create a marker for each property
                const marker = L.marker([property.lat, property.lon]).addTo(map);

                // Bind a popup with property details
                marker.bindPopup(`
                    <b>${property.name}</b><br>
                    Space: ${property.space} sq ft<br>
                    Type: ${property.type}<br>
                    Gender: ${property.gender}<br>
                    Food Option: ${property.food}<br>
                    Address: ${property.address}<br>
                    People: ${property.people}
                `);
            });
        })
        .catch(error => {
            console.error('Error fetching property data:', error);
        });
}

// Call the function to load properties when the page loads
document.addEventListener('DOMContentLoaded', fetchProperties);





$(document).ready(function() {
    $.ajax({
        url: 'properties.php', // URL to the PHP script
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            var $navfix = $('.navfix');
            $navfix.empty(); // Clear existing content

            if (data.error) {
                $navfix.html('<p>Error loading properties: ' + data.error + '</p>');
            } else if (data.length === 0) {
                $navfix.html('<p>No properties available.</p>');
            } else {
                $.each(data, function(index, property) {
                    var propertyHtml = `
                        <div class="property-item">
                            <h3>${property.name}</h3>
                            <p>Property Space: ${property.space} sq ft</p>
                            <p>Type: ${property.type}</p>
                            <p>Gender: ${property.gender}</p>
                            <p>Food: ${property.food}</p>
                            <p>Address: ${property.address}</p>
                            <p>Number of People: ${property.people}</p>
                            <p>Latitude: ${property.lat}</p>
                            <p>Longitude: ${property.lon}</p>
                        </div>
                    `;
                    $navfix.append(propertyHtml);
                });
            }
        },
        error: function() {
            $('.navfix').html('<p>Error loading properties.</p>');
        }
    });
});




document.getElementById('ticketForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const description = document.getElementById('description').value;
    
    // Process the description as needed
    console.log("User Description:", description);
});



// Function to fetch properties and add markers to the map
async function fetchProperties(address) {
    const response = await fetch(`fetch_properties.php?address=${encodeURIComponent(address)}`);
    const properties = await response.json();

    properties.forEach(property => {
        const { lat, lon, name, space, type, gender, food, people } = property;
        const marker = L.marker([lat, lon], { color: 'red' }).addTo(map);

        // Bind a popup with property details
        marker.bindPopup(`
            <b>${name}</b><br>
            Address: ${property.address}<br>
            Space: ${space} sq ft<br>
            Type: ${type}<br>
            Gender: ${gender}<br>
            Food Option: ${food}<br>
            People: ${people}
        `);
    });
}

// Modify your existing search handling
searchInput.addEventListener('input', async function () {
    const query = searchInput.value;
    if (query.length < 2) {
        autocompleteContainer.innerHTML = ''; // Clear suggestions if query is too short
        return;
    }

    // Fetch properties and add markers to the map
    await fetchProperties(query);
});

async function fetchProperties(address) {
    const response = await fetch(`fetch_properties.php?address=${encodeURIComponent(address)}`);
    const properties = await response.json();

    console.log(properties); // Debug log to see fetched properties

    properties.forEach(property => {
        const { lat, lon, name, space, type, gender, food, people } = property;
        const marker = L.marker([lat, lon]).addTo(map); // Removed color option, not necessary

        // Bind a popup with property details
        marker.bindPopup(`
            <b>${name}</b><br>
            Address: ${property.address}<br>
            Space: ${space} sq ft<br>
            Type: ${type}<br>
            Gender: ${gender}<br>
            Food Option: ${food}<br>
            People: ${people}
        `);
    });

    if (properties.length === 0) {
        console.log("No properties found for this address.");
    }
}
