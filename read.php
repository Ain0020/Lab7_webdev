<?php
include 'Database.php';
include 'Users.php';

// Start session to access session variables
session_start();

// Create an instance of the Database class and get the connection
$database = new Database();
$db = $database->getConnection();

// Create an instance of the User class
$user = new User($db);

// Check if the matric value is set in the session
if(isset($_SESSION['matric'])) {
    // Fetch user data based on the matric value stored in the session
    $matric = $_SESSION['matric'];
    $userData = $user->getUser($matric);

    // Initialize the name variable
    $name = "";

    // Check if user data is retrieved successfully
    if ($userData !== false) {
        // Assign the name to the $name variable
        $name = $userData['name'];
    }
} else {
    // Redirect to login page if matric is not set in session
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-left: auto; /* Center the table horizontally */
            margin-right: auto;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #ddd;
        }

        table a {
            color: #007bff;
            text-decoration: none;
        }

        table a:hover {
            text-decoration: underline;
        }

        h2 {
            text-align: center;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 150px;
            height: 40px;
            float: right;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <br><br>
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
    <br><br>
    <h2>Hi, <?php echo $name; ?></h2>
    <br><br>
    <table border="1">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Role</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        // Fetch all users
        $result = $user->getUsers();

        if ($result) {
            // Fetch each row from the result set
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["matric"]; ?></td>
                    <td><?php echo $row["name"]; ?></td>
                    <td><?php echo $row["role"]; ?></td>
                    <td><a href="update_form.php?matric=<?php echo $row["matric"]; ?>">Update</a></td>
                    <td><a href="delete.php?matric=<?php echo $row["matric"]; ?>">Delete</a></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
        }
        ?>
    </table>
</body>

</html>