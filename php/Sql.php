<?php
    // SQL.PHP handles the SQL queries sent to the database.

    //  ___________
    // | VARIABLES |
    // |___________|

    // USERNAME VARIABLE FROM FORM
    $username = $_POST['username'];
    $userPassword = $_POST['alteredPassword'];
    $userSalt = $_POST['userSalt'];
    $userScore = $_POST['userScore'];
    session_start();
    //$userSalt = $_SESSION['userSalt']; // Server Generated Salt
    $_SESSION['password'] = $userPassword;
    
    //  ________________
    // | SQL STATEMENTS |
    // |________________|
    
    // IN FUTURE: PREPARE THESE STATEMENTS, prone to SQL-Injection.

    // SQL STATEMENT TO CHECK IF A USERNAME ALREADY EXISTS
    // *** REQUIREMENTS : $username ***
    $existsSQL = "SELECT (EXISTS (SELECT 1 FROM `User` WHERE Username = '$username')) AS results;";

    // SQL STATEMENT TO SELECT USERS SALT
    // *** REQUIREMENTS : $username ***
    $saltSQL = "SELECT UserSalt FROM `User` WHERE Username = '$username';";
    
    // SQL STATEMENT TO INSERT A USER INTO THE DATABASE
    // *** REQUIREMENTS : $username, $userPassword, $userSalt ***
    $insertSQL = "INSERT INTO `epiz_24392556_Assignment1`.`User` (`Username`, `UserPassword`, `UserSalt`) VALUES ('$username', '$userPassword', '$userSalt');";

    // SQL STATEMENT TO GRAB THE USERS INFO
    // *** REQUIREMENTS : $username, $password ***
    $userVerificationSQL = "SELECT (EXISTS (SELECT 1 FROM `User` WHERE Username = '$username' AND UserPassword = '$userPassword')) AS results;";
    
    // SQL STATEMENT TO GRAB WORDS
    $wordsSQL = "SELECT * FROM `Word`;";

    // SQL STATEMENT TO INSERT INTO SCORE TABLE
    // *** REQUIREMENTS : $userName, $userScore;
    $insertSQL2 = "INSERT INTO `epiz_24392556_Assignment1`.`Score` (`ScoreUsername`, `ScoreValue`) VALUES ('$currentUser', '$userScore');";

    // SQL STATEMENT TO SELECT TOP 10 SCORES
    $topTenSQL = "SELECT ScoreUsername, ScoreValue FROM `Score` ORDER BY ScoreValue DESC LIMIT 10;";

    // SQL STATEMENT TO SELECT PREVIOUS SCORE
    $previousScoreSQL = "SELECT ScoreUsername, ScoreValue FROM `Score` ORDER BY ScoreID DESC LIMIT 1;";
?>