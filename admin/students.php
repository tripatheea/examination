<?php
require_once("func_library.php");
require_once("../connection.php");
allow_in_admin_and_data_manager_only_zone();
if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access cookie!");
}
if(!isset($_GET['school'])){

		echo "<font face='Arial' size='2'>";
		echo "Please enter the school code below!";
		echo "<br /><br />";
		echo "<form name='school_code' method='get' action='students.php'>";		
		echo "<input type='text' name='school' maxlength='3' size='3' />";
		echo "<br /><br /><input type='submit' value='Enter' />";
		echo "</form>";
}
else {

$school = $_GET['school'];

// create query
$query = "SELECT * FROM marks WHERE school_code = $school";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
		$p = 1;
			while ($p <= mysql_num_rows($result)){
				$row = mysql_fetch_assoc($result);
				$symbolno[$p] = $row['symbol_no'];
				$name[$p] = $row['name'];
				$dob[$p] = $row['dob'];
				$opti[$p] = $row['opti_choice'];
				$optii[$p] = $row['optii_choice'];
				$total = $p;
				$p++;
			}	
}
else {
	die ("ERROR: No student exists!");
}

// free result set memory
mysql_free_result($result);
//close connection
mysql_close($connection);

?>
<div align="center">
<font face="Arial" size="3"><strong><?php echo school_name($school);?></strong></font><br />
<font face="Arial" size="3"><?php echo school_address($school);?></font><br />
</div>
<table cellspacing="0" cellpadding="5">
	<tr bgcolor="#828282">
		<td width="25">S.No.</td>
		<td width="100">Symbol No.</td>
		<td width="300">Name</td>
		<td width="80">DOB</td>
		<td width="250">OPTI</td>
		<td width="250">OPTII</td>		
		
	</tr>
<?php
$p=1;
while ($p <= $total){
if ($p % 2 == 0){
echo "<tr bgcolor='#B1B1B1'>";
}
else {
echo "<tr>";
}
echo "<td>" . $p . "</td>";
echo "<td>" . $symbolno[$p] . "</td>";
echo "<td>" . $name[$p] . "</td>";
echo "<td>" . $dob[$p] . "</td>";
echo "<td>" . subject_name($opti[$p]) . "</td>";
echo "<td>" . subject_name($optii[$p]) . "</td>";
echo "</tr>";
$p++;
}

echo "</table><br>";



require ("../connection.php");


for($i=1; $i <= 6; $i++){
	$opti = "OI0" . $i;
	
	
	// create query
	$query = "SELECT id FROM marks WHERE school_code = '$school' AND opti_choice = '$opti'";
	// execute querys
	$result = mysql_query($query) or die ("Error in query: $query.
	" . mysql_error());
	// see if any rows were returned
	if(mysql_num_rows($result) > 0){
		echo "<b>" . subject_name($opti) . ": " . mysql_num_rows($result) . "</b><br>";
	}
}



for($i=1; $i <= 5; $i++){
	$optii = "OII0" . $i;
	
	
	// create query
	$query = "SELECT id FROM marks WHERE school_code = '$school' AND optii_choice = '$optii'";
	// execute querys
	$result = mysql_query($query) or die ("Error in query: $query.
	" . mysql_error());
	// see if any rows were returned
	if(mysql_num_rows($result) > 0){
		echo "<b>" . subject_name($optii) . ": " . mysql_num_rows($result) . "</b><br>";
	}
}

}
?>