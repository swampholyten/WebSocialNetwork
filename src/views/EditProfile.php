<?php
include_once('../models/database.php');

// Assume the user is logged in and you have the user ID
$loggedInUserID = 2; // Replace with the actual logged-in user ID

$database = new Database();

// Fetch user data
$userData = $database->getUserByID($loggedInUserID);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $newUsername = $_POST['new_username'];
    $newEmail = $_POST['new_email'];
    $newBio = $_POST['new_bio'];

    // Validate input (you should perform more comprehensive validation)
    if (empty($newUsername) || empty($newEmail)) {
        $errorMessage = "Please fill in all required fields.";
    } else {
        // Check if the new username or email already exists
        $existingUser = $database->getUserByUsername($newUsername);
        $existingEmail = $database->getUserByEmail($newEmail);

        if ($existingUser && $newUsername !== $userData['Username']) {
            $errorMessage = "Username already exists. Please choose a different one.";
        } elseif ($existingEmail && $newEmail !== $userData['Email']) {
            $errorMessage = "Email already exists. Please choose a different one.";
        } else {
            // Update user data in the database
            $result = $database->updateUser($loggedInUserID, $newUsername, $newEmail, $newBio);

            if ($result) {
                echo '<script>alert("Profile updated successfully!");</script>';
                // Refresh user data after update
                $userData = $database->getUserByID($loggedInUserID);
                
            } else {
                echo '<script>alert("Profile update failed. Please try again later.!");</script>';
            }

            // Redirect back to the profile page after submission

            header('Location: profile.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="../css/EditProfile.css">
</head>
<body>

<main class="main">

    <header class="header">
        <div class="public-container header-container">
            <span class="username"><?php echo $userData['Username']; ?></span>
        </div>
    </header>
    <section class="settings-form public-container">
        <form class="form">
            <section class="back">
                <h2 class="title">Describe You</h2>
                <a href="javascript:history.back()" class="back-button">Back</a>
                <!-- Oppure, se preferisci un pulsante -->
                <!-- <button class="back-button" onclick="javascript:history.back()">Back</button> -->
            </section>
            
            <h3 class="subtitle">Let's modify your account!</h3>
            <section class="input-container ic1">
                <input id="new_username" name="new_username" class="input" type="text" placeholder=" " />
                <div class="cut"></div>
                <label for="new_username" class="placeholder">Username</label>
            </section>
            <section class="input-container ic2">
                <input id="new_email" name="new_email" class="input" type="email" placeholder=" " />
                <div class="cut"></div>
                <label for="new_email" class="placeholder">New Email</label>
            </section>
            <section class="input-container ic2 ic3">
                <textarea id="new_bio" name="new_bio" class="input" type="text" placeholder=" "></textarea>
                <div class="cut cut-short"></div>
                <label for="new_bio" class="placeholder">Bio</>
            </section>
            <button type="submit" class="submit">Update Profile</button>
        </form>
    </section>

</main>

<script src="../js/backbutton.js"></script>

<?php include_once('Nav.php'); ?>

</body>
</html>