<?php
// Start the session
session_start();

include 'Database.php';
include 'Users.php';

// Check if the user is logged in
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['userRole']) && $_SESSION['userRole'] === 'admin') {
    // Retrieve the matric value from the GET request
    $matric = $_GET['matric'];

    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    // Create an instance of the User class
    $user = new User($db);
    $user->deleteUser($matric);

    // Close the connection
    $db->close();

    // Redirect to read page after successful deletion
    header("Location: read.php");
    exit();
}
?>