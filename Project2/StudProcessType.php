<?php
session_start();
if ($_POST["type"] == "Group"){ //group appointment goes to 08StudSelectTime.php
	$_SESSION["advisor"] = $_POST["type"];
	header('Location: 08StudSelectTime.php');
}
elseif ($_POST["type"] == "Individual"){ // individual appointment goes to 07StudSelectAdvisor.php
	header('Location: 07StudSelectAdvisor.php');
}
?>