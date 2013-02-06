<?php
session_start();
if (!isset($_SESSION['IP'])) {	$_SESSION['IP'] = $_SERVER['REMOTE_ADDR']; $_SESSION['Logged_In'] = 0;}
?>
<!doctype html>
<html>
<head>
<title>Projekt Details</title>
<link rel="stylesheet" href="include/body.css" type="text/css">
</head>
<body>
<h2>Arbeitspakete:</h2>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr>
    <th>Erstellungsdatum</th>
    <th>Beschreibung</th>
    <th>Verantwortlicher</th>
    <th>Termin</th>
  </tr>
<?php
include "include/PDOConnect.php";
$user_query = $connection->prepare("Select ID, displayname FROM users");
$user_query->execute();
$users = array();
for ($i = 0; $i < $user_query->rowCount(); $i++)
{
	$row = $user_query->fetch();
	$users[$row['ID']] = $row['displayname'];
}
$workunit_query = $connection->prepare("SELECT * FROM workunits WHERE project_ID = :project_id");
$workunit_query->bindParam(':project_id', $_GET['id'], PDO::PARAM_STR);
$workunit_query->execute();
$WUTable = "";
$MSTable = ""
$assignment_query = $connection->prepare("SELECT users.displayname FROM workunits INNER JOIN worker_assignment on workunits.ID = worker_assignment.workunit_ID INNER JOIN users on worker_assignment.user_ID = users.ID WHERE workunits.ID = :workunit_id AND worker_assignment.job = 3");
for ($i = 0; $i < $workunit_query->rowCount(); $i++)
{
	$row = $workunit_query->fetch();
	$assignment_query->bindParam(':workunit_id', $row['ID'], PDO::PARAM_STR);
	$assignment_query->execute();
	$assignment_row = $assignment_query->fetch();
	if ($row['type'] == "1") {
		$WUTable .= "<tr><td>" . $row['creation'] . "</td>";
		$WUTable .= "<td><a href='WUDetails.php?id=" . $row['ID'] . "'>" . $row['description'] . "</a></td>";
		$WUTable .= "<td>" . $assignment_row['displayname'] . "</td>";
		$WUTable .= "<td>" . $row['deadline'] . "</td></tr>";
	}
	if ($row['type'] == "3") {
		$MSTable .= "<tr><td>" . $row['creation'] . "</td>";
		$MSTable .= "<td><a href='WUDetails.php?id=" . $row['ID'] . "'>" . $row['description'] . "</a></td>";
		$MSTable .= "<td>" . $assignment_row['displayname'] . "</td>";
		$MSTable .= "<td>" . $row['deadline'] . "</td></tr>";
	}
}
echo $WUTable . "</table>";
?>
<br>
<h2>Meilensteine:</h2>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr>
    <th>Erstellungsdatum</th>
    <th>Beschreibung</th>
    <th>Verantwortlicher</th>
    <th>Termin</th>
  </tr>
<?php echo $MSTable; ?>
</table>
<br>
<h2>Arbeitspakete erstellen:</h2>
<form id='CreateWorkUnit' action='/Project/CreateWorkUnit.php' method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<input type='hidden' name='Project_ID' id='Project_ID' value=<?php echo "'" . $_GET["id"] . "'"; ?>/>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr><td><label for='WUDescription'>Arbeitspaketbeschreibung:</label></td>
      <td><textarea Cols="100" rows="25" name='WUDescription' id='WUDescription'></textarea></td></tr>
  <tr><td><label for='Responsible'>Arbeitspaket Verantwortlicher:</label></td>
      <td><select name="Responsible" multiple size="1">
<?php
for ($i = 1; $i < count($users) + 1; $i++)
{
	echo "<option value=\"" . $i . "\">" . $users[$i] . "</option>";
}
?>
      </select></td></tr>
  <tr><td><label for='WUDeadline'>Termin:</label></td>
      <td><input type='date' name='WUDeadline' id='WUDeadline'  maxlength="50" /></td></tr>
  <tr><td><label for='Estimate'>Voraussichtlicher Aufwand (Stunden):</label></td>
      <td><input type='text' name='Estimate' id='Estimate'  maxlength="50" /></td></tr>
  <tr><td><label for='WUType'>Arbeitspakettyp (1 = Arbeitspaket, 3 = Meilenstein):</label></td>
      <td><input type='text' name='WUType' id='WUType'  maxlength="50" value="1" /></td></tr>
    <tr><td>&nbsp;</td><td><input type='submit' name='Submit' value='Submit' /></td>
  </tr>
</form>
</table>
</html>
