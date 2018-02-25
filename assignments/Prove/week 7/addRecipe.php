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
		<form action="submitRecipe.php" id="newRecipe" method="post" enctype="multipart/form-data">
			<input type ="name" name="recipeName" class="name" placeholder="Name">
			<br>
			<input type="file" name="userfile" id="fileToUpload">
			<br>
			<textarea name="discription" form="newRecipe" placeholder="discription"></textarea>
			<br>
			<input type="submit">
		</form>
<?php 


?>

	</body>
</html>