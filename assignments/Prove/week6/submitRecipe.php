<?php
	$name = "";
	$discription = "";


	require('dbConnect.php');
	$db = get_db();



	function test_input($data) 
	{
		$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);
	  	return $data;
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		// NAME
  		if (empty($_POST["recipeName"])) 
  		{
    		$nameErr = "Name is required";
  		}
  		else 
  		{
    		$name = test_input($_POST["recipeName"]);
  		}

  		// DISCRIPTION
  		if (empty($_POST["discription"])) 
  		{
    		$discriptionErr = "Discription is required";
  		}
  		else 
  		{
    		$discription = test_input($_POST["discription"]);
  		}


  		// ADD TO Database
  		if (!empty($_POST["discription"]) && !empty($_POST["recipeName"]))
  		{
  			try
  			{
  				$addRequest = $db->prepare("INSERT INTO recipes(name, description, creator_users_id) VALUES(?, ?, ?)");
  				$addRequest->execute( array("$name", "$discription", 1));
  				$id = $db->lastInsertId('recipes_id_seq');
  				echo "new recipe id : $id\n<br>\n";

  				$addRequestPic = $db->prepare("INSERT INTO pictures(recipe_id, users_id) VALUES(?, ?)");
  				$addRequestPic->execute( array("$id", 1) );
				// $sql = "INSERT INTO recipes(name, description, creator_users_id, image_main_name) VALUES('Test Recipe', 'testing recipes description. testing recipes description, testing recipes description ',1,'1main.jpg')";
				// $stmt = $db->prepare($sql);
				// $stmt->execute();
				echo "prepared\n<br>\n";
  			}
  			catch(PDOExecption $e )
  			{
  				echo "FALIED to prepare\n<br>\n";
  			}
  		}
  	}
?>
<html>
	<body>
		<?php echo $name; ?>
		<br>
		<?php echo $discription . "\n<br>\n"; ?>

		<br>


		<?php 
			$dataBaseRecipeNameRequest = $db->query("SELECT id, name FROM recipes");
			foreach ($dataBaseRecipeNameRequest as $recipe)
			{
				echo $recipe['id'] . " : " .$recipe['name'] . "<br>\n";
			}
			?>
						<?php
				$imgRequest = $db->query("SELECT id FROM pictures WHERE recipe_id = $id");
				$img = $imgRequest->fetch();
				$imgID = $img['id'];
				$imgName = "$imgID.jpg";
				echo "<img src=\"../../../img/$imgName \">";

			?>

	</body>
</html>