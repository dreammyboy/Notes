<?php
	include_once('/notes/models/NoteModel.php');
	$note = new NoteModel;
	$datas = $note->dates();
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>记单词</title>
<style>
	body {
		margin:0;
		height:100%;
	}
	
	#page {
		width:100%;
		height:100%;		
		font-family: Source-Han-Ligh4741c0fb45125;
		color:chocolate;
	}
	
	#header {
		width:100%;
		text-align:center;	
		padding: 1rem 0;	
		background-color:#b2b2b2;
		font-size:1.5rem;
		font-weight: bold;
	}
	
	#scrollWrapper {		
		overflow-x: hidden;
		overflow-y: scroll;
		height:80%;	
		padding:0.5rem;
		background-color: lightgoldenrodyellow;
	}
	
	#content {
		height:calc(100% - 3rem);
	}
	
	#scroll {
		width:100%;		
	}
	
	#scroll a {
		display:flex;
		height:4rem;
		width:100%;
		margin:0.5rem 0;
		justify-content: center;
		align-items: center;	
		background-color:white;
	}
	
	a:link {color: blue; text-decoration:none;}
	
	#scroll a div:nth-child(1) {
		flex:1;
		text-align:center;
		font-weight: bold;
		font-size:1.5rem;
	}
	
	#scroll a div:nth-child(2) {	
		flex:1;
		display:flex;
		justify-content: flex-end;
		padding:0 0.5rem 0 0;
	}
	
	a::after {	
		content:'>';
		margin: 0 0.5rem 0 0;
	}
	
	.number {
		display:flex;
		background-color: #ef473a;
		color: #fff;
		border: 0;
		border-radius: 1rem;
		width:2rem;
		height:2rem;
		text-align: center;
		align-items: center;
		justify-content: center;
	}
	
	.button {
		padding: 10px;
	}
	
	#addNew {
		background-color:#b2b2b2;
		width:100%;
		padding: 1rem 0;
		font-size:1.5rem;
		font-weight: bold;
		border-width: 1px;
		border-style: solid;
		border-radius: 2px;
		text-overflow: ellipsis;
		color:chocolate;
		border-color:chocolate;		
	}
	
</style>
</head>

<body>
    <div id="page">
		<div id="header">			
			<span id="date">日期列表</span>		
		</div>
		<div id="content">
			<div id="scrollWrapper">
				<div id="scroll">
				<?php              
					foreach($datas as $data) { 
				?>
						<a href="#" onclick="linkToWords('<?php echo $data['addDate'] ?>')">
							<div><?php echo substr_replace(substr_replace($data['addDate'],'-',4,0),'-',7,0) ?></div>
							<div><span class="number"><?php echo $data['num'] ?></span></div>
						</a>
				<?php
					}
				?>				
				</div>				
			</div>
			<div class="button">
				<button id="addNew">new</button>
			</div>
		</div>		
	</div>	
<script>	
	var page = document.getElementById("page");
	page.style.height = document.documentElement.clientHeight + "px";
	
	function linkToWords(date) {
		document.location = "../controller/NoteController.php?p=words&addTime=" + date;
	}
	
	var addNew = document.getElementById("addNew");
	addNew.onclick = function() {
		document.location = "../controller/NoteController.php?p=newNote";
	}
</script>
</body>
</html>
