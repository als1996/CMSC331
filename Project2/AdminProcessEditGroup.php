<?php
session_start();

$_SESSION["GroupApp"] = $_POST["GroupApp"];
$_SESSION["Delete"] = false;

if ($_POST["next"] == "Delete Appointment"){ //deletes the appointment selected and continues to AdminConfirmEditGroup.php
    $_SESSION["Delete"] = true;
    $_SESSION["advisor"] = $_POST["next"];
    header('Location: AdminConfirmEditGroup.php');
}
elseif ($_POST["next"] == "Edit Appointment"){ // edits the appointment selected and continues to AdminProceedEditGroup.php
    header('Location: AdminProceedEditGroup.php');
}

?>