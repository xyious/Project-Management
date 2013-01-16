<form id='CreateWorkUnit' action='/Project/CreateWorkUnit.php' method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<input type='hidden' name='Project_ID' id='Project_ID' value='$_GET["Project_ID"]'/>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr><td><label for='WUDescription'>Arbeitspaketbeschreibung:</label></td>
      <td><textarea Cols="100" rows="25" name='WUDescription' id='WUDescription'></textarea></td></tr>
  <tr><td><label for='Responsible'>Arbeitspaket Verantwortlicher:</label></td>
      <td><select name="Responsible" multiple>
<?php 
echo "test";
include "PDOConnect.php";
$query=$connection->prepare("Select ID, displayname FROM users");
for ($i = 0; $i < $query->rowCount(); $i++)
{
  echo "test1";
  $row = $query->fetch();
  echo "<option value=\"" . $row['ID'] . "\">" . $row['displayname'] . "</option>";
}
?>
      </select></td></tr>
  <tr><td><label for='WUDeadline'>Termin:</label></td>
      <td><input type='date' name='WUDeadline' id='WUDeadline'  maxlength="50" /></td></tr>
  <tr><td><label for='Estimate'>Voraussichtlicher Aufwand (Stunden):</label></td>
      <td><input type='text' name='Estimate' id='Estimate'  maxlength="50" /></td></tr>
    <tr><td>&nbsp;</td><td><input type='submit' name='Submit' value='Submit' /></td>
  </tr>
</form>
</table>
