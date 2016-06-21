<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta content="IE=edge" http-equiv="X-UA-Compatible">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<title>投票信息录入系统</title>
		<link crossorigin="anonymous" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" rel="stylesheet">
		<style type="text/css">
			* {
			font-family: "微软雅黑";
			}
		</style>

	</head>
	<body>
		<div class="container" style="margin-top:15px;">
			<!--<form action="action.php?action=addvoteinfo" method="POST" role="form">-->
				<legend class="text-center" style="font-size:16px;">
					<strong>杭州国际服务工程学院</strong>
					<br/>
					<strong>第五次团代会、第十六次学代会</strong>
					<br/>
					<br/>
					*代表投票信息注册系统
				</legend>
				<div class="form-group">
					<label for="">
						学号：
					</label>
					<span id="tips1"></span>
					<input class="form-control" id="stu_num" placeholder="请输入你的学号" type="text" name="stu_num" onkeyup="this.value=this.value.replace(/\D/g,'')"  onafterpaste="this.value=this.value.replace(/\D/g,'')">
					</input>
				</div>
				<div class="form-group">
					<label for="">
						姓名：
					</label>
					<span style="color:#FF0000;" id="tips2"></span>
					<input class="form-control" id="stu_name" placeholder="请输入你的姓名" type="text" name="stu_name" disabled="disabled" />
				</div>
				<div class="form-group">
					<label for="">
						班级：
					</label>
					<span style="color:#FF0000;" id="tips3"></span>
					<select class="form-control" name="stu_class" id='stu_class' onchange="checkclass()">
						<option value='0' selected="true" >
							==请选择班级==
						</option>
						<?php
						require_once "functions.php";
						$pdo = connectDb();
						$sql = "select * from class_info";
						$arr = $pdo -> query($sql);
						foreach ($arr as $row) {
							$_value = $row['class_id'];
							$_class = $row['class_name'];
							echo "<option value='{$_value}'>";
							echo $_class;
							echo '</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<span style="color:#FF0000;" id="tips4"></span>
					<label for="">
						联系方式：
					</label>
					<input maxlength="11" class="form-control" id="stu_mobile" placeholder="请输入你的手机（长号）" type="text" name="stu_mobile" onkeyup="this.value=this.value.replace(/\D/g,'')"  onafterpaste="this.value=this.value.replace(/\D/g,'')">
					</input>
				</div>

				<input id="submitvote" type="submit" name="stu_class" value="提交注册信息" type="submit" class="btn btn-info" style="width: 100%;" onclick="return check()">
			<!--</form>-->
			<div class="text-center" style="margin-top: 20px;">
				CopyRight @2016杭州国际服务工程学院第五次团代会、第十六次学代会筹备组版权所有
			</div>
		</div>
		
		
		<script>
			var pass1=false;
			var pass2=false;
			var pass3=false;
			var pass4=false;
			
			function check(){
				var v1=document.getElementById("stu_num").value;
				var v2=document.getElementById("stu_name").value;

				var myselect=document.getElementById("stu_class");
				var index=myselect.selectedIndex ;             // selectedIndex代表的是你所选中项的index
				var classvalue=myselect.options[index].value;
				var v3=classvalue;
				var v4=document.getElementById("stu_mobile").value;
				checkmobile(document.getElementById("stu_mobile").value)
				if(!pass1&&!pass2&&!pass3&&!pass4&&v1==""&&v3=='0'&&v4==""){
					alert('信息都不填写，还想提交？');
					return false;
				}
				else if(!pass1){
					alert('请先验证你的学号信息');
					return false;
				}
				else if(!pass3){
					alert("请选择你的班级");
					return false;
				}
				else if(!pass4){
					if(v4==""){
						alert("请填写你的手机号");
						return false;
					}
					else{
						alert("手机号输入有误，请重新输入");
					}
					return false;
				}
				else if(v2==""){
					alert("姓名不能为空");
					return false;
				}
				else{
					return true;
				}
			}
			
			
			document.getElementById("submitvote").onclick = function() {
				if(check()){
					var request = new XMLHttpRequest();
					request.open("POST", "action.php?action=addvoteinfo");
					
					var myselect=document.getElementById("stu_class");
					var index=myselect.selectedIndex ;             // selectedIndex代表的是你所选中项的index
					var classvalue=myselect.options[index].value;
					var data = "stu_num=" + document.getElementById("stu_num").value + "&stu_name=" + document.getElementById("stu_name").value + "&stu_class=" + classvalue + "&stu_mobile=" + document.getElementById("stu_mobile").value;
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					request.send(data);
					request.onreadystatechange = function() {
						if (request.readyState === 4) {
							if (request.status === 200) {
								alert("信息添加成功");
								//alert(request.responseText);
								window.location.href='vote_success.html';
								//alert("信息添加成功");
	//							document.getElementById("createResult").innerHTML = request.responseText;
							} else {
	//							alert("发生错误：" + request.status);
								//alert("失败");
							}
						}
					}
				}

			}
			
			function checkclass(){
				var myselect=document.getElementById("stu_class");
				var index=myselect.selectedIndex ;             // selectedIndex代表的是你所选中项的index
				var classvalue=myselect.options[index].value;
				if(classvalue!=0){
					pass3=true;					
				}
				else{
					pass3=false;
				}
			}
			function checkmobile(tel){
//				var reg = /^0?1[3|4|5|8][0-9]\d{8}$/;
//				if (reg.test(tel)) {
//					pass4=true;
//				}else{
//					pass4=false;
//				};
				if(tel.length==11){
					pass4=true;
				}
				else{
					pass4=false;
				}
			}
			document.getElementById("stu_num").onblur = function() {
				var request = new XMLHttpRequest();
				request.open("GET", "action.php?action=checknum&stu_num=" + document.getElementById("stu_num").value);
				request.onreadystatechange = function() {
					if (request.readyState === 4) {
						if (request.status === 200) {
							if(request.responseText.replace(/\s/g, "")=='0'){
								pass1=false;
								pass2=false;
								document.getElementById("tips1").innerHTML='学号输错了吧，国服还不存在学号为：\"'+document.getElementById("stu_num").value+'\"的学生。';
								document.getElementById("tips1").style.color="#FF0000";
								document.getElementById("tips2").innerHTML='名字验证失败，请先输入学号！';
								document.getElementById("tips2").style.color="#FF0000";
								document.getElementById("stu_name").value = null;
								document.getElementById("stu_name").focus();
							}
							else{
								pass1=true;
								pass2=true;
								document.getElementById("tips1").innerHTML='Hi!'+request.responseText+'你真棒，学号验证通过！';
								document.getElementById("tips1").style.color="#339933";
								document.getElementById("tips2").innerHTML='名字验证通过！若有误，请修改。';
								document.getElementById("tips2").style.color="#339933";
								document.getElementById("stu_name").value = request.responseText;
							}
							
						} else {
							pass1=false;
							pass2=false;

							alert("发生错误：" + request.status);
						}
					}
				}
				request.send();
			}
			

		</script>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js">
		</script>
		<!-- Bootstrap JavaScript -->
		<script crossorigin="anonymous" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">
		</script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="Hello World">
		</script>
	</body>
</html>