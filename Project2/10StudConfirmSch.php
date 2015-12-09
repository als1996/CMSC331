<?php
session_start();
$_SESSION["appTime"] = $_POST["appTime"]; // radio button selection from previous form
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Confirm Appointment</title>

    <!-- includes the css file -->
    <link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
        <h1>Confirm Appointment</h1>
        <div class="field">

        <!-- SelectTime function that  shows the user the selected appointment and asks them to confirm their selection -->
        <form action = "StudProcessSch.php" method = "post" name = "SelectTime">
        <?php
            $debug = false;
            include('../CommonMethods.php');
            $COMMON = new Common($debug);
            

            $userID = $_SESSION["userID"];
            $sql = "select * from Proj2Students where `id` = '$userID'";
            $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
            $row = mysql_fetch_row($rs);

            $firstn = $row[1];
            $lastn = $row[2];
            $studid = $row[3];
            $major = $row[5];
            $email = $row[4];

            if($_SESSION["resch"] == true){ //if the student is rescheduling an existing appointment
                //reads in from mySQL Appointments table
                $sql = "select * from Proj2Appointments where `EnrolledID` like '%$studid%'";
                $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
                $row = mysql_fetch_row($rs);
                $oldAdvisorID = $row[2];
                $oldDatephp = strtotime($row[1]);

                if($oldAdvisorID != 0){ //only for individual
                    //reads in from mySQL Advisors table
                    $sql2 = "select * from Proj2Advisors where `id` = '$oldAdvisorID'";
                    $rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
                    $row2 = mysql_fetch_row($rs2);
                    $oldAdvisorName = $row2[1] . " " . $row2[2];
                }
                else{$oldAdvisorName = "Group";}//only for group

                //prints the previously selected appointment to the user
                echo "<h2>Previous Appointment</h2>";
                echo "<label for='info'>";
                echo "Advisor: ", $oldAdvisorName, "<br>";
                echo "Appointment: ", date('l, F d, Y g:i A', $oldDatephp), "</label><br>";
            }

            $currentAdvisorName;
            $currentAdvisorID = $_SESSION["advisor"];
            $currentDatephp = strtotime($_SESSION["appTime"]);
            if($currentAdvisorID != 0){ // only for individual
                $sql2 = "select * from Proj2Advisors where `id` = '$currentAdvisorID'";
                $rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
                $row2 = mysql_fetch_row($rs2);
                $currentAdvisorName = $row2[1] . " " . $row2[2];
            }
            else{$currentAdvisorName = "Group";} // only for group

            //prints out currently selected appointment

            echo "<h2>Current Appointment</h2>";
            echo "<label for='newinfo'>";
            echo "Advisor: ",$currentAdvisorName,"<br>";
            echo "Appointment: ",date('l, F d, Y g:i A', $currentDatephp),"</label>";
        ?>
        </div>
        <!-- Confirm button that continues on to StudProcessSch.php -->
        <div class="nextButton">
        <?php
            if($_SESSION["resch"] == true){ // if reshedule then the button says reschedule rather than submit
                echo "<input type='submit' name='finish' class='button large go' value='Reschedule'>";
            }
            else{
                echo "<input type='submit' name='finish' class='button large go' value='Submit'>";
            }
        ?>
            <!-- option for user to cancel the appointment -->
            <input style="margin-left: 50px" type="submit" name="finish" class="button large" value="Cancel">
        </div>
        </form>
        </div>
<?php
            include 'StudAdminFooter.php';
?>
  </body>
</html>