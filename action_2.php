<?php

$op=$_GET['op'];
if ($op == "") {
    header("Location: login.php");
} else if ($op == "1") {
    verifyUser();
} else if ($op == "2") {
    registerUser();
} else if ($op == "3") {
    initializeExam();
} else if ($op == "4") {
    resetPasswordKnown();
} else if ($op == "5") {
    logoutUser();
} else if ($op == "6") {
    forgotPassword();
} else if ($op == "7") {
    resetPassword();
} else if ($op == "8") {
    storeAnswer();
} else if ($op == "9") {
    quitTest();
} else if ($op == "10") {
    insertQue();
} else if ($op == "11") {
    editExamRules();
} else if ($op == "12") {
    setExam();
} else {
    header("Location:index.php");
}

function verifyUser(){ // op=1
if(session_start() && !(isset ($_SESSION['username']) && isset ($_SESSION['pass']))){
$user=$_POST['userName'];
$password=$_POST['password'];
if(isset ($_POST['userName']) && ($_POST['password'])){
$sql="SELECT name,password,profilepic,name,enrollment FROM users WHERE username='$user'";
require 'connection.php';
$result=mysql_query($sql) or die(mysql_error());
$query_array = mysql_fetch_assoc($result);
    if($password==$query_array['password']){
		$_SESSION['username']=$user;
        $_SESSION['pass']=$password;
        $_SESSION['name']=$query_array['name'];
        $_SESSION['enrollment']=$query_array['enrollment'];
		if ($query_array['profilepic']!="")
			$_SESSION['pic']=$query_array['profilepic'];
		else
			$_SESSION['pic']="default.png";
		if (isset($_GET['fromLocation'])) {
			$location=$_GET['fromLocation'];
			header("Location: $location");
		}else {
			header("Location: index.php");
		}
    } else {
		$message="Username or Password entered is Incorrect !";
		header ("Location:errorPage.php?message=$message");
	}
}  else {
    $message="Please Provide Login Details !";
    header("Location: login.php?message=$message");
}
}  else {
    header("Location: index.php");
}
mysql_close($dbc);
}

function registerUser() { // op=2
if(session_start() && !(isset ($_SESSION['username']) && isset ($_SESSION['pass']))){
    $username=$_POST['userName'];
    $password=$_POST['password'];
	$name=$_POST['name'];
	$enrollment=$_POST['enNo'];
	$branch=$_POST['branch'];
    $confirmPassword=$_POST['confirmPassword'];
    $securityQuestion=$_POST['securityQuestion'];
    $securityAnswer=$_POST['securityAnswer'];
	$semester=$_POST['semester'];
    $eMail=$_POST['eMail'];
    if (!($_POST['userName'])=="" && !($_POST['password'])=="" && !($_POST['confirmPassword'])=="" && !($_POST['securityQuestion'])=="" && !($_POST['securityAnswer'])=="" && !($_POST['eMail'])=="") {
        if($_POST['userName']=="admin") {
            $message="More Admins can't be created !";
            header("Location: registerUser.php?message=$message");
        }
        if($password!=$confirmPassword) {
            $errorPassword="Password and Confirm Password do Not Match";
            header("Location: errorPage.php?message=$errorPassword");
        } else if(userAlreadyExists($username)) {
            $errorDuplicateUser="Username Entered is Already Exists, Try a different one.";
            header("Location: errorPage.php?message=$errorDuplicateUser");
        } else if(enrollAlreadyExists($enrollment)) {
            $errorDuplicateUser="Enrollment Number Entered Already Exists, Contact Admin!";
            header("Location: errorPage.php?message=$errorDuplicateUser");
        } else {
            if (isset($_POST['mobNo'])) {
			$mobno=$_POST['mobNo'];
			$sql="INSERT INTO users(enrollment, name, branch, mobno, username, password, security_question, securityAnswer, email, semester) VALUES ('$enrollment', '$name','$branch', '$mobno', '$username', '$password', '$securityQuestion', '$securityAnswer', '$eMail', '$semester')";
			} else {
			$sql="INSERT INTO users(enrollment, name, branch, mobno, username, password, security_question, securityAnswer, email, semester) VALUES ('$enrollment', '$name','$branch', $semester, '$username', '$password', '$securityQuestion', '$securityAnswer', '$eMail', '$semester')";
			}
            require 'connection.php';
			$res=mysql_query($sql) or die(mysql_error());
            header("Location: userSuccessfullyRegistered.php?username=$username");
        }
    } else {
        $user=$_POST['userName'];
        $message="Some Fealds remain Unfilled, Please Fill all Fields Correctly !";
        header("Location: registerUser.php?message=$message&userName=$user&securityQuestion=$securityQuestion&securityAnswer=$securityAnswer&eMail=$eMail");
    }
}
mysql_close($dbc);
}

