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
if (($_SESSION['Logged_In'] && ($_SESSION['IP'] == $_SERVER['REMOTE_ADDR']))) {
        $NeedLogin = 1;
	$_SESSION['Logged_In'] = 0;
	echo "Sie sind jetzt ausgeloggt.";
} else {
	echo "Sie waren bereits ausgeloggt.";
}
include "include/LoginForm.php";
?>
</body>
</html>
