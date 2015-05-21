<?php
require "connection.php";
$recString= $_GET['recString'];
$op=$_GET['op'];
if($op=="1") {
	$query= "SELECT question,op1,op2,op3,op4,ans FROM questions WHERE question LIKE '%{$recString}%'";
	if($query_run = mysql_query($query)){
		while($query_array=mysql_fetch_assoc($query_run)) {
			$que=$query_array['question'];
                        $op1=$query_array['op1'];
                        $op2=$query_array['op2'];
                        $op3=$query_array['op3'];
                        $op4=$query_array['op4'];
						$ans=$query_array['ans'];
                        echo "Que-".$que."<br />(a) ".$op1."<br />(b) ".$op2."<br />(c) ".$op3."<br />(d) ".$op4."<br /> Ans-".$ans."<hr />";
		}
	}
} else if ($op=="2") {
	$query= "SELECT name,username,enrollment,branch FROM users WHERE name LIKE '%{$recString}%' OR username LIKE '%{$recString}%' OR enrollment LIKE '%{$recString}%'";
	if($query_run = mysql_query($query)){
		while($query_array=mysql_fetch_assoc($query_run)) {
			$name=$query_array['name'];
			$enrollment=$query_array['enrollment'];
			$username=$query_array['username'];
			$branch=$query_array['branch'];
			echo "<a style=\"text-decoration:none;\" title=\"Click to View ".$name."'s Profile\" href=\"student.php?username=".$username."\">
					<div style=\"background-color:white; color:#000066; padding:5px; width:auto; border:1px lightgrey solid; box-shadow:1px 2px 80px lightgrey;\">
					<b>".$name."</b>
					<br /><span style=\"font-size:13px; color:grey;\">Enrollment No.-".$enrollment."</span>
					<br /><span style=\"font-size:13px; color:grey;\">Branch-".$branch."</span>
				  </div></a>";
		}
	}
}
?>