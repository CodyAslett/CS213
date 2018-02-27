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

		echo "<select name='ingredent[]' onchange='addIngredient()'>\n";

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

		echo "<input type='number' name='ingredentQt[]'>";

		echo "<select name='ingredentQtType[]' onchange='test()'>\n";
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
        <script src="addRecipe.js" type="text/javascript"></script>
        <title>New Recipe></title>
	</head>
	<body>
<?php include 'menu.php' ?>

		<form action="submitRecipe.php" id="newRecipe" method="post" enctype="multipart/form-data">
			<input type ="name" name="recipeName" class="name" placeholder="Name" id="nameInput" autofocus>
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
<!-- should make something better then hard coding: probebly restructure to table -->
			<p>
				Name - - - - - - - - - - - - - - - Quanty - - - - - - - - - - - - Quanty Type
			</p>
			<div id="addIngredents">
				<div id="ingredents">
					<?php
						selectIngredient("ingredient1");
						selectIngredientQt("qt1");
						echo "\n<br>\n";
					?>
				</div>
			</div>
			<h3>
				Directions
			</h3>
			<div id="directions">
				<textarea id="direction" name="direction[]" form="newRecipe" rows="3" class="direction" onchange="addDirection()" ></textarea><br>
				<textarea id="direction2" name="direction[]" form="newRecipe" rows="3" class="direction" onchange="addDirection()" ></textarea><br>
			</div>
			<br>
			<input type="submit">
		</form>
<?php 


?>

	</body>
</html>