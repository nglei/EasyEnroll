var usernamefield= document.getElementById("uniadminusername");

function uniAdminValidation(){
    validUsername();

function validUsername(){
if (usernamefield.value == ""){
    document.getElementById("errorUsername").innerHTML="Please enter valid username";
    usernamefield.style.borderColor="rgb(255,0,0)";
                                        }
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