<?php
	$host= "localhost";
	$username1 = "root";
	$password1 = "hirdesh";

	$dbc = mysql_connect("$host", "$username1", "$password1");
	if (!$dbc)
	{
		die ("Connection Not Possible ".mysql_error());
	}
	// Select Database
	$db_selected = mysql_select_db("eexam.co.in", $dbc);
	if (!$db_selected)
	{
			die ("Can Not Connect to Database".mysql_error());
	}
?>
