function validateName() {
	var name = document.getElementById("txtName").value;
	if(name!=""){
		document.getElementById("txtName").style.backgroundColor="white"
		var r= new RegExp("^[a-z ]+$","i");
		if(!name.match(r)){
			document.getElementById("txtName").style.backgroundColor="red";
		}
		if(name.lenght>30) {
			alert("Your Name Exceeds the Limit of 30 Characters :(");
			document.getElementById("txtName").style.backgroundColor="red";	
		}
	}
}


function nameHint() {
	var a=document.getElementById("nameHint");
	a.style.padding=12+"px";
	a.style.borderRadius=8+"px";
	a.style.visibility="visible";
	a.innerHTML="Enter Your Full Name like, Hirdesh Vishwdewa";
}

function hideNameHint() {
	document.getElementById("nameHint").style.visibility="hidden";
}

function userNameHint() {
	var a=document.getElementById("userNameHint");
	a.style.padding=12+"px";
	a.style.borderRadius=8+"px";
	a.style.visibility="visible";
	a.innerHTML="Create a UserName or Simply Put your Enrollment no. Like- 0101IT101031";
}
function hideUserNameHint() {
	document.getElementById("userNameHint").style.visibility="hidden";
}
