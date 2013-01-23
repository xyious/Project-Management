<?php
	$dsn = 'mysql:host=localhost;dbname=ProjectManagement';
	$connection = new PDO($dsn, 'Projectadmin', 'ProjAdmin!');
	$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$connection->setAttribute(PDO::ATTR_PERSISTENT, true);
?>
