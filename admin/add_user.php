<?php


if (!isset($anappleinabasket)){
require("func_library.php");
}

user_logged_on();



if (!isset($bulbul)){
	die ("Unauthorized access!");
}
else {

if ($bulbul == 1){
// user comes from good background; proceed
$userid = $_COOKIE['basket_id'];
//find the user's name

$name = user_name($userid);
global $name;




// user addition layout/forehand
echo "<font face='Arial' size='2' color='brown'><strong>We're adding users " . $name . "!</font>";
echo "<br /><br />";
echo "<form name='user_add' action='add.php' method='post'>";
echo "<table cellspacing='0' cellpadding='5' border='0'>";
echo "<tr>";
echo "<td><font face='Arial' size='2'><strong>Name:</strong></font></td><td><input type='text' size='30' maxlength='30' name='name' /></td></tr>";
echo "<td><font face='Arial' size='2'><strong>Username:</strong></font></td><td><input type='text' size='10' maxlength='20' name='username' /></td></tr>";
echo "<td><font face='Arial' size='2'><strong>Password:</strong></font></td><td><input type='password' size='10' maxlength='10' name='password' /></td></tr>";
echo "<td><font face='Arial' size='2'><strong>Privelages:</strong></font></td>";
echo "
<td>
<select name='privelages'>
<option name=''></option>

<option name='school' onClick=\"
document.user_add.CMP01.checked=false; document.user_add.CMP01.disabled=false;
document.user_add.CMP02.checked=false; document.user_add.CMP02.disabled=false;
document.user_add.CMP03.checked=false; document.user_add.CMP03.disabled=false;
document.user_add.CMP04.checked=false; document.user_add.CMP04.disabled=false;
document.user_add.CMP05.checked=false; document.user_add.CMP05.disabled=false;
document.user_add.CMP06.checked=false; document.user_add.CMP06.disabled=false;
document.user_add.OPTI.checked=false; document.user_add.OPTI.disabled=false;
document.user_add.OPTII.checked=false; document.user_add.OPTII.disabled=false;
document.user_add.pra.checked=true; document.user_add.pra.disabled=false;\">School</option>
<option name='data_manager_limited' onClick=\"
document.user_add.CMP01.checked=false; document.user_add.CMP01.disabled=false;
document.user_add.CMP02.checked=false; document.user_add.CMP02.disabled=false;
document.user_add.CMP03.checked=false; document.user_add.CMP03.disabled=false;
document.user_add.CMP04.checked=false; document.user_add.CMP04.disabled=false;
document.user_add.CMP05.checked=false; document.user_add.CMP05.disabled=false;
document.user_add.CMP06.checked=false; document.user_add.CMP06.disabled=false;
document.user_add.OPTI.checked=false; document.user_add.OPTI.disabled=false;
document.user_add.OPTII.checked=false; document.user_add.OPTII.disabled=false;
document.user_add.pra.checked=false; document.user_add.pra.disabled=false;\">Data Manager(Limited)</option>
<option name='data_manager' onClick=\"
document.user_add.CMP01.checked=true; document.user_add.CMP01.disabled=true;
document.user_add.CMP02.checked=true; document.user_add.CMP02.disabled=true;
document.user_add.CMP03.checked=true; document.user_add.CMP03.disabled=true;
document.user_add.CMP04.checked=true; document.user_add.CMP04.disabled=true;
document.user_add.CMP05.checked=true; document.user_add.CMP05.disabled=true;
document.user_add.CMP06.checked=true; document.user_add.CMP06.disabled=true;
document.user_add.OPTI.checked=true; document.user_add.OPTI.disabled=true;
document.user_add.OPTII.checked=true; document.user_add.OPTII.disabled=true;
document.user_add.pra.checked=true; document.user_add.pra.disabled=true;\">Data Manager</option>

<option name='admin' onClick=\"
document.user_add.CMP01.checked=true; document.user_add.CMP01.disabled=true;
document.user_add.CMP02.checked=true; document.user_add.CMP02.disabled=true;
document.user_add.CMP03.checked=true; document.user_add.CMP03.disabled=true;
document.user_add.CMP04.checked=true; document.user_add.CMP04.disabled=true;
document.user_add.CMP05.checked=true; document.user_add.CMP05.disabled=true;
document.user_add.CMP06.checked=true; document.user_add.CMP06.disabled=true;
document.user_add.OPTI.checked=true; document.user_add.OPTI.disabled=true;
document.user_add.OPTII.checked=true; document.user_add.OPTII.disabled=true;
document.user_add.pra.checked=true; document.user_add.pra.disabled=true;\">Administrator</option></td></tr>";


echo "<tr><td valign='top'><font face='Arial' size='2'><strong>Subjects:</strong></font></td><td>
<font face='Arial' size='2'>
<input type='checkbox' name='CMP01'>English<br />
<input type='checkbox' name='CMP02'>Nepali<br />
<input type='checkbox' name='CMP03'>Mathematics<br />
<input type='checkbox' name='CMP04'>Science<br />
<input type='checkbox' name='CMP05'>Social Studies<br />
<input type='checkbox' name='CMP06'>Health, Population and Environment<br />
<input type='checkbox' name='OPTI'>Optional I<br />
<input type='checkbox' name='OPTII'>Optional II<br />
<input type='checkbox' name='pra'><strong>Practicals</strong><br />
</font>
</td></tr>";

echo "<tr><td>&nbsp;</td>";
echo "<td><input type='submit' value='Create' />&nbsp; <input type='reset' /></td>";
echo "</table>";
echo "<input type='hidden' name='bulbul' value='1' />";
echo "<input type='hidden' name='dept' value='user' />";
echo "</form>";
?>

<?php
}
}

?>






