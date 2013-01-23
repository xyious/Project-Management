<?php
session_start();
if (!$_SESSION['IP']) {
	$_SESSION['IP'] = $_SERVER['REMOTE_ADDR']; }
?>
<!doctype html>
<html>
<head>
<title>Projekt Details</title>
<link rel="stylesheet" href="include/body.css" type="text/css">
</head>
<body>
<h1>Arbeitspakete:</h1>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr>
    <th>Erstellungsdatum</th>
    <th>Beschreibung</th>
    <th>Verantwortlicher</th>
    <th>Termin</th>
  </tr>
<?php
include "include/PDOConnect.php";
$workunit_query = $connection->prepare("SELECT * FROM workunits");
$assignment_query = $connection->prepare("SELECT * FROM workunits INNER JOIN worker_assignment on workunits.ID = worker_assignment.workunit_ID WHERE workunits.ID = :workunit_id AND worker_assignment.job = 3");
$workunit_query->execute();
for ($i = 0; $i < $workunit_query->rowCount(); $i++)
{
	$row = $workunit_query->fetch();
	echo "<tr><td>" . $row['creation'] . "</td>";
	echo "<td><a href='WUDetails.php?id=" . $row['ID'] . "'>" . $row['description'] . "</a></td>";
	echo "<td>FIX ME</td>";
	echo "<td>" . $row['deadline'] . "</td></tr>";
}
?>
</table>
<br>
<form id='CreateWorkUnit' action='/Project/CreateWorkUnit.php' method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<input type='hidden' name='Project_ID' id='Project_ID' value=<?php echo "'" . $_GET["id"] . "'"; ?>/>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr><td><label for='WUDescription'>Arbeitspaketbeschreibung:</label></td>
      <td><textarea Cols="100" rows="25" name='WUDescription' id='WUDescription'></textarea></td></tr>
  <tr><td><label for='Responsible'>Arbeitspaket Verantwortlicher:</label></td>
      <td><select name="Responsible" multiple size="1">
<?php
$user_query = $connection->prepare("Select ID, displayname FROM users");
$user_query->execute();
for ($i = 0; $i < $user_query->rowCount(); $i++)
{
	$row = $user_query->fetch();
	echo "<option value=\"" . $row['ID'] . "\">" . $row['displayname'] . "</option>";
}
?>
      </select></td></tr>
  <tr><td><label for='WUDeadline'>Termin:</label></td>
      <td><input type='date' name='WUDeadline' id='WUDeadline'  maxlength="50" /></td></tr>
  <tr><td><label for='Estimate'>Voraussichtlicher Aufwand (Stunden):</label></td>
      <td><input type='text' name='Estimate' id='Estimate'  maxlength="50" /></td></tr>
    <tr><td>&nbsp;</td><td><input type='submit' name='Submit' value='Submit' /></td>
  </tr>
</form>
</table>
</html>
