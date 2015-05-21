<?php
if( session_start() && !(isset ($_SESSION['pass']) || isset ($_SESSION['username']))) {

	header("Location: login.php");
} else if (isset($_GET['op'])) {
	$op=$_GET['op'];
	if ($op==1) {
		$f=fopen("files/examNotes.txt","r") or exit("Unable to open file- 'files\examNotes.txt' !");
		while (!feof($f)) {
			echo fgets($f);
		}
		fclose($f);
	} else if ($op==2) {
		$f=fopen("files/examNotes.txt","r") or exit("Unable to open file- 'files\examNotes.txt' !");
		$a="";
		while (!feof($f)) {
			$a.=fgets($f);
		}
		echo "<input type=\"text\" value=\"".$a."\" style=\"height:30px; font-family:'arial'; font-size:18px;\" size=\"110\" id=\"editedExamNote\"\>";
		fclose($f);
	} else if ($op!=1 && $op!=2) {
		$f=fopen("files/examNotes.txt","w") or exit("Unable to open file- 'files\examNotes.txt' !");
		fwrite($f,$op);
		fclose($f);
	} 
} else {

	echo "Something went wrong in fetching files\examNotes.txt";
}
?>