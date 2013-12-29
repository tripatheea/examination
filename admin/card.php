<?php





if (!isset($anappleinabasket)){
require("func_library.php");
}

user_logged_on();
allow_in_admin_and_data_manager_only_zone();





//first of all check for whether user is logged on or not

if (!isset($_GET['school'])){


if (!isset($_GET['id'])){
// nothing in the link
die("ERROR: Access denied!");
}
else {
// link is sth like card.php?id=ind

$id = $_GET['id'];


if ($id == "mass"){
	
	
	if(!isset($_GET['school'])){
		echo "<font face='Arial' size='2'>";
		echo "Please enter the school code below!";
		echo "<br /><br />";
		echo "<form name='school_code' method='get' action='card.php'>";
		echo "<input type='hidden' name='id' value='mass' />";
		echo "<input type='text' name='school' maxlength='3' size='3' />";
		echo "<br /><br /><input type='submit' value='Enter' />";
		echo "</form>";


		
	
		
	
	
	
	}

	
}	


elseif ($id == "ind"){
$userid = $_COOKIE['basket_id'];
//find the user's name



$name = user_name($userid);
global $name;
echo "<font face='Arial' size='2'>";
echo "Please enter the school code below!";
echo "<br /><br />";
echo "<form name='school_code' method='get' action='card.php'>";
echo "<input type='hidden' name='id' value='ind' />";
echo "<input type='text' name='school' maxlength='3' size='3' />";
echo "<br /><br /><input type='submit' value='Enter' />";
echo "</form>";



}




}
}
else {


if (!isset($_GET['id'])){
//link has only school; sth like card.php?school=001
die ("ERROR: Acess Denied");
}
else {
//link is complete; sth like card.php?id=ind&school=001
 





$id = $_GET['id'];
if ($id == "ind"){


$school_code = $_GET['school'];
$data_status = data_empty($school_code);
$correct_chars = anka_matra($school_code);


if (($data_status == true) || ($correct_chars == false)){
	die ("Invalid character or empty code enterred!");
}
else {


require("../connection.php");
// create query
$query = "SELECT * FROM schools WHERE school_code = $school_code";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) == 1) {
$row = mysql_fetch_assoc($result);
$school_name = $row['name'];
$school_address = $row['address'];
$show = 1;
global $show;
global $school_code;
global $school_name;
}
else
{
die ('<b>Invalid school code entered!</b>');
}
// free result set memory
mysql_free_result($result);
// close connection
mysql_close($connection);

if ((isset($show)) && ($show == 1)){
echo "<strong><u>School Code:</u></strong> <font color='#A80000'>$school_code</font><br /> ";
echo "<strong><u>School:</u></strong> <font color='#A80000'>$school_name</font><br /> ";
echo "<strong><u>Address:</u></strong> <font color='#A80000'>$school_address</font><br /> <br />";

require("../connection.php");
// create query
$query = "SELECT * FROM marks WHERE school_code = '$school_code'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
echo "<table width='400' border='0' cellspacing='0' cellpadding='0'>";
echo "<tr bgcolor='#828282'>";
echo "<th width='100' scope='col' align='left'><font color='white'>Symbol No.</font> </th>";
echo "<th width='250' scope='col' align='left'><font color='white'>Name</font></th>";
echo "<th width='50' scope='col' align='left'><font color='white'>View</font></th>";
echo " </tr>";




$no = mysql_num_rows($result);


$p = 1;
while ($p <= $no){
$row = mysql_fetch_assoc($result);
$sym[$p] = $row['symbol_no'];
$naam[$p] = $row['name'];
$p++;
}
$p = 1;
while ($p <= $no){

if (($p % 2) == 0){
echo "<form action='final.php' method='post'>";
echo "<input type='hidden' name='symbolno' value='$sym[$p]'>";
echo "<input type='hidden' name='id' value='admission'>";
echo "<input type='hidden' name='bulbul' value='1'>";
echo "<input type='hidden' name='school' value='$school_code'>";
echo "<tr bgcolor='#F7F7F7'>";
echo "<td>" . $sym[$p] . "</td>";
echo "<td>" . $naam[$p] . "</td>";
echo "<td>" . "<input type='submit' name='view' value='Print'>" . "</td>";
echo "</tr>";
echo "</form>";
}
elseif (!($p % 2) == 0){
echo "<form action='final.php' method='post'>";
echo "<input type='hidden' name='symbolno' value='$sym[$p]'>";
echo "<input type='hidden' name='id' value='admission'>";
echo "<input type='hidden' name='bulbul' value='1'>";
echo "<input type='hidden' name='school' value='$school_code'>";
echo "<tr bgcolor='#B1B1B1'>";
echo "<td>" . $sym[$p] . "</td>";
echo "<td>" . $naam[$p] . "</td>";
echo "<td>" . "<input type='submit' name='view' value='Print'>" . "</td>";
echo "</tr>";
echo "</form>";
}



$p++;
}
// free result set memory
mysql_free_result($result);
// close connection
mysql_close($connection);





}
else
{
die ('<b>No student exists. Please enter some students before producing admission cards!</b>');
}








//do everything of ind asbove this
}
}
}
elseif ($id == "mass"){
$school = $_GET['school'];
$data_status = data_empty($school);
$correct_chars = anka_matra($school);


if (($data_status == true) || ($correct_chars == false)){
	die ("Invalid character or empty code enterred!");
}
else {
echo "<form name='print' action='card_mass.php' method='post' >";
echo "<input type='hidden' name='bulbul' value='1' />";
echo "<input type='hidden' name='school' value='$school' />";
echo "<input type='checkbox' name='print' /><font face='Arial' size='2'> Print them! </font><input type='submit' value='Proceed' /> </form>";
?>


<br />
<hr><br />
<font face="Arial" size="2">

<strong>To ensure proper printing of the admission cards, please read the instructions below:</strong>
<br /><br />
Before printing, you need to setup the page for best results. For doing so, please follow the following instructions:
<br />
</font><ul type="square">
<li><font size="2" face="Arial"><strong>For Internet Explorer Users:</strong></font></li>

<ul type="circle">
	<li><font size="2" face="Arial">Go to the printing menu. See picture below:<br />
    <img src="../imgs/menu.jpg" width="379" height="31" />    </font></li>
    <font size="2" face="Arial"><br />
    </font><font face="Arial"><li><font size="2">Select Page Setup from the menu.<br />
    <img src="../imgs/menu2.jpg" width="241" height="113" />    </font></li> <font size="2"><br />
    </font></font>
    <li><font size="2" face="Arial">Select A4 as the <strong>paper size</strong>,<strong> 'Portrait'</strong> as the <strong>orientation</strong>. <br />Check on <strong>'Print Background Colors and Images'</strong> and on <strong>'Enable Shrink-to-Fit'</strong>.<br />
    On <strong>Headers and Footers</strong>, select <strong>'empty'</strong> on all <strong>Headers and Footers</strong>. See below image for reference.<br />
    Choose all margins in between 0.5 to 0.75.<br />
    <img src="../imgs/pagesetup.jpg" width="504" height="411" />    </font></li><br />
    <li><font size="2" face="Arial">Click on OK and then you can print with best results. :)</font></li>
</ul><br />
<li><font face="Arial" size="2"><strong>For Mozilla Firefox users:</strong></font></li>

<ul type="circle">
<li><font size="2" face="Arial">Go to thethe <strong>Firefox/File</strong> menu. See picture below:<br />
      <img src="../imgs/firefox_menu.jpg" width="360" height="64" /> </font></li>
<font size="2" face="Arial"><br />
</font>
<li><font size="2" face="Arial">Select <strong>Print&gt;&gt;Page Setup</strong> from the menu.<br />
      <img src="../imgs/firefox_menu2.jpg" width="313" height="293" /> </font></li>
<font size="2" face="Arial"><br />
</font>
<li><font size="2" face="Arial">Select <strong>'Format &amp; Options'</strong> tab. <br />
  Select <strong>'Portrait'</strong> as the orientation. <br />
  Check on <strong>'Shrink to Fit Page Width'</strong> and on <strong>'Print Background (colors &amp; images)'</strong>.<br />
  <img src="../imgs/firefox_pagesetup1.jpg" width="374" height="431" /> </font></li>
<li><font size="2" face="Arial">Select <strong>'Margins &amp; Header/Footer'</strong> tab.<br />
  Choose all margins in between 0.5 to 0.75.<br />
On <strong>Headers and Footers</strong>, select <strong>'--blank--'</strong> on all Headers and Footers. See below image for reference.<br />
<img src="../imgs/firefox_pagesetup2.jpg" alt="" width="374" height="431" /> </font></li>
<br />
<li><font size="2" face="Arial">Click on OK and then you can print with best results. :)</font></li>
</ul><br />
<li><font face="Arial" size="2"><strong>For all other browsers, the procedure is similar. Please find the detailed procedure for yourself.</strong></font>
</ul>









<?php
}





}







 
 
 
 }
 
 }




?>