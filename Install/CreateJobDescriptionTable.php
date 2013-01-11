<?php
include('../include/PDOConnect.php');
$table = 'job_description';
$success = $connection->query("CREATE TABLE IF NOT EXISTS $table (ID INT AUTO_INCREMENT PRIMARY KEY, description TEXT)");
if ($success) {
	echo "Table '$table' created<br>'";

$success = $connection->query("INSERT INTO $table (description) Values ('Projekt Management')");
if ($success) {	echo 'Value Inserted<br>';}
$success = $connection->query("INSERT INTO $table (description) Values ('Projektleiter')");
if ($success) {	echo 'Value Inserted<br>'';}
$success = $connection->query("INSERT INTO $table (description) Values ('Arbeitspaketverantwortlicher')");
if ($success) {	echo 'Value Inserted<br>'';}
$success = $connection->query("INSERT INTO $table (description) Values ('Mitarbeiter')");
if ($success) {	echo 'Value Inserted<br>'';}
}


?>
