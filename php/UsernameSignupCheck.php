<?php
    // USERNAMESIGNUPCHECK.PHP checks if the user exists at sign up.
if($_POST){
    include 'Connect.php';
    
    // Store the User's entered Username
    $username = $_POST["username"];

    // Grab the SQL statements
    include 'Sql.php';
    // QUERY to see if the username exists
    $result = mysqli_query($con, $existsSQL) or die ("BAD QUERY");
    while($row = mysqli_fetch_assoc($result))
    {
        $checkResult = $row['results'];
    }
    //existsSQL Query Test
    //include 'output.php';

    if($checkResult == 1){
        // If the username does exist, pass the corresponding salt value to the user so they can try to enter their password.
        header("Location: " . $_SERVER['REQUEST_URI'] = 'http://wsucslillywhite.epizy.com/usernamesignup.php');
        exit();
    }
    else
    {
        // If the username does not exist, generate salt to send back to the User and redirect them to the password entry
        $salt = bin2hex(random_bytes(16));
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['salt'] = $salt;
        header("Location: " . $_SERVER['REQUEST_URI'] = 'http://wsucslillywhite.epizy.com/passwordsignup.php');
        exit();
    }
}
?>

