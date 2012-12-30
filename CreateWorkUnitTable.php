<?php
include('include/PDOConnect.php');
$success = $connection->query("CREATE TABLE IF NOT EXISTS workunits (ID INT AUTO_INCREMENT PRIMARY KEY, description TEXT, progress INT, estimated_hours INT, deadline DATETIME)");

if ($success) {
	echo 'Table "workunits" created';
}
?>
