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

//ask for school code and all

if (!isset($_GET['school'])){
	echo "<font face='Arial' size='2'>";
	echo "Please enter the school code below!";
	echo "<br /><br />";
	echo "<form name='school_code' method='get' action='department.php'>";
	echo "<input type='hidden' name='dept' value='school' />";
	echo "<input type='hidden' name='task' value='edit' />";
	echo "<input type='text' name='school' maxlength='3' size='3' />";
	echo "<br /><br /><input type='submit' value='Enter' />";
	echo "</form>";

}

else {

// school edit layout/forehand

$school  = $_GET['school'];
$data_status = data_empty($school);
$correct_chars = anka_matra($school);


if (($data_status == true) || ($correct_chars == false)){
	die ("Invalide characres or empty code enterred!");
}
else {
require("../connection.php");
// create query
$query = "SELECT * FROM schools WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$naam = $row['name'];
$address = $row['address'];

echo "<font face='Arial' size='2' color='brown'><strong>We're editing schools " . $name . "!</font>";
echo "<br /><br />";
?>
<form name='edit_school' action='edit.php' method='post'>
<table width="347" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="92"><font face="Arial" size="2">School Code:</font></td>
    <td width="98"><input name="newschool_code" type="text" size="3" maxlength="3" value="<?php echo $school;?>"></td>
  </tr>
  <tr>
    <td><font face="Arial" size="2">Name:</font></td>
    <td><input name="name" type="text" size="40" maxlength="50" value="<?php echo $naam;?>"></td>
  </tr>
  <tr>
    <td><font face="Arial" size="2">Address:</font></td>
    <td><input name="address" type="text" size="30" maxlength="40" value="<?php echo $address;?>"></td>
  </tr>
</table>
<br />
<input type="submit" value="Save" />&nbsp;&nbsp;
<input type="Reset" />
<?php
echo "<input type='hidden' name='school_code' value='$school' />";
?>
<input type="hidden" name="bulbul" value="1" />
<input type="hidden" name="dept" value="school" />
</form>
<?php



}
else{
die("ERROR: INVALID SCHOOL CODE!");
}



}
}

?>
<?php
}
}
?>


