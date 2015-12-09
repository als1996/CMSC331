<?php
session_start();

include '../CommonMethods.php';

$debug = false;
$COMMON = new Common($debug);

//sets value to session
$studid = strtoupper($_POST["studID"]);
$sql = "select * from Proj2Students where `StudentID` = '$studid'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);

if (!empty($row)) {
    $_SESSION["userID"] = $row[0];
}
else {
    $firstn = strtoupper($_POST["firstN"]);
    $lastn = strtoupper($_POST["lastN"]);
    $studid = strtoupper($_POST["studID"]);
    $major = $_POST["major"];
    $email = $_POST["email"];
    //Creates more room when writing into mySQL table for Students

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

    //inserts student into mySQL students table
    $sql = "insert into Proj2Students (`FirstName`,`LastName`,`StudentID`,`Email`,`Major`) values ('$firstn','$lastn','$studid','$email','$major')";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    // new user is created, set the id.
    $sql1 = "select * from Proj2Students where `StudentID` = '$studid'";
    $rs1 = $COMON->executeQuery($sql1, $_SERVER["SCRIPT_NAME"]);
    $row = mysql_fetch_row($rs1);
    
    $_SESSION["userID"] = $row[0];
    
}


header('Location: 02StudHome.php'); // takes user to 02StudHome.php
?>