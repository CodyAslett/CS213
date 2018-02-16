<?php
// copied from teacher brother burton
//https://github.com/sburton42/cs313-php-17w/blob/master/web/0209_demo/dbConnect.php
function get_db() {
	$dbUrl = getenv('DATABASE_URL');
	if (empty($dbUrl)) {
		$dbUser = "php_user";
		$dbPassword = "aVaryGoodPassword1029384756";
		$dbPort = "";
		$dbHost = "localhost";
		$dbName = "cookbook";
	} else {
		$dbopts = parse_url($dbUrl);
		$dbHost = $dbopts["host"];
		$dbPort = $dbopts["port"];
		$dbUser = $dbopts["user"];
		$dbPassword = $dbopts["pass"];
		$dbName = ltrim($dbopts["path"],'/');
	}
	try {
	 $db = new PDO("pgsql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
	}
	catch (PDOException $ex) {
	 print "<p>error: $ex->getMessage() </p>\n\n";
	 die();
	}
	return $db;
}
?>