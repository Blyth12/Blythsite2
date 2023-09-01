<?php
//Conn
$host = "localhost:3306";
$username = "root";
$password = "";
$dbname = "accounts";
$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Submit check
if (isset($_POST['submit'])) {
    // Get the form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //Query
    $query = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    //Check if the query returned any results
    if (mysqli_num_rows($result) > 0) {
        //Match
        mysqli_close($conn);
        echo "Login successful!";
        $loggedin = array(
            'success' => true,
            'message' => 'Login successful'
        );
        $loggedinJSON = json_encode($loggedin);
        header("Location: uploads.html");
        exit();
    }
    else {
        //No match
        mysqli_close($conn);
        echo "Login failed. Incorrect username, password, or acckey.";
        header("Location: login.html?error=credentials");
        $loggedin = array(
            'success' => false,
            'message' => 'Login failed'
        );
        exit();
    }
}

else {
    header("Location: login.html?error=connection");
    exit();
}

header('Content-Type: application/json');
echo json_encode($loggedin);
mysqli_close($conn);

?>