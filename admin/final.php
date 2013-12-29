<?php



if (!isset($anappleinabasket)){
require("func_library.php");
}
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
	
// create query
$query = "SELECT * FROM marks WHERE symbol_no = '$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$name = $row['name'];
$school_code = $row['school_code'];
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


?><body onLoad="window.print()">

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
      <td width="272" align="left" valign="bottom"><font face="Arial" size="2"><strong>Symbol No.</strong><strong>:</strong> <?php echo $sym; ?>
      </font></td>
      <td width="347">&nbsp;</td>
    </tr>
    <tr>
      <td height="28" align="left" valign="top"> <font face="Arial" size="2"><strong>Student's Name</strong><strong>:</strong> <?php echo $name; ?></font></td>
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
         <td align="left"><font face="Arial" size="2"><?php echo $subject_opti; ?>&nbsp;</font></td>
        </tr>
        <tr bgcolor="#E2E2E2">
          <td align="center"><font face="Arial" size="2">4</font></td>
          <td align="left"><font face="Arial" size="2">Science</font></td>
          <td align="center"><font face="Arial" size="2">8</font></td>
          <td align="left"><font face="Arial" size="2"><?php echo $subject_optii; ?></font></td>
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
</body>


<?php



}
elseif($_POST['id'] == "report"){




require("../connection.php");
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





// create query
$query = "SELECT * FROM marks WHERE symbol_no = '$sym'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$eng_th = $row['english_th'];
$eng_pr = $row['english_pr'];
$nep = $row['nepali'];
$maths = $row['maths'];
$sci_th = $row['science_th'];
$sci_pr = $row['science_pr'];
$social = $row['social'];
$hpe_th = $row['hpe_th'];
$hpe_pr = $row['hpe_pr'];
$opti = $row['opti'];
$opti_pr = $row['opti_pr'];
$optii_th = $row['optii_th'];
$optii_pr = $row['optii_pr'];
$total = $row['total'];
$percent = $row['percent'];
$division = $row['division'];
$passbhae = $row['pass'];
}
else{
die ("No such student exists!");
}
// free result set memory
mysql_free_result($result);
// close connection
mysql_close($connection);
























?>


<style type="text/css">
<!--
.bhitri {    font-family: Arial;
	font-size:1.000em;
}
-->
</style>
<body onLoad="window.print()">

<style language="text/css">
.bhitri {
    font-family: Arial;
	font-size:1.000em;
	 }

</style>
<table border='0' cellspacing = '20'>
<tr>

<td>

<table border='0' cellpadding='0' cellspacing='0'>
<tr>
<td width = '629' style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">
<table width="629" border="0" cellspacing="0" cellpadding="0">
 <tr>
 <td colspan="4">&nbsp;</td>
 </tr>
  <tr>
    <td width="186" rowspan="4" align="left"><table width="184" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="184" align="right"><img src="../imgs/logo.jpg" alt="" width="100" height="100"></td>
      </tr>
    </table></td>
    <td colspan="3" align="left"><font face="Arial" size="4"><strong><?php echo $school_or_board; ?></strong></font></td>
  </tr>
  <tr>
    <td width="45" align="left">&nbsp;</td>
    <td colspan="2" align="left"><font face="Arial" size="3"><strong><?php echo $exam_name; ?></strong></font></td>
  </tr>
  <tr>
    <td height="13" align="right">&nbsp;</td>
    <td width="59" height="13" align="left">&nbsp;</td>
    <td width="339" align="left"><font face="Arial" size="3"><?php echo $year; ?></font></td>
  </tr>
  <tr>
    <td height="14" colspan="3" align="left">&nbsp;</td>
  </tr>
