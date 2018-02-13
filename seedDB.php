<?php
	echo "START SEED\n\n<br>\n\n";
	//$command = 'psql -d cookbook -a -f DB.sql';
	echo exec('psql -d cookbook -a -f DB.sql');
	echo "\n<br>\nEND SEED\n<br>\n"
?>