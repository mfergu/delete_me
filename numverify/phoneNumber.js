//needs to get phone number from user and send to verify.php through a $_GET message
//similar to register.js
var body = document.querySelector("body");
var input_num;


var numv_get_string;
var numv_return;


var gmaps_key = "AIzaSyCI5Bi09F2NwleFuBVgdec-F3L8-6OODP0";
var gmaps_get_string;
var gmaps_return;

function start(){
    //create user input

    window.addEventListener("keyup", function(e) {
        var key = e.which || e.code;
        if(key == 13){
            document.getElementById("form").submit();
		
        }
    })
	submitNumverify();
}

function createGmap(){
    var gmap = document.querySelector("iframe");
    if(gmap == null){
        gmap = document.createElement("iframe");
    }
    gmap.width="600";
    gmap.height="450";
    gmap.frameborder="0";
    gmap.stype="border:0";
    gmap.src = gmaps_get_string;
    gmap.innerHTML += " allowfullscreen";
    console.log(gmap);
    body.appendChild(gmap);
}

function prepareGmaps(){
    gmaps_get_string = "https://www.google.com/maps/embed/v1/place?key=" + gmaps_key
                + "&q=" + numv_return.country_name;
            gmaps_get_string = gmaps_get_string.replace(/ /g,"+");
            console.log(gmaps_get_string);
            createGmap();
}

function printEmptyStrings(ret){
    if(document.querySelector("ul")){
        var temp = document.querySelector("ul");
        temp.parentNode.removeChild(temp);
    }
    var leest = document.createElement("ul");
    var leest_item = document.createElement("li");
    if(ret.carrier === ""){
        leest_item.innerText = " missing carrier ";
        leest.appendChild(leest_item);
    }
    if(ret.country_code ===""){
        leest_item.innerText = " missing country_code ";
    }
    if(ret.country_name ===""){
        leest_item.innerText = " missing country_name ";
        leest.appendChild(leest_item);
    }
    if(ret.country_prefix ===""){
        leest_item.innerText = " missing country_prefix ";
        leest.appendChild(leest_item);
    }
    if(ret.local_format ===""){
        leest_item.innerText = " missing local_format ";
        leest.appendChild(leest_item);
    }
    if(ret.international_format ===""){
        leest_item.innerText = " missing international_format ";
        leest.appendChild(leest_item);
    }
    if(ret.line_type ===""){
        leest_item.innerText = " missing line_type ";
        leest.appendChild(leest_item);
    }
    if(ret.location ===""){
        leest_item.innerText = " missing location ";
        leest.appendChild(leest_item);
    }
    if(ret.number ===""){
        leest_item.innerText = " missing number ";
        leest.appendChild(leest_item);
    }
    body.appendChild(leest);
}

function submitNumverify(){

            //update status
		var divs = document.querySelectorAll("div");
		if(divs[1]){
		var numv_return = divs[1].innerText;
		console.log(numv_return);
            //    printEmptyStrings(numv_return);
             //   prepareGmaps();
		}
		if(true){

            } else {
                if(document.querySelector("iframe")){
                    var frame = document.querySelector("iframe");
                    frame.parentNode.removeChild(frame);
                }
                document.querySelector("h2").innerText = "result is invalid";  
            }   
}

window.addEventListener("load", function(){start()}, false);




