<?php 
$page = 'register';
require_once 'config.php';
GLOBAL $app;
$C = new CamerticConfig;
$app = new premiumAutocar;
require_once "inc/config.inc.php";
require_once "inc/fonction.inc.php";
include_once "inc/haut.inc.php";
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$autocar = new mdr;
	//var_dump($autocar); die;
	//if(is_null($autocar->demandeInscription($_POST))) {
	 //echo 'Demande bien envoyee!';
	//};
}
?>
		
		<div id="main-container" class="clearfix">
		
		    <!--<div class="tete">
			    <h2><span>CONNECTEZ VOUS POUR GERER VOTRE PAGE</span></h2>
			</div>--><div class="tete">
					<h2 style="width:98%;"><span id="message">Pour pouvoir gerer le contenu de votre page d'autocariste, veuillez entrer les identifiants de connexion fourni par l'administraateur a votre
					inscription.</span></h2>
				</div>
		    <div id="corps">
			    
				
			    <form method="POST" action="">
				    <label for="email">Email</label>
					<input name="email" id="email" type="text"/>
				    <label for="pass">Mot de passe</label>
					<input name="pass" id="pass" type="password"/>
					<input name="valid" id="valid" value="-2" type="hidden"/>
					<button onclick="login(); return false" type="submit">Connectez vous</button>
				</form>
			</div>
		</div>
		
<script type="text/javascript" src="<?php echo PATH_ROOT ?>js/login.js"></script>
<?php 
include_once "inc/bas.inc.php";
?>