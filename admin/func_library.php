<?php

$anappleinabasket = "yndmoue";

function validate($user, $pass) {
$a = strlen($user);
$b = strlen($pass);
$x=0;
	while ($x <= ($a-1)){
		$p = substr($user,$x,1);
		if (((ord($p)>=65) && (ord($p)<=90)) || ((ord($p)>=97) && (ord($p)<=122)) || ((ord($p)>=48) && (ord($p)<=57))|| (ord($p)==46) || (ord($p)==95)){
			//username in correct form
			//validate password
			$y=0;
			while ($y <= ($b-1)){
				$q = substr($pass,$y,1);
					if (((ord($q)>=65) && (ord($q)<=90)) || ((ord($q)>=97) && (ord($q)<=122)) || ((ord($q)>=48) && (ord($q)<=57))|| (ord($q)==46) || (ord($q)==95)){
					//password also in correct form
					//return true;
					return true;
					}
					else
					{
					//data incorrect
					return false;
					break;
					}
				$y++;
			}
		}
		else{
		//data incorrect
		return false;
		break;
		}
		$x++;
	}
}


function success ($username, $password){
$password = sha1($password);
require ("../connection.php");
// create query
$query = "SELECT * FROM users WHERE username = '$username'
AND password = '$password' AND locked = 0";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
//one row returned; successful login
$row = mysql_fetch_assoc($result);
$userid = $row['user_id'];





//start new session and set a new cookie to store userid
session_start();
$_SESSION['basket_auth'] = 1;
setcookie("basket_id", $userid, time()+(3600*4), "/",
			"", 0);
			
	
	
	
header( 'refresh: 0; url=../admin/' );
// free result set memory
mysql_free_result($result);

// close connection
mysql_close($connection);
return true;

}
else
{
// free result set memory
mysql_free_result($result);

// close connection
mysql_close($connection);
return false;
}

}

function access_level($userid){
require ("../connection.php");
// create query
$query = "SELECT * FROM users WHERE user_id = '$userid'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
return $row['access_level'];
}
}


function access_type($userid){
require ("../connection.php");
// create query
$query = "SELECT * FROM users WHERE user_id = '$userid'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
return $row['access_type'];
}

}




function user_name($userid){
require ("../connection.php");
// create query
$query = "SELECT * FROM users WHERE user_id = '$userid'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
return $row['name'];
}
}

function username20($userid){
require ("../connection.php");
// create query
$query = "SELECT * FROM users WHERE user_id = '$userid'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
return $row['username'];
}
}

function data_empty() {
$i = 0;
$a = "";
// get the arguments
$args = func_get_args();
foreach ($args as $arg) {
	if (strlen($arg) == 0){
		$a .= "empty";
	}
	else {
		$a .= "";
	}
$i++;	
}
if (!strlen($a) == 0){
	//empty
	return true;
}
else {
	//not empty
	return false;
}

}



function add_users($name , $username , $password , $access_level , $access_type , $user_created_by ){
	require ("../connection.php");
	// create query
	$query = "INSERT INTO users ( name , username , password , access_level , access_type , user_created_by , user_created_on)
	VALUES ( '$name' , '$username' , '$password' , '$access_level' , '$access_type' , '$user_created_by' , now())";
	// execute querys
	$result = mysql_query($query) or die ("Error in query: $query.
	" . mysql_error());


	// close connection
	mysql_close($connection);
	
	$success = true;
	return $success;
}


function subject_name ($subject){

require ("../connection.php");
// create query
$query = "SELECT * FROM subjects WHERE subject_code = '$subject'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
return $row['name'];
}
else {

if (($subject == "OPTI") || ($subject == "OPTII") ){
	return $subject;
}
else{
die ("ERROR:: Invalid subject code!");
}
}
}



function school_name ($school){

require ("../connection.php");
// create query
$query = "SELECT * FROM schools WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
return $row['name'];
}
else {
die ("ERROR:: Invalid school code!");
}
}


function school_address ($school){

require ("../connection.php");
// create query
$query = "SELECT * FROM schools WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
return $row['address'];
}
else {
die ("ERROR:: Invalid school code!");
}
}


function division($percent){
if (($percent >= 80) && ($percent <= 100)){
return "Distinction";
}
elseif (($percent >= 60) && ($percent < 80)){
return "First";
}
elseif (($percent >= 45) && ($percent < 60)){
return "Second";
}
elseif (($percent >= 32) && ($percent < 45)){
return "Third";
}
elseif (($percent < 32) && ($percent >= 0)) {
return "Failed";
}
elseif ($percent == 0){
return "Absent";
} 
else {
return "No division!";
}
}


