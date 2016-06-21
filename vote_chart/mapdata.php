<?php




	
	function connectDb()
	{
	    try {
	        $pdo = new PDO("mysql:host=localhost;dbname=hise;", "root", "");
	        $pdo->query("set names utf8");
	        //echo "<strong>->数据库连接成功</strong>";
	    } catch (PDOException $e) {
	        die("数据库连接失败" . $e->getMessage());
	    }
	    return $pdo;
	}
	
	switch ($_GET["action"]){
		case 'tuanwei':
		    $pdo = connectDb();
		    $sql = "select * from vote_tw order by v_score desc";
			//$sql = "select * from vote_tw";
		    $arr = $pdo->query($sql);

		    foreach ($arr as $row) {
				$datainfo[] = array(
					'name' => $row['v_name'],
					'score' => $row['v_score']
				);
		    }
			echo json_encode($datainfo,JSON_UNESCAPED_UNICODE);
			break;
			
		case 'xueshenghui':
		   	$pdo = connectDb();
		    $sql = "select * from vote_xsh order by v_score desc";
		    $arr = $pdo->query($sql);

		    foreach ($arr as $row) {
				$datainfo[] = array(
					'name' => $row['v_name'],
					'score' => $row['v_score']
				);
		    }
			echo json_encode($datainfo,JSON_UNESCAPED_UNICODE);					
			break;
	}


?>