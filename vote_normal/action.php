<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/28
 * Time: 8:21
 */

function getRecord($tableName, $recordName, $condition) {
	$pdo = connectDb();
	$sql = "select * from $tableName where $recordName=$condition";
	$rs = $pdo -> query($sql);
	//返回影响了多少行数据
	$arrData = $rs -> fetch(PDO::FETCH_ASSOC);
	//获取找到的数据

	if ($rs -> rowCount() > 0) {
		return $arrData;
	} else {
		return;
	}
}

require_once "functions.php";

if (!isset($_GET["action"]) || empty($_GET["action"])) {
	echo "参数错误";
	return;
}

$operation = $_GET["action"];

if (!empty($operation)) {

	$pdo = connectDb();

	switch ($operation) {
		
		case 'updatevote':
			$vote_id= $_POST['vote_id'];
			$num = $_POST['stu_num'];
			$name = $_POST['stu_name'];
			$class = $_POST['stu_class'];
			$mobile = $_POST['stu_mobile'];
			
			$sql = "update vote_person_info set vote_stu='{$num}',vote_name='{$name}',vote_mark='$class',vote_mobile='$mobile' where vote_id={$vote_id}";
			
			$rw = $pdo -> exec($sql);
			if ($rw > 0) {
			 	echo "1";
			} else {
				echo "0";
			 }
			break;
		case 'frank' :
			$arrData = getRecord('stu_info', 'stu_num', '2012212304');
			echo $arrData['stu_dom'];

			break;
		case "remove" :
			$sql = "select * from stu_info";
			$arr = $pdo -> query($sql);
			foreach ($arr as $row) {
				$newname = str_replace(' ', '', $row['stu_name']);
				$stu_num = $row['stu_num'];
				$sql2 = "update stu_info set stu_name='{$newname}' where stu_num='{$stu_num}'";
				$rw = $pdo -> exec($sql2);
				if ($rw > 0) {
					echo '<span style="color:red">修改成功</span>' . '<br/>';
				} else {
					echo '修改失败' . '<br/>';
				}
			}
			break;
		case 'xuehao' :
			$sql = "select * from vote_person_status";
			$arr = $pdo -> query($sql);
			foreach ($arr as $row) {
				$pc_name = $row['pc_name'];

				$sql = "select * from stu_info where stu_name='$pc_name'";
				$rs = $pdo -> query($sql);
				//返回影响了多少行数据
				$arrData = $rs -> fetch(PDO::FETCH_ASSOC);
				//获取找到的数据
				$number = $arrData['stu_num'];

				$sql2 = "update vote_person_status set pc_num='{$number}' where pc_name='{$pc_name}'";
				$rw = $pdo -> exec($sql2);
				if ($rw > 0) {
					echo '修改成功' . '<br/>';
				} else {
					echo '修改失败' . '<br/>';
				}
			}

			break;
		case "test" :
			//    http://hise.dev/hise/action.php?action=test
			$name = '林立城';
			$sql = "select * from vote_person_status where pc_name='{$name}'";
			$rs = $pdo -> query($sql);
			//返回影响了多少行数据
			$arrData = $rs -> fetch(PDO::FETCH_ASSOC);
			//获取找到的数据

			if ($rs -> rowCount() > 0) {
				echo "找到信息" . "<br/>";
				$sql2 = "update vote_person_status set pc_status='已填写信息' where pc_name='{$name}'";
				$rw = $pdo -> exec($sql2);
				if ($rw > 0) {
					echo "<script>alert('修改成功');window.location='index.php'</script>";
				} else {
					echo "<script>alert('增加失败');window.history.back();</script>";
				}
				echo '添加成功';
			} else {
				echo "不存在记录";
			}
			break;

		//增加列席代表信息
		case "addvoteinfo" :
			$stuid = $_POST['stu_num'];
			$name = $_POST['stu_name'];
			$class = $_POST['stu_class'];
			$mobile = $_POST['stu_mobile'];

			$class_name=getRecord('class_info', 'class_id', $class)['class_name'];

			$sql2 = "insert into vote_person_info values(null,'{$stuid}','{$name}','{$class}','{$mobile}','{$class_name}',null)";
			$rw = $pdo -> exec($sql2);
			if ($rw > 0) {
				echo "信息添加成功";
			} else {
				echo "提交失败";
			}
			break;

		//删除信息
		case "del" :
			$id = $_GET['id'];
			$sql = "delete from vote_person_info where vote_id={$id}";
			$pdo -> exec($sql);
			header("Location:list.php");
			break;

		//修改信息
		case "edit" :
			$id = $_POST['id'];
			$sql = "update stu set name='{$name}',sex='{$sex}',age={$age},classid={$classid} where id={$id}";
			$rw = $pdo -> exec($sql);
			if ($rw > 0) {
				echo "<script>alert('修改成功');window.location='index.php'</script>";
			} else {
				echo "<script>alert('增加失败');window.history.back();</script>";
			}
			break;
		case 'showinfo' :
			$stunum = $_GET['stuid'];
			$sql = "select stu_num,stu_name from stu_info where stu_name like '%$stunum%'";
			$arr = $pdo -> query($sql);
			$row = $arr -> fetchAll(PDO::FETCH_ASSOC);

			// print_r($arr);
			var_dump(json_encode($row, JSON_UNESCAPED_UNICODE));

			//echo json_encode($row, JSON_UNESCAPED_UNICODE);
			break;
		case 'checknum' :
			$stu_num = $_GET['stu_num'];

			$sql = "select stu_name from stu_info where stu_num='$stu_num'";
			$rs = $pdo -> query($sql);
			//返回影响了多少行数据
			$arrData = $rs -> fetch(PDO::FETCH_ASSOC);
			//获取找到的数据

			if ($rs -> rowCount() > 0) {
				echo $arrData['stu_name'];
			} else {
				echo '0';
			}

			break;
	}
} else {
	echo "非法操作";
}
