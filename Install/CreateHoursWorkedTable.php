<?php
include('include/PDOConnect.php');
$table = 'hours_worked';
$success = $connection->query("CREATE TABLE IF NOT EXISTS $table (ID INT AUTO_INCREMENT PRIMARY KEY, user_id INT, workunit_id INT, duration FLOAT, billable_duration FLOAT, date DATETIME, description TEXT)");

if ($success) {
	echo 'Table "' . $table . '" created';
}
?>
