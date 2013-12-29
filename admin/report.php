<?php
if (!isset($anappleinabasket)){
require("func_library.php");
}

user_logged_on();
allow_in_admin_and_data_manager_only_zone();
if (!isset($_POST['bulbul'])){
die("ERROR:: Access denied!");
}
else {

if ($_POST['bulbul'] != '1'){
die("ERROR:: Access denied!");
}
else {

if ($_POST['id'] == "admission"){

$school_code = $_POST['school'];
$sym = $_POST['symbolno'];
require ("../connection.php");
// create query
$query = "SELECT * FROM marks WHERE symbol_no = '$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$naam = $row['name'];
$opti = $row['opti_choice'];
$optii = $row['optii_choice'];
}
else
{
die ('<b>Invalid symbol no.!</b>');
}
// free result set memory
mysql_free_result($result);
// create query
$query = "SELECT * FROM schools WHERE school_code = '$school_code'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$school_name = $row['name'];
}
else
{
die ('<b>Invalid symbol no.!</b>');
}
// free result set memory
mysql_free_result($result);
	

}
// free result set memory
mysql_free_result($result);
// create query
$query = "SELECT * FROM schools WHERE school_code = '$school_code'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$school_name = $row['name'];
}
else
{
die ('<b>Invalid symbol no.!</b>');
}
// free result set memory
mysql_free_result($result);

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
$school_or_board = $row['value'];
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
$query = "SELECT * FROM subjects WHERE subject_code = '$opti'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$row = mysql_fetch_assoc($result);
$subject_opti = $row['name'];
// free result set memory
mysql_free_result($result);

// create query
$query = "SELECT * FROM subjects WHERE subject_code = '$opti'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$row = mysql_fetch_assoc($result);
$subject_opti = $row['name'];
// free result set memory
mysql_free_result($result);
// create query
$query = "SELECT * FROM subjects WHERE subject_code = '$optii'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$row = mysql_fetch_assoc($result);
$subject_optii = $row['name'];
// free result set memory
mysql_free_result($result);


// close connection
mysql_close($connection);



global $sym;
global $name;
global $school_name;
global $subject_opti;
global $subject_optii;





	
	
	
	
	
	

	
	
	
	
	
	
	}





}


}
?>


<body onLoad="window.print()">

 <table width="629" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="62" colspan="2" align="center" valign="top">
      <font face="Arial" size="4"><strong><?php echo $school_or_board; ?></strong></font>
      <br />
      <font face="Arial" size="3"><?php echo $exam_name . "-" . $year; ?></font>      </td>
    </tr>
    <tr>
      <td height="42" colspan="2" align="center" valign="top"><font face="Arial" size="3"><strong><u>Entrance Card</u></strong></font></td>
    </tr>
    <tr>
      <td width="272" align="left" valign="bottom"><font face="Arial" size="2"><strong>Symbol No.</strong><strong>:</strong> <?php echo $sym; ?>
      </font></td>
      <td width="347">&nbsp;</td>
    </tr>
    <tr>
      <td height="28" align="left" valign="top"> <font face="Arial" size="2"><strong>Student's Name</strong><strong>:</strong> <?php echo $name; ?></font></td>
      <td align="right" valign="top"><font face="Arial" size="2"><strong>School</strong><strong>:</strong> <?php echo $school_name; ?></font></td>
    </tr>
    <tr>
      <td height="30" colspan="2" align="center" valign="middle"><font face="Arial" size="2"><strong>Subjects</strong></font></td>
    </tr>
    <tr>
      <td height="22" colspan="2" align="center" valign="bottom"><table width="629" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
        <tr>
          <td width="55" align="center">S.No.</th>
          <td width="251" align="center">Subject</th>
          <td width="55" align="center">S.No.</th>
        <td width="250" align="center">Subject</th>        </tr>
        <tr>
          <td align="center">1</td>
         <td align="left">English</td>
         <td align="center">5</td>
         <td align="left">Social Studies</td>
        </tr>
        <tr>
         <td align="center">2</td>
         <td align="left">Nepali</td>
         <td align="center">6</td>
         <td align="left">Health Population and Environment</td>
        </tr>
        <tr>
         <td align="center">3</td>
         <td align="left">Mathematics</td>
         <td align="center">7</td>
         <td align="left"><?php echo $subject_opti;; ?>&nbsp;</td>
        </tr>
        <tr>
          <td align="center">4</td>
          <td align="left">Science</td>
          <td align="center">8</td>
          <td align="left"><?php echo $subject_optii;; ?></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="22" colspan="2" align="left" valign="bottom"><font face="Arial" size="2"><strong>N.B.: </strong>This card must be presented on every exam day.</font></td>
    </tr>
    <tr>
      <td height="27" colspan="2" align="left" valign="bottom"><strong>Date:</strong>        <?php 
	  
echo date("M N, Y",mktime())
	  
	   ?></td>
    </tr>
  </table>
  </body>