<?php
session_start();
$debug = false;
include('../CommonMethods.php');
$COMMON = new Common($debug);

$studID = $_SESSION["studID"];
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>View Appointment</title>

    <!-- this includes the css file -->

    <link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
        <h1>View Appointment</h1>
        <div class="field">
        <?php
            //this prints the current appointment the student is signed up for

            $sql = "select * from Proj2Appointments where `EnrolledID` like '%$studID%'";
            $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
            // if for some reason there really isn't a match, (something got messed up, tell them there really isn't one there)
            $num_rows = mysql_num_rows($rs);

            if($num_rows > 0)
            {
                $row = mysql_fetch_row($rs); // get legit data
                $advisorID = $row[2];
                $datephp = strtotime($row[1]);
		$room = $row[7]; 
                if($advisorID != 0){
                    $sql2 = "select * from Proj2Advisors where `id` = '$advisorID'";
                    $rs2 = $COMMON->executeQuery($sql2, $_SERVER["SCRIPT_NAME"]);
                    $row2 = mysql_fetch_row($rs2);
                    $advisorName = $row2[1] . " " . $row2[2];
                    $location = $row2[5];
                }
                else{$advisorName = "Group";}
		
                echo "<label for='info'>";
                echo "Advisor: ", $advisorName, "<br>";
                echo "Appointment: ", date('l, F d, Y g:i A', $datephp), "<br>";
		if($advisorID != 0){
                echo "Advisor's Room: ", $location, "<br>";
		}
                echo "Appointment Location: ", $room, "</label>"; 
            }
            else // something is up, and there DB table needs to be fixed
            {
                echo("No appointment was detected. It may have been cancelled. Please make another appointment.");
                $sql = "update `Proj2Students` set `Status` = 'N' where `StudentID` = '$studID'";
                $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
            }


        ?>
        </div>

    <!-- this function returns the user back to the homepage once they are done looking at their appointment -->

        <div class="finishButton">
            <button onclick="location.href = '02StudHome.php'" class="button large go" >Return to Home</button>
        </div>
        </div>
        </form>
<?php
            include 'StudAdminFooter.php';
?>
  </body>
</html>