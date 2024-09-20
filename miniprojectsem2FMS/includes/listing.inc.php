<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $house_no = $_POST["house_no"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $pincode = $_POST["pincode"];
    $tenant_id = $_POST["tenant_id"];
    $owner_id = $_POST["owner_id"];
    
    // Files array for the uploaded images
    $images = $_FILES['images'];

    try {
        // Connect to the database
        require_once 'dbh.inc.php';

        // Start a transaction to ensure both listings and images are uploaded together
        $pdo->beginTransaction();

        // Insert the listing details into the listings table
        $sql = "INSERT INTO listings (house_no, street, city, state, pincode, tenant_id, owner_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$house_no, $street, $city, $state, $pincode, $tenant_id, $owner_id]);

        // Get the last inserted ID for the listing
        $listing_id = $pdo->lastInsertId();

        // Loop through the uploaded images
        foreach ($images['tmp_name'] as $key => $tmp_name) {
            // Read the image file content
            $image = file_get_contents($tmp_name);

            // Insert the image into the images table, associating it with the listing_id
            $image_sql = "INSERT INTO listing_images (listing_id, image) VALUES (?, ?)";
            $image_stmt = $pdo->prepare($image_sql);
            $image_stmt->execute([$listing_id, $image]);
        }

        // Commit the transaction
        $pdo->commit();

        echo "Listing and images uploaded successfully!";
    } catch (PDOException $e) {
        // Roll back the transaction if something failed
        $pdo->rollBack();
        die("Error: " . $e->getMessage());
    }
}
