<?php

if (!isset($_COOKIE['basket_id'])){
die ("ERROR: Unauthorized access!");

}
else{


if (!isset($anappleinabasket)){
require("func_library.php");
}



echo "Are you sure you wan to delete all data?";
echo "<br />";
echo "Remember that <strong>THE DATA WON'T BE RECOVARABLE!</strong>";
echo "<br />";
echo "<br />";
echo "If you are really sure, please enter you password in all of the below textboxes!";
echo "<br />";
echo "<br />";
echo "<form name='delete' action='delete2.php' method='post'>";
echo "Password: <input type='password' name='pass1' maxlength='15' size='15' /><br />";
echo "Password Again: <input type='password' name='pass2' maxlength='15' size='15' /><br />";

echo "<input type='submit' name='delete' value='Delete All'>";

















}






?>