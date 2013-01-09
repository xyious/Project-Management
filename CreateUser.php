<?php
session_start();
if (!isset($_SESSION['IP'])) {	$_SESSION['IP'] = $_SERVER['REMOTE_ADDR']; }
if (!isset($_SESSION['Logged_In'])) { $_SESSION['Logged_In'] = 0; }
?>
<!doctype html>
<head>
<title>Neuen Benutzer Erstellen</title>
<link rel="stylesheet" href="include/body.css" type="text/css">
</head>
<body>
<?php
include "include/PDOConnect.php";
include "include/PBKDF2.php";

$Error = 1;
if (isset($_POST['submitted']) && $_POST['submitted'] == 1) {
	$Error = 0;
	if (!($_SESSION['Logged_In'] && ($_SESSION['IP'] == $_SERVER['REMOTE_ADDR']))) {
		echo "Sie sind nicht eingeloggt!<br><a href='/Project/Login.php?previous=" . $_SERVER['PHP_SELF'] . "'>Login</a>";
	} else {
		if (!(preg_match("/^[a-zA-Z]/", $_POST['Username']) == 1)) {
			echo "Benutzername muss mit Buchstaben anfangen!<br>";
			$Error++;
		}
		if (!(preg_match("/[a-zA-Z]/", $_POST['Displayname']) == 1)) {
			echo "Name muss Text sein!<br>";
			$Error++;
		}
		if ($Error == 0) {
			$Password = create_hash($_POST['Password'], $_POST['Username']);
			$query = $connection->prepare("INSERT INTO users (username, displayname, email, password) VALUES (:username, :displayname, :email, :password)");
			$query->bindParam(':username', $_POST['Username'], PDO::PARAM_STR);
			$query->bindParam(':displayname', $_POST['Displayname'], PDO::PARAM_STR);
			$query->bindParam(':email', $_POST['Email'], PDO::PARAM_STR);
			$query->bindParam(':password', $Password, PDO::PARAM_STR);
			$query->execute();
			if ($connection->lastInsertId() > 0) {
				echo "Projekt wurde erstellt, Kunde: " . $_POST['Customer'] . "<br>Beschreibung: " . $_POST['ProjectDescription'] . "<br>Termin: " . $_POST['ProjectDeadline'] . "<br>";
			}
		}
	}
}
if ($Error > 0) {
	include "include/CreateUserForm.php";
}
?>
</body>
</html>
