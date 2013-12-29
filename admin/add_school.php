<?php
if (!isset($anappleinabasket)){
require("func_library.php");
}

user_logged_on();
allow_in_admin_only_zone();

if (!isset($bulbul)){
	die ("Unauthorized access!");
}
else {

if ($bulbul == 1){



if (!isset($_POST['no_of_schools'])){

echo "<font face='Arial' size='2'>How many rows to you wish to have(no. of schools to enter)?<br /><br /></font>";
echo "<form action='department.php?dept=school&task=add' method ='post'>";
echo "<input type='text' name='no_of_schools' size='1' maxlength='2' />&nbsp;";
die ("<input type='Submit' value='Proceed' />");
}
else {

$no_of_schools123 = $_POST['no_of_schools'];

if (anka_matra($no_of_schools123) == false){
	die("Please enter a no. and not something else!");
}
// user comes from good background; proceed
$userid = $_COOKIE['basket_id'];
//find the user's name
$name = user_name($userid);
global $name;


// school addition layout/forehand
?>
<head>
</head>
<body>
<?php


echo "<font face='Arial' size='2' color='brown'><strong>We're adding schools " . $name . "!</font>";
echo "<br /><br />";
echo "<form name='school_add' action='add.php' method='post'>";
echo "<table width='597' border='0' cellspacing = '0' id='add_school'>";
echo "<tr>";
echo "<th width='63' bgcolor='#828282' scope='col'><font color='white'>S. No.</font></th>";
echo "<th width='47' bgcolor='#828282' scope='col'><font color='white'> &nbsp;  Code</font></th>";
echo "<th width='266' bgcolor='#828282' scope='col'><font color='white'> &nbsp; Name</font></th>";
echo "<th width='203' bgcolor='#828282' scope='col'><font color='white'> Address&nbsp; </font></th>";
echo "</tr>";
$i = 1;
while ($i <= $no_of_schools123){
if ($i % 2 == 0){
	echo "<tr>";
	echo "<td align='center' bgcolor='#FFFFFF'>$i</td>";
	echo "<td align='center' bgcolor='#FFFFFF'><input type='text' size='3' maxlength='3' name='school_code_$i' style='background:#FFFFFF;' /></td>";	
	echo "
	<td align='center' bgcolor='#FFFFFF'>
		<input type='text' size='40' maxlength='50' name='school_name_$i' style='background:#FFFFFF;' />
	</td>";		
	echo "
	<td align='center' bgcolor='#FFFFFF'>
		<input type='text' size='30' maxlength='40' name='school_address_$i' style='background:#FFFFFF;' />
	</td>";	
	echo "</tr>";
	}
	else
	{
	
	echo "<tr>";
	echo "<td align='center' bgcolor='#E1E1E1'>$i</td>";
	echo "<td align='center' bgcolor='#E1E1E1'><input type='text' size='3' maxlength='3' name='school_code_$i' style='background:#E1E1E1;' /></td>";	
	echo "
	<td align='center' bgcolor='#E1E1E1'>
		<input type='text' size='40' maxlength='50' name='school_name_$i' style='background:#E1E1E1;' />
	</td>";		
	echo "
	<td align='center' bgcolor='#E1E1E1'>
		<input type='text' size='30' maxlength='40' name='school_address_$i' style='background:#E1E1E1;' />
	</td>";	
	echo "</tr>";
}
 $no_of_rows_enterred = $i;
 global $no_of_rows_enterred;
 $i++;
 }
echo "</table>";
echo "<br />";
echo "&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;";
echo "<input type='submit' name='save' id='save' value='Save' />";
echo "<input type='reset' name='Reset' id='button' value='Reset' />";
echo "<input type='hidden' name='no_of_rows_enterred' value='$no_of_rows_enterred' />";
echo "<input type='hidden' name='bulbul' value='aIeL8J2m1s' />";
echo "<input type='hidden' name='dept' value='school' />";
echo "</form>";
echo "</body>";
?>

<?php
}
}
}
?>


