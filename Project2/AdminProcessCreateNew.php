<?php
session_start();

$_SESSION["AdvF"] = $_POST["firstN"];
$_SESSION["AdvL"] = $_POST["lastN"];
$_SESSION["AdvUN"] = $_POST["UserN"];
$_SESSION["AdvPW"] = $_POST["PassW"];
$_SESSION["AdvLoc"] = $_POST["Loc"];
$_SESSION["PassCon"] = false;

if($_POST["PassW"] == $_POST["ConfP"]){ // if passwords match then continue to AdminCreateNew.php
    header('Location: AdminCreateNew.php');
}
elseif($_POST["PassW"] != $_POST["ConfP"]){//If passwords dont match return to AdminCreateNewAdv.php
    $_SESSION["PassCon"] = true;
    header('Location: AdminCreateNewAdv.php');
}

?>