<?php
if (session_start() && !(isset ($_SESSION['username']) && isset ($_SESSION['pass']))) {
		header("Location: login.php");
	} else {
			if (isset($_SESSION["examCode"])) {
			$examcode=$_SESSION["examCode"];
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
        $welcome="<b>Welcome User </b>".$username;
        $qno=$_GET['qNo'];
        $qstr="que".$qno;
		if ($_GET['qNo']=="" || $_GET['qNo']<0 || $_GET['qNo']>($_SESSION["maxQue"]+1)) {
			header("Location: paper.php?qNo=1");
		} else if ( $_GET['qNo']==($_SESSION["maxQue"]+1)) {
			$qno=$qno-1;
			header("Location: paper.php?qNo=$qno");
		}
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam - Save Tree, Paper and Time</title>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <script type="text/javascript" src="js/loadExamNote.js"></script>
    </head>
    <body onload="loadExamNote(1)">
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
                    <td colspan="" valign="top">
                        <div class="hori_list">
                            <a href="index.php" class="link"><div class="hori_list_tab">Home</div></a>
                            <a href="ExamRules.php" class="link"><div class="hori_list_tab">Exam Rules</div></a>
                            <a href="about.php" class="link"><div class="hori_list_tab">About</div></a>
						</div>
                    </td>
					<td align="left" valign="top">
                        <?php
                            echo "<b style=\"position:relative; top:0px; font-family: 'arial'; color:green;-weight:bold; font-size:25px;\">".$welcome."</b>";
							echo "<div style=\"position:relative;font-size:14px; font-family:'arial';\">".$time."</div>";
							?>
                    </td>						
                   <td align="right">
						<a class="submitButton" href="confirmExamSubmit.php">Submit Test</a>
					</td>
                </tr>
				<tr>
					<td colspan="3">
					<div class="examNote"><b style="color:black;">Exam Note:- </b><span style="color:red;" id="examNote">examNote.txt</span></div>
                    </td>
				</tr>
                <tr>
                    <td valign="top" id="content" colspan="3">
                     <table border="0" width="100%">
                            <tbody>
                                <tr>
                                    <td valign="top">
                                        <form method="post" action="action.php?op=8">
                                             <table border="0" id="table"  width="100%" style="color:black; font-family: 'arial'; font-size: 18px; ">
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
						<div class="recentToppers" style="width:350px">
							Question Numbers
						</div>
						<div id="div2">
                            <?php
                               for ($i=1; $i<=$_SESSION['maxQue']; $i++) {
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