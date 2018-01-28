<?php
    function display($location, $url)
    {
        $url = str_replace('index.php', '', $url);
        $dir = scandir($location);
        
        echo "\t\t<dir class=\"body\">\n";
        echo "\t\t\t<ul>\n";
        for ($x = 2; $x < sizeof($dir); $x++) {
            if(file_exists($dir[$x] . "/index.php")) {
                $ref = 'http://' . $_SERVER['SERVER_NAME'] . $url . $dir[$x] . "/index.php";
                echo "\t\t\t\t<li id=\"$dir[$x]\"><a href=\"$ref\">$dir[$x]</li>\n";
                include "./$ref/index.php";
            }    
        }
        echo "\t\t\t</ul>\n";
        echo "\t\t</dir>\n";
    }?>