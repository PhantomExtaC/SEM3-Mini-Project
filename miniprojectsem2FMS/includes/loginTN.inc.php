<?php
session_start(); // Start the session
$authenticated = false;
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "dbh.inc.php"; // Include your database connection

    // Get the form data
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Prepare SQL to check for tenant by username, email, or phone number
    $sql = "SELECT * FROM user_tenant WHERE (Username = :login OR Email = :login OR Phone_number = :login)";

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
                // Password is correct, start a session
                $_SESSION['tenant_id'] = $user['id']; // Store tenant ID in session
                $_SESSION['tenant_username'] = $user['Username']; // Store username in session

                // Redirect to a protected page or dashboard
                $authenticated = true;
                header("Location: Thome.html");
                exit();
            } else {
                // Invalid password
                echo "<p style='color:red;'>Invalid password.</p>";
            }
        } else {
            // No user found
            echo "<p style='color:red;'>No tenant found with the provided credentials.</p>";
        }

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: login_form.php"); // Redirect back if accessed without submitting the form
    exit();
}
?>
