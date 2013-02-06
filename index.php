<?php
session_start();
if (!isset($_SESSION['IP'])) { $_SESSION['IP'] = $_SERVER['REMOTE_ADDR']; $_SESSION['Logged_In'] = 0;}
?>
<!doctype html>
<html>
<head>
<title>Projekt Liste</title>
<link rel="stylesheet" href="include/body.css" type="text/css">
</head>
<body>
<?php 
if (!($_SESSION['Logged_In'] && ($_SESSION['IP'] == $_SERVER['REMOTE_ADDR']))) {
 	echo "Sie sind nicht eingeloggt!<br><a href='/Project/Login.php?previous=" . $_SERVER['PHP_SELF'] . "'>Login</a>";
} else {
	echo "<h2>Projektliste:</h2>";
	echo "<table rules=\"all\" border=\"1px\" style=\"width: 100%; border-color: #FFFFFF\">";
  	echo "<tr>";
    	echo "<th>Erstellungsdatum</th>";
    	echo "<th>Beschreibung</th>";
    	echo "<th>Projektleiter</th>";
    	echo "<th>Termin</th>";
  	echo "</tr>";
	include "include/PDOConnect.php";
	$user_query = $connection->prepare("Select ID, displayname FROM users");
	$user_query->execute();
	$users = array();
	for ($i = 0; $i < $user_query->rowCount(); $i++)
	{
		$row = $user_query->fetch();
		$users[$row['ID']] = $row['displayname'];
	}
	$query = $connection->prepare("SELECT project.creation, project.ID, project.description, project.deadline FROM project INNER JOIN worker_assignment on project.ID = worker_assignment.project_ID WHERE worker_assignment.user_ID = " . $_SESSION['user_id'] . " AND worker_assignment.job != 3");
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
	echo "</table><br>";
	echo "<h2>Neues Projekt erstellen:</h2><br>";
	echo "<form id='CreateProject' action='/Project/CreateProject.php' method='post' accept-charset='UTF-8'>";
	echo "<input type='hidden' name='submitted' id='submitted' value='1'/>";
	echo "<table rules=\"all\" border=\"1px\" style=\"width: 100%; border-color: #FFFFFF\">";
  	echo "<tr><td><label for='Customer'>Kunde:</label></t:>";
      	echo "<td><textarea Cols=\"100\" rows=\"5\" name='Customer' id='Customer'></textarea></td></tr>";
  	echo "<tr><td><label for='ProjectDescription'>Projektbeschreibung:</label></t:>";
      	echo "<td><textarea Cols=\"100\" rows=\"25\" name='ProjectDescription' id='ProjectDescription'></textarea></td></tr>";
       	echo "<tr><td><label for='Responsible'>Projektverantwortlicher:</label></td>";
  	echo "<td><select multiple name=\"Responsible\" size=\"1\">";
	for ($i = 1; $i < count($users) + 1; $i++)
	{
		echo "<option value=\"" . $i . "\">" . $users[$i] . "</option>";
	}
	echo "</select></td></tr>";
  	echo "<tr><td><label for='ProjectDeadline'>Termin:</label></t:>";
      	echo "<td><input type='date' name='ProjectDeadline' id='ProjectDeadline'  maxlength=\"50\" /></td></tr>";
    	echo "<tr><td>&nbsp;</td><td><input type='submit' name='Submit' value='Submit' /></td>";
  	echo "</tr>";
	echo "</form>";
	echo "</table>";
}
?>
</body>
</html>
