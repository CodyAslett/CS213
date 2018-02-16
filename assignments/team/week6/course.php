<?php
	try
	{
		$server = 'pgsql:host=127.0.0.1;dbname=notebook';
		$user = 'note_user';
		$password = 'orange';
		$db = new PDO($server, $user, $password);

		$coursID =  intval($_GET["id"]);

		 $courseQuerry = $db->query("SELECT name, number FROM course WHERE id = $coursID");
		 $course = $courseQuerry->fetch();
		 $courseName = $course['name'];
		 $courseNumber = $course['number'];
	}
	catch (PDOException $ex)
	{

	}
?>
<html>
    <body>
        <h1>
            Notes
        </h1>
        <h2>
            <?php echo "$courseName ($courseNumber)"; ?>

        </h2>
    </body>
</html>