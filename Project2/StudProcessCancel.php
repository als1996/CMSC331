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

if($_POST["cancel"] == 'Cancel'){

    //remove stud from EnrolledID
    $sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $row = mysql_fetch_row($rs);
    $oldAdvisorID = $row[2];
    $oldAppTime = $row[1];
    $newIDs = str_replace($studid, "", $row[4]);
    //call mySQL to update Appointments
    $sql = "update `Proj2Appointments` set `EnrolledNum` = EnrolledNum-1, `EnrolledID` = '' where `AdvisorID` = '$oldAdvisorID' and `Time` = '$oldAppTime'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    //update stud status to noApp
    $sql = "update `Proj2Students` set `Status` = 'N' where `StudentID` = '$studid'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

    $_SESSION["status"] = "cancel";
}
else{
    $_SESSION["status"] = "keep";
}
header('Location: 12StudExit.php');
?>