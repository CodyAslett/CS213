<?php
	session_start();

	$currentUser = $_SESSION["user"];

	if(isset($currentUser))
	{
		require('dbConnect.php');
		$db = get_db();
		$stmt = $db->query("SELECT username FROM users WHERE id = '$currentUser'");
		if(isset($stmt))
		{
			if($stmt)
			{
				$user = $stmt->fetch();
				$username = $user['username'];
			}
		}
	}

?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<h1>
			Sign In
		</h1>
		<form action="signInSubmit.php" method="post">
			Username: <input type="text" name="username" placeholder=<?php
			if(isset($username))
			{
				echo "'Username: $username'";
			}
			else
			{
				echo "'Name'";
			}

				?> >
			<br>
			Password: <input type="Password" name="pass" placeholder="Password">
			<br>
			<input type="submit" name="submit">
		</form>
	</body>
</html>