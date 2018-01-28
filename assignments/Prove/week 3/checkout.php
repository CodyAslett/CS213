<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"></META>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
<?php include "menu.php" ?>
        <h1>
            Check Out
        </h1>
        <?php echo $_SESSION["name"] ?>
        <br>
        <form action="confirmation.php" id="checkoutAddress" method="post">
            Address :<br> <textarea name="address" form="checkoutAddress" placeholder="Address" rows=8 cols="35"> </textarea>
            <br>
            <input type="submit">
        </form>
    </body>
</html>