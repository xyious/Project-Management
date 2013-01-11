<?php
include('../include/PDOConnect.php');
$success = $connection->query("CREATE TABLE IF NOT EXISTS workunits (ID INT AUTO_INCREMENT PRIMARY KEY, project_id INT, creation TIMESTAMP default CURRENT_TIMESTAMP, description TEXT, progress INT, estimated_hours INT, deadline DATETIME, status INT, type INT)");

if ($success) {
	echo 'Table "workunits" created';
}
?>
