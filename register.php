<?php 
$page = 'register';
require_once 'config.php';
GLOBAL $app;
$C = new CamerticConfig;
$app = new premiumAutocar;
require_once "inc/config.inc.php";
require_once "inc/fonction.inc.php";
include_once "inc/haut.inc.php";
?>
		
		<div id="main-container" class="clearfix">
		
		    <div class="tete">
			    <h2><span>REFERENCEZ SIMPLEMENT VOTRE SOCIETE</span></h2>
			</div>
		    <div id="corps">
			    <p>Phrase de pr&eacute;sentation,Phrase de pr&eacute;sentation,
				Phrase de pr&eacute;sentation,Phrase de pr&eacute;sentation,
				Phrase de pr&eacute;sentation,Phrase de pr&eacute;sentation,
				Phrase de pr&eacute;sentation,Phrase de pr&eacute;sentation,
				Phrase de pr&eacute;sentation,Phrase de pr&eacute;sentation,
				Phrase de pr&eacute;sentation</p>
				<p><?php 
					if($_SERVER['REQUEST_METHOD'] == 'POST') {
						$autocar = new mdr;
						//var_dump($autocar); die;
						if(is_null(@$autocar->demandeInscription($_POST))) {
						 echo '<span style="color:blue;">Demande bien envoyee! Vous recevrez confirmation a votre inscription bientot!</span>';
						};
					}
				?></p>
			    <form method="POST" action="">
				    <label for="mdr_nom">Nom de votre soci&eacute;t&eacute;</label>
					<input name="mdr_nom" id="mdr_nom" type="text"/>
				    <label for="mdr_resp">Nom du responsable</label>
					<input name="mdr_resp" id="mdr_resp" type="text"/>
				    <label for="mdr_tel">Num&eacute;ro de t&eacute;l&eacute;phone</label>
					<input name="mdr_tel" id="mdr_tel" type="text"/>
				    <label for="mdr_email">Adresse Email</label>
					<input name="mdr_email" id="mdr_email" type="email"/>
					<input name="valid" id="valid" value="-2" type="hidden"/>
					<button type="submit">R&eacute;f&eacute;rencer ma soci&eacute;t&eacute;</button>
				</form>
			</div>
		</div>
		
		<script type='text/javascript' src='<?php echo PATH_ROOT ?>js/jquery.js'></script>
<script type='text/javascript' src='<?php echo PATH_ROOT ?>js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='<?php echo PATH_ROOT ?>js/contact.js'></script>
<?php 
include_once "inc/bas.inc.php";
?>