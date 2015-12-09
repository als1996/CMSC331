<?php
session_start();
$debug = false;

if(isset($_POST["advisor"])){
    $_SESSION["advisor"] = $_POST["advisor"];
}

$localAdvisor = $_SESSION["advisor"];

include('../CommonMethods.php');
$COMMON = new Common($debug);

$userID = $_SESSION["userID"];
$sql = "select * from Proj2Students where `id` = '$userID'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$localMaj = $row[5];

$sql = "select * from Proj2Advisors where `id` = '$localAdvisor'";
$rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
$row = mysql_fetch_row($rs);
$advisorName = $row[1]." ".$row[2];
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Select Appointment</title>

    <!-- includes css file -->

    <link rel='stylesheet' type='text/css' href='css/standard.css'/>

  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
        <h1>Select Appointment Time</h1>
        <div class="field">

    <!-- this action posts the appointment time selected to 10StudConfirmSch.php -->

        <form action = "10StudConfirmSch.php" method = "post" name = "SelectTime">
        <?php

// http://php.net/manual/en/function.time.php fpr SQL statements below
// Comparing timestamps, could not remember.

            $curtime = time();
            //this reads in from the mySQL appointments table
            if ($_SESSION["advisor"] != "Group")  // for individual conferences only
            {
                $sql = "select * from Proj2Appointments where $temp `EnrolledNum` = 0
                    and (`Major` like '%$localMaj%' or `Major` = '') and `Time` > '".date('Y-m-d H:i:s')."' and `AdvisorID` = ".$_POST['advisor']."
                    order by `Time` ASC limit 30";
                $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                echo "<h2>Individual Advising</h2><br>";
                echo "<label for='prompt'>Select appointment with ",$advisorName,":</label><br>";
            }
            else // for group conferences
            {
                $temp = "";
                if($localAdvisor != "Group") { $temp = "`AdvisorID` = '$localAdvisor' and "; }

                $sql = "select * from Proj2Appointments where $temp `EnrolledNum` < `Max` and `Max` > 1 and (`Major` like '%$localMaj%' or `Major` = '')  and `Time` > '".date('Y-m-d H:i:s')."' order by `Time` ASC limit 30";
                $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                echo "<h2>Group Advising</h2><br>";
                echo "<label for='prompt'>Select appointment:</label><br>";
            }
            //while loop to output to the user every appointment offered by chosen advisor
            while($row = mysql_fetch_row($rs)){
                $datephp = strtotime($row[1]);
                echo "<label for='",$row[0],"'>";
                echo "<input id='",$row[0],"' type='radio' name='appTime' required value='", $row[1], "'>", date('l, F d, Y g:i A', $datephp) ,"</label><br>\n";
            }
        ?>
        </div>
    <!-- this button submits the radio button chosen to the 10StudConfirmSch.php -->
        <div class="nextButton">
            <input type="submit" name="next" class="button large go" value="Next">
        </div>
        </form>
        <div class="field">
            <!-- this action is to automatically choose the next available appointment with given advisor -->
            <form action = "10StudConfirmSch.php" method = "post" name = "NextAvailable">
        <?php
            $curtime = time();
            //reads in information from mySQL like before
            if ($_SESSION["advisor"] != "Group")  // for individual conferences only
            {
                $sql = "select * from Proj2Appointments where $temp `EnrolledNum` = 0
                    and (`Major` like '%$localMaj%' or `Major` = '') and `Time` > '".date('Y-m-d H:i:s')."' and `AdvisorID` = ".$_POST['advisor']."
                    order by `Time` ASC limit 30";
                $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
            }
            else // for group conferences
            {
                $temp = "";
                if($localAdvisor != "Group") { $temp = "`AdvisorID` = '$localAdvisor' and "; }

                $sql = "select * from Proj2Appointments where $temp `EnrolledNum` < `Max` and `Max` > 1 and (`Major` like '%$localMaj%' or `Major` = '')  and `Time` > '".date('Y-m-d H:i:s')."' order by `Time` ASC limit 30";
                $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
            }
            //Instead of while loop it automatically assigns value to the first entry
            $row = mysql_fetch_row($rs);
            $datephp = strtotime($row[1]);
            echo"<input type='radio' name='appTime' value='",$row[1],"' style='display:none;' checked />"
        ?>
        </div>
        <!-- submits the selected radio button to 10StudConfirmSch.php -->
        <div class="nextButton">
            <input type="submit" name="next" class="button large go" value="Next Available Appointment">
        </div>
        </form>
        <div>
        <!-- Option for student to cancel and return to home page -->
        <form method="link" action="02StudHome.php">
        <input type="submit" name="home" class="button large" value="Cancel">
        </form>
        </div>
        <div class="bottom">
        <p>Note: Appointments are maximum 30 minutes long.</p>
        <p style="color:red">If there are no more open appointments, contact your advisor or click <a href='02StudHome.php'>here</a> to start over.</p>
        </div>
<?php
            include 'StudAdminFooter.php';
?>
  </body>
</html>