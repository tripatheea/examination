<?php
if (!isset($anappleinabasket)){
require("func_library.php");
}
if ((!isset($correct_bato))){

die ("ERROR: Access Denied!");

}
else{
$userid = $_COOKIE['basket_id'];
echo "<font face='Arial' size='2'>";
echo "<strong>Howdy " . user_name($userid) . "!</strong><br /><br />";
echo "Please select what you want to do!";




$access_level = access_level($userid);


if (($access_level == 0) || ($access_level == 1)) {
		//administrator; give full access
		echo "<ul type='square'>";
		echo "<li><a href='department.php?dept=user'>Users</a></li>";
		echo "<li><a href='department.php?dept=school'>Schools</a></li>";
		echo "<li><a href='department.php?dept=student'>Students</a></li>";
		echo "<li><a href='department.php?dept=marks'>Marks</li>";
		echo "<li><a href='work.php?id=PMI7E'>Admission Cards</li>";
		echo "<li><a href='work.php?id=gs0deDS'>Compile Result</li>";
		echo "<li><a href='work.php?id=RASl0'>Report Cards</li>";
		echo "<li><a href='work.php?id=AAHo3'>Tools</li>";				
		echo "<li><a href='work.php?id=TS0vR'>Settings</li>";
		echo "<li><a href='work.php?id=pRaTi'>Change Password</li>";	
		echo "<li><a href='list.php'>List Schools</li>";
		echo "<li><a href='students.php'>List Students</li>";		
		echo "<li><a href='work.php?id=buLBUl'>Help</li>";		
		echo "<li><a href='work.php?id=IH453'>Logout</li>";
		echo "</ul>";
}
elseif ($access_level == 2){
		//data manager's account; only selected access
		echo "<ul type='square'>";
		echo "<li><a href='department.php?dept=user'>Users</a></li>";
		echo "<li><a href='department.php?dept=school'>Schools</a></li>";
		echo "<li><a href='department.php?dept=student'>Students</a></li>";
		echo "<li><a href='department.php?dept=marks'>Marks</li>";
		echo "<li><a href='work.php?id=PMI7E'>Admission Cards</li>";
		echo "<li><a href='work.php?id=RASl0'>Report Cards</li>";
		echo "<li><a href='work.php?id=AAHo3'>Tools</li>";		
		echo "<li><a href='work.php?id=pRaTi'>Change Password</li>";
		echo "<li><a href='list.php'>List Schools</li>";
		echo "<li><a href='students.php'>List Students</li>";	
		echo "<li><a href='work.php?id=buLBUl'>Help</li>";
		echo "<li><a href='work.php?id=IH453'>Logout</li>";
		echo "</ul>";
		
}
elseif ($access_level == 3){
		//data manager(limited)'s account; only selected access
		echo "<ul type='square'>";
		echo "<li><a href='department.php?dept=student'>Students</a></li>";
		echo "<li><a href='department.php?dept=marks'>Marks</li>";	
		echo "<li><a href='work.php?id=pRaTi'>Change Password</li>";
		echo "<li><a href='work.php?id=buLBUl'>Help</li>";		
		echo "<li><a href='work.php?id=IH453'>Logout</li>";
		echo "</ul>";
		
}
elseif ($access_level == 4){
		//school's account; only selected access
		require ("../connection.php");
		// create query
		$query = "SELECT * FROM settings WHERE field = 'result_status'";
		// execute querys
		$result = mysql_query($query) or die ("Error in query: $query.
		" . mysql_error());
		$row = mysql_fetch_assoc($result);
		$status = $row['value'];
		
		
		
		echo "<ul type='square'>";
		if ($status == "0"){
			echo "<li><a href='department.php?dept=student'>Students</a></li>";
		}
		elseif($status == "1"){
			echo "<li><a href='department.php?dept=marks'>Marks</li>";
		}			
		else {
			echo "<li><a href='work.php?id=tImA'>My Ledger</li>";
		}
		echo "<li><a href='work.php?id=pRaTi'>Change Password</li>";
		echo "<li><a href='work.php?id=buLBUl'>Help</li>";		
		echo "<li><a href='work.php?id=IH453'>Logout</li>";
		echo "</ul>";
		
}
else {
	die ("You are not allowed here. Go away!");
}



}



?>