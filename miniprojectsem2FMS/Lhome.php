<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casca</title>
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" type="x-icon" href="img/favicon4.png">
    <style>
        /* Add custom styles for the file input */
        .file-upload-container {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        .file-upload-button {
            width: 40px;
            height: 40px;
            background: #ffa600; /* Button background color */
            border-radius: 50%;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            border: none;
            font-size: 20px;
            text-align: center;
            font-family: 'Lato', sans-serif; /* Ensure consistent font */
        }
        .file-upload-button:hover {
            background: #263147; /* Darker color on hover */
        }
        .file-input {
            display: none; /* Hide the default file input */
        }
        .file-upload-text {
            margin-left: 10px;
            font-size: 17px; /* Font size for consistency */
            color: #333; /* Text color for consistency */
            font-family: 'Lato', sans-serif; /* Ensure consistent font */
        }
        .submit-btn {
            font-size: 1.5rem; /* Bigger text size */
            color: white; /* White text color */
            font-family: 'Lato', sans-serif; /* Ensure consistent font */
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo-container">
            <img src="img/favicon5.png" alt="Logo" width="50" height="50">
            <h2 class="logo">Casca</h2>
        </div>
        <ul>
            <li class="active"><a href="Lhome.php">List Property</a></li>
            <li><a href="listings.php">View Listings</a></li>
            <li><a href="viewtickets.php">View Tickets</a></li>
            <li><a href="viewreviews.php">View Reviews</a></li>
        </ul>
        <button class="login"><a href="includes/logout.php">Logout</a></button>
    </nav>
    <div class="navfix"> 
        <div class="form-container">
            <div class="form-box">
                <h2>List a Property</h2>
                <form id="propertyForm" action="upload.php" method="POST" enctype="multipart/form-data">
                    <div class="input-box">
                        <input type="text" class="input-field" id="name" name="name" placeholder="Property Name" required>
                    </div>

                    <div class="input-box">
                        <input type="text" class="input-field" id="space" name="space" placeholder="Property Space (sq ft)" required oninput="validateSpace()">
                    </div>

                    <div class="input-box">
                        <input type="text" class="input-field" id="type" name="type" placeholder="Type (e.g., BHK, 1B)" required pattern="[BHK1-9]+" oninput="validateType()">
                    </div>

                    <div class="input-box">
                        <select id="gender" name="gender" class="input-field" required>
                            <option value="boys">Boys Only</option>
                            <option value="girls">Girls Only</option>
                            <option value="na">N/A</option>
                        </select>
                    </div>

                    <div class="input-box">
                        <select id="food" name="food" class="input-field" required>
                            <option value="veg">Veg</option>
                            <option value="non-veg">Non-Veg</option>
                            <option value="vegan">Vegan</option>
                        </select>
                    </div>
                    
                    <div class="input-box">
                        <input type="text" class="input-field" id="address" name="address" placeholder="Address" required>
                    </div>

                    <div class="input-box">
                        <input type="text" class="input-field" id="people" name="people" placeholder="Number of People" required oninput="validatePeople()">
                    </div>

                    <div class="input-box file-upload-container">
                        <label for="photos" class="file-upload-button">+</label>
                        <input type="file" class="file-input" id="photos" name="photos[]" multiple accept="image/*">
                        <span class="file-upload-text">Upload Images</span>
                    </div>

                    <div class="input-submit">
                        <button type="submit" class="submit-btn" id="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>

</body>
</html>

