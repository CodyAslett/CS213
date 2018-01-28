<!------------------------------------------------------------------
 * CART
 *   
---------------------------------------------------------------------->
<?php
    session_start();
    $toRemoveItem = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = test_input($_POST["name"]);
    }
    else
    {
        echo "METHOD : \n";
    }

    function test_input($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    foreach($_SESSION["itemsLocations"] as $key =>$item)
    {
        if($item == $name)
        {
            unset($_SESSION["itemsLocations"][$key]);
        }
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
            Cart
        </h1>
        <p>
<?php 
    if (isset($_SESSION["itemsLocations"]) and !empty($_SESSION["itemsLocations"]))
    {
        $list = array();
        $fullTotal = 0;
        $vals = array_count_values($_SESSION["itemsLocations"]);
        echo "\t<table class='cartTable'>\n";
        echo "\t\t<tr>\n";
        echo "\t\t\t<th></th>\n";
        echo "\t\t\t<th>Image</th>\n";
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
            echo "\t\t\t<td>\n";
?>
<!-- FORM -->
<form action="cart.php" method="post">
<input type="hidden" name="name" value=<?php echo $item;?>>
    <input type="submit" value="Remove">
</form>
<!-- form -->
            
            
<?php
            echo "\t\t\t<td>$info->name</td>\n";
            echo "\t\t\t<td><img src='$item/simple.jpg' class='cartImg'></td>\n";
            echo "\t\t\t<td>$info->cost</td>\n";
            echo "\t\t\t<td>$count</td>\t\n";
            echo "\t\t\t<td>$total</td>\n";
            
            echo "\t\t</tr>\n";
        }
        echo "\t\t<tr>\n";
        echo "\t\t\t<td></td>\n";
        echo "\t\t\t<td></td>\n";
        echo "\t\t\t<td></td>\n";
        echo "\t\t\t<td></td>\n";
        echo "\t\t\t<td></td>\n";
        echo "\t\t\t<td class='cartFullTotal'>$fullTotal</td>\n";
        echo "\t\t<tr>\n";
        
        echo "\t</table>\n";
    }
    else
    {
        echo "EMPTY";
    }
    ?>
        </p>
        <a href="checkout.php"><button>Checkout</button></a>
    </body>
</html>
<!------------------------------------------------------------------
 * CART
 *   END
---------------------------------------------------------------------->