var usernamefield= document.getElementById("uniadminusername");
var unifield = document.getElementById("uniName");
var pwfield = document.getElementById("uniadminpw");
var fullNamefield = document.getElementById("uniadminfullname");
var emailfield = document.getElementById("uniadminemail");

function uniAdminValidation(){
    if (validUsername()){
        if(validUniversityName()){
            if (validPassword()){
                if (validEmail()){
                    if(validFullName()){
                        return true;
                    }
                }
            }
        }
    }
    return false;
}


function validUsername(){
    if (usernamefield.value == "" || usernamefield.value == " "){
        document.getElementById("errorUsername").innerHTML="Please enter valid username";
        usernamefield.style.borderColor="rgb(255,0,0)";
    }
    else if(usernamefield.value.includes(" ")){
        document.getElementById("errorUsername").innerHTML = "Username must not include spaces";}
        else {
            return true;
        }
    }

    function validUniversityName(){
        if(unifield.value == "" || unifield.value ==" "){
            document.getElementById("invalidUniName").innerHTML = "University Name is blamk";
        }else{
            return true;
        }
    }
    function validPassword(){
        if(pwfield.value == ""){
            document.getElementById("invalidPW").innerHTML = "Password is required";
        }else{
            return true;
        }
    }
    function validEmail(){
        if(emailfield.value == "" ){
            document.getElementById("invalidEmail").innerHTML == "Invalid email format";
        }else{
            return true;
        }
    }
    function validFullName(){
        if(fullNamefield.value == "" || fullNamefield.value == " "){
            document.getElementById("invalidFullName").innerHTML == "Your name is not in full";
        }
        else{
            return true;
        }
    }
usernamefield.onkeyup = function(){
        if(usernamefield.value == ""){
            document.getElementById("errorUsername").innerHTML="Please enter valid username";
            usernamefield.style.borderColor="red";
        }
        else if(!(usernamefield.value.includes("@")) ){
            usernamefield.style.borderColor="cyan";
            document.getElementById("errorUsername").innerHTML="Username has not indicate \"@\" university name";
    
        }
        else if(usernamefield.value.includes("@")){
            document.getElementById("errorUsername").innerHTML="";
            usernamefield.style.borderColor="rgb(55,77,174)";
        }
    }
    var pwfield = document.getElementById("uniadminpw");
    pwfield.onkeyup = function(){
        if (pwfield.value == ""){
            document.getElementById("invalidPW").innerHTML="Please specify a password";
            pwfield.style.borderColor="rgb(187,3,5)";
        }
        else if (pwfield.value.length < 5){
            document.getElementById("invalidPW").innerHTML="password is not long enough";
            pwfield.style.borderColor="rgb(174,14,3)";
        }
        else if(pwfield.value.length >=5){
            document.getElementById("invalidPW").innerHTML="";
        }
    }