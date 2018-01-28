<html>
    <head>
        <title>Your Info</title>
    </head>
    <body>
<?php
// define variables and set to empty values
    $name = $email = $major = $comment =   $continents = "";

// save data from post
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      $name = test_input($_POST["name"]);
      $email = test_input($_POST["email"]);
      $major = test_input($_POST["major"]);
      $comment = test_input($_POST["comment"]);
      $continents = test_input($_POST["continents"]);

    }
// clean data back to limit hacking
    function test_input($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }  
// display data
    echo "\t\t<h2>Your Info:</h2>\n";
    echo "\t\t<div>Name: $name</div>\n";
    echo "\t\t<div>Email: $email</div>\n";
    echo "\t\t<div>Major: $major</div>\n";
    echo "\t\t<div>Comment:". $_POST["continent"]."</div>\n";
    echo "\t\t<div>Location: "; 
    if(!empty($_POST["continents"]) )
    {
        foreach($_POST["continents"] as $continent)
        {
            echo  $continent . ", ";
        }
    }
    else
    {
        echo "Nowhere?";
    }
        echo "</div>\n";
?>
    </body>
</html>