<?php
include('../include/PDOConnect.php');
$table = 'project';
$success = $connection->query("CREATE TABLE IF NOT EXISTS $table (ID INT AUTO_INCREMENT PRIMARY KEY, status INT, deadline TIMESTAMP, customer VARCHAR(256), description TEXT)");

if ($success) {
	echo 'Table "' . $table . '" created';
}
?>
