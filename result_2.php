<?php
$fileName="result.php";
if (session_start() && isset($_SESSION['maxQue'])) {
		header("Location: paper.php?qNo=1");
	} else if(!(isset ($_SESSION['pass']) || isset ($_SESSION['username']))) {
		header("Location: login.php");
    } else {
        if (isset ($_SESSION['pic'])) {
            $user=$_SESSION['username'];
            $pic="<a href=\"student.php?username=$user\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        $logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>";
		if (isset($_GET['result'])) {
			$result=$_GET['result'];
			$display="<div style=\"border: 2px #3D997A solid; border-radius: 10px; padding:20px; height:260px;\">
						<div style=\"position: absolute; background-color:lightgreen; padding:20px; border-radius: 10px; border: 2px #3D997A solid;\">
							<b>Last test Result-</b>"."You'd got ".$result." marks in this Test !"."
						</div>
                      </div>
					";
		} else {
			$display="<div style=\"border: 2px #3D997A solid; border-radius: 10px; height:300px;\">
						<div style=\"position: absolute; padding:50px;\">
							<h1 style=\"color:red;\">Unknown Link !</h1>
						</div>
                      </div>
					";
		}
		if ($_SESSION['username']=="admin") {
					$examNote="<a href=\"\" class=\"link\"><div class=\"hori_list_tab\">Edit ExamNote</div></a>";
        }
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
                <tr>
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
                <tr onclick="flush_result1()">
                    <td colspan="2">
                        <div class="hori_list">
                            <a href="index.php" class="link"><div class="hori_list_tab">Home</div></a>
                            <a href="ExamRules.php" class="link"><div class="hori_list_tab">Exam Rules</div></a>
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
											if (isset($_SESSION['username']) && ($_SESSION['username']=="admin")) {
												echo $display;
											} else if(isset($_SESSION['pass']) && !($_SESSION['username']=="admin")) {
												echo $display;
											} else {
												echo $display;
											}
										?>
                                    </td>
                                    <td valign="top">
                                        <div style="width: 200px;">
                                            <div class="recentToppers">
                                                Recent Toppers
                                            </div>
                                            <div style="padding: 10px; border-radius: 10px; margin-top: 5px; border: 2px  #3D997A solid; height: auto; width:200px;">
                                                
                                            </div>
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