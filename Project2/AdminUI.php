<?php
session_start();
$debug = false;

if($debug) { echo("Session variables-> ".var_dump($_SESSION)); }

include('../CommonMethods.php');
$COMMON = new Common($debug);
$_SESSION["PassCon"] = false;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Admin Home</title>
	<!-- includes css file -->
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
	<h2> Hello
	<?php

	if(!isset($_SESSION["UserN"])) // someone landed this page by accident
	{
		return;
	}

		$User = $_SESSION["UserN"];
		$Pass = $_SESSION["PassW"];
		$sql = "SELECT `firstName` FROM `Proj2Advisors`
			WHERE `Username` = '$User'
			and `Password` = '$Pass'";
		//calls mySQL to get information about current Advisor
		$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$row = mysql_fetch_row($rs);
		echo $row[0];
	?>
	</h2>

	<!-- UI function posts which selection the user made -->
	<form action="AdminProcessUI.php" method="post" name="UI">

		<input type="submit" name="next" class="button large selection" value="Schedule appointments"><br>
		<input type="submit" name="next" class="button large selection" value="Print schedule for a day"><br>
		<input type="submit" name="next" class="button large selection" value="Edit appointments"><br>
		<input type="submit" name="next" class="button large selection" value="Search for an appointment"><br>
		<input type="submit" name="next" class="button large selection" value="Create new Admin Account"><br>

	</form>
	<br>

	<!-- additional button which continues to logout.php -->
	<form method="link" action="Logout.php">
		<input type="submit" name="next" class="button large go" value="Log Out">
	</form>

        </div>
        <div class="field">

        </div>
	</div>

<?php
            include 'StudAdminFooter.php';
?>
	<?php include('./workOrder/workButton.php'); ?>

</body>

</html>
