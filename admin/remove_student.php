<?php


if (!isset($anappleinabasket)){
require("func_library.php");
}

user_logged_on();
allow_in_admin_only_zone();

if (!isset($bulbul)){
	die ("Unauthorized access!");
}
else {

if ($bulbul == 1){



if (!isset($_GET['school'])){
	echo "<font face='Arial' size='2'>";
	echo "Please enter the school code below!";
	echo "<br /><br />";
	echo "<form name='school_code' method='get' action='department.php'>";
	echo "<input type='hidden' name='dept' value='student' />";
	echo "<input type='hidden' name='task' value='remove' />";
	echo "<input type='text' name='school' maxlength='3' size='3' />";
	echo "<br /><br /><input type='submit' value='Enter' />";
	echo "</form>";

}

else {


// user comes from good background; proceed
$userid = $_COOKIE['basket_id'];
//find the user's name

$name = user_name($userid);
$school = $_GET['school'];
$school = $_GET['school'];

$data_status = data_empty($school);
$correct_chars = anka_matra($school);


if (($data_status == true) || ($correct_chars == false)){
	die ("Invalide character or empty code enterred!");
}
else {

// user addition layout/forehand



$naam = array();
$username = array();
require ("../connection.php");
// create query
$query = "SELECT * FROM marks WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
$p = 1;
while ($p <= mysql_num_rows($result)){
$row = mysql_fetch_assoc($result);
$sym[$p] = $row['symbol_no'];
$naam[$p] = $row['name'];
$no = $p;
$p++;
}
// free result set memory
mysql_free_result($result);
$school_name = school_name ($school);
$school_address = school_address($school);

echo "<strong><u>School Code:</u></strong> <font color='#A80000'>$school</font><br /> ";
echo "<strong><u>School:</u></strong> <font color='#A80000'>$school_name</font><br /> ";
echo "<strong><u>Address:</u></strong> <font color='#A80000'>$school_address</font><br /> <br />";

echo "<form name='remove' action='remove.php' method='post'>";
echo "<table border='0' cellspacing='0' cellpadding='0'>";
echo "<tr bgcolor='#828282'>";
echo "<td width='45'><font face='Arial' size='2' color='white'><strong>S.No.</strong></font></td>";
echo "<td width='80'><font face='Arial' size='2' color='white'><strong>Symbol No.</strong></font></td>";
echo "<td width='200'><font face='Arial' size='2' color='white'><strong>Name</strong></font></td>";
echo "<td width='60'><font face='Arial' size='2' color='white'><strong>Remove?</strong></font></td>";
echo "</tr>";

$p = 1;
while ($p <= $no){

if (($p % 2) == 0){
echo "<tr bgcolor='#FFFFFF'>";
echo "<td align='center'><font face='Arial' size='2'>" . $p ."</font></td>";
echo "<td><font face='Arial' size='2'>" . $sym[$p] ."<input type='hidden' name='sym_$p' value='$sym[$p]' /></font></td>";
echo "<td><font face='Arial' size='2'>" . $naam[$p] ."</font></td>";
echo "<td align='center'><input type='checkbox' name='del_$p' /></td>";
echo "</tr>";

}
else {




echo "<tr bgcolor='#E1E1E1'>";
echo "<td align='center'><font face='Arial' size='2'>" . $p ."</font></td>";
echo "<td><font face='Arial' size='2'>" . $sym[$p] ."<input type='hidden' name='sym_$p' value='$sym[$p]' /></font></td>";
echo "<td><font face='Arial' size='2'>" . $naam[$p] ."</font></td>";
echo "<td align='center'><input type='checkbox' name='del_$p' /></td>";
echo "</tr>";
}




$p++;
}
echo "</table>";
echo "<br />";
echo "<input type='hidden' name='bulbul' value='1' />";
echo "<input type='hidden' name='dept' value='student' />";
echo "<input type='hidden' name='no' value='$no' />";
echo "<input type='submit' value='Remove' />";
echo "&nbsp;&nbsp;<input type='reset' />";
echo "</form>";
}
else {
	die ("ERROR: No students found! Enter students first!");
}










}
}
}
else {

die ("ERROR:: ACCESS DENIED!");

}
}



?>