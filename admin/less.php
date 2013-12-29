<?php
if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access cookie!");

}
else{

if (!isset($_POST['lessthan'])){
	die ("ERROR: Direct access prohibited!");
}
else{

require("../connection.php");
if (!isset($anappleinabasket)){
require("func_library.php");
}
allow_in_admin_and_data_manager_only_zone();
$katitani = $_POST['lessthan'];


if ((data_empty($katitani) == true) || (anka_matra($katitani) == false)){
	echo "No or invalid marks enterred!<br />";
	die("<a href='http://example.com/admin/tools.php?id=04'>Go Back</a>");
}
else {

// create query
$query = "SELECT * FROM marks WHERE percent < '$katitani'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$anka = mysql_num_rows($result);
// free result set memory
mysql_free_result($result);

echo $anka . " student/s got less percentage than " . $katitani . "%";
echo "<br />";
echo "<a href='tools.php?id=04'>Go Back</a>";









}
}

}
?>
