function initAjax(){
// Now get the value from user and pass it to server script.
 var width = 0, height = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    width = window.innerWidth;
    height = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    width = document.documentElement.clientWidth;
    height = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    width = document.body.clientWidth;
    height = document.body.clientHeight;
	}
	  var topHeader = document.getElementById("topHeader");
	  topHeader.style.height=height/5+"px";
	  var middle = document.getElementById("middle");
	  middle.style.height=height/1.35+"px";
	  middle.style.top=height/5+"px";
	  var footer = document.getElementById("footer");
	  footer.style.top=height/5+height/1.35+"px";
	  footer.style.height=height/15+"px";
	  var logoImg = document.getElementById("logoImg");
	  logoImg.style.height=height/5.1+"px";
	  logoImg.style.width=width/5+"px";
}