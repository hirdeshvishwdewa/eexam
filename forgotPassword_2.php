<?php
//$fileName="index.php";
if (session_start() && isset($_SESSION['maxQue'])) {
		header("Location: paper.php?qNo=1");
	} else if((isset ($_SESSION['pass']) && isset ($_SESSION['username']))) {
		header("Location: login.php");
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
                                    <td valign="top" align="left" width="86%" style="">
										<div style="width: inherit; height: 50px; border: 2px  #3D997A solid; padding:20px;">
                                            <?php
											if (isset ($_GET['message']))   echo $_GET['message'];
										?>
										<form method="post" action="action.php?op=6">
											<b>Input UserName-</b><input type="text" name="userName" />
											<input type="submit" value="Submit" />
										</form>
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
                                            <!--<input style="position: absolute; top:65px; left:190px;" type="checkbox" id="catCheck" />-->
	</body>
</html>