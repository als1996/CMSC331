<?php
session_start();
if ($_POST["type"] == "Group"){
	$_SESSION["advisor"] = $_POST["type"];
	header('Location: 08StudSelectTime.php');
}
elseif ($_POST["type"] == "Individual"){
	header('Location: 07StudSelectAdvisor.php');
}
// ************ davies4 10-20-2015
// Edited this file to display the next available appointment for
// individual appointment and group appointment.
elseif ($_POST["type"] == "Next Group") {
    header('Location: 14StudSelectNextTime.php');
}
elseif ($_POST["type"] == "Next Individual") {
    header('Location: 14StudSelectNextTime.php');   
}
?>