<?php
session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Advisor</title>

    <!-- includes the css file -->

    <link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
        <h1>Individual Advising</h1>
        <h2>Select Advisor</h2>
        <div class="field">

        <!-- SelectAdvisor function that posts the advisor selected to 08StudSelectTime.php -->

        <form action="08StudSelectTime.php" method="post" name="SelectAdvisor">
        <?php
            $sql = "select * from Proj2Advisors";
            //reads from mySQL
            $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
            while($row = mysql_fetch_row($rs)){
                echo "<label for='",$row[0],"'><input id='",$row[0],"' type='radio' name='advisor' required value='", $row[0],"'>", $row[1]," ", $row[2],"</label><br>";
            }
        ?>
        </div>
    <!-- on button click submits the data to 08StudSelectTime.php -->
        <div class="nextButton">
            <input type="submit" name="next" class="button large go" value="Next">
        </div>
        </div>
        </form>
        <div>
        <!-- cancel button option that returns user to Home -->
        <form method="link" action="02StudHome.php">
        <input type="submit" name="home" class="button large" value="Cancel">
        </form>
        </div>
<?php
            include 'StudAdminFooter.php';
?>
  </body>
</html>