<?php




if (!isset($bulbul)){
die("ERROR: ACCESS DENIED");
}
else {



if($_GET['subject'] == ""){


if (!isset($_GET['select'])){
	die("ERROR:: ACCESS DENIED!");
}
else {

if ($_GET['select'] == "pra"){

$school = $_GET['school'];
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


		echo "<strong><u>School Code:</u></strong> <font color='#A80000'>$school</font><br /> ";
		echo "<strong><u>School:</u></strong> <font color='#A80000'>$school_name</font><br /> ";
		echo "<strong><u>Address:</u></strong> <font color='#A80000'>$school_address</font><br /> <br />";
		echo "Please select a subject for the above mentioned school!";
		echo "<ul type='square'>";
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&select=pra&subject=CMP01'>English</a></li>";
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&select=pra&subject=CMP04'>Science</a></li>";
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&select=pra&subject=CMP06'>Health, Population and Enivronment</a></li>";
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&select=pra&subject=OPTI'>Optional I</a></li>";		
		echo "<li><a href='department.php?dept=marks&task=edit&school=$school&select=pra&subject=OPTII'>Optional II</a></li>";
		echo "</ul>";
}		
}		
		
		
}
else {














	//show the  place to enter marks
	
	//check users' privelage before allowing anything
	
	$select = "pra";
	$subject = $_GET['subject'];
	$subject_name = subject_name($subject);
	$school = $_GET['school'];
	$school_name = school_name($school);
	$school_address = school_address($school);
	echo "<strong><u>School Code:</u></strong> <font color='#A80000'>$school</font><br /> ";
	echo "<strong><u>School:</u></strong> <font color='#A80000'>$school_name</font><br /> ";
	echo "<strong><u>Address:</u></strong> <font color='#A80000'>$school_address</font><br />";
	echo "<strong><u>Subject:</u></strong> <font color='#A80000'>$subject_name</font><br /> <br />";
	
	
	//generate table names of subjects from general subject names
	if ($subject_name == "English"){
		$sub = "english_pr";
	}
	elseif ($subject_name == "Science"){
		$sub = "science_pr";
	} 
	elseif ($subject_name == "Health Population and Environment"){
		$sub = "hpe_pr";
	} 	
	elseif ($subject_name == "OPTI"){
		$sub = "opti_pr";
	}	
	elseif ($subject_name == "OPTII"){
		$sub = "optii_pr";
	} 	
	
	
	require("../connection.php");
	
	if ($subject == "OPTI"){
	// create query
	$query = "SELECT * FROM marks WHERE school_code = '$school' AND opti_choice = 'OI05'";
	}
	else {
	// create query
	$query = "SELECT * FROM marks WHERE school_code = '$school'";
	}
	
	
	
	// execute querys
	$result = mysql_query($query) or die ("Error in query: $query.
	" . mysql_error());
	// see if any rows were returned
	if (mysql_num_rows($result) >= 1) {
	echo "Please make sure that you are enterring the marks for the <strong>practicals</strong> of <font face='Arial' size='2'><b>$subject_name</b></font>!<br /><br />";
	echo "<form name='marks' method='post' action='add.php'>";
	echo "<table width='400' border='0' cellspacing='0' cellpadding='0'>";
	echo "<tr bgcolor='#828282'>";
	echo "<th width='100' scope='col' align='left'><font color='white'>Symbol No.</font> </th>";
	echo "<th width='250' scope='col' align='left'><font color='white'>Name</font></th>";
	echo "<th width='50' scope='col' align='left'><font color='white'>Marks(Practical)</font></th>";
	echo " </tr>";
	
	
	
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
	echo "<td align='center'>" . "<input type='text' name='marks_$p' size='1' maxlength='3' style='background:#FFFFFF;' value='$marks[$p]' />" . "<input type='hidden' name='sym_$p' value='$sym[$p]' /></td>";
	echo "</tr>";
	}
	elseif (!($p % 2) == 0){
	echo "<tr bgcolor='#E1E1E1'>";
	echo "<td>" . $sym[$p] . "</td>";
	echo "<td>" . $naam[$p] . "</td>";
	echo "<td align='center'>" . "<input type='text' name='marks_$p' size='1' maxlength='3' style='background:#E1E1E1;' value='$marks[$p]' />" . "<input type='hidden' name='sym_$p' value='$sym[$p]' /></td>";
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
	echo "<input type='hidden' name='select' value='$select' />";	
	echo "<input type='hidden' name='subject' value='$subject_name' />";
	echo "</form>";
	}
	else
	{
	die ('<b>No student exists. Please enter some students before enterring mark!</b>');
	}
	}






















}













?>