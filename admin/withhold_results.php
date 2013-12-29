<?php
if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access1!");

}
else{

if (!isset($_POST['bulbul'])){
die ("ERROR: Unauthorized access2!");
}
else{
require ("../connection.php");
if (!isset($anappleinabasket)){
require("func_library.php");
}
allow_in_admin_and_data_manager_only_zone();
$no = $_POST['no'];
$school = $_POST['school'];
$p = 1;
while ($p <= $no){
$sym[$p] = $_POST['sym_' . $p];
//echo $sym[$p] . "K HO<br />";
/* // create query
$query = "SELECT * FROM marks WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$row = mysql_fetch_assoc($result);
$sym_dbko[$p] = $row['symbol_no'];
 */
if(isset($_POST['with_' . $p])){
$withhold_him_or_her[$p] = $_POST['with_' . $p];
}
else {
$withhold_him_or_her[$p] = "off";
}

if ($withhold_him_or_her[$p] == "on"){
with_hold ($sym[$p]);
//	echo "ON" .$sym[$p] . "<br />";
}
elseif($withhold_him_or_her[$p] == "off") {
release_with_hold ($sym[$p]);

}


$p++;
}
echo "Result successfully withheld/released of the selected students<br /><a href='tools.php?id=006&school=$school'>Go Back</a>";
}
}







?>
