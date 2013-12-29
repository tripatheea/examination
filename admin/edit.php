<?php


if (!isset($_POST['bulbul'])){
	die("ERROR: Access Denied");
}
else{
?>
<?php
//correct way; now check which department
$dept = $_POST['dept'];
if ($dept == "user" ){

//processing for edit user begins








require("func_library.php");


$username123 = $_POST['userko'];
$name123 = $_POST['name'];
$pass123 = $_POST['password'];
$lock_user123 =  $_POST['lockuser'];


if ($lock_user123 == "on"){
	$lock_user123 = "1";
}
else {
	$lock_user123 = "0";
}
$status = data_empty($username123 , $name123 , $pass123);
	
	$correct_chars = correct_characters($username123 , $name123 , $pass123 , $lock_user123);
	
	if (($status == true) || ($correct_chars == false)){
		die("One or more fields empty or invalid character; you must fill in every data to edit a user!");
	}
	else {
		//all fields filled; now check if data is in correct format or not
		$edit_users = true;

	}	
// CHECKING FOR DATA REDUNDANCY BEGINS
	
$pass123 = sha1($pass123);

if($edit_users == true){
$name;
require("../connection.php");
//edit users first

// create query
$query = "UPDATE users
SET name='$name123' , password='$pass123' , locked='$lock_user123'
WHERE username='$username123'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());		

//edit username


echo "User edited successfully!";


}
		



		
		
		



























}

elseif ($dept == 'marks'){
// processing for add marks begins






$no = $_POST['no_of_rows_enterred'];
$subject = $_POST['subject'];
$select = $_POST['select'];
require_once("func_library.php");

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
elseif ($select == "pra"){
	$bishaya = "practicals";
}
if (!marks_allowed($bishaya) == true){
	die ("ERROR: Access Denied!");
}








if ($select == "th"){


//data validation
if (!isset($anappleinabasket)){
require("func_library.php");
}


$i = 1;
while ($i <= $no){
	$marks[$i] = $_POST['marks_' . $i];
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


//echo $subject987;
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

		//use isint() function to check if all data is integer or not; also check if data in correct range or not
		$add_marks = true;
		
	}
	
	
$i++;
}


if($add_marks == true){


$i = 1;
$school = $_POST['school'];
require("../connection.php");
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
$sy = $sym[$i];
// create query
$query = "UPDATE marks
SET $subject='$ma'
WHERE symbol_no='$sy'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
$i++;
} 

		echo "Congratulations! Marks edited successfully! Please hit the Back key on your browser to go Back!";
}
}
elseif ($select == "pra"){


















// processing for add practical marks begins



//data validation
//require ("func_library.php");


$i = 1;
while ($i <= $no){
	$marks[$i] = $_POST['marks_' . $i];
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
$correct_range = add_marks_range_correct($subject987, $marks[$i] , "practical");
//echo $correct_range;	
	if (($status == true) || ($correct_chars == false) || ($correct_range == false)){
		
		die("ERROR: Please complete the forms with proper characters within the correct range for the chosen subject. 
		All fields must be completely filled and only numeric characters are allowed!" );
	}
	else {
		//all fields filled; now check if data is in correct format or not
		// DO NOT FORGET TO VALIDATE DATA AT ANY COST

		//use isint() function to check if all data is integer or not; also check if data in correct range or not
		$edit_marks = true;
		
	}
	
	
$i++;
}


if($edit_marks == true){

require("../connection.php");
//seperate module for optional I practicals (Geography practicals)

if ($subject == 'OPTI'){

$no234 = $_POST['no_of_rows_enterred'];
$i = 1;
while ($i <= $no234){
$sym456 = $_POST['sym_' . $i];
$ma = $marks[$i];
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

die("Congratulations! Practical Marks added successfully! Please hit the Back key on your browser to go Back!");
}

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
$sy = $sym[$i];
// create query
$query = "UPDATE marks
SET $subject='$ma'
WHERE symbol_no='$sy'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
$i++;
} 

		echo "Congratulations! Practical Marks edited successfully!";
}





































































}






}

// processing for edit school begins
elseif ($dept == "school"){

require("func_library.php");


$school_code = $_POST['school_code'];
$newschool_code = $_POST['newschool_code'];
$school_name = $_POST['name'];
$school_address =  $_POST['address'];





















$status = data_empty($newschool_code , $school_name , $school_address);
	
	$correct_chars = correct_characters($newschool_code , $school_name , $school_address);
	
	if (($status == true) || ($correct_chars == false)){
		die("One or more fields empty or invalid character; you must fill in every data to register a school!");
	}
	else {
		//all fields filled; now check if data is in correct format or not
		// DO NOT FORGET TO VALIDATE DATA AT ANY COST

		
			require("../connection.php");
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
			$codewa_yahiko = trim(strtolower($school_code));
			$naaun_yahiko = trim(strtolower($school_name));
			
			$i++;
			}
			}
			// free result set memory
			mysql_free_result($result);


			//CHECKING FOR DATA REDUNDACNY ENDS

		
		
		
		
		
		
		//SIMILARY ALSO CHECK WHETHER ENTERRED DATA ALREADY EXISTS IN DATABASE OR NOT
		$edit_schools = true;
		

	}
	
