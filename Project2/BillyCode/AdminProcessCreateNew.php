<?php
session_start();

$_SESSION["AdvF"] = $_POST["firstN"];
$_SESSION["AdvL"] = $_POST["lastN"];
$_SESSION["AdvUN"] = $_POST["UserN"];
$_SESSION["AdvPW"] = $_POST["PassW"];
// *********** davies4 10-22-2015 added the office location parameter
// to be filled out.
$_SESSION["AdvOF"] = $_POST["AdvOF"];
$_SESSION["PassCon"] = false;

if($_POST["PassW"] == $_POST["ConfP"]){
	header('Location: AdminCreateNew.php');
}
elseif($_POST["PassW"] != $_POST["ConfP"]){
	$_SESSION["PassCon"] = true;
	header('Location: AdminCreateNewAdv.php');
}

?>