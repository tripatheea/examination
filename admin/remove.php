<?php
if (!isset($anappleinabasket)){
require("func_library.php");
}
allow_in_admin_only_zone();

if (!isset($_POST['bulbul'])){
	die("ERROR: Access Denied!");
}
else{
?>
<?php
//correct way; now check which department
$dept = $_POST['dept'];
if ($dept == "user" ){

//processing for remove user begins
require("../connection.php");
$no = $_POST['no'];
$p = 1;
while ($p <= $no){

if (isset($_POST['del_' . $p])){

if ($_POST['del_' . $p] == "on"){
$user = $_POST['user_' . $p];
// create query
$query = "DELETE FROM users WHERE username = '$user'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
}
}


$p++;
}

if($no == 1){
echo "User removed successfully! :)";
}
else {

echo "Users removed successfully! :)";
}




}
//next department
//schools

if ($dept == "school" ){

//processing for remove school begins
require("../connection.php");
$no = $_POST['no'];
$p = 1;
while ($p <= $no){

if (isset($_POST['del_' . $p])){

if ($_POST['del_' . $p] == "on"){
$school = $_POST['school_' . $p];

// create query
$query = "SELECT * FROM schools WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$row = mysql_fetch_assoc($result);
$school_name = $row['name'];
// free result set memory
mysql_free_result($result);
// create query
$query = "DELETE FROM users WHERE name = '$school_name'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// create query
$query = "DELETE FROM schools WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// create query
$query = "DELETE FROM marks WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());





}



}


$p++;
}
if($no == 1){
echo "School and corresponding user removed successfully! :)";
}
else {

echo "Schools and corresponding users removed successfully! :)";
}


}

//next department
//students


if ($dept == "student" ){

//processing for remove student begins
require("../connection.php");
$no = $_POST['no'];
$p = 1;
while ($p <= $no){

if (isset($_POST['del_' . $p])){

if ($_POST['del_' . $p] == "on"){
$sym = $_POST['sym_' . $p];
// create query
$query = "DELETE FROM marks WHERE symbol_no = '$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
}
}


$p++;
}
if($no == 1){
echo "Student removed successfully! :)";
}
else {

echo "Students removed successfully! :)";
}


}











?>
<?php
}

?>