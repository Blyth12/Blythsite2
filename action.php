<?php

// Connect to the database
$host = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query the database to check if the entered credentials match those in the database
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    // If a match is found, log the user in
    if (mysqli_num_rows($result) == 1) {
        // Start a session and set a session variable to indicate that the user is logged in
        session_start();
        $_SESSION['logged_in'] = true;

        // Redirect the user to the protected page
        header('Location: protected.php');
        exit;
    } else {
        // If the entered credentials are invalid, show an error message
        $error = "Invalid username or password";
    }
}

?>

<!-- HTML login form -->
<form action="" method="post">
    <label for="username">Username:</label><br>
    <input type="text" name="username" id="username"><br>
    <label for="password">Password:</label><br>
    <input type="password" name="password" id="password"><br><br>
    <input type="submit" name="submit" value="Log in">
</form>

<?php