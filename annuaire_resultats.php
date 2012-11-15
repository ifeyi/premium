<?php 
$page = 'annuaire_resultats';
$texte_input_recherche = 'Ou Recherchez une localité';
include_once "inc/recherche.ann.php";
include_once "inc/localites.ann.php";
include_once "inc/resultats.ann.php"; 
include_once "inc/haut.inc.php";

?>
<link type='text/css' href='<?php echo PATH_ROOT; ?>css/contact.css' rel='stylesheet' media='screen' />

        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
		
		<div id="main-container" class="clearfix">
		
		    <div class="tete">
			    <h2>
					<span><?php echo NOM_2?> <?php  echo strtoupper($lieu)?></span> - <?php echo $count?> <?php  echo NOM_1?> <?php  echo $prefix." ".strtoupper($lieu)?></h2>
			</div>
		    <div id="divRecherche">
			    <div class="asideLeft">
				    <div class="premierElt">    
						<form method="post" action="">
					        <h3>Nouvelle recherche</h3>
						    <h5>D&eacute;crivez votre trajet</h5>
						
				    		<input placeholder="Ville de d&eacute;part" type="text" id="" name=""/>
					    	<input placeholder="Ville de d'arriv&eacute;e" type="text" id="" name=""/>
					    	<input placeholder="Nombre de passagers" type="text" id="" name=""/>
					    
						    <button type="button">Trouver</button>
					    </form>
					</div>
					<div class="deuxiemeElt">
					    <div class="carteAside">
						    <h3>Recherchez par la carte</h3>
							<?php include "inc/map2.php"; ?>
							<!--<img src="<?php echo PATH_ROOT ?>img/paris.png" alt="paris" width="250px"/>-->
						</div>
					
				        <div class="demandes2">
					        <h3>Les derni&egrave;res demandes</h3>
					        <ul>
						        <li><a href="#"><strong>Alpes-maritimes - Paris</strong> : Demande de Mlle Agathe C. - 182 voyageurs, 4 autobus pour des musiciens </a></li>
						        <li><a href="#"><strong>Alpes-maritimes - Cologne</strong> : Demande de Mlle Estelle E. - 78 voyageurs, 2 autobus pour des association </a></li>
						        <li><a href="#"><strong>Alpes-maritimes - Tarbes</strong> : Demande de M. Erwan M. - 78 voyageurs, 2 autocars pour son club sportif </a></li>
						        <li><a href="#"><strong>Alpes-maritimes - Boe</strong> : Demande de M. Julien P. - 91 voyageurs, 2 bus pour un spectacle </a></li>
        				    </ul>
				        </div>	
					</div>
					
			        <div class="publicite secondPub">
		                <h3>Publicit&eacute;</h3>
			            <img src="<?php echo PATH_ROOT ?>img/liberte.png" alt="publicit&eacute;"/>
			    	</div>
					
					<div class="troisiemeElt">
					    <h2>Autocaristes</h2>
						<p>
						    Devenez membres <br/>premium et bla bla...<br/>
							<a href="#">Cliquez >></a>
						</p>
					</div>
				</div>
				<?php 
					$i = 0;
					$Rmdr=mysql_query($Qmdr); ?>
				<div class="corpsRecherche">
					<?php 	if($count>8){
                	include "inc/pagination.ann.php";
						}
					?>
					<div class="cocher" id='contact-form'>
					    <p>Pour recevoir des devis, veuillez cocher les cases (5 max) puis <a href='#' class='contact'>cliquez ici >></a></p>
					</div>
					
					<form action="" method="post" id="form_profil">
					<!--<div class="connexAllier">
					    <p>
					        <span class="checkbox"><input type="checkbox" name="" id=""/></span>
							<h2><a href="#">Connex Allier</a></h2>
							<img class="imageFlottante" src="<?php echo PATH_ROOT ?>img/car2.png" height="150px" alt="autocar"/>
				        </p>
						<p>
						    <h4>RUE CHATEAU <br/>03310 VILLEBRET</h4>
							
							A votre disposition les horaires de nos lignes r&eacute;guli&egrave;res. Organisez vos sorties, 
							tourisme loisirs, sportifs d&eacute;placements des &eacute;quipes. Demande de devis
						</p>
						<button type="button">Plus de d&eacute;tails</button>
					</div>
					<div class="connexAllier">
					    <p>
					        <span class="checkbox"><input type="checkbox" name="" id=""/></span>
    					    <h2><a href="#">Connex Allier</a></h2>
					        <img class="imageFlottante" src="<?php echo PATH_ROOT ?>img/car2.png" height="150px" alt="autocar"/>
				        </p>
						<p>
						    <h4>RUE CHATEAU <br/>03310 VILLEBRET</h4>
							
							A votre disposition les horaires de nos lignes r&eacute;guli&egrave;res. Organisez vos sorties, 
							tourisme loisirs, sportifs d&eacute;placements des &eacute;quipes. Demande de devis
						</p>
						<button type="button">Plus de d&eacute;tails</button>
					</div>-->
					<?php 
						$i = 0;
						$Rmdr=mysql_query($Qmdr);
						while($Rmdr && $mdr=mysql_fetch_array($Rmdr)){ ?>
						<div class="connexAllier2" id="link<?php  echo $i?>">
								<span class="checkbox"><input type="checkbox" name="champ[]" value="<?php echo $i?>" onclick="limite_check(this.name, 5);" /></span>
							<h2><a href="#"><?php if(strlen($mdr['mdr_nom'])>40) echo substr($mdr['mdr_nom'],0,70)."..."; else echo $mdr['mdr_nom'];?></a></h2>
							<p>
								<?php echo $mdr['mdr_adresse']?><br/>
								<?php echo $mdr['mdr_cp']?> <?php  echo $mdr['mdr_ville'] ?>
							</p>
						</div>
					<?php $i++; } ?> 
					
					</form>
				    <div class="cocher" id='contact-formm'>
					    <p>Pour recevoir des devis, veuillez cocher les cases (5 max) puis <a href='#' class='contact'>cliquez ici >></a></p>
					</div>
					 <?php 	if($count>8){
                	include "inc/pagination.ann.php";
						}
					?>
				</div>
			</div>
		</div>
		
	<script type='text/javascript' src='<?php echo PATH_ROOT?>js/jquery.js'></script>
<script type='text/javascript' src='<?php echo PATH_ROOT?>js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='<?php echo PATH_ROOT?>js/contactann.js'></script>
<?php 
include_once "inc/bas.inc.php";
?>