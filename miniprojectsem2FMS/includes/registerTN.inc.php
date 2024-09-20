<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["password"];
    $email = $_POST["email"];
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $phoneNo = $_POST["phone"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];

    try {
        require_once "dbh.inc.php";  // Your database connection script

        $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT);

        $query = "INSERT INTO user_tenant (Username, pwd, Email, First_name, Last_name, Phone_number, gender, dob) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $hashedPwd, $email, $firstName, $lastName, $phoneNo, $gender, $dob]);

        $pdo = null;
        $stmt = null;
        header("Location: ../Thome.php");  // Redirect after successful insert
        die();

    } catch (PDOException $e) {
        // Check if the error code is for a duplicate entry (1062)
        if ($e->getCode() == 23000) {
            // Extract the field that caused the error
            if (strpos($e->getMessage(), 'user_tenant_username_unique') !== false) {
                $error_message = "The username '$username' is already taken. Please choose another one.";
            } elseif (strpos($e->getMessage(), 'user_tenant_email_unique') !== false) {
                $error_message = "The email '$email' is already registered. Please use another email.";
            } elseif (strpos($e->getMessage(), 'user_tenant_phone_number_unique') !== false) {
                $error_message = "The phone number '$phone' is already in use.";
            } else {
                $error_message = "A duplicate entry occurred.";
            }

            $_SESSION["username"] = $username;

            // Redirect back to the registration form with the error message
            header("Location: ../registerTN.html");
            exit();
        } else {
            die("Query Failed: " . $e->getMessage());
        }
    }
} else {
    header("Location: ../registerTN.html");
    exit();
}
?>
