<?php
	$fileName="ExamRules.php";
    if( session_start() && !(isset ($_SESSION['pass']) && isset ($_SESSION['username']))) {
	$login="<b style=\"font-family:'Arial'; color:black;\">Login Here Now !</b><br />
			<form method=\"post\" action=\"action.php?op=1&fromLocation=$fileName\">
            <b style=\"font-family:'Arial'; color:black;\">User Name</b>
            <input type=\"text\" name=\"userName\" value=\"\" />
            <br />
            <b style=\"font-family:'Arial'; color:black;\">Password</b>
          <input type=\"password\" name=\"password\" /> <br />
            <input type=\"submit\" value=\"Login\" />
        </form>
        <a style=\"font-family:'Arial'; color:grey;\" href=\"forgotPassword.php\">Forgot Password</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"registerUser.php\">Register</a>";
    } else {
        if (isset ($_SESSION['pic'])) {
            $user=$_SESSION['username'];
            $pic="<a href=\"student.php?username=$user\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        $logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>";
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
                        <?php
                            if (isset ($login)) {
                                echo $login;
                            } else {
                                echo $username;
                                echo $pic;
                                echo $logout;
                            }
                        ?>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <div class="hori_list">
                            <a href="index.php" class="link"><div class="hori_list_tab">Home</div></a>
                            <?php if(isset($_SESSION['username'])) echo "<a href=\"inbox.php?username=".$_SESSION['username']."\" class=\"link\"><div class=\"hori_list_tab\">Inbox</div></a>";?>
                            <a href="ExamRules.php" class="link"><div class="hori_list_tab">Exam Rules</div></a>
                            <a href="about.php" class="link"><div class="hori_list_tab">About</div></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td id="content" colspan="2" valign="top">
                        <table align="center" border="0">
                            <tbody>
                                <tr>
                                    <td valign="top"></td>
                                    <td>
									<br />
									<div class="recentToppers">Rules for the Online Exam.</div>
										<ol style="padding-top:20px; padding-right:20px; padding-bottom:20px; border:1px lightgrey solid; border-radius:10px; font-family:'arial'; font-size:16px; color:black; line-height:30px; letter-spacing:2px;">
											<?php
												$a= fopen("examRules.txt","r");
												while (!feof($a)) {
													echo fgets($a);
												}
												fclose($a);
											?>
										</ol>
										<?php
											if ((isset ($_GET['category'])&& isset ($_GET['maxQue'])) && (isset ($_SESSION['pass']) && isset ($_SESSION['username']))) {
												$maxque=$_GET['maxQue'];
												$category =$_GET['category'];
												$timelimit=$_GET["timeLimit"];
												$examcode=$_GET["examCode"];
												if (isset($_GET["message"])) echo $_GET["message"];
												echo "<a class=\"submitButton\" href=\"action.php?op=3&category=$category&maxQue=$maxque&timeLimit=$timelimit&examCode=$examcode\">Proceed Now !</a>";
												if ($_SESSION['username']=="admin") echo "&nbsp; <a class=\"submitButton\" href=\"editExamRule.php\">Edit</a>";
											} else if(isset ($_SESSION['pass']) && isset ($_SESSION['username'])){
												echo "<a class=\"submitButton\" href=\"inbox.php\">Select Exam</a>";
												if ($_SESSION['username']=="admin") echo "&nbsp; <a class=\"submitButton\" href=\"editExamRule.php\">Edit</a>";
											} else {
												echo "<a class=\"submitButton\" href=\"login.php?fromLocation=$fileName\">Login</a> Or <a class=\"submitButton\" href=\"registerUser.php\">Register</a>";
											}
										?>
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
