<?php

// Connect to the database
$host = "localhost:8888";
$username = "username";
$password = "password";
$dbname = "accounts";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Prepare the SELECT query
    $query = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Check if the query returned any results
    if (mysqli_num_rows($result) > 0) {
        // The entered credentials are correct
        echo "Login successful!";
    } else {
        // The entered credentials are incorrect
        echo "Login failed. Incorrect username, password, or acckey.";
    }
}

mysqli_close($conn);

?>