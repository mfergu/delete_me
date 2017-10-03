//login.js

//shows or hides error box using CSS Styles
//sets message inside the box
var showError = (msg) =>{
	var errorNode = document.getElementById("error");
	if(msg == "" || msg == false){
		//hide error
		errorNode.style = "visibility: hidden;";
		return;
	}
	errorNode.innerText = msg;
	errorNode.style = "visibility: visible;";
};

//validates data before wasting ths user's and server's time
//this is NOT security, this is convience 
//we will have to do the same checks on the server
var validate = () =>{
    
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;


	if(username === "" || password === ""){
		showError("All fields are required.");
		return false;
	}
    
	return true;
};


var onSubmit = () =>{
	if(!validate()){
		return false;
	}

	var buttonNode = document.getElementById("submit");
	buttonNode.innerText = "Submitting, please wait...";

	return true;
};

var onLoad = () => {
	var formNode = document.getElementById("form");
	formNode.onsubmit = onSubmit;

	if (errorMessage){
		showError(errorMessage);
	}
};
window.addEventListener("load",onLoad,false);
