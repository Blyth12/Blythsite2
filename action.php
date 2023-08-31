<?php

// Connect to the database
$host = "localhost:3306";
$username = "root";
$password = "";
$dbname = "accounts";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    header("Location: login.html");
    // Get the form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";
    // Execute query
    $result = mysqli_query($conn, $query);

    // Check if the query returned any results
    if (mysqli_num_rows($result) > 0) {
        // Match
        mysqli_close($conn);
        echo "Login successful!";
        header("Location: uploads.html");
        exit();
    }
    else {
        // No match
        mysqli_close($conn);
        echo "Login failed. Incorrect username, password, or acckey.";
        header("Location: login.html");
        exit();
    }
}

else {
    header("Location: index.html");
    exit();
}

mysqli_close($conn);

?>