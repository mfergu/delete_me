<?php
//recvs phone num from phoneNumber.php in $_GET
//stores hard coded access key 
//makes request to API

$errorMessage = false;
session_start();
if($_SESSION['username']) {
	//use file_get_contents to do a get request to numverify API
	// using the number provided in $_GET and a hard coded access key
	//error_log($_GET['phonenum']);
	$numv_key = "b1d5f828832403389f1e161a42f63498";
	$numv_get_string = 'http://apilayer.net/api/validate?access_key='.$numv_key.'&number='.$_GET['phonenum'];
	//error_log($numv_get_string);
	$json = file_get_contents($numv_get_string) or die("failed");	
	//error_log($json);
	$_SESSION['json'] = $json;
	header("Location:/proj4/numverify/phoneNumber.php", true, 302);
} else {
        header("Location:/proj4/login/login.php", true, 302);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div style = "display:none;"><?php echo $json; ?></div>
</body>
</html>
