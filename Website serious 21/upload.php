<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "casca";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $name = $_POST['name'];
    $space = $_POST['space'];
    $type = $_POST['type'];
    $gender = $_POST['gender'];
    $food = $_POST['food'];
    $address = $_POST['address'];
    $latitude = $_POST['latitude']; // New field
    $longitude = $_POST['longitude']; // New field
    $people = $_POST['people'];

    // Handling multiple file uploads
    $photosArray = [];
    $uploadDirectory = "uploads/";
    foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
        $file_name = basename($_FILES['photos']['name'][$key]);
        $targetFilePath = $uploadDirectory . $file_name;

        // Move uploaded file to the upload directory
        if (move_uploaded_file($tmp_name, $targetFilePath)) {
            $photosArray[] = $targetFilePath;
        }
    }

    // Convert photos array to JSON for storage in database
    $photosJSON = json_encode($photosArray);

    // Insert data into properties table
    $stmt = $conn->prepare("INSERT INTO properties (name, space, type, gender, food, address, latitude, longitude, people, photos) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        die("SQL prepare error: " . $conn->error);
    }

    $stmt->bind_param("ssssssddis", $name, $space, $type, $gender, $food, $address, $latitude, $longitude, $people, $photosJSON);

    if ($stmt->execute()) {
        // Redirect to listings.html after successful insertion
        header("Location: listings.html");
        exit(); // Ensure no further code is executed after the redirect
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
