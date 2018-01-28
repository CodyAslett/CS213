

<!------------------------------------------------------------------------------------
        BROWSE
                START
----------------------------------------------------------------------------------------->


<script type="text/javascript">
    // https://www.w3schools.com/xml/ajax_intro.asp
    function addToCart(location) 
    {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cartBtn").innerHTML = "Cart " + this.responseText;
                document.getElementById("cartBtn").value = this.responseText;
            }
        };
        var getLocation = "addToCart.php";
        xhttp.open("POST", getLocation, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("test=" + location);
    }
    function readXML(xml) {
        var xmlDoc = xml.responseXML;
        
        document.getElementById("cartBtn").value = this.responseText;
    }
</script>

<?php
    $products = __DIR__ . '\products';
    echo "Products $products";
    $one = simplexml_load_file($products . '/attributes.xml');
    $tags = $one->tag;
    $dir = scandir($products);
    foreach ($tags as $tag)
    {
        echo "<div class=\"tagGroup\" id=$tag>\n";
        echo "<br>\n<hr>\n<br>\n<h1>";
        echo ucwords($tag);
        echo "</h1>";
        for ($x = 2; $x < sizeof($dir); $x++) 
        {
            $productDir   = 'products/' . $dir[$x];
            $imgLocation  = $productDir . "/simple.jpg";
            $infoLocation = $productDir . "/info.xml";
            
            if(file_exists($infoLocation)) 
            {
                $info = simplexml_load_file($infoLocation);
                if (strcasecmp($info->tag, $tag) == 0) 
                {
                    echo "<div class = \"product\" id = \"$dir[$x]\">\n";
                        echo "<h5>$info->name</h5>\n";
                        echo "\t<div class=\"productPic\" id=\"$dir[$x]\"";
                        echo "style=\"background-image: url($imgLocation)\"></div>\n";
                        echo "\t<div class=\"price\">\$$info->cost</div>\n";
                        echo "\t<div class=\"discription\">\n\t\t<p>\n\t\t\t$info->discription\n\t\t</p>\n\t</div>\n";
                        echo "<button onclick=\"addToCart('";
                        echo $productDir;
                        echo "')\" class=\"buyButton\">Buy</button>\n";
                    echo "</div>\n";
                }
            }
        }
    }
?>
<!------------------------------------------------------------------------------------
        BROWSE
                END
----------------------------------------------------------------------------------------->


