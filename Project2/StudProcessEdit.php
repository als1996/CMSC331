<?php
session_start();


include '../CommonMethods.php';

$debug = false;
$COMMON = new Common($debug);

//sets value to session
$userid = $_SESSION["userID"];
$sql = "select * from Proj2Students where `id` = '$userid'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

$firstn = $row[1];
$lastn = $row[2];
$studid = $row[3];
$email = $row[4];
$major = $row[5];

$firstn = strtoupper($_POST["firstN"]);
$lastn = strtoupper($_POST["lastN"]);
$email = $_POST["email"];
$studid = $_POST["studID"];
$major = $_POST["major"];

$sql = "update `Proj2Students` set `FirstName` = '$firstn', `LastName` = '$lastn', `Email` = '$email', `Major` = '$major', `StudentID` = '$studid' where `id` = '$userid'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]); // posts to Students table in mySQL


header('Location: 02StudHome.php'); // returns to home
?>