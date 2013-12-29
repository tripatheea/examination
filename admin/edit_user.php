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

//ask for username and all

if (!isset($_GET['username'])){
	echo "<font face='Arial' size='2'>";
	echo "Please enter the username below!";
	echo "<br /><br />";
	echo "<form name='school_code' method='get' action='department.php'>";
	echo "<input type='hidden' name='dept' value='user' />";
	echo "<input type='hidden' name='task' value='edit' />";
	echo "<input type='text' name='username' maxlength='20' size='15' />";
	echo "<br /><br /><input type='submit' value='Enter' />";
	echo "</form>";

}

else {

// user edit layout/forehand

$user123  = $_GET['username'];
$data_status = data_empty($user123);
$correct_chars = correct_characters($user123);


if (($data_status == true) || ($correct_chars == false)){
	die ("Invalid character or empty code enterred!");
}
else {
require("../connection.php");
// create query
$query = "SELECT * FROM users WHERE username = '$user123' AND access_level > 0";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$naam123 = $row['name'];
$user987 = $row['username'];
$lock567 = $row['locked'];
echo "<font face='Arial' size='2' color='brown'><strong>We're editing schools " . $name . "!</font>";
echo "<br /><br />";
?>
<form name='edit_school' action='edit.php' method='post'>
<table width="347" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="92"><font face="Arial" size="2">Name:</font></td>
    <td width="98"><input name="name" type="text" id="name" value="<?php echo $naam123;?>" size="20" maxlength="30"></td>
  </tr>
  <tr>
    <td><font face="Arial" size="2">Username:</font></td>
    <td><?php echo $user987;?></td>
  </tr>
  <tr>
    <td><font face="Arial" size="2">Password:</font></td>
    <td><input name="password" type="password" size="30" maxlength="40" id="password"></td>
  </tr>
  <tr>
    <td><font face="Arial" size="2">Lock User:</font></td>
    <td>
	
	
	<?php
	if ($lock567 == "0") {
	echo "<input type='checkbox' name='lockuser' />";
	}
	else{
	echo "<input type='checkbox' name='lockuser' checked=true />";
	}
	?>
	</td>
  </tr>
</table>
<br />
<input type="submit" value="Save" />&nbsp;&nbsp;
<input type="Reset" />
<?php
echo "<input type='hidden' name='userko' value='$user987' />";
?>
<input type="hidden" name="bulbul" value="1" />
<input type="hidden" name="dept" value="user" />
</form>
<?php



}
else{
die("ERROR: Invalid Username Enterred! Please hit the Back key of your browser to go back!");
}



}
}

?>
<?php
}
}
?>


