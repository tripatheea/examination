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
// user comes from good background; proceed
$userid = $_COOKIE['basket_id'];
//find the user's name

$name = user_name($userid);
global $name;




// user addition layout/forehand




$naam = array();
$address = array();
require ("../connection.php");
// create query
$query = "SELECT * FROM schools";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
$p = 1;
while ($p <= mysql_num_rows($result)){
$row = mysql_fetch_assoc($result);
$school_code[$p] = $row['school_code'];
$naam[$p] = $row['name'];
$address[$p] = $row['address'];
$no = $p;
$p++;
}
// free result set memory
mysql_free_result($result);

echo "<form name='remove' action='remove.php' method='post'>";
echo "<table border='0' cellspacing='0' cellpadding='0'>";
echo "<tr bgcolor='#828282'>";
echo "<td width='40'><font face='Arial' size='2' color='white'><strong>S.No.</strong></font></td>";
echo "<td width='40'><font face='Arial' size='2' color='white'><strong>Code</strong></font></td>";
echo "<td width='350'><font face='Arial' size='2' color='white'><strong>Name</strong></font></td>";
echo "<td width='150'><font face='Arial' size='2' color='white'><strong>Address</strong></font></td>";
echo "<td width='60'><font face='Arial' size='2' color='white'><strong>Remove?</strong></font></td>";
echo "</tr>";

$p = 1;
while ($p <= $no){

if (($p % 2) == 0){
echo "<tr bgcolor='#FFFFFF'>";
echo "<td align='center'><font face='Arial' size='2'>" . $p ."</font></td>";
echo "<td><font face='Arial' size='2'>" . $school_code[$p] ."<input type='hidden' name='school_$p' value='$school_code[$p]' /></font></td>";
echo "<td><font face='Arial' size='2'>" . $naam[$p] ."</font></td>";
echo "<td><font face='Arial' size='2'>" . $address[$p] ."</font></td>";
echo "<td align='center'><input type='checkbox' name='del_$p' /></td>";
echo "</tr>";

}
else {




echo "<tr bgcolor='#E1E1E1'>";
echo "<td align='center'><font face='Arial' size='2'>" . $p ."</font></td>";
echo "<td><font face='Arial' size='2'>" . $school_code[$p] ."<input type='hidden' name='school_$p' value='$school_code[$p]' /></font></td>";
echo "<td><font face='Arial' size='2'>" . $naam[$p] ."</font></td>";
echo "<td><font face='Arial' size='2'>" . $address[$p] ."</font></td>";
echo "<td align='center'><input type='checkbox' name='del_$p' /></td>";
echo "</tr>";
}




$p++;
}
echo "</table>";
echo "<br />";
echo "<input type='hidden' name='bulbul' value='1' />";
echo "<input type='hidden' name='dept' value='school' />";
echo "<input type='hidden' name='no' value='$no' />";
echo "<input type='submit' value='Remove' />";
echo "&nbsp;&nbsp;<input type='reset' />";
echo "</form>";
}
else {
	die ("ERROR: No school found! Enter schools first!");
}








}
else {

die ("ERROR:: ACCESS DENIED!");

}


}





?>