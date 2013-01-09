<?php
session_start();
if (!isset($_SESSION['IP'])) {	$_SESSION['IP'] = $_SERVER['REMOTE_ADDR']; }
if (!isset($_SESSION['Logged_In'])) { $_SESSION['Logged_In'] = 0; }
?>
<!doctype html>
<head>
<title>Neues Projekt Erstellen</title>
<link rel="stylesheet" href="include/body.css" type="text/css">
</head>
<body>
<?php
include "include/PDOConnect.php";

$Error = 1;
if (isset($_POST['submitted']) && $_POST['submitted'] == 1) {
	$Error = 0;
	if (!($_SESSION['Logged_In'] && ($_SESSION['IP'] == $_SERVER['REMOTE_ADDR']))) {
		echo "Sie sind nicht eingeloggt!<br><a href='/Project/Login.php?previous=" . $_SERVER['PHP_SELF'] . "'>Login</a>";
	} else {
			if (!(preg_match("/[0-9]/", $_POST['Estimate']) == 1)) {
			echo "Aufwand muss Zahlen enthalten (Anzahl Stunden)!<br>";
			$Error++;
		}
		if (!(preg_match("/[a-zA-Z0-9]/", $_POST['WUDescription']) == 1)) {
			echo "Arbeitspaketbeschreibung muss text sein!<br>";
			$Error++;
		}
		if ($Error == 0) {
			$query = $connection->prepare("INSERT INTO workunits (project_id, deadline, description, estimated_hours, status, type) VALUES (:project_id, :deadline, :description, :estimate, -1, 1)");
			$query->bindParam(':project_id', $_POST['Project_ID'], PDO::PARAM_STR);
			$query->bindParam(':deadline', $_POST['WUDeadline'], PDO::PARAM_STR);
			$query->bindParam(':description', $_POST['WUDescription'], PDO::PARAM_STR);
			$query->bindParam(':estimate', $_POST['Estimate'], PDO::PARAM_STR);
			$query->execute();
			if ($connection->lastInsertId() > 0) {
				echo "Arbeitspaket wurde erstellt, Project ID: " . $_POST['Project_ID'] . "<br>Beschreibung: " . $_POST['WUDescription'] . "<br>Termin: " . $_POST['WUDeadline'] . "<br>";
			}
		}
	}
}
if ($Error > 0) {
	include "include/CreateWorkUnitForm.php";
}
?>
</body>
</html>
