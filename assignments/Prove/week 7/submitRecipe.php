<?php
	session_start();






	echo "POST\n<br>\n";
	foreach ($_POST as $key => $value) 
	{
  		echo "$key\n<br>\n";
  		foreach($value as $k => $v)
  		{
  			echo "\t - $k \n<br>\n";
  			echo "\t$v \n<br>\n";
  		}
  		echo "<hr>";
	} 
	echo "\n<br>\n";
	echo "END POST\n<br>\n";















	if(!isset($_SESSION["user"]))
	{
		header("Location: signIn.php");
		die();
	}
	if($_SESSION["user"] == 0)
	{
		header("Location: signIn.php");
		die();
	}

	$userId = $_SESSION["user"];


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
  				$addRequest->execute( array("$name", "$discription", "$userId"));
  				// get id of recipe just added
  				$id = $db->lastInsertId('recipes_id_seq');
  				echo "new recipe id : $id\n<br>\n";

  				// add ingredients
  				$i = 0;
  				foreach ($_POST["ingredent"] as $key => $value)
				{
					if ($value != "")
					{
						$qt = 0;
						if (isset($_POST["ingredentQt"][$i]))
						{
							if ($_POST["ingredentQt"][$i] != "")
							{
								$qt = floatval($_POST["ingredentQt"][$i]);
							}
						}
						$k = $key + 1;
						$addRequest = $db->prepare("INSERT INTO ingredients_recipes(recipe_id, ingredient_id, qt, qt_type) VALUES(?, ?, ?, ?)");
	  					$addRequest->execute( array($id, $value, $qt, 1));
	  					echo "ADDed: $id, $value, 0, 1\n<br>\n";
  					}
  					$i = $i + 1;
				}

  				// add instructions
  				foreach ($_POST["direction"] as $key => $value)
				{
					if ($value != "")
					{
						$k = $key + 1;
						$addRequest = $db->prepare("INSERT INTO instructions(instruction_text, recipes_id, num_order) VALUES(?, ?, ?)");
	  					$addRequest->execute( array("$value", $id, $k));
	  					echo "ADDed: $value, $id, $key\n<br>\n";
  					}
				}



  				// PICTURES
  				$uploadfile = "../../../img/$id.jpg";
  				if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) 
  				{
    				echo "File is valid, and was successfully uploaded.\n<br>\n";
				} 
				else 
				{
    				echo "Possible file upload attack!\n<br>\n";
				}
				print_r($_FILES);


				// ADD pic to database
  				$addRequestPic = $db->prepare("INSERT INTO pictures(recipe_id, users_id) VALUES(?, ?)");
  				$addRequestPic->execute( array("$id", 1) );
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
		<br>
		<br>
		<br>
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

<?php
	header("Location: recipe.php?id=$id.php");
	die();
?>