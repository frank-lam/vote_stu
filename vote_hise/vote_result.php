<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>投票结果数据</title>

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
    <script>
    	
//  	var password = prompt ( "请输入密码" , "" );
//  	if(password!='hise2016'){
//  		alert("密码错误");
//  		window.close();
//  	}
        function doDel(id) {
            if (confirm("确定要删除吗？")) {
                window.location = 'action.php?action=del&id=' + id;
            }
        }
    </script>
    </head>
    <body>
         <?php

    //数据库连接
    require_once "functions.php";
    $pdo = connectDb();
    $sql = "select * from vote_tw order by v_score desc";
	$sql3 = "select * from vote_xsh order by v_score desc";
	
    $arr = $pdo->query($sql);
	$arr2 = $pdo->query($sql3);

	$sql2 = "select count(*) from vote_record;";
    $rs = $pdo -> query($sql2);
    $arrData = $rs -> fetch(PDO::FETCH_ASSOC);
    //获取找到的数据
    $total=$arrData['count(*)'];
    ?>

    <div class="container">
    	<div class="text-center alert-success" style="font-size: 50px;margin-top: 10px;">有效投票：<?php echo $total ?>人次</div>

        <table class="table table-condensed table-hover table-bordered text-center" style="font-size: 20px;">
            <h4 class="text-center" style="font-size: 25px;">第五次团代会候选人票选结果</h4>
            <thead>
            <tr>
                <th>序号</th>
                <th style="width: 200px;">姓名</th>
                <th>票数</th>
                <th>是否过半</th>

            </tr>
            </thead>
            <tbody>

            <?php
            $id=0;
            foreach ($arr as $row) {
            	$isOk='<span style="color:red;"><strong>票数未过半</strong><span>';
            	if($row['v_score']>=$total/2){
            		$isOk='<span style="color:green;"><strong>√ 已经过半</strong<span>';
            	}
            	$id++;
                echo "<tr>";
	                echo "<td>{$id}</td>";
	                echo "<td>{$row['v_name']}</td>";
	                echo "<td>{$row['v_score']}</td>";
	                echo "<td>{$isOk}</td>";

                echo "<tr/>";
            }
            ?>
            </tbody>
        </table>
        
        
         <table class="table table-condensed table-hover table-bordered text-center" style="font-size: 20px;">
            <h4 class="text-center" style="font-size: 25px;">第十六次学代会候选人票选结果</h4>
            <thead>
            <tr>
                <th>序号</th>
                <th style="width: 200px;">姓名</th>
                <th>票数</th>
                <th>是否过半</th>

            </tr>
            </thead>
            <tbody>

            <?php
            $id2=0;
            foreach ($arr2 as $row) {
            	$isOk='<span style="color:red;"><strong>票数未过半</strong><span>';
            	if($row['v_score']>=$total/2){
            		$isOk='<span style="color:green;"><strong>√ 已经过半</strong<span>';
            	}
            	$id2++;
                echo "<tr>";
	                echo "<td>{$id2}</td>";
	                echo "<td>{$row['v_name']}</td>";
	                echo "<td>{$row['v_score']}</td>";
	                echo "<td>{$isOk}</td>";

                echo "<tr/>";
            }
            ?>
            </tbody>
        </table>
        
    </div>


        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
         <script src="Hello World"></script>
    </body>
</html>