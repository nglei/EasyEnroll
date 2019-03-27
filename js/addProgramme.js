var progName = document.getElementById("programmeName");
var description = document.getElementById("description");
var closingDate = document.getElementById("closingDate");
var duration = document.getElementById("duration");
var fee = document.getElementById("fee");

function validation(){

	validProgName();
	validDescription();
	validClosingDate();
	validDuration();
	validFee();

	if(validProgName()){
		if(validDescription()){
			if(validClosingDate()){
				if(validDuration()){
					if(validFee()){
								return true;
	}}}}}

	return false;




	function validProgName(){
	if(progName.value == ""){
		document.getElementById("errorProgramme").innerHTML="Please enter a Programme Name";
        progName.style.borderColor="red";
		return false;
	}
	else{
		return true;
	}}

	function validDescription(){

 if(description.value == ""){
		document.getElementById("errorDescription").innerHTML="Please enter a description";
        description.style.borderColor="red";
		return false;
	}
	else{
		return true;
	}}

	function validClosingDate(){
if(closingDate.value == ""){
		document.getElementById("errorDate").innerHTML="Please enter a closing date";
        closingDate.style.borderColor="red";
		return false;
	}
	else{
		return true;
	}}
	
	function validDuration(){
if(duration.value == ""){
		document.getElementById("errorDuration").innerHTML="Please enter a duration";
        duration.style.borderColor="red";
		return false;
	}
	else{
		return true;
	}}
	
	function validFee(){
if(fee.value == ""){
		document.getElementById("errorFee").innerHTML="Please enter total fee for the programme";
        fee.style.borderColor="red";
		return false;
	}
	else{
		return true;
	}}
}


progName.onkeyup = function(){
	if(prognName.value != ""){
		document.getElementById("errorProgramme").innerHTML="";
        progName.style.borderColor="white";
	}
	else if(progName.value == ""){
		document.getElementById("errorProgramme").innerHTML="Please enter a Programme Name";
        progName.style.borderColor="red";
	}
}

description.onkeyup = function(){
if(description.value != ""){
		document.getElementById("errorDescription").innerHTML="";
        description.style.borderColor="white";
	}
	else  if(description.value == ""){
			document.getElementById("errorDescription").innerHTML="Please enter a description";
	        description.style.borderColor="red";
	}
}

closingDate.onkeyup = function(){
 if(closingDate.value != ""){
		document.getElementById("errorDate").innerHTML="";
        closingDate.style.borderColor="white";
	}else if(closingDate.value == ""){
			document.getElementById("errorDate").innerHTML="Please enter a closing date";
	        closingDate.style.borderColor="red";

	}
}

duration.onkeyup = function(){
if(duration.value != ""){
		document.getElementById("errorDuration").innerHTML="";
        duration.style.borderColor="white";
	}
	else  if(duration.value == ""){
			document.getElementById("errorDuration").innerHTML="Please enter a duration";
	        duration.style.borderColor="red";
	}
}

fee.onkeyup = function(){
if(fee.value != ""){
		document.getElementById("errorFee").innerHTML="";
        fee.style.borderColor="white";
	}
	else  if(fee.value == ""){
			document.getElementById("errorFee").innerHTML="Please enter total fee for the programme";
	        fee.style.borderColor="red";
	}
}
