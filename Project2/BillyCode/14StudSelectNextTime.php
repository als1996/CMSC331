<?php
session_start();
$debug = false;

$localMaj = $_SESSION["major"];

include('../CommonMethods.php');
$COMMON = new Common($debug);

?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Appointment</title>
	<link rel='stylesheet' type='text/css' href='../css/standard.css'/>

  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
		<h1>Select Appointment Time</h1>
	    <div class="field">
		<form action = "10StudConfirmSch.php" method = "post" name = "SelectTime">
	    <?php

// http://php.net/manual/en/function.time.php fpr SQL statements below
// Comparing timestamps, could not remember. 

			$curtime = time();
			if ($_SESSION["type"] != "Next Group")  // for individual conferences only
			{ 
                // get the first result that's greater than the time on the db.
                $sql = "select * from Proj2Appointments where `EnrolledNum` = 0 and `Time` > '".date('Y-m-d H:i:s')."'
                        and (`Major` like '%$localMaj%' or `Major` = '') order by `Time` ASC limit 30";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                $row = mysql_fetch_row($rs);
                // extract the advisor id from the desired appointment time.
                $advisorID = $row[2];
                // get the advisors information based on the id given from the previous query.
                $sql = "select * from Proj2Advisors where `id` = '$advisorID'";
                $rs1 = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                $row1 = mysql_fetch_row($rs1);
                // set advisor name
                $advisorName = $row1[1]." ".$row1[2];
				echo "<h2>Individual Advising</h2><br>";
				echo "<label for='prompt'>Select appointment with ",$advisorName,":</label><br>";
                $datephp = strtotime($row[1]);
				echo "<label for='",$row[0],"'>";
				echo "<input id='",$row[0],"' type='radio' name='appTime' required value='", $row[1], "'>", date('l, F d, Y g:i A', $datephp) ,"</label><br>\n";
			}
			else // for group conferences
			{
                // get the first result that's greater than the current time and isn't filled on the db.
                $sql = "select * from Proj2Appointments where `Time` > '".date('Y-m-d H:i:s')."' and (`Major` like '%$localMaj%' or `Major` = '')
                        and `EnrolledNum` < `Max` and `Max` > 1
                        order by `Time` ASC limit 30";
				$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                $row = mysql_fetch_row($rs);
                // Get the advisors name who is in charge of the group appointment.
                $advisorID = $row[2];
                $sql = "select * from Proj2Advisors where `id` = '$advisorID'";
                $rs1 = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                $row1 = mysql_fetch_row($rs1);
                // Get the advisors name for display.
                $advisorName = $row1[1]." ".$row1[2];
				echo "<h2>Group Advising</h2><br>";
				echo "<label for='prompt'>Select appointment:</label><br>";
                $datephp = strtotime($row[1]);
				echo "<label for='",$row[0],"'>";
				echo "<input id='",$row[0],"' type='radio' name='appTime' required value='", $row[1], "'>", date('l, F d, Y g:i A', $datephp) ,"</label><br>\n";
			}

		?>
        </div>
	    <div class="nextButton">
			<input type="submit" name="next" class="button large go" value="Next">
	    </div>
		</form>
		<div>
		<form method="link" action="02StudHome.php">
		<input type="submit" name="home" class="button large" value="Cancel">
		</form>
		</div>
		<div class="bottom">
		<p>Note: Appointments are maximum 30 minutes long.</p>
		<p style="color:red">If there are no more open appointments, contact your advisor or click <a href='02StudHome.php'>here</a> to start over.</p>
		</div>
  </body>
</html>