<?php
    if (session_start() && isset ($_SESSION['username']) && isset ($_SESSION['pass'])) {
    header("Location: resetPasswordKnown.php");
    } 
    else if (isset ($_SESSION['username']) && !isset ($_SESSION['pass'])) {
                if (isset ($_GET['confcode'])) {
                    require 'connection.php';
                    $username=$_SESSION['username'];
                    $sql1="SELECT seccode FROM users WHERE username='$username'";
                    $result= mysql_query($sql1) or die(mysql_error());
                    $code= mysql_fetch_assoc($result);
                    if ($code['seccode'] == $_GET['confcode']) {
                        // Do nothing
                    } else {
                        $message="Confirmation Code Expired  or Invalid,".$_GET['confcode'];
                        header("Location: answerSecurityQuestion.php?message=$message");
                    }
                    mysql_close($dbc);
                } else {
                    $message="Confirmation Code Could Not be generated !";
                    header("Location: forgotPassword.php?message=$message");
                }
         } else {
                $message="Please Provide the Username !";
                header("Location: forgotPassword.php?message=$message");
         }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam- Save Paper Save Tree</title>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
    </head>
    <body>
        <table id="deep_table" border="0" align="center">
            <thead>
                <tr>
                    <td align="left" >
                        <a href="index.php"><img hspace="45px" src="images/logo1.png" width="300" height="150" title="eExam.co.in - Home" alt="logo"/></a>
                    </td>
                    <td align="right" >

                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <div class="hori_list">
                            <a href="index.php" class="link"><div class="hori_list_tab">Home</div></a>
                            <a href="ExamRules.php" class="link"><div class="hori_list_tab">Exam Rules</div></a>
                            <a href="about.php" class="link"><div class="hori_list_tab">About</div></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td height="10px" colspan="2">

                    </td>
                </tr>
                <tr>
                    <td id="content" colspan="2" valign="top">
                        <table border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td valign="top" align="left" width="86%" style="">
										<div style="width: inherit; height: 50px; border: 2px  #3D997A solid; padding:20px;">
                                            <?php
											if (isset ($_GET['message']))   echo $_GET['message'];
										?>
										        <form method="post" action="action.php?op=7">
													<b>New Password-</b><input type="password" name="pass1"/> <br />
													<b>Confirm New Password-</b><input type="password" name="pass2"<br />
													<input type="submit" value="Reset" />
												</form>
										</div>
                                    </td>
                                    <td valign="top">
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                   </td>
                </tr>
				<?php
					require("footer.txt");
				?>
            </tbody>
        </table>
	</body>
</html>
