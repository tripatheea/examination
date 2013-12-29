<?php

// set server access variables
$host = "";
$user = "";
$pass = "";
$db = "";
// open connection
$connection = mysql_connect($host, $user, $pass) or die ("Unable to
connect!");
// select database
mysql_select_db($db) or die ("Unable to select database!");


?>
