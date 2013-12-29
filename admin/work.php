<?php

if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access!");

}
else{

if (!isset($_GET['id'])){
die ("Error! Unauthorized access!");
}
else {
if (!isset($anappleinabasket)){
require("func_library.php");
}
$option = $_GET['id'];
if ($option == "IH453"){
//logout

setcookie("basket_id", "", time()-3600, "/",
			"", 0);
//session_destroy();

header("Location: logout.php");
}
elseif ($option == "PMI7E"){
	//admission card
	$bulbul = 1;
	include ("admission.php");
}
elseif ($option == "RASl0"){
	//report cards
	header ("Location: reportcard.php");
}
elseif ($option == "AAHo3"){
	//tools
	header ("Location: tools.php");
}
elseif ($option == "TS0vR"){
	//settings
	header ("Location: settings.php");
}

elseif ($option == "pRaTi"){
	//settings
	header ("Location: changepassword.php");
}
elseif ($option == "tImA"){
	//settings
	header ("Location: myledger.php");
}
elseif ($option == "gs0deDS"){
	//settings
	header ("Location: compile.php");
}
elseif ($option == "buLBUl"){
	//help
	header ("Location: help.php");
}
else {
	die ("ERROR: Unidentified id!");
}







}
}

?>