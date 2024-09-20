<?php
// Database connection settings
$host = 'localhost'; // Change this if your database is on a different server
$dbname = 'your_database_name'; // Your database name
$username = 'your_username'; // Your database username
$password = 'your_password'; // Your database password

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the address from the request
$address = isset($_GET['address']) ? $conn->real_escape_string($_GET['address']) : '';

// Prepare the SQL query
$sql = "SELECT name, address, latitude, longitude, space, type, gender, food, people FROM properties WHERE address LIKE '%$address%'";
$result = $conn->query($sql);

// Prepare an array to hold property data
$properties = [];

if ($result->num_rows > 0) {
    // Fetch each row of data
    while ($row = $result->fetch_assoc()) {
        $properties[] = [
            'name' => $row['name'],
            'address' => $row['address'],
            'lat' => $row['latitude'],
            'lon' => $row['longitude'],
            'space' => $row['space'],
            'type' => $row['type'],
            'gender' => $row['gender'],
            'food' => $row['food'],
            'people' => $row['people'],
        ];
    }
}

// Return JSON data
header('Content-Type: application/json');
echo json_encode($properties);

// Close the connection
$conn->close();
?>
