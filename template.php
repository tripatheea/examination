<basefont face="Ärial" size="2">
<table width="775" border="0" background="imgs/bckg_in.png">
	<tr>

	  <td width="665"><strong><font face="Arial" size="2"><?php echo $kbhayo; ?></font></strong></td>
	</tr>
	<tr>
	  <td><strong><font face="Arial" size="2">
	  <?php
	
	  if ((isset($showmarks)) && ($showmarks == true)){
	  
	  ?>
	  <?php
	  //get everything from database
	  
	  $sym = $symbol_no;
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
$school_code = $row['school_code'];
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

	  
	  
	  
	  
      </font>
      
      <table width="368" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="216" rowspan="2" bgcolor="#969696">Subjects</td>
    <td colspan="2" bgcolor="#969696">Marks Obtained</td>
    <td width="51" rowspan="2" align="center" bgcolor="#969696">Total</td>
  </tr>
  <tr>
    <td width="50" align="center" bgcolor="#969696">Th</td>
    <td width="51" align="center" bgcolor="#969696">Pr</td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">English</td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $eng_th; ?>&nbsp;</td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $eng_pr; ?></td>
    <td align="center" bgcolor="#FFFFFF"><?php echo $eng_th + $eng_pr; ?></td>
  </tr>
  <tr bgcolor="#E0E0E0">
    <td>Nepali</td>
    <td align="center"><?php echo $nep; ?></td>
    <td align="center">-</td>
    <td align="center"><?php echo $nep; ?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Mathematics</td>
    <td align="center"><?php echo $maths; ?></td>
    <td align="center">-</td>
    <td align="center"><?php echo $maths; ?></td>
  </tr>
  <tr bgcolor="#E0E0E0">
    <td>Science</td>
    <td align="center"><?php echo $sci_th; ?></td>
    <td align="center"><?php echo $sci_pr; ?></td>
    <td align="center"><?php echo $sci_th + $sci_pr; ?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td>Social Studies</td>
    <td align="center"><?php echo $social; ?></td>
    <td align="center">-</td>
    <td align="center"><?php echo $social; ?></td>
  </tr>
  <tr bgcolor="#E0E0E0">
    <td>Health Population and Environment</td>
    <td align="center"><?php echo $hpe_th; ?></td>
    <td align="center"><?php echo $hpe_pr; ?></td>
    <td align="center"><?php echo $hpe_th + $hpe_pr; ?></td>
  </tr>
  <tr bgcolor="#FFFFFF">
    <td><?php echo $subject_opti; ?></td>
    <td align="center"><?php echo $opti; ?></td>
    <td align="center">-</td>
    <td align="center"><?php echo $opti; ?></td>
  </tr>
  <tr bgcolor="#E0E0E0">
    <td><?php echo $subject_optii; ?></td>
    <td align="center"><?php echo $optii_th; ?></td>
    <td align="center"><?php echo $optii_pr; ?></td>
    <td align="center"><?php echo $optii_th + $optii_pr; ?></td>
  </tr>
</table>

      
      
      
      
      
      <?php
	  
	  }
	  
	  
	  
	   ?>
      
      
      </font></strong></td>
  </tr>
	<tr>
	  <td><font face="Arial" size="2"><a href="index.php?bas=check">Go Back</a></font></td>
  </tr>
</table>
</basefont>