<?php
@session_start();


if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['user']) && !empty($_POST['pass'])) {
	//require_once('_connect_.php');
	require_once('../config.php');
	$clean = array();
	$mysql = array();
	
	$now = time();
	$max = $now - 15;
	
	$salt = 'duo';

	if (ctype_alnum($_POST['user'])) {
		$clean['username'] = $_POST['user'];
	}
	else {
		//die('trou');
	}

	$camertic = new CamerticConfig('../lib/library.php');
	
	$user = new utilisateur;//var_dump(session_id()); die();
	//;
	
	if($user->simpleLogin($_POST['user'], $_POST['pass'])) {
		//
		echo "true";
	}
	else {
		//$badattempt = true;
		echo "false";
	}
	
}
?>