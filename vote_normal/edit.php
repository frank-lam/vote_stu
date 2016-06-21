<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<title>
			编辑信息
		</title>
	</head>
	<body>

			<?php /**
			 * Created by PhpStorm.
			 * User: Administrator
			 * Date: 2016/3/28
			 * Time: 8:21
			 */
			require_once "functions.php";

			$pdo = connectDb();
			if (!empty($_GET['id']) && isset($_GET['id'])) {
				$id = $_GET['id'];

			} else {
				echo "<script>window.location='list.php'</script>";
				echo "ID未设置";
				echo "";
			}

			//2.拼SQL语句，取信息
			$sql = "select * from vote_person_info where vote_id=".$_GET['id'];
			$stmt = $pdo -> query($sql);
			if ($stmt -> rowCount() > 0) {
				$stu = $stmt -> fetch(PDO::FETCH_ASSOC);
				//解析数据
			} else {
				die("没要有修改的数据");
			}
			?>
			<!--<form action="action.php?action=edit" method="post">-->
				<table class="table" style="width: 40%;margin: 0 auto;">
					<caption class="text-center" style="margin: 0 auto;">
						修改信息
					</caption>
					<tbody>
						<tr>
							<td class="text-right" style="line-height:30px">
								学号：
							</td>
							<td>
								<input id="stu_num" type="text" class="form-control" name="id" value="<?php echo "{$stu['vote_stu']}"; ?>">
							</td>
						</tr>
						<tr>
							<td class="text-right" style="line-height:30px">
								姓名：
							</td>
							<td>
								<input id="stu_name" type="text" class="form-control" name="name" value="<?php echo "{$stu['vote_name']}"; ?>">
							</td>
						</tr>
												<tr>
							<td class="text-right" style="line-height:30px">
								班级：
							</td>
							<td>
								<input id="stu_class" type="text" class="form-control" name="name" value="<?php echo "{$stu['vote_mark']}"; ?>">
							</td>
						</tr>
						
						<tr>
							<td class="text-right" style="line-height:30px">
								手机：
							</td>
							<td>
								<input id="stu_mobile" class="form-control" type="text" name="age" value="<?php echo "{$stu['vote_mobile']}"; ?>">
							</td>
						</tr>
						
						<tr>
							<td class="text-right" style="line-height:30px">
							</td>
							<td>
								<input type="button" id="submitvote" class="btn btn-success" value="修改"/>
							</td>
						</tr>
					</tbody>
				</table>
			<!--</form>-->
			
			
			<script>
					function getQueryString(name) { 
						var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i"); 
						var r = window.location.search.substr(1).match(reg); 
						if (r != null) return unescape(r[2]); return null; 
					} 

				document.getElementById("submitvote").onclick = function() {
					var request = new XMLHttpRequest();
					request.open("POST", "action.php?action=updatevote");
					
					var data ="vote_id="+getQueryString('id')+ "&stu_num=" + document.getElementById("stu_num").value + "&stu_name=" + document.getElementById("stu_name").value + "&stu_class=" + document.getElementById("stu_class").value + "&stu_mobile=" + document.getElementById("stu_mobile").value;
					request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					request.onreadystatechange = function() {
						if (request.readyState === 4) {
							if (request.status === 200) {
								if(request.responseText=='1'){
										alert("修改成功");
										window.location.href='list.php';
								}
								if(request.responseText=='0'){
										alert("你没有修改内容，无法提交！");	
								}
								//window.location.href='list.php';
							} else {
	//							alert("发生错误：" + request.status);
								alert("失败");
							}
						}
					}
					request.send(data);
				}

			
			</script>
		
	</body>
</html>