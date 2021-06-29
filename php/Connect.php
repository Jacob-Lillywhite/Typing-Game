<?php
    // CONNECT.PHP Handles the Server-Database Connection

    //  ______________________
    // | DATABASE INFORMATION |
    // |______________________|
    $hostName = 'sql305.epizy.com';
    $dbUserName = 'epiz_24392556';
    $dbPassword = 'Uq5j6wjH9bndmjG';
    $dbName = 'epiz_24392556_Assignment1';
  
    //  _____________________
    // | DATABASE CONNECTION |
    // |_____________________|
    $con =mysqli_connect($hostName, $dbUserName, $dbPassword, $dbName);
    // CONNECTION ERROR
    if(!$con)
    {
        echo 'NOT connected to the server.';
    }
    // DATABASE NOT SELECTED ERROR
    if(!mysqli_select_db ($con, $dbName))
    {
        echo 'Database NOT selected.';
    }
    
?>