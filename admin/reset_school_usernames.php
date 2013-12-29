<?php
if (!isset($_COOKIE['basket_id'])){
	die ("ERROR: Unauthorized access!");
}
else{
	if (!isset($anappleinabasket)){
		require("func_library.php");
	}
	allow_in_admin_only_zone();
	
	
	if (!isset($_POST['bulbul'])){
	
	
		require("../connection.php");
		
		// create query
		$query = "SELECT user_id, username FROM users WHERE access_level = 4";
		// execute querys
		$result = mysql_query($query) or die ("Error in query: $query.
		" . mysql_error());
		// see if any rows were returned
		$i = 0;
		$users = array();
		while ($row = mysql_fetch_assoc($result)){
			$users[$i]['id'] = $row['user_id'];
			$users[$i]['username'] = $row['username'];
			$users[$i]['password'] = sha1($row['username']);
			$i++;
		}
		
		// free result set memory
		mysql_free_result($result);
	
		foreach($users as $user){
			$a = $user['id'];
			$b = $user['password'];
			//create  query
			$query = "UPDATE users SET password = '$b' WHERE user_id = '$a'";
			// execute querys
			$result = mysql_query($query) or die ("Error in query: $query.
			" . mysql_error());
		}
		
		echo "All schools' login details reset successully! <a href='http://example.com/admin/'>Go Back!</a>";
			
	}
}
?>
