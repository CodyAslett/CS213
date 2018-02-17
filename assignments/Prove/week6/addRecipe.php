<?php
	require('dbConnect.php');
	$db = get_db();


		//INSERT INTO recipes(name, description, creator_users_id, image_main_name) 
				// $sql = "INSERT INTO recipes(name, description, creator_users_id, image_main_name) VALUES('Test Recipe', 'testing recipes description. testing recipes description, testing recipes description ',1,'1main.jpg')";
				// $stmt = $db->prepare($sql);
				// $stmt->execute();



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
		<form action="/addRecipe.php">
			<input type ="name" name="recipeName" class="name">
			<br>
		</form>
<?php 
	$q = $db->query("SELECT * FROM 'information_schema.tables'");
	$q->fetch();

?>

	</body>
</html>