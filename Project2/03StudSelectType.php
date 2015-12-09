<?php
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Advising Type</title>
    <link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
        <h1>Schedule Appointment</h1>
        <h2>What kind of advising appointment would you like?</h2><br>

    <!-- this action allows the student to choose either group or individual appointment and returns the selection to StudProcessType.php -->
    <form action="StudProcessType.php" method="post" name="SelectType">
    <div class="nextButton">
        <input type="submit" name="type" class="button large go" value="Individual">
        <input type="submit" name="type" class="button large go" value="Group" style="float: right;">
        </div>
        </div>
        </form>


<br>
<br>
        <div>
        <form method="link" action="02StudHome.php">

        <!-- in case the user wants to cancel they can go back to the Home page -->

        <input type="submit" name="home" class="button large" value="Cancel">
        </form>
        </div>
<?php
            include 'StudAdminFooter.php';
?>
  </body>
</html>