<?php
include('../include/PDOConnect.php');
$table = 'WU_status';
$success = $connection->query("CREATE TABLE IF NOT EXISTS $table (ID INT AUTO_INCREMENT PRIMARY KEY, description TEXT)");
if ($success) {
	echo "Table '$table' created<br>'";

$success = $connection->query("INSERT INTO $table (ID, description) Values (0, 'Noch nicht spezifiziert')");
if ($success) {	echo 'Value Inserted<br>';}
$success = $connection->query("INSERT INTO $table (description) Values ('Freigegeben')");
if ($success) {	echo 'Value Inserted<br>';}
$success = $connection->query("INSERT INTO $table (description) Values ('In Bearbeitung')");
if ($success) {	echo 'Value Inserted<br>';}
$success = $connection->query("INSERT INTO $table (description) Values ('Abhaengigkeiten nicht erfuellt')");
if ($success) {	echo 'Value Inserted<br>';}
$success = $connection->query("INSERT INTO $table (ID, description) Values (999, 'Abgeschlossen')");
if ($success) {	echo 'Value Inserted<br>';}
$success = $connection->query("INSERT INTO $table (ID, description) Values (-1, 'Es gibt ungeloeste Probleme')");
if ($success) {	echo 'Value Inserted<br>';}
}


?>
