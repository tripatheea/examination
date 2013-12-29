<?php
if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access!");

}
else{


if (isset($_POST['enter'])){

require ("../connection.php");
require("func_library.php");

$old_pass = $_POST['current_pass'];
$newpass1 = $_POST['new_pass1'];
$newpass2 = $_POST['new_pass2'];

if (correct_characters($old_pass , $newpass1 , $newpass2) == false){
	die ("Empty or incorrect characters enterred. Only aplhanumeric characters allowed! Hit the back key of your browser to go back!");
}

$logged_bhako_user = $_COOKIE['basket_id'];
$query = "SELECT * FROM users WHERE user_id = '$logged_bhako_user'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$row = mysql_fetch_assoc($result);
$purano_pass = $row['password'];
// free result set memory
mysql_free_result($result);

$old_pass = sha1($old_pass);
if ($purano_pass != $old_pass){
	die ("Sorry! Your current password isn't correct!  Hit the back key of your browser to go back!");
}
if ($newpass1 != $newpass2){
	die ("Sorry! The passwords you enterred doesn't match!  Hit the back key of your browser to go back!");
}

if ((strlen($newpass1) < 10) || (strlen($newpass2) >20)){
	die ("The password you enterred is either too short or too long. Please enter a password of 10 to 20 characters.");
}

$newpass = sha1($newpass1);
// create query
$query = "UPDATE users
SET password = '$newpass'
WHERE user_id='$logged_bhako_user'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	

die ("Password successfully changed.<br /><a href='index.php'>Go Back</a>");


}
else{

?>
<font face='Arial' size='2'>Please enter the current and new password to change your password!</font>
<br /><br />
<form name='pass_change' method='post' action='changepassword.php'>
<table border='0' cellspacing='0' cellpadding='0'>
	<tr>
		<td><font face='Arial' size='2'>Current Password:</font></td>
		<td><input type='password' name='current_pass' maxlength='20' size='10' /></td>
	</tr>
	<tr>
		<td><font face='Arial' size='2'>New Password:</font></td>
		<td><input type='password' name='new_pass1' maxlength='20' size='10' /></td>
	</tr>
	<tr>
		<td><font face='Arial' size='2'>New Password Again:</font></td>
		<td><input type='password' name='new_pass2' maxlength='20' size='10' /></td>
	</tr>
<tr>
	<td colspan='2'><input type='hidden' name='enter' value='1' /><input type='submit' value='Change Password' /></td>
</tr>
</table>
<br />
<a href="index.php">Go Back</a>

<?php

}
}
?>