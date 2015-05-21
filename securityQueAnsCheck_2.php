<?php
    if (session_start() && isset ($_SESSION['username']) && isset ($_SESSION['pass'])) {
    header("Location: index.php");
    } else if (!isset ($_SESSION['username'])) {
        $message="Please Provide the Username !";
        header("Location: forgotPassword.php?message=$message");
    }   require 'connection.php';
        $username=$_SESSION['username'];
        $securityAnswer =$_POST['securityAnswer'];
        $sql1= "SELECT securityAnswer FROM users WHERE username='$username'";
        $result= mysql_query($sql1) or die(mysql_error());
        $sec_ans= mysql_fetch_assoc($result);
        $securityAnswer1= $sec_ans['securityAnswer'];

        if ($securityAnswer == $securityAnswer1) {  // securityQuestion and securityAnser
            //$confirm_code= md5(uniqid(rand()));     // must be not null in Table
            $confirm_code= md5(uniqid(rand(),true));
            $sql1="UPDATE users SET seccode='$confirm_code' WHERE username='$username'";
            $result= mysql_query($sql1) or die(mysql_error());
            header("Location: resetPassword.php?confcode=$confirm_code");
        } else {
            $message="You Answered Wrong... Try Again !";
			unset  ($_SESSION['username']);
            header("Location: answerSecurityQuestion.php?userName=$username&message=$message");
        }
        mysql_close($dbc);
?>
