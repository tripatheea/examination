<?php
if (!isset($_COOKIE['basket_id'])){
	die("ERROR: Access Denied");
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
$school = $_POST['school'];
if (!isset($anappleinabasket)){
require("func_library.php");
}
allow_in_admin_and_data_manager_only_zone();
$data_status = data_empty($school);

$correct_chars = anka_matra($school);


if (($data_status == true) || ($correct_chars == false)){
	die ("Invalid character or empty code enterredd!");
}
else {

require ("../connection.php");


// create query
$query = "SELECT * FROM marks WHERE school_code = '$school'";


// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
if (mysql_num_rows($result) == 0){
	die ("ERROR: No student exists for enterred school!");
}

$p = 1;

while ($p <= mysql_num_rows($result)){
$row = mysql_fetch_assoc($result);
$sym[$p] = $row['symbol_no'];
$name[$p] = $row['name'];
$school_code[$p] = $row['school_code'];
$opti_choice[$p] = $row['opti_choice'];
$optii_choice[$p] = $row['optii_choice'];
$eng_th[$p] = $row['english_th'];
$eng_pr[$p] = $row['english_pr'];
$nep[$p] = $row['nepali'];
$maths[$p] = $row['maths'];
$sci_th[$p] = $row['science_th'];
$sci_pr[$p] = $row['science_pr'];
$social[$p] = $row['social'];
$hpe_th[$p] = $row['hpe_th'];
$hpe_pr[$p] = $row['hpe_pr'];
$opti[$p] = $row['opti'];
$opti_pr[$p] = $row['opti_pr'];
$optii_th[$p] = $row['optii_th'];
$optii_pr[$p] = $row['optii_pr'];
$total[$p] = $row['total'];
$percent[$p] = $row['percent'];
$division[$p] = $row['division'];
$passbhae[$p] = $row['pass'];
$no = $p;
$p++;
}
// free result set memory
mysql_free_result($result);

//$school_name = school_name ($school_code[$p]);

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
$query = "SELECT * FROM subjects WHERE subject_code = '$opti_choice[$p]'";
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
$query = "SELECT * FROM subjects WHERE subject_code = '$optii_choice[$p]'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$row = mysql_fetch_assoc($result);
$subject_optii[$p] = $row['name'];
$p++;
}

?><head>

<style>
@media print

{

table {page-break-after:always}

}


</style>
<style language="text/css">
.bhitri {
    font-family: Arial;
	font-size:1.000em;
	 }

</style>

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
<! ------REPORT CARD GOES HERE ------- />




<table border='0' cellspacing = '0'>
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
    <td height="33" colspan="3" align="left" valign="bottom"><font face="Arial" size="3">The marks secured by <?php echo $name[$p]; ?>&nbsp;Symbol No. <?php echo $sym[$p]; ?> </font></td>
  </tr>
  <tr>
    <td height="21" colspan="3" align="left" valign="bottom"><font face="Arial" size="3">of <?php echo school_name ($school_code[$p]); ?> in the <?php echo $exam_name; ?> <?php echo $year; ?> are as follows:</font></td>
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
        <td align="center"><?php echo $eng_th[$p]; ?>&nbsp;</td>
        <td align="center"><?php echo $eng_pr[$p]; ?></td>
        <td align="center"><?php echo $eng_th[$p] + $eng_pr[$p]; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">2</td>
        <td>Nepali</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $nep[$p]; ?></td>
        <td align="center">-</td>
        <td align="center"><?php echo $nep[$p]; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">3</td>
        <td>Mathematics</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $maths[$p]; ?></td>
        <td align="center">-</td>
        <td align="center"><?php echo $maths[$p]; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">4</td>
        <td>Science</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $sci_th[$p]; ?></td>
        <td align="center"><?php echo $sci_pr[$p]; ?></td>
        <td align="center"><?php echo $sci_th[$p] + $sci_pr[$p]; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">5</td>
        <td>Social Studies</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $social[$p]; ?></td>
        <td align="center">-</td>
        <td align="center"><?php echo $social[$p]; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">6</td>
        <td>Health Population and Environment</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $hpe_th[$p]; ?></td>
        <td align="center"><?php echo $hpe_pr[$p]; ?></td>
        <td align="center"><?php echo $hpe_th[$p] + $hpe_pr[$p]; ?></td>
        <td>&nbsp;</td>
      </tr>
                <tr>
                  <td align="center">7</td>
                  <td><?php echo $subject_opti[$p]; ?></td>
                  <td align="center">100</td>
                  <td align="center">32</td>
                  <td align="center"><?php echo $opti[$p]; ?></td>
                  <td align="center">
				  <?php 
				  if ($subject_opti[$p] != "Optional Geography"){
						$opti_pr[$p] = 0;
						echo "-";
					}
					else {
						echo $opti_pr[$p]; 
					}
			
				  ?></td>
                  <td align="center"><?php echo $opti[$p] + $opti_pr[$p]; ?></td>
                  <td>&nbsp;</td>
                </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">8</td>
        <td><?php echo $subject_optii[$p]; ?></td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $optii_th[$p]; ?></td>
        <td align="center"><?php echo $optii_pr[$p]; ?></td>
        <td align="center"><?php echo $optii_th[$p] + $optii_pr[$p]; ?></td>
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
        <td width="63" align="left"><font face="Arial" size="3"><?php echo $total[$p]; ?></font></td>
      </tr>
      <tr>
        <td align="right"><font face="Arial" size="3"><strong>PERCENTAGE :</strong></font></td>
        <td align="left"><font face="Arial" size="3"><?php echo $percent[$p]; ?></font></td>
      </tr>
      <tr>
        <td align="right"><font face="Arial" size="3"><strong>DIVISION :</strong></font></td>
        <td align="left"><font face="Arial" size="3"><?php echo $division[$p]; ?></font></td>
      </tr>
      <tr>
        <td align="right"><font face="Arial" size="3"><strong>RESULT :</strong></font></td>
        <td align="left"><font face="Arial" size="3"><?php echo $passbhae[$p]; ?></font></td>
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



</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
<?php
if (isset($sym[$p+1])){


?>    <td width = '629' style="border-bottom: 1px solid #000000; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;">

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
    <td height="33" colspan="3" align="left" valign="bottom"><font face="Arial" size="3">The marks secured by <?php echo $name[$p+1]; ?>&nbsp;Symbol No. <?php echo $sym[$p+1]; ?> </font></td>
  </tr>
  <tr>
    <td height="21" colspan="3" align="left" valign="bottom"><font face="Arial" size="3">of <?php echo school_name ($school_code[$p]); ?> in the <?php echo $exam_name; ?> <?php echo $year; ?> are as follows:</font></td>
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
        <td align="center"><?php echo $eng_th[$p+1]; ?>&nbsp;</td>
        <td align="center"><?php echo $eng_pr[$p+1]; ?></td>
        <td align="center"><?php echo $eng_th[$p+1] + $eng_pr[$p+1]; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">2</td>
        <td>Nepali</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $nep[$p+1]; ?></td>
        <td align="center">-</td>
        <td align="center"><?php echo $nep[$p+1]; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center">3</td>
        <td>Mathematics</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $maths[$p+1]; ?></td>
        <td align="center">-</td>
        <td align="center"><?php echo $maths[$p+1]; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">4</td>
        <td>Science</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $sci_th[$p+1]; ?></td>
        <td align="center"><?php echo $sci_pr[$p+1]; ?></td>
        <td align="center"><?php echo $sci_th[$p+1] + $sci_pr[$p+1]; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>

        <td align="center">5</td>
        <td>Social Studies</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $social[$p+1]; ?></td>
        <td align="center">-</td>
        <td align="center"><?php echo $social[$p+1]; ?></td>
        <td>&nbsp;</td>
      </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">6</td>
        <td>Health Population and Environment</td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $hpe_th[$p+1]; ?></td>
        <td align="center"><?php echo $hpe_pr[$p+1]; ?></td>
        <td align="center"><?php echo $hpe_th[$p+1] + $hpe_pr[$p+1]; ?></td>
        <td>&nbsp;</td>
      </tr>
                <tr>
                  <td align="center">7</td>
                  <td><?php echo $subject_opti[$p+1]; ?></td>
                  <td align="center">100</td>
                  <td align="center">32</td>
                  <td align="center"><?php echo $opti[$p+1]; ?></td>
                  <td align="center">
				  <?php 
				  if ($subject_opti[$p+1] != "Optional Geography"){
						$opti_pr[$p+1] = 0;
						echo "-";
					}
					else {
						echo $opti_pr[$p+1]; 
					}
			
				  ?></td>
                  <td align="center"><?php echo $opti[$p+1] + $opti_pr[$p+1]; ?></td>
                  <td>&nbsp;</td>
                </tr>
      <tr bgcolor="#E0E0E0">
        <td align="center">8</td>
        <td><?php echo $subject_optii[$p+1]; ?></td>
        <td align="center">100</td>
        <td align="center">32</td>
        <td align="center"><?php echo $optii_th[$p+1]; ?></td>
        <td align="center"><?php echo $optii_pr[$p+1]; ?></td>
        <td align="center"><?php echo $optii_th[$p+1] + $optii_pr[$p+1]; ?></td>
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
        <td width="63" align="left"><font face="Arial" size="3"><?php echo $total[$p+1]; ?></font></td>
      </tr>
      <tr>
        <td align="right"><font face="Arial" size="3"><strong>PERCENTAGE :</strong></font></td>
        <td align="left"><font face="Arial" size="3"><?php echo $percent[$p+1]; ?></font></td>
      </tr>
      <tr>
        <td align="right"><font face="Arial" size="3"><strong>DIVISION :</strong></font></td>
        <td align="left"><font face="Arial" size="3"><?php echo $division[$p+1]; ?></font></td>
      </tr>
      <tr>
        <td align="right"><font face="Arial" size="3"><strong>RESULT :</strong></font></td>
        <td align="left"><font face="Arial" size="3"><?php echo $passbhae[$p+1]; ?></font></td>
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


<br /><br />
<?php
}
else {
	break;
}
?>
</td>
  </tr>
</table>












<! ------REPORT CARD ENDS HERE ------- />
<?php



$p = $p + 2;
}

echo "</body>";










?>
<?php

}


}



}
}
}
?>