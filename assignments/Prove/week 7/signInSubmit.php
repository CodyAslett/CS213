<?php
	session_start();
	$_SESSION["user"] = 0;

/********************************************************************
 * upon start connet to database
*********************************************************************/
	require('dbConnect.php');
	$db = get_db();

/********************************************************************
 * get in info from user submited signIn.php and sanitize it
 *	* used for refference on how to sanitize
 *	* https://www.w3schools.com/php/php_form_validation.asp
*********************************************************************/
	$username = "";
	$pass = "";
	$user = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$username = test_input($_POST["username"]);
		$pass = test_input($_POST["pass"]);
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}



	$stmt = $db->query("SELECT password, id FROM users WHERE username = '$username'");
    if ($stmt) // if statment so a bad query dosn't crash things
    {
    	$user = $stmt->fetch();
    	// check password using hash
	    if ( password_verify($pass, $user['password']) )
	    {
	    	echo "Sucess\n<br>\n";
	    	// sesion variable user set to 'db User ID' to track user
	    	// return to index.php
	    	$_SESSION["user"] = $user['id'];
	    	header("Location: index.php");
			die();
	    }
	    else
	    {
	    	// return to sign in
	    	header("Location: signIn.php?error=1");
			die();
	    }
    }
    else // if the query was bad go back
    {
    	// return to signin or maybe just index.php because if db problems trying agin probely wont work
    	if(isset($_SESSION["currentPage"]))
    	{
    		$goTo = $_SESSION["currentPage"];
    		header("Location: $currentPage?error=1");
			die();
    	}
    	else
    	{
    		header("Location: index.php?error=1");
			die();
    	}
    }
?>