</table>
<table width="629" height="656" border="0">
  <tr>
    <td height="33" colspan="3" align="center" valign="bottom"><font face="Arial" size="4"><strong><u>Mark Sheet</u></strong></font></td>
  </tr>
    <tr>
    <td height="33" colspan="3" align="center" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="33" colspan="3" align="left" valign="bottom"><font face="Arial" size="3">The marks secured by <?php echo $naam; ?>&nbsp;Symbol No. <?php echo $sym; ?> </font></td>
  </tr>
  <tr>
    <td height="21" colspan="3" align="left" valign="bottom"><font face="Arial" size="3">of <?php echo $school_name; ?> in the <?php echo $exam_name; ?> <?php echo $year; ?> are as follows:</font></td>
  </tr>
  <tr>
    <td height="21" colspan="3" align="left" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="3" align="left" valign="bottom"><table width="629" border="0" cellpadding="0" cellspacing="0" class="bhitri">
      <tr>
        <td width="47" rowspan="2" bgcolor="#969696">S. No.</td>
        <td width="261" rowspan="2" bgcolor="#969696">Subjects</td>
        <td width="39" rowspan="2" align="center" bgcolor="#969696">FM</td>
        <td width="39" rowspan="2" align="center" bgcolor="#969696">PM</td>
        <td colspan="2" align="center" bgcolor="#969696">Marks Obtained</td>
        <td width="50" rowspan="2" align="center" bgcolor="#969696">Total</td>
        <td width="69" rowspan="2" align="center" bgcolor="#969696">Remarks</td>
      </tr>
      <tr>
        <td width="62" align="center" bgcolor="#969696">Th</td>
        <td width="62" align="center" bgcolor="#969696">Pr</td>
      </tr>
      <tr>
        <td align="center">1</td>
        <td>English</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $eng_th; ?>&nbsp;</td>
        <td align="center"><?php echo $eng_pr; ?></td>
        <td align="center"><?php echo $eng_th + $eng_pr; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">2</td>
        <td>Nepali</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $nep; ?></td>
        <td align="center">-</td>
        <td align="center"><?php echo $nep; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">3</td>
        <td>Mathematics</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $maths; ?></td>
        <td align="center">-</td>
        <td align="center"><?php echo $maths; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">4</td>
        <td>Science</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $sci_th; ?></td>
        <td align="center"><?php echo $sci_pr; ?></td>
        <td align="center"><?php echo $sci_th + $sci_pr; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">5</td>
        <td>Social Studies</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $social; ?></td>
        <td align="center">-</td>
        <td align="center"><?php echo $social; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">6</td>
        <td>Health Population and Environment</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $hpe_th; ?></td>
        <td align="center"><?php echo $hpe_pr; ?></td>
        <td align="center"><?php echo $hpe_th + $hpe_pr; ?></td>
        <td>&nbsp;</td>
      </tr>
                <tr>
                  <td align="center">7</td>
                  <td><?php echo $subject_opti; ?></td>
                  <td align="center">100</td>
                  <td align="center">32</td>
                  <td align="center"><?php echo $opti; ?></td>
                  <td align="center">
				  <?php 
				  if ($subject_opti != "Optional Geography"){
						$opti_pr = 0;
						echo "-";
					}
					else {
						echo $opti_pr; 
					}
			
				  ?></td>
                  <td align="center"><?php echo $opti + $opti_pr; ?></td>
                  <td>&nbsp;</td>
                </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">8</td>
        <td><?php echo $subject_optii; ?></td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $optii_th; ?></td>
        <td align="center"><?php echo $optii_pr; ?></td>
        <td align="center"><?php echo $optii_th + $optii_pr; ?></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="254" height="96" align="left" valign="bottom"><table width="227" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="227" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;"><font face="Arial" size="3">80% and above &nbsp;&nbsp;&nbsp;: Distinction</font></td>
      </tr>
      <tr>
        <td style="border-left: 1px solid #000000; border-right: 1px solid #000000;"><font face="Arial" size="3">60% - below 80% : 1<sup>st</sup> Division</font></td>
      </tr>
      <tr>
        <td style="border-left: 1px solid #000000; border-right: 1px solid #000000;"><font face="Arial" size="3">45% - below 60% : 2<sup>nd</sup> Division</font></td>
      </tr>
      <tr>
        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;"><font face="Arial" size="3">32% - below 45% : 3<sup>rd</sup> Division</font></td>
      </tr>
    </table></td>
    <td width="141" height="96" align="left" valign="bottom">&nbsp;</td>
    <td width="226" height="96" align="left" valign="bottom"><table width="208" border="0">
      <tr>
        <td width="135" align="right"><font face="Arial" size="3"><strong>TOTAL :</strong></font></td>
        <td width="63" align="left"><font face="Arial" size="3"><?php echo $total; ?></font></td>
      </tr>
      <tr>
        <td align="right"><font face="Arial" size="3"><strong>PERCENTAGE :</strong></font></td>
        <td align="left"><font face="Arial" size="3"><?php echo $percent; ?></font></td>
      </tr>
      <tr>
        <td align="right"><font face="Arial" size="3"><strong>DIVISION :</strong></font></td>
        <td align="left"><font face="Arial" size="3"><?php echo $division; ?></font></td>
      </tr>
      <tr>
        <td align="right"><font face="Arial" size="3"><strong>RESULT :</strong></font></td>
        <td align="left"><font face="Arial" size="3"><?php echo $passbhae; ?></font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="42" align="left" valign="bottom"><font face="Arial" size="3">Date of Issue:
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
    </font></td>
    <td height="42" align="left" valign="bottom">&nbsp;</td>
    <td height="42" align="left" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="52" colspan="3" align="left" valign="bottom"></td>
  </tr>
    <tr>
    <td height="64" colspan="3" align="left" valign="bottom"><table width="628" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="168"><font face="Arial" size="3">________________________</font></td>
        <td width="292">&nbsp;</td>
        <td width="168"><font face="Arial" size="3">________________________</font></td>
      </tr>
      <tr>
        <td align="center"><font face="Arial" size="3">PRINCIPAL</font></td>
        <td>&nbsp;</td>
        <td align='center'><font face="Arial" size="3">COORDINATOR</font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="32" colspan="3" align="left" valign="middle"><font face="Arial" size="3">Note: 'A' - Absent; 'F' - Fail and 'W' - Withheld</font></td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  </tr>
