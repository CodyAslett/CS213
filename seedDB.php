<?php
	echo "START SEED\n\n<br>\n\n";
	//$command = 'psql -d cookbook -a -f DB.sql';
	//echo exec('psql -d cookbook -a -f DB.sql');
	$process = new Process('ls -al');
	
	
	echo "\n<br>\nEND SEED\n<br>\n"
?>