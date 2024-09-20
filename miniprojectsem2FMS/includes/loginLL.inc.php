<?php
session_start(); // Start the session
$authenticated = false;

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "dbh.inc.php"; // Include your database connection

    // Get the form data
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Prepare SQL to check for owner by username, email, or phone number
    $sql = "SELECT * FROM user_owner WHERE (Username = :login OR Email = :login OR Phone_number = :login)";

    try {
        // Prepare the query
        $stmt = $pdo->prepare($sql);
        // Bind the login parameter
        $stmt->bindParam(':login', $login);

        // Execute the query
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user is found
        if ($user) {
            // Verify the password with hashed password
            if (password_verify($password, $user['pwd'])) {
                // Password is correct, start a session for the owner
                $_SESSION['owner_id'] = $user['id']; // Store owner ID in session
                $_SESSION['owner_username'] = $user['Username']; // Store username in session

                // Redirect to the owner's dashboard
                $authenticated = true;
                header("Location: ../Lhome.php");
                exit();
            } else {
                // Invalid password
                echo "<p style='color:red;'>Invalid password.</p>";
            }
        } else {
            // No user found
            echo "<p style='color:red;'>No owner found with the provided credentials.</p>";
        }

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: loginLL.html"); // Redirect back if accessed without submitting the form
    exit();
}
?>
