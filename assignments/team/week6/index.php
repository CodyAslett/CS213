<?php
	try
	{
		$server = 'pgsql:host=127.0.0.1;dbname=notebook';
		$user = 'note_user';
		$password = 'orange';
		$db = new PDO($server, $user, $password);
	}
	catch (PDOException $ex)
	{

	}
?>
<html>
	<body>
		<h1>
			Note saver
		</h1>
		<h2>
			corses
		</h2>
		<ul>
<?php
	foreach ($db->query('SELECT name, number, id FROM course') as $row)
	{
		$name = $row['name'];
		$num = $row['number'];
		$id = $row['id'];
		echo "\t\t\t<a href='course.php?id=$id'> <li>$name ($num)</li> </a>\n";
	}
?> 
		</ul>
	</body>
</html>

