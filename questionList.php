<?php
//$fileName="index.php";
if (session_start() && isset($_SESSION['maxQue'])) {
		header("Location: paper.php?qNo=1");
	} else if(!(isset ($_SESSION['pass']) || isset ($_SESSION['username']))) {
		header("Location: login.php");
    } else if ($_SESSION['username']=="admin") {

		if (isset ($_SESSION['pic'])) {
            $p=$_SESSION['pic'];
            $pic="<a href=\"photoFrame.php?pic=$p\"><img src=\"user_pics/".$_SESSION['pic']."\" width=\"62\" height=\"75\" alt=\"".$_SESSION['username']."\" title=\"".$_SESSION['username']."\" /><a/><br />";
        } else {
            $pic="<a href=\"fileUpload.php\"><img src=\"user_pics/default1.png\" width=\"62\" height=\"60\" alt=\"Default\" title=\"Uplaod Your Pic !\"/></a><br />";
        }
		$examNote="<a href=\"\" class=\"link\"><div class=\"hori_list_tab\">Edit ExamNote</div></a>";
		$username="<b style=\"font-family:'Arial'; color:black;\">".$_SESSION['username']."</b><br />";
        $logout="<a style=\"font-family:'Arial'; color:grey;\" href=\"action.php?op=5\" title=\"Logout\">Logout</a><br /><a style=\"font-family:'Arial'; color:grey;\" href=\"resetPasswordKnown.php\" title=\"Change Password\">Change Password</a>";
        
		}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>eExam- Save Paper Save Tree</title>
        <link type="text/css" rel="stylesheet" href="styles/style.css" />
        <script type="text/javascript" src="js/loadList.js"></script>
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
                                    <td valign="top" align="left" width="100%" >
										<div style="border: 2px #3D997A solid; border-radius: 10px; height:350px; padding:0px; overflow:scroll;">
										<div style="position:absolute; background-color:lightblue; width:96.4%; border-radius: 10px; padding:2px;">
									<b>Input Question Category=></b><select onclick="loadListQuestion(this.value)" onchange="loadListQuestion(this.value)" id="category" size="1" style="width:150px;">
										<option value="none">Select</option>
										<option value="All">All</option>
										<?php
											require "connection.php";
											$sql="SELECT category FROM questions";
											$res=mysql_query($sql) or die(mysql_error());
											$arr=array();
											while ($result=mysql_fetch_assoc($res)) {
												$cat=$result['category'];
												$i=0; $flag=1;
												if(sizeof($arr)!=0) {
												while($i<sizeof($arr)) {
													if($cat!=$arr[$i]) {
														$flag=0;
														$i++;
													} else {
														break;
													}
												} if($flag==0) {
													$index=sizeof($arr);
													$arr[$index]=$cat;
													echo "<option value=\"".$arr[$index]."\">".$arr[$index]."</option>";
												}
											} else {
												$arr[0]=$cat;
												echo "<option value=\"".$arr[0]."\">".$arr[0]."</option>";
											}
											}
											mysql_close($dbc);
										?>
										</select>
										<table border="1" width="100%" cellpadding="10">
											<tr>
												<td width="5%">qId</td>
												<td width="45%">Question</td>
												<td width="10%">Option1</td>
												<td width="10%">Option2</td>
												<td width="10%">Option3</td>
												<td width="10%">Option4</td>
												<td width="5%">Answer</td>
												<td width="5%">Delete All<input type="checkbox" title="Delete All Questions" onclick="deleteAllQues()" /></td>
											</tr>
										</table>
									</div>
						<table border="1" width="100%" cellpadding="10" style="margin-top:90px;" id="allQueDisplay">
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
            </tbody>
        </table>
	</body>
</html>