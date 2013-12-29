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
		echo "<input type='hidden' name='id' value='01' />";		
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

echo "<font face='Arial' size='2' color='brown'><strong>We're making corrections " . $name . "!</strong></font>";
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
$query = "SELECT * FROM marks WHERE school_code = '$school' AND pass = 'Fail'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 0) {
	die ("No failures! Congratulations!<br /><a href='tools.php'>Go Back</a>");
}
elseif (mysql_num_rows($result) >= 1) {
$p = 1;
while ($p <= mysql_num_rows($result)){
$row = mysql_fetch_assoc($result);
$naam[$p] = $row['name'];
$sym[$p] = $row['symbol_no'];
$eng_th[$p] = $row['english_th'];
$eng_pr[$p] = $row['english_pr'];
$nep[$p] = $row['nepali'];
$maths[$p] = $row['maths'];
$sci_th[$p] = $row['science_th'];
$sci_pr[$p] = $row['science_pr'];
$social[$p] = $row['social'];
$hpe_th[$p] = $row['hpe_th'];
$hpe_pr[$p] = $row['hpe_pr'];
$opti[$p] = $row['opti'];
$optii_th[$p] = $row['optii_th'];
$optii_pr[$p] = $row['optii_pr']; 
$total[$p] = $row['total']; 
$percent[$p] = $row['percent']; 
$no = $p;
$p++;
}
// free result set memory
mysql_free_result($result);

}
?>
<form name="corrections" action="pass_fail.php" method="post" />
<table width="886" border = '1' align="center" cellpadding = '0' cellspacing = '0'>
<tr bgcolor='#828282'>
	<td width="35"><strong><font face='Arial' size='2' color='white'>S. No.</font></strong></td>
	<td width="67"><strong><font face='Arial' size='2' color='white'>Symbol No.</font></strong></td>	
	<td width="143"><strong><font face='Arial' size='2' color='white'>Name</font></strong></td>
	<td colspan="2" align='center'><strong><font face='Arial' size='2' color='white'>English</font></strong></td>	
	<td width="41" align='center'><strong><font face='Arial' size='2' color='white'>Nepali</font></strong></td>	
	<td width="40" align='center'><strong><font face='Arial' size='2' color='white'>Maths</font></strong></td>	
	<td colspan="2" align='center'><strong><font face='Arial' size='2' color='white'>Science</font></strong></td>	
	<td width="77" align='center'><strong><font face='Arial' size='2' color='white'>Social Studies</font></strong></td>	
	<td align='center' colspan="2"><strong><font face='Arial' size='2' color='white'>H.P.E.</font></strong></td>
	<td width="50" align='center'><strong><font face='Arial' size='2' color='white'>Optional I</font></strong></td>	
	<td colspan="2" align='center'><strong><font face='Arial' size='2' color='white'>Optional II</font></strong></td>	
	<td width="28" align='center'><strong><font face='Arial' size='2' color='white'>Total</font></strong></td>	
	<td width="50" align='center'><strong><font face='Arial' size='2' color='white'>Percent</font></strong></td>		
	<td width="40" align='center'><strong><font face='Arial' size='2' color='white'>Pass?</font></strong></td>	
</tr>
<tr bgcolor='#828282'>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td width="24" align='center'><strong><font face='Arial' size='2' color='white'>Th</font></strong></td>
  <td width="24" align='center'><strong><font face='Arial' size='2' color='white'>Pr</font></strong></td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td width="26" align='center'><strong><font face='Arial' size='2' color='white'>Th</font></strong></td>
  <td width="27" align='center'><strong><font face='Arial' size='2' color='white'>Pr</font></strong></td>
  <td>&nbsp;</td>
  <td width="24" align='center'><strong><font face='Arial' size='2' color='white'>Th</font></strong></td>
  <td width="25" align='center'><strong><font face='Arial' size='2' color='white'>Pr</font></strong></td>
  <td width="50">&nbsp;</td>
  <td width="32" align='center'><strong><font face='Arial' size='2' color='white'>Th</font></strong></td>
  <td width="33" align='center'><strong><font face='Arial' size='2' color='white'>Pr</font></strong></td>
  <td width="28">&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>

<?php






$p = 1;
while ($p <= $no){


if($p % 2 == 0){
echo "<tr bgcolor='#FFFFFF'>";
echo "<td><font face='Arial' size='2'>" . $p . "</font></td>";
echo "<td><font face='Arial' size='2'>" . $sym[$p] . "<input type='hidden' name='sym_$p' value = '$sym[$p]' /></font></td>";
echo "<td><font face='Arial' size='2'>" . $naam[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $eng_th[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $eng_pr[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $nep[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $maths[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $sci_th[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $sci_pr[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $social[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $hpe_th[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $hpe_pr[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $opti[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $optii_th[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $optii_pr[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $total[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $percent[$p] . "</font></td>";
echo "<td align='center'><input type='checkbox' name='pass_$p' /></td>";
echo "</tr>";

}
else{
echo "<tr bgcolor='#E1E1E1'>";
echo "<td><font face='Arial' size='2'>" . $p . "</font></td>";
echo "<td><font face='Arial' size='2'>" . $sym[$p] . "<input type='hidden' name='sym_$p' value = '$sym[$p]' /></font></td>";
echo "<td><font face='Arial' size='2'>" . $naam[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $eng_th[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $eng_pr[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $nep[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $maths[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $sci_th[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $sci_pr[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $social[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $hpe_th[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $hpe_pr[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $opti[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $optii_th[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $optii_pr[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $total[$p] . "</font></td>";
echo "<td align='center'><font face='Arial' size='2'>" . $percent[$p] . "</font></td>";
echo "<td align='center'><input type='checkbox' name='pass_$p' /></td>";
echo "</tr>";



}




$p++;
}


echo "</table>";
echo "<br />";
echo "<input type='hidden' name='bulbul' value='1' />";
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