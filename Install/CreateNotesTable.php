<?php
include('../include/PDOConnect.php');
$table = 'notes';
$success = $connection->query("CREATE TABLE IF NOT EXISTS $table (ID INT AUTO_INCREMENT PRIMARY KEY, workunit_ID INT, note TEXT)");

if ($success) {
	echo 'Table "' . $table . '" created';
}
?>
