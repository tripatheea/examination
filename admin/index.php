<?php



if (!isset($_COOKIE['basket_id'])){

if (!isset($_POST['pass'])){
?>
<html>
<head>


 </head>
 <body>
<center>
<font face="Arial" size="2">
<form name="login" action="index.php" method="post">


<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>Username: </td>
		<td><input type="text" name="user" size="10" maxlength="50"></td>
	</tr>
	<tr>
		<td>Password: </td>
		<td><input type="password" name="pass" size="10" maxlength="50"></td>		
	</tr>
	</table>
	<table>
	<tr>
		<td> <script type="text/javascript"
     src="http://www.google.com/recaptcha/api/challenge?k=6LdtncsSAAAAALOWrNbppVGqkmDgm5SBFb8iJuX5">
  </script>
  <noscript>
     <iframe src="http://www.google.com/recaptcha/api/noscript?k=6LdtncsSAAAAALOWrNbppVGqkmDgm5SBFb8iJuX5"
         height="300" width="500" frameborder="0"></iframe><br>
     <textarea name="recaptcha_challenge_field" rows="3" cols="40">
     </textarea>
     <input type="hidden" name="recaptcha_response_field"
         value="manual_challenge">
  </noscript>
  </td>
  </tr>
  </table>
  <table>
	<tr>
		<td><input type="submit" value="Login"></td>
	</tr>
</table>

</form>
</font>
</center>
</body>
<?php
}
else
{

  require_once('recaptchalib.php');
  $privatekey = "6LdtncsSAAAAABGusZpl3VTQTGyZ_RYGGECdcQBj";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ") <a href='http://example.com/admin/'>Go back!</a>");
  } else {
    // Your code here to handle a successful verification
  }






$user = $_POST['user'];
$pass = $_POST['pass'];
global $user, $pass;
require ("func_library.php");
//check for correct format of data

$data_correct = validate ($user,$pass);
if ($data_correct == true){
//correct data; now check whether credentials are correct or not;

$status = success ($user,$pass);
if ($status == true){

	
	
	
	$correct_bato = 1;
require('admin.php');
}
elseif ($status == false){
//password incorrect what to be done do them

die ("Incorrect login credentials!<a href='http://example.com/admin/'>Go back!</a>");
}

}
elseif ($data_correct == false){
echo "Incorrect characters enterred in field username/password!<a href='http://example.com/admin/'>Go back!</a>";
}
}
?>

<?php

}
else {
//user already logged in
session_start();
$_SESSION['basket_auth'] = 1;









require ("func_library.php");




$correct_bato = 1;
require('admin.php');
require("../connection.php");
// create query
$query = "UPDATE users SET last_logon_on = 'now()'
WHERE username = '$user'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// close connection
mysql_close($connection);

}
?>
