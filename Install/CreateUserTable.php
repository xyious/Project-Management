
<?php
include('include/PDOConnect.php');
$table = 'users';
$success = $connection->query("CREATE TABLE IF NOT EXISTS $table (ID INT AUTO_INCREMENT PRIMARY KEY, username varchar(25), password varchar(128), email varchar(256), displayname varchar(64))");

if ($success) {
	echo 'Table "' . $table . '" created';
}
?>
