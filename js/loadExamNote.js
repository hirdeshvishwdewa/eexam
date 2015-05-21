function loadExamNote(c) {
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
      var ajaxDisplay = document.getElementById('examNote');
	  ajaxDisplay.innerHTML = ajaxRequest.responseText;
   }
 }
	queryString="?op="+c;
	ajaxRequest.open("GET", "loadExamNote.php"+queryString, true);
	ajaxRequest.send(null);
}
