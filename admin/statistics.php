<?php
if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access!");

}
else{


if (!isset($anappleinabasket)){
require("func_library.php");
}


allow_in_admin_and_data_manager_only_zone();
//get all the statistics

// total no. of students
// create query
$query = "SELECT * FROM marks";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$totalnoofstudents = mysql_num_rows($result);
// free result set memory
mysql_free_result($result);


// total no. of passed students
// create query
$query = "SELECT * FROM marks WHERE pass = 'Pass'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$totalnoofpass = mysql_num_rows($result);
// free result set memory
mysql_free_result($result);



// total no. of passed students
// create query
$query = "SELECT * FROM marks WHERE pass = 'Fail'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$totalnooffail = mysql_num_rows($result);
// free result set memory
mysql_free_result($result);


// total no. of distinction students
// create query
$query = "SELECT * FROM marks WHERE division = 'Distinction'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$totalnoofdist = mysql_num_rows($result);
// free result set memory
mysql_free_result($result);

// total no. of first division students
// create query
$query = "SELECT * FROM marks WHERE division = 'First'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$totalnooffirst = mysql_num_rows($result);
// free result set memory
mysql_free_result($result);



// total no. of second division students
// create query
$query = "SELECT * FROM marks WHERE division = 'Second'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$totalnoofsecond = mysql_num_rows($result);
// free result set memory
mysql_free_result($result);


// total no. of third division students
// create query
$query = "SELECT * FROM marks WHERE division = 'Third'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$totalnoofthird = mysql_num_rows($result);
// free result set memory
mysql_free_result($result);


// total no. of withheld students
// create query
$query = "SELECT * FROM marks WHERE withheld = '1'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$totalnoofwithheld = mysql_num_rows($result);
// free result set memory
mysql_free_result($result);



// total no. of disqualified students
// create query
$query = "SELECT * FROM marks WHERE disqualified = '1'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$totalnoofdisqualified = mysql_num_rows($result);
// free result set memory
mysql_free_result($result);

echo "<font face='Arial' size='2'>";
echo "We're seeing the statistics for this year!";
echo "<br /><br />";
?>
<html>
<head>

</head>
<body>
<table>

	<tr>
		<td><font face="Arial" size="2"><strong>Distinction:</strong></font></td>
		<td><font face="Arial" size="2"><?php echo $totalnoofdist; ?></font></td>
	</tr>	
	<tr>
		<td><font face="Arial" size="2"><strong>I<sup>st</sup> Division:</strong></font></td>
		<td><font face="Arial" size="2"><?php echo $totalnooffirst; ?></font></td>
	</tr>	
	<tr>
		<td><font face="Arial" size="2"><strong>II<sup>nd</sup> Division:</strong></font></td>
		<td><font face="Arial" size="2"><?php echo $totalnoofsecond; ?></font></td>
	</tr>	
	<tr>
		<td><font face="Arial" size="2"><strong>III<sup>rd</sup> Division:</strong></font></td>
		<td><font face="Arial" size="2"><?php echo $totalnoofthird; ?></font></td>
	</tr>	
	<tr>
		<td><font face="Arial" size="2"><strong>Passed:</strong></font></td>
		<td><font face="Arial" size="2"><?php echo $totalnoofpass; ?></font></td>
	</tr>	
	<tr>
		<td><font face="Arial" size="2"><strong>Failed:</strong></font></td>
		<td><font face="Arial" size="2"><?php echo $totalnooffail; ?></font></td>
	</tr>		
	<tr>
		<td><font face="Arial" size="2"><strong>Withheld:</strong></font></td>
		<td><font face="Arial" size="2"><?php echo $totalnoofwithheld; ?></font></td>
	</tr>		
	<tr>
		<td><font face="Arial" size="2"><strong>Disqualified:</strong></font></td>
		<td><font face="Arial" size="2"><?php echo $totalnoofdisqualified; ?></font></td>
	</tr>	
	<tr>
		<td><font face="Arial" size="2"><strong>Total:</strong></font></td>
		<td><font face="Arial" size="2"><?php echo $totalnoofstudents; ?></font></td>
	</tr>
	<tr>
		<td><font face="Arial" size="2"><strong>Greater than:</strong></font></td>
		<td><font face="Arial" size="2"><form name="greater" action="greater.php" method="post"><input type="text" name="greaterthan" size="1" maxlength="2" />&nbsp;%&nbsp;<input type="Submit" value="See" /></form></font></td>
	</tr>	
	<tr>
		<td><font face="Arial" size="2"><strong>Less than:</strong></font></td>
		<td><font face="Arial" size="2"><form name="less" action="less.php" method="post"><input type="text" name="lessthan" size="1" maxlength="2" />&nbsp;%&nbsp;<input type="Submit" value="See" /></form></font></td>
	</tr>	
	
	
</table>


<?php
// create query
$query = "SELECT * FROM marks ORDER BY percent DESC";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$p=1;
while ($p <= 10){
$row = mysql_fetch_assoc($result);
$top_symbolno[$p] = $row['symbol_no'];
$top_name[$p] = $row['name'];
$top_dob[$p] = $row['dob'];
$top_school[$p] = $row['school_code'];
$top_percent[$p] = $row['percent'];
$p++;
}
// free result set memory
mysql_free_result($result);


$p=1;
while ($p <= 10){
// create query
$query = "SELECT * FROM schools WHERE school_code = '$top_school[$p]'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$row = mysql_fetch_assoc($result);
$top_school_name[$p] = $row['name'];
$p++;
}
// free result set memory
mysql_free_result($result);
?>
<br />
<font face="Arial" size="3"><strong><u>Top 10 Students:</u></strong></font>
<br /><br />
<table border="0" cellpadding="0" cellspacing="0">
<tr bgcolor="#828282">
<td width="50">Rank</td>
<td width="100">Symbol No.</td>
<td width="200">Name</td>
<td width="80">DOB</td>
<td width="400">School</td>
<td width="80">Percentage</td>
</tr>
<?php
$p=1;
while ($p <= 10){

if (($p % 2) == 0){
?>
<tr bgcolor="#FFFFFF">
<td align="center"><?php echo $p;?></td>
<td><?php echo $top_symbolno[$p];?></td>
<td><?php echo $top_name[$p];?></td>
<td><?php echo $top_dob[$p];?></td>
<td><?php echo $top_school_name[$p];?></td>
<td align="center"><?php echo $top_percent[$p];?></td>
</tr>
<?php
}
else{
?>
<tr bgcolor="#E1E1E1">
<td align="center"><?php echo $p;?></td>
<td><?php echo $top_symbolno[$p];?></td>
<td><?php echo $top_name[$p];?></td>
<td><?php echo $top_dob[$p];?></td>
<td><?php echo $top_school_name[$p];?></td>
<td align="center"><?php echo $top_percent[$p];?></td>
</tr>
<?php
}


$p++;
}

?>
</table>
<br /><br />
<font face="Arial" size="3"><strong><u>Optional Subjects Info:</u></strong></font><br /><br />
<?php



for($i=1; $i <= 6; $i++){
	$opti = "OI0" . $i;
	
	
	// create query
	$query = "SELECT id FROM marks WHERE opti_choice = '$opti'";
	// execute querys
	$result = mysql_query($query) or die ("Error in query: $query.
	" . mysql_error());
	// see if any rows were returned
	
	echo "<b>" . subject_name($opti) . ":</b> " . mysql_num_rows($result) . "<br><br>";
	
}


for($i=1; $i <= 5; $i++){
	$optii = "OII0" . $i;
	
	
	// create query
	$query = "SELECT id FROM marks WHERE optii_choice = '$optii'";
	// execute querys
	$result = mysql_query($query) or die ("Error in query: $query.
	" . mysql_error());
	// see if any rows were returned
	
	echo "<b>" . subject_name($optii) . ":</b> " . mysql_num_rows($result) . "<br><br>";
	
}



?>

<?php
echo "<br /><br /><a href='tools.php'>Go Back</a>";
echo "</font>";






}
?>