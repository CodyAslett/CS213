<?php
	session_start();

	require('dbConnect.php');
	$db = get_db();

	$userName = "";

	if(isset($_SESSION["user"]))
  	{
  		if($_SESSION["user"] != 0)
  		{
  			$userID = $_SESSION["user"];
			$dbRequestCreatorName = $db->query("SELECT display_name from users WHERE id = $userID");

			$user = $dbRequestCreatorName->fetch();
			$userName = $user["display_name"];
		}
	}

	// for effeciency should read in ingredients as page loads but this should work for small scale
	function selectIngredient($name)
	{
		global $db;

		$dbRequestIngredents = $db->query("SELECT id, name FROM ingredients");

		echo "<select name='$name'>\n";

		echo "\t<option value=0></option>\n";

		foreach ($dbRequestIngredents  as $ingredent)
		{
			$ingredentId = $ingredent['id'];
			$ingredentName = $ingredent['name'];

			echo "\t<option value='$ingredentId'>$ingredentName</option>\n";
		}
		echo "</select>\n";
		return;
	}


	function selectIngredientQt($name)
	{
		global $db;

		$dbRequestQtType = $db->query("SELECT id, name FROM qt_type");

		echo "<input type='number'>";

		echo "<select name='$name'>\n";
		echo "\t<option value=0></option>\n";
		foreach ($dbRequestQtType  as $qt)
		{
			$QtId = $qt['id'];
			$QtName = $qt['name'];

			echo "\t<option value='$QtId'>$QtName</option>\n";
		}
		echo "</select>\n";
		return;
	}


?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="recipe.css">
        <link rel="stylesheet" type="text/css" href="menu.css">
        <title>New Recipe></title>
	</head>
	<body>
		<?php include 'menu.php' ?>
		<form action="submitRecipe.php" id="newRecipe" method="post" enctype="multipart/form-data">
			<input type ="name" name="recipeName" class="name" placeholder="Name">
			<br>
			<?php echo $userName ?>
			<br>
			<input type="file" name="userfile" id="fileToUpload">
			<br>
			<textarea name="discription" form="newRecipe" placeholder="discription"></textarea>
			<br>
			<br>
			<h3>
				Ingredients
			</h3>
			<div id="ingredents">
<!-- should make something better then hard coding -->
				Name - - - - - - - - - - - - - - - Quanty - - - - - - - - - - - - Quanty Type
				<br>
				<?php
					echo "1: ";
					selectIngredient("ingredient1");
					selectIngredientQt("qt1");
					echo "\n<br>\n2: ";
					selectIngredient("ingredient2");
					selectIngredientQt("qt2");
					echo "\n<br>\n3: ";
					selectIngredient("ingredient3");
					selectIngredientQt("qt3");
					echo "\n<br>\n";
				?>
			</div>
			<h3>
				Directions
			</h3>
			<div id="directions">
				1: <textarea name="direction1" form="newRecipe" rows="3" class="direction"></textarea><br>
				2: <textarea name="direction2" form="newRecipe" rows="3" class="direction"></textarea><br>
				3: <textarea name="direction3" form="newRecipe" rows="3" class="direction"></textarea><br>
			</div>
			<br>
			<input type="submit">
		</form>
<?php 


?>

	</body>
</html>