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
		if (isset($_SESSION["examcode"])) {
				$secs=$_SESSION['timelimit']-time();
				if($secs>0){
					$mins=$secs/60;
					$secs=$secs%60;
					$hours=intval($mins/60);
					$mins=$mins%60;
					//echo $hours.":".$mins.":".$secs;
				}else if($secs<=0){
					//unset($_SESSION['nextlimit']);
					//unset($_SESSION['examcode']);
					header("Location: action.php?op=9");
				}
		}
        if (isset ($_SESSION['pic'])) {
            $user=$_SESSION['username'];
            $pic="<a href=\"student.php?username=$user\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
		$time="<div id=\"clock\"></div>";
		$logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
         <title>eExam- Save Paper Save Tree</title>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <script type="text/javascript" src="js/timer.js"></script>
		<style>
		#clock {
			background-color:lightgreen;
			padding:7px;
			width:67px;
			font-family:"Calibri","Arial","Times New Roman", Times, serif;
			border-radius:5px;
			height:20px;
			border:1px solid green;
			color:green;
		}
	</style>
	<script type="text/javascript">
//alert("hi");

		var secs=<?php echo $secs;?>;
		var mins=<?php echo $mins; ?>;
		var hours=<?php echo $hours; ?>;
		var myVar = setInterval(function(){ myTimer() },1000);

		function myTimer()
		{
			////////////////////////////////////////////////////////////////////////
			if(hours==0 && mins<=4){
				document.getElementById("clock").style.color="white";
				document.getElementById("clock").style.backgroundColor="red";
			}
			////////////////////////////////////////////////////////////////////////
			if(hours>0 && mins>0 && secs>0) //e.g., 11:56:39
			{
				document.getElementById("clock").innerHTML=hours+":"+mins+":"+secs; secs--;
			}
			else if(hours>0 && mins>0 && secs==0) //e.g., 11:56:00
			{
				document.getElementById("clock").innerHTML=hours+":"+mins+":"+"00"; secs=59;	mins--;
			}
			else if(hours>0 && mins==0 && secs>0) //e.g., 11:00:39
			{
				document.getElementById("clock").innerHTML=hours+":"+mins+":"+secs; secs--;
			}
			else if(hours>0 && mins==0 && secs==0) //e.g., 11:00:00
			{
				document.getElementById("clock").innerHTML=hours+":00:00"; secs=59; mins=59; hours--;
			}
			else if(hours==0 && mins>0 && secs>0) //e.g., 00:56:39
			{
				document.getElementById("clock").innerHTML="00:"+mins+":"+secs; secs--;
			}
			else if(hours==0 && mins>0 && secs==0) //e.g., 00:56:00
			{
				document.getElementById("clock").innerHTML="00:"+mins+":00";	mins--;	secs=59;
			}
			else if(hours==0 && mins==0 && secs>0) //e.g., 00:00:39
			{
				document.getElementById("clock").innerHTML="00:00:"+secs;	secs--;
			}
			else if(hours==0 && mins==0 && secs==0) //e.g., 00:00:00
			{
				document.getElementById("clock").innerHTML="Time Out!";
				clearInterval(myVar);
			}
		}
		
</script>
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
                                //echo $logout;
                            }
                        ?>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="">
                        <div class="hori_list">
                            <a href="index.php" class="link"><div class="hori_list_tab">Home</div></a>
                            <a href="ExamRules.php" class="link"><div class="hori_list_tab">Exam Rules</div></a>
                            <a href="about.php" class="link"><div class="hori_list_tab">About</div></a>
                        </div>
                    </td>
                </tr>
				<tr>
					<td align="right">
						<?php if(isset($_SESSION['examcode'])) echo "Time Left:";?>
					</td>
					<td align="right">
						<?php if(isset($_SESSION['examcode'])) echo "<div style=\"position:relative;font-size:14px; font-family:'arial';\">".$time."</div>"; ?>
					</td>
				</tr>
                <tr>
                    <td id="content" colspan="2" valign="top">
                        <table align="center" border="0">
                            <tbody>
                                <tr>
                                    <td valign="top">
									</td>
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
											if (isset ($_GET['examid']) && isset ($_SESSION['pass']) && isset ($_SESSION['username']) && !isset($_SESSION['examid'])) {
												$examid=$_GET['examid'];
												if (isset($_GET["message"])) echo $_GET["message"];
												echo "Enter the Exam Code:-
														<form method=\"post\" action=\"action.php?op=3\">
														<input type=\"hidden\" name=\"examid\" value=\"".$examid."\" />
														<input name=\"examcode\" />
														<input type=\"submit\" style=\"padding:5px; height:40px; background-color:green; color:white; width:100px; text-shadow:1px 1px 1px black; box-shadow:5px 5px 30px grey; -moz-box-shadow:5px 5px 30px grey; border-radius:10px;\" value=\"Start!\"/>
													</form>";
												if ($_SESSION['username']=="admin") echo "&nbsp; <a class=\"submitButton\" href=\"editExamRule.php\">Edit</a>";
												
											} else if(isset ($_SESSION['pass']) && isset ($_SESSION['username']) && isset($_SESSION['examcode']) && !isset ($_GET['examid'])){
												echo "<a class=\"submitButton\" href=\"paper.php?qNo=1\">Back to Exam</a>";
												if ($_SESSION['username']=="admin") echo "&nbsp; <a class=\"submitButton\" href=\"editExamRule.php\">Edit</a>";
											} else if(isset ($_SESSION['pass']) && isset ($_SESSION['username']) && !isset($_SESSION['examcode']) && !isset ($_GET['examid'])){
												echo "<a class=\"submitButton\" href=\"index.php\">Select Exam</a>";
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
