<?php
if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access cookie!");

}
else{

if (!isset($_POST['bulbul'])){
die ("ERROR: Unauthorized access redirect!");
}
else{
require ("../connection.php");
if (!isset($anappleinabasket)){
require("func_library.php");
}
allow_in_admin_and_data_manager_only_zone();
$no = $_POST['no'];
$school = $_POST['school'];
$p = 1;
while ($p <= $no){
$sym[$p] = $_POST['sym_' . $p];

// create query
$query = "SELECT * FROM marks WHERE school_code = '$school' AND pass = 'Fail' AND symbol_no = '$sym[$p]'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
$row = mysql_fetch_assoc($result);
$sym[$p] = $row['symbol_no'];
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
$optii_th[$p] = $row['optii_th'];
$optii_pr[$p] = $row['optii_pr']; 
$opti_choice[$p] = $row['opti_choice']; 
$optii_choice[$p] = $row['optii_choice']; 
if(isset($_POST['pass_' . $p])){
$pass_him_or_her[$p] = $_POST['pass_' . $p];
}
else {
$pass_him_or_her[$p] = "";
}
if ($pass_him_or_her[$p] == "on"){

pass_fail ($sym[$p] , $opti_choice[$p] , $optii_choice[$p] , $eng_th[$p] , $eng_pr[$p] , $nep[$p] , $maths[$p] , $sci_th[$p] , $sci_pr[$p] ,$social[$p] , $hpe_th[$p] , $hpe_pr[$p] , $opti[$p] , $optii_th[$p] , $optii_pr[$p]);
}



$p++;
}
echo "Grace marks successfully provided to the selected students<br /><a href='tools.php?id=001&school=$school'>Go Back</a>";
}
}









?>
