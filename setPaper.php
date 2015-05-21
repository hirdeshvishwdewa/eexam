<?php
//$fileName="setPaper.php";
if (session_start() && isset($_SESSION['maxQue'])) {
		header("Location: paper.php?qNo=1");
	} else if(!(isset ($_SESSION['pass']) && isset ($_SESSION['username']))) {
		header("Location: login.php");
    } else if ($_SESSION['username']!="admin") header("Location: index.php");
		if (isset ($_SESSION['pic'])) {
            $user=$_SESSION['username'];
            $pic="<a href=\"student.php?username=$user\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
		$examNote="<a href=\"editexamNote.php\" class=\"link\"><div class=\"hori_list_tab\">Edit ExamNote</div></a>";
		$username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        $logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a>&nbsp;<a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">ChangePassword</a>";
        
?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam- Save Paper Save Tree</title>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <script type="text/javascript" src="js/loadList.js"></script>
		<script type="text/javascript">
			function initExam() {
				//alert("1");
				var examname=document.getElementById("examName");
				var examname=examname.value;
				//alert(examname1);
				var examdate=document.getElementById("examDate");
				examdate=examdate.value;
				var semester=document.getElementById("semester");
				semester=semester.value;
				var maxque=document.getElementById("maxQue");
				maxque=maxque.value;
				var examtimelimit=document.getElementById("examTimeLimit");
				examtimelimit=examtimelimit.value;
				var examstatus=document.getElementById("examStatus");
				examstatus=examstatus.value;
				//alert(examstatus);
				var ajaxRequest;
					 try{  
					   ajaxRequest = new XMLHttpRequest();
					 }catch (e){
					   try{
						  ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
					   }catch (e) {
						  try{
							 ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
						  }catch (e){
							 alert("Please, Update Your Browser !");
							 return false;
						  }
					   }
					 }
					 ajaxRequest.onreadystatechange = function(){
					   if(ajaxRequest.readyState ==4 && ajaxRequest.status==200){
						  loadListExam(0);
						  window.open("../eExam.co.in/timer.php","Timer","scrollbars=no,width=250,height=200");
					   }
					 }
						var queryString="&examName="+examname+"&examDate="+examdate+"&semester="+semester+"&maxQue="+maxque+"&examTimeLimit="+examtimelimit+"&examStatus="+examstatus;
						alert(queryString);
						ajaxRequest.open("GET", "action.php?op=12"+queryString, true);
						ajaxRequest.send();
			}
		</script>
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
                <tr onclick="flush_result1()">
                    <td colspan="2">
                        <div class="hori_list">
                            <a href="index.php" class="link"><div class="hori_list_tab">Home</div></a>
                            <?php if(isset($_SESSION['username'])) echo "<a href=\"inbox.php?username=".$_SESSION['username']."\" class=\"link\"><div class=\"hori_list_tab\">Inbox</div></a>";?>
                            <a href="examMenu.php" class="link"><div class="hori_list_tab">Exam Menu</div></a>
                            <a href="" class="link"><div class="hori_list_tab">Galary</div></a>
                            <a href="ExamRules.php" class="link"><div class="hori_list_tab">Exam Rules</div></a>
							<?php if (isset($examNote)) echo $examNote;?>
                            <a href="editExamNote.php" class="link"><div class="hori_list_tab">Tutorials</div></a>
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
                                    <td valign="top" align="left" width="35%" >
										<div style="border: 2px #3D997A solid; border-radius: 10px; height:350px; padding:0px;">
											<table align="left" height="100%" cellpadding="1" cellspacing="0">
												<tr>
												<td valign="top">
													<div class="recentToppers" style="position:relative; width:200px;">
														Set An Exam
													</div>
												</td>
												</tr>
												<tr>
												<td valign="top">
													<table align="left">
														<tr><td>Exam Name</td><td><input type="text" maxlength="30" id="examName"/></td></tr>
														<tr><td>Exam Date</td><td><input type="text" maxlength="10" id="examDate"/></td></tr>
														<tr><td>Semester</td><td><input type="text" maxlength="1" id="semester"/></td></tr>
														<tr><td>Maximum Questions</td><td><input type="text" maxlength="2" id="maxQue"/></td></tr>
														<tr><td>Time Limit</td><td><input type="text" maxlength="3" value="60" id="examTimeLimit"/></td></tr>
														<tr><td>Exam Status</td><td><input type="text" maxlength="20" value="Waiting" id="examStatus"/></td></tr>
														<tr><td><input type="button" onclick="initExam()" value="Create" /></td></tr>
													</table>
												</td>
												</tr>
											</table>
										</div>
                                    </td>
									<td valign="top" align="left" width="50%" >
										<div style="border: 2px #3D997A solid; border-radius: 10px; height:350px; overflow:scroll;">
											<div style="position:absolute; background-color:lightblue; width:56.8%; border-radius: 10px;">
									<b>Select Semester=></b>
										<select onchange="loadListExam(this.value)" onload="loadListExam(this.value)" id="semester" size="1" style="width:150px;">
											<option value="0">Select Semester</option>
											<option value="1">1st Sem</option>
											<option value="2">2nd Sem</option>
											<option value="3">3rd Sem</option>
											<option value="4">4th Sem</option>
											<option value="5">5th Sem</option>
											<option value="6">6th Sem</option>
											<option value="7">7th Sem</option>
											<option value="8">8th Sem</option>
										</select>
										<table border="1" width="100%" cellpadding="10">
											<tr>
												<th width="5%">Exam Id</th>
												<th width="40%">Exam Name</th>
												<th width="10%">Sem</th>
												<th width="10%">Maximum Questions</th>
												<th width="15%">Date</th>
												<th width="15%">Status</th>
												<th width="5%">Delete All<input type="checkbox" onclick="deleteAllExams()"/></th>
											</tr>
										</table>
									</div>
						<table border="1" width="100%" cellpadding="10" style="margin-top:90px;" id="allExamDisplay">
							<tbody id="resultDisplay">
								<?php
									require("connection.php");
									$res=mysql_query("SELECT examid, examname, semester, maxque, date, status FROM exams ORDER BY examid DESC LIMIT 10") or die(mysql_error());
									while($result=mysql_fetch_assoc($res)) {
										$style="style=\"color:red; text-decoration:none;\"  onclick=\"doComplete(".$result["examid"].")\"";
										if ("Completed"==$result["status"])		{	$style="style=\"color:green; text-decoration:none;\"";}
										echo "<tr>
												<td  width=\"5%\">".$result["examid"]."</td>
												<td  width=\"50%\">".$result["examname"]."</td>
												<td  width=\"50%\">".$result["semester"]."</td>
												<td  width=\"10%\">".$result["maxque"]."</td>
												<td  width=\"15%\">".$result["date"]."</td>
												<td  width=\"15%\"><a href=\"#\" ".$style." id=\"".$result["examid"]."\"><b>".$result["status"]."...</b></td>
												<td  width=\"5%\"></td>
											 </tr>";
									}
								?>
							</tbody>
						</table>
					</div>
										</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div style="width: inherit; height: auto; border: 2px  #3D997A solid; padding:2px;">
                                            <b style="color:red;">Notes On Seting An Exam:-</b>
												<ol>
													<li><b>Exam Name</b> should be same as that of its Question's <b>Category</b> in <b>Questions</b> Table.</li>
													<li><b>Exam Date</b> should strictly be in <b>YYYY-MM-DD</b> Format.</li>
													<li>Value of <b>Semester</b> should strictly be a one digit <b>(1-8)</b> Number.</li>
													<li>Value Of <b>Time Limit</b> of exam should strictly be in <b>Minutes</b>.</li>
													<li>At the time of Creation <b>Status</b> of exam should strictly be <b>Waiting</b>.</li>
												</ol>
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