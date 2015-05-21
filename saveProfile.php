<?php
if (session_start() && !(isset ($_SESSION['pass']) && isset ($_SESSION['username']))) {
		header("Location: login.php");
}
		$username=$_POST["username"];
		$name=$_POST['txtName'];
		$semester=$_POST['txtSem'];
		$email=$_POST['txtEmail'];
		$branch=$_POST['txtBranch'];
		$mobno=$_POST['txtMobNo'];
		require "connection.php";
		$sql="UPDATE users SET name='$name',semester='$semester',email='$email',branch='$branch',mobno='$mobno' WHERE username='$username'";
		mysql_query($sql) or die(mysql_error());
		header("Location: student.php?username=$username");
		mysql_close($dbc);
?>