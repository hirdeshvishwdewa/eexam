<?php
$secs=0;
$mins=0;
$hours=0;
if (session_start() && !(isset ($_SESSION['username']) && isset ($_SESSION['pass']))) {
		header("Location: login.php");
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
					unset($_SESSION['nextlimit']);
					unset($_SESSION['examcode']);
					header("Location: action.php?op=9");
				}
				$examcode=$_SESSION["examcode"];
				$score=0;
				$left=0;
				$resStr="";
				for ($i=1; $i<=$_SESSION["maxque"]; $i++) {
					$qstr="que".$i;
					if ($_SESSION[$qstr]['opt']=="0") {
						$left++;
						continue;
					}
					else if($_SESSION[$qstr]['ans']==$_SESSION[$qstr]['opt']) {
						$score++;
					}
					if($i%2==0) $var="style=\"background-color:lightgrey;\"";
					else $var="style=\"background-color:white;\"";
					$resStr.="<tr ".$var.">
						<td colspan=\"5\"><b>Que(".$_SESSION[$qstr]['qno'].") ".$_SESSION[$qstr]['question']."</b></td>
						</tr>
						<tr ".$var.">
						<td>(1)".$_SESSION[$qstr]['op1']."</td>
						<td>(2)".$_SESSION[$qstr]['op2']."</td>
						<td>(3)".$_SESSION[$qstr]['op3']."</td>
						<td>(4)".$_SESSION[$qstr]['op4']."</td>
						<td>You Anserd-".$_SESSION[$qstr]['opt']."</td>
							</tr>";
				}
			} else {
					$message="Error 111- Dont have permissions to acces this page!";
					header("Location: errorPage.php?message=$message");
			}
		if (isset ($_SESSION['pic'])) {
            $user=$_SESSION['username'];
            $pic="<a href=\"student.php?username=$user\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        //$logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>.<br />";
        $time="<div id=\"clock\"></div>";
        $welcome="Review the Attempted Questions before final Submission Button!";
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam - Save Tree, Paper and Time</title>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <script type="text/javascript" src="js/loadExamNote.js"></script>
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
				clearInterval(myVar);
				document.getElementById("body").style.opacity=".75";				
				submitTest();
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
					<td>
					</td>
                    <td align="right" width="65%" colspan="2">
                        <?php
                                echo $username;
                                echo $pic;
                               // echo $logout;
                        ?>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                    <td align="left" valign="top" colspan="1">
                        <?php
                            echo "<b style=\"position:relative; top:0px; font-family: 'calibri','arial'; color:grey; font-size:25px;\">".$welcome."</b>";
							?>
                    </td>
					<td><b>Time Left -</b></td>
					<td align="right">
							<?php echo "<div style=\"position:relative;font-size:14px; font-family:'arial';\">".$time."</div>"; ?>
					</td>
                </tr>
				<tr>
					<td valign="top" colspan="3">
						<div class="recentToppers">
							Question Numbers
						</div>
						<div id="div2">
                            <?php
                               for ($i=1; $i<=$_SESSION['maxque']; $i++) {
									$qstr="que".$i;
									if($_SESSION[$qstr]["opt"]!=0) $optedOnes="style=\"background-color:#80CC99;\"";
										else if($_SESSION[$qstr]["opt"]==0) $optedOnes="style=\"background-color:#FF3333; color:white;\"";
										else $optedOnes="";
											echo "<a style=\"text-decoration:none;\" href=\"paper.php?qNo=".$i."\"><div class=\"que_button\" ".$optedOnes.">".$i."</div></a> ";
                                    }
                            ?>
                        </div>
					</td>
				</tr>
				<tr>
                    <td valign="top" id="content" colspan="3">
                     <table border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td valign="top" colspan="2">
                                        <table cellpadding="3px" border="1" width="100%" align="center">
											<tr>
												<td collspan="2"><b style="color:grey; font-family:'Calibri'; font-size:120%;">Exam Name- <?php echo$_SESSION["examName"];?></b></td>	
											</tr>
										</table>
										<table cellpadding="4px" border="1" width="100%" align="center">
											<tr>
												<td style="width:300px;"><b>Enrollment Id = </b><?php echo$_SESSION['enrollment'];?></td><td style="width:200px;">You attempted <b><?php echo ($_SESSION['maxque']-$left); ?></b>question out of <?php echo $_SESSION['maxque']; ?></td>
											</tr>
										 </table>
										 <table cellpadding="10px" border="1" width="100%" align="center">
											<?php
												echo$resStr;
											?>
											<tr>
												<td colspan="5">
													<?php
														if($left!=0)
															echo "<span  style=\"color:red;\">You have <b>NOT</b> attempted all Questions Successfully! Want really to submit ?</span><br /><br /><a href=\"action.php?op=9\" class=\"submitButton\" style=\"background-color:red;\">Submit</a>";
														else if ($left==0)
															echo "<span  style=\"color:green;\">You have attempted all Questions <b>Successfully!</b><br />Want really to submit ?</span><br /><br /><a href=\"action.php?op=9\" class=\"submitButton\">Submit</a>";
													?>
												</td>
											</tr>
										 </table>
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