<?php
$fileName="index.php";
if (session_start() && isset ($_SESSION['username']) && isset ($_SESSION['pass'])) {
    header("Location: index.php");
} else if($_GET['userName']=="") {
    $message="Please Provide the Username !";
    header("Location: forgotPassword.php?message=$message");
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

                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2">
                        <div class="hori_list">
                            <a href="index.php" class="link"><div class="hori_list_tab">Home</div></a>
                            <a href="examMenu.php" class="link"><div class="hori_list_tab">Exam Menu</div></a>
                            <a href="" class="link"><div class="hori_list_tab">Galary</div></a>
                            <a href="ExamRules.php" class="link"><div class="hori_list_tab">Exam Rules</div></a>
							<?php if (isset($examNote)) echo $examNote;?>
                            <a href="editExamNote.php" class="link"><div class="hori_list_tab">Tutorials</div></a>
                            <a href="" class="link"><div class="hori_list_tab">About</div></a>
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
                                    <td valign="top" align="left" width="86%" style="">
										<div style="width: inherit; height: 50px; border: 2px  #3D997A solid; padding:20px;">
                                            <?php
												if ($_GET['userName'] == $_SESSION['username']) {
													$username=$_SESSION['username'];
													echo "<b>".$_SESSION['username']."</b> is this you ? <br /><br /><a class=\"submitButton\" href=\"forgotPassword.php?userName=$username\">No</a> &nbsp; &nbsp;<a class=\"submitButton\" href=\"answerSecurityQuestion.php\">Yes</a>";
												} else {
													echo "<h1>Some Thing is missing or you've made some Bad Request !</h1>";
												}
											?>
                                        </div>
                                    </td>
                                    <td valign="top">
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td>

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