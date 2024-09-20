<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casca</title>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
         integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
         crossorigin=""/>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" type="x-icon" href="img/favicon4.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/leaflet-geosearch/dist/geosearch.umd.js"></script>
</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="img/favicon5.png" alt="Logo" width="50" height="50"> 
            <h2 class="logo">Casca</h2>
        </div>
        <ul>
            <li class="active"><a href="Thome.php">Home</a></li>
            <li><a href="Raisetickets.php">Raise Tickets</a></li>
            <li><a href="Pastrent.php">Past Rentals</a></li>
        </ul>
        <button class="login"><a href="includes/logout.php">Logout</a></button>
    </nav>

    <div class="white-bar">
        <input type="text" placeholder="Enter Location" class="search-bar" id="search-input">
        <button id="locate-button" class="locate-button">
            <img src="img/mark.png" alt="Locate" class="button-icon">
        </button>
        <div class="autocomplete-container" id="autocomplete-container"></div>
    </div>
    
    <main>
        <div id="map"></div>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
                crossorigin=""></script>
        <script src="script.js"></script>
    </main>
</body>
</html>
