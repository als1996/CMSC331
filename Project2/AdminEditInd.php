<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Edit Individual Appointment</title>
    <script type="text/javascript">
    function saveValue(target){
    var stepVal = document.getElementById(target).value;
    alert("Value: " + stepVal);
    }
    </script>
    <!-- includes css file -->
    <link rel='stylesheet' type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
          <h1>Select which appointment you would like to change: </h1>
          <div class="field">

          <?php
            $debug = false;
            include('../CommonMethods.php');
            $COMMON = new Common($debug);

    //reads in all individual appointments from the Appointments table in mySQL
            $sql = "SELECT * FROM `Proj2Appointments` WHERE `AdvisorID` != '0' and `Time` > '".date('Y-m-d H:i:s')."' ORDER BY `Time`";
            $rs = $COMMON->executeQuery($sql, "Advising Appointments");
            $row = mysql_fetch_array($rs, MYSQL_NUM);
            //first item in row
            if($row){
    //Confirm function posts the Edits to the selected appointment to AdminConfirmEditInd.php
              echo("<form action=\"AdminConfirmEditInd.php\" method=\"post\" name=\"Confirm\">");


    echo("<table border='1px'>\n<tr>");
    echo("<tr><td width='320px'>Time</td><td>Majors</td><td>Enrolled</td></tr>\n");

              $secsql = "SELECT `FirstName`, `LastName` FROM `Proj2Advisors` WHERE `id` = '$row[2]'";
              $secrs = $COMMON->executeQuery($secsql, "Advising Appointments");
              $secrow = mysql_fetch_row($secrs);

              if($row[4]){//continues as long as there exists a student signed up in that appointment
                $trdsql = "SELECT `FirstName`, `LastName` FROM `Proj2Students` WHERE `StudentID` = '$row[4]'";
                $trdrs = $COMMON->executeQuery($trdsql, "Advising Appointments");
                $trdrow = mysql_fetch_row($trdrs);
              }

              echo("<tr><td><label for='$row[0]'><input type=\"radio\" id='$row[0]' name=\"IndApp\"
                required value=\"row[]=$row[1]&row[]=$secrow[0]&row[]=$secrow[1]&row[]=$row[3]&row[]=$row[4]\">");
              echo(date('l, F d, Y g:i A', strtotime($row[1])). "</label></td>");
              if($row[3]){ //will output what majors the appointment allows
                echo("<td>$row[3]</td>");
              }
              else{//if all majors are allowed
                echo("Available to all majors");
              }

              if($row[4]){
                echo("<td>$trdrow[0] $trdrow[1]</td>");
              }
              else{
                echo("<td>Empty</td>");
              }
              echo("</tr>\n");


              //rest of items in row
              while ($row = mysql_fetch_array($rs, MYSQL_NUM)) {
                $secsql = "SELECT `FirstName`, `LastName` FROM `Proj2Advisors` WHERE `id` = '$row[2]'";
                $secrs = $COMMON->executeQuery($secsql, "Advising Appointments");
                $secrow = mysql_fetch_row($secrs);

                if($row[4]){//for every student signed up for an appointment
                  $trdsql = "SELECT `FirstName`, `LastName` FROM `Proj2Students` WHERE `StudentID` = '$row[4]'";
                  $trdrs = $COMMON->executeQuery($trdsql, "Advising Appointments");
                  $trdrow = mysql_fetch_row($trdrs);
                }

                echo("<tr><td><label for='$row[0]'><input type=\"radio\" id='$row[0]' name=\"IndApp\"
                  required value=\"row[]=$row[1]&row[]=$secrow[0]&row[]=$secrow[1]&row[]=$row[3]&row[]=$row[4]\">");
                echo(date('l, F d, Y g:i A', strtotime($row[1])). "</label></td>");
                if($row[3]){
                  echo("<td>$row[3]</td>"); //outputs the majors the appointment is available for
                }
                else{
                  echo("Available to all majors"); //only if available to all majors
                }



                if($row[4]){
                  echo("<td>$trdrow[0] $trdrow[1]</td>");
                }
                else{
                  echo("<td>Empty</td>");
                }
                echo("</tr>\n");



              }
              echo("</table>");

              echo("<div class=\"nextButton\">");
    //deletes apointment
              echo("<input type=\"submit\" name=\"next\" class=\"button large go\" value=\"Delete Appointment\">");
              echo("</div>");
              echo("</form>");
    //cancel button to take user back to home page
              echo("<form method=\"link\" action=\"AdminUI.php\">");
              echo("<input type=\"submit\" name=\"next\" class=\"button large\" value=\"Cancel\">");
              echo("</form>");
            }
            else{
              echo("<br><b>There are currently no individual appointments scheduled at the current moment.</b>");
              echo("<br><br>");
              echo("</td</tr>");
              echo("<form method=\"link\" action=\"AdminUI.php\">");
              echo("<input type=\"submit\" name=\"next\" class=\"button large go\" value=\"Return to Home\">");
              echo("</form>");
            }
          ?>

    </div>
    </div>
    <div class="bottom">
        <p style='color:red'>Please note that individual appointments can only be removed from schedule.</p>
    </div>
    </div>
    <?php include('./workOrder/workButton.php'); ?>

    </div>
  </body>

</html>
