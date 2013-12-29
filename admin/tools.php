<?php

if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access!");

}
else{
if (!isset($anappleinabasket)){
require("func_library.php");
}
allow_in_admin_and_data_manager_only_zone();

if (!isset($_GET['id'])){
echo "<font face='Arial' size='2'>";
echo "Please select a option from below!";
echo "<br />";
echo "<ul type='square'>";
echo "<li><a href='?id=01'>Corrections</a></li>";
echo "<li><a href='?id=02'>Result</a></li>";
echo "<li><a href='?id=03'>Ledger</a></li>";
echo "<li><a href='?id=04'>Statistics</a></li>";
echo "<li><a href='?id=05'>Fail Ledger</a></li>";
echo "<li><a href='?id=06'>Withheld</a></li>";
echo "<li><a href='?id=07'>Lock Users</a></li>";
echo "<li><a href='optional_numbers.php'>Optional Numbers</a></li>";
echo "<li><a href='index.php'>Go Back</a></li>";
echo "</ul>";



}
else {
$id = $_GET['id'];

if ($id == "01"){
//corrections
$bulbul = 1;
require ("corrections.php");

}
elseif ($id == "02"){
//result
$bulbul = 1;
require ("result.php");

}
elseif ($id == "03"){
//ledger
$bulbul = 1;
require ("ledger.php");
}
elseif ($id == "04"){
//ledger
$bulbul = 1;
require ("statistics.php");
}
elseif ($id == "05"){
//ledger
$bulbul = 1;
require ("fail_ledger.php");
}
elseif ($id == "06"){
//ledger
$bulbul = 1;
require ("withheld.php");
}
elseif ($id == "07"){
//ledger
$bulbul = 1;
require ("lockusers.php");
}



else {
	die ("ERROR: Undefined id!");
}




}


}
?>