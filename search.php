<?php 
session_start();

	if($_POST['depart'] == ""){
		header("Location: /");
	}
	else
	{
		$_POST['submit_x']=1;
		$_POST['recherche'] = $_POST['depart'];
		$_SESSION['depart'] = $_POST['depart'];
		$_SESSION['arrive'] = $_POST['arrive'];
		include("inc/recherche.ann.php");
	}
?>