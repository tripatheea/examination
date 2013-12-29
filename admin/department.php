<?php
if (!isset($_COOKIE['basket_id'])){
	die("ERROR: Access Denied");
}
else{


?>

<?php
if (!isset($_GET['task'])){

	if (!isset($_GET['dept'])){
		//die("ERROR: Access Denied neither task nor dept");
		header("Location: index.php");
		
	}
	else{
		//adddress is sth like ....department.php?dept=sth
		require("func_library.php");
		$userid = $_COOKIE['basket_id'];
		$name = user_name($userid);
		$department = $_GET['dept'];
		$access_level = access_level($userid);

		if($access_level == "4"){
			$status = get_exam_status();				// 0 => Allow students only. 1 => Allow marks only. 2 => Allow nothing.
			if(($status == "2") || ($status == "0" && $department == "marks")){
				die("You can no longer change marks. Please contact our office if there's still something you need to change!");				
			}
			elseif(($status == "2") || ($status == "1" && $department == "student")){
				die("You can no longer change the student details. Please contact our office if there's still something you need to change!");							
			}
		}


		
		if (($department == "user") || ($department == "school")){
			allow_in_admin_only_zone();
		}

		
		echo "<font face='Arial' size='2'>Hey <strong>" . $name . "</strong>! Doin' good? <br/> We're now working in the " . $department . "s section! Please select what you want to do!";
		echo "<ul type='square'>";
		echo "<li><a href='?dept=". strtolower($department) .  "&task=add'>Add " . $department . "</a></li>";
		if ($department != "das"){
		echo "<li><a href='?dept=". strtolower($department) .  "&task=edit'>Edit " . $department . "</a></li>";
		}
		if ($department != "marks"){
		echo "<li><a href='?dept=". strtolower($department) .  "&task=remove'>Remove " . $department . "</a></li>";
		}
		echo "<li><a href='index.php'>Go Back</li>";
		echo "</ul>";
		
		
		
		
		
		
		
		
		
		
	}
}
else {

	if (!isset($_GET['dept'])){
	die("ERROR: Access Denied");
	}
	else{
		$department = $_GET['dept'];
		$task = $_GET['task'];
		$filereqd = $task . "_" . $department . ".php";
		$bulbul = 1;
		require($filereqd);
	}
}
}
?>
			
