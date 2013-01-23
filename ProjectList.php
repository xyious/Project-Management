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
<h2>Projektliste:</h2>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr>
    <th>Erstellungsdatum</th>
    <th>Beschreibung</th>
    <th>Projektleiter</th>
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
$query = $connection->prepare("SELECT * FROM project");
$query->execute();
$assignment_query = $connection->prepare("SELECT users.displayname FROM workunits INNER JOIN worker_assignment on workunits.ID = worker_assignment.workunit_ID INNER JOIN users on worker_assignment.user_ID = users.ID WHERE workunits.project_ID = :project_id AND workunits.type = 2");
for ($i = 0; $i < $query->rowCount(); $i++)
{
	$row = $query->fetch();
	$assignment_query->bindParam(':project_id', $row['ID'], PDO::PARAM_STR);
	$assignment_query->execute();
	$assignment_row = $assignment_query->fetch();
	echo "<tr><td>" . $row['creation'] . "</td>";
	echo "<td><a href='ProjectDetails.php?id=" . $row['ID'] . "'>" . $row['description'] . "</a></td>";
	echo "<td>" . $assignment_row['displayname'] ."</td>";
	echo "<td>" . $row['deadline'] . "</td></tr>";
}
?>
</table><br>
<h2>Neues Project erstellen:</h2><br>
<form id='CreateProject' action='/Project/CreateProject.php' method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr><td><label for='Customer'>Kunde:</label></t:>
      <td><textarea Cols="100" rows="5" name='Customer' id='Customer'></textarea></td></tr>
  <tr><td><label for='ProjectDescription'>Projektbeschreibung:</label></t:>
      <td><textarea Cols="100" rows="25" name='ProjectDescription' id='ProjectDescription'></textarea></td></tr>
        <tr><td><label for='Responsible'>Projektverantwortlicher:</label></td>
  <td><select multiple name="Responsible" size="1">
<?php
for ($i = 1; $i < count($users) + 1; $i++)
{
	echo "<option value=\"" . $i . "\">" . $users[$i] . "</option>";
}
?>
      </select></td></tr>
  <tr><td><label for='ProjectDeadline'>Termin:</label></t:>
      <td><input type='date' name='ProjectDeadline' id='ProjectDeadline'  maxlength="50" /></td></tr>
    <tr><td>&nbsp;</td><td><input type='submit' name='Submit' value='Submit' /></td>
  </tr>
</form>
</table>

</body>
</html>
