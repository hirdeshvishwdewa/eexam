<?php
$fileName="student.php";
if (session_start() && isset($_SESSION['examcode'])) {
		header("Location: paper.php?qNo=1");	
	} else if(!(isset ($_SESSION['pass']) || isset ($_SESSION['username'])) ) {
		header("Location: login.php");
	} else if (!isset($_GET['username']) || $_GET['username']==""){
		header("Location: index.php");
	} else {
		require 'connection.php';
		$username=$_GET['username'];
		$sql="SELECT username,name,result,semester,enrollment,email,branch,mobno,profilepic FROM users WHERE username='$username'";
		$result=mysql_query($sql) or die(mysql_error());
		$found=mysql_fetch_assoc($result);
		$foundUserName=$found['username'];
		$result=$found['result'];
		$name=$found['name'];
		$semester=$found['semester'];
		$enroll=$found['enrollment'];
		$email=$found['email'];
		$branch=$found['branch'];
		$mobno=$found['mobno'];
		$profilepic=$found['profilepic'];
		mysql_close($dbc);
		if ($foundUserName==$username && ($username==$_SESSION["username"] || $_SESSION["username"]=="admin")) {
			if (isset ($_SESSION['pic'])) {
				$user=$_SESSION['username'];
				$pic="<a href=\"student.php?username=$user\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
			} else {
				$pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
			}
			$username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
			$logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>";
		} else {
			$message="Either You Are Looking For An Unknown User Or Other User's Info !";
			header ("Location: errorPage.php?message=$message");
		}
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam- Save Paper Save Tree</title>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <script type="text/javascript" src="js/student.js"></script>
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
                            <a href="inbox.php" class="link"><div class="hori_list_tab">Inbox</div></a>
                            <a <?php echo "href=\"student.php?username=".$foundUserName."\""; ?> class="link"><div class="hori_list_tab">Profile</div></a>
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
                                    <td valign="top" align="left" width="100%">
                                                <div style="">
													<b style="position:relative; top:0px; font-family: 'arial'; color:green; font-size:25px;">
															<?php
																if($user!="admin") echo"Student-";
																else if($user=="admin")	echo"Admin-";
															?>
															<span style="font-family:'Arial'; color:black;"><?php echo $name;?></span><br />
													</b>
												</div>
									</td>
								</tr>
								<tr>
									<td>
                                        <div style="position:relative;border-radius: 10px; height: auto; padding:20px;  width:95%; font-family:'Arial'; font-size: 14px;">
												<?php
											if ($profilepic!="") {
												echo "<img src=\"user_pics/".$_SESSION['pic']."\" width=\"200px\" height=\"250px\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" />";
											}
										?>
												<div style="position:relative; top:10px; height: 350px; font-size:16px; font-family:'Arial'; color:black;" id="profile">
													<input type="hidden"  value="<?php echo $foundUserName; ?>" id="username"/>
													<div><a href="#" class="submitButton" onclick="editProfile()">Edit Profile</a></div><br />
													<table cellspacing="5px" cellpadding="5px">
														<tr><td><b style="color:green;">Name</b></td><td><?php echo $name; ?></td></tr>
														<tr><td><b style="color:green;">Username</b></td><td><?php echo $foundUserName; ?></td></tr>
														<tr><td><b style="color:green;">Branch</b></td><td><?php echo $branch;?></td></tr>
														<tr><td><b style="color:green;">Enrollment Number</b></td><td><?php echo $enroll;?></td></tr>
														<tr><td><b style="color:green;">Semester</b></td><td><?php echo $semester;?></td></tr>
														<tr><td><b style="color:green;">Email Id</b></td><td><?php echo $email;?></td></tr>
														<tr><td><b style="color:green;">Mobile Number</b></td><td><?php echo $mobno;?></td></tr>
														<tr><td colspan="2"><b style="color:blue;"><?php if(isset($_GET["message"])) echo $_GET["message"]; ?></b></td></tr>
													</table>
												</div>
										</div>
									</td>
								</tr>
								<!--<tr>
									<td>
												<b>Results-</b>
												<table border="1" cellpadding="15" width="30%">
													<tr>
														<th>Subject</th>
														<th>Marks</th>
													</tr>
													<?php
														if($result!=NULL || $result!="") {
															$arr=explode("=",$result);
															$i=0;
															while ($i<sizeof($arr)){
																echo "<tr>
																	<td align=\"center\">".$arr[$i]."</td>
																	<td align=\"center\">".$arr[++$i]."</td>
																  </tr>";
																  $i++;
															}
														}	else {
																echo "<tr>
																		<td colspan=\"2\" align=\"center\">Test Results Not Available !</td>
																	  </tr>
																	 ";
														}
													?>
												</table>
                                    </td>
                                </tr>-->
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