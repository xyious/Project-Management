<?php
session_start();
if (!isset($_SESSION['IP'])) {	$_SESSION['IP'] = $_SERVER['REMOTE_ADDR']; }
if (!isset($_SESSION['Logged_In'])) { $_SESSION['Logged_In'] = 0; }
?>
<!doctype html>
<head>
<title>Login</title>
<link rel="stylesheet" href="include/body.css" type="text/css">
</head>
<body>
<?php
include "include/PDOConnect.php";
include "include/pbkdf2.php";

if (!($_SESSION['Logged_In'] && ($_SESSION['IP'] == $_SERVER['REMOTE_ADDR']))) {
	$NeedLogin = 1;
	if ($_POST['username']) {
		if ($_POST['password']) {
			$Username = trim($_POST['username']);
			$Password = trim($_POST['password']);
			$Hash = create_hash($Password, $Username);
//			echo $Hash;
			$query = $connection->prepare("SELECT ID, password FROM users WHERE Username = :Username");
			$query->bindParam(':Username', $Username, PDO::PARAM_STR);
			$query->execute();
			if ($query->rowCount() != 0) {
				$row = $query->fetch();
				if (validate_password($Password, $row['password'])) {
					$NeedLogin = 0;
					$_SESSION['Logged_In'] = 1;
					$_SESSION['user_id'] = $row['ID'];
					echo "Sie sind jetzt eingeloggt!<br>";
					echo "<a href='" . $_GET['previous'] . "'>Vorherige Seite</a>";
				} else {
					echo "Falscher Benutzername oder Passwort!";
				}
			}
		}
	}
} else {
	echo "Sie sind bereits eingeloggt, <a href='/Project/Logout.php'>ausloggen</a> ?";
}
if ($NeedLogin) {
	include "include/LoginForm.php";
}
?>
</body>
</html>
