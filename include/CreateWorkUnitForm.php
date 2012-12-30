<form id='CreateProject' action='/Project/CreateWorkUnit.php' method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr><td><label for='Customer'>Kunde:</label></t:>
      <td><textarea Cols="100" rows="5" name='Customer' id='Customer'></textarea></td></tr>
  <tr><td><label for='ProjectDescription'>Projektbeschreibung:</label></t:>
      <td><textarea Cols="100" rows="25" name='ProjectDescription' id='ProjectDescription'></textarea></td></tr>
  <tr><td><label for='ProjectDeadline'>Termin:</label></t:>
      <td><input type='date' name='ProjectDeadline' id='ProjectDeadline'  maxlength="50" /></td></tr>
    <tr><td>&nbsp;</td><td><input type='submit' name='Submit' value='Submit' /></td>
  </tr>
</form>
</table>
