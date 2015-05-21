function show_search_result() {
	var ssr = document.getElementById('search_result');
	ssr.style.visibility='visible';
	var getChar = document.getElementById('txtSearch');
	if ((getChar.value=="") || (getChar.value=="Type Here !")) {
		document.getElementById('search_result').innerHTML="Please Type a Question !";
	}	
	else {
			document.getElementById('search_result').style.overflow="scroll";
			document.getElementById('search_result').style.height=300+"px";
			initAjax(getChar.value);
		}
	}
	function hide_default_text() {
		document.getElementById("txtSearch").style.color='#000066';
		var hdt = document.getElementById("txtSearch");
		if (hdt.value=='Type Here !') hdt.value='';
		else return;
	}
	function flush_result1() {
		var fr = document.getElementById('search_result');
		fr.style.visibility='hidden';
		document.getElementById("studentDisplay").innerHTML='';
	}
function initAjax(c){
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
      var ajaxDisplay = document.getElementById('search_result');
	  if (ajaxRequest.responseText=="")	ajaxDisplay.innerHTML='No Result For This Query !';
	  else ajaxDisplay.innerHTML = ajaxRequest.responseText;
   }
 }
	var queryString ="?recString="+c+"&op=1";
	ajaxRequest.open("GET", "viaPHPFile.php"+queryString, true);
	ajaxRequest.send(null);
}

function findStudent(c) {
	if (c=="Type a Name !") {
		document.getElementById('txtStudent').value="";
	} else if (c=="") {
		document.getElementById('studentDisplay').innerHTML="Please Input a Name";
	} else {
	document.getElementById('studentDisplay').style.overflow="scroll";
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
      var ajaxDisplay = document.getElementById('studentDisplay');
	  if (ajaxRequest.responseText=="")	ajaxDisplay.innerHTML='Student Not Exist !';
	  else ajaxDisplay.innerHTML = ajaxRequest.responseText;
   }
 }
	var queryString ="?recString="+c+"&op=2";
	ajaxRequest.open("GET", "viaPHPFile.php"+queryString, true);
	ajaxRequest.send(null);
}
}
