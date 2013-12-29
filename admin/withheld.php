<?php

$no = 0;
if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Access Denied!");

}
else{
if (!isset($bulbul)){
die ("ERROR: Access Denied!");
}
else{
if (!isset($_GET['school'])){


		echo "<font face='Arial' size='2'>";
		echo "Please enter the school code below!";
		echo "<br /><br />";
		echo "<form name='school_code' method='get' action='tools.php'>";
		echo "<input type='hidden' name='id' value='06' />";		
		echo "<input type='text' name='school' maxlength='3' size='3' />";
		echo "<br /><br /><input type='submit' value='Enter' />";
		echo "</form>";
}
else {

$userid = $_COOKIE['basket_id'];
//find the user's name
allow_in_admin_and_data_manager_only_zone();
$name = user_name($userid);
$school = $_GET['school'];
$data_status = data_empty($school);
$correct_chars = anka_matra($school);


if (($data_status == true) || ($correct_chars == false)){
	die ("Invalid character or empty code enterred!");
}
else {

echo "<font face='Arial' size='2' color='brown'><strong>We're withholding results " . $name . "!</strong></font>";
echo "<br /><br />";

$sym = array();
$naam = array();
$eng_th = array();
$eng_pr = array();
$nep = array();
$maths = array();
$sci_th = array();
$sci_pr = array();
$social = array();
$hpe_th = array();
$hpe_pr = array();
$opti = array();
$optii_th = array();
$optii_pr = array();
$total = array();
$percent = array();
require ("../connection.php");
// create query
$query = "SELECT * FROM marks WHERE school_code = $school";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 0) {
	die ("No student exists!<br /><a href='tools.php'>Go Back</a>");
}
elseif (mysql_num_rows($result) >= 1) {
$p = 1;
while ($p <= mysql_num_rows($result)){
$row = mysql_fetch_assoc($result);
$naam[$p] = $row['name'];
$sym[$p] = $row['symbol_no'];
$withhold_cha[$p] = $row['withheld'];
$no = $p;
$p++;
}
// free result set memory
mysql_free_result($result);

}
?>
<form name="corrections" action="withhold_results.php" method="post">
<input type='hidden' name='bulbul' value='1' />
<table width="886" border = '1' align="center" cellpadding = '0' cellspacing = '0'>
<tr bgcolor='#828282'>
	<td width="35"><strong><font face='Arial' size='2' color='white'>S. No.</font></strong></td>
	<td width="67"><strong><font face='Arial' size='2' color='white'>Symbol No.</font></strong></td>	
	<td width="143"><strong><font face='Arial' size='2' color='white'>Name</font></strong></td>	
	<td width="40" align='center'><strong><font face='Arial' size='2' color='white'>Withheld?</font></strong></td>	
</tr>

<?php






$p = 1;
while ($p <= $no){


if($p % 2 == 0){
echo "<tr bgcolor='#FFFFFF'>";
echo "<td><font face='Arial' size='2'>" . $p . "</font></td>";
echo "<td><font face='Arial' size='2'>" . $sym[$p] . "<input type='hidden' name='sym_$p' value = '$sym[$p]' /></font></td>";
echo "<td><font face='Arial' size='2'>" . $naam[$p] . "</font></td>";
if ($withhold_cha[$p] == "1"){
echo "<td align='center'><input type='checkbox' name='with_$p' checked='true' /></td>";
}
else{
echo "<td align='center'><input type='checkbox' name='with_$p' /></td>";
}
echo "</tr>";

}
else{
echo "<tr bgcolor='#E1E1E1'>";
echo "<td><font face='Arial' size='2'>" . $p . "</font></td>";
echo "<td><font face='Arial' size='2'>" . $sym[$p] . "<input type='hidden' name='sym_$p' value = '$sym[$p]' /></font></td>";
echo "<td><font face='Arial' size='2'>" . $naam[$p] . "</font></td>";
if ($withhold_cha[$p] == "1"){
echo "<td align='center'><input type='checkbox' name='with_$p' checked='true' /></td>";
}
else{
echo "<td align='center'><input type='checkbox' name='with_$p' /></td>";
}
echo "</tr>";



}




$p++;
}


echo "</table>";
echo "<br />";

echo "<input type='hidden' name='no' value='$no' />";
echo "<input type='hidden' name='school' value='$school' />";
echo "<input type='Submit' value='Save' />"; 
echo "<input type='reset' />"; 
echo "<br /><br />";
echo "<a href='tools.php'>Go Back</a>";















}
}
}
}
?>