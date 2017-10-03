<?php
require_once("UserStore.php");



function validate(){
        if( !isset($_POST['username']) || !isset($_POST['password'])){
                return "All fields are required.";
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(strlen($username) > 25){
                return "Your username cannot be longer than 25 characters.";
        }

        if(strlen($password) > 100){
                return "Your password cannot be longer than 100 characters.";
        }

	return true;
}

//takes a user name and checks if it exists
function userInfo($username){
        try {

                //instantiate user store with path to json file on disk
                //if file doesnt exist, this call will create it for us
                $store = new UserStore("/data/users.json");

                //check to see if the user already exists
                //if so return false
		$acctInfo = $store->getUser($username);
                if( $acctInfo !== false){
                        return $acctInfo;
                }

        } catch (Exception $e) {
                //if we encountered any exceptions return false
                return false;
        }

        return false;
}

function sign_in(){

        $username = $_POST['username'];
        $password = $_POST['password'];
	$user = userInfo($username);

	if( $username == $user['username']){
		$salt = $user['salt'];
		$hash = hash("sha256",$_POST['password'].$salt);
		if( $hash == $user['password']){
			return true;
		}
	} else {
		return "username and password not verified";
	}	
}


$errorMessage = "false";


if(isset($_POST['comingBack'])){
	//make sure posts vars are valid
	$valid = validate();
	error_log($valid);
	if(is_bool($valid) && $valid){
		$result = sign_in();
		if(is_bool($result) && $result){
			session_start();
			$_SESSION['username'] = $_POST['username'];
			if(isset($_SESSION)){
				header("Location: /proj4/numverify/phoneNumber.php", true, 302);
			}
			return;
		} else {
			$errorMessage = "an error occured while logging into your account";
			header("Location: login.php", true, 302);
			return;
		}
	} else {	
		$errorMessage = "an error occured while logging into your account";
		header("Location: login_fail.php", true, 302);
		return;
	}
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
</head>

<h1>Login</h1>
<p id="instructions">Enter username and password</p>
<div id="error" class="errorMessage" style="visibility: hidden;"></div>
<section>
	<form id="form" method="post" action="login.php">
		<label>Username: <input type="text" name="username" id="username"></label><br>
		<label>Password: <input type="password" name="password" id="password"></label><br>
		<input type="hidden" name="comingBack" value="1">
		<button id="submit" type="submit" name="submit">Submit</button>
	</form>
    <div>
    <a href="register.php">IF NOT REGISTERED CLICK HERE</a>
        </div>
</section>
<script type="text/javascript" src="login.js"></script>
</html>
