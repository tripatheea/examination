<?php
if (!isset($anappleinabasket)){
require("func_library.php");
}

user_logged_on();


if (!isset($bulbul)){
	die ("Unauthorized access!");
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
	echo "<input type='hidden' name='task' value='add' />";
	
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
	
	$data_status = data_empty($school);
	$correct_chars = anka_matra($school);
	if (($data_status == true) || ($correct_chars == false)){
		die ("Code not enterred or invalid code enterred");
	}
	else {
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

		// die("It's too early to add marks! :)");
		
		
		echo "<strong><u>School Code:</u></strong> <font color='#A80000'>$school</font><br /> ";
		echo "<strong><u>School:</u></strong> <font color='#A80000'>$school_name</font><br /> ";
		echo "<strong><u>Address:</u></strong> <font color='#A80000'>$school_address</font><br /> <br />";
		echo "Please select a subject for the above mentioned school!";
		
		//CHECK USER'S PRIVELAGES BEFORE ENTERING MARKS
		
		echo "<ul type='square'>";
		if (marks_allowed("english") == true){
		echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=CMP01&select=th'>English</a></li>";
		}
		if (marks_allowed("nepali") == true){
		echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=CMP02&select=th'>Nepali</a></li>";
		}
		if (marks_allowed("mathematics") == true){
		echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=CMP03&select=th'>Mathematics</a></li>";
		}
		if (marks_allowed("science") == true){
		echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=CMP04&select=th'>Science</a></li>";
		}
		if (marks_allowed("social") == true){
		echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=CMP05&select=th'>Social Studies</a></li>";
		}
		if (marks_allowed("hpe") == true){
		echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=CMP06&select=th'>Health, Population and Environment</a></li>";
		}
		if (marks_allowed("opti") == true){
		echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTI&select=th'>Optional I</a></li>";
		}
		if (marks_allowed("optii") == true){
		echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTII&select=th'>Optional II</a></li>";
		}
		if (marks_allowed("practicals") == true){
		echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=&select=pra'>Practicals</a></li>";		
		}
		
		echo "</ul>";
		
		
}
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
		require ("practical.php");
	}
	else {
	
	if(($subject == "OPTI") || ($subject == "OPTII")){
	
	$school = $_GET['school'];
	$school_name = school_name($school);
	$school_address = school_address($school);
	$subject_name = subject_name($subject);
	echo "<strong><u>School Code:</u></strong> <font color='#A80000'>$school</font><br /> ";
	echo "<strong><u>School:</u></strong> <font color='#A80000'>$school_name</font><br /> ";
	echo "<strong><u>Address:</u></strong> <font color='#A80000'>$school_address</font><br />";
	echo "<strong><u>Subject:</u></strong> <font color='#A80000'>$subject_name</font><br /> <br />";
			if(!isset($_GET['choice'])){
		
			
			if ($subject == "OPTI"){
			echo "Please select a subject under Optional I!";
			echo "<ul type='square'>";
			echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTI&select=th&choice=OI01'>Optional Mathematics</a></li>";
			echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTI&select=th&choice=OI02'>Optional Population</a></li>";
			echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTI&select=th&choice=OI03'>Optional Environment Science</a></li>";		
			echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTI&select=th&choice=OI04'>Optional English</a></li>";
			echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTI&select=th&choice=OI05'>Optional Geography</a></li>";
			echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTI&select=th&choice=OI06'>Optional Economics</a></li>";
			echo "</ul>";
			}
			else {
			echo "Please select a subject under Optional II!";
			echo "<ul type='square'>";
			echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTII&select=th&choice=OI01&choice=OII01'>Optional Health & Physical Education</a></li>";
			echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTII&select=th&choice=OI01&choice=OII02'>Optional Office Mgmt. & Accounts</a></li>";
			echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTII&select=th&choice=OI01&choice=OII03'>Optional Agriculture</a></li>";
			echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTII&select=th&choice=OI01&choice=OII04'>Optional Journalism</a></li>";		
			echo "<li><a href='department.php?dept=marks&task=add&school=$school&subject=OPTII&select=th&choice=OI01&choice=OII05'>Optional Computer Science</a></li>";
			echo "</ul>";
			}
		
		
		
		}
		else {
		
			$choice_kun = $_GET['choice'];
		
			$choice_name = subject_name($choice_kun);
	
		
		
		if ($subject == "OPTI"){
			// create query
			$query = "SELECT * FROM marks WHERE school_code = '$school' AND opti_choice = '$choice_kun'";
		}
		elseif ($subject == "OPTII"){
			// create query
			$query = "SELECT * FROM marks WHERE school_code = '$school' AND optii_choice = '$choice_kun'";
		}
			// execute querys
			$result = mysql_query($query) or die ("Error in query: $query.
			" . mysql_error());
			// see if any rows were returned
			if (mysql_num_rows($result) >= 1) {
			echo "Please make sure that you are enterring the marks for the <strong>practicals</strong> of <font face='Arial' size='2'><b>$choice_name</b></font>!<br /><br />";
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
			$p++;
			}
			$p = 1;
			while ($p <= mysql_num_rows($result)){

			if (($p % 2) == 0){

				echo "<tr bgcolor='#FFFFFF'>\n";
				echo "<td>" . $sym[$p] . "\n<input type='hidden' name='symbol_$p' value='$sym[$p]' />\n</td>\n";
				echo "<td>" . $naam[$p] . "</td>\n";
				echo "<td align='center'>" . "\n<input type='text' name='marks_$p' size='1' maxlength='3' style='background:#FFFFFF;' />" . "\n</td>\n";
				echo "\n</tr>\n";
			}
			elseif (!($p % 2) == 0){
				echo "<tr bgcolor='#E1E1E1'>\n";
				echo "<td>" . $sym[$p] . "\n<input type='hidden' name='symbol_$p' value='$sym[$p]' />\n</td>\n";
				echo "<td>" . $naam[$p] . "</td>\n";
				echo "<td align='center'>" . "\n<input type='text' name='marks_$p' size='1' maxlength='3' style='background:#E1E1E1;'/>" . "\n</td>\n";
				echo "\n</tr>\n";
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

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		//FINISH EVERYTHING ABOVE THIS LINE
		
		}
	
	
	
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
	echo "<form name='marks' method='post' action='add.php'>";
	echo "<table width='400' border='0' cellspacing='0' cellpadding='0'>";
	echo "<tr bgcolor='#828282'>";
	echo "<th width='100' scope='col' align='left'><font color='white'>Symbol No.</font> </th>";
	echo "<th width='250' scope='col' align='left'><font color='white'>Name</font></th>";
	echo "<th width='50' scope='col' align='left'><font color='white'>Marks(Th)</font></th>";
	echo " </tr>";
	
	
	
	$p = 1;
	while ($p <= mysql_num_rows($result)){
	$row = mysql_fetch_assoc($result);
	$sym[$p] = $row['symbol_no'];
	$naam[$p] = $row['name'];
	$p++;
	}
	$p = 1;
	while ($p <= mysql_num_rows($result)){

	if (($p % 2) == 0){

	echo "<tr bgcolor='#FFFFFF'>\n";
	echo "<td>" . $sym[$p] . "\n<input type='hidden' name='symbol_$p' value='$sym[$p]' />\n</td>\n";
	echo "<td>" . $naam[$p] . "</td>\n";
	echo "<td align='center'>" . "\n<input type='text' name='marks_$p' size='1' maxlength='3' style='background:#FFFFFF;' />" . "\n</td>\n";
	echo "\n</tr>\n";
	}
	elseif (!($p % 2) == 0){
	echo "<tr bgcolor='#E1E1E1'>\n";
	echo "<td>" . $sym[$p] . "\n<input type='hidden' name='symbol_$p' value='$sym[$p]' />\n</td>\n";
	echo "<td>" . $naam[$p] . "</td>\n";
	echo "<td align='center'>" . "\n<input type='text' name='marks_$p' size='1' maxlength='3' style='background:#E1E1E1;'/>" . "\n</td>\n";
	echo "\n</tr>\n";
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
}

?>
