<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Timer</title>
		<style type="text/css" href="../styles/style.css"></style>
	<script type="text/javascript">
		var maxTime=document.getElementById("maxTime");
		maxTime=maxTime.value;
		maxTime=new Number(maxTime);
		
	function change() {
	maxTime=maxTime-1;	
	document.getElementById("time").innerHTML=maxTime;
	//setTimer("change()",1000);
}

		</script>
	</head>
	<body>
		<?php echo "<input type=\"hidden\" id=\"maxTime\" value=\"".$_SESSION["examTimeLimit"]."\"/>";?>
		<div style="background-color:yellow; color:bloak; font-weight:bold;">
			<?php echo "<h1 id=\"time\">".$_SESSION["examTimeLimit"]."</h1>";?>
		</div>
	<script type="text/javascript">
		//alert(maxTime);
		setInterval("change()",1000);
	</script>
		<a href="" class="submitButton" onclick="doComplete(<?php echo $_SESSION['examId']; ?>)">STOP</a>
	</body>
</html>