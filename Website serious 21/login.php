<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "findmystay";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare SQL query to check if email exists and get password and role
    $stmt = $conn->prepare("SELECT role, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($role, $stored_password);
    $stmt->fetch();

    // Validate the password
    if ($stored_password && $stored_password === $password) {
        // Redirect based on role
        if ($role === 'tenant') {
            header("Location: Thome.html");
        } else if ($role === 'landlord') {
            header("Location: Lhome.html");
        }
        exit();
    } else {
        // Show an error message for invalid login
        echo "Invalid email or password. Please try again.";
    }

    $stmt->close();
}

$conn->close();
?>
