<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			投票管理中心
		</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
th{
text-align: center;x
}
*{font-family: "微软雅黑";}
		</style>
		<script>//  	var password = prompt ( "请输入密码" , "" );
//  	if(password!='hise2016'){
//  		alert("密码错误");
//  		window.close();
//  	}
function doDel(id) {
	if (confirm("确定要删除吗？")) {
		window.location='action.php?action=del&id=' + id;
	}
}
</script>
	</head>
	<body>
		<?php //echo "<script>document.getElementById('tips1').value='frank';</script>";
		require_once "functions.php";
		function getToggle(){
			$pdo = connectDb();
			$sql = "select * from toggle";
			$rs = $pdo -> query($sql);
			//返回影响了多少行数据
			$arrData = $rs -> fetch(PDO::FETCH_ASSOC);
			//获取找到的数据
			if($arrData['toggle']=='0'){
				return FALSE;
			}
			else{
				return TRUE;
			}
		}
		
		if(getToggle()){
			$tips1 = '开启';
		}
		else{
			$tips1 = '关闭';
		}
		
		?>
		<div class="container" style="margin-top: 20px;">
				<legend class='text-center'>
					国服团委学生会换届选举投票系统<br/>
					后台管理中心
				</legend>
				<div class="form-group">
					<label>当前投票状态:</label>
					<strong>
						<span id="tips1" style="color:green;">
							<?php echo $tips1 ?>
						</span>
					</strong>
					<input id="toggle" type="button" class="form-control btn btn-default" id="" value='投票开关'/>
				</div>
				<div class="form-group">
					<label>初始化投票数据:</label>
					<strong>
						<span id="tips1" style="color:green;">
							
						</span>
					</strong>
					<input id="clear_info" type="button" class="form-control btn btn-default"  value='初始化'/>
				</div>
				<div class="form-group">
					<label>投票页面：</label>
					<strong>
						<span id="tips1" style="color:green;">
						</span>
					</strong>
					<a href="index.html" target="_blank">代表投票页面</a>
					<br/>
					<a href="../img/vote_qcode.png" target="_blank">【二维码，www.ifrank域名访问!!优先打开这个，微信可以正常访问】</a>
					<br/>
					<a href="../img/vote_qcode2.png" target="_blank">【二维码，ip域名访问，微信会有提示验证】</a>
					<br/>
					说明：如果二维码扫描出问题，可关注"杭师大国服小助理"发送"20160525"获取投票链接
				</div>
				<div class="form-group">
					<label>实时投票柱状图:</label>
					<strong>
						<span id="tips1" style="color:green;">
						</span>
					</strong>
					<a href="../vote_chart/chart4.html" target="_blank">实时动态图</a>

				</div>
				<div class="form-group">
					<label>已验证代表名单：</label>
					<strong>
						<span id="tips1" style="color:green;">
						</span>
					</strong>
					<a href="../vote_normal/list.php" target="_blank">已验证代表名单</a>
				</div>
				<div class="form-group">
					<label>未注册代表临时注册：</label>
					<strong>
						<span id="tips1" style="color:green;">
						</span>
					</strong>
					<a href="../vote_normal/index.php" target="_blank">临时注册</a>
					<br />

					<a href="../img/linshi_qcode.png" target="_blank">【二维码，www.ifrank域名访问!!优先打开这个，微信可以正常访问】</a>
					<br/>
					<a href="../img/linshi_qcode2.png" target="_blank">【二维码，ip域名访问，微信会有提示验证】</a>
				</div>

				<div class="form-group">
					<label>代表投票信息：</label>
					<strong>
						<span id="tips1" style="color:green;">
						</span>
					</strong>
					<a href="../vote_normal/vote_list.php" target="_blank">投票记录</a>
				</div>
				
				<div class="form-group">
					<label>投票结果数据：</label>
					<strong>
						<span id="tips1" style="color:green;">
						</span>
					</strong>
					<a href="../vote_hise/vote_result.php" target="_blank">投票结果票选（可大屏展示）</a>
				</div>
				
				<input type="submit" name="stu_class" value="2016年5月25日" type="submit" class="btn btn-success" style="width: 100%;">


			
			
			
		</div>
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script type="text/javascript">
		
		
			
			document.getElementById("toggle").onclick = function() {
				if(confirm("确定要开始投票吗？")){
					var request = new XMLHttpRequest();
				request.open("POST", "action.php?action=toggle");
					var data='';
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					request.send(data);
					request.onreadystatechange = function() {
	
						if (request.readyState === 4) {
							if (request.status === 200) {
								alert(request.responseText+'成功');
								document.getElementById("tips1").innerHTML=request.responseText;
							}
							
						}
					}
				}
				
			}
			
			document.getElementById("clear_info").onclick = function() {
				if(confirm("确定要初始化吗？")){
					var request = new XMLHttpRequest();
					request.open("POST", "action.php?action=iniVoteData");
					var data='';
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					request.send(data);
					request.onreadystatechange = function() {
	
						if (request.readyState === 4) {
							if (request.status === 200) {
								alert(request.responseText);
							}
						}
					}
				}
			}
		</script>
	</body>
</html>