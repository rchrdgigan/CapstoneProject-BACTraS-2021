//selection
function d1select(){
    var d1=document.getElementById("selectbrgy");
    var display = d1.options[d1.selectedIndex].text;
    document.getElementById("brgy").value = display;                                     
}
//show pass
function showPass(){
    var pass = document.getElementById("pass");
    if(pass.type == "password"){
        pass.type = "text";
    }else {
        pass.type = "password"
    }
}
//keyvalidation number only
function isInputNumber(evt){
    var ch = String.fromCharCode(evt.which);
    if(!(/[0-9]/.test(ch))){
        evt.preventDefault(); 
    }
    
}
//validate leght of number
function valnumblenght(){
    var text = document.getElementById("contact1").value;
    var regex = /^[0-9]\d{10}$/;
    if (regex.test(text)) 
    {   
    }else {
        document.getElementById("contact1").value = ""; 
        document.getElementById("lbltxt").innerHTML = "Invalid";
        document.getElementById("lbltxt").style.visibility = "visible";
        document.getElementById("lbltxt").style.color = "red";   
    }
}