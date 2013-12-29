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
?>

<?php
// user comes from good background; proceed
$userid = $_COOKIE['basket_id'];
//find the user's name
$name = user_name($userid);
global $name;
$access_level2 = access_level("$userid");
//ask for school code and all

if ((!isset($_GET['school'])) && (($access_level2 == 0) || ($access_level2 == 1) || ($access_level2 == 2) || ($access_level2 == 3))){
	echo "<font face='Arial' size='2'>";
	echo "Please enter the school code below!";
	echo "<br /><br />";
	echo "<form name='school_code' method='get' action='department.php'>";
	echo "<input type='hidden' name='dept' value='student' />";
	echo "<input type='hidden' name='task' value='edit' />";
	echo "<input type='text' name='school' maxlength='3' size='3' />";
	echo "<br /><br /><input type='submit' value='Enter' />";
	echo "</form>";

}

else {

	if ($access_level2 == 4){
	$school = username20($userid);
	}
	else {
	$school = $_GET['school'];
	}
$data_status = data_empty($school);
$correct_chars = anka_matra($school);


if (($data_status == true) || ($correct_chars == false)){
	die ("Invalid character or empty code enterred!");
}
else {
require ("../connection.php");
// create query
$query = "SELECT * FROM marks WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
if (mysql_num_rows($result) >= 1) {

echo "<font face='Arial' size='2' color='brown'><strong>We're editing students " . $name . "!</strong></font>";
echo "<br /><br />";

echo "<strong><u>School Code:</u></strong> <font color='#A80000'>$school</font><br /> ";
echo "<strong><u>School:</u></strong> <font color='#A80000'>" . school_name($school) . "</font><br /> ";
echo "<strong><u>Address:</u></strong> <font color='#A80000'>". school_address($school) . "</font><br /> <br />";


echo "<form name='edit_student' action='edit.php' method='post' />";
?>
<table border="0">
  <tr bgcolor="#828282">
    <th width="126" scope="col"><font color="white">Symbol No.</font> </th>
    <th width="264" scope="col"><font color="white">Name</font></th>
	<th scope="col"><font color="white">DOB</font><br /><font face="Arial" size="1" color="white">(YY|MM|DD)</font></th>
    <th width="107" scope="col"><font color="white">Optional I</font> </th>
    <th width="139" scope="col"><font color="white">Optional II</font> </th>
  </tr>
  <?php

$p = 1;
while ($p <= mysql_num_rows($result)){
$row = mysql_fetch_assoc($result);
$sym[$p] = $row['symbol_no'];
$naam[$p] = $row['name'];
$dob[$p] = $row['dob'];
$opti[$p] = $row['opti_choice'];
$optii[$p] = $row['optii_choice'];
$dob1[$p] = substr($dob[$p], 0, 2);
$dob2[$p] = substr($dob[$p], 3, 2);
$dob3[$p] = substr($dob[$p], 6, 2);
if (($p % 2) == 0){
echo "<tr bgcolor='F7F7F7'>";
echo "<td>" . $sym[$p] . "<input type='hidden' name='old_sym_$p' value='$sym[$p]' /></td>";
echo "<td><input type='text' name='naam_$p' value='$naam[$p]' size='40' maxlength='40' style='background:#F7F7F7;' /></td>";
echo "<td align='center' bgcolor='#F7F7F7'><input type='text' size='1' maxlength='2' value = $dob1[$p] name='dob1_$p' style='background:#F7F7F7;' /><input type='text' size='1' maxlength='2' name='dob2_$p' value = $dob2[$p] style='background:#F7F7F7;' /><input type='text' size='1' maxlength='2' name='dob3_$p' value = $dob3[$p] style='background:#F7F7F7;' /></td>";
echo "<td>
<select name='opti_$p' style='background:#F7F7F7;'>
			<option value=''></option>";

if ($opti[$p] == "OI01"){
echo "<option value='OI01' selected='selected'>Mathematics</option>";
}
else {
echo "<option value='OI01'>Mathematics</option>\n";
} 
if ($opti[$p] == "OI02"){
echo "<option value='OI02' selected='selected'>Population</option>\n";
}
else {
echo "<option value='OI02'>Population</option>\n";
}

if ($opti[$p] == "OI03"){
echo "<option value='OI03' selected='selected'>Environment Science</option>\n";
}
else {
echo "<option value='OI03'>Environment Science</option>\n";
}
if ($opti[$p] == "OI04"){
echo "<option value='OI04' selected='selected'>English</option>\n";
}
else {
echo "<option value='OI04'>English</option>\n";
}
if ($opti[$p] == "OI05"){
echo "<option value='OI05' selected='selected'>Geography</option>\n";
}
else {
echo "<option value='OI05'>Geography</option>\n";
}
if ($opti[$p] == "OI06"){
echo "<option value='OI06' selected='selected'>Economics</option>\n";
}
else {
echo "<option value='OI06'>Economics</option>\n";
}
echo "
</select>\n
</td>";
echo "<td>
<select name='optii_$p' style='background:#F7F7F7;'>
			<option value=''></option>\n";

if ($optii[$p] == "OII01"){
echo "<option value='OII01' selected='selected'>Health & Physical Education</option>\n";
}
else {
echo "<option value='OII01'>Health & Physical Education</option>\n";
} 
if ($optii[$p] == "OII02"){
echo "<option value='OII02' selected='selected'>Office Mgmt. & Accounts</option>\n";
}
else {
echo "<option value='OII02'>Office Mgmt. & Accounts</option>\n";
}

if ($optii[$p] == "OII03"){
echo "<option value='OII03' selected='selected'>Agriculture</option>\n";
}
else {
echo "<option value='OII03'>Agriculture</option>\n";
}
if ($optii[$p] == "OII04"){
echo "<option value='OII04' selected='selected'>Journalism</option>\n";
}
else {
echo "<option value='OII04'>Journalism</option>\n";
}
if ($optii[$p] == "OII05"){
echo "<option value='OII05' selected='selected'>Computer Science</option>\n";
}
else {
echo "<option value='OII05'>Computer Science</option>\n";
}
echo "
</select>
</td>";
echo "</tr>";
}
else {
echo "<tr bgcolor='B1B1B1'>";
echo "<td>" . $sym[$p] . "<input type='hidden' name='old_sym_$p' value='$sym[$p]' /></td>";
echo "<td><input type='text' name='naam_$p' value='$naam[$p]' size='40' maxlength='40' style='background:#B1B1B1;' /></td>";
echo "<td align='center' bgcolor='#B1B1B1'><input type='text' size='1' maxlength='2' value = $dob1[$p] name='dob1_$p' style='background:#B1B1B1;' /><input type='text' size='1' maxlength='2' name='dob2_$p' value = $dob2[$p] style='background:#B1B1B1;' /><input type='text' size='1' maxlength='2' name='dob3_$p' value = $dob3[$p] style='background:#B1B1B1;' /></td>";

echo "<td>
<select name='opti_$p' style='background:#B1B1B1;'>
			<option value=''></option>";

if ($opti[$p] == "OI01"){
echo "<option value='OI01' selected='selected'>Mathematics</option>";
}
else {
echo "<option value='OI01'>Mathematics</option>\n";
} 
if ($opti[$p] == "OI02"){
echo "<option value='OI02' selected='selected'>Population</option>\n";
}
else {
echo "<option value='OI02'>Population</option>\n";
}

if ($opti[$p] == "OI03"){
echo "<option value='OI03' selected='selected'>Environment Science</option>\n";
}
else {
echo "<option value='OI03'>Environment Science</option>\n";
}
if ($opti[$p] == "OI04"){
echo "<option value='OI04' selected='selected'>English</option>\n";
}
else {
echo "<option value='OI04'>English</option>\n";
}
if ($opti[$p] == "OI05"){
echo "<option value='OI05' selected='selected'>Geography</option>\n";
}
else {
echo "<option value='OI05'>Geography</option>\n";
}
if ($opti[$p] == "OI06"){
echo "<option value='OI06' selected='selected'>Economics</option>\n";
}
else {
echo "<option value='OI06'>Economics</option>\n";
}
echo "
</select>\n
</td>";






echo "<td>
<select name='optii_$p' style='background:#B1B1B1;'>
			<option value=''></option>";

if ($optii[$p] == "OII01"){
echo "<option value='OII01' selected='selected'>Health & Physical Education</option>";
}
else {
echo "<option value='OII01'>Health & Physical Education</option>\n";
} 
if ($optii[$p] == "OII02"){
echo "<option value='OII02' selected='selected'>Office Mgmt. & Accounts</option>\n";
}
else {
echo "<option value='OII02'>Office Mgmt. & Accounts</option>\n";
}

if ($optii[$p] == "OII03"){
echo "<option value='OII03' selected='selected'>Agriculture</option>\n";
}
else {
echo "<option value='OII03'>Agriculture</option>\n";
}
if ($optii[$p] == "OII04"){
echo "<option value='OII04' selected='selected'>Journalism</option>\n";
}
else {
echo "<option value='OII04'>Journalism</option>\n";
}
if ($optii[$p] == "OII05"){
echo "<option value='OII05' selected='selected'>Computer Science</option>\n";
}
else {
echo "<option value='OII05'>Computer Science</option>\n";
}
echo "
</select>\n
</td>";
echo "</tr>";


}






$no = $p;
$p++;
}
echo "</table>";
echo "<br />";
echo "<input type='hidden' name='bulbul' value='1' />";
echo "<input type='hidden' name='no' value='$no' />";
echo "<input type='hidden' name='school' value='$school' />";
echo "<input type='hidden' name='dept' value='student' />";
echo "<input type='submit' value='Save' />";
echo "<input type='reset' />";




}
else {
die ("Invalid school code enterred!");
}


}
?>


<?php
}
}
}
?>