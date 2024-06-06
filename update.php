<?php
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

    $user = new User($db);
    $user->updateUser($matric, $name, $role);

    // Close the connection
    $db->close();

    // Redirect to read page after successful update
    header("Location: read.php");
    exit();
}
?>