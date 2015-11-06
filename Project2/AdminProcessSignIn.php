<?php

/* Had to make sure sessions was enabled. Some help here:

https://wiki.umbc.edu/pages/viewpage.action?pageId=46563550

cd /afs/umbc.edu/public/web/sites/coeadvising/prod/php/session/

/usr/bin/fs sa /afs/umbc.edu/public/web/sites/coeadvising/prod/php/session/ web.coeadvising all


then edit .htaccess file here in the same directory

*/


session_start();

include('../CommonMethods.php');
$debug = false;
$Common = new Common($debug);

$_SESSION["UserN"] = strtoupper($_POST["UserN"]);
$_SESSION["PassW"] = strtoupper($_POST["PassW"]);
$_SESSION["UserVal"] = false;

$user = $_SESSION["UserN"];
$pass = $_SESSION["PassW"];

//reads in from Advisors table on mySQL

$sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '$user' AND `Password` = '$pass'";
$rs = $Common->executeQuery($sql, "Advising Appointments");
$row = mysql_fetch_row($rs);

if($row){ // checks if admin is registered admin
    if($debug) { echo("<br>".var_dump($_SESSION)."<- Session variables above<br>"); }
    else { header('Location: AdminUI.php'); }
}
else{ // if not then returns to sign in page
    $_SESSION["UserVal"] = true;
    header('Location: AdminSignIn.php');
}

?>