function pass($opti_choice , $optii_choice , $eng_th , $eng_pr , $nepali , $maths , $sci_th , $sci_pr , $social , $hpe_th , $hpe_pr , $opti , $optii_th , $optii_pr){
$opti_th_pm = 0;
$optii_th_pm = 0;
$optii_pr_pm = 0;

if (($eng_th == "52") && ($eng_pr == "24") && ($nepali == "41") && ($maths == "41")){
//die ($opti_choice . " " . $optii_choice . " " . $eng_th . " " . $eng_pr . " " . $nepali . " " . $maths . " " . $sci_th . " " . $sci_pr . " " . $social . " " . $hpe_th . " " . $hpe_pr . " " . $opti . " " . $optii_th . " " . $optii_pr);
}

require("../connection.php");
// create query
$query = "SELECT * FROM subjects WHERE subject_code = '$opti_choice'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$opti_th_pm = $row['theory_pm'];
}
else {
//die ("Unknown subject!");
}
// free result set memory
mysql_free_result($result);
// create query
$query = "SELECT * FROM subjects WHERE subject_code = '$optii_choice'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$optii_th_pm = $row['theory_pm'];
$optii_pr_pm = $row['practical_pm'];
}
else {
//die ("Unknown subject!");
}
// free result set memory
mysql_free_result($result);


if (($eng_th >= 24) && ($nepali >=32) && ($maths >=32) && ($sci_th >= 24) && ($social >=32) && ($hpe_th >= 24) && ($opti >= $opti_th_pm) && ( $optii_th >= $optii_th_pm) && ($eng_pr >= 10) && ($sci_pr >= 10) && ($hpe_pr >= 10) && ( $optii_pr >= $optii_pr_pm)){

return "Pass";

}
else {
return "Fail";
}

}



function build_access_type ($eng , $nep , $math , $sci , $social , $health  , $opti , $optii , $pra){


/*FOR CODER'S REFERENCE ONLY
the access type will be simply something like 1 for access and 0 for no access
the total number representing the access_type so will be of 9 digits.
it will be binary, something like 101101110, which represents access in eng, math, sci, health, opti, optii only
CODER'S REFERENCE ENDS
*/

if ($eng == true){
	$eng = "1";
}
elseif ($eng == false){
	$eng = "0";
}
if ($nep == true){
	$nep = "1";
}
elseif ($nep == false){
	$nep = "0";
}
if ($math == true){
	$math = "1";
}
elseif ($math == false){
	$math = "0";
}
if ($sci == true){
	$sci = "1";
}
elseif ($sci == false){
	$sci = "0";
}
if ($social == true){
	$social = "1";
}
elseif ($social == false){
	$social = "0";
}
if ($health == true){
	$health = "1";
}
elseif ($health == false){
	$health = "0";
}
if ($opti == true){
	$opti = "1";
}
elseif ($opti == false){
	$opti = "0";
}
if ($optii == true){
	$optii = "1";
}
elseif ($optii == false){
	$optii = "0";
}
if ($pra == true){
	$pra = "1";
}
elseif ($pra == false){
	$pra = "0";
}



$access_type = $eng . $nep . $math . $sci . $social . $health  . $opti . $optii . $pra;
return $access_type;



}






function correct_characters(){
$basket = 1;
// get the arguments
$args = func_get_args();
foreach ($args as $arg) {


if (preg_match('/^[a-z0-9,._ ]+$/i', $arg)) {
// match
$basket = 2 * $basket;
}
else
{
// no match
$basket = 0 * $basket;
} 

}
if (!$basket == 0){
	return true;
}
else {
	return false;
}
}



function anka_matra(){
$basket = 1;
// get the arguments
$args = func_get_args();
foreach ($args as $arg) {


if (preg_match('/^[0-9 ]+$/i', $arg)) {
// match
$basket = 2 * $basket;
}
else
{
// no match
$basket = 0 * $basket;
} 

}
if (!$basket == 0){
	return true;
}
else {
	return false;
}



}

function with_hold ($sym987){
require("../connection.php");
// create query
$query = "UPDATE marks
SET withheld = '1'
WHERE symbol_no='$sym987'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}





function release_with_hold($sym987){

require("../connection.php");
// create query
$query = "UPDATE marks
SET withheld = '0'
WHERE symbol_no='$sym987'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}


