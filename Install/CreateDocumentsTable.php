<?php
include('../include/PDOConnect.php');
$table = 'documents';
$success = $connection->query("CREATE TABLE IF NOT EXISTS $table (ID INT AUTO_INCREMENT PRIMARY KEY, workunit_ID INT, link VARCHAR(256), description TEXT)");

if ($success) {
	echo 'Table "' . $table . '" created';
}
?>