function initializeExam() { // op=3
    if (session_start() && !(isset ($_SESSION['username']) && isset ($_SESSION['pass']))) {
        header("Location: login.php");
    } else if (isset($_SESSION['maxQue']) && isset($_SESSION['category']) && isset($_SESSION['examCode']) && isset($_SESSION['timeLimit'])) {
		header("Location: paper.php?qNo=1");
	} else if ($_GET["maxQue"]!="" && $_GET["category"]!="" && $_GET["examCode"]!="" && $_GET["timeLimit"]!="") {
	//header("Location: awai.php?val=1");
	$examcode=$_GET["examCode"];
	require "connection.php";
	$sql="SELECT status FROM exams WHERE examcode='$examcode'";
	$res=mysql_query($sql) or die(mysql_error());
	$result=mysql_fetch_assoc($res);
	if($result["status"]!="Waiting") {
		$message ="Error no. 109 -Exam Already Closed, Contact Admin !";
		header("Location: errorPage.php?message=$message");
	}
	$category=$_SESSION['category']=$_GET['category'];
	$_SESSION['examCode']=$examcode;
    $_SESSION['day']= date('D');
    $_SESSION['day1']= date('d');
    $_SESSION['month']= date('M');
    $_SESSION['year']= date('Y');
    $_SESSION['hours']= date('H');
    $_SESSION['minutes']= date('i');
    $_SESSION['seconds']= date('s');
    $_SESSION['timeLimit']=$_GET['timeLimit'];
    $_SESSION['maxQue']=$_GET['maxQue'];
	$sql="SELECT category FROM questions WHERE category='$category'";
	$result = mysql_query($sql) or die(mysql_error());
	$res=mysql_fetch_assoc($result);
	if($res['category']!=$category) {
		unset ($_SESSION['maxQue']);
		unset  ($_SESSION['examCode']);
		unset  ($_SESSION['category']);
		unset  ($_SESSION['timeLimit']);
		$message="Error No. 101 -This Category Question Do not Exist in the database,Please Contact Admin!";
		header("Location: errorPage.php?message=$message");
    }
	$sql = "SELECT qid FROM questions WHERE category='$category'";
	$result = mysql_query($sql) or die(mysql_error());
    $found=mysql_num_rows($result) or die(mysql_error());
	if ($found<$_GET['maxQue']) {
    		unset ($_SESSION['maxQue']);
         $message="Error No. 102 -Question Found in Database for this Category are too few than Maximaum Question Limit for this test !";
         header("Location: errorPage.php?message=$message");
    } else {
	$i=1;
    while ($q = mysql_fetch_assoc($result)) {
        $qid[$i]=$q['qid']; $i++;
    }
    $numbers = range(1, $found);
    shuffle($numbers);
    $i=1;
    foreach ($numbers as $number) {
    $qxn[$i]=$qid[$number]; $i++;
    }
    $i=1;
    while ($i<=$_GET['maxQue']) {
        $sql="SELECT * FROM questions WHERE qid='$qxn[$i]'";
        $result= mysql_query($sql) or die(mysql_error());
        while ($que=  mysql_fetch_assoc($result)) {
            $str="que".$i;
            $_SESSION[$str]['qno']=$i;
            $_SESSION[$str]['question']=$que['question'];
            $_SESSION[$str]['op1']=$que['op1'];
            $_SESSION[$str]['op2']=$que['op2'];
            $_SESSION[$str]['op3']=$que['op3'];
            $_SESSION[$str]['op4']=$que['op4'];
            $_SESSION[$str]['ans']=$que['ans'];
            $_SESSION[$str]['opt']="0";
        }
        $i++;
    }
        header("Location: paper.php?qNo=1");
    }
} else {
	$message="Error No. 103 - Contact Admin to Solve this Issue !";
	header("Location: errorPage.php?message=$message");
}
mysql_close($dbc);
}

