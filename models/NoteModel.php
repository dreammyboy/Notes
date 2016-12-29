<?php
	include_once('/notes/util/Database.php');
	class NoteModel {
		
		public function dates(){
			$sql = "SELECT addDate,count(*) as num FROM `zhe_word` group by addDate"; 
			return queryFromDataBase($sql);
		}
	
		public function words(){
			$addTime = $_GET["addTime"];
			$sql = "SELECT id, word, meaning FROM `zhe_word` where addDate='" . $addTime . "'";
			return queryFromDataBase($sql);
		}
	
		public function save(){
			$word = $_GET['word'];
			$meaning = $_GET['meaning'];
			$addTime = $_GET['addTime'];
			$addDate = $_GET['addDate'];
			$state = 1;
			$sql = "insert into zhe_word (id,word,meaning,state,groupId,addDate,addTime) VALUES ('','".$word."','".$meaning."','".$state."','0','".$addDate."','".$addTime."')"; 
			$r = operateDataBase($sql); 
			$resultset['success'] = $r===false? 0:1;
			$resultset['msg'] = $r===false? '保存失败':'保存成功';
			return json_encode($resultset,JSON_UNESCAPED_UNICODE);
		}			
	}
?>