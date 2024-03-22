<?php
include('connection.php');

// Assuming the password input field name is 'password'
$username = $_POST['username'];
$password = $_POST['password'];

// To prevent SQL injection
$username = stripcslashes($username);
$password = stripcslashes($password);
$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);

$sql = "SELECT * FROM login WHERE username = ? AND password = ?";
$stmt = mysqli_prepare($con, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    $count = mysqli_stmt_num_rows($stmt);

    if ($count == 1) {
        echo "<h1><center> Login successful </center></h1>";
    } else {
        echo "<h1> Login failed. Invalid username or password.</h1>";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error in preparing statement: " . mysqli_error($con);
}

mysqli_close($con);
?>

