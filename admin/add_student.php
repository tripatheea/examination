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


// student addition layout/forehand
$access_level2 = access_level("$userid");

//ask for school code and all

if ((!isset($_GET['school'])) && (($access_level2 == 0) || ($access_level2 == 1) || ($access_level2 == 2) || ($access_level2 == 3))){
	echo "<font face='Arial' size='2'>";
	echo "Please enter the school code below!";
	echo "<br /><br />";
	echo "<form name='student_code' method='get' action='department.php'>";
	echo "<input type='hidden' name='dept' value='student' />";
	echo "<input type='hidden' name='task' value='add' />";
	echo "<input type='text' name='school' maxlength='3' size='3' />";
	echo "<br /><br /><input type='submit' value='Enter' />";
	echo "</form>";

}

else {



if (!isset($_POST['no_of_students'])){
$skool = $_GET['school'];
echo "<font face='Arial' size='2'>How many rows to you wish to have(no. of students to enter)?<br /><br /></font>";
echo "<form action='department.php?dept=student&task=add&school=$skool' method ='post'>";
echo "<input type='text' name='no_of_students' size='1' maxlength='2' />&nbsp;";
die ("<input type='Submit' value='Proceed' />");
}
else {
$no_of_students123 = $_POST['no_of_students'];

if (anka_matra($no_of_students123) == false){
	die("Please enter a no. and not something else!");
}

	if ($access_level2 == 4){
	$school_code = username20($userid);
	}
	else {
	$school_code = $_GET['school'];
	}

$data_status = data_empty($school_code);
$correct_chars = anka_matra($school_code);


if (($data_status == true) || ($correct_chars == false)){
	die ("Invalid character or empty code enterred!");
}
else {






require("../connection.php");
// create query
$query = "SELECT * FROM schools WHERE school_code = $school_code";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$school_name = $row['name'];
$school_address = $row['address'];
}
else
{
die ('<b>Invalid school code entered!</b>');
}
// free result set memory
mysql_free_result($result);



echo "<strong><u>School Code:</u></strong> <font color='#A80000'>$school_code</font><br /> ";
echo "<strong><u>School:</u></strong> <font color='#A80000'>$school_name</font><br /> ";
echo "<strong><u>Address:</u></strong> <font color='#A80000'>$school_address</font><br /> <br />";


?>
    <form action="add.php" method="post" name="students_enter">
<table border="0">
  <tr bgcolor="#828282">
    <th width="126" scope="col"><font color="white">Symbol No.</font> </th>
    <th width="264" scope="col"><font color="white">Name</font></th>
	<th scope="col"><font color="white">DOB</font><br /><font face="Arial" size="1" color="white">(YY|MM|DD)</font></th>
    <th width="107" scope="col"><font color="white">Optional I</font> </th>
    <th width="139" scope="col"><font color="white">Optional II</font> </th>
  </tr>

		<?php
    
    //assembly of symbol no.
	
// create query
$query = "SELECT * FROM settings WHERE field = 'Year'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$row = mysql_fetch_assoc($result);
$year = $row['value'];
// free result set memory
mysql_free_result($result);


	
$year = substr( $year, - 2 );
	
	

	// end of assembly
    
	$count = 0; //count=count of symbol no.
	
	?>
	
	
	<?php
	//find the value of i from the database
	$current_sym = array();
	// create query
	$query = "SELECT * FROM marks WHERE school_code = '$school_code'";
	// execute querys
	$result = mysql_query($query) or die ("Error in query: $query.
	" . mysql_error());
	if (mysql_num_rows($result) >= 1){
	$p = 1;
	while ($p <= mysql_num_rows($result)){
	$row = mysql_fetch_assoc($result);
	$current_sym[$p] = substr(($row['symbol_no']), -4 , 3);
	$max_no = $p;
	$p++;
	}
	// free result set memory
	mysql_free_result($result);
	rsort($current_sym);
	$i = $current_sym[1] + 2;
	}
	else {
	$i = 1;
	}

	
	?>
	
	
	<?php

	//DELETE THE FOLLOWING LINE
	$no_of_rows = $no_of_students123;
	$kho = $i;
	$pra = 1;
	while ($i <= ($no_of_rows - 1 + $kho) ) {
	
	$id = $count; //$id=array count
	
	
	if ($i <= 26){
	$asciieqv = $i + 64;
	$alphabet = chr($asciieqv);
	}
	elseif (($i >= 27) && ($i < 53)) {
	$asciieqv =  $i - 26 + 64;
	$alphabet = chr($asciieqv);
	}
	elseif (($i >= 53) && ($i < 79)) {
	$asciieqv =  $i - 52 + 64;
	$alphabet = chr($asciieqv);
	}
	elseif (($i >= 79) && ($i < 105)) {
	$asciieqv =  $i - 78 + 64;
	$alphabet = chr($asciieqv);
	}
	elseif (($i >= 105) && ($i < 131)) {
	$asciieqv =  $i - 104 + 64;
	$alphabet = chr($asciieqv);
	}
	elseif (($i >= 131) && ($i < 157)) {
	$asciieqv =  $i - 130 + 64;
	$alphabet = chr($asciieqv);
	}
	elseif (($i >= 157) && ($i < 183)) {
	$asciieqv =  $i - 156 + 64;
	$alphabet = chr($asciieqv);
	}
	elseif (($i >= 183) && ($i < 209)) {
	$asciieqv =  $i - 182 + 64;
	$alphabet = chr($asciieqv);
	}
	elseif (($i >= 209) && ($i < 235)) {
	$asciieqv =  $i - 208 + 64;
	$alphabet = chr($asciieqv);
	}
	elseif (($i >= 235) && ($i < 261)) {
	$asciieqv =  $i - 234 + 64;
	$alphabet = chr($asciieqv);
	}	
		elseif (($i >= 261) && ($i < 287)) {
	$asciieqv =  $i - 260 + 64;
	$alphabet = chr($asciieqv);
	}	
		elseif (($i >= 287) && ($i < 313)) {
	$asciieqv =  $i - 286 + 64;
	$alphabet = chr($asciieqv);
	}	
		elseif (($i >= 313)) {
	$asciieqv =  $i - 312 + 64;
	$alphabet = chr($asciieqv);
	}	
	
	
	
	

	
	if ($i <= 9)
	{
	$student_no = "00". $i;
	}
	elseif (($i <= 99) && ($i >= 10)) {
	$student_no = "0". $i;
	}
	else {
	$student_no = $i;
	}
	
	$symbolno[$id] = $year. $school_code. $student_no. $alphabet ; 
	
	if ($id % 2 == 0){
	
	echo "<tr>";
	echo "<td align='center' bgcolor='#F7F7F7'>$symbolno[$id]<input type='hidden' name='symbolno_$pra' value='$symbolno[$id]'/></td>";
	echo "<td align='center' bgcolor='#F7F7F7'><input type='text' size='40' maxlength='40' name='name_$pra' style='background:#F7F7F7;' /></td>";
	echo "<td align='center' bgcolor='#F7F7F7'><input type='text' size='1' maxlength='2' name='dob1_$pra' style='background:#F7F7F7;' value='00' /><input type='text' size='1' maxlength='2' name='dob2_$pra' style='background:#F7F7F7;' value='00' /><input type='text' size='1' maxlength='2' name='dob3_$pra' style='background:#F7F7F7;' value='00' /></td>";
	echo "
	<td align='center' bgcolor='#F7F7F7'>
		<select name='opti_$pra' style='background:#F7F7F7;'>
			<option value=''></option>
			<option value='OI01'>Mathematics</option>
			<option value='OI02'>Population</option>
			<option value='OI03'>Environment Science</option>
			<option value='OI04'>English</option>
			<option value='OI05'>Geography</option>
			<option value='OI06'>Economics</option>
		</select>
	</td>";		
	echo "
	<td align='center' bgcolor='#F7F7F7'>
		<select name='optii_$pra' style='background:#F7F7F7;'>
			<option value=''></option>
			<option value='OII01'>Health & Physical Education</option>
			<option value='OII02'>Office Mgmt. & Accounts</option>
			<option value='OII03'>Agriculture</option>
			<option value='OII04'>Journalism</option>
			<option value='OII05'>Computer Science</option>
		</select>
	</td>";	
	echo "</tr>";
	}
	else
	{
	
		echo "<tr>";
	echo "<td align='center' bgcolor='#B1B1B1'>$symbolno[$id]<input type='hidden' name='symbolno_$pra' value='$symbolno[$id]'/></td>";
	echo "<td align='center' bgcolor='#B1B1B1'><input type='text' size='40' maxlength='40' name='name_$pra' style='background:#B1B1B1;' /></td>";
	echo "<td align='center' bgcolor='#B1B1B1'><input type='text' size='1' maxlength='2' name='dob1_$pra' style='background:#B1B1B1;' value='00' /><input type='text' size='1' maxlength='2' name='dob2_$pra' style='background:#B1B1B1;' value='00' /><input type='text' size='1' maxlength='2' name='dob3_$pra' style='background:#B1B1B1;' value='00' /></td>";
	echo "
	<td align='center' bgcolor='#B1B1B1'>
		<select name='opti_$pra' style='background:#B1B1B1;'>
			<option value=''></option>
			<option value='OI01'>Mathematics</option>
			<option value='OI02'>Population</option>
			<option value='OI03'>Environment Science</option>
			<option value='OI04'>English</option>
			<option value='OI05'>Geography</option>
			<option value='OI06'>Economics</option>
		</select>
	</td>";		
	echo "
	<td align='center' bgcolor='#B1B1B1'>
		<select name='optii_$pra' style='background:#B1B1B1;'>\
			<option value=''></option>
			<option value='OII01'>Health & Physical Education</option>
			<option value='OII02'>Office Mgmt. & Accounts</option>
			<option value='OII03'>Agriculture</option>
			<option value='OII04'>Journalism</option>
			<option value='OII05'>Computer Science</option>
		</select>
	</td>";	
	echo "</tr>";	
	}
	
	 $no_of_rows_enterred = $pra;
 global $no_of_rows_enterred;
	
	$i++;
	$pra++;
	$count++;
	}
	
	
	
    
    
    ?>
</table>
<br />

<table width="711" border="0">
  <tr>
    <td width="521" height="26" align="right" valign="top" bgcolor="#E0E9FE" style="BORDER-RIGHT: #E0E9FE 3px solid;><font face="Arial" size="2">
<?php
echo "<input type='hidden' name='no_of_rows_enterred' value='$no_of_rows_enterred' />";
echo "<input type='hidden' name='school_code' value='$school_code' />";
echo "<input type='hidden' name='bulbul' value='aIeL8J2m1s' />";
echo "<input type='hidden' name='dept' value='student' />";

?>
      <input type="submit" value="Save" />

   
    </font></td>
  </tr>
</table>

    </form>
<?php
}
}
}
}
}
?>
	

	