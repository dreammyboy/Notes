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
	}
	
	#page {
		width:100%;
		height:100%;		
		font-family: Source-Han-Ligh4741c0fb45125;
		color:chocolate;
		background-color: lightgoldenrodyellow;
	}
	
	#header {
		width:100%;
		text-align:center;	
		padding: 1rem 0;	
		font-size:1.5rem;
		background-color:#b2b2b2;		
	}
	
	#backButton {
		position:absolute;
		padding:1rem;
		color:chocolate;	
		font-weight: bold;
		line-height:1.5rem;
		top:0;
		left:0.5rem;
	}
	
	#date {
		font-size:1.5rem;
		font-weight: bold;
	}
	
	.content {
		padding:10px;		
	}
	
	.content label{
		display:block;
	}	

	.input-label {
		display:block;
		margin: 1rem 0 1rem 0;
	}
	
	#word {
		width:100%;
		border-width:0 0 thin 0;
		border-style:solid;
		border-color:chocolate;
		font-size:2rem;
		font-weight: bold;
		color:black;
		border-radius: 0px;
		padding:0px;
	}
	
	#meaning {
		width:100%;
		border-color:chocolate;
		font-size:1.5rem;
		font-weight: bold;
		border-radius: 2px;
		color:black;
		padding:0px;
	}	
	
	.button {
		padding: 10px;
	}
	
	#save {
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
	
	#dialog {
		display: none;
		height:20rem;
		width:20rem;
		border-radius: 2px;
		border-width: 2px;
		border-color:black;
		border-style: solid;
		position: absolute;
		top:50%;
		left:50%;
		transform:translate(-50%,-50%);
		background:white;
	}
	
	#dialog .head{
		text-align: center;
		background-color:#b2b2b2;
		width:100%;
		padding: 1rem 0;
	}
	
	#messContent {
		width:100%;
		height:100%;
		display:flex;
		flex-direction: column;
		align-items: center;
	}
	
	#message {
		width:90%;
		height:50%;
		display:flex;
		align-items: center;
		justify-content: center;
		font-size:2rem;
	}
	
	#ok {
		background-color:#b2b2b2;
		width:90%;
		padding: 0.75rem 0;
		font-size:1.5rem;
		font-weight: bold;
		border-width: 1px;
		border-style: solid;
		border-radius: 2px;
		text-overflow: ellipsis;
		color:chocolate;
		border-color:chocolate;
		position:relative;
		bottom:-10%;
	}
	
</style>
</head>

<body>
    <div id="page">
		<div id="header">		
			<div id="backButton">返回</div>
			<span id="date"></span>		
		</div>
		<div class="content">
			<label>
				<span class="input-label">单词：</span>
				<input id="word" type="text" placeholder="">
			</label>
			<label>
				<span class="input-label">释义：</span>
				<textarea id="meaning" rows="10"></textarea>
			</label>  
		</div>
		<div class="button">
			<button id="save">save</button>
		</div>
		<div id="dialog">
			<div class="head">
				对话框
			</div>
			<div id="messContent">
				<div id="message">保存成功</div>
				<button id="ok">OK</button>
			</div>
		</div>
	</div>	
<script>
	var page = document.getElementById("page");
	page.style.height = document.documentElement.clientHeight + "px";
	
	var date = new Date();
	var dateE = document.getElementById("date");
	dateE.innerHTML = date.toISOString().substring(0, 10);
	
	var word = document.getElementById("word");	
	var meaning = document.getElementById("meaning");	
	var saveButton = document.getElementById("save");
	
	var backButton = document.getElementById("backButton");
		
	var message = document.getElementById("message");	
	var dialog = document.getElementById("dialog");
	var okButton = document.getElementById("ok");
	
	var isSaveSuccess = false;
	
	saveButton.onclick = function() {
		if(word.value=="") {
			message.innerHTML = "单词不能为空";
			dialog.style.display="block";
			return;
		}
		if(meaning.value=="") {
			meaning.value="空";
		}
		
		date = new Date();
		var addDate = date.getFullYear() + ("0"+(date.getMonth()+1)).substr(-2,2) + ("0"+date.getDate()).substr(-2,2);
		var addTime = ("0"+date.getHours()).substr(-2,2) + ("0"+date.getMinutes()).substr(-2,2);				
		
		saveButton.disabled=true;
		ajax({
			method: "get",
			url: "../controller/NoteController.php?p=save&word="+word.value+"&meaning="+meaning.value+"&addDate="+addDate+"&addTime="+addTime
		}, function(data) {			
			message.innerHTML = data.msg;
			dialog.style.display="block";			
			isSaveSuccess = true;
		}, function() {
			message.innerHTML = "网络访问失败";
			dialog.style.display="block";
			isSaveSuccess = false;
		})
	}
	
	okButton.onclick = function() {
		if(isSaveSuccess) {
			word.value = "";
			meaning.value = "";
		}		
		dialog.style.display="none";
		saveButton.disabled=false;
	}
	
	backButton.onclick = function() {
		window.history.go(-1); 
	}
	
	function ajax(params,successFuc,failFunc) {
		var xhr = new XMLHttpRequest();
		xhr.open(params.method, params.url, true);
		xhr.onload = function (e) {
			if (xhr.readyState === 4) {
				if (xhr.status === 200) {					
					successFuc(JSON.parse(xhr.responseText));
				} else {
					failFunc();
				}
			}
		};
		xhr.onerror = function (e) {
			failFunc();
		};
		xhr.send(null);
	}
</script>
</body>
</html>
