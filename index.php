<?php 
$page = 'home';
$texte_input_recherche = 'Entrez une localit&eacute;';
include_once "inc/recherche.ann.php";
include_once "inc/localites.ann.php";
include_once "inc/resultats.ann.php"; 
include_once "inc/haut.inc.php";
?>
    <body class="">
	<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div id="header-container">
		    <div id="header" class="wrapper clearfix">
		        <div class="hgroup">
			        <h1>Trouver<span>AUTOCAR</span></h1>
				    <h5>un</h5>
			    </div>
			    <div class="headerRight">
	    		    <button class="acces" onclick="window.location='login.php'">Acc&egrave;s autocaristes</button>
				
			    	<div class="social">
				        <a href="#" class="linkedin"><i class="icon-linkedin-sign icon-large"></i></a>
				        <a href="#" class="facebook"><i class="icon-facebook-sign icon-large"></i></a>
				        <a href="#" class="twitter"><i class="icon-twitter-sign icon-large"></i></a>
				    </div>
			    </div>
			</div>
		</div>
		
		<div id="main-container" class="clearfix">
		    <div class="firstContent">
			    <div class="topContent">
					<div class="rechercheRapide ">
					    <form method="POST" action="search.php">
					        <h2>Recherche rapide</h2>
						    <h5>D&eacute;crivez votre trajet</h5>
						
					    	
							<input name="depart" class="champs wickEnabled:mytable1" type="text" value="Ville de d&eacute;part" autocomplete="off" onfocus="if(this.value=='Ville de d&eacute;part') this.value='';" onblur="if(this.value=='') this.value='Ville de d&eacute;part'" />
						
							<input name="arrive" class="champs wickEnabled:mytable2" type="text" value="Ville d'arriv&eacute;e" onfocus="if(this.value=='Ville d\'arriv&eacute;e') this.value='';" onblur="if(this.value=='') this.value='Ville d\'arriv&eacute;e'" autocomplete="off" />
						    <input value="Nombre de passagers" id="nbpassagers" name="nbpassagers" type="text" onfocus="if(this.value=='Nombre de passagers') this.value='';" onblur="if(this.value=='') this.value='Nombre de passagers'" />
						    <button type="submit">Trouver</button>
							<table id="mytable1" class="mytable1">
								<tr>
									<td>
									<div class="myCustomFloaterContent">
									</div>
									</td>
								</tr>
							</table>
							
							<table id="mytable2" class="mytable2">
								<tr>
									<td>
									<div class="myCustomFloaterContent">
									</div>
									</td>
								</tr>
							</table>
							
					    </form>
					</div>
				    <div class="hgroup">
					    <h3>
						    Trouvez l'autocar qu'il vous faut !
						    <span class="message">Plus de <span>Demandes 500 effectu&eacute;es</span> chaque mois</span>
						</h3>
					</div>
				    
				</div>
				<div class="bottomContent">
					<div class="circle">
					    <h3>Ils nous font CONFIANCE</h3>
						<span class="arrowBottom"></span>
					</div>
					<div class="ongles">
					    <button type="button" class="guide">
					        <span>Guide</span><br/>
						    de la location <br/>d'autocars
					    </button>
					    <button type="button" class="autocariste" onclick="window.location='register.php'">
					        <span>Autocariste</span><br/>
						    r&eacute;f&eacute;rencez<br/> votre soci&eacute;t&eacute;
					    </button>
				    </div>
				</div>
			</div>
			
			<div class="secondContent">
			    <div class="logos">
				    <button class="gauche masterchef"></button>
					<button class="creditA"></button>
					<button class="gauche masterchef"></button>
					<button class="creditA"></button>
					<button class="gauche masterchef"></button>
				</div>
			</div>
			
			<div class="thirdContent">
				<div class="demandes">
					<h3>Les derni&egrave;res demandes</h3>
					<ul>
						<li><a href="#"><strong>Alpes-maritimes - Paris</strong> : Demande de Mlle Agathe C. - 182 voyageurs, 4 autobus pour des musiciens </a></li>
						<li><a href="#"><strong>Alpes-maritimes - Cologne</strong> : Demande de Mlle Estelle E. - 78 voyageurs, 2 autobus pour des association </a></li>
						<li><a href="#"><strong>Alpes-maritimes - Tarbes</strong> : Demande de M. Erwan M. - 78 voyageurs, 2 autocars pour son club sportif </a></li>
						<li><a href="#"><strong>Alpes-maritimes - Boe</strong> : Demande de M. Julien P. - 91 voyageurs, 2 bus pour un spectacle </a></li>
						<li><a href="#"><strong>Alpes-maritimes - Ouanne</strong> : Demande de M. Steven U. - 342 voyageurs, 7 bus pour des &eacute;tudiants </a></li>
						<li><a href="#"><strong>Alpes-maritimes - Pantin</strong> : Demande de M. Thomas Q. - 19 voyageurs, 1 minibus pour une f&ecirc;te familiale </a></li>
						<li><a href="#"><strong>Alpes-maritimes - Strasbourg</strong> : Demande de Mme Alicia Q. - 133 voyageurs, 3 autocars pour son association </a></li>
				    </ul>
					<div class="publicite">
				        <h3>Publicit&eacute;</h3>
					    <img src="img/liberte.png" alt="publicit&eacute;"/>
			    	</div>

				</div>	
			
			    <div class="carte">
				    <h3>Recherchez par la carte</h3>
					<div class="carte2">
						<div id="ann_carte_div">
							<div id="ann_carte" style="height: 511px;margin-top:10px">
							<!--<span class="titre_noir">Nouvelle recherche d'<?php echo NOM_1?></span>-->
							<?php include "inc/map.php"; ?>
							<span class="titre_small">
							<?php include "autocomplete_wick/wick_form.php"; ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
<script type='text/javascript' src='<?php echo PATH_ROOT ?>js/jquery.js'></script>
<script type='text/javascript' src='<?php echo PATH_ROOT ?>js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='<?php echo PATH_ROOT ?>js/contact.js'></script>
<?php 
include_once "inc/bas.inc.php";
?>