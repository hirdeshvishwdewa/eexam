<?php
if (session_start() && !(isset ($_SESSION['pass']) && isset ($_SESSION['username']))) {
		header("Location: login.php");
} else {
	require "connection.php";
	$username=$_GET["username"];
	$sql="SELECT username,name,result,semester,enrollment,email,branch,mobno FROM users WHERE username='$username'";
		$result=mysql_query($sql) or die(mysql_error());
		$found=mysql_fetch_assoc($result);
		$foundUserName=$found['username'];
		$result=$found['result'];
		$name=$found['name'];
		$semester=$found['semester'];
		$enroll=$found['enrollment'];
		$email=$found['email'];
		$branch=$found['branch'];
		$mobno=$found['mobno'];
	echo "<form method=\"POST\" action=\"saveProfile.php\">
			<input type=\"hidden\"  value=\"".$username."\" name=\"username\"/>
			<input type=\"submit\" style=\"height:40px; background-color:green; color:white; width:80px; text-shadow:1px 1px 1px white; box-shadow:5px 5px 30px grey; -moz-box-shadow:5px 5px 30px grey; border-radius:10px;\" value=\"Done\">
			<table cellspacing=\"5px\" cellpadding=\"5px\">
			<tr><td><b style=\"color:green;\">Name</b></td><td><input name=\"txtName\" type=\"text\" value=\"".$name."\" /></td></tr>
			<tr><td><b style=\"color:green;\">Branch</b></td><td><input type=\"text\" name=\"txtBranch\" value=\"".$branch."\"</td></tr>
			<tr><td><b style=\"color:green;\">Semester</b></td><td><input type=\"text\" name=\"txtSem\" value=\"".$semester."\"</td></tr>
			<tr><td><b style=\"color:green;\">Email Id</b></td><td><input type=\"text\" name=\"txtEmail\" value=\"".$email."\"</td></tr>
			<tr><td><b style=\"color:green;\">Mobile Number</b></td><td><input type=\"text\" name=\"txtMobNo\" value=\"".$mobno."\"</td></tr>
			</table>
			</form>";
}
mysql_close($dbc);
?>