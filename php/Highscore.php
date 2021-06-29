<?php
if($_POST){
    session_start();
    $currentUser = $_SESSION['username'];
include 'Connect.php';
include 'Sql.php';

// Take the POSTED info and INSERT it into the Database
mysqli_query($con, $insertSQL2) or die ("BAD INSERT QUERY");

$result = mysqli_query($con, $topTenSQL) or die("BAD QUERY");
    while($row = mysqli_fetch_assoc($result))
    {
        $usernames[]=$row['ScoreUsername'];
        $userscores[]=$row['ScoreValue'];
    }
$_SESSION['usernames']= $usernames;
$_SESSION['userscores']= $userscores;

$result = mysqli_query($con, $previousScoreSQL) or die("BAD QUERY");
    while($row = mysqli_fetch_assoc($result))
    {
        $myUserscore=$row['ScoreValue'];
    }
    $_SESSION['myUserScore']= $myUserscore;

// Redirect the User to the highscore screen
header("Location: " . $_SERVER['REQUEST_URI'] = 'http://wsucslillywhite.epizy.com/score.php');
exit();
}
?>