function resetPasswordKnown() { //op=4
    if (session_start() && !(isset ($_SESSION['username']) && isset ($_SESSION['pass']))) {
        header("Location: login.php");
    } 
        if ($_POST['oldPassword']=="" || $_POST['newPassword1']=="" || $_POST['newPassword2']=="") {
            $message="Some Fields were Not Filled...";
            header("Location: resetPasswordKnown.php?message=$message");
        } else if($_POST['newPassword1'] == $_POST['newPassword2']) {
            $newpassword=$_POST['newPassword1'];
            $username=$_SESSION['username'];
            require 'connection.php';
            $sql="SELECT password FROM users WHERE username='$username'";
            $result=mysql_query($sql) or die(mysql_error());
            $pass=mysql_fetch_assoc($result);
            if($_POST['oldPassword']==$pass['password']) {
                $sql="UPDATE users SET password='$newpassword' where username='$username'";
                $result=mysql_query($sql) or die(mysql_error());
                logoutUser();
                header("Location: login.php");
            } else {
                $message="Current Password is not Correct !";
                header("Location: resetPasswordKnown.php?message=$message");
            }
        } else {
            $message="New Password and Confirm New Password Didn't Match !";
            header("Location: resetPasswordKnown.php?message=$message");
        }
mysql_close($dbc);
}

function logoutUser() { //op=5
    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    header("Location: index.php");
}

function forgotPassword() {     //op=6
    if (session_start() && isset ($_SESSION['username']) && isset ($_SESSION['pass'])) {
    header("Location: index.php");
    }
        $username=$_POST['userName'];
        if(!isset ($_POST['userName'])){
            $message="Please Provide the Username !";
            header("Location: forgotPassword.php?message=$message");
        } else if(userAlreadyExists($username)) {
            $_SESSION['username']=$username;
            header("Location: isThisYou.php?userName=$username");
        } else {
			$message="Error No. 104 -Please Contact Admin !";
            header("Location: errorpage.php?message=$message");
        }
}

function userAlreadyExists($username) {
    require 'connection.php';
    $sql="SELECT username FROM users WHERE username='$username'";
    $result=mysql_query($sql) or die(mysql_error());
    $found=mysql_fetch_assoc($result);
    $foundUserName=$found['username'];
    return $foundUserName==$username;
	mysql_close($dbc);
}

function enrollAlreadyExists($enno) {
    require 'connection.php';
    $sql="SELECT enrollment FROM users WHERE enrollment='$enno'";
    $result=mysql_query($sql) or die(mysql_error());
    $found=mysql_fetch_assoc($result);
    $foundEnrollment=$found['enrollment'];
    return $foundEnrollment==$enno;
	mysql_close($dbc);
}

function resetPassword() {      //op=7
if (session_start() && isset ($_SESSION['username']) && isset ($_SESSION['pass'])) {
    header("Location: index.php");
    }
    if(!($_POST['pass1']=="") && !($_POST['pass2']=="") ) {
        if ($_POST['pass1'] == $_POST['pass2']) {
            session_start();
            $username= $_SESSION['username'];
            $pass =$_POST['pass1'];
            require 'connection.php';
            $null="";
            $sql="UPDATE users SET password='$pass',seccode='$null' WHERE username='$username'";
            mysql_query($sql) or die(mysql_error());
			mysql_close($dbc);
            logoutUser();
            header("Location: passwordSuccessfullyReset.php");
        } else {
            require 'connection.php';
            $null="";
            $sql="UPDATE users SET seccode='$null' WHERE username='$username'";
            mysql_query($sql) or die(mysql_error());
			mysql_close($dbc);
            $message="Password and Confirm Password didn't match, Retry !";
            header("Location: answerSecurityQuestion.php?message=$message");
        }
    } else {
        require 'connection.php';
        $null="";
        $sql="UPDATE users SET seccode='$null' WHERE username='$username'";
        mysql_query($sql) or die(mysql_error());
		mysql_close($dbc);
        $message="Wrong Password Selection !";
        header("Location: answerSecurityQuestion.php?message=$message");
    }
}


