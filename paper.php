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
					//unset($_SESSION['nextlimit']);
					//unset($_SESSION['examcode']);
					header("Location: action.php?op=9");
				}
			} else {
					$message="Error 112- Something Went Wrong Please Contact Admin !";
					header("Location: index.php?message=$message");
			}
		if (isset ($_SESSION['pic'])) {
            $user=$_SESSION['username'];
            $pic="<a href=\"student.php?username=$user\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        //$logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>.<br />";
        $welcome=$_SESSION['examName'];
        $qno=$_GET['qNo'];
        $qstr="que".$qno;
		if ($_GET['qNo']=="" || $_GET['qNo']<0 || $_GET['qNo']>($_SESSION["maxque"]+1)) {
			header("Location: paper.php?qNo=1");
		} else if ( $_GET['qNo']==($_SESSION["maxque"]+1)) {
			$qno=$qno-1;
			header("Location: paper.php?qNo=$qno");
		}
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam - Save Tree, Paper and Time</title>
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
				document.getElementById("clock").innerHTML="00:"+mins+":00"; mins--;	secs=59;
			}
			else if(hours==0 && mins==0 && secs>0) //e.g., 00:00:39
			{
				document.getElementById("clock").innerHTML="00:00:"+secs;	secs--;
			}
			else if(hours==0 && mins==0 && secs==0) //e.g., 00:00:00
			{
				clearInterval(myVar);
				//alert("Over!");
				document.getElementById("body").style.opacity=".75";
				document.getElementById("loading").style.visibility="visible";
				submitTest();
			}
		}
		
		</script>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <script type="text/javascript" src="js/loadExamNote.js"></script>
    </head>
    <body onload="loadExamNote(1)">
		<div id="loading" style="position:absolute; z-index:1; visibility:hidden; width:500px; height:250px; background:url('images/loading3.gif'); background-repeat:no-repeat;">
			
		</div>
        <table id="deep_table" border="0" align="center" id="body">
			<thead>
                <tr>
                    <td align="left" >
                        <a href="index.php"><img hspace="45px" src="images/logo1.png" width="300" height="150" title="eExam.co.in - Home" alt="logo"/></a>
                    </td>
                    <td align="right" width="65%" colspan="2">
                        <?php
                                echo $username;
                                echo $pic;
                                //echo $logout;
                        ?>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="" valign="top">
                        <div class="hori_list">
                            <a href="ExamRules.php" class="link"><div class="hori_list_tab">Exam Rules</div></a>
						</div>
                    </td>
					<td align="right" valign="top" colspan="2">
						<a class="submitButton" href="confirmExamSubmit.php">Submit Test</a>                        
                    </td>						
                   <td align="right">
					</td>
                </tr>
				<tr>
					<td align="left" colspan="1">
						<?php echo "<b style=\"position:relative; top:0px; font-family: 'arial'; color:green;-weight:bold; font-size:25px;\">".$welcome."</b>"; ?>
					</td>
					<td align="right">Time Left:</td>
					<td align="right">
						<div id="clock"></div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
					<div class="examNote"><b style="color:black;">Exam Note:- </b><span style="color:red;" id="examNote">examNote.txt</span></div>
                    </td>
				</tr>
                <tr>
                    <td valign="top" id="content" colspan="3" style="width:100%;">
                     <table border="0">
                            <tbody>
                                <tr>
                                    <td valign="top" style="width:800px;">
                                        <form method="post" action="action.php?op=8">
                                             <table border="0" id="table"  style="color:black; font-family: 'arial'; font-size: 18px; ">
                                                 <tr><td><b>Que<?php echo "(".$_SESSION[$qstr]['qno'].")</b> ".$_SESSION[$qstr]['question'] ?></td></tr>
                                                 <tr>
                                                     <td><br />
                                                         (a)<input type="checkbox" name="op[]" value="1" <?php if (in_array("1", explode(" ", $_SESSION[$qstr]["opt"]))>0) echo "checked"; else echo " "; ?> /> <?php echo $_SESSION[$qstr]['op1'] ?>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td><br />
                                                         (b)<input type="checkbox" name="op[]" value="2" <?php if (in_array("2", explode(" ", $_SESSION[$qstr]["opt"]))>0) echo "checked"; else echo " "; ?> /> <?php echo $_SESSION[$qstr]['op2'] ?>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td><br />
                                                         (c)<input type="checkbox" name="op[]" value="3" <?php if (in_array("3", explode(" ", $_SESSION[$qstr]["opt"]))>0) echo "checked"; else echo " "; ?> /> <?php echo $_SESSION[$qstr]['op3'] ?>
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td><br />
                                                         (d)<input type="checkbox" name="op[]" value="4" <?php if (in_array("4", explode(" ", $_SESSION[$qstr]["opt"]))>0) echo "checked"; else echo " "; ?> /> <?php echo $_SESSION[$qstr]['op4'] ?>
                                                         <br />
														 <input type="hidden" name="qno" value="<?php echo $qno; ?>" />
                                                     </td>
                                                 </tr>
                                                 <tr>
                                                     <td>
                                                         <input type="submit" value="Answer" />
                                                     </td>
                                                 </tr>
                                             </table>
                                        </form>
                                    </td>
									<td valign="top" align="right">
										<div class="recentToppers">
											Question Numbers
										</div>
										<div id="div2">
											<?php
											   for ($i=1; $i<=$_SESSION['maxque']; $i++) {
													$qstr="que".$i;
													if($_SESSION[$qstr]["opt"]!=0) $optedOnes="style=\"background-color:#80CC99;\"";
														else if($_SESSION[$qstr]["opt"]==0 && $i<$qno) $optedOnes="style=\"background-color:#FF3333; color:white;\"";
														else $optedOnes="";
															echo "<a style=\"text-decoration:none;\" href=\"paper.php?qNo=".$i."\"><div class=\"que_button\" ".$optedOnes.">".$i."</div></a> ";
													}
											?>
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