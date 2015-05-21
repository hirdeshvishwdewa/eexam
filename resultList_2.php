<?php
$fileName="resultList.php";
if (session_start() && !($_SESSION['username']=="admin" )) {
		header("Location: login.php?fromLocation=$fileName");
	} else {
        if (isset ($_SESSION['pic'])) {
            $p=$_SESSION['pic'];
            $pic="<a href=\"photoFrame.php?pic=$p\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        $logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>";
		$examNote="<a href=\"editExamNote.php\" class=\"link\"><div class=\"hori_list_tab\">Edit ExamNote</div></a>";
		$resultList="<a href=\"resultList.php\" class=\"link\"><div class=\"hori_list_tab\">Result List</div></a>";
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam- Save Paper Save Tree</title>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
		<script type="text/javascript" src="js/loadList.js">			
		</script>
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
                            <a href="ExamRules.php" class="link"><div class="hori_list_tab">Exam Rules</div></a>
							<?php if (isset($examNote) ||isset($resultList)) echo $examNote." ".$resultList; ?>
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
										<div style="border: 2px #3D997A solid; border-radius: 10px; height:350px; padding:0px; overflow:scroll;">
										<div style="position:absolute; background-color:lightblue; width:83%; border-radius: 10px; padding:2px;">
									<b>Select Semester=></b><select onchange="loadListStudent(this.value)" id="semester" size="1">
										<option value=""></option>
										<option value="1">1st</option>
										<option value="2">2nd</option>
										<option value="3">3rd</option>
										<option value="4">4th</option>
										<option value="5">5th</option>
										<option value="6">6th</option>
										<option value="7">7th</option>
										<option value="8">8th</option>
									</select>
									</div>
						<table border="1" width="100%" cellpadding="10" style="margin-top:28px;">
							<tbody id="resultDisplay"></tbody>
						</table>
					</div>
                                    </td>
                                    <td valign="top">
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div style="width: inherit; height: 50px; border: 2px  #3D997A solid;">
                                            
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