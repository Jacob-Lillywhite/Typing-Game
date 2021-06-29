<?php
session_start();
session_destroy();
$_SESSION=array();
unset($_SESSION);
    // USERNAMELOGINCHECK.PHP checks if the user exists at login.
if($_POST){
    include 'Connect.php';
    include 'Sql.php';

    $username = $_POST["username"];
    $_SESSION['username'] = $username;
    // QUERY to see if the username exists
    $result = mysqli_query($con, $existsSQL) or die ("BAD QUERY");
    while($row = mysqli_fetch_assoc($result))
    {
        $checkResult = $row['results'];
    }
    if($checkResult == 1){
        // If the username does exist, pass the corresponding salt value to the user so they can try to enter their password.
        session_start();
        $result2 = mysqli_query($con, $saltSQL) or die("BAD QUERY");
            while($row = mysqli_fetch_assoc($result2))
            {
            $userSalt = $row['UserSalt'];
            }
            $_SESSION['userSalt'] = $userSalt;
        header("Location: " . $_SERVER['REQUEST_URI'] = 'http://wsucslillywhite.epizy.com/passwordlogin.php');
        exit();  
    }
    else{
        // If the username does not exist redirect the user to the username login page
        header("Location: " . $_SERVER['REQUEST_URI'] = 'http://wsucslillywhite.epizy.com/usernamelogin.php');
        exit();
    }
}
?>

