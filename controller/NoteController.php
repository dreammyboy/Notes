<?php
	if($_GET["p"] == "dates") {
		include_once('/notes/views/dates.php');
	}else if($_GET["p"] == "words"){
		include_once('/notes/views/words.php');
	}else if($_GET["p"] == "newNote") {
		include_once('/notes/views/newNote.php');		
	}else if($_GET["p"] == "save") {
		include_once('/notes/models/NoteModel.php');
		$note = new NoteModel;
		echo $note->save();
	}
?>