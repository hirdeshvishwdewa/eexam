function submitTest() {
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
		alert("Time Out!");
		window.location.href = "index.php"
   }
 }
	ajaxRequest.open("GET", "action.php?op=9", true);
	ajaxRequest.send(null);
}












/*var secs=<?php echo $secs;?>;
		var mins=<?php echo $mins; ?>;
		var hours=<?php echo $hours; ?>;
		var myVar = setInterval(function(){ myTimer() },1000);

		function myTimer()
		{
			////////////////////////////////////////////////////////////////////////
			if(hours==0 && mins<=5){
				document.getElementById("clock").style.color="red";
			}
			////////////////////////////////////////////////////////////////////////
			if(hours>0 && mins>0 && secs>0) //e.g., 11:56:39
			{
				document.getElementById("clock").innerHTML=hours+":"+mins+":"+secs; secs--;
			}
			else if(hours>0 && mins>0 && secs==0) //e.g., 11:56:00
			{
				document.getElementById("clock").innerHTML=hours+":"+mins+":"+"00"; secs=59;	mins--;
			}
			else if(hours>0 && mins==0 && secs>0) //e.g., 11:00:39
			{
				document.getElementById("clock").innerHTML=hours+":"+mins+":"+secs; secs--;
			}
			else if(hours>0 && mins==0 && secs==0) //e.g., 11:00:00
			{
				document.getElementById("clock").innerHTML=hours+":00:00"; secs=59; mins=59; hours--;
			}
			else if(hours==0 && mins>0 && secs>0) //e.g., 00:56:39
			{
				document.getElementById("clock").innerHTML="00:"+mins+":"+secs; secs--;
			}
			else if(hours==0 && mins>0 && secs==0) //e.g., 00:56:00
			{
				document.getElementById("clock").innerHTML="00:"+mins+":00"; mins--;	secs=59;
			}
			else if(hours==0 && mins==0 && secs>0) //e.g., 00:00:39
			{
				document.getElementById("clock").innerHTML="00:00:"+secs;	secs--;
			}
			else if(hours==0 && mins==0 && secs==0) //e.g., 00:00:00
			{
				document.getElementById("clock").innerHTML="Time Out!";
				clearInterval(myVar);
			}
		}
		*/