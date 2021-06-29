<?php
if($_POST){
include 'Connect.php';
include 'Sql.php';


// Take the POSTED info and INSERT it into the Database
mysqli_query($con, $insertSQL) or die ("BAD INSERT QUERY");
// Redirect the User to the login screen
header("Location: " . $_SERVER['REQUEST_URI'] = 'http://wsucslillywhite.epizy.com/usernamelogin.php');
exit();
}
?>