<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Schedule Individual Appointment</title>
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
            <h1>Schedule Individual Appointments</h1>
    <!-- confirm function posts the details of the individual appointment to AdminConfirmScheInd.php -->
        <form action="AdminConfirmScheIndApp.php" method="post" name="Confirm">
        <div class="field">
          <label for="Date">Date</label>

        <!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
        <!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

        <!-- I had to change this for every semester!!!  Lupoli, 8/18/15 -->

        <!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->
        <!-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% -->

          <input id="Date" type="date" name="Date" placeholder="mm/dd/yyyy" min="2015-08-01" max="2015-12-30" required autofocus> (mm/dd/yyyy)
        </div>

        <div class="field">
          <label for="Time">Times</label><!-- checkboxes for time -->
        <input type="checkbox" name="time[]" value="08:00:00"> 8:00AM - 8:30AM <br>
        <input type="checkbox" name="time[]" value="08:30:00"> 8:30AM - 9:00AM <br>
        <input type="checkbox" name="time[]" value="09:00:00"> 9:00AM - 9:30AM <br>
        <input type="checkbox" name="time[]" value="09:30:00"> 9:30AM - 10:00AM <br>
        <input type="checkbox" name="time[]" value="10:00:00"> 10:00AM - 10:30AM <br>
        <input type="checkbox" name="time[]" value="10:30:00"> 10:30AM - 11:00AM <br>
        <input type="checkbox" name="time[]" value="11:00:00"> 11:00AM - 11:30AM <br>
        <input type="checkbox" name="time[]" value="11:30:00"> 11:30AM - 12:00PM <br>
        <input type="checkbox" name="time[]" value="12:00:00"> 12:00PM - 12:30PM <br>
        <input type="checkbox" name="time[]" value="12:30:00"> 12:30PM - 1:00PM <br>
        <input type="checkbox" name="time[]" value="13:00:00"> 1:00PM - 1:30PM <br>
        <input type="checkbox" name="time[]" value="13:30:00"> 1:30PM - 2:00PM <br>
        <input type="checkbox" name="time[]" value="14:00:00"> 2:00PM - 2:30PM <br>
        <input type="checkbox" name="time[]" value="14:30:00"> 2:30PM - 3:00PM <br>
        <input type="checkbox" name="time[]" value="15:00:00"> 3:00PM - 3:30PM <br>
        <input type="checkbox" name="time[]" value="15:30:00"> 3:30PM - 4:00PM <br>

        </div>

      <div class="field">
        <label for="Majors">Majors</label><!-- check boxes for major -->
          <input type="checkbox" name="major[]" value="CMPE" checked>Computer Engineering
          <input type="checkbox" name="major[]" value="CMSC" checked>Computer Science
          <input type="checkbox" name="major[]" value="MENG" checked>Mechanical Engineering
          <input type="checkbox" name="major[]" value="CENG" checked>Chemical Engineering
      </div>

        <div class="field">
            <label for="Location">Location of meeting</label> <!-- check boxes for repeat weekdays -->
            <input type="radio" name="location[]" value="My Office">My Office
            <input type="radio" name="location[]" value="Other">Other:<input type="text" name="Location">
    </div>


        <div class="field">
            <label for="Repeat">Repeat Weekly</label> <!-- check boxes for repeat weekdays -->
            <input type="checkbox" name="repeat[]" value="Monday">Monday
            <input type="checkbox" name="repeat[]" value="Tuesday">Tuesday
            <input type="checkbox" name="repeat[]" value="Wednesday">Wednesday
            <input type="checkbox" name="repeat[]" value="Thursday">Thursday
            <input type="checkbox" name="repeat[]" value="Friday">Friday
        </div>

        <div class="field"> <!-- sets number of repeat weeks -->
            <h3>Repeat for
            <input type="number" id="stepper" name="stepper" min="0" max="4" value="0" />
              more week(s)</h3>
        </div>
        <div class="nextButton">
            <input type="submit" name="next" class="button large go" value="Create">
    </div>
    </div>
    </form>
    <!-- home function to return user to home page -->
    <form method="link" action="AdminUI.php" name="home">
        <input type="submit" name="next" class="button large go" value="Return to Home">
    </form>
    <?php include('./workOrder/workButton.php'); ?>

  </body>

</html>
