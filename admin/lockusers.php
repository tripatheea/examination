<?php

$no = 0;
if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Access Denied!");

}
if (!isset($bulbul)){
die ("ERROR: Access Denied!");
}
//find the user's name
allow_in_admin_and_data_manager_only_zone();



require ("../connection.php");
// create query
$query = "SELECT * FROM users WHERE access_level > 1";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 0) {
	die ("No user exists!<br /><a href='tools.php'>Go Back</a>");
}
elseif (mysql_num_rows($result) >= 1) {
$p = 1;
while ($p <= mysql_num_rows($result)){
$row = mysql_fetch_assoc($result);
$naam[$p] = $row['name'];
$usernaam[$p] = $row['username'];
$lock_cha[$p] = $row['locked'];
$no = $p;
$p++;
}
// free result set memory
mysql_free_result($result);

}
?>
<form name="lock users" action="lock_users.php" method="post" />
<table border = '1' align="center" cellpadding = '0' cellspacing = '0'>
<tr bgcolor='#828282'>
	<td align='center'><strong><font face='Arial' size='2' color='white'>S. No.</font></strong></td>
	<td width="120"><strong><font face='Arial' size='2' color='white'>Username</font></strong></td>	
	<td width="250"><strong><font face='Arial' size='2' color='white'>Name</font></strong></td>	
	<td width="40" align='center'><strong><font face='Arial' size='2' color='white'>Lock?</font></strong></td>	
</tr>

<?php






$p = 1;
while ($p <= $no){


if($p % 2 == 0){
echo "<tr bgcolor='#FFFFFF'>";
echo "<td align='center'><font face='Arial' size='2'>" . $p . "</font></td>";
echo "<td><font face='Arial' size='2'>" . $usernaam[$p] . "<input type='hidden' name='username_$p' value = '$usernaam[$p]' /></font></td>";
echo "<td><font face='Arial' size='2'>" . $naam[$p] . "</font></td>";
if ($lock_cha[$p] == "1"){
echo "<td align='center'><input type='checkbox' name='lock_$p' checked='true' /></td>";
}
else{
echo "<td align='center'><input type='checkbox' name='lock_$p' /></td>";
}
echo "</tr>";

}
else{
echo "<tr bgcolor='#E1E1E1'>";
echo "<td align='center'><font face='Arial' size='2'>" . $p . "</font></td>";
echo "<td><font face='Arial' size='2'>" . $usernaam[$p] . "<input type='hidden' name='username_$p' value = '$usernaam[$p]' /></font></td>";
echo "<td><font face='Arial' size='2'>" . $naam[$p] . "</font></td>";
if ($lock_cha[$p] == "1"){
echo "<td align='center'><input type='checkbox' name='lock_$p' checked='true' /></td>";
}
else{
echo "<td align='center'><input type='checkbox' name='lock_$p' /></td>";
}
echo "</tr>";



}




$p++;
}


echo "</table>";
echo "<br />";
echo "<input type='hidden' name='bulbul' value='1' />";
echo "<input type='hidden' name='no' value='$no' />";
echo "<input type='Submit' value='Save' />"; 
echo "<input type='reset' />"; 
echo "<br /><br />";
echo "<a href='tools.php'>Go Back</a>";








?>