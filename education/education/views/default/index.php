<?php
	if(!isset($_REQUEST['page'])){
		return;
	}
	$page = $_REQUEST["page"];
	if($page === 'login'){
	     include 'login.html';
	}else{
		include 'main.php';
	}
?>

