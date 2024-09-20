<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casca - Listings</title>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
          crossorigin=""/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="img/favicon5.png" alt="Logo" width="50" height="50">
            <h2 class="logo">Casca</h2>
        </div>
        <ul>
            <li><a href="Lhome.php">List Property</a></li>
            <li><a href="listings.php">View Listings</a></li>
            <li><a href="viewtickets.php">View Tickets</a></li>
            <li class="active"><a href="viewreviews.php">View Reviews</a></li>
        </ul>
        <button class="login"><a href="includes/logout.php">Logout</a></button>
    </nav>

    <div class="navfix">
        <!-- Property listings will be dynamically inserted here -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