function storeAnswer() { //op=8
if (session_start() && isset ($_SESSION['username']) && isset ($_SESSION['pass']) && isset ($_SESSION['examCode'])) {
		$qsrt="que".$_POST["qno"];
        $next_que=$_POST["qno"]+1;
			if (!isset($_POST["op"])) {
				$_SESSION[$qsrt]['opt']="0";
				header("Location: paper.php?qNo=$next_que");
			} else {
				$_SESSION[$qsrt]['opt']=implode(" ", $_POST["op"]);
				header("Location: paper.php?qNo=$next_que");
			}
    } else {
		$message="Error No. 105, Please Contact Admin !";
        header("Location: errorPage.php?message=$message");
	}
}

function quitTest() { //op=9
	if (session_start() && isset($_SESSION["username"]) && isset($_SESSION["pass"]) && isset($_SESSION["examCode"])) {
		$i=1;
        $score=0;
		$resStr="";
		for ($i=1; $i<=$_SESSION["maxQue"]; $i++) {
			$qstr="que".$i;
            if ($_SESSION[$qstr]['opt']=="0") {
				continue;
			} else if($_SESSION[$qstr]['ans']==$_SESSION[$qstr]['opt']) {
				$score++;
            }
			if($i%2==0) $var="style=\"background-color:lightgrey;\"";
			else $var="style=\"background-color:white;\"";
			$resStr.="<tr ".$var.">
				<td colspan=\"4\">Que(".$_SESSION[$qstr]['qno'].")".$_SESSION[$qstr]['question']."</td>
				<td>Correct Answer-".$_SESSION[$qstr]['ans']."</td>
				</tr>
				<tr ".$var.">
				<td>(1)".$_SESSION[$qstr]['op1']."</td>
				<td>(2)".$_SESSION[$qstr]['op2']."</td>
				<td>(3)".$_SESSION[$qstr]['op3']."</td>
				<td>(4)".$_SESSION[$qstr]['op4']."</td>
				<td>You Anserd-".$_SESSION[$qstr]['opt']."</td>
					</tr>";
		}
		$username=$_SESSION['username'];
		require "connection.php";
		$sql="SELECT result FROM users WHERE username='$username'";
		$result=mysql_query($sql) or die(mysql_error());
		$res=mysql_fetch_assoc($result);
		$score1=$res["result"];
		$score2=$_SESSION['category']."=".$score."/".$_SESSION['maxQue'];
		if($score1!="") $score1.="=".$score2;
		else $score1=$score2;
		$sql="UPDATE users SET result='$score1' WHERE username='$username'";
		mysql_query($sql) or die(mysql_error());
		$resStr="<table border=\"1\" width=\"800px\" cellpadding=\"3px\" align=\"center\">".$resStr."</table>";
		$filename=$_SESSION["username"]."-".$_SESSION["examCode"];
		$user=$_SESSION["username"];
		$result="<table cellpadding=\"3px\" border=\"1\" width=\"800px\" align=\"center\">
					<tr>
						<td style=\"width:600px;\">".$_SESSION['username']."</td><td style=\"width:200px;\">".$score."</td>
					</tr>
				 </table>";
		$result1="<table cellpadding=\"3px\" border=\"1\" width=\"800px\" align=\"center\">
					<tr>
						<td collspan=\"2\"><b style=\"color:grey; font-family:'Calibri'; font-size:120%;\">Exam Code- ".$_SESSION["examCode"].", Time Limit- ".$_SESSION["timeLimit"].", Max. Que- ".$_SESSION["maxQue"]."</b></td>	
					</tr>
				</table>
				<table cellpadding=\"3px\" border=\"1\" width=\"800px\" align=\"center\">
					<tr>
						<td style=\"width:600px;\">".$_SESSION['username']."</td><td style=\"width:200px;\">".$score."</td>
					</tr>
				 </table>";
		$resStr=$result1.$resStr;
		file_put_contents("results/$filename.html","$resStr");
		$filename=$_SESSION["examCode"];
		if (file_get_contents("results/$filename.html")!="")	file_put_contents("results/$filename.html","$result",FILE_APPEND);
		else	file_put_contents("results/$filename.html","$result1");
		$sql="UPDATE users SET examcode='' WHERE username='$username'";
		mysql_query($sql) or die(mysql_error());
		mysql_close($dbc);
		logoutUser();
	} else {
		$message="Error No 106 -Bad Luck, Unusuall Session End, Your Test didn't Saved !";
		header ("Location: errorPage.php?message=$message");
	}
mysql_close($dbc);
}

