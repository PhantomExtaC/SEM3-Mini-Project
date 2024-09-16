<?php
$servername = "localhost";
$username = "root"; // replace with your MySQL username
$password = ""; // replace with your MySQL password
$dbname = "casca_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$space = $_POST['space'];
$type = $_POST['type'];
$gender = $_POST['gender'];
$food = $_POST['food'];
$address = $_POST['address'];
$people = $_POST['people'];

// Use geocoding service to get lat and lon
$address_encoded = urlencode($address);
$geocode_url = "https://nominatim.openstreetmap.org/search?format=json&q=$address_encoded";
$geocode_response = file_get_contents($geocode_url);
$geocode_data = json_decode($geocode_response, true);

$lat = $lon = null;
if (isset($geocode_data[0])) {
    $lat = $geocode_data[0]['lat'];
    $lon = $geocode_data[0]['lon'];
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO properties (name, space, type, gender, food, address, people, lat, lon) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sissssdds", $name, $space, $type, $gender, $food, $address, $people, $lat, $lon);

// Execute the statement
$stmt->execute();

echo "New property listed successfully";

$stmt->close();
$conn->close();
?>
