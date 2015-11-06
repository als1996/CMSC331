<?php
session_start();

if($_POST["selection"] == 'Signup'){ //continues to 03StudSelectType.php
    header('Location: 03StudSelectType.php');
}
elseif($_POST["selection"] == 'View'){ // continues to 04StudViewApp.php
    header('Location: 04StudViewApp.php');
}
elseif($_POST["selection"] == 'Reschedule'){ // continues to 03StudSelectType.php with resch
    $_SESSION["resch"] = true;
    header('Location: 03StudSelectType.php');
}
elseif($_POST["selection"] == 'Cancel'){ // continues to 05StudCancelApp.php
    header('Location: 05StudCancelApp.php');
}
elseif($_POST["selection"] == 'Search'){ // continues to 09StudSearchApp.php
    header('Location: 09StudSearchApp.php');
}
elseif($_POST["selection"] == 'Edit'){ // continues to 06StudEditInfo.php
    header('Location: 06StudEditInfo.php');
}

?>