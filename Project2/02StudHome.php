<?php
session_start();
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Student Advising Home</title>

    <!-- includes css file -->

    <link rel="stylesheet" type='text/css' href='css/standard.css'/>
  </head>
  <body>
    <div id="login">
      <div id="form">
        <div class="top">
        <h1>Hello
        <?php
            echo $_SESSION["firstN"];
        ?>
        </h1>
        <div class="selections">

        <!-- Home function -->
        <!-- this action will go to StudProcessHome.php and decide what form to go to next depending on users selection -->
        <form action="StudProcessHome.php" method="post" name="Home">
        <?php
            $debug = false;
            include('../CommonMethods.php');
            $COMMON = new Common($debug);

            $_SESSION["studExist"] = false;
            $adminCancel = false;
            $noApp = false;
            $studid = $_SESSION["studID"];

            $sql = "select * from Proj2Students where `StudentID` = '$studid'";
            $rs = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
            $row = mysql_fetch_row($rs);

            if (!empty($row)){
                $_SESSION["studExist"] = true;
                if($row[6] == 'C'){
                    $adminCancel = true;
                }
                if($row[6] == 'N'){
                    $noApp = true;
                }
            }

            //Checks to make sure current session student exists
            //If appointment was canceled by the advisor then the student will be notified
            if ($_SESSION["studExist"] == false || $adminCancel == true || $noApp == true){
                if($adminCancel == true){
                    echo "<p style='color:red'>The advisor has cancelled your appointment! Please schedule a new appointment.</p>";
                }
                echo "<button type='submit' name='selection' class='button large selection' value='Signup'>Signup for an appointment</button><br>";
            }
            //otherwise there will be buttons allowing the student view, reshedule, or cancel their appointment
            else{
                echo "<button type='submit' name='selection' class='button large selection' value='View'>View my appointment</button><br>";
                echo "<button type='submit' name='selection' class='button large selection' value='Reschedule'>Reschedule my appointment</button><br>";
                echo "<button type='submit' name='selection' class='button large selection' value='Cancel'>Cancel my appointment</button><br>";
            }
            //shows buttons allowing student to search for an appointment or edit their own info
            echo "<button type='submit' name='selection' class='button large selection' value='Search'>Search for appointment</button><br>";
            echo "<button type='submit' name='selection' class='button large selection' value='Edit'>Edit student information</button><br>";
        ?>
        </form>
        </div>
        <!-- logout button that allows the student to logout -->
        <form action="Logout.php" method="post" name="Logout">
        <div class="logoutButton">
            <input type="submit" name="logout" class="button large go" value="Logout">
        </div>
        </div>
        </form>
<?php
            include 'StudAdminFooter.php';
?>
  </body>
</html>