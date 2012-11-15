<?php 
@session_start();
global $user;
GLOBAL $app;

require_once 'config.php';
$C = new CamerticConfig;
$user = new utilisateur();

$app = new premiumAutocar;

// Check session
if(!$app->checkSession()) {
	header('location:index.html');
	die();
}

global $lang;

// Set the language of the page
//$lang = new lang($user->getUserLang());
//var_dump($lang->phrases); die;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title><?php echo $app->title; ?> - Contact Management/CRM Template</title>

<link rel="stylesheet" media="screen" href="css/reset.css" />
<link rel="stylesheet" media="screen" href="css/grid.css" />
<link rel="stylesheet" media="screen" href="css/style.css" />
<link rel="stylesheet" media="screen" href="css/messages.css" />
<link rel="stylesheet" media="screen" href="css/forms.css" />

<!--[if lt IE 8]>
<link rel="stylesheet" media="screen" href="css/ie.css" />
<![endif]-->

<!-- jquerytools -->
<script src="js/jquery.tools.min.js"></script>

<script type="text/javascript" src="js/global.js"></script>

<!--[if lt IE 9]>
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/PIE.js"></script>
<script type="text/javascript" src="js/IE9.js"></script>
<script type="text/javascript" src="js/ie.js"></script>
<![endif]-->

</head>
<body>
    <div id="wrapper">
        <header>
            <div class="container_8 clearfix">
                <h1 class="grid_1"><a href="dashboard.php"><?php echo $app->title; ?></a></h1>
                <nav class="grid_5">
                    <ul class="clearfix"><!--
                        <li class="action">
                            <a href="#" class="has-popupballoon button button-blue"><span class="add"></span>New Contact</a>
                            <div class="popupballoon top">
                                <h3>Add new contact</h3>
                                First Name<br />
                                <input type="text" /><br />
                                Last Name<br />
                                <input type="text" /><br />
                                Company<br />
                                <input type="text" />
                                <hr />
                                <button class="button button-orange">Add contact</button>
                                <button class="button button-gray close">Cancel</button>
                            </div>
                        </li>
                        <li class="action">
                            <a href="#" class="has-popupballoon button button-blue"><span class="add"></span>New Task</a>
                            <div class="popupballoon top">
                                <h3>Add new task</h3>
                                <input type="text" /><br /><br />
                                When it's due?<br />
                                <input type="date" /><br />
                                What category?<br />
                                <select><option>None</option></select>
                                <hr />
                                <button class="button button-orange">Add task</button>
                                <button class="button button-gray close">Cancel</button>
                            </div>
                        </li>-->
                        <li class="active"><a href="dashboard.html">Dashboard</a></li>
                        <li><a href="profile.html">Profile</a></li>
                        <li class="fr"><a href="#">administrator<span class="arrow-down"></span></a>
                            <ul>
                                <li><a href="#" onclick="logout();">Sign out</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <form class="grid_2">
                    <input class="full" type="text" placeholder="Search..." />
                </form>
            </div>
        </header>
        
        <section>
            <div class="container_8 clearfix">

                <!-- Sidebar -->

                <aside class="grid_1">
					<?php getComponent('menu'); ?>
                </aside>

                <!-- Sidebar End -->
                

                <!-- Main Section -->

                <section class="main-section grid_7">
					<?php getView(); ?>
                </section>

                <!-- Main Section End -->

            </div>
            <div id="push"></div>
        </section>
    </div>
    
    <footer>
        <div id="footer-inner" class="container_8 clearfix">
            <div class="grid_8">
                <span class="fr"><a href="#">Documentation</a> | <a href="#">Feedback</a></span>Last account activity from 127.0.0.1 - <a href="#">Details</a> | &copy; 2010. All rights reserved. Theme design by VivantDesigns
            </div>
        </div>
    </footer>
</body>
</html>