</table>
</td>
</tr>
</table>


</td>
 <td width = '629' style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">
<table width="629" border="0" cellspacing="0" cellpadding="0">
  <tr>
 <td colspan="4">&nbsp;</td>
 </tr>
  <tr>
    <td width="186" rowspan="4" align="left"><table width="184" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="184" align="right"><img src="../imgs/logo.jpg" alt="" width="100" height="100"></td>
      </tr>
    </table></td>
    <td colspan="3" align="left"><font face="Arial" size="4"><strong><?php echo $school_or_board; ?></strong></font></td>
  </tr>
  <tr>
    <td width="45" align="left">&nbsp;</td>
    <td colspan="2" align="left"><font face="Arial" size="3"><strong><?php echo $exam_name; ?></strong></font></td>
  </tr>
  <tr>
    <td height="13" align="right">&nbsp;</td>
    <td width="59" height="13" align="left">&nbsp;</td>
    <td width="339" align="left"><font face="Arial" size="3"><?php echo $year; ?></font></td>
  </tr>
  <tr>
    <td height="14" colspan="3" align="left">&nbsp;</td>
  </tr>
</table>
<table width="629" height="656" border="0">
  <tr>
    <td height="33" colspan="3" align="center" valign="bottom"><font face="Arial" size="4"><strong><u>Mark Sheet</u></strong></font></td>
  </tr>
    <tr>
    <td height="33" colspan="3" align="center" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="33" colspan="3" align="left" valign="bottom"><font face="Arial" size="3">The marks secured by <?php echo $naam; ?>&nbsp;Symbol No. <?php echo $sym; ?> </font></td>
  </tr>
  <tr>
    <td height="21" colspan="3" align="left" valign="bottom"><font face="Arial" size="3">of <?php echo $school_name; ?> in the <?php echo $exam_name; ?> <?php echo $year; ?> are as follows:</font></td>
  </tr>
  <tr>
    <td height="21" colspan="3" align="left" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="21" colspan="3" align="left" valign="bottom"><table width="629" border="0" cellpadding="0" cellspacing="0" class="bhitri">
      <tr>
        <td width="47" rowspan="2" bgcolor="#969696">S. No.</td>
        <td width="261" rowspan="2" bgcolor="#969696">Subjects</td>
        <td width="39" rowspan="2" align="center" bgcolor="#969696">FM</td>
        <td width="39" rowspan="2" align="center" bgcolor="#969696">PM</td>
        <td colspan="2" align="center" bgcolor="#969696">Marks Obtained</td>
        <td width="50" rowspan="2" align="center" bgcolor="#969696">Total</td>
        <td width="69" rowspan="2" align="center" bgcolor="#969696">Remarks</td>
      </tr>
      <tr>
        <td width="62" align="center" bgcolor="#969696">Th</td>
        <td width="62" align="center" bgcolor="#969696">Pr</td>
      </tr>
      <tr>
        <td align="center">1</td>
        <td>English</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $eng_th; ?>&nbsp;</td>
        <td align="center"><?php echo $eng_pr; ?></td>
        <td align="center"><?php echo $eng_th + $eng_pr; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">2</td>
        <td>Nepali</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $nep; ?></td>
        <td align="center">-</td>
        <td align="center"><?php echo $nep; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">3</td>
        <td>Mathematics</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $maths; ?></td>
        <td align="center">-</td>
        <td align="center"><?php echo $maths; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">4</td>
        <td>Science</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $sci_th; ?></td>
        <td align="center"><?php echo $sci_pr; ?></td>
        <td align="center"><?php echo $sci_th + $sci_pr; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>

        <td align="center">5</td>
        <td>Social Studies</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $social; ?></td>
        <td align="center">-</td>
        <td align="center"><?php echo $social; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">6</td>
        <td>Health Population and Environment</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $hpe_th; ?></td>
        <td align="center"><?php echo $hpe_pr; ?></td>
        <td align="center"><?php echo $hpe_th + $hpe_pr; ?></td>
        <td>&nbsp;</td>
      </tr>
                <tr>
                  <td align="center">7</td>
                  <td><?php echo $subject_opti; ?></td>
                  <td align="center">100</td>
                  <td align="center">32</td>
                  <td align="center"><?php echo $opti; ?></td>
                  <td align="center">
				  <?php 
				  if ($subject_opti != "Optional Geography"){
						$opti_pr = 0;
						echo "-";
					}
					else {
						echo $opti_pr; 
					}
			
				  ?></td>
                  <td align="center"><?php echo $opti + $opti_pr; ?></td>
                  <td>&nbsp;</td>
                </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">8</td>
        <td><?php echo $subject_optii; ?></td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $optii_th; ?></td>
        <td align="center"><?php echo $optii_pr; ?></td>
        <td align="center"><?php echo $optii_th + $optii_pr; ?></td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
  <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="254" height="96" align="left" valign="bottom"><table width="227" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="227" style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;"><font face="Arial" size="3">80% and above &nbsp;&nbsp;&nbsp;: Distinction</font></td>
      </tr>
      <tr>
        <td style="border-left: 1px solid #000000; border-right: 1px solid #000000;"><font face="Arial" size="3">60% - below 80% : 1<sup>st</sup> Division</font></td>
      </tr>
      <tr>
        <td style="border-left: 1px solid #000000; border-right: 1px solid #000000;"><font face="Arial" size="3">45% - below 60% : 2<sup>nd</sup> Division</font></td>
      </tr>
      <tr>
        <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;"><font face="Arial" size="3">32% - below 45% : 3<sup>rd</sup> Division</font></td>
      </tr>
    </table></td>
    <td width="141" height="96" align="left" valign="bottom">&nbsp;</td>
    <td width="226" height="96" align="left" valign="bottom"><table width="208" border="0">
      <tr>
        <td width="135" align="right"><font face="Arial" size="3"><strong>TOTAL :</strong></font></td>
        <td width="63" align="left"><font face="Arial" size="3"><?php echo $total; ?></font></td>
      </tr>
      <tr>
        <td align="right"><font face="Arial" size="3"><strong>PERCENTAGE :</strong></font></td>
        <td align="left"><font face="Arial" size="3"><?php echo $percent; ?></font></td>
      </tr>
      <tr>
        <td align="right"><font face="Arial" size="3"><strong>DIVISION :</strong></font></td>
        <td align="left"><font face="Arial" size="3"><?php echo $division; ?></font></td>
      </tr>
      <tr>
        <td align="right"><font face="Arial" size="3"><strong>RESULT :</strong></font></td>
        <td align="left"><font face="Arial" size="3"><?php echo $passbhae; ?></font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="42" align="left" valign="bottom"><font face="Arial" size="3">Date of Issue:
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
    </font></td>
    <td height="42" align="left" valign="bottom">&nbsp;</td>
    <td height="42" align="left" valign="bottom">&nbsp;</td>
  </tr>
  <tr>
    <td height="52" colspan="3" align="left" valign="bottom"></td>
  </tr>
    <tr>
    <td height="64" colspan="3" align="left" valign="bottom"><table width="628" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="168"><font face="Arial" size="3">________________________</font></td>
        <td width="292">&nbsp;</td>
        <td width="168"><font face="Arial" size="3">________________________</font></td>
      </tr>
      <tr>
        <td align="center"><font face="Arial" size="3">PRINCIPAL</font></td>
        <td>&nbsp;</td>
        <td align='center'><font face="Arial" size="3">COORDINATOR</font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="32" colspan="3" align="left" valign="middle"><font face="Arial" size="3">Note: 'A' - Absent; 'F' - Fail and 'W' - Withheld</font></td>
  </tr>
    <tr>
  <td>&nbsp;</td>
  </tr>
</table>
</td>
</tr>
</table>
</body>





<?php
	
	

}

}
}
?>