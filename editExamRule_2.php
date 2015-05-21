<?php
	$fileName="ExamRules.php";
    if( session_start() && (!isset ($_SESSION['pass']) || !isset ($_SESSION['username']))) {
		header("Location:index.php;");
	} else if (isset($_SESSION['maxQue'])) {
		header("Location: paper.php?qNo=1");
	} else {
        if (isset ($_SESSION['pic'])) {
            $p=$_SESSION['pic'];
            $pic="<a href=\"photoFrame.php?pic=$p\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        $logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>";
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
                        <?php
                            if (isset ($login)) {
                                echo $login;
                            } else {
                                echo $username;
                                echo $pic;
                                echo $logout;
                            }
                        ?>
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
                        </div>
                    </td>
                </tr>
                <tr>
                    <td id="content" colspan="2" valign="top">
                        <table align="center" border="0">
                            <tbody>
                                <tr>
                                    <td valign="top"></td>
                                    <td>
									<br />
									<div class="recentToppers">Rules for the Online Exam.</div>
											<?php
												$a= fopen("examRules.txt","r");
												$text="";
												while (!feof($a)) {
													$text.=fgets($a);
												}
												fclose($a);
												echo "<form method=\"post\" action=\"action.php?op=11\"><textarea name=\"txtRules\" style=\"font-size:15px;\" cols=\"70\" rows=\"20\">".$text."</textarea><br />";
											if(isset ($_SESSION['pass']) && isset ($_SESSION['username'])){
												echo "<input type=\"submit\" value=\"Ok\"> </form>";
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
