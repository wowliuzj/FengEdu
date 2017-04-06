<?php
	if(!isset($_REQUEST['page'])){
        include 'cover.html';
        return;
	}
	$page = $_REQUEST["page"];
	if($page === 'login'){
        include 'cover.html';
	     //include 'login.html';
	} else if($page === 'front'){
        include 'front.html';
        //include 'login.html';
    } else {
		include 'main.php';
	}
?>

