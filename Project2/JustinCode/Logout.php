<?php
session_start();
$flag = false;

if(isset($_SESSION['studID'])) { $flag = true; } //if student ID detected then it will go to 01StudSignIn.html otherwise it will go to StudentAdminSignIn.html

session_unset();
session_destroy();


if($flag) { header("Location: 01StudSignIn.html"); } 
else { header("Location: StudentAdminSignIn.html"); }

?>