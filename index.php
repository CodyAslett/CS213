<html>
    <head>
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"></META>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <?php 
            include './parts/navBar.php';
        ?>
        
            <?php
                $header = file_get_contents('./parts/header.php', true);
                echo $header;
            ?>
        <div class="body" id="listTest">
            <?php
                $dir = scandir(__DIR__);
                echo "\t\t\t<ul>\n";
                for ($x = 2; $x < sizeof($dir); $x++) {
                    if(file_exists($dir[$x] . "/index.php")) {
                        $ref = $dir[$x] . "/index.php";
                        echo "\t\t\t\t<li><a href=\"$ref\">$dir[$x]\n\t\t<br>\n";
                        $t = './' . $dir[$x] . "/index.php";
                        echo "</a></li>\n";
                    }
                }
            ?>
        </div>
    echo "\t\t\t<ul>\n";
        
        
        <div class="body" id="assignments"> 
            <?php
                include './assignments/team/index.php';
            ?>
        </div>
    </body>
</html>