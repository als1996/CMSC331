<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Create New Admin</title>
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
        <h1>New Advisor has been created:</h1>

        <?php
            $first = $_SESSION["AdvF"];
            $last = $_SESSION["AdvL"];
            $user = $_SESSION["AdvUN"];
            $pass = $_SESSION["AdvPW"];
            $location = $_SESSION["AdvLoc"];

            include('../CommonMethods.php');
            $debug = false;
            $Common = new Common($debug);

      $sql = "SELECT * FROM `Proj2Advisors` WHERE `Username` = '$user' AND `FirstName` = '$first' AND  `LastName` = '$last'";
    // reads in from mySQL advisors table
      $rs = $Common->executeQuery($sql, "Advising Appointments");
      $row = mysql_fetch_row($rs);
      if($row){//outputs to user that the advisor already exists
        echo("<h3>Advisor $first $last already exists</h3>");
      }
      else{//inputs the new advisor in mySQL advisor table
            $sql = "INSERT INTO `Proj2Advisors`(`FirstName`, `LastName`, `Username`, `Password`, `Location`)
            VALUES ('$first', '$last', '$user', '$pass', '$location')";
        echo ("<h3>$first $last<h3>");
        $rs = $Common->executeQuery($sql, "Advising Appointments");
      }
        ?>
        <!--returns user to home page -->
        <form method="link" action="AdminUI.php">
            <input type="submit" name="next" class="button large go" value="Return to Home">
        </form>
    </div>
    </div>
    </div>
    </form>
<?php
            include 'StudAdminFooter.php';
?>
  </body>

</html>
