<?php

		require("admin/func_library.php");
		require("connection.php");
		// create query
		$query = "SELECT * FROM settings WHERE field = 'result_status'";
		// execute querys
		$result = mysql_query($query) or die ("Error in query: $query.
		" . mysql_error());
		// see if any rows were returned
		
		$row = mysql_fetch_assoc($result);
		if($row['value'] == 2){

?>



<basefont face="Ärial" size="2">
<table width="775" border="0" background="imgs/bckg_in.png">
	<tr>

	  <td width="665"><strong>Basic Result: </strong></td>
	</tr>
	<tr>
	  <td>Please enter your symbol number below! </td>
  </tr>
	<tr>
	  <td><form name="basic_search" method="post" action="search.php">
	    <input type="hidden" name="type" value="basic" />
	    <input name="symbolno" type="text" id="symbolno" size="9" maxlength="9" />
	    &nbsp;
                  <input type="submit" name="Submit" value="Search" />
	  </form>	  </td>
  </tr>
	<tr>
	  <td height="17" align="center"><img src="imgs/spacer.gif" width="760" height="2" /></td>
  </tr>
	<tr>
	  <td><strong>Marks Sheet : </strong></td>
  </tr>
	<tr>
	  <td>      <form id="marksheet" name="marksheet" method="post" action="search.php">
	  <input type="hidden" name="type" value="marksheet" />
      Please enter your symbol number and birth date below!<br />

       Symbol No.: 
       <input type="hidden" name="type" value="marksheet" />
    <input name="symbolno" type="text" size="9" maxlength="9" />
           
           &nbsp;Birthdate: 
           <input name="year" type="text" id="year" value="YYYY" size="4" maxlength="4" />
     <input name="month" type="text" id="month" value="MM" size="2" maxlength="2" />
           <input name="day" type="text" id="day" value="DD" size="2" maxlength="2" />
           <input type="submit" name="search" id="search" value="Search" />
      </form>	  </td>
  </tr>
  	<tr>
	  <td height="18" align="center"><img src="imgs/spacer.gif" width="760" height="2" /></td>
  </tr>
	<tr>
	  <td><strong>School Ledger : </strong></td>
  </tr>
	<tr>
	  <td>Please login to view the school ledger!</td>
  </tr>

</table>
</basefont>

<?php
	}
	else{
		die("Not yet time!");
	}