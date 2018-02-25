<!------------------------------------------------------------------
 * MENUE
 *   used w3 schools as a base
 *      https://www.w3schools.com/howto/howto_css_dropdown.asp 
---------------------------------------------------------------------->
<?php
	session_start();

	//require('dbConnect.php');
	//$db = get_db();

	$userName = 'Sign In';

	$goodUser = 0;

	if(isset($_SESSION['user']))
	{
		if($_SESSION['user'] != 0)
		{
			$userId = $_SESSION['user'];
			$stmt = $db->query("SELECT display_name FROM users WHERE id = '$userId'");
    		if ($stmt) // if statment so a bad query dosn't crash things
    		{
    			$user = $stmt->fetch();
    			$curentUserDisplayName = $user['display_name'];
    			if (isset($curentUserDisplayName))
    			{
    				if(!empty($curentUserDisplayName) )
    				{
						$userName = $curentUserDisplayName;
						$goodUser = 1;
					}
				}
			}
		}
	}
	
?>
<div class="menu">
    <div class="dropdown">
        <a href="index.php" class="homeLink"><button class="dropbtn">Recipe Book</button></a>
    </div>
    <div class="dropdown">
        <?php 
        if($goodUser == 1)
        {
        	echo "\t\t\t<a href='index.php' class='homeLink'><button class='dropbtn'>$userName </button></a>\n";
	        echo "\t\t\t<div class='dropdown-content'>\n";
	        echo "\t\t\t\t<a href='signOut.php'>Sign Out</a>\n";
	        echo "\t\t\t\t<a href='profile.phps'>Profile</a>\n";
	        echo "\t\t\t</div>\n";
   		}
   		else
   		{
   			echo "\t\t\t<a href='signIn.php' class='homeLink'><button class='dropbtn'>$userName </button></a>\n";
   			echo "\t\t\t<div class='dropdown-content'>\n";
	        echo "\t\t\t\t<a href='createUser.php'>Create New Account</a>\n";
	        echo "\t\t\t</div>\n";
	        $_SESSION["user"] = 0;
   		}
    ?>
    </div>
</div>
<div class="topBuffer"></div>
<!------------------------------------------------------------------
 * MENUE
 *   END
---------------------------------------------------------------------->