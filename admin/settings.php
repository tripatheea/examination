<?php
if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access!");

}
else{
if (!isset($anappleinabasket)){
require("func_library.php");
}
allow_in_admin_only_zone();


if (!isset($_POST['bulbul'])){


require("../connection.php");

// create query
$query = "SELECT * FROM settings WHERE field = 'year'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$row = mysql_fetch_assoc($result);
$year = $row['value'];
// free result set memory
mysql_free_result($result);


// create query
$query = "SELECT * FROM settings WHERE field = 'school/board'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$row = mysql_fetch_assoc($result);
$board = $row['value'];
// free result set memory
mysql_free_result($result);

// create query
$query = "SELECT * FROM settings WHERE field = 'exam_name'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$row = mysql_fetch_assoc($result);
$exam_name = $row['value'];
// free result set memory
mysql_free_result($result);

// create query
$query = "SELECT * FROM settings WHERE field = 'result_status'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$row = mysql_fetch_assoc($result);
$result_status_dbko = $row['value'];
// free result set memory
mysql_free_result($result);




$userid = $_COOKIE['basket_id'];
echo "<font face='Arial' size='2'>";
echo "We're determining some important settings about the program <strong>" . user_name($userid) . "</strong>!" ;
echo "<br /><br />";
?>
<form action='settings.php' method='post'>


<table border="0" cellspacing="0" cellpadding="2">
	<tr>
		<td width="100"><font face="Arial" size="2"><strong>Year:</td>
		<td><input type='text' name='year' size='2' maxlength='4' value='<?php echo $year; ?>' /></td>
	</tr>
	<tr>
		<td width="100"><font face="Arial" size="2"><strong>School/Board:</td>
		<td><input type='text' name='board' size='30' maxlength='40' value='<?php echo $board; ?>' /></td>
	</tr>
	<tr>
		<td width="100"><font face="Arial" size="2"><strong>Exam Name:</td>
		<td><input type='text' name='exam_name' size='30' maxlength='40' value='<?php echo $exam_name; ?>' /></td>
	</tr>
	<tr>
		<td width="100"><font face="Arial" size="2"><strong>Result Status:</td>
		<td>
		<?php
		//0 exam not completed
		//1 result being processed
		//2 Result Out
		if ($result_status_dbko == "0"){
		?>
		<select name="result_status">
			<option value="0" selected=true>Exam Not Completed</option>
			<option value="1">Result being processed</option>
			<option value="2">Result Out</option>
		</select>
		<?php
		}
		elseif($result_status_dbko == "1"){
		?>
		<select name="result_status">
			<option value="0">Exam Not Completed</option>
			<option value="1" selected=true>Result being processed</option>
			<option value="2">Result Out</option>
		</select>
		<?php
		}
		elseif ($result_status_dbko == "2"){
		?>
		<select name="result_status">
			<option value="0">Exam Not Completed</option>
			<option value="1">Result being processed</option>
			<option value="2" selected=true>Result Out</option>
		</select>
		<?php
		}
		?>
		</td>
	</tr>
</table>

<br><br>

<input type="hidden" name="bulbul" value="1" />
<input type="submit" value="Save" />
</form>
<br />
<form method='post' action='delete.php'>
<font face="Arial" size="2"><strong>Delete all data:</strong></font>&nbsp;&nbsp;<input type="hidden" name="delete" value="1" /><input type='submit' value='Delete' />
</form>
<br>
<a href="http://example.com/admin/reset_school_usernames.php">Reset all schools' password!</a> (Doing this will reset all schools' password to their usernames (i.e. their respective school codes)).
<br><br>

<a href="index.php">Go Back</a>
<?php


}
else {
$year = $_POST['year'];
$exam_name = $_POST['exam_name'];
$board = $_POST['board'];
$result_status = $_POST['result_status'];
require ("../connection.php");



$data_status = data_empty($year , $exam_name , $board);
$correct_chars = correct_characters($year , $exam_name , $board);


if (($data_status == true) || ($correct_chars == false)){
	die ("Invalid character or empty code enterred!");
}
else {




//create  query
$query = "UPDATE settings
SET value='$year'
WHERE field='Year'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
//create  query
$query = "UPDATE settings
SET value='$board'
WHERE field='school/board'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
//create  query
$query = "UPDATE settings
SET value='$exam_name'
WHERE field='exam_name'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
//create  query
$query = "UPDATE settings
SET value='$result_status'
WHERE field='result_status'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());

echo "Settings saved successfully!<br /><a href='settings.php'>Go Back</a>";

}
}
?>
<?php

}
?>
