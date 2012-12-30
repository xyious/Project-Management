<?php
include('include/PDOConnect.php');
$table = 'worker_assignment';
$success = $connection->query("CREATE TABLE IF NOT EXISTS $table (ID INT AUTO_INCREMENT PRIMARY KEY, user_ID INT, workunit_ID INT, project_ID INT, job INT)");
if ($success) {
	echo "Table '$table' created";

}


?>
