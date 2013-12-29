<?php

//require ("func_library.php");

user_logged_on();
allow_in_admin_and_data_manager_only_zone();



if (!isset($bulbul)){
	die ("ERROR: Unauthorized access!");
}
else {
	if (!$bulbul == "1"){
		die ("ERROR: Unauthorized access!");
	}
	else {
?>

<?php
// user comes from good background; proceed
$userid = $_COOKIE['basket_id'];
//find the user's name
$name = user_name($userid);
global $name;


// school addition layout/forehand
echo "<font face='Arial' size='2' color='black'>So you wanna produce admission cards <strong>" . $name . "!</strong></font>";
echo "<br />";
echo "<font face='Arial' size='2' color='black'>";
echo "<ul>";
echo "<li><a href='card.php?id=ind'>Individual Cards</a></li>";
echo "<li><a href='card.php?id=mass'>Mass Produce</a></li>";
echo "<li><a href='index.php'>Go Back</a></li>";
echo "</ul>";
echo "</font>";


?>

<?php


}
}
?>