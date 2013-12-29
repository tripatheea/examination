<?php

if (!isset($anappleinabasket)){
require("func_library.php");
}

user_logged_on();

if (!isset($bulbul)){
	die ("ERROR: Access Denied!");
}
else {

if ($bulbul == 1){

// user comes from good background; proceed
$userid = $_COOKIE['basket_id'];
//find the user's name

$name = user_name($userid);
global $name;


//CODE ADDED TO PREVENT ACCESS FROM OTHE SCHOOLS
if ((access_level($userid) == "4") && (isset($_GET['school']))){
if (sha1(username20($userid)) == sha1($_GET['school'])){
	$good = "hehe";
}
else {
die("Sorry! You are not entitled to do anything for another school!");
}
}
//CODE ADDED TO PREVENT ACCESS FROM OTHE SCHOOLS




if (!isset($_GET['subject'])){
$access_level2 = access_level("$userid");

if ((!isset($_GET['school'])) && (($access_level2 == 0) || ($access_level2 == 1) || ($access_level2 == 2) || ($access_level2 == 3))){
	//neither school nor subject; landing page; ask user to enter school code
	
	echo "<font face='Arial' size='2'>";
	echo "Please enter the school code below!";
	echo "<br /><br />";
	echo "<form name='school_code' method='get' action='department.php'>";
	echo "<input type='hidden' name='dept' value='marks' />";
	echo "<input type='hidden' name='task' value='edit' />";
	
	echo "<input type='text' name='school' maxlength='3' size='3' />";
	echo "<br /><br /><input type='submit' value='Enter' />";
	echo "</form>";
	
	
}
else {
	//no subject but yes school
	//display menu to choose subjects
	
	if ($access_level2 == 4){
	$school = username20($userid);
	}
	else {
	$school = $_GET['school'];
	}
	
		require("../connection.php");
		// create query
		$query = "SELECT * FROM schools WHERE school_code = $school";
		// execute querys
		$result = mysql_query($query) or die ("Error in query: $query.
		" . mysql_error());
		// see if any rows were returned
		if (mysql_num_rows($result) == 1) {
		$row = mysql_fetch_assoc($result);
		$school_name = $row['name'];
		$school_address = $row['address'];
		}
		else
		{
		die ('<b>Invalid school code entered!</b>');
		}
		// free result set memory
		mysql_free_result($result);
		// close connection
		mysql_close($connection);

		// die("It's too early to edit marks! :)");
		
		
		echo "<strong><u>School Code:</u></strong> <font color='#A80000'>$school</font><br /> ";
		echo "<strong><u>School:</u></strong> <font color='#A80000'>$school_name</font><br /> ";
		echo "<strong><u>Address:</u></strong> <font color='#A80000'>$school_address</font><br /> <br />";
		echo "Please select a subject for the above mentioned school!";
		
		//CHECK USER'S PRIVELAGES BEFORE ENTERING MARKS
		
		echo "<ul type='square'>";
		if (marks_allowed("english") == true){
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&subject=CMP01&select=th'>English</a></li>";
		}
		if (marks_allowed("nepali") == true){
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&subject=CMP02&select=th'>Nepali</a></li>";
		}
		if (marks_allowed("mathematics") == true){
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&subject=CMP03&select=th'>Mathematics</a></li>";
		}
		if (marks_allowed("science") == true){
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&subject=CMP04&select=th'>Science</a></li>";
		}
		if (marks_allowed("social") == true){
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&subject=CMP05&select=th'>Social Studies</a></li>";
		}
		if (marks_allowed("hpe") == true){
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&subject=CMP06&select=th'>Health, Population and Environment</a></li>";
		}
		if (marks_allowed("opti") == true){
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&subject=OPTI&select=th'>Optional I</a></li>";
		}
		if (marks_allowed("optii") == true){
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&subject=OPTII&select=th'>Optional II</a></li>";
		}
		if (marks_allowed("practicals") == true){
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&subject=&select=pra'>Practicals</a></li>";		
		}
		
		echo "</ul>";
		
		
}
}
else {
	
	if (!isset($_GET['school'])){
		header ("Location: department.php?dept=marks");
	}
	else {
	//show the  place to enter marks
	
	//check users' privelage before allowing anything
	
	$subject = $_GET['subject'];
	$select = $_GET['select'];
	if ($select == "pra"){
		$bulbul == 1;
		require ("edit_practical.php");
	}
	else {
	$subject_name = subject_name($subject);
	$school = $_GET['school'];
	$school_name = school_name($school);
	$school_address = school_address($school);
	echo "<strong><u>School Code:</u></strong> <font color='#A80000'>$school</font><br /> ";
	echo "<strong><u>School:</u></strong> <font color='#A80000'>$school_name</font><br /> ";
	echo "<strong><u>Address:</u></strong> <font color='#A80000'>$school_address</font><br />";
	echo "<strong><u>Subject:</u></strong> <font color='#A80000'>$subject_name</font><br /> <br />";
	require("../connection.php");
	
	// create query
	$query = "SELECT * FROM marks WHERE school_code = '$school'";
	
	// execute querys
	$result = mysql_query($query) or die ("Error in query: $query.
	" . mysql_error());
	// see if any rows were returned
	if (mysql_num_rows($result) >= 1) {
	echo "Please make sure that you are enterring the marks of <font face='Arial' size='2'><b>$subject_name</b></font>!<br /><br />";
	echo "<form name='marks' method='post' action='edit.php'>";
	echo "<table width='400' border='0' cellspacing='0' cellpadding='0'>";
	echo "<tr bgcolor='#828282'>";
	echo "<th width='100' scope='col' align='left'><font color='white'>Symbol No.</font> </th>";
	echo "<th width='250' scope='col' align='left'><font color='white'>Name</font></th>";
	echo "<th width='50' scope='col' align='left'><font color='white'>Marks(Th)</font></th>";
	echo " </tr>";
	
	
	
	
	//generate table names of subjects from general subject names
	if ($subject_name == "English"){
		$sub = "english_th";
	}
	elseif ($subject_name == "Nepali"){
		$sub = "nepali";
	} 
	elseif ($subject_name == "Mathematics"){
		$sub = "maths";
	} 	
	elseif ($subject_name == "Science"){
		$sub = "science_th";
	} 	
	elseif ($subject_name == "Social Studies"){
		$sub = "social";
	} 	
	elseif ($subject_name == "Health Population and Environment"){
		$sub = "hpe_th";
	} 	
	elseif ($subject_name == "OPTI"){
		$sub = "opti";
	} 		
	elseif ($subject_name == "OPTII"){
		$sub = "optii_th";
	} 		
	
	
	
	
	
	$p = 1;
	while ($p <= mysql_num_rows($result)){
	$row = mysql_fetch_assoc($result);
	$sym[$p] = $row['symbol_no'];
	$naam[$p] = $row['name'];
	$marks[$p] = $row[$sub];
	$p++;
	}
	$p = 1;
	while ($p <= mysql_num_rows($result)){

	if (($p % 2) == 0){

	echo "<tr bgcolor='#FFFFFF'>";
	echo "<td>" . $sym[$p] . "</td>";
	echo "<td>" . $naam[$p] . "</td>";
	echo "<td align='center'>" . "<input type='text' name='marks_$p' size='1' maxlength='3' style='background:#FFFFFF;' value='$marks[$p]' />" . "</td>";
	echo "</tr>";
	}
	elseif (!($p % 2) == 0){
	echo "<tr bgcolor='#E1E1E1'>";
	echo "<td>" . $sym[$p] . "</td>";
	echo "<td>" . $naam[$p] . "</td>";
	echo "<td align='center'>" . "<input type='text' name='marks_$p' size='1' maxlength='3' style='background:#E1E1E1;' value='$marks[$p]' />" . "</td>";
	echo "</tr>";
	}
	$no_of_rows_enterred = $p;
	$p++;
	}
	echo "</table>";
	echo "<br />";
	echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";
	echo "<input type='submit' name='save' id='save' value='Save' />";
	echo "<input type='reset' name='Reset' id='button' value='Reset' />";
	echo "<input type='hidden' name='no_of_rows_enterred' value='$no_of_rows_enterred' />";
	echo "<input type='hidden' name='bulbul' value='aIeL8J2m1s' />";
	echo "<input type='hidden' name='dept' value='marks' />";
	echo "<input type='hidden' name='school' value='$school' />";	
	echo "<input type='hidden' name='subject' value='$subject_name' />";
	echo "<input type='hidden' name='select' value='th' />";	
	echo "</form>";
	}
	else
	{
	die ('<b>No student exists. Please enter some students before enterring mark!</b>');
	}
	}

	
	
	
	
	
}	
}
}
}

?>