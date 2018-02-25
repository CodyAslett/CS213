<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<?php include 'menu.php'; ?>
		<h1>Create User</h1>
		<form action="createUserSubmit.php" method="post">
			Username : <input type="text" name="username" placeholder="Unique Username" size="50">
			<br>
			Display Name : <input type="text" name="displayName" placeholder="Awsome Name you want other to see" size="50">
			<br>
			E-Mail : <input type="email" name="email" placeholder="example@email.com" size="50">
			<br>
			Password : <input type="password" name="pass" placeholder="iLikeTheColorRedBecuseItMakesMeThinkOfApples" size="50">
			<br>
			Verify Password : <input type="password" name="passVerify" placeholder="same thing you typed above" size="50">
			<br>
			<br>
			<br>
			<input type="submit" name="createUser" value="Create New Account">
			<br>
		</form>
	</body>
</html>