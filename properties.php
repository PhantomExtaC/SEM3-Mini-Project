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

// Fetch property data
$query = "SELECT name, space, type, gender, food, address, people, lat, lon FROM properties";
$result = $conn->query($query);

if ($result === FALSE) {
    echo json_encode(array('error' => $conn->error));
    $conn->close();
    exit();
}

$properties = array();
while ($row = $result->fetch_assoc()) {
    $properties[] = $row;
}

echo json_encode($properties);

$conn->close();
?>
