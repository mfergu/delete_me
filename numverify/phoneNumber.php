<?php 

function validate(){
	if(!$_GET['phonenum']){
		return "missing phone number.";
	}
	$phonenum = $_GET['phonenum'];
	if(strlen($phonenum) > 25){
		return "Phone number entered too long.";
	}
	return true;
}

$errorMessage = "false";
session_start();
if($_SESSION['username']) {
	
	//if we have the post variable from the hidden input element
	// then we know that the form is being submitted and we should
	// deal with the submission
	// otherwise we wouldn't do anymore work and just render the html
		if($_GET['phonenum']!== ""){
			//make sure posts are valid
			$valid = validate();

			//if we didn't get a string, but got a boolean true
			if(is_bool($valid) && $valid){
				//pass phonenum to verify.php
				//axios call to verify.php
		//		$_SESSION['phonenum']=$_GET['phonenum'];
				header("Location: /proj4/numverify/verify.php?phonenum=".$_GET['phonenum'], true, 302);
				
			} else {
				// error with validate

			}
		} else {
			//error with isset($_POST['phonenum'])

		}
} else {
	//session not authenticated
	header("Location:/proj4/login/login.php", true, 302);
}
	
?>

<!DOCTYPE html>
	<title>Proj3 Secure Ed.</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript">var errorMessage = <?php /*php executes this blob of code */echo $errorMessage; ?></script>
<style type="text/css">
        .error{
                border: 1px solid;
                color: red;
        }
</style>
<h1>numverify api call (SECURE ED.)</h1>
<p id="instructions"> Instructions: enter a phone number </p>
<div id="error" class="errorMessage" style="visibility: hidden;"></div>
<section>
	<form id="form" method="get" action="phoneNumber.php">
		<label>Phone Number: <input type="number" pattern="[0-9]" name="phonenum" id="phonenum"></label><br>
<!--		<input type="hidden" name="comingBack" value="1"> -->
		<button id="butt" type="submit" name="butt">Submit</button>
		<div id="json" style="display:none;" name="json"><?php session_start();error_log($_SESSION['json']); if($_SESSION['json']){ echo $_SESSION['json'];} ?></div>
	</form>
</section>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="phoneNumber.js"></script>

