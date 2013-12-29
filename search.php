<?php

if (!isset($_POST['type'])) {
die ("Direct Access Prohibited!");
}
else {


$type = $_POST['type'];
$symbol_no = $_POST['symbolno'];
if ($type == "basic"){		
		
		require("admin/func_library.php");
		require("connection.php");
		// create query
		$query = "SELECT * FROM marks WHERE symbol_no = '$symbol_no'";
		// execute querys
		$result = mysql_query($query) or die ("Error in query: $query.
		" . mysql_error());
		// see if any rows were returned
		if (mysql_num_rows($result) == 1) {
			$row = mysql_fetch_assoc($result);
			$pass = $row['pass'];
			$with = $row['withheld'];
			if ($with == "1"){
						$kbhayo = "Sorry! Your result has been withheld!";
						echo "<center>";
						require("top.php");
						require("template.php");
						require("footer.php");
						die();
				
			}
				if ($pass == "Pass"){
						$kbhayo = "Congratulations! You successfully passed the exam!";
						echo "<center>";
						require("top.php");
						require("template.php");
						require("footer.php");
						echo "</center>";
				}
				else {
					$kbhayo = "Sorry! You didn't make it this time!";
					echo "<center>";
					require("top.php");
					require("template.php");
					require("footer.php");
					echo "</center>";
				}
		}
		else
		{
					$kbhayo = "Invalid symbol no.!";
					echo "<center>";
					require("top.php");
					require("template.php");
					require("footer.php");
					echo "</center>";
		}
		// free result set memory
		mysql_free_result($result);
		// close connection
		mysql_close($connection);
		
		
		
}

elseif ($type == "marksheet"){
	

$symbol = $_POST['symbolno'];
$birthdate = substr(($_POST['year']), -2) . "p" . $_POST['month'] . "p" . $_POST['day'];
require("admin/func_library.php");
require("connection.php");
	
// create query
$query = "SELECT * FROM marks WHERE symbol_no = '$symbol_no'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
	$row = mysql_fetch_assoc($result);
	$pass = $row['pass'];
	$day = $row['dob'];
	$day = str_replace("/", "p", $day);
			$with = $row['withheld'];
			if ($with == "1"){
						$kbhayo = "Sorry! Your result has been withheld!";
						echo "<center>";
						require("top.php");
						require("template.php");
						die();
				
			}
	if ($day == $birthdate){
		if ($pass == "Pass"){
			$kbhayo = "Congratulations! You passed. Your marksheet is as follows:";
			
			$showmarks = true;
			
			
			echo "<center>";
			require("top.php");
			require("template.php");
			echo "</center>";
			
			
			
		}
		else {
		
				$kbhayo = "Sorry! You didn't make it this time!";
				echo "<center>";
				require("top.php");
				require("template.php");
				echo "</center>";
			
			
		}	
}
else {
$kbhayo = "Invalid symbol no. and DOB comination!";
echo "<center>";
require("top.php");
require("template.php");
echo "</center>";

}	
	
	
	
	
}
else {
$kbhayo = "Invalid symbol no.!";
echo "<center>";
require("top.php");
require("template.php");
echo "</center>";


}
}	
elseif ($type == "ledger"){
	
	


	echo "Please login to view your ledger!";

}






}

?>