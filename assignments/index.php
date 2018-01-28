<?php
    $listDirs = $_SERVER['DOCUMENT_ROOT'] . '/lsitDirectories.php';
    include $listDirs;
/****************************
* Get Reference Directory
*    - get Where This File is located
*****************************/

// test if it is being refferenced
    if(__DIR__ == getcwd()) 
    {
        echo "<!DOCTYPE html>\n<html>\n";
        echo "\t<head>\n\t\t<link rel=\"stylesheet\" href=\"" . $_SERVER['SERVER_URI'] . "/index.css\">\n\t</head>\n";
        echo "\n\t<body>\n";
    }
// show links to sub directories with index.php
    display(__DIR__, $_SERVER['PHP_SELF']);
        
        
        
    if(__DIR__ == getcwd()) {
        echo "\t</body>\n</html>";
    }
    ?>