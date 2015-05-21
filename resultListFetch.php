<?php
if (isset($_GET["semester"])) {
	$semester=$_GET["semester"];
	require "connection.php";
	$sql="SELECT name,result FROM users WHERE semester='$semester'";
	$res=mysql_query($sql) or die(mysql_error());
	while ($result=mysql_fetch_assoc($res)) {
		$res1=$result["result"];
		if ($res1!="" || $res1!=NULL) {
		$arr=explode("=","$res1");
		$res1="";
		for($i=0; $i<sizeof($arr); $i++) {
			$res1.=$arr[$i]."=".$arr[++$i].", &nbsp;";
		}
		echo "<tr>
				<td>".$result["name"]."</td>
				<td>".$res1."</td>
			  </tr>";
		} else {
			echo "<tr>
				<td>".$result["name"]."</td>
				<td> Test Result Not Available !</td>
			  </tr>";
		}
	}
} else if (isset($_GET["category"])) {
	$cat=$_GET["category"];
	require "connection.php";
	if ($cat=="All") $sql="SELECT qid,question,op1,op2,op3,op4,ans FROM questions";
	else $sql="SELECT qid,question,op1,op2,op3,op4,ans FROM questions WHERE category='$cat'";
	$res=mysql_query($sql) or die(mysql_error());
	while ($result=mysql_fetch_assoc($res)) {
		echo "<tr id=\"".$result["qid"]."\">
				<td  width=\"5%\">".$result["qid"]."</td>
				<td  width=\"45%\">".$result["question"]."</td>
				<td  width=\"10%\">".$result["op1"]."</td>
				<td  width=\"10%\">".$result["op2"]."</td>
				<td  width=\"10%\">".$result["op3"]."</td>
				<td  width=\"10%\">".$result["op4"]."</td>
				<td  width=\"5%\">".$result["ans"]."</td>
				<td id=\"checkBox\" width=\"5%\">Delete this<input type=\"checkbox\" value=\"".$result["qid"]."\" onclick=\"deleteQue(this.value)\"/></td>
			 </tr>";
	}
} else if(isset($_GET["qId"])) {
	$qid=$_GET["qId"];
	require "connection.php";
	$sql="DELETE FROM questions WHERE qid='$qid'";
	mysql_query($sql) or die(mysql_error());

} else if (isset($_GET["deleteAllCat"])) {
	$all=$_GET["deleteAllCat"];
	require "connection.php";
	if($all=="All") $sql="DELETE * FROM questions";
	else $sql="DELETE * FROM questions WHERE category='$all'";
	mysql_query($sql) or die(mysql_error());

} else if (isset($_GET["semExam"])) {
	$sem=$_GET["semExam"];
	require "connection.php";
	if($sem==0)	$sql="SELECT examid, examname,semester, maxque, date, status FROM exams ORDER BY examid DESC";
	else	$sql="SELECT examid, examname,semester, maxque, date, status FROM exams WHERE semester='$sem' ORDER BY examid DESC";
	$res=mysql_query($sql) or die(mysql_error());
	while($result=mysql_fetch_assoc($res)) {
		$style="style=\"color:red; text-decoration:none;\"  onclick=\"doComplete(".$result["examid"].")\"";
		if ("Completed"==$result["status"])		{	$style="style=\"color:green; text-decoration:none;\"";}
		echo "<tr>
				<td  width=\"5%\">".$result["examid"]."</td>
				<td  width=\"25%\">".$result["examname"]."</td>
				<td  width=\"10%\">".$result["semester"]."</td>
				<td  width=\"10%\">".$result["maxque"]."</td>
				<td  width=\"15%\">".$result["date"]."</td>
				<td  width=\"15%\"><a href=\"#\" ".$style." id=\"".$result["examid"]."\"><b>".$result["status"]."...</b></td>
				<td  width=\"5%\"></td>
			 </tr>";
	}
} else if(isset($_GET["id"])) {

	require "connection.php";
	$id=$_GET["id"];
	$sql="UPDATE exams SET status='Completed' WHERE examid='$id'";
	mysql_query($sql) or die(mysql_error());
	echo "Completed";
}
	mysql_close($dbc);
?>