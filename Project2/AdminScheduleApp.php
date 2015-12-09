<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Schedule Appointment</title>
    <!-- includes css file -->
    <link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
    <h1>Schedule Appointments</h1>
    <h2>Select advising type</h2><br>

    <!-- posts either group or individual to AdminProcessSchedule.php depending on user choice -->
    <form method="post" action="AdminProcessSchedule.php">
    <div class="nextButton">
        <input type="submit" name="next" class="button large go" value="Individual"> <!-- user choose individual -->
        <input type="submit" name="next" class="button large go" value="Group" style="float: right;"> <!-- user choose group -->
    </div>
    </form>
        </div>
    </div>
        </form>
    <!-- user has option to return to home page -->
        <form method="link" action="AdminUI.php">
        <input type="submit" name="home" class="button large" value="Cancel">
        </form>
    </div>
<?php
            include 'StudAdminFooter.php';
?>
    </div>


  </body>

</html>
