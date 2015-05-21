<?php
//$fileName="index.php";
if (session_start() && !($_SESSION['username']=="admin" )) {
		header("Location: login.php");
	} else {
        if (isset ($_SESSION['pic'])) {
            $p=$_SESSION['pic'];
            $pic="<a href=\"photoFrame.php?pic=$p\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        $logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>";
		$display="<div style=\"border: 2px #3D997A solid; border-radius: 10px; height:250px; padding:50px;\">
				<div style=\"font-family:'Arial'; line-height:22px;\">&#8594;It is the Note which will be shown to the students during exam. Student and Normal users don't have permission to edit it. Examiner or Admin can only change it before or during exam.</div>
						<div class=\"examNote\"><b style=\"color:black;\">Exam Note:&#8594; </b><span  id=\"examNote\"  style=\"color:red;\">examNote.txt</span></div>
						<a href=\"#\" id=\"editButton\" onclick=\"editExamNote()\">Edit</a>
									<a href=\"#\" id=\"okButton\" onclick=\"saveExamNote()\"></a>
					</div>";
						$examNote="<a href=\"\" class=\"link\"><div class=\"hori_list_tab\">Edit ExamNote</div></a>";
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam- Save Paper Save Tree</title>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <script type="text/javascript" src="js/loadExamNote.js"></script>
        <script type="text/javascript">
			function editExamNote() {
				document.getElementById('editButton').innerHTML="";
				document.getElementById('editButton').style.padding=0;
				document.getElementById('okButton').innerHTML="Ok";
				document.getElementById('okButton').style.padding=3+"px";
				document.getElementById('examNote').style.border=0+"px";
				loadExamNote(2);
			}
			function saveExamNote() {
				document.getElementById('okButton').innerHTML="";
				document.getElementById('okButton').style.padding=0;
				document.getElementById('editButton').innerHTML="Edit";
				document.getElementById('editButton').style.padding=3+"px";
				c=document.getElementById('editedExamNote').value;
				loadExamNote(c);
				loadExamNote(1);
			}
		</script>
		
    </head>
    <body  onload="loadExamNote(1)">
        <table id="deep_table" border="0" align="center">
            <thead>
                <tr>
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
                <tr>
                    <td colspan="2">
                        <div class="hori_list">
                            <a href="index.php" class="link"><div class="hori_list_tab">Home</div></a>
                            <?php if(isset($_SESSION['username'])) echo "<a href=\"inbox.php?username=".$_SESSION['username']."\" class=\"link\"><div class=\"hori_list_tab\">Inbox</div></a>";?>
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
										<?php
											echo $display;
										?>
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