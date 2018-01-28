<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $address = test_input($_POST["address"]);
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
    </head>
    <body>
<?php include "menu.php" ?>
        <h1>
            Confirmation
        </h1>
<?php 
    echo "<h2>ADDRESS :</h2><br>\n<p>$address\n</p>\n<br><br>\n";
    echo "<h2>Recipt :</h2><br>\n";
    if (isset($_SESSION["itemsLocations"]) and !empty($_SESSION["itemsLocations"]))
    {
        $list = array();
        $fullTotal = 0;
        $vals = array_count_values($_SESSION["itemsLocations"]);
        echo "\t<table class='confirmationTable'>\n";
        echo "\t\t<tr>\n";
        echo "\t\t\t<th>Name</th>\n";
        echo "\t\t\t<th>Price</th>\n";
        echo "\t\t\t<th>Count</th>\n";
        echo "\t\t\t<th>Total</th>\n";
        echo "\t\t</tr>\n";
        foreach ($vals as $item => $count)
        {
            $infoLocation = './' . $item . '/info.xml';
            $info = simplexml_load_file($infoLocation);
            $total = (int)$count * (float)$info->cost;
            $fullTotal += $total;
            echo "\t\t<tr>\n";
            
            echo "\t\t\t<td>$info->name</td>\n";
            echo "\t\t\t<td>$info->cost</td>\n";
            echo "\t\t\t<td>$count</td>\t\n";
            echo "\t\t\t<td>$total</td>\n";
            
            echo "\t\t</tr>\n";
        }
        echo "\t\t<tr>\n";
        echo "\t\t\t<td></td>\n";
        echo "\t\t\t<td></td>\n";
        echo "\t\t\t<td></td>\n";
        echo "\t\t\t<td>$fullTotal</td>\n";
        echo "\t\t<tr>\n";
        
        echo "\t</table>\n";
    }
    else
    {
        echo "You Bought Nothing";
    }
?>
        <br>
        <a href="index.php"><button>Continu Shopping</button></a>
    </body>
</html>
<?php
$_SESSION["itemsLocations"] = array();
?>