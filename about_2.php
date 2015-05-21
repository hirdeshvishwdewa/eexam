<?php
$fileName="index.php";
if (session_start() && isset($_SESSION['maxQue'])) {
		header("Location: paper.php?qNo=1");
	} else if(!isset ($_SESSION['pass']) && !isset ($_SESSION['username'])) {
        $login="<b style=\"font-family:'Arial'; color:black;\">Login Here Now !</b><br />
		<form method=\"post\" action=\"action.php?op=1\">
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
            $p=$_SESSION['pic'];
            $pic="<a href=\"photoFrame.php?pic=$p\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        $logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>";
		$examNote="<a href=\"\" class=\"link\"><div class=\"hori_list_tab\">Edit ExamNote</div></a>";
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam- Save Paper Save Tree</title>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <script type="text/javascript" src="js/script1.js"></script>
		<script type="text/javascript" src="js/script2.js"></script>
    </head>
    <body>
        <table id="deep_table" border="0" align="center">
            <thead>
                <tr onclick="flush_result1()">
                    <td align="left" >
                        <a href="index.php"><img hspace="45px" src="images/logo1.png" width="300" height="150" title="eExam.co.in - Home" alt="logo"/></a>
                    </td>
                    <td align="right" >
						<div class="loginForm">
							 <?php
                            if (isset ($login)) {
                                echo $login;
                            } else {
                                echo $username;
                                echo $pic;
                                echo $logout;
                            }
                        ?>
						</div>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr onclick="flush_result1()">
                    <td colspan="2">
                        <div class="hori_list">
                            <a href="index.php" class="link"><div class="hori_list_tab">Home</div></a>
                            <a href="ExamRules.php" class="link"><div class="hori_list_tab">Exam Rules</div></a>
							<?php if (isset($examNote)) echo $examNote;?>
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
                                    <td valign="top" align="left" width="86%" >
                                        <div style="border: 2px #3D997A solid; border-radius: 10px; height: auto; padding:20px;">
                                            <div style="position: relative;">
                                                <h1>A Project By...</h1>
												<table style="color:black; font-weight:bold;" cellspacing="10px">
													<tr><td><img src="images/hirdesh.jpg" width="190px" align="top"/></td>
														<td valign="top">
															<span style="color:grey; font-size:140%;">Hirdeh Vishwdewa</span><br /><span style="font-weight:normal; color:green;">
															<b>Project Contribution-</b>
																<ul>
																	<li>Ideas</li>
																	<li>Algorithms</li>
																	<li>Designs</li>
																	<li>Database Designing</li>
																	<li>PHP-Mysql</li>
																	<li>Java Scripts</li>
																	<li>HTML, CSS, AJAX</li>
																</ul>
															</span>
														</td>
													</tr>
													<tr><td><img src="images/suraj.jpg" width="190px" align="top"/></td>
														<td valign="top">
															<span style="color:grey; font-size:140%;">Suraj Garg</span><br /><span style="font-weight:normal; color:green;">
															<b>Project Contribution-</b>
																<ul>
																	<li>Backend Development</li>
																	<li>Mysql</li>
																	<li>Algorithms</li>
																	<li>Database Designing</li>
																	<li>HTML, CSS, AJAX</li>
																</ul>
															</span>
														</td>
													</tr>
													<tr><td><img src="images/prateek.jpg" width="190px" align="top"/></td>
														<td valign="top">
															<span style="color:grey; font-size:140%;">Prateek Jain</span><br /><span style="font-weight:normal; color:green;">
															<b>Project Contribution-</b>
																<ul>
																	<li>HTML</li>
																	<li>CSS</li>
																	<li>JAVA SCRIPT</li>
																	<li>Design</li>
																</ul>
															</span>
														</td>
													</tr>
													<tr><td><img src="images/akki.jpg" width="190px" align="top"/></td>
														<td valign="top">
															<span style="color:grey; font-size:140%;">Akshay Suman</span><br /><span style="font-weight:normal; color:green;">
															<b>Project Contribution-</b>
																<ul>
																	<li>HTML</li>
																	<li>CSS</li>
																	<li>JAVA SCRIPT</li>
																	<li>Design</li>
																</ul>
															</span>
														</td>
													</tr>
												</table>
													<h1>Project Submited to...</h1>
													<em><b>Dr. Roopam Gupta</b><br>H.O.D. Information Technology Department<br>UIT RGPV, Bhopal</em><br><br>
													<b>Under the guidence of-</b>
													<ul>
														<li>Mr. Vikas Rohit</li>
														<li>Mr. Dhananjay Bisen</li>
													</ul>
													<center><em style="color:red;">Thanks to all faculty members and whole Department for a constant support.</em></center>
											</div>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div style="width: 200px;">
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