<basefont face="Ärial" size="2">
<table width="775" border="0" background="imgs/bckg_in.png">
	<tr>

		<td width="665">
			<?php
			require ("connection.php");
			// create query
			$query = "SELECT * FROM settings WHERE field = 'result_status'";
			// execute querys
			$result = mysql_query($query) or die ("Error in query: $query.
			" . mysql_error());
			$row = mysql_fetch_assoc($result);
			$status = $row['value'];
			
			if ($status == "0"){
				echo "If you are a school representative, please <a href=\"http://example.com/admin\">click here</a> to enter your students' details.";
				echo "<br><br>If you're not sure about your school code, please <a href=\"http://example.com/admin/list.php\">click here</a>.<br><br><br>";
			}
			elseif ($status == "1"){
				echo "<font face='Arial' size='2'><strong>The result is being processed. Please check back soon.</strong></font><br /><br /><br /><br />";
			}
			elseif ($status == "2"){
			?>
			Please select an option from below!<br />
			<ul type="square">
				<li><a href="index.php?bas=check">Check Result</a></li>
				<li><a href="admin/index.php">Login</a></li>
			</ul>	
		<?php
		}
		?>
		
		</td>
	</tr>
</table>
</basefont>
