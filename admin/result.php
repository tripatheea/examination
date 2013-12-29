<?php

if (!isset($anappleinabasket)){
require("func_library.php");
}

if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access!");

}
else{

if (!isset($bulbul)){
die ("ERROR: Unauthorized access!");
}
else{


if (!isset($_GET['cat'])){


//compile result first

//compilation finished; proceed


echo "<font face='Arial' size='2'>";
echo "Please select a category from below!";
echo "<br />";
echo "<ul type='square'>";
echo "<li><a href='?id=02&cat=01'>Distinction</a></li>";
echo "<li><a href='?id=02&cat=02'>First Division</a></li>";
echo "<li><a href='?id=02&cat=03'>Second Division</a></li>";
echo "<li><a href='?id=02&cat=04'>Third Division</a></li>";
echo "<li><a href='?id=02&cat=05'>Failures</a></li>";
echo "<li><a href='?id=02&cat=06'>Withheld</a></li>";
echo "<li><a href='?id=02&cat=07'>Disqualified</a></li>";
echo "<li><a href='?id=02&cat=08'>All Passed</a></li>";
echo "<li><a href='tools.php'>Go Back</a></li>";
echo "</ul>";

}



else{

$cat = $_GET['cat'];
if ($cat == "01"){
$div = "Distinction";
}
elseif ($cat == "02"){
$div = "First";
}
elseif ($cat == "03"){
$div = "Second";
}
elseif ($cat == "04"){
$div = "Third";
}


if (($cat == "01") || ($cat == "02") || ($cat == "03") || ($cat == "04")){
//DIST, IST, IIND OR IIIRD

require("../connection.php");
// create query
$query = "SELECT * FROM marks WHERE division = '$div' AND withheld = '0'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
$no = mysql_num_rows($result);
$p = 1;
echo "<table border='0' cellpadding='2'>\n";
while ($p <= $no){
$row = mysql_fetch_assoc($result);
$sym = $row['symbol_no'];
if ((($p-1) % 10) == 0){
echo "</tr>\n";
echo "<tr>\n";
echo "<td>" . $sym . "</td>\n";

}
else {
echo "<td>" . $sym . "</td>\n";
}
$p++;
}
echo "</table>\n";
}
}
elseif ($cat == "05"){
//FAILURE
require("../connection.php");
// create query
$query = "SELECT * FROM marks WHERE pass = 'Fail' AND withheld = '0'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
$no = mysql_num_rows($result);
$p = 1;
echo "<table border='0' cellpadding='2'>\n";
while ($p <= $no){
$row = mysql_fetch_assoc($result);
$sym = $row['symbol_no'];
if ((($p-1) % 10) == 0){
echo "</tr>\n";
echo "<tr>\n";
echo "<td>" . $sym . "</td>\n";

}
else {
echo "<td>" . $sym . "</td>\n";
}
$p++;
}
echo "</table>\n";
}
}
elseif ($cat == "06"){
//WITHELD
require("../connection.php");
// create query
$query = "SELECT * FROM marks WHERE withheld = '1'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
$no = mysql_num_rows($result);
$p = 1;
echo "<table border='0' cellpadding='2'>\n";
while ($p <= $no){
$row = mysql_fetch_assoc($result);
$sym = $row['symbol_no'];
if ((($p-1) % 10) == 0){
echo "</tr>\n";
echo "<tr>\n";
echo "<td>" . $sym . "</td>\n";

}
else {
echo "<td>" . $sym . "</td>\n";
}
$p++;
}
echo "</table>\n";
}
}
elseif ($cat == "07"){
//DISQUALIFIED
require("../connection.php");
// create query
$query = "SELECT * FROM marks WHERE disqualified = '1'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
$no = mysql_num_rows($result);
$p = 1;
echo "<table border='0' cellpadding='2'>\n";
while ($p <= $no){
$row = mysql_fetch_assoc($result);
$sym = $row['symbol_no'];
if ((($p-1) % 10) == 0){
echo "</tr>\n";
echo "<tr>\n";
echo "<td>" . $sym . "</td>\n";

}
else {
echo "<td>" . $sym . "</td>\n";
}
$p++;
}
echo "</table>\n";
}
}
elseif ($cat == "08"){
//FAILURE
require("../connection.php");
// create query
$query = "SELECT * FROM marks WHERE pass = 'Pass' AND withheld = '0'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
$no = mysql_num_rows($result);
$p = 1;
echo "<table border='0' cellpadding='2'>\n";
while ($p <= $no){
$row = mysql_fetch_assoc($result);
$sym = $row['symbol_no'];
if ((($p-1) % 10) == 0){
echo "</tr>\n";
echo "<tr>\n";
echo "<td>" . $sym . "</td>\n";

}
else {
echo "<td>" . $sym . "</td>\n";
}
$p++;
}
echo "</table>\n";
}
}
else{
die ("ERROR: Invalid cat");
}
}
}
}
?>