<?php
	// define variables and set to empty values
	$recipeID = "";
	$recipeName = "";
	$recipeDiscription = "";
	$recipeCreator = "";
	$recipeName = "";
	$recipeCreatorId = "";

	if ($_SERVER["REQUEST_METHOD"] == "GET") 
	{
		$recipeID = intval(strip_tags(test_input($_GET["id"]))); // do some converting to avoid secuirty problems

		try
		{
			//get database
			require('dbConnect.php');
			$db = get_db();

			$dbRecipeStatement = "SELECT name, description, creator_users_id FROM recipes WHERE id = $recipeID";
			$dbRequest = $db->query($dbRecipeStatement);
			$recipe = $dbRequest->fetch();

			$recipeName = $recipe['name'];
			$recipeDiscription = $recipe['description'];
			$recipeCreatorId = $recipe['creator_users_id'];

			$imgRequest = $db->query("SELECT id FROM pictures WHERE recipe_id = $recipeID");
			$img = $imgRequest->fetch();
			$imgID = $img['id'];
			$imgName = "$imgID.jpg";



			//get creator name
			$dbCreatorStatement = "SELECT id, display_name FROM users WHERE id = $recipeCreatorId";
			$dbCreatorRequest = $db->query($dbCreatorStatement);
			$recipeCreator = $dbCreatorRequest->fetch();

			$recipeCreatorName = $recipeCreator['display_name'];
		 }
		catch (Exception $ex)
		{
			echo "ERROR";
		}
	}

	function test_input($data) 
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>
<html>
	<head>
        <link rel="stylesheet" type="text/css" href="recipe.css">
        <link rel="stylesheet" type="text/css" href="menu.css">
        <title><?php echo $recipeName; ?></title>
    </head>
	<body>
		<?php include 'recipeMenu.php' ?>

		<h1>
			<?php echo "$recipeName\n"; ?>
		</h1>
		<div class=creator>
			<?php //TODO: should add link to user info page when ueres are implemented
			 echo "Added by: $recipeCreatorName\n"; ?>
		</div>
		<div class="imageHead">
			<img src="../../../img/<?php echo $imgName;?>">
		</div>
		<div class=discription>
			<?php echo "$recipeDiscription\n"; ?>
		</div>
		<div class="list" id="ingredients">
			<h3>
				Ingredients
			</h3>
			<table>
<?php
				foreach ($db->query("SELECT ingredient_id, qt, qt_type  FROM ingredients_recipes WHERE recipe_id = $recipeID") as $row)
				{
					// get ingredient name
					$ingredientId = $row['ingredient_id'];
					$dbGetIngredientStatement = "SELECT name, group_id FROM ingredients WHERE id = $ingredientId";
					$dbRequestForIngredient = $db->query($dbGetIngredientStatement);
					$ingredient = $dbRequestForIngredient->fetch();
					$ingredientName = "";
					$ingredientName = $ingredient['name'];

					// get qt_type Name
					$qtTypeId = $row['qt_type'];
					$dbGetQtTypetStatement = "SELECT name FROM qt_type WHERE id = $qtTypeId";
					$dbRequestForQtType = $db->query($dbGetQtTypetStatement);
					$QtType = $dbRequestForQtType->fetch();
					$QtTypeName = "";
					$QtTypeName = $QtType['name'];

// TODO : convert dcimal to fraction. maybe do it client side with javascript
					$qt = $row['qt'];
					// display name then qt in table row
					echo "\t\t\t\t<tr class='row'>\n\t\t\t\t\t<td>$ingredientName</td>\n\t\t\t\t\t<td>$qt $QtTypeName(s)</td>\n\t\t\t\t</tr>\n";
				}

?>
			</table>
		</div>
		<div class="list" id="directions">
			<h3>
				Directions
			</h3>
			<table>
<?php
				foreach ($db->query("SELECT instruction_text, num_order FROM instructions WHERE recipes_id = $recipeID") as $row)
				{
			// TODO: garentee order
					$order = $row['num_order'];
					$instruction = $row['instruction_text'];
					// display order number then instruction text
					echo "\t\t\t\t<tr class='row'>\n\t\t\t\t\t<td>$order</td>\n\t\t\t\t\t<td>$instruction</td>\n\t\t\t\t</tr>\n";
				}
?>
			</table>
		</div>
	</body>

</html>