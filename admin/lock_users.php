<?php
if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access!");

}
else{

if (!isset($_POST['bulbul'])){
die ("ERROR: Unauthorized access!");
}
else{
require ("../connection.php");
if (!isset($anappleinabasket)){
require("func_library.php");
}
allow_in_admin_and_data_manager_only_zone();
$no = $_POST['no'];

$p = 1;
while ($p <= $no){
$usernaam123[$p] = $_POST['username_' . $p];
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
if(isset($_POST['lock_' . $p])){
$lock_user987[$p] = $_POST['lock_' . $p];
}
else {
$lock_user987[$p] = "off";
}

if ($lock_user987[$p] == "on"){
lock_gara_user ($usernaam123[$p]);
//	echo "ON" .$sym[$p] . "<br />";
}
elseif($lock_user987[$p] == "off") {
unlock_gara_user ($usernaam123[$p]);

}


$p++;
}
echo "Selected users successfully locked!<br /><a href='tools.php?id=007'>Go Back</a>";
}
}







?>
