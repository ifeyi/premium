<?php 
@session_start();
global $user;
require_once 'config.php';
$C = new CamerticConfig;
$app = new premiumAutocar;
$user = new utilisateur();

// Check session
if(!$app->checkSession()) {
	header('location:index.html');
	die();
}

global $lang;

// Set the language of the page
$lang = new lang($user->getUserLang());
//var_dump($lang->phrases); die;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
	<title>Eureners</title>
	<style type="text/css">
		@import url("css/arianne.css");
		@import url("css/style.css");
		@import url('css/style_text.css');
		@import url('css/form-buttons.css');
		@import url('css/link-buttons.css');
		@import url('css/menu.css');
		@import url('css/statics.css');
		@import url('css/messages.css');
		@import url('css/datatable.css');
		@import url('css/accordion.css');
		@import url('css/tabs.css');
		@import url('css/forms.css');
		@import url('css/datepicker.css');
		@import url('css/modalbox.css');
		@import url('css/jquery.fancybox-1.3.4.css');
		@import url('css/jquery.treeview.css');
		@import url('css/wysiwyg.css');
		@import url('css/wysiwyg.modal.css');
		@import url('css/wysiwyg-editor.css');
	</style>
	
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
	
	<!--[if lte IE 8]>
		<script type="text/javascript" src="js/excanvas.min.js"></script>
	<![endif]-->
	
</head>

<body>

<div class="container">   
  
	<div class="logo-labels">
		<h1><a href="#">CleanDream</a></h1>
		<ul>
			<!--<li><a href="#"><span>Settings</span></a></li>
			<li class="usermessage"><a href="#"><span>1 new message</span></a></li>-->
			<li class="logout"><a href="#" onclick="logout();"><span>Logout</span></a></li>
		</ul>
	</div>
	
	<div class="menu-search">
		<?php getComponent('menu'); ?>
		<div class="search">
			<form action="" method="post">
				<input type="text" id="searchbox" value="Seachterm" />
				<button type="submit"></button>
			</form> 
		</div>
	</div>
	
	<div class="breadcrumbs">
		<ul>
			<li class="home"><a href="#"></a></li>
			<!--<li class="break">&#187;</li>
			<li><a href="#">Menu item</a></li>
			<li class="break">&#187;</li>
			<li><a href="#">Menu item</a></li>-->
		</ul>
	</div>
	<div class="section">
		<?php getView(); ?>
	</div>
	
	<div class="footer">
		<div class="split">&#169; Copyright <a href="#">cimenti.es</a></div> 
		<div class="split right">Powered by <a href="#" target="_blank">Eureners</a></div> 
	</div>
</div>
<div id="backgroundPopup"></div>

<script type="text/javascript" src="js/superfish.js"></script>
<script type="text/javascript" src="js/supersubs.js"></script>
<script type="text/javascript" src="js/hoverIntent.js"></script>
<script type="text/javascript" src="js/jquery.flot.js"></script>
<script type="text/javascript" src="js/jquery.graphtable-0.2.js"></script>
<script type="text/javascript" src="js/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/jquery-ui-select.js"></script>
<script type="text/javascript" src="js/customInput.jquery.js"></script>
<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="js/jquery.filestyle.mini.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/jquery.treeview.js"></script>
<script type="text/javascript" src="js/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/plugins/wysiwyg.rmFormat.js"></script>
<script type="text/javascript" src="js/controls/wysiwyg.image.js"></script>
<script type="text/javascript" src="js/controls/wysiwyg.link.js"></script>
<script type="text/javascript" src="js/controls/wysiwyg.table.js"></script>
<script type="text/javascript" src="js/inline.js"></script>
<script type="text/javascript" src="js/eureners.js"></script>
<script type="text/javascript" src="js/logout.js"></script>
<script type="text/javascript" >
$('#searchbox').bind('keypress', function(e) {
	//alert(e.keyCode); 
//if(e.keyCode==65){
               // Enter pressed... do anything here...
  //      }
	var code = (e.keyCode ? e.keyCode : e.which);
	if(code == 65) {
		alert('vous avez tape A');
	}
	//alert(code);
});
</script>

</body>

</html> 