<?php
session_start();

if ($_POST["next"] == "Group"){ // if group appointment then go to AdminEditGroup.php
    $_SESSION["advisor"] = $_POST["next"];
    header('Location: AdminEditGroup.php');
}
elseif ($_POST["next"] == "Individual"){ // if individual appointment then go to AdminEditInd.php
    header('Location: AdminEditInd.php');
}

?>