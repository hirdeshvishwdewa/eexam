function loadListStudent(c) {
	//alert(c);
	if(c!="") {
		//alert(c);
		var ajaxRequest;
		 
		 try{  
		   ajaxRequest = new XMLHttpRequest();
		 }catch (e){
		   try{
			  ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		   }catch (e) {
			  try{
				 ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			  }catch (e){
				 alert("Please, Update Your Browser !");
				 return false;
			  }
		   }
		 }
		 ajaxRequest.onreadystatechange = function(){
		   if(ajaxRequest.readyState ==4 && ajaxRequest.status==200){
			  var ajaxDisplay = document.getElementById('resultDisplay');
			  ajaxDisplay.innerHTML = ajaxRequest.responseText;
		   }
		 }
			//var queryString=""
			ajaxRequest.open("GET", "resultListFetch.php?semester="+c, true);
			ajaxRequest.send(null);
	}
}

function loadListQuestion(c) {
	//alert(c);
	if(c!="") {
		//alert(c);
		var ajaxRequest;
		 
		 try{  
		   ajaxRequest = new XMLHttpRequest();
		 }catch (e){
		   try{
			  ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		   }catch (e) {
			  try{
				 ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			  }catch (e){
				 alert("Please, Update Your Browser !");
				 return false;
			  }
		   }
		 }
		 ajaxRequest.onreadystatechange = function(){
		   if(ajaxRequest.readyState ==4 && ajaxRequest.status==200){
			  var ajaxDisplay = document.getElementById('resultDisplay');
			  ajaxDisplay.innerHTML = ajaxRequest.responseText;
		   }
		 }
			//var queryString=""
			ajaxRequest.open("GET", "resultListFetch.php?category="+c, true);
			ajaxRequest.send(null);
	}
}

function deleteQue(qid) {
	if(confirm("Really Want to delet this Question (qid="+qid+") ?")) {
		var ajaxRequest;
			 try{  
			   ajaxRequest = new XMLHttpRequest();
			 }catch (e){
			   try{
				  ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
			   }catch (e) {
				  try{
					 ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
				  }catch (e){
					 alert("Please, Update Your Browser !");
					 return false;
				  }
			   }
			 }
			 ajaxRequest.onreadystatechange = function(){
			   if(ajaxRequest.readyState ==4 && ajaxRequest.status==200){
				var ajaxDisplay = document.getElementById(qid);
				ajaxDisplay.style.opacity=.40;
				ajaxDisplay.style.color="red";
			   }
			 }
				//var queryString=""
				ajaxRequest.open("GET", "resultListFetch.php?qId="+qid, true);

				ajaxRequest.send(null);
	}
}

function deleteAllQues() {
	var a=document.getElementById("category");
	var delAll=a.value;
	//alert("ok");
	if(delAll!="none" && (confirm("Really Want to delet all questions of \""+delAll+"\" ?"))) {
//	if(delAll!="none" && verifyAdmin()) {
		//alert(verifyAdmin());
		var ajaxRequest;
		 try{  
		   ajaxRequest = new XMLHttpRequest();
		 }catch (e){
		   try{
			  ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		   }catch (e) {
			  try{
				 ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			  }catch (e){
				 alert("Please, Update Your Browser !");
				 return false;
			  }
		   }
		 }
		 ajaxRequest.onreadystatechange = function(){
		   if(ajaxRequest.readyState ==4 && ajaxRequest.status==200){
			  var ajaxDisplay = document.getElementById("allQueDisplay");
				ajaxDisplay.style.opacity=.40;
			  ajaxDisplay.style.color="red";
		   }
		 }
			//var queryString=""
			ajaxRequest.open("GET", "resultListFetch.php?deleteAllCat="+delAll, true);
			ajaxRequest.send(null);
	} else if(delAll=="none"){
		alert("Please Select a Category First !");
	}
}


function loadListExam(sem) {

	var ajaxRequest;
		 try{  
		   ajaxRequest = new XMLHttpRequest();
		 }catch (e){
		   try{
			  ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		   }catch (e) {
			  try{
				 ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			  }catch (e){
				 alert("Please, Update Your Browser !");
				 return false;
			  }
		   }
		 }
		 ajaxRequest.onreadystatechange = function(){
		   if(ajaxRequest.readyState ==4 && ajaxRequest.status==200){
			  var ajaxDisplay = document.getElementById("allExamDisplay");
			  ajaxDisplay.innerHTML=ajaxRequest.responseText;
		   }
		 }
			//var queryString=""
			ajaxRequest.open("GET", "resultListFetch.php?semExam="+sem, true);
			ajaxRequest.send(null);
}

function verifyAdmin() {
	var pwd=prompt("Provid Admin Login Password !");
	var ajaxRequest;
		 try{  
		   ajaxRequest = new XMLHttpRequest();
		 }catch (e){
		   try{
			  ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		   }catch (e) {
			  try{
				 ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			  }catch (e){
				 alert("Please, Update Your Browser !");
				 return false;
			  }
		   }
		 }
		 ajaxRequest.onreadystatechange = function(){
		   if(ajaxRequest.readyState ==4 && ajaxRequest.status==200){
			  
		   }
		 }
			//var queryString=""
			ajaxRequest.open("POST", "resultListFetch.php?password="+pwd, true);
			ajaxRequest.send(null);
}

function doComplete(id) {
//alert(id);
	var ajaxRequest;
		 try{  
		   ajaxRequest = new XMLHttpRequest();
		 }catch (e){
		   try{
			  ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		   }catch (e) {
			  try{
				 ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			  }catch (e){
				 alert("Please, Update Your Browser !");
				 return false;
			  }
		   }
		 }
		 ajaxRequest.onreadystatechange = function(){
		   if(ajaxRequest.readyState ==4 && ajaxRequest.status==200){
			  var ajaxDisplay = document.getElementById(id);
			  ajaxDisplay.innerHTML=ajaxRequest.responseText;
		   }
		 }
			//var queryString=""
			ajaxRequest.open("GET", "resultListFetch.php?id="+id, true);
			ajaxRequest.send(null);
}

function deleteAllExams() {
	
}