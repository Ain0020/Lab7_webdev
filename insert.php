<?php
if(isset($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role'])) {
    // Check if any of the fields are empty
    if(empty($_POST['matric']) || empty($_POST['name']) || empty($_POST['password']) || empty($_POST['role'])) {
        echo "Error: Missing POST data.";
        // Debugging: Print POST data to see which fields are missing
        print_r($_POST);
        exit(); // Stop further execution
    }
    
    // Include necessary files
    include 'Database.php';
    include 'Users.php';

    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    // Create an instance of the User class
    $user = new User($db);

    // Register the user using POST data
    $user->createUser($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role']);

    // Close the connection
    $db->close();

    // Redirect to insert page
    header("Location: insert.php?success=1");
    exit(); // Stop further execution
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    <!-- Display pop-up message using JavaScript -->
    <script>
        if (<?php echo isset($_GET['success']) ? $_GET['success'] : '0'; ?>) {
            alert("Successfully registered!");
            window.location.href = "login.php"; // Redirect to login page
        }
    </script>
</body>
</html>