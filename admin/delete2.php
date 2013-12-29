<?php

if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access!");

}
else{


if (!isset($anappleinabasket)){
require("func_library.php");
}



if((!isset($_POST['pass1'])) || (!isset($_POST['pass1']))){
	die ("Password not enterred!");
}
else {
$passs1 = $_POST['pass1'];
$passs2 = $_POST['pass2'];
if (data_empty($passs1 , $passs2) == true){
die ("Please enter both passwords! Hit the Back key of your Browser to go back!");
}


if (correct_characters($passs1 , $passs2) == false){
die ("Invalid character enterred! Only alphanumeric characters allowed! Hit the Back key of your Browser to go back!");
}

$userid = $_COOKIE['basket_id'];
$passs1 = sha1($passs1);
$passs2 = sha1($passs2);
require("../connection.php");
// create query
$query = "SELECT * FROM users WHERE user_id = '$userid'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$row = mysql_fetch_assoc($result);
$khaas_pass = $row['password'];
// free result set memory
mysql_free_result($result);

if (($passs1 == $khaas_pass) && ($passs2 == $khaas_pass)){

// create query
$query = "DELETE FROM marks";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// create query
$query = "DELETE FROM schools";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// create query
$query = "DELETE FROM users WHERE access_level > 1";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());

die ("Congratulations! All data deleted succcessfully except administrator's account details and settings!");
}
else {

die ("Invalid password enterred! Hit the Back key of your Browser to go back!");
}




}















}






?>