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
		if (!(preg_match("/[a-zA-Z0-9]/", $_POST['Customer']) == 1)) {
			echo "Kunde muss Zahlen oder Buchstaben enthalten!<br>";
			$Error++;
		}
		if (!(preg_match("/[a-zA-Z0-9]/", $_POST['ProjectDescription']) == 1)) {
			echo "Projektbeschreibung muss text sein!<br>";
			$Error++;
		}
		if ($Error == 0) {
			$query = $connection->prepare("INSERT INTO project (status, deadline, customer, description) VALUES (1, :deadline, :customer, :description)");
			$query->bindParam(':deadline', $_POST['ProjectDeadline'], PDO::PARAM_STR);
			$query->bindParam(':customer', $_POST['Customer'], PDO::PARAM_STR);
			$query->bindParam(':description', $_POST['ProjectDescription'], PDO::PARAM_STR);
			$query->execute();
			if ($connection->lastInsertId() > 0) {
				echo "Projekt wurde erstellt, Kunde: " . $_POST['Customer'] . "<br>Beschreibung: " . $_POST['ProjectDescription'] . "<br>Termin: " . $_POST['ProjectDeadline'] . "<br>";
			}
		}
	}
}
if ($Error > 0) {
	include "include/CreateProjectForm.php";
}
?>
</body>
</html>
