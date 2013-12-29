<?php
if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access!");

}
else{



require("func_library.php");
$ahileko_user = $_COOKIE['basket_id'];
$school = username20($ahileko_user);



// create query
$query = "SELECT * FROM settings WHERE field = 'result_status'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$row = mysql_fetch_assoc($result);
$status = $row['value'];

if (($status == "0") || ($status == "1")){
	echo "<font face='Arial' size='2'>Sorry! You can't view the ledger right now. Please use the 'Back' button of your browser to go back.</font>";
	die();
}
elseif ($status == "2"){



require("../connection.php");



//compilation finished; proceed


//define arrays


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
$division = array();








//retrieve and store everything in the table marks in arrays
// create query
$query = "SELECT * FROM marks WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
	$no = mysql_num_rows($result);
		$p = 1;
			while ($p <= $no){
				$row = mysql_fetch_assoc($result);
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
				$opti_pr[$p] = $row['opti_pr'];
				$optii_th[$p] = $row['optii_th'];
				$optii_pr[$p] = $row['optii_pr'];
				$total[$p] = $row['total'];
				$percent[$p] = $row['percent'];
				$division[$p] = $row['division'];
				$pass[$p] = $row['pass'];
				$withheld[$p] = $row['withheld'];
				$disqualified[$p] = $row['disqualified'];
				$p++;
			}	
}
else {
	die ("ERROR: No marks enterred! Enter marks first!");
}

// free result set memory
mysql_free_result($result);



//retrieve and store names in the table students in arrays
// create query
$query = "SELECT * FROM marks WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
	$no = mysql_num_rows($result);
		$p = 1;
			while ($p <= $no){
				$row = mysql_fetch_assoc($result);
				$naam[$p] = $row['name'];
				$p++;
			}	
}
else {
	die ("ERROR: No student exists in corresponding table!");
}
?>
<body>
<center>
<font face="Arial" size="4"><strong><?php echo school_name($school);?></strong></font>
<br />
<font face="Arial" size="3"><strong><?php echo school_address($school);?></strong></font><br /><br />
<font face="Arial" size="3"><u>School Marks Ledger</u></font><br />
<table border = '1' align="center" cellpadding = '0' cellspacing = '0'>
<tr bgcolor='#828282'>
	<td width="40" align="center"><strong><font face='Arial' size='2' color='white'>S. No.</font></strong></td>
	<td width="80"><strong><font face='Arial' size='2' color='white'>Symbol No.</font></strong></td>	
	<td width="200"><strong><font face='Arial' size='2' color='white'>Name</font></strong></td>
	<td colspan="2" align='center'><strong><font face='Arial' size='2' color='white'>English</font></strong></td>	
	<td width="41" align='center'><strong><font face='Arial' size='2' color='white'>Nepali</font></strong></td>	
	<td width="40" align='center'><strong><font face='Arial' size='2' color='white'>Maths</font></strong></td>	
	<td colspan="2" align='center'><strong><font face='Arial' size='2' color='white'>Science</font></strong></td>	
	<td width="77" align='center'><strong><font face='Arial' size='2' color='white'>Social Studies</font></strong></td>	
	<td align='center' colspan="2"><strong><font face='Arial' size='2' color='white'>H.P.E.</font></strong></td>
	<td width="63" align='center' colspan="2"><strong><font face='Arial' size='2' color='white'>Optional I</font></strong></td>	
	<td colspan="2" align='center'><strong><font face='Arial' size='2' color='white'>Optional II</font></strong></td>	
	<td width="28" align='center'><strong><font face='Arial' size='2' color='white'>Total</font></strong></td>	
	<td width="50" align='center'><strong><font face='Arial' size='2' color='white'>Percent</font></strong></td>	
	<td width="102" align='center'><strong><font face='Arial' size='2' color='white'>Division</font></strong></td>		
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
  <td width="32" align='center'><strong><font face='Arial' size='2' color='white'>Th</font></strong></td>
  <td width="33" align='center'><strong><font face='Arial' size='2' color='white'>Pr</font></strong></td>
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
echo "<tr bgcolor='#FFFFFF'>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $p . "</font></td>\n";
echo "<td><font face='Arial' size='2'>" . $sym[$p] . "</font></td>\n";
echo "<td><font face='Arial' size='2'>" . $naam[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $eng_th[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $eng_pr[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $nep[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $maths[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $sci_th[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $sci_pr[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $social[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $hpe_th[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $hpe_pr[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $opti[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $opti_pr[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $optii_th[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $optii_pr[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $total[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $percent[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $division[$p] . "</font></td>\n";
echo "</tr>";
}
else{
echo "<tr bgcolor='#E1E1E1'>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $p . "</font></td>\n";
echo "<td><font face='Arial' size='2'>" . $sym[$p] . "</font></td>\n";
echo "<td><font face='Arial' size='2'>" . $naam[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $eng_th[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $eng_pr[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $nep[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $maths[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $sci_th[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $sci_pr[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $social[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $hpe_th[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $hpe_pr[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $opti[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $opti_pr[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $optii_th[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $optii_pr[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $total[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $percent[$p] . "</font></td>\n";
echo "<td align='center'><font face='Arial' size='2'>" . $division[$p] . "</font></td>\n";
echo "</tr>";



}





$p++;
}
echo "<table>";
//determining the top 3 students

/* echo "<font face='Arial' size='2'>";
echo "<br /><br /><br />";
echo "<strong>Rank 1: </strong>" . $naam[1];
echo "<br /><strong>Rank 2: </strong>" . $naam[2];
echo "<br /><strong>Rank 3: </strong>" . $naam[3];
echo "</font>";
echo "</body>"; */
}

}
?>