<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Edit Appointment</title>
	<!-- includes css file -->
	<link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
	<h1>Edit Appointments</h1>
	<h2>Select advising type</h2><br>

	<!-- posts change in information to AdminProcessEdit.php -->
	<form method="post" action="AdminProcessEdit.php">
	<!-- next button makes method occur -->
	<div class="nextButton">
		<!-- choice between Individual or Group -->
		<input type="submit" name="next" class="button large go" value="Individual">
		<input type="submit" name="next" class="button large go" value="Group">
	</div>
	</form>
        </div>
        <div class="field">
	<br>
	<br>
	<!-- cancel button takes user back to home page -->
	<form method="link" action="AdminUI.php">
	<input type="submit" name="next" class="button large go" value="Return to Home">
	</form>
         
        </div>
	</div>
		
  </body>
  
</html>
