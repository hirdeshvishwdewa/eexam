<?php
    if(session_start() && isset ($_SESSION['username']) && isset ($_SESSION['pass'])) {
        header("Location:index.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam- Register New User</title>
		<link type="text/css" rel="stylesheet" href="styles/style.css" />
		<script type="text/javascript" src="js/registrationPage.js"></script>
    </head>
    <body>
        <table id="deep_table" border="0" align="center">
            <thead>
                <tr onclick="flush_result1()">
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
							<b style="color:blue; font-weight:bold; font-family:'Arial';">Already Registered ?</b><a class="submitButton" href="login.php">Login</a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td height="10px" colspan="2"  width="100%">

                    </td>
                </tr>
                <tr>
                    <td id="content" colspan="2"  width="100%" valign="top">
                        <table border="0" align="left" >
                            <tbody>
                                <tr>
                                    <td valign="top">
                                            <div class="recentToppers">
                                                Registration Form
                                            </div>
                                            <div style="padding: 30px; border-radius: 10px; margin-top: 5px; border: 2px  #3D997A solid; height: auto; width:600px;">
												<?php if(isset ($_GET['message'])) echo "<b style=\"color:red;\">".$_GET['message']."</b><br />";?>
												<form action="action.php?op=2" method="post" style="color:blue; font-weight:bold; font-family:'Arial';" >
													Full Name<small style="color:red;">*</small><br /><input onblur="validateName()" type="text" name="name" id="txtName" <?php if (isset ($_GET['name'])) echo "value=\"".$_GET['name']."\"";?>/>
														<a style="color:lightgrey; text-decoration:none;" onclick="nameHint()" href="#"><small>[?]</small></a>
															<span onclick="hideNameHint()" class="hint" id="nameHint"></span><br />
															
													Create a Username<small style="color:red;">*</small><br /><input type="text" name="userName" maxlength="15" <?php if (isset ($_GET['userName'])) echo "value=\"".$_GET['userName']."\"";?>/>
														<a style="color:lightgrey; text-decoration:none;" onclick="userNameHint()" href="#"><small>[?]</small></a>
															<span onclick="hideUserNameHint()" class="hint" id="userNameHint"></span><br />
															
													Enrollment Number<small style="color:red;">*</small><br /><input type="text" name="enNo" <?php if (isset ($_GET['enNo'])) echo "value=\"".$_GET['enNo']."\"";?>/><a style="color:lightgrey; text-decoration:none;" onclick="nameHint()" href="#"><small>[?]</small></a><span onclick="hideHint()" id="nameHint"></span><br />
													Current Semester<small style="color:red;">*</small><br /><input type="text" name="semester" <?php if (isset ($_GET['semester'])) echo "value=\"".$_GET['semster']."\"";?> maxlength="1"/><a style="color:lightgrey; text-decoration:none;" onclick="nameHint()" href="#"><small>[?]</small></a><span onclick="hideHint()" id="nameHint"></span><br />
													Mobile Number<br /><input type="text" name="mobNo" <?php if (isset ($_GET['mobno'])) echo "value=\"".$_GET['mobno']."\"";?>/><a style="color:lightgrey; text-decoration:none;" onclick="nameHint()" href="#"><small>[?]</small></a><span onclick="hideHint()" id="nameHint"></span><br />
													Branch<small style="color:red;">*</small><br /><input type="text" name="branch" <?php if (isset ($_GET['branch'])) echo "value=\"".$_GET['branch']."\"";?>/><a style="color:lightgrey; text-decoration:none;" onclick="nameHint()" href="#"><small>[?]</small></a><span onclick="hideHint()" id="nameHint"></span><br />
													Email Id<small style="color:red;">*</small><br /><input type="text" name="eMail"<?php if (isset ($_GET['eMail'])) echo "value=\"".$_GET['eMail']."\"";?> /><a style="color:lightgrey; text-decoration:none;" onclick="nameHint()" href="#"><small>[?]</small></a><span onclick="hideHint()" id="nameHint"></span><br />
													Password<small style="color:red;">*</small><br /><input type="password" name="password" /><a style="color:lightgrey; text-decoration:none;" onclick="nameHint()" href="#"><small>[?]</small></a><span onclick="hideHint()" id="nameHint"></span><br />
													Confirm Password<small style="color:red;">*</small><br /><input type="password" name="confirmPassword" /><a style="color:lightgrey; text-decoration:none;" onclick="nameHint()" href="#"><small>[?]</small></a><span onclick="hideHint()" id="nameHint"></span><br />
													Security Question<small style="color:red;">*</small><br /><input type="text" name="securityQuestion" <?php if (isset ($_GET['securityQuestion'])) echo "value=\"".$_GET['securityQuestion']."\"";?> /><a style="color:lightgrey; text-decoration:none;" onclick="nameHint()" href="#"><small>[?]</small></a><span onclick="hideHint()" id="nameHint"></span><br />
													Security Answer<small style="color:red;">*</small><br /><input type="text" name="securityAnswer" <?php if (isset ($_GET['securityAnswer'])) echo "value=\"".$_GET['securityAnswer']."\"";?> /><a style="color:lightgrey; text-decoration:none;" onclick="nameHint()" href="#"><small>[?]</small></a><span onclick="hideHint()" id="nameHint"></span><br />
													<input type="submit" value="Register"/><br />
												</form>
                                            </div>
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