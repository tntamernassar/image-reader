<?php
include "connection.php";


if(isset($_POST['postimagecode'])){
	$imagecode = $_POST['postimagecode'];
$width = $_POST['width'];
$height = $_POST['height'];

$query = mysql_query("INSERT INTO images VALUES('','$imagecode','$width','$height')");

echo $imagecode;
}
else{
	
	echo "No Post request found :)";
	
}
?>
