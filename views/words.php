<?php
	include_once('/notes/models/NoteModel.php');
	$note = new NoteModel;
	$datas = $note->words();
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
	
	#backButton {
		position:absolute;
		padding:1rem;
		color:chocolate;	
		font-weight: bold;
		line-height:1.5rem;
		top:0;
		left:0.5rem;
	}
	
	#content {
		height:calc(100% - 5rem);
		padding:0.5rem;
		background-color: lightgoldenrodyellow;
		overflow-x: hidden;		
		overflow-y: scroll;
	}
	
	#scroll {
		width:100%;		
	}
	
	#scroll>a {
		display:flex;
		height:4rem;
		width:100%;
		margin:0.5rem 0;
		justify-content: center;
		align-items: center;	
		background-color:white;
	}
	
	.button {
		padding: 0.5rem 1rem;
		background-color:chocolate;
		color:white;
	}
	
	a:link {color: blue; text-decoration:none;}
	
	#scroll a div:nth-child(1) {
		flex:4;
		text-align:left;
		font-weight: bold;
		font-size:1.5rem;
		padding:0 0 0 0.5rem;
	}
	
	#scroll a div:nth-child(2) {	
		flex:3;
		display:flex;
		justify-content: flex-start;
	}	

	#scroll a div:nth-child(3) {	
		flex:1;
		display:flex;
		justify-content: center;
		padding:0.5rem;
		margin: 0 0.5rem 0 0;
		border-radius: 5px;
	}					
	
</style>
</head>

<body>
    <div id="page">
		<div id="header">	
			<div id="backButton">返回</div>
			<span id="date"><?php echo substr_replace(substr_replace($_GET["addTime"],'-',4,0),'-',7,0) ?></span>		
		</div>
		<div id="content">
				<div id="scroll">
				<?php              
					foreach($datas as $data) { 
				?>
						<a href="#">
							<div id="word<?php echo $data['id']?>"><?php echo $data['word']?></div>
							<div><?php echo $data['meaning'] ?></div>
							<div class="button" onclick="copy('<?php echo $data['id']?>')">复制</div>
						</a>
				<?php
					}
				?>				
				</div>						
		</div>		
	</div>	
<script>	
var page = document.getElementById("page");
page.style.height = document.documentElement.clientHeight + "px";

var backButton = document.getElementById("backButton");
backButton.onclick = function() {
	window.history.go(-1); 
}
//该函数参考的clipboard.js的实现原理。
//https://clipboardjs.com/
function copy(id) {
	//建立个屏幕上不显示的textarea元素。
	var fakeElem = document.createElement('textarea');
	// Prevent zooming on iOS
    fakeElem.style.fontSize = '12pt';
    // Reset box model
    fakeElem.style.border = '0';
    fakeElem.style.padding = '0';
    fakeElem.style.margin = '0';
    // Move element out of screen horizontally
    fakeElem.style.position = 'absolute';
    fakeElem.style['left'] = '-9999px';
	// Move element to the same position vertically
    var yPosition = window.pageYOffset || document.documentElement.scrollTop;
    fakeElem.addEventListener('focus', window.scrollTo(0, yPosition));
    fakeElem.style.top = yPosition + 'px';
	fakeElem.setAttribute('readonly', '');

	var copyTextarea = document.getElementById('word'+id);
	
	fakeElem.value = copyTextarea.innerHTML;
	document.body.appendChild(fakeElem);
	
	fakeElem.focus();
	//关键在这句要选中
    fakeElem.setSelectionRange(0, fakeElem.value.length);
	try {
		var successful = document.execCommand('copy');
		var msg = successful ? 'successful' : 'unsuccessful';
		console.log('Copying text command was ' + msg);
	} catch (err) {
		console.log('Oops, unable to copy');
	}
	document.body.removeChild(fakeElem);
	fakeElem = null;
}

</script>
</body>
</html>
