<?php
	session_start();
	$_SESSION["user"] = 0;

	$username = "";
	$displayName = "";
	$email = "";
	$pass = "";
	$passVerify = "";

	$user = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$username = test_input($_POST["username"]);
		$displayName = test_input($_POST["displayName"]);
		$email = test_input($_POST["email"]);
		$pass = test_input($_POST["pass"]);
		$passVerify = test_input($_POST["passVerify"]);
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


	// test username
	if(isset($username)) // test existance
	{
		if($username != "") // no empty or default value
		{
			if(!preg_match('/\s/', $username) ) // no white space
			{
				if(strlen($username) >= 3) // min length
				{
					echo "username $username should be clean enugh\n<br>\n";
				}
				else
				{
					header("Location: createUser.php?error=username.errorType=short");
					die();
				}
			}
			else
			{
				header("Location: createUser.php?error=username.errorType=whiteSpace");
				die();
			}
		}
		else
		{
			header("Location: createUser.php?error=username.errorType=empty");
			die();
		}
	}
	else
	{
		header("Location: createUser.php?error=username.errorType=nonExistant");
		die();
	}

	// test display name
	if(isset($displayName)) // test existance
	{
		if($displayName != "") // no empty or default value
		{
			if(strlen($displayName) >= 1) // min length
			{
				echo "displayName $displayName should be clean enugh\n<br>\n";
			}
			else
			{
				header("Location: createUser.php?error=displayName.errorType=short");
				die();
			}
		}
		else
		{
			header("Location: createUser.php?error=displayName.errorType=empty");
			die();
		}
	}
	else
	{
		header("Location: createUser.php?error=displayName.errorType=nonExistant");
		die();
	}

	// test email
	if(isset($email)) // test existance
	{
		if($email != "") // no empty or default value
		{
			if(!preg_match('/\s/', $email) ) // no white space
			{
				if(strlen($email) >= 3) // min length
				{
					if(filter_var($email, FILTER_VALIDATE_EMAIL)) // valid email format
					{
						echo "email $email should be clean enugh\n<br>\n";
					}
					else
					{
						header("Location: createUser.php?error=email.errorType=format");
						die();
					}
				}
				else
				{
					header("Location: createUser.php?error=email.errorType=short");
					die();
				}
			}
			else
			{
				header("Location: createUser.php?error=email.errorType=whiteSpace");
				die();
			}
		}
		else
		{
			header("Location: createUser.php?error=email.errorType=empty");
			die();
		}
	}
	else
	{
		header("Location: createUser.php?error=username.errorType=nonExistant");
		die();
	}

	// test password
	if(isset($pass)) // test existance
	{
		if($pass != "") // no empty or default value
		{
			if(strlen($pass) >= 6) // min length
			{
				if($pass === $passVerify) // verify match
				{
					echo "password $pass should be clean enugh\n<br>\n";
				}
				else
				{
					header("Location: createUser.php?error=password.errorType=verify");
					die();
				}
			}
			else
			{
				header("Location: createUser.php?error=password.errorType=short");
				die();
			}
		}
		else
		{
			header("Location: createUser.php?error=password.errorType=empty");
			die();
		}
	}
	else
	{
		header("Location: createUser.php?error=password.errorType=nonExistant");
		die();
	}


	// assuming all tests are good
/********************************************************************
 * upon start connet to database
*********************************************************************/
	require('dbConnect.php');
	$db = get_db();

	// test if username already exists
	echo "test user";
	$redundetnUserQuery = $db->query("SELECT id FROM users WHERE username = '$username'");
	$redundetnUser = $redundetnUserQuery->fetch();
	// should do same check with email
	if( isset($redundetnUser['id']) )
	{
		header("Location: createUser.php?error=username.errorType=alreadyExists");
		die();
	}

	// HASH PASSWORD
	$passHash = password_hash($pass, PASSWORD_DEFAULT);

	// write to Database
	try
	{
		$addRequest = $db->prepare("INSERT INTO users(username, password, display_name, email) VALUES(?, ?, ?, ?)");
	  	$addRequest->execute( array("$username", "$passHash", "$displayName", "$email"));

	  	$_SESSION["user"] = $db->lastInsertId('users_id_seq');
	}
	catch(Exception $e)
	{
		header("Location: createUser.php?error=db.errorType=db");
		die();
	}

	header("Location: index.php");
	die();
?>