<?php
// --------------------------------------------------------INCLUDE BEGINS---------------------------------------------------- 
function samlagna ($basket) {
switch ($basket) {
    case 'home':
        include ('home.php');
        break;
		case 'check':
        include ('check.php');
        break;
    default:
        include ('home.php');
        break;
}
}
// --------------------------------------------------------INCULDE ENDS---------------------------------------------------- 
?>
<?php
// --------------------------------------------------------TITLE BEGINS---------------------------------------------------- 
function title() {
if (isset($_GET['bas'])) {
$basket = $_GET['bas'];
switch ($basket) {
    case 'home':
        return "welcome :: parikchya";
        break;
		case 'check':
        return "check results :: parikchya";
        break;
    default:
        return "welcome :: parikchya";
        break;
}
}
else {
return "welcome :: parikchya";
}
}
// --------------------------------------------------------TITLE ENDS---------------------------------------------------- 
?>
<html>
<head>
<title><?php 
echo (title());
?>
</title>

</head>
<body background="imgs/bckg.png">
<center>
<?php include ("top.php");?>
<br />
<?php 
if (isset($_GET['bas'])) {
$basket = $_GET['bas'];
samlagna($basket);	
}
else {
include ('home.php');
} 
?>
<br />
<?php 
include ('footer.php');
?>

</body>
</html>

