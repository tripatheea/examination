<?php
if (!isset($anappleinabasket)){
require("func_library.php");
}

user_logged_on();

if (!isset($_POST['bulbul'])){
	die("ERROR: Access Denied!");
}
else{
?>
<?php
//correct way; now check which department
$dept = $_POST['dept'];
if ($dept == "user" ){

//processing for add user begins
require ("../connection.php");
function subjects($subject){

	if(!isset($_POST[$subject])){
		return false;
	}
	else {
		if ($_POST[$subject] == "on"){
			return true;
		}
		else {
			return true;
		}
	}
}
$userid = $_COOKIE['basket_id'];
//data processing
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$privelages = $_POST['privelages'];



// CHECKING FOR DATA REDUNDANCY BEGINS

$noom = $name;
$usernoom = $username;
// create query
$query = "SELECT * FROM users";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
if (mysql_num_rows($result) >= 1) {

$p = 1;
while ($p <= mysql_num_rows($result)){
$row = mysql_fetch_assoc($result);
$naaun = $row['name'];
$usernaaun = $row['username'];
$naaun = trim(strtolower($naaun));
$usernaaun = trim(strtolower($usernaaun));
$noom = trim(strtolower($noom));
$usernoom = trim(strtolower($usernoom));
if (($naaun == $noom) || ($usernaaun == $usernoom)){
	die ("ERROR: The data enterred already exists there in the database!");
}
else {

}
$p++;
}
}

// free result set memory
mysql_free_result($result);


//CHECKING FOR DATA REDUNDACNY ENDS







$english = subjects('CMP01');
$nepali = subjects('CMP02');
$mathematics = subjects('CMP03');
$science = subjects('CMP04');
$social = subjects('CMP05');
$health = subjects('CMP06');
$opti = subjects('OPTI');
$optii = subjects('OPTII');
$practicals = subjects('pra');





if (($privelages == "Administrator") || ($privelages == "Data Manager")){
$access_type = "111111111";
}
elseif (($privelages == "Data Manager(Limited)") || ($privelages == "School")){
$access_type = build_access_type($english , $nepali , $mathematics , $science , $social , $health  , $opti , $optii , $practicals);
}
else {
$access_type = "000000000";
}




$data_status = data_empty($name, $username, $password, $privelages);
$correct_chars = correct_characters($name, $username, $password);
$password = sha1($password);
if (($data_status == true) || ($correct_chars == false)){

die ("ERROR: Please complete the forms with proper characters. All fields must be completely filled and only alphanumeric characters are allowed!");
}
elseif (($data_status == false) && ($correct_chars == true)) {
 
 //data good; proceed 
 
 // check  for valid characters in each field
 
	//build access level
	if ($privelages == "Administrator"){
		$access_level = 1;
	}
	elseif ($privelages == "Data Manager"){
		$access_level = 2;
	}
	elseif ($privelages == "Data Manager(Limited)"){
		$access_level = 3;
	}	
	elseif ($privelages == "School"){
		$access_level = 4;
	}	
	else {
		$access_level = 9;
	}
 
//build user created by
// create query
$query = "SELECT * FROM users WHERE user_id = '$userid'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
$row = mysql_fetch_assoc($result);
$user_created_by = $row['name'];
// free result set memory
mysql_free_result($result);
// close connection
mysql_close($connection);
 
 

$success = add_users($name , $username , $password , $access_level , $access_type , $user_created_by);


if (!isset($success)){
echo "User addition failed! Please <a href='http://example.com/admin/'>click here</a> to go Back!";
}
else {
if ($success == true){
echo "User added successfully! Please <a href='http://example.com/admin/'>click here</a> to go Back!";
}
}




}
}

elseif ($dept == 'marks'){
// processing for add marks begins






$no = $_POST['no_of_rows_enterred'];
$subject = $_POST['subject'];
$select = $_POST['select'];
global $subject;
$bishaya = "paraasthiimsah";

if ($subject == "CMP01"){
	$bishaya = "english";
}
elseif ($subject == "CMP02"){
	$bishaya = "nepali";
}
elseif ($subject == "CMP03"){
	$bishaya = "mathematics";
}
elseif ($subject == "CMP04"){
	$bishaya = "science";
}
elseif ($subject == "CMP05"){
	$bishaya = "social";
}
elseif ($subject == "CMP06"){
	$bishaya = "hpe";
}
elseif ($subject == "OPTI"){
	$bishaya = "opti";
}
elseif ($subject == "OPTII"){
	$bishaya = "optii";
}


if (!$select == "pra"){
if (!marks_allowed($bishaya) == true){
	die ("ERROR: Access Denied!");
}
}





if ($select == "th"){


//data validation



$i = 1;
while ($i <= $no){
	$marks[$i] = $_POST['marks_' . $i];
	$symbol_no[$i] = $_POST['symbol_' . $i];
$i++;
}

$i = 1;
while ($i <= $no){

if (($subject == "OPTI") || ($subject == "OPTII")){
$subject987 = $subject;
}
else{
$subject987 = convert_to_sub_code($subject);
}



$status = data_empty($marks[$i]);
$correct_chars = anka_matra($marks[$i]);
$correct_range = add_marks_range_correct($subject987, $marks[$i] , "theory");

//echo $correct_range;
	if (($status == true) || ($correct_chars == false) || ($correct_range == false)){
		
		die("ERROR: Please complete the forms with proper characters within the correct range for the chosen subject. 
		All fields must be completely filled and only numeric characters are allowed!" );
	}
	else {
		//all fields filled; now check if data is in correct format or not
		// DO NOT FORGET TO VALIDATE DATA AT ANY COST
			//DATA ALREADY VALIDATED; SIMPLY CHECK WHETHER IT'S IN CORRECT RANGE OR NOT
		//use isint() function to check if all data is integer or not; also check if data in correct range or not
		$add_marks = true;
		
	}
	
	
$i++;
}


if($add_marks == true){


$i = 1;
$school = $_POST['school'];
$ko_ho = $_COOKIE['basket_id'];
$ko_ho123 = username20($ko_ho);
$kati123 = access_level($ko_ho);

if (($kati123 == 4) && ($ko_ho123 != $school)){
	die ("Access Denied! You can't enter other school's marks");
}

require("../connection.php");




if (strtolower($subject) == "health population and environment"){
	$subject = "hpe";
}
elseif (strtolower($subject) == "mathematics"){
	$subject = "maths";
}
elseif (strtolower($subject) == "social studies"){
	$subject = "social";
}

if (($subject == "English") || ($subject == "Science") || ($subject == "hpe") || ($subject == "OPTII")){
	$subject = strtolower($subject) . "_th";
}
else {
	$subject = strtolower($subject);
}





	
$i = 1;
while ($i <= $no){

$ma = $marks[$i];
$kaskoma = $symbol_no[$i];
// create query
$query = "UPDATE marks
SET $subject='$ma'
WHERE symbol_no='$kaskoma'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
$i++;
} 

		echo "Congratulations! Marks added successfully! Please <a href='http://example.com/admin/'>click here</a> to go Back!";
}
}
elseif ($select == "pra"){


















// processing for add practical marks begins



//data validation




$i = 1;
while ($i <= $no){
	$marks[$i] = $_POST['marks_' . $i];
	
	if (isset($_POST['symbol_1'])){
	$symbol[$i] = $_POST['symbol_' . $i];
	}
	elseif (isset($_POST['sym_1'])){
	$symbol[$i] = $_POST['sym_' . $i];
	}
$i++;
}

$i = 1;
while ($i <= $no){

if (($subject == "OPTI") || ($subject == "OPTII")){

$subject987 = $subject;
}
else{
$subject987 = convert_to_sub_code($subject);
}


$status = data_empty($marks[$i]);
$correct_chars = anka_matra($marks[$i]);
//$correct_range = add_marks_range_correct($subject987, $marks[$i] , "theory");
$correct_range = true;
//echo $correct_range;
	if (($status == true) || ($correct_chars == false) || ($correct_range == false)){
		
		die("ERROR: Please complete the forms with proper characters within the correct range for the chosen subject. 
		All fields must be completely filled and only numeric characters are allowed!" );
	}
	else {
		//all fields filled; now check if data is in correct format or not
		// DO NOT FORGET TO VALIDATE DATA AT ANY COST

		//use isint() function to check if all data is integer or not; also check if data in correct range or not
		
		
		
		
		$add_marks = true;
		
	}
	
	
$i++;
}


if($add_marks == true){







require("../connection.php");
//seperate module for optional I practicals (Geography practicals)

if ($subject == 'OPTI'){

$no234 = $_POST['no_of_rows_enterred'];
$i = 1;
while ($i <= $no234){
$sym456 = $_POST['sym_' . $i];
$ma = $marks[$i];


$ko_ho = $_COOKIE['basket_id'];
$ko_ho123 = username20($ko_ho);
$kati123 = access_level($ko_ho);
// create query
$query = "SELECT * FROM marks WHERE symbol_no = '$sym456'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
	if (mysql_num_rows($result) >= 1) {
		$row = mysql_fetch_assoc($result);
		$school777 = $row['school_code'];
	}
	else {
		$school777 = "0";
	}
		// free result set memory
		mysql_free_result($result);	
	
	

if (($kati123 == 4) && ($ko_ho123 != $school777)){
	die ("Access Denied! You can't enter other school's marks");
}




// create query
$query = "UPDATE marks
SET opti_pr = '$ma'
WHERE symbol_no='$sym456'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
//echo $sym456;
//echo $_POST['sym_' . $i];

$i++;
}

die("Congratulations! Practical Marks added successfully! Please <a href='http://example.com/admin/'>click here</a> to go Back!");
}
else{





$i = 1;
$school = $_POST['school'];
// create query
$query = "SELECT * FROM marks WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
while ($i <= $no){
	$row = mysql_fetch_assoc($result);
	$sym[$i] = $row['symbol_no'];
$i++;
} 
// free result set memory
mysql_free_result($result);



if (strtolower($subject) == "health population and environment"){
	$subject = "hpe";
}


$subject = strtolower($subject) . "_pr";






$i = 1;
while ($i <= $no){

$ma = $marks[$i];
$sy = $symbol[$i];

$ko_ho = $_COOKIE['basket_id'];
$ko_ho123 = username20($ko_ho);
$kati123 = access_level($ko_ho);
// create query
$query = "SELECT * FROM marks WHERE symbol_no = '$sy'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
	if (mysql_num_rows($result) >= 1) {
		$row = mysql_fetch_assoc($result);
		$school777 = $row['school_code'];
	}
	else {
		$school777 = "0";
	}
		// free result set memory
		mysql_free_result($result);	
	
	

if (($kati123 == 4) && ($ko_ho123 != $school777)){
	die ("Access Denied! You can't enter other school's marks");
}





// create query
$query = "UPDATE marks
SET $subject='$ma'
WHERE symbol_no='$sy'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
$i++;
} 

		echo "Congratulations! Practical Marks added successfully! Please <a href='http://example.com/admin/'>click here</a> to go Back!";
}



}

































































}






}

// processing for add school begins
elseif ($dept == "school"){


$no = $_POST['no_of_rows_enterred'];
global $no;
$i = 1;
while ($i <= $no){
	$school_code[$i] = $_POST['school_code_' . $i];
	$school_name[$i] = $_POST['school_name_' . $i];
	$school_address[$i] =  $_POST['school_address_' . $i];

	$i++;
}





// CHECKING FOR DATA REDUNDANCY BEGINS




require("../connection.php");
$p = 1;
while ($p <= $no){
// create query
$query = "SELECT * FROM schools";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
if (mysql_num_rows($result) >= 1) {
$i = 1;
while ($i <= mysql_num_rows($result)){
$row = mysql_fetch_assoc($result);
$naaun = trim(strtolower($row['name']));
$codewa = trim(strtolower($row['school_code']));
$codewa_yahiko = trim(strtolower($school_code[$p]));
$naaun_yahiko = trim(strtolower($school_name[$p]));
if (($naaun == $naaun_yahiko) || ($codewa == $codewa_yahiko)){
	echo "ERROR: The following code or school name already exists in the database!";
	die ("<br />$codewa_yahiko  $naaun_yahiko");
}
else {
}
$i++;
}
}
$p++;
}
// free result set memory
mysql_free_result($result);


//CHECKING FOR DATA REDUNDACNY ENDS















$i = 1;
while ($i <= $no){
	$status = data_empty($school_code[$i],$school_name[$i],$school_address[$i]);
	$correct_chars = correct_characters($school_code[$i],$school_name[$i],$school_address[$i]);
	
	if (($status == true) || ($correct_chars == false)){
		die("ERROR: Please complete the forms with proper characters. All fields must be completely filled and only alphanumeric characters are allowed!");
	}
	else {
		//all fields filled; now check if data is in correct format or not
		// DO NOT FORGET TO VALIDATE DATA AT ANY COST

		
		//SIMILARY ALSO CHECK WHETHER ENTERRED DATA ALREADY EXISTS IN DATABASE OR NOT
		$add_schools = true;
		

	}
	
	
$i++;
}


if($add_schools == true){

		require("../connection.php");
		$i = 1;
		while($i <= $no){
			$code = $school_code[$i];
			$name = $school_name[$i];
			$address = $school_address[$i];
		
		
		


		// create query
		$query = "INSERT INTO schools ( school_code , name , address )
		VALUES ( '$code' , '$name' , '$address')";
		// execute querys
		$result = mysql_query($query) or die ("Error in query: $query.
		" . mysql_error());
		$i++;
		}
		// close connection
		mysql_close($connection);
		//school added successfully
	
		//now create users with corresponding usernames and passwords; usernames = schoolcode; password = schoolcode
		
		$i = 1;
		while($i <= $no){
			$name = $school_name[$i];
			$username = $school_code[$i];
			$password = sha1($school_code[$i]);
			$access_level = "4";
			$access_type = "000000001"; //i.e practicals and adding students only
			$userid = $_COOKIE['basket_id'];
			$user_created_by = user_name($userid);
			
			
				// create query
				$query = "SELECT * FROM users WHERE username = '$username'";
				// execute querys
				$result = mysql_query($query) or die ("Error in query: $query.
				" . mysql_error());
				if (mysql_num_rows($result) == 0) {
					$addusers456 = true;
				}
				
				// free result set memory
				mysql_free_result($result);

				if ($addusers456 == true){
				add_users($name , $username , $password , $access_level , $access_type , $user_created_by);
				}
		
			$i++;
		}
		
		
		
		
		echo "Schools added successfully!";
		
		

}



}
elseif ($dept == "student"){




$no = $_POST['no_of_rows_enterred'];


$school_code = $_POST['school_code'];
//delete the following line and uncomment previous line

$userid200 = $_COOKIE['basket_id'];
$username200 = username20($userid200);
$access_level20 = access_level($userid200);
if (($access_level20 == 4) && (!$username200 == $school_code)){
	die ("ERROR: Access Denied!");
}

$i = 1;
while ($i <= $no){
	$symbolno[$i] = $_POST['symbolno_' . $i];
	$name[$i] = $_POST['name_' . $i];
	$dob1[$i] = $_POST['dob1_' . $i];
	$dob2[$i] = $_POST['dob2_' . $i];
	$dob3[$i] = $_POST['dob3_' . $i];
	$opti[$i] = $_POST['opti_' . $i];
	$optii[$i] = $_POST['optii_' . $i];	
	
$i++;
}






// CHECKING FOR DATA REDUNDANCY BEGINS




require("../connection.php");
$i = 1;
while ($i <= $no){
// create query
$query = "SELECT * FROM marks";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
if (mysql_num_rows($result) >= 1) {
$p = 1;
while ($p <= mysql_num_rows($result)){
$row = mysql_fetch_assoc($result);
$naaun = trim(strtolower($row['name']));
$naaun_yahiko = trim(strtolower($name[$i]));
/*
if ($naaun == $naaun_yahiko){
	echo "The following student already exists in the database!";
	die ("<br />$naaun_yahiko");
}
*/
$p++;
}
}
$i++;
}
// free result set memory
mysql_free_result($result);


//CHECKING FOR DATA REDUNDACNY ENDS

















$i = 1;
while ($i <= $no){
	$status = data_empty($symbolno[$i],$name[$i],$opti[$i],$optii[$i]);
	$correct_chars = correct_characters($symbolno[$i],$name[$i],$opti[$i],$optii[$i]);
	if (anka_matra($dob1[$i] , $dob2[$i] , $dob3[$i]) == false){
		die("ERROR: Please complete the forms with proper characters. All fields must be completely filled and only numeric characters are allowed!");
		}
	if (($dob1[$i] == "00") && ($dob2[$i] == "00") & ($dob3[$i] == "00")){
	}
	else {
	if (($dob1[$i] < 40) || ($dob2[$i] < 1) || ($dob2[$i] > 12) || ($dob3[$i] < 1) || ($dob3[$i] > 32)){
		die("ERROR: Please complete the forms with proper characters. All fields must be completely filled and only numeric characters are allowed!");
	}
	}
	//IT"S IMPORTANT; READ THIS
	//DO NOT FORGET TO VALIDATE DATES 
	$dob[$i] = $dob1[$i] . "/" . $dob2[$i] . "/" . $dob3[$i];
	if (($status == true) || ($correct_chars == false)){
		die("ERROR: Please complete the forms with proper characters. All fields must be completely filled and only alphanumeric characters are allowed!");
	}
	else {
		//all fields filled; now check if data is in correct format or not
		// DO NOT FORGET TO VALIDATE DATA AT ANY COST
	//IT"S IMPORTANT; READ THIS
	//DO NOT FORGET TO VALIDATE DATES 
		
		//SIMILARY ALSO CHECK WHETHER ENTERRED DATA ALREADY EXISTS IN DATABASE OR NOT
		$add_schools = true;
	}	
$i++;
}
if($add_schools == true){

		require("../connection.php");
		$i = 1;
		while($i <= $no){
			$a = $symbolno[$i];
			$b = $name[$i];
			$c = $dob[$i];
			$d = $opti[$i];
			$e = $optii[$i];
		

		//FOR STUDENTS

		// create query
		$query = "INSERT INTO marks ( symbol_no , school_code , name , dob , opti_choice , optii_choice )
		VALUES ( '$a' , '$school_code' , '$b' , '$c' , '$d' , '$e')";
		// execute querys
		$result = mysql_query($query) or die ("Error in query: $query.
		" . mysql_error());
		
	
		$i++;	
		
		}
		// close connection
		mysql_close($connection);
		//school added successfully
	
		
	

		
		
		
		
		
		
		
		echo "Students added successfully! Please <a href='http://example.com/admin/'>click here</a> to go Back!";
		echo "<br /><a href='go back' />";
		

}






}


}
?>
