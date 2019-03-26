var progName = document.getElementById("programmeName");
var description = document.getElementById("description");
var closingDate = document.getElementById("closingDate");

function validation(){

	validProgName();
	validDescription();
	validClosingDate();

	if(validProgName()){
		if(validDescription()){
			if(validClosingDate()){
								return true;
	}}}

	return false;



	//validate qualification Name
	function validProgName(){
	if(progName.value == ""){
		document.getElementById("errorProgramme").innerHTML="Please enter a Programme Name";
        progName.style.borderColor="red";
		progName.focus();
		return false;
	}
	else{
		return true;
	}}
	//validate minimum score
	function validDescription(){

 if(description.value == ""){
		document.getElementById("errorDescription").innerHTML="Please enter a description";
        description.style.borderColor="red";
		description.focus();
		return false;
	}
	else{
		return true;
	}}
	//validate maximum score
	function validClosingDate(){
if(closingDate.value == ""){
		document.getElementById("errorDate").innerHTML="Please enter maximum score";
        closingDate.style.borderColor="red";
		closingDate.focus();
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
			document.getElementById("errorDate").innerHTML="Please enter maximum score";
	        closingDate.style.borderColor="red";

	}


}
