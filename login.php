<?php
    if(session_start() && isset ($_SESSION['username']) && isset ($_SESSION['pass'])){
        header("Location: index.php");
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
                    <td align="right" ></td>
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
                    <td id="content" align="center" valign="top" colspan="2">
						<div class="recentToppers" style="margin-top:10px; width:320px;">
						<img src="images/lock1.png" style="height:25px; float:left; margin-left:5px;"/>
							Login Here
						</div>
						<div style="padding: 10px; border-radius: 10px; margin-top: 5px; border: 2px  #3D997A solid; height: auto; width:300px;">
                                        <?php
                                            if(isset ($_GET['message']))    echo "<b style=\"color:red;\">".$_GET['message']."</b><br />";
                                        ?>
                                        <form method="post" action="action.php?op=1<?php if(isset($_GET['fromLocation'])) {$from=$_GET['fromLocation']; echo "&fromLocation=$from";}?>">
                                            User <input type="text" name="userName" value="" size="26"/>
                                            <br />
                                            Password
                                          <input type="password" name="password" value="" /><br />
                                            <input type="submit" value="Login" />
                                        </form>
                                        <a href="forgotPassword.php">Forgot Password</a><br /><a href="registerUser.php">Register</a>
						</div>
                    </td>
                </tr>
				<?php
					require("footer.txt");
				?>
            </tbody>
        </table>
    </body>
</html>