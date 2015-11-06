<?php
session_start();

if($_POST["next"] == 'Schedule appointments'){ // continues to AdminScheduleApp.php
    header('Location: AdminScheduleApp.php');
}
elseif($_POST["next"] == 'Print schedule for a day'){ // continues to AdminPrintSchedule.php
    header('Location: AdminPrintSchedule.php');
}
elseif($_POST["next"] == 'Edit appointments'){ // continues to AdminEditApp.php
    header('Location: AdminEditApp.php');
}
elseif($_POST["next"] == 'Search for an appointment'){ // continues to AdminSearchApp.php
    header('Location: AdminSearchApp.php');
}
elseif($_POST["next"] == 'Create new Admin Account'){ // continues to AdminCreateNewAdv.php
    header('Location: AdminCreateNewAdv.php');
}

?>