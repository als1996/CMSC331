<?php
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Exit Message</title>
    <!-- includes the css file -->
        <link rel="stylesheet" type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
        <div class="statusMessage">
        <?php
            //outputs a message to the user apprpriate to the action that took place
            $_SESSION["resch"] = false;
            if($_SESSION["status"] == "complete"){
                echo "You have completed your sign-up for an advising appointment.";
            }
            elseif($_SESSION["status"] == "none"){
                echo "You did not sign up for an advising appointment.";
            }
            if($_SESSION["status"] == "cancel"){
                echo "You have cancelled your advising appointment.";
            }
            if($_SESSION["status"] == "resch"){
                echo "You have changed your advising appointment.";
            }
            if($_SESSION["status"] == "keep"){
                echo "No changes have been made to your advising appointment.";
            }
        ?>
        </div>

        <!-- complete function that returns user to Home page -->
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