<?php
require_once("../connection.php");
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
				$school_name[$p] = $row['name'];
				$school_address[$p] = $row['address'];
				$total = $p;
				$p++;
			}	
}
else {
	die ("ERROR: No school exists!");
}

// free result set memory
mysql_free_result($result);
//close connection
mysql_close($connection);

?>


<table cellspacing="0" cellpadding="0">
	<tr bgcolor="#828282">
		<td width="25">S.No.</td>
		<td width="400">Name</td>
		<td width="200">Address</td>
		<td width="25">Code</td>
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
echo "<td>" . $school_name[$p] . "</td>";
echo "<td>" . $school_address[$p] . "</td>";
echo "<td>" . $school_code[$p] . "</td>";
$p++;
}

?>