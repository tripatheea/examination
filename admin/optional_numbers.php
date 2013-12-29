<?php
require_once("func_library.php");
require_once("../connection.php");
allow_in_admin_and_data_manager_only_zone();
if (!isset($_COOKIE['basket_id'])){
	die ("ERROR: Unauthorized access cookie!");
}

// create query
$query = "SELECT * FROM schools";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
		$p = 0;
		while ($p < mysql_num_rows($result)){
			$row = mysql_fetch_assoc($result);
			$schools[$p]['code'] = $row['school_code'];
			$schools[$p]['name'] = $row['name'];
			$schools[$p]['address'] = $row['address'];
			$p++;
		}	
}

// create query
$query = "SELECT * FROM subjects WHERE subject_type = 'OptionalI'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
	$p = 0;
	while ($p < mysql_num_rows($result)){
		$row = mysql_fetch_assoc($result);
		$optionalI[$p]['code'] = $row['subject_code'];
		$optionalI[$p]['name'] = $row['name'];
		$p++;
	}	
}


// create query
$query = "SELECT * FROM subjects WHERE subject_type = 'OptionalII'";
// execute querys
$result = mysql_query($query) or die ("Error in query: $query.
" . mysql_error());
// see if any rows were returned
if (mysql_num_rows($result) >= 1) {
	$p = 0;
	while ($p < mysql_num_rows($result)){
		$row = mysql_fetch_assoc($result);
		$optionalII[$p]['code'] = $row['subject_code'];
		$optionalII[$p]['name'] = $row['name'];
		$p++;
	}	
}

foreach ($schools as $school){
	foreach ($optionalI as $optI){
		$schoolCode = $school['code'];
		$subjectCode = $optI['code'];
		// create query
		$query = "SELECT * FROM marks WHERE school_code = '$schoolCode' AND opti_choice = '$subjectCode'";
		// execute querys
		$result = mysql_query($query) or die ("Error in query: $query.
		" . mysql_error());
		// see if any rows were returned
		$numbers[$schoolCode][$subjectCode] = mysql_num_rows($result);
	}
	foreach ($optionalII as $optII){
		$schoolCode = $school['code'];
		$subjectCode = $optII['code'];
		// create query
		$query = "SELECT * FROM marks WHERE school_code = '$schoolCode' AND optii_choice = '$subjectCode'";
		// execute querys
		$result = mysql_query($query) or die ("Error in query: $query.
		" . mysql_error());
		// see if any rows were returned
		$numbers[$schoolCode][$subjectCode] = mysql_num_rows($result);
	}	
}

?>

<table cellspacing="0" cellpadding="5" border="1">
	<tr bgcolor="#828282">
		<td rowspan="2" width="25">S.No.</td>
		<td rowspan="2" width="100">Code</td>
		<td rowspan="2" width="300">Name</td>
		<td style="text-align: center;" colspan="<?php echo count($optionalI); ?>">Optional I</td>
		<td style="text-align: center;" colspan="<?php echo count($optionalII); ?>">Optional II</td>
		<td rowspan="2">Total</td>
	</tr>
	<tr bgcolor="#828282">
		<?php
			foreach($optionalI as $optI){
		?>
			<td><?php echo $optI['name']; $subjectTotal[$optI['code']] = 0;?></td>
		<?php
			}
		?>
		<?php
			foreach($optionalII as $optII){
		?>
			<td><?php echo $optII['name']; $subjectTotal[$optII['code']] = 0; ?></td>
		<?php
			}
		?>			
	</tr>
	
	<?php
		$i = 1;
		foreach ($schools as $school) {
			$numberOfStudentsInSchool = 0;
	?>
			<tr>
				<td<?php echo ($i % 2 != 1) ? " bgcolor='#B1B1B1'" : "" ?>><?php echo $i; ?>
				<td<?php echo ($i % 2 != 1) ? " bgcolor='#B1B1B1'" : "" ?>><?php echo $school['code']; ?></td>
				<td<?php echo ($i % 2 != 1) ? " bgcolor='#B1B1B1'" : "" ?>><?php echo $school['name']; ?></td>
				<?php
					foreach($optionalI as $optI){
				?>
					<td<?php echo ($i % 2 != 1) ? " bgcolor='#B1B1B1'" : "" ?>><?php $n = $numbers[$school['code']][$optI['code']]; echo ($n != 0) ? $n : ''; $numberOfStudentsInSchool += $n; $subjectTotal[$optI['code']] += $n; ?></td>
				<?php
					}
				?>
				<?php
					foreach($optionalII as $optII){
				?>
					<td<?php echo ($i % 2 != 1) ? " bgcolor='#B1B1B1'" : "" ?>><?php $n = $numbers[$school['code']][$optII['code']]; echo ($n != 0) ? $n : ''; $subjectTotal[$optII['code']] += $n; ?></td>
				<?php
					}
				?>
				<td<?php echo ($i % 2 != 1) ? " bgcolor='#B1B1B1'" : "" ?>><?php echo ($numberOfStudentsInSchool != 0) ? $numberOfStudentsInSchool : ''; ?></td>
			</tr>	
	<?php
			$i++;
		}
	?>
			<tr bgcolor="#828282">
				<td>&nbsp;</td>
				<td colspan="2" style="text-align: right;"><strong>Total: </strong></td>
				<?php
					$grandTotal = 0;
					foreach($optionalI as $optI){
				?>
					<td><strong><?php $n = $subjectTotal[$optI['code']]; echo ($n != 0) ? $n : ''; $grandTotal += $n; ?></strong></td>
				<?php
					}
				?>
				<?php
					foreach($optionalII as $optII){
				?>
					<td><strong><?php $n = $subjectTotal[$optII['code']]; echo ($n != 0) ? $n : ''; ?></strong></td>
				<?php
					}
				?>
				<td><strong><?php echo ($grandTotal != 0) ? $grandTotal : ''; ?></strong></td>
			</tr>
	
</table>
<?php


?>