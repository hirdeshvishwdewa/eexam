//student.js
function editProfile() {
var ajaxRequest;
var user=document.getElementById("username").value;
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
      var ajaxDisplay = document.getElementById('profile');
	  ajaxDisplay.innerHTML = ajaxRequest.responseText;
   }
 }
	ajaxRequest.open("GET", "editProfile.php?username="+user, true);
	ajaxRequest.send(null);
}
