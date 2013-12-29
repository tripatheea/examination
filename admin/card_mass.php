<?php
if (!isset($_COOKIE['basket_id'])){
	die("ERROR: Access Denied!");
}
else{


if (!isset($_POST['school'])){
die ("ERROR: ACCES DENIED!");
}
else {


if (!isset($_POST['bulbul'])){
die ("ERROR: ACCES DENIED!");
}
else {

if (!$_POST['bulbul'] == "1"){

die ("ERROR: ACCES DENIED!");

}
else {
if (!isset($anappleinabasket)){
require("func_library.php");
}
allow_in_admin_and_data_manager_only_zone();
$school = $_POST['school'];
require ("../connection.php");


// create query
$query = "SELECT * FROM marks WHERE school_code = '$school'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());

if (mysql_num_rows($result) == "0"){
	die("<b>No student exists for the enterred school. Please enter some students before producing admission cards!</b>");
}
else{

$p = 1;

while ($p <= mysql_num_rows($result)){
$row = mysql_fetch_assoc($result);
$sym[$p] = $row['symbol_no'];
$name[$p] = $row['name'];
$school_code[$p] = $row['school_code'];
$opti[$p] = $row['opti_choice'];
$optii[$p] = $row['optii_choice'];
$no = $p;
$p++;
}
}
// free result set memory
mysql_free_result($result);


$school_name = school_name ($school);

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


$p = 1;
while ($p <= $no){
// create query
$query = "SELECT * FROM subjects WHERE subject_code = '$opti[$p]'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$row = mysql_fetch_assoc($result);
$subject_opti[$p] = $row['name'];
$p++;
}
$p = 1;
while ($p <= $no){
// create query
$query = "SELECT * FROM subjects WHERE subject_code = '$optii[$p]'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$row = mysql_fetch_assoc($result);
$subject_optii[$p] = $row['name'];
$p++;
}

?><head>



</head>

<?php

if (isset($_POST['print'])){
echo "<body onLoad='window.print()'>";
}
else {
echo "<body>";
}
?>


<?php



$p = 1;
while ($p <= $no){
?>
<! ------ADMISISON CARD GOES HERE ------- />






 

<table width="629" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" align="center" valign="top">
        <table width="621" height="92" border="0" cellpadding="0" cellspacing="0">
          <tr>
             <td width="129" rowspan="2" align="right"><img src="../imgs/logo.jpg" alt="" width="100" height="100"></td>
            <td width="356" align="center" valign="top"><font face="Arial" size="4"><strong><?php echo $school_or_board; ?>, Kaski</strong></font><br /><font face="Arial" size="3"><?php echo $exam_name . "-" . $year; ?></font></td>
            <td width="136" rowspan="2" align="right" valign="top"><table width="109" height="122" border="0" cellpadding="0" cellspacing="0" style="border-left: 1px solid #000000; border-right: 1px solid #000000; border-top: 1px solid #000000; border-bottom: 1px solid #000000;">
              <tr>
                <td width="107" align="center">Photo</td>
              </tr>
<tr></tr>
            </table></td>
          </tr>
          <tr>
            <td height="67" align="center" valign="top">
            <p>&nbsp; </p>
            <p><font face="Arial" size="3"><strong><u>Entrance Card</u></strong></font></p></td>
          </tr>
        </table>        
      </td>
    </tr>
    
    <tr>
      <td width="272" align="left" valign="bottom"><font face="Arial" size="2"><strong>Symbol No.</strong><strong>:</strong> <?php echo $sym[$p]; ?>
      </font></td>
      <td width="347">&nbsp;</td>
    </tr>
    <tr>
      <td height="28" align="left" valign="top"> <font face="Arial" size="2"><strong>Student's Name</strong><strong>:</strong> <?php echo $name[$p]; ?></font></td>
      <td align="right" valign="top"><font face="Arial" size="2"><strong>School</strong><strong>:</strong> <?php echo $school_name; ?></font></td>
    </tr>
    <tr>
      <td height="16" colspan="2" align="center" valign="middle"><font face="Arial" size="2"><strong>Subjects</strong></font></td>
    </tr>
    <tr>
      <td height="22" colspan="2" align="center" valign="bottom"><table width="629" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000">
        <tr bgcolor="#999999">
          <td width="55" align="center"><strong><font face="Arial" size="2">S.No.</font>
            </th>
          </strong>
          <td width="251" align="center"><strong><font face="Arial" size="2">Subject</font>
            </th>
          </strong>
          <td width="55" align="center"><strong><font face="Arial" size="2">S.No</font>.
            </th>
          </strong>
        <td width="250" align="center"><strong><font face="Arial" size="2">Subject</font>
            </th>        
        </strong></tr>
        <tr>
          <td align="center"><font face="Arial" size="2">1</font></td>
         <td align="left"><font face="Arial" size="2">English</font></td>
         <td align="center"><font face="Arial" size="2">5</font></td>
         <td align="left"><font face="Arial" size="2">Social Studies</font></td>
        </tr>
        <tr bgcolor="#E2E2E2">
         <td align="center"><font face="Arial" size="2">2</font></td>
         <td align="left"><font face="Arial" size="2">Nepali</font></td>
         <td align="center"><font face="Arial" size="2">6</font></td>
         <td align="left"><font face="Arial" size="2">Health Population and Environment</font></td>
        </tr>
        <tr>
         <td align="center"><font face="Arial" size="2">3</font></td>
         <td align="left"><font face="Arial" size="2">Mathematics</font></td>
         <td align="center"><font face="Arial" size="2">7</font></td>
         <td align="left"><font face="Arial" size="2"><?php echo $subject_opti[$p]; ?>&nbsp;</font></td>
        </tr>
        <tr bgcolor="#E2E2E2">
          <td align="center"><font face="Arial" size="2">4</font></td>
          <td align="left"><font face="Arial" size="2">Science</font></td>
          <td align="center"><font face="Arial" size="2">8</font></td>
          <td align="left"><font face="Arial" size="2"><?php echo $subject_optii[$p]; ?></font></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="22" colspan="2" align="left" valign="bottom"><font face="Arial" size="2"><strong><br />N.B.: </strong>This card must be presented on every exam day.</font></td>
    </tr>
  <tr>
  <td height="31" colspan="2">&nbsp;</td>
  </tr>
    <tr>
      <td height="19" align="left" valign="bottom">_____________</td>
      <td height="19" align="right" valign="bottom">_____________</td>
    </tr>
    <tr>
      <td height="27" align="left" valign="bottom"><font face="Arial" size="2">Exam Coordinator</font></td>
      <td height="27" align="right" valign="bottom"><font face="Arial" size="2">Principal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></td>
   </tr>
     <tr>
      <td height="27" colspan="2" align="left" valign="bottom"><font face="Arial" size="2"><strong>Date:</strong>        
      <script language="JavaScript">
	  <!--
	  var currentTime = new Date()
var month = currentTime.getMonth() + 1
var day = currentTime.getDate()
var year = currentTime.getFullYear()

if (month == "1"){
	mahina = "January";
}
else if (month == "2"){
	mahina = "February";
}
else if (month == "3"){
	mahina = "March";
}
else if (month == "4"){
	mahina = "April";
}
else if (month == "5"){
	mahina = "May";
}
else if (month == "6"){
	mahina = "June";
}
else if (month == "7"){
	mahina = "July";
}
else if (month == "8"){
	mahina = "August";
}
else if (month == "9"){
	mahina = "September";
}
else if (month == "10"){
	mahina = "October";
}
else if (month == "11"){
	mahina = "November";
}
else if (month == "12"){
	mahina = "December";
}

document.write(mahina + " " + day + ", " + year);
	  //-->
	  </script>
      
     </font>      </td>
    </tr>
  </table>
<?php
if ((($p % 2) == 0 ) ){
	echo "<DIV style='page-break-after:always'></DIV>";
}
else {
	echo "<br /><br />";
}


?>







<! ------ADMISISON CARD ENDS HERE ------- />
<?php




$p++;
}

echo "</body>";










?>
<?php

}






}
}
}
?>