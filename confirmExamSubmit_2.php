<?php
if (session_start() && !(isset ($_SESSION['username']) && isset ($_SESSION['pass']))) {
		header("Location: login.php");
	} else {
			if (isset($_SESSION["examCode"])) {
			$examcode=$_SESSION["examCode"];
			$score=0;
			$left=0;
			$resStr="";
			for ($i=1; $i<=$_SESSION["maxQue"]; $i++) {
				$qstr="que".$i;
				if ($_SESSION[$qstr]['opt']=="0") {
					$left++;
					continue;
				} else if($_SESSION[$qstr]['ans']==$_SESSION[$qstr]['opt']) {
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
			require "connection.php";
			$sql="SELECT status FROM exams WHERE examcode='$examcode'";
			$res=mysql_query($sql) or die(mysql_error());
			$result=mysql_fetch_assoc($res);
			if($result["status"]!="Waiting") {
				header("Location: action.php?op=9");
			}
		} else {
				$message="Error 101- Something Went Wrong Please Contact Admin !";
				header("Location: errorPage.php?message=$message");
		}
		if (isset ($_SESSION['pic'])) {
            $user=$_SESSION['username'];
            $pic="<a href=\"student.php?username=$user\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        $logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>.<br />";
        $time="<b>".$_SESSION["category"]." </b><span style=\"font-family:'Arial'; color:black;\"> Test Started on- ".$_SESSION['day'].", ".$_SESSION['day1']."-".$_SESSION['month']."-".$_SESSION['year']." <b>".$_SESSION['hours'].":".$_SESSION['minutes'].":".$_SESSION['seconds']."</b>, Time Limit -<b>".$_SESSION["timeLimit"]." Minutes</b> </span>";
        $welcome="<b>Review your Attempted Questions & press the final Submission Button!</b><br />".$username;
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam - Save Tree, Paper and Time</title>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <script type="text/javascript" src="js/loadExamNote.js"></script>
    </head>
    <body>
        <table id="deep_table" border="0" align="center">
            <thead>
                <tr>
                    <td align="left" >
                        <a href="index.php"><img hspace="45px" src="images/logo1.png" width="300" height="150" title="eExam.co.in - Home" alt="logo"/></a>
                    </td>
                    <td align="right" width="65%" colspan="2">
                        <?php
                                echo $username;
                                echo $pic;
                                echo $logout;
                        ?>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                    <td align="left" valign="top">
                        <?php
                            echo "<b style=\"position:relative; top:0px; font-family: 'arial'; color:red;-weight:bold; font-size:25px;\">".$welcome."</b>";
							echo "<div style=\"position:relative;font-size:14px; font-family:'arial';\">".$time."</div>";
							?>
                    </td>						
					<td align="right">
						&nbsp;
					</td>
                </tr>
				<tr>
                    <td valign="top" id="content" colspan="3">
                     <table border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td valign="top">
                                        <table cellpadding="3px" border="1" width="600px" align="center">
											<tr>
												<td collspan="2"><b style="color:grey; font-family:'Calibri'; font-size:120%;">Exam Code- <?php echo$_SESSION["examCode"];?>, Time Limit- <?php echo$_SESSION["timeLimit"];?>, Max. Que- <?php echo$_SESSION["maxQue"];?></b></td>	
											</tr>
										</table>
										<table cellpadding="3px" border="1" width="600px" align="center">
											<tr>
												<td style="width:600px;"><?php echo$_SESSION['username'];?></td><td style="width:200px;"><?php echo$score;?></td>
											</tr>
										 </table>
										 <table cellpadding="10px" border="1" width="600px" align="center">
											<?php
												echo$resStr;
											?>
											<tr>
												<td colspan="5">
													<?php
														if($left!=0)
															echo "<span  style=\"color:red;\">You have <b>NOT</b> attempted all Questions Successfully! Want really to submit ?</span><br /><br /><a href=\"action.php?op=9\" class=\"submitButton\" style=\"background-color:red;\">Submit</a>";
														else if ($left==0)
															echo "<span  style=\"color:green;\">You have attempted all Questions <b>Successfully!</b> Want really to submit ?</span><br /><br /><a href=\"action.php?op=9\" class=\"submitButton\">Submit</a>";
													?>
												</td>
											</tr>
										 </table>
                                    </td>
 					<td valign="top" align="right">
						<div class="recentToppers" style="width:350px">
							Question Numbers
						</div>
						<div id="div2">
                            <?php
                               for ($i=1; $i<=$_SESSION['maxQue']; $i++) {
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