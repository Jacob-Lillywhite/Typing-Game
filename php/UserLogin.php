<?php

if($_POST)
{
    include 'Connect.php';
    include 'Sql.php';
    
    // QUERY to see if the username and password match what is in the database.
    $result = mysqli_query($con, $userVerificationSQL) or die ("BAD VERIFICATION QUERY");
    echo var_dump($_SESSION);
    while($row = mysqli_fetch_assoc($result))
    {
        $userVerification = $row['results'];
    }

    if($userVerification == 1)
    {
        // If the username and password match store the username and redirect to the game
        header("Location: " . $_SERVER['REQUEST_URI'] = 'http://wsucslillywhite.epizy.com/index.php');
        exit();
    }
    else
    {
        // If the password does not exist redirect them to the password signin to try again.
        header("Location: " . $_SERVER['REQUEST_URI'] = 'http://wsucslillywhite.epizy.com/passwordlogin.php');
        exit();
    }
}

?>