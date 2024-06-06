<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

include 'Database.php';
include 'Users.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the POST request
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    // Create an instance of the User class
    $user = new User($db);

    // Check if the logged-in user has permission to perform the update
    if ($_SESSION['userRole'] === 'admin' || $_SESSION['matric'] === $matric) {
        // Perform the update
        $user->updateUser($matric, $name, $role);
    } else {
        // If the user does not have permission, redirect to read page
        header("Location: read.php");
        exit();
    }

    // Close the connection
    $db->close();

    // Redirect to read page after successful update
    header("Location: read.php");
    exit();
}
?>