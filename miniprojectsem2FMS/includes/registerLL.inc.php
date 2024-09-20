<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["password"];
    $email = $_POST["email"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $phoneNo = $_POST["phone"];

    try {
        require_once "dbh.inc.php";  // Your database connection script

        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);

        $query = "INSERT INTO user_owner (Username, password, Email, First_name, Last_name, Phone_No) VALUES (?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $hashedPwd, $email, $firstName, $lastName, $phoneNo]);

        $pdo = null;
        $stmt = null;
        header("Location: ../landlord.php");  // Redirect after successful insert
        $_SESSION["username"] = $username;
        die();

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.html");  // Redirect if accessed directly
}
?>
