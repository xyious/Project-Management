<?php
session_start();
if (!$_SESSION['IP']) {
	$_SESSION['IP'] = $_SERVER['REMOTE_ADDR']; }
?>
<!doctype html>
<html>
<head>
<title>Projekt Liste</title>
<link rel="stylesheet" href="include/body.css" type="text/css">
</head>
<body>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr>
    <th>Erstellungsdatum</th>
    <th>Beschreibung</th>
    <th>Projektleiter</th>
    <th>Termin</th>
  </tr>
<?php
include "include/PDOConnect.php";
$query = $connection->prepare("SELECT * FROM project");
$query->execute();
for ($i = 0; $i < $query->rowCount(); $i++)
{
	$row = $query->fetch();
	echo "<tr><td>" . $row['creation'] . "</td>";
	echo "<td><a href='ProjectDetails.php?id=" . $row['ID'] . "'>" . $row['description'] . "</a></td>";
	echo "<td>FIX ME</td>";
	echo "<td>" . $row['deadline'] . "</td></tr>";
}
?>
</table>
</body>
</html>
