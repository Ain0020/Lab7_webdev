<?php
// Start the session
session_start();

include 'Database.php';
include 'Users.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve the matric value from the GET request
    $matric = $_GET['matric'];

    // Process the update using the matric value
    // For example, you can fetch the user data using the matric value and display it in a form for updating
    // Create an instance of the Database class and get the connection
    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);
    $userDetails = $user->getUser($matric);

    // Close the connection
    $db->close();

    // Set session variables with user data
    $_SESSION['userDetails'] = $userDetails;

    // Redirect to update form page
    header("Location: update_form.php");
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: block;
        }

        input[type="submit"],
        input[type="button"] {
            width: 100%;
            padding: 10px;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #28a745;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>

</head>

<body>
    <form action="update.php" method="post">
        <input type="hidden" name="matric" value="<?php echo $userDetails['matric']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $userDetails['name']; ?>"><br>
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="">Please select</option>
            <option value="lecturer" <?php if ($userDetails['role'] == 'lecturer') echo "selected" ?>>Lecturer</option>
            <option value="student" <?php if ($userDetails['role'] == 'student') echo "selected" ?>>Student</option>
        </select><br>
        <input type="submit" value="Update">
    </form>
</body>

</html>