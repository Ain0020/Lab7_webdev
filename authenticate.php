<?php
session_start(); // Start the session

include 'Database.php';
include 'Users.php';

if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {
    // Create database connection
    $database = new Database();
    $db = $database->getConnection();

    // Sanitize inputs using mysqli_real_escape_string
    $matric = $db->real_escape_string($_POST['matric']);
    $password = $db->real_escape_string($_POST['password']);

    // Validate inputs
    if (!empty($matric) && !empty($password)) {
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        // Check if user exists and verify password
        if ($userDetails && password_verify($password, $userDetails['password'])) {
            // Set session variables upon successful login
            $_SESSION['loggedin'] = true;
            $_SESSION['matric'] = $matric;
            $_SESSION['name'] = $userDetails['name'];

            // Redirect to read.php
            header("Location: read.php");
            exit(); // Stop further execution
        } else {
            echo 'Login Failed';
        }
    } else {
        echo 'Please fill in all required fields.';
    }
}
?>