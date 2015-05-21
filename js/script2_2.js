function insertQue() {
	var que = document.getElementById('txtSearch').value;
	var op1= document.getElementById('txtOp1').value;
	var op2= document.getElementById('txtOp2').value;
	var op3= document.getElementById('txtOp3').value;
	var op4= document.getElementById('txtOp4').value;
	var ans= document.getElementById('txtAns').value;
	var category= document.getElementById('category').value;
	if (!((que=="")||(op1=="")||(op2=="")||(op3=="")||(op4=="")||(ans=="")||(category==""))) {
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
			  var ajaxDisplay = document.getElementById('succsessDiv');
			  ajaxDisplay.innerHTML = ajaxRequest.responseText;
			  resetQue();
		   }
		 }
			var queryString ="?op=10&question="+que+"&op1="+op1+"&op2="+op2+"&op3="+op3+"&op4="+op4+"&ans="+ans+"&category="+category;
			ajaxRequest.open("GET", "action.php"+queryString, true);
			ajaxRequest.send(null);
		} else {
			alert("Please Enter all the fields Correctly !");
	}
}	
	function resetQue() {
	document.getElementById('txtSearch').value="";
	document.getElementById('txtOp1').value="";
	document.getElementById('txtOp2').value="";
	document.getElementById('txtOp3').value="";
	document.getElementById('txtOp4').value="";
	document.getElementById('txtAns').value="";
}