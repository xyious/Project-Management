<?php
session_start();
if (!$_SESSION['IP']) {
	$_SESSION['IP'] = $_SERVER['REMOTE_ADDR']; }
?>
<!doctype html>
<html>
<head>
<title>Benutzerverwaltung</title>
<link rel="stylesheet" href="include/body.css" type="text/css">
</head>
<body>
<h1>Benutzer:</h1>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr>
    <th>Name</th>
    <th>Benutzername</th>
    <th>Email</th>
  </tr>
<?php
include "include/PDOConnect.php";
$query = $connection->prepare("SELECT * FROM users");
$query->execute();
for ($i = 0; $i < $query->rowCount(); $i++)
{
	$row = $query->fetch();
	echo "<tr><td>" . $row['displayname'] . "</td>";
	echo "<td>" . $row['username'] . "</td>";
	echo "<td>" . $row['email'] . "</td></tr>";
}
?>
</table>
<br>
<?php include "include/CreateUserForm.php" ?>
</body>
</html>
