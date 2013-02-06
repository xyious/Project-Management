<?php
session_start();
if (!isset($_SESSION['IP'])) {  $_SESSION['IP'] = $_SERVER['REMOTE_ADDR']; $_SESSION['Logged_In'] = 0;}
?>
<!doctype html>
<html>
<head>
<title>Arbeitspaket Details</title>
<link rel="stylesheet" href="include/body.css" type="text/css">
</head>
<body>
<h2>Bisherige Buchungen:</h2>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr>
    <th>Buchungsdatum</th>
    <th>Beschreibung der Tätigkeiten</th>
    <th>Mitarbeiter</th>
  </tr>
<?php
include "include/PDOConnect.php";
$query = $connection->prepare("SELECT * FROM hours_worked INNER JOIN users on hours_worked.user_id = users.ID WHERE workunit_id = :id");
$query->bindParam(':id', $_GET['ID'], PDO::PARAM_STR);
$query->execute();
for ($i = 0; $i < $query->rowCount(); $i++)
{
	$row = $query->fetch();
		$WUTable .= "<tr><td>" . $row['creation'] . "</td>";
		$WUTable .= "<td><a href='WUDetails.php?id=" . $row['ID'] . "'>" . $row['description'] . "</a></td>";
		$WUTable .= "<td>" . $assignment_row['displayname'] . "</td>";
		$WUTable .= "<td>" . $row['deadline'] . "</td></tr>";
}
echo $WUTable . "</table>";
?>
<br>
<br>
<h2>Zeiten Buchen:</h2>
<form id='CreateWorkUnit' action='/Project/CreateWorkUnit.php' method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<input type='hidden' name='Workunit_ID' id='Project_ID' value=<?php echo "'" . $_GET["id"] . "'"; ?>/>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr><td><label for='Activity'>Tätigkeitsbeschreibung:</label></td>
      <td><textarea Cols="100" rows="25" name='Activity' id='Activity'></textarea></td></tr>
  <tr><td><label for='Hours'>Gearbeitete Zeit:</label></td>
      <td><input type='text' name='hours' id='hours'  maxlength="5" />
        <input type='text' name='minutes' id='minutes'  maxlength="5" /></td></tr>
  <tr><td><label for='Bhours'>Fakturierbare Zeit:</label></td>
      <td><input type='text' name='Bhours' id='Bhours'  maxlength="5"/>
        <input type='text' name='Bminutes' id='Bminutes'  maxlength="5"/></td></tr>
    <tr><td>&nbsp;</td><td><input type='submit' name='Submit' value='Submit' /></td>
  </tr>
</form>
</table>
</html>
