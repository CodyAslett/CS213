<?php include './lsitDirectories.php';?>
<!DOCTYPE html><html>
<html>
    <head>
        <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"></META>
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <?php 
            include './parts/navBar.php';
            $header = file_get_contents('./parts/header.php', true);
            echo $header;
        ?>
        
        <div class="body" id="list">
            <ul>
                <?php
                    display(__DIR__, $_SERVER['PHP_SELF']);
                ?>
            </ul>
        </div>
    </body>
</html>