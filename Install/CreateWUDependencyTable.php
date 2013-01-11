<?php
include('../include/PDOConnect.php');
$table = 'workunit_dependency';
$success = $connection->query("CREATE TABLE IF NOT EXISTS $table (workunit_ID INT, depends_on INT)");
if ($success) {
	echo "Table '$table' created<br>";

}


?>
