<?php
include('../include/PDOConnect.php');
$table = 'WU_type';
$success = $connection->query("CREATE TABLE IF NOT EXISTS $table (ID INT AUTO_INCREMENT PRIMARY KEY, description TEXT)");
if ($success) {
	echo "Table '$table' created<br>'";

$success = $connection->query("INSERT INTO $table (ID, description) Values (0, 'Normales Arbeitspaket')");
if ($success) {	echo 'Value Inserted<br>';}
$success = $connection->query("INSERT INTO $table (description) Values ('Projectleitung')");
if ($success) {	echo 'Value Inserted<br>';}
$success = $connection->query("INSERT INTO $table (description) Values ('Meilenstein')");
if ($success) {	echo 'Value Inserted<br>';}
}


?>
