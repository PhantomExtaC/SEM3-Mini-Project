<?php
$servername = "localhost"; 
$username = "root";         
$password = "";             
$dbname = "casca";         

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$phone = $_POST['phone'];
$role = $_POST['role'];
$aadhaar = $_POST['aadhaar'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$password = $_POST['password']; // Store plain text password

$stmt = $conn->prepare("INSERT INTO users (name, phone, role, aadhaar, age, gender, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssisss", $name, $phone, $role, $aadhaar, $age, $gender, $email, $password);

if ($stmt->execute()) {
    // Redirect based on role
    if ($role === 'tenant') {
        header("Location: Thome.html");
    } else if ($role === 'landlord') {
        header("Location: Lhome.html");
    }
    exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
