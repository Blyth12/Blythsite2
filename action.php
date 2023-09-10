<?php
//Conn
$host = "localhost:3306";
$username = "root";
$password = "";
$dbname = "accounts";
$conn = mysqli_connect($host, $username, $password, $dbname);

function generate_session_id($length = 32) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $sessionid = '';

    for ($i = 0; $i < $length; $i++) {
        $sessionid .= $characters[random_int(0, strlen($characters) -1)];
    }
    return $sessionid;
}

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
        $user_id = $username;
        $session_id = generate_session_id();
        $_SESSION['user_id'] = $user_id;
        setcookie('session_id', $session_id, time() + 3600, '/');
        echo "Login successful!";
        header("Location: uploads.php");
        exit();
    }
    else {
        //No match
        mysqli_close($conn);
        echo "Login failed. Incorrect username, password, or acckey.";
        header("Location: login.html?error=credentials");
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