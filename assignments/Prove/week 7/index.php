<?php
/********************************************************************
 * upon start connet to database
*********************************************************************/
  require('dbConnect.php');
  $db = get_db();

  session_start();

  if(isset($_SESSION["currentPage"]))
  {
    $_SESSION["lastPage"] = $_SESSION["currentPage"];
  }
  $_SESSION["currentPage"] = 'index.php';

/********************************************************************
 * header
 *  * NO page caching
*********************************************************************/
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

/********************************************************************
 * Make Recipe Tile
 *  * makes recipe tile of recipe with the id you pass in
 * 
 * NOTES:
 *  * if get too many recipies need to use ajacx to asynchronous get the recipes to avoid lag 
 *  * might want to make it return the div object instead of just making it where it was called
*********************************************************************/
    function tile($recipieID)
    {
      try
      {
        global $db; // global allows me to access the variable inside the function. without it it wont work and yould have to make another server call
        $dataBaseRecipeNameRequest = $db->query("SELECT name FROM recipes WHERE id = $recipieID");
        $recipe = $dataBaseRecipeNameRequest->fetch();
        $recipeName = $recipe['name'];

        $dataBaseRecipeImageRequest = $db->query("SELECT id FROM pictures WHERE recipe_id = $recipieID");
        $image = $dataBaseRecipeImageRequest->fetch();
        $image = $image['id'];
        $imgName = "$image.jpg";

        // Start Main Div
        echo "\t\t" . '<a href = "recipe.php?id=' . $recipieID . '">' . "\n";
        echo "\t\t\t" . '<div class="recipeTile">' . "\n";
        
        // Image Div
        if (file_exists("../../../img/$imgName"))
        {
          echo "\t\t\t\t<div class=\"recipeTileImg\">\n\t\t\t\t\t<img src=\"../../../img/" . $imgName . "\" name=\"img_$image\">\n\t\t\t\t</div>\n";
        }
        else
        {
          echo "\t\t\t\t<div class=\"recipeTileImg\">\n\t\t\t\t\t<img src=\"..\..\..\img\\" . "default.jpg" . "\" name=\"img_$image\">\n\t\t\t\t</div>\n";
        }

        // Info Div - name, stars, maybe creator
        // TO DO : if name to long cut it off or tiles get lifted out of allignment. it seems so that bottom lines of text align
        echo "\t\t\t\t<div class=\"recipeTileInfo\">\n\t\t\t\t\t" . $recipeName  . "\n\t\t\t\t</div>\n";
        
        // End main div
        echo "\t\t\t</div>\n";
        echo "\t\t" . "</a>\n";
      }
      catch (Exception  $ex)
      {
        echo $ex;
      }
    }

?>
<htm>
    <head>
      <title>Recipe Book</title>
      <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>

      <?php include 'indexMenu.php'; ?>
      <h1></h1>
      <h1 class="topTitle">
        Recipe Book
      </h1>
      <?php
        // make a tile for every recipe
        // if get too many recipies may want to limit this to a spcific number
        // in future may want to use ajax so page dosn't lag from loading too many on start
        foreach ($db->query('SELECT id FROM recipes') as $row)
        {
          tile($row['id']);
        }
      ?>
<?php 
// only users can add a recipe
  if(isset($_SESSION["user"]))
  {
    if($_SESSION["user"] != 0)
    {
      echo "\t\t<a href = 'addRecipe.php'>\n";
      echo "\t\t\t<div class = 'recipeTile'>\n";
      echo "\t\t\t\t<div class = 'recipeTileImg'>\n";
      echo "\t\t\t\t\t<img src='..\..\..\img\addRecipe.jpg'>\n";
      echo "\t\t\t\t</div>\n";
      echo "\t\t\t\t<div class = 'recipeTileInfo'>\n";
      echo "\t\t\t\t\tAdd New Rcipe\n";
      echo "\t\t\t\t</div>\n";
      echo "\t\t\t</div>\n";
      echo "\t\t</a>\n";
    }
  }
?>
    </body>
</htm>