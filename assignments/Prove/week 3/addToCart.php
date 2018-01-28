<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $location = test_input($_POST["test"]);
    }

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $item = './' . $location . '/info.xml';
    $one = simplexml_load_file($item);

    if (!isset($_SESSION["itemsLocations"]))
    {
        $_SESSION["itemsLocations"] = array($location);
    }
    else {
        array_push($_SESSION["itemsLocations"], $location);
        echo count($_SESSION["itemsLocations"]);
    }
    ?>