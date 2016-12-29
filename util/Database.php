<?php
function queryFromDataBase($queryString) { 

	$link = connectDatabase();
	$result = mysqli_query($link, $queryString);
	if (!$result) {
		trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
	}else {
		$i = 0;
		while ($row = mysqli_fetch_assoc($result)) {
			$data[$i] = $row;
			$i++;
		}
	}
	
	closeDatabaseConnection($link);
	
	return $data;
}

function operateDataBase($executeString) { 

	$link = connectDatabase();
	$r = mysqli_query($link, $executeString);	
	closeDatabaseConnection($link);
	return $r;
}

function connectDatabase() {
	$link = mysqli_connect('127.0.0.1', 'root', '123456','zhephp','3306');
    if (!$link) {
		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	}
	return $link;
}

function closeDatabaseConnection($link) {
	mysqli_close($link);
}

?>