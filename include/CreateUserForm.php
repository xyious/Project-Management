<h1>Neuen Benutzer Anlegen:</h1>
<form id='CreateUser' action='/Project/CreateUser.php' method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr><td><label for='Username'>Benutzername:</label></td>
      <td><input type='text' name='Username' id='Username'  maxlength="50" /></td></tr>
  <tr><td><label for='Displayname'>Name:</label></td>
      <td><input type='text' name='Displayname' id='Displayname'  maxlength="50" /></td></tr>
  <tr><td><label for='Email'>Email:</label></td>
      <td><input type='text' name='Email' id='Email'  maxlength="50" /></td></tr>
  <tr><td><label for='Password'>Passwort:</label></td>
      <td><input type='text' name='Password' id='Password'  maxlength="50" /></td></tr>
    <tr><td>&nbsp;</td><td><input type='submit' name='Submit' value='Submit' /></td>
  </tr>
</form>
</table>