// CHECKING FOR DATA REDUNDANCY BEGINS




	
	
	
	
	
	
	
	
	
	
	
if($edit_schools == true){
$name;
require("../connection.php");
//edit schools first

// create query
$query = "UPDATE schools
SET school_code='$newschool_code' , name='$school_name' , address='$school_address'
WHERE school_code='$school_code'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());		

//edit username


$new_password = sha1($newschool_code);
// create query
$query = "UPDATE users
SET name='$school_name' , username='$newschool_code' , password='$new_password'
WHERE username='$school_code'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());

echo "School, username and password of the school edited successfully!";


}
		



		
		
		


		
		
		
}


elseif ($dept == "student"){
require("func_library.php");



$no = $_POST['no'];


$school_code = $_POST['school'];
//delete the following line and uncomment previous line

$userid200 = $_COOKIE['basket_id'];
$username200 = username20($userid200);
$access_level20 = access_level($userid200);
if (($access_level20 == 4) && (!$username200 == $school_code)){
	die ("ERROR: Access Denied!");
}


$i = 1;
while ($i <= $no){
	$symbolno[$i] = $_POST['old_sym_' . $i];
	$name[$i] = $_POST['naam_' . $i];
	$dob1[$i] = $_POST['dob1_' . $i];
	$dob2[$i] = $_POST['dob2_' . $i];
	$dob3[$i] = $_POST['dob3_' . $i];	
	$opti[$i] = $_POST['opti_' . $i];
	$optii[$i] = $_POST['optii_' . $i];	
	$old_sym[$i] = $_POST['old_sym_' . $i];	
	
$i++;
}





$i = 1;
while ($i <= $no){

	$status = data_empty($symbolno[$i],$name[$i],$opti[$i],$optii[$i]);
	$correct_chars = correct_characters($symbolno[$i],$name[$i],$opti[$i],$optii[$i]);
	if (anka_matra($dob1[$i] , $dob2[$i] , $dob3[$i]) == false){
		die("ERRORA: Please complete the forms with proper characters. All fields must be completely filled and only numeric characters are allowed!");
		}
		if (($dob1[$i] == "00") && ($dob2[$i] == "00") & ($dob3[$i] == "00")){
	}
	else {
	if (($dob1[$i] < 40) || ($dob2[$i] < 1) || ($dob2[$i] > 12) || ($dob3[$i] < 1) || ($dob3[$i] > 32)){
		die("ERRORB: Please complete the forms with proper characters. All fields must be completely filled and only numeric characters are allowed!");
	}
	}
	//IT"S IMPORTANT; READ THIS
	//DO NOT FORGET TO VALIDATE DATES 
	$dob[$i] = $dob1[$i] . "/" . $dob2[$i] . "/" . $dob3[$i];
	if (($status == true) || ($correct_chars == false)){
		die("ERRORC: Please complete the forms with proper characters. All fields must be completely filled and only alphanumeric characters are allowed!");
	}
	else {
		//all fields filled; now check if data is in correct format or not
		// DO NOT FORGET TO VALIDATE DATA AT ANY COST
	//IT"S IMPORTANT; READ THIS
	//DO NOT FORGET TO VALIDATE DATES 
		//SIMILARY ALSO CHECK WHETHER ENTERRED DATA ALREADY EXISTS IN DATABASE OR NOT
		$edit_students = true;
	}	
$i++;
}
if($edit_students == true){

		require("../connection.php");
		$i = 1;
		while($i <= $no){
			$a = $symbolno[$i];
			$b = $name[$i];
			$c = $dob[$i];
			$d = $opti[$i];
			$e = $optii[$i];
			$f = $old_sym[$i];	
		
		//FOR STUDENTS

		// create query
		$query = "UPDATE marks
			SET symbol_no='$a' , school_code='$school_code' , name='$b' , dob='$c' , opti_choice='$d' , optii_choice='$e'
			WHERE symbol_no='$f'";
		// execute querys
		$result = mysql_query($query) or die ("Error in query: $query.
		" . mysql_error());
		$i++;	
		
		}
		// close connection
		mysql_close($connection);
		//school added successfully
	
		
	

		
		
		
		
		
		
		
		echo "Students edited successfully!";
		
		

}






}


}
?>

