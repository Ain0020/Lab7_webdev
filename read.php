<?php
include 'Database.php';
include 'Users.php';

// Create an instance of the Database class and get the connection
$database = new Database();
$db = $database->getConnection();

// Create an instance of the User class
$user = new User($db);

// Fetch user data
$result = $user->getUsers();

// Initialize the name variable
$name = "";

// Check if there are rows returned from the database
if ($result->num_rows > 0) {
    // Assuming the first row contains the user data
    $row = $result->fetch_assoc();
    // Assign the name to the $name variable
    $name = $row['name'];
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
  b order-collapse: collapse;
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
    </style>
</head>

<body>

<h2>Hi, <?php echo $name; ?></h2>
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
    <br><br>
    <table border="1">
        <tr>
            <th>Matric</th>
            <th>Name</th>
            <th>Level</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
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
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }
        // Close connection
        $db->close();
        ?>
    </table>
</body>

</html>