<?php
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Exit Message</title>
    <!-- includes css file -->
    <link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
        <div class="statusMessage">
        Someone JUST took that appointment before you. Please find another available appointment.
        </div>
        <!-- complete function returns user to home page -->
        <form action="02StudHome.php" method="post" name="complete">
        <div class="returnButton">
            <input type="submit" name="return" class="button large go" value="Return to Home">
        </div>
        </div>
        </form>
<?php
            include 'StudAdminFooter.php';
?>
  </body>
</html>