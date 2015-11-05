<?php
session_start();
$flag = false;

if(isset($_SESSION['studID'])) { $flag = true; }

session_unset();
session_destroy();

//************** davies4 10-22-2015 changed the flag to false
// in order to redirect to the basic signin html page instead of
// just the student.
$flag = false;
if($flag) { header("Location: 01StudSignIn.html"); }
else { header("Location: StudentAdminSignIn.html"); }

?>