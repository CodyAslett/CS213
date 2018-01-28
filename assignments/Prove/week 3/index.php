<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $_SESSION["name"] = test_input($_POST["name"]);
      $email = test_input($_POST["email"]);
      $website = test_input($_POST["website"]);
      $comment = test_input($_POST["comment"]);
      $gender = test_input($_POST["gender"]);
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"></META>
        <link rel="stylesheet" type="text/css" href="style.css">
         <script type="text/javascript">
            function alerting(){
                alert("dfdgfg");
            }
        </script>
    </head>
    <body>
<?php include "menu.php" ?>
                <h1 class="Title">Neo-Old Foods</h1>
        <?php include 'browse.php';?>
        <?php echo $_SESSION["name"] ?>
        <hr>
        <a href="cart.php" style="text-decoration: none; width:100%;"><button id="cartBtn" style="width:100%;">BUY</button></a>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <hr>
        <br><br><br><br>
    </body>
</html>