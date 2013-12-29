<?php

require("../connection.php");
require ("func_library.php");
allow_in_admin_and_data_manager_only_zone();
// create query
$query = "SELECT * FROM marks";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
	$proceed = true;
}
else {
	die ("ERROR: No marks enterred! Enter marks first!");
}
// free result set memory
mysql_free_result($result);



if ($proceed == true){

// create query
$query = "SELECT * FROM marks";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
$p = 1;
while ($p <= mysql_num_rows($result)){
$row = mysql_fetch_assoc($result);
$chinha[$p] = $row['id'];
$eng_th[$p] = $row['english_th'];
$eng_pr[$p] = $row['english_pr'];
$nepali[$p] = $row['nepali'];
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
$opti_choice[$p] = $row['opti_choice'];
$optii_choice[$p] = $row['optii_choice'];
$total[$p] = $eng_th[$p] + $eng_pr[$p] + $nepali[$p] + $maths[$p] + $sci_th[$p] + $sci_pr[$p] + $social[$p] + $hpe_th[$p] + $hpe_pr[$p] + $opti[$p] + $opti_pr[$p] + $optii_th[$p] + $optii_pr[$p];
$passbhae[$p] = pass($opti_choice[$p] , $optii_choice[$p] , $eng_th[$p] , $eng_pr[$p] , $nepali[$p] , $maths[$p] , $sci_th[$p] , $sci_pr[$p] , $social[$p] , $hpe_th[$p] , $hpe_pr[$p] , $opti[$p] , $optii_th[$p] , $optii_pr[$p]);

if ($passbhae[$p] == "Pass"){
$percent[$p] = $total[$p]/8;
}
else {
$percent[$p] = "-";
}

if ($passbhae[$p] == "Pass"){
$division[$p] = division($percent[$p]);
}
else {
$division[$p] = "-";
}

if ($total[$p] == 0){
$division[$p] = "Absent";
}

$ready[$p] = "1";

$total_unready = $p;
$p++;
}

// free result set memory
mysql_free_result($result);





$r = 1;
while ($r <= $total_unready){

// create query
$query = "UPDATE marks
SET total='$total[$r]' , percent='$percent[$r]' , division='$division[$r]' , pass='$passbhae[$r]' , ready='$ready[$r]'
WHERE id='$chinha[$r]'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());	
$r++;
}

echo "Result successfully compiled. Hit the back key of your browser to go back!";

}
?>