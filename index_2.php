<?php
//$fileName="index.php";
if (session_start() && isset($_SESSION['maxQue'])) {
		header("Location: paper.php?qNo=1");
	} else if(!(isset ($_SESSION['pass']) && isset ($_SESSION['username']))) {
	$login="<div class=\"login-form\">
			<b style=\"font-family:'Arial'; color:green;\">Already Registered?<br />login Here Now !</b><br />
			<form method=\"post\" action=\"action.php?op=1\">
            <b style=\"font-family:'Arial'; color:grey;\">User Name</b>
            <input type=\"text\" name=\"userName\" value=\"\" />
            <br />
            <b style=\"font-family:'Arial'; color:grey;\">Password &nbsp;</b>
          <input type=\"password\" name=\"password\" /> <br />
            <input type=\"submit\" value=\"Login\" />
        </form>
        <div class=\"forgotPassword\"><a href=\"forgotPassword.php\">Forgot Password</a> <a href=\"registerUser.php\">Register</a></div>
		</div><br />
		<a href=\"registerUser.php\" class=\"submitButton\">Register Here!</a>
		";
		$display="<div id=\"indexPageContent\">
					<b class=\"recentToppers\">Welcome to eExam</b>
					<p>This is an approach in the form of web application in order to conduct the examinations easily, effectively, economical, environment friendly and with least of man power. It is a common platform in terms of the year of study, subject of study etc. for conducting exam online. Students are just required to fill a registration form in order to appear in an exam at this web portal.
</p><p>An effective Content Management System (CMS) is used for storing the student personal information, academic information etc. The result copy of each exam in which a student got appeared, is generated automatically (in html file) by the system so that the admin can maintain a proof of every student’s performance.
</p>
				  </div>";
    } else {
		$user=$_SESSION["username"];
        if (isset ($_SESSION['pic'])) {
            $p=$_SESSION['pic'];
            $pic="<a href=\"student.php?username=$user\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        $logout="<a style=\"font-family:'Arial'; color:grey; font-size:14px;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a> <a style=\"font-family:'Arial'; color:grey; font-size:14px\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>";
		$inbox="<a href=\"inbox.php?username=".$_SESSION['username']."\"class=\"link\"><div class=\"hori_list_tab\">Inbox</div></a>";
		$profile="<a href=\"student.php?username=".$_SESSION['username']."\"class=\"link\"><div class=\"hori_list_tab\">Profile</div></a>";
		$display="<div id=\"indexPageContent\">
					<b class=\"recentToppers\">Welcome to eExam</b>
					<p>This is an approach in the form of web application in order to conduct the examinations easily, effectively, economical, environment friendly and with least of man power. It is a common platform in terms of the year of study, subject of study etc. for conducting exam online. Students are just required to fill a registration form in order to appear in an exam at this web portal.
</p><p>An effective Content Management System (CMS) is used for storing the student personal information, academic information etc. The result copy of each exam in which a student got appeared, is generated automatically (in html file) by the system so that the admin can maintain a proof of every student’s performance.
</p>
				  </div>";
		if ($_SESSION['username']=="admin") {
            $studentdisplay="<div class=\"recentToppers\">
								Search a Student
							</div>
							<div style=\"padding: 10px; border-radius: 10px; margin-top: 5px; border: 2px  #3D997A solid; width: auto;\">
								<input type=\"text\" id=\"txtStudent\" value=\"Type a Name !\" onkeyup=\"findStudent(this.value)\" onmousedown=\"findStudent(this.value)\" onclick=\"findStudent(this.value)\" size=\"40\"/>
								<div id=\"studentDisplay\"></div>
							</div>";
            $display="<div style=\"height:auto; width:95%; margin-left:30px;\">
                                            <div style=\"position: relative;\">
                                                <span style=\"margin-top: 1px; font-size: 20px; font-weight: bold; color: white; border-radius: 5px; background-color: #64AD95; padding: 5px;\">
                                                Insert Question
                                                </span>
                                                <input id=\"txtSearch\" size=\"40\" onmousedown=\"hide_default_text();\" onkeyup=\"show_search_result()\" onclick=\"show_search_result()\" value=\"Type Here !\" type=\"text\"/>
                                                <input style=\"position:relative; top:1px; padding: 5px; width:60px; font-size: 20px; float:right;\" type=\"button\" onclick=\"flush_result1()\" value=\"close\" />
												<div id=\"succsessDiv\"></div>
                                            </div>
                                            <div id=\"search_result\"></div>
											<div onclick=\"flush_result1()\">
                                            <div style=\"color: #000066; margin-left: 220px; margin-top: 22px; font-family: 'arial'; font-weight: bold;\">Option 1<input style=\"height: 20px; color: #000066; font-family: 'arial'; font-weight: bold;\" type=\"text\" id=\"txtOp1\" size=\"22\" maxlength=\"100\"/></div>
                                            <div style=\"color: #000066; margin-left: 220px; margin-top: 12px; font-family: 'arial'; font-weight: bold;\">Option 2<input style=\"height: 20px; color: #000066; font-family: 'arial'; font-weight: bold;\" type=\"text\" id=\"txtOp2\" size=\"22\" maxlength=\"100\"/></div>
                                            <div style=\"color: #000066; margin-left: 220px; margin-top: 12px; font-family: 'arial'; font-weight: bold;\">Option 3<input style=\"height: 20px; color: #000066; font-family: 'arial'; font-weight: bold;\" type=\"text\" id=\"txtOp3\" size=\"22\" maxlength=\"100\"/></div>
                                            <div style=\"color: #000066; margin-left: 220px; margin-top: 12px; font-family: 'arial'; font-weight: bold;\">Option 4<input style=\"height: 20px; color: #000066; font-family: 'arial'; font-weight: bold;\" type=\"text\" id=\"txtOp4\" size=\"22\" maxlength=\"100\"/></div>
                                            <div style=\"color: #000066; margin-left: 220px; margin-top: 12px; font-family: 'arial'; font-weight: bold;\">Answer &nbsp;<input style=\"height: 20px; color: #000066; font-family: 'arial'; font-weight: bold;\" type=\"text\" id=\"txtAns\" size=\"22\" maxlength=\"7\"/></div>
                                            <div style=\"color: #000066; margin-left: 220px; margin-top: 12px; font-family: 'arial'; font-weight: bold;\">Category<input style=\"height: 20px; color: #000066; font-family: 'arial'; font-weight: bold;\" type=\"text\" id=\"category\" size=\"22\" maxlength=\"30\" value=\"java\" /></div>
                                            <input id=\"btnSubmit\" style=\"position: relative; top:-25px; font-size: 20px; float:right; width: 100px; height:35px; color: #000066;\" type=\"button\" value=\"Insert\" onclick=\"insertQue()\"/>
											</div>
                                        </div>
						";
						$examNote="<a href=\"editexamNote.php\" class=\"link\"><div class=\"hori_list_tab\">Edit ExamNote</div></a>";
						$resultList="<a href=\"resultList.php\" class=\"link\"><div class=\"hori_list_tab\">Result List</div></a>";
						$questionList="<a href=\"questionList.php\" class=\"link\"><div class=\"hori_list_tab\">Question List</div></a>";
						$setPaper="<a href=\"setPaper.php\" class=\"link\"><div class=\"hori_list_tab\">Set Paper</div></a>";
	} else {
					$display="<div style=\"position:relative; top:10px; margin-left:5px;\">
								
					</div>";
	}
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam- Save Paper Save Tree</title>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <script type="text/javascript" src="js/script1.js"></script>
		<script type="text/javascript" src="js/script2.js"></script>
		<script type="text/javascript" src="js/script3.js"></script>
    </head>
    <body onresize="">
        <table id="deep_table" border="0" align="center">
            <thead>
                <tr onclick="flush_result1()">
                    <td align="left" >
                        <a href="index.php"><img hspace="45px" src="images/logo1.png" width="300" height="150" title="eExam.co.in - Home" alt="logo"/></a>
                    </td>
                    <td align="right" >
						<?php if (!isset ($login))
							{echo $username;
                                echo $pic;
                                echo $logout;
                            }
					?>
                    </td>
                </tr>
            </thead>
            <tbody>
			<tr>
				<td style="height:10px;">
					                                
				</td>
			</tr>
                <tr <?php if (isset($_SESSION['pass']) && ($_SESSION['username']=="admin")) echo "onclick=\"flush_result1()\""; ?> >
                    <td colspan="2">
                        <span class="hori_list">
                            <a href="index.php" class="link"><div class="hori_list_tab">Home</div></a>
							<?php if (isset($inbox)) echo $inbox; ?>
							<?php if (isset($profile)) echo $profile; ?>
                            <a href="ExamRules.php" class="link"><div class="hori_list_tab">Exam Rules</div></a>
							<?php if (isset($examNote) || isset($resultList) || isset($questionList) || isset($setPaper)) echo $examNote." ".$resultList." ".$questionList." ".$setPaper; ?>
                            <a href="about.php" class="link"><div class="hori_list_tab">About</div></a>
                        </span>
                    </td>
                </tr>
				<tr>
                    <td id="content" colspan="2" valign="top">
                        <table border="0" align="center">
                            <tbody>
                                <tr>
                                    <td valign="top" align="left" width="80%" >
                                        <?php echo $display;?>
                                    </td>
                                    <td valign="top">
                                        <div style="width: 300px;">
                                            <?php if (isset($studentdisplay)) echo $studentdisplay;?>
											<div class="loginForm">
                        <?php
                            if (isset ($login)) {
                                echo $login;
                            }
                        ?>
						</div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
										<?php if (isset($_SESSION["username"]) && isset($_SESSION["pass"]) && $_SESSION["username"]=="admin") 
											echo "<div style=\"padding:5px; width: inherit; height: auto; border: 2px  #3D997A solid;\" onclick=\"flush_result1()\">
													<b style=\"color:red;\">Note:-</b>
													<ol>
														<li>A Student can either be searched by <b>Name or Enrollment No. or Username.</b></li>
														<li>A Question can either be searched by <b>Question or any of the options.</b></li>
													</ol>
												  </div>";
											else {
													
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