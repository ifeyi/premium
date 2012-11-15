<?php
@session_start();
require_once 'config.php';
GLOBAL $app;

$C = new CamerticConfig;
$user = new utilisateur;
$app = new premiumAutocar;

if($app->checkSession())
	$user->isAdministrator() ? header('location:dashboard.php') : header('location:dashboard');
else
	header('location:index.html');
?>