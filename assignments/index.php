<?php
/****************************
* Get Reference Directory
*    - get Where This File is located
*****************************/
    function getRefDir() 
    {
        $nativDir = substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT']));
        $d = str_replace('\\', '/', $nativDir);
        $out = '.' . $d . '/' . $dir[$x] . 'index.php';
        return $out;
    }

// test if it is being refferenced
    if(__DIR__ == getcwd()) 
    {
        echo "<!DOCTYPE html>\n<html>\n";
        echo "\t<head>\n\t\t<link rel=\"stylesheet\" href=\"" . $_SERVER['SERVER_URI'] . "/index.css\">\n\t</head>\n";
        echo "\n\t<body>\n";
        include $_SERVER['DOCUMENT_ROOT'] . "/parts/header.php";
        include $_SERVER['DOCUMENT_ROOT'] . "/parts/navBar.php";
    }
// show links to sub directories with index.php
    $dir = scandir(__DIR__);
    echo "\t\t<dir class=\"body\">\n";
    echo "\t\t\t<ul>\n";
    for ($x = 2; $x < sizeof($dir); $x++) {
        if(file_exists($dir[$x] . "/index.php")) {
                $ref = $dir[$x] . "/index.php";
                echo "\t\t\t\t<li><a href=\"$ref\">$dir[$x]</a></li>\n";
        }
    }
    echo "\t\t\t\t<ul>\n";
    echo "\t\t</dir>\n";
        
        
        
    if(__DIR__ == getcwd()) {
        echo "\t</body>\n</html>";
    }
    ?>