<?php
session_start();
session_destroy();
$_SESSION=array();
unset($_SESSION);
 header("Location: " . $_SERVER['REQUEST_URI'] = 'http://wsucslillywhite.epizy.com/index.php');
 exit();
?>