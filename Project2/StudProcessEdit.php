<?php
session_start();

$_SESSION["firstN"] = strtoupper($_POST["firstN"]);
$_SESSION["lastN"] = strtoupper($_POST["lastN"]);
$_SESSION["email"] = $_POST["email"];
$_SESSION["major"] = $_POST["major"];

$firstn = strtoupper($_POST["firstN"]);
$lastn = strtoupper($_POST["lastN"]);
$studid = $_SESSION["studID"];
$email = $_POST["email"];
$major = $_POST["major"];

//if statement to create more space in mySQL table for Students

if($major == 'Computer Science')
    {$major = "CMSC";}
elseif($major == 'Computer Engineering')
    {$major = "CMPE";}
elseif($major == 'Mechanical Engineering')
    {$major = "MENG";}
elseif($major == 'Chemical Engineering')
    {$major = "CENG";}
elseif($major == 'Engineering Undecided')
    {$major = "ENGR";}

$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);
if($_SESSION["studExist"] == true){
    $sql = "update `Proj2Students` set `FirstName` = '$firstn', `LastName` = '$lastn', `Email` = '$email', `Major` = '$major' where `StudentID` = '$studid'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]); // posts to Students table in mySQL
}

header('Location: 02StudHome.php'); // returns to home
?>