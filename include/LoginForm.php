<form id='login' action=<?php echo "'" . $_SERVER['QUERY_STRING']. "'"; ?> method='post' accept-charset='UTF-8'>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<input type='hidden' name='previous' id='previous' value=<?php echo "'" . $_GET['previous']. "'"; ?>/>
<table rules="all" border="1px" style="width: 100%; border-color: #FFFFFF">
  <tr><td><label for='username' >Benutzername:</label></t:>
      <td><input type='text' name='username' id='username'  maxlength="50" /></td></tr>
    <tr><td><label for='password' >Passwort:</label></td>
      <td><input type='password' name='password' id='password' maxlength="50" /></td></tr>
    <tr><td>&nbsp;</td><td><input type='submit' name='Submit' value='Submit' /></td>
  </tr>
</form>
</table>
