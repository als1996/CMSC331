<?php
session_start();

if ($_POST["next"] == "Group"){//if group appointment then continues to AdminScheduleGroup.php
	$_SESSION["advisor"] = $_POST["next"];
	header('Location: AdminScheduleGroup.php');
}
elseif ($_POST["next"] == "Individual"){//if individual appointment then continues to AdminScheduleInd.php
	header('Location: AdminScheduleInd.php');
}

?>