function insertQue () { //op=10
	if (session_start() && isset($_SESSION["pass"]) && $_SESSION['username']=="admin") {
		$que =$_GET['question'];
		$op1 =$_GET['op1'];
		$op2 =$_GET['op2'];
		$op3 =$_GET['op3'];
		$op4 =$_GET['op4'];
		$ans =$_GET['ans'];
		$category =$_GET['category'];
		$sql ="INSERT INTO questions (question, op1, op2, op3, op4, ans, category) VALUES ('$que','$op1','$op2','$op3','$op4','$ans','$category')";
		require "connection.php";
		$result= mysql_query($sql) or die(mysql_error());
		if ($result) {
			echo "<b style=\"color:green;\">Question Successfully Inserted !</b>";
		} else {
			echo "<b style=\"color:green;\">Something Went Wrong, Please try Again!</b>";
		}
	} else {
		$message="Error No 107 -Please Contact Admin !";
		header ("Location: errorPage.php?message=$message");
	}
mysql_close($dbc);
}

function editExamRules() { //op=11
	if (session_start() && isset($_SESSION["pass"]) && $_SESSION['username']=="admin") {
		if($_POST['txtRules']!=""){
		$rules=$_POST['txtRules'];
		$a=fopen("examRules.txt","w");
		fwrite($a,$rules);
		fclose($a);
		header("Location: ExamRules.php");
		}
	} else {
		$message="Error No. 108 -Please Report this Error to Admin !";
		header("Location: errorPage.php?message=$message");
	}
}

function setExam() { //op=12
	if (session_start() && isset($_SESSION["pass"]) && $_SESSION["username"]=="admin") {
		$examname=$_GET["examName"];
		$examdate=$_GET["examDate"];
		$semester=$_GET["semester"];
		$maxque=$_GET["maxQue"];
		$_SESSION["examTimeLimit"]=$timelimit=$_GET["examTimeLimit"];
		$examstatus=$_GET["examStatus"];
		$examcode= $examname."-".$examdate."-".$timelimit."-".$semester."-".$maxque;
		require "connection.php";
		$sql="INSERT INTO exams (examname, examcode, semester, maxque, date, status,timelimit) VALUES ('$examname', '$examcode', '$semester', '$maxque', '$examdate', '$examstatus','$timelimit')";
		mysql_query($sql) or die(mysql_error());
		$sql="SELECT examcode FROM users WHERE semester='$semester'";
		$res=mysql_query($sql) or die(mysql_error());
		$result=mysql_fetch_assoc($res);
		$code=$result["examcode"];
		if ($code!="") { $examcode.="][".$code;	$sql="UPDATE users SET examcode='$examcode' WHERE semester='$semester'"; }
		else	$sql="UPDATE users SET examcode='$examcode' WHERE semester='$semester'";
		mysql_query($sql) or die(mysql_error());
		$res=mysql_query("SELECT examid FROM exams ORDER BY examid DESC LIMIT 1");
		$_SESSION["examId"]=$res["examid"];
		mysql_close($dbc);
		echo $examcode;
		//header("Location: setPaper.php");
	} else {
		header("Location: index.php");
	}
mysql_close($dbc);
}
?>