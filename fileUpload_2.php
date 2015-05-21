<?php
if (session_start() && isset($_SESSION['maxQue'])) {
		header("Location: paper.php?qNo=1");
	} else if(!(isset ($_SESSION['pass']) && isset ($_SESSION['username']))) {
		header("Location: login.php");
    } else {
        if (isset ($_SESSION['pic'])) {
			$username=$_SESSION['username'];
            $pic="<a href=\"student.php?username=$username\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
        $username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        $logout="<a style=\"font-family:'Arial'; color:grey; font-size:14px;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a> <a style=\"font-family:'Arial'; color:grey; font-size:14px\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>";
		$inbox="<a href=\"inbox.php?username=".$_SESSION['username']."\"class=\"link\"><div class=\"hori_list_tab\">Inbox</div></a>";
		$profile="<a href=\"student.php?username=".$_SESSION['username']."\"class=\"link\"><div class=\"hori_list_tab\">Profile</div></a>";
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
                <tr>
                    <td colspan="2">
                        <div class="hori_list">
                            <a href="index.php" class="link"><div class="hori_list_tab">Home</div></a>
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
                                        <div style="border: 2px #3D997A solid; border-radius: 10px; height:150px; padding:50px;">
                                            <div style="position:relative; border: 2px #3D997A solid; border-radius: 10px; padding:50px; width:450px;">
                                                <form action="upload_file.php" method="post" enctype="multipart/form-data">
													<input type="hidden" name="username" value="<?php echo $_SESSION['username'];?>"/>
												<label for="file">Upload:</label>
												<input type="file" name="file" id="file"><br>
												<input type="submit" name="submit" value="Submit">
												</form>
												<b style="color:red;">Note-</b>Size of your pic must be <=50 Kb<br />
												<b style="color:red;">Note-</b>File Formats must Strictly be-.gif, .png, .jpg, .jpeg
											</div>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div style="width: 200px;">
                                        </div>
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
