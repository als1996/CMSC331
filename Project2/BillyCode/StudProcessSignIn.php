<?php
session_start();
include('../CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

$_SESSION["firstN"] = strtoupper($_POST["firstN"]);
$_SESSION["lastN"] = strtoupper($_POST["lastN"]);
$_SESSION["studID"] = strtoupper($_POST["studID"]);
$_SESSION["email"] = $_POST["email"];
$_SESSION["major"] = $_POST["major"];


// ************************ davies4 10-20-2015
// check to see if the information is valid and
// the user exists in the db. If they don't, it will
// keep redirecting to the student login page until they
// enter valid credentials.
$firstn = $_SESSION["firstN"];
$lastn = $_SESSION["lastN"];
$studid = $_SESSION["studID"];
$email = $_SESSION["email"];
$major = $_SESSION["major"];

// if the user is valid, then go redirect to the home page
if (isValid($firstn, $lastn, $studid, $email, $major)) {
    header('Location: 02StudHome.php'); 
}
// if the user isn't in the db, they have to enter
// valid credentials
else {
    header('Location: 01StudSignIn.html');   
}
// basic function to see if the user's parameters exist in the 
// student db. If they do, this will return true, otherwise it will return false.
function isValid($firstn, $lastn, $studid, $email, $major) {
    global $debug; global $COMMON;
    $sql = "select * from Proj2Students where `FirstName` = '$firstn' and `LastName` = '$lastn' and `StudentID` = '$studid' and `Email` = '$email' and `Major` = '$major'";
    $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
    $row = mysql_fetch_row($rs);

    if(!empty($row)) {
        // student exists in the db.
        return true;
    }
    else {
        // student doesn't exist in the db.
        // redirect to login.
        return false;
    }
    
}

//header('Location: 02StudHome.php');
?>