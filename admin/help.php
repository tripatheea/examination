<?php
if (!isset($anappleinabasket)){
require("func_library.php");
}
user_logged_on();
?>


<style language="text/css">
.question {
    font-family: Arial;
	font-size:1.000em;
	font-weight:bold;
	background-color:#E5E5E5;
	color:#050071;
	border-bottom:1px solid #79A2FF;
	
	 }
.answer {
    font-family: Arial;
	font-size:0.900em;
	 }
</style>



<table width="940" border="0" cellspacing="0" cellpadding="0" style="border-spacing:10px;">
  <tr class="question">
    <td width="940">How do I add a user?</td>
  </tr>
  <tr class="answer">
    <td>Go to Users&gt;&gt;Add Users. Enter the required details. Note that all fields accept only alphanumeric characters.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I remove a user?</td>
  </tr>
  <tr class="answer">
    <td>Go to Users&gt;&gt;Remove Users. Select the user to remove and click on Remove.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I edit a user?</td>
  </tr>
  <tr class="answer">
    <td>Go to Users&gt;&gt;Edit Users. Enter the username to edit. If you're not sure, go to &quot;Remove Users&quot; where it will show all details of all the users.</td>
  </tr>
   <tr class="question">
    <td width="940">How do I add a school?</td>
  </tr>
  <tr class="answer">
    <td>Go to Schools&gt;&gt;Add School. Enter how many schools you would like to register. Enter the required details. Note that all fields accept only alphanumeric characters.</td>
  </tr> 
    <tr class="question">
    <td width="940">How do I edit a school?</td>
  </tr>
  <tr class="answer">
    <td>Go to School&gt;&gt;Edit School. Enter the school's code you wish to edit. If you're not sure, go to &quot;Remove Schools&quot; where it will show all details of all the schools. Note that if you change the school code, you will have to delete all existing students of that school and create them once again because their symbol numbers are generated on the basis of the school code. If you change the school code but do not delete and re-enter all the students details, the software might not give accurate results about a student and may not even show up under any school.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I remove a school?</td>
  </tr>
  <tr class="answer">
    <td>Go to Schools&gt;&gt;Remove schools. Select the school to remove and click on Remove.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I add a student?</td>
  </tr>
  <tr class="answer">
    <td>Go to Students&gt;&gt;Add Students. Enter the school code. Enter how many students you wish to register. Fill in the details and click on Save.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I edit a student?</td>
  </tr>
  <tr class="answer">
    <td>Go to Students&gt;&gt;Edit Student. Enter the school code. Change the require data and click on Save. Note that you need to enter Optional I and Optional II once again.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I remove a student?</td>
  </tr>
  <tr class="answer">
    <td>Go to Students&gt;&gt;Remove Students. Select the student to remove and click on Remove.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I add marks?</td>
  </tr>
  <tr class="answer">
    <td>Go to Marks&gt;&gt;Add Marks. Enter the school code. Select the subject. Enter the marks and click on Save.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I edit marks?</td>
  </tr>
  <tr class="answer">
    <td>Go to Marks&gt;&gt;Edit Marks. Enter the school code. Select the subject. Modify the marks and hit Save.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I produce admission cards?</td>
  </tr>
  <tr class="answer">
    <td>Go to Admission Cards.</td>
  </tr>
    <tr class="question">
    <td width="940">What is Compile Result?</td>
  </tr>
  <tr class="answer">
    <td>Compiling refers to the calculation of total, percentage, division, etc. You need to compile result before producing ledgers, report cards, or anything related to the marks. Basically, it's a good idea to compile result after all marks has been enterred(including practicals) and before doing anything else.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I produce report cards?</td>
  </tr>
  <tr class="answer">
    <td>Go to Report Cards.</td>
  </tr>
  
    <tr class="question">
    <td width="940">How do I print a ledger of just the Failed Students?</td>
  </tr>
  <tr class="answer">
    <td>Go to Tools&gt;&gt;Fail Ledger.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I provide grace marks to the Failed Students?</td>
  </tr>
  <tr class="answer">
    <td>Go to Tools&gt;&gt;Corrections.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I print the results?</td>
  </tr>
  <tr class="answer">
    <td>Go to Tools&gt;&gt;Result.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I print ledgers?</td>
  </tr>
  <tr class="answer">
    <td>Go to Tools&gt;Ledger.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I wittheld results?</td>
  </tr>
  <tr class="answer">
    <td>Go to Tools&gt;&gt;Withheld.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I lock users?</td>
  </tr>
  <tr class="answer">
    <td>Go to Tools&gt;&gt;Lock Users.</td>
  </tr>
    <tr class="question">
    <td width="940">How do I see the statistics related to this year's examination?</td>
  </tr>
  <tr class="answer">
    <td>Go to Tools&gt;&gt;Statistics.</td>
  </tr>
     <tr class="question">
    <td width="940">How do I change my password?</td>
  </tr>
  <tr class="answer">
    <td>Go to Change Password. Note that the password should be 10-20 characters long and can include just alphanumeric characters.</td>
  </tr>
     <tr class="question">
    <td width="940">How do I view my ledger(for schools only)?</td>
  </tr>
  <tr class="answer">
    <td>Go to My Ledger.</td>
  </tr>
     <tr class="question">
    <td width="940">How do I change the year?</td>
  </tr>
  <tr class="answer">
    <td>Go to Settings.</td>
  </tr>
      <tr class="question">
    <td width="940">How do I change the Board Name? (eg, ABC Examination Board)</td>
  </tr>
  <tr class="answer">
    <td>Go to Settings.</td>
  </tr>
       <tr class="question">
    <td width="940">How do I change the Exam Name? (eg, Send Up Examination)</td>
  </tr>
  <tr class="answer">
    <td>Go to Settings.</td>
  </tr>
       <tr class="question">
    <td width="940">How do I change the result status?</td>
  </tr>
  <tr class="answer">
    <td>Go to Settings. Note that people can see the results only when the status is set to Result Out.</td>
  </tr>
       <tr class="question">
    <td width="940">How do I delete all data?</td>
  </tr>
  <tr class="answer">
    <td>Go to Settings. Note that administrator's accounts and settings are not deleted. To delete administrator, do it manually.</td>
  </tr> 
</table>
