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

    // Function to render autocomplete suggestions
    function renderSuggestions(suggestions) {
        autocompleteContainer.innerHTML = ''; // Clear previous suggestions
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
                map.setView([suggestion.y, suggestion.x], 14);

                // Add a marker at the result location
                L.marker([suggestion.y, suggestion.x])
                    .addTo(map)
                    .bindPopup(suggestion.label)
                    .openPopup();
            });
            list.appendChild(item);
        });

        autocompleteContainer.appendChild(list);
    }

    // Add event listener for input changes
    searchInput.addEventListener('input', async function () {
        const query = searchInput.value;
        if (query.length < 2) {
            autocompleteContainer.innerHTML = ''; // Clear suggestions if query is too short
            return;
        }

        try {
            const results = await provider.search({ query });
            if (results.length > 0) {
                renderSuggestions(results);
            } else {
                autocompleteContainer.innerHTML = '<p>No results found.</p>';
            }
        } catch (error) {
            console.error('Error during search:', error);
            autocompleteContainer.innerHTML = '<p>Error retrieving results.</p>';
        }
    });

    // Hide autocomplete container when clicking outside
    document.addEventListener('click', function (e) {
        if (!autocompleteContainer.contains(e.target) && e.target !== searchInput) {
            autocompleteContainer.innerHTML = ''; // Hide suggestions
        }
    });

    // Variable to store user marker
    let userMarker;

    // Handle location button click
    document.getElementById('locate-button').addEventListener('click', function () {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;

                // Create or update a marker for the user's location
                if (userMarker) {
                    userMarker.setLatLng([userLat, userLng]).update();
                } else {
                    userMarker = L.marker([userLat, userLng]).addTo(map);
                }

                // Animate the map to the user's location
                map.flyTo([userLat, userLng], 14, {
                    animate: true,
                    duration: 1 // Adjust the animation duration as needed
                });

                // Optional: Add or update a popup on the marker
                userMarker.bindPopup('You are here').openPopup();
            }, function (error) {
                console.error('Error getting location:', error);
                alert('Unable to retrieve your location.');
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
    
    if (email === 'renter') {
        redirectUrl = 'https://example.com/site-a'; // Replace with actual URL for site A
        welcomeMessage = 'Welcome, Renter!';
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