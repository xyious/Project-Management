<?php

$host="localhost";

$root="root";
$root_password="winshit";
$user='Projectadmin';
$pass='ProjAdmin!';

$db="ProjectManagement";

    try {
        $dbh = new PDO("mysql:host=$host", $root, $root_password);

        $dbh->exec("CREATE DATABASE `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;") 
        or die(print_r($db->errorInfo(), true));

    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }

echo "Database creation successful !";
?>