function pass_fail ($sym , $opti_choice , $optii_choice , $eng_th , $eng_pr , $nep , $maths , $sci_th , $sci_pr ,$social , $hpe_th , $hpe_pr , $opti , $optii_th , $optii_pr){


require("../connection.php");
if ($eng_th < 24){
// create query
$query = "UPDATE marks
SET english_th = '24'
WHERE symbol_no='$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}
if ($eng_pr < 10){
// create query
$query = "UPDATE marks
SET english_pr = '10'
WHERE symbol_no='$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}
if ($nep < 32){
// create query
$query = "UPDATE marks
SET nepali = '32'
WHERE symbol_no='$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}

if ($maths < 32){
// create query
$query = "UPDATE marks
SET maths = '32'
WHERE symbol_no='$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}

if ($sci_th < 24){

// create query
$query = "UPDATE marks
SET science_th = '24'
WHERE symbol_no='$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}

if ($sci_pr < 10){
// create query
$query = "UPDATE marks
SET science_pr = '10'
WHERE symbol_no='$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}

if ($social < 32){
// create query
$query = "UPDATE marks
SET social = '32'
WHERE symbol_no='$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}

if ($hpe_th < 24){
// create query
$query = "UPDATE marks
SET hpe_th = '24'
WHERE symbol_no='$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}
if ($hpe_pr < 10){
// create query
$query = "UPDATE marks
SET hpe_pr = '10'
WHERE symbol_no='$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}

// create query
$query = "SELECT * FROM subjects WHERE subject_code = '$opti_choice'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$opti_th_pm = $row['theory_pm'];

}
else {
echo $opti_choice . "   " . $optii_choice;
//die ("Unknown subject!");
}
// free result set memory
mysql_free_result($result);
// create query
$query = "SELECT * FROM subjects WHERE subject_code = '$optii_choice'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$optii_th_pm = $row['theory_pm'];
$optii_pr_pm = $row['practical_pm'];

}
else {
//die ("Unknown subject!");
}
// free result set memory
mysql_free_result($result);








if ($opti < $opti_th_pm){
// create query
$query = "UPDATE marks
SET opti = '$opti_th_pm'
WHERE symbol_no='$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}

if ($optii_th < $optii_th_pm ){
// create query
$query = "UPDATE marks
SET optii_th = '$optii_th_pm'
WHERE symbol_no='$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}

if ($optii_pr < 24){
// create query
$query = "UPDATE marks
SET optii_pr = '$optii_pr_pm'
WHERE symbol_no='$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}


//RECOMPILE RESULT











// create query
$query = "SELECT * FROM marks";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$p = 1;
$no = mysql_num_rows($result);
while ($p <= $no){




$row = mysql_fetch_assoc($result);
$chinha[$p] = $row['id'];
$a[$p] = $row['english_th'];
$b[$p] = $row['english_pr'];
$c[$p] = $row['nepali'];
$d[$p] = $row['maths'];
$e[$p] = $row['science_th'];
$f[$p] = $row['science_pr'];
$g[$p] = $row['social'];
$h[$p] = $row['hpe_th'];
$i[$p] = $row['hpe_pr'];
$j[$p] = $row['opti'];
$k[$p] = $row['optii_th'];
$l[$p] = $row['optii_pr']; 
$opti_rozai[$p] = $row['opti_choice'];
$optii_rozai[$p] = $row['optii_choice'];
$total[$p] = $a[$p] + $b[$p] + $c[$p] + $d[$p] + $e[$p] + $f[$p] + $g[$p] + $h[$p] + $i[$p] + $j[$p] + $k[$p] + $l[$p];
$percent[$p] = $total[$p]/8;
$passbhae[$p] = pass($opti_rozai[$p] , $optii_rozai[$p] , $a[$p] , $b[$p] , $c[$p] , $d[$p] , $e[$p] , $f[$p] , $g[$p] , $h[$p] , $i[$p] , $j[$p] , $k[$p] , $l[$p]);

if ($passbhae[$p] == "Pass"){
$division[$p] = division($percent[$p]);
}
else {
$division[$p] = "-";
}

$ready[$p] = "1";

$p++;
}

// free result set memory
mysql_free_result($result);


$p = 1;
while ($p <= $no){

// create query
$query = "UPDATE marks
SET total='$total[$p]' , percent='$percent[$p]' , division='$division[$p]' , pass='$passbhae[$p]' , ready='$ready[$p]'
WHERE id='$chinha[$p]'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
$p++;
}



























}







function user_logged_on(){
if (!isset($_COOKIE['basket_id'])){
	die ("ERROR:: ACCESS DENIED!");
}
else {
}



}



function allow_in_admin_and_data_manager_only_zone(){
//admin and date manager only zone refers to the following:
/*
ALL ADMISSION CARDS
ALL REPORT CARDS
ALL REMOVE OPTIONS
ALL SCHOOLS
ALL TOOLS
*/
$userid2 = $_COOKIE['basket_id'];
$access_level2 = access_level ($userid2);
if (($access_level2 == 3) || ($access_level2 == 4)){
	die ("ERROR:: ACCESS DENIED!");
}
elseif (($access_level2 == 0) || ($access_level2 == 1) || ($access_level2 == 2)){
$he = "good";
}
else {
	die ("ERROR:: ACCESS DENIED!");
}
}
function allow_in_admin_only_zone(){
//admin only zone refers to the following:
/*
ALL REMOVE STUFFS
SETTINGS
*/
$userid2 = $_COOKIE['basket_id'];
$access_level2 = access_level ($userid2);
if (($access_level2 == 3) || ($access_level2 == 4)){
	die ("ERROR:: ACCESS DENIED!");
}
elseif (($access_level2 == 0) || ($access_level2 == 1) || ($access_level2 == 2)){
$he = "good";
}
else {
	die ("ERROR:: ACCESS DENIED!");
}
}

function marks_allowed($subject){

$userid20 = $_COOKIE['basket_id'];
$access_level = access_level($userid20);
$access_type = access_type($userid20);
if (($access_level == 0) || ($access_level == 1) || ($access_level == 2)){
	return true;
}
elseif (($access_level == 4) && ($subject == "practicals")){
	return true;
}
elseif ($access_level == 3){

if (($subject == "english") && ((substr(($access_type), 0 , 1)) == 1)){
	return true;
}
elseif (($subject == "nepali") && ((substr(($access_type), 1 , 1)) == 1)){
	return true;
}
elseif (($subject == "mathematics") && ((substr(($access_type), 2 , 1)) == 1)){
	return true;
}
elseif (($subject == "science") && ((substr(($access_type), 3 , 1)) == 1)){
	return true;
}
elseif (($subject == "social") && ((substr(($access_type), 4 , 1)) == 1)){
	return true;
}
elseif (($subject == "hpe") && ((substr(($access_type), 5 , 1)) == 1)){
	return true;
}
elseif (($subject == "opti") && ((substr(($access_type), 6 , 1)) == 1)){
	return true;
}
elseif (($subject == "optii") && ((substr(($access_type), 7 , 1)) == 1)){
	return true;
}
elseif (($subject == "practicals") && ((substr(($access_type), 8 , 1)) == 1)){
	return true;
}	
	
	
}




}


function add_marks_range_correct($subject234, $marks , $type){


require ("../connection.php");
if (($type == "practical") && (($subject234 == "OPTI") || ($subject234 == "OPTII"))){
$full_marks = 50;
}
elseif (($type == "theory") && (($subject234 == "OPTI") || ($subject234 == "OPTII"))){
$full_marks = 100;
}
elseif (($subject234 != "OPTI") || ($subject234 != "OPTII")){
// create query
$query = "SELECT * FROM subjects WHERE subject_code = '$subject234'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
if (mysql_num_rows($result) == 1){
$row = mysql_fetch_assoc($result);
if ($type == "theory"){
$full_marks = $row['theory_fm'];
}
else{
$full_marks = $row['practical_fm'];
}
}
else {
	die ("ERROR: Invalid subject");
}
}
//echo $marks;
// free result set memory
//mysql_free_result($result);
//close connection
mysql_close($connection);
if (($marks >= 0) && ($marks <= $full_marks)){
	return true;
}
else {
	return false;
}


}


function convert_to_sub_code($subjectaa){

require ("../connection.php");
// create query
$query = "SELECT * FROM subjects WHERE name = '$subjectaa'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$row = mysql_fetch_assoc($result);
return $row['subject_code'];
// free result set memory
mysql_free_result($result);
//close connection
mysql_close($connection);

}

function lock_gara_user($naaun){
require("../connection.php");
// create query
$query = "UPDATE users
SET locked = '1'
WHERE username='$naaun'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}

function unlock_gara_user($naaun){
require("../connection.php");
// create query
$query = "UPDATE users
SET locked = '0'
WHERE username='$naaun'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
}

function get_exam_status(){
	require ("../connection.php");
	// create query
	$query = "SELECT * FROM settings WHERE field = 'result_status'";
	// execute querys
	$result = mysql_query($query) or die ("Error in query: $query.
	" . mysql_error());
	$row = mysql_fetch_assoc($result);
	return $row['value'];
}


?>