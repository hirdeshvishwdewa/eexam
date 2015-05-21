<?php
$fileName="index.php";
if (session_start() && isset($_SESSION['maxQue'])) {
		header("Location: paper.php?qNo=1");
	} else if(!(isset ($_SESSION['pass']) && isset ($_SESSION['username']))) {
		header("Location: login.php");
	} else {
        if (isset ($_SESSION['pic'])) {
            $user=$_SESSION['username'];
            $pic="<a href=\"student.php?username=$user\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        $logout="<div class=\"forgotPassword\"><a href=\"action.php?op=5\" title=\"Logout\">Logout</a> <a href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a></div>";
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
                <tr onclick="flush_result1()">
                    <td align="left" >
                        <a href="index.php"><img hspace="45px" src="images/logo1.png" width="300" height="150" title="eExam.co.in - Home" alt="logo"/></a>
                    </td>
                    <td align="right" >
						<div class="loginForm">
						<?php
							echo $username;
                            echo $pic;
                            echo $logout;
						?>
						</div>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <div class="hori_list">
                            <a href="index.php" class="link"><div class="hori_list_tab">Home</div></a>
                            <a <?php echo "href=\"inbox.php?username=".$_SESSION['username']."\"";?> class="link"><div class="hori_list_tab">Inbox</div></a>
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
                                    <td valign="top" align="left" width="100%" >
                                        <div class="recentToppers" style="width:150px;">
												Inbox
										</div>	
										<div style="border: 2px #3D997A solid; border-radius: 10px; height:300px; margin-top:4px;">
                                            <table width="100%" cellpadding="5" cellspacing="1">
											<?php
													require "connection.php";
													$user=$_SESSION["username"];
													$sql="SELECT examcode FROM users WHERE username='$user'";
													$res=mysql_query($sql) or die(mysql_error());
													$result=mysql_fetch_assoc($res);
													$code=$result["examcode"];
													$arr_code=explode("][",$code);
													$sql="SELECT examname,examcode,maxque,date,status,timelimit FROM exams ORDER BY examid DESC LIMIT 10";
													$res=mysql_query($sql) or die(mysql_error());
													$exam_str="";
													while($result=mysql_fetch_assoc($res)) {
														$i=0;
														while ($i<sizeof($arr_code)) {
															$maxque=$result["maxque"];
															$category=$result["examname"];
															$examcode=$result["examcode"];
															$date=$result["date"];
															$timelimit=$result["timelimit"];
															if($result["examcode"]==$arr_code[$i] && $result["status"]=="Waiting") {
																echo "<tr><td><a class=\"inbox_hori\" href=\"ExamRules.php?category=".$category."&maxQue=".$maxque."&timeLimit=".$timelimit."&examCode=".$examcode."\"><div class=\"inbox_slabs\">Quiz of <b>".$category."</b> on <b>".$date."</b> and Max Question Limit is ".$maxque."</div></a></td></tr>";
															}
															$i++;
														}
													}
													mysql_close($dbc);
											?>
											</table>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="width: inherit; height: 50px; border: 2px  #3D997A solid;" onclick="flush_result1()">
                                            
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