<?php 
$page = 'home';
$texte_input_recherche = 'Entrez une localité';
include_once "inc/recherche.ann.php";
include_once "inc/localites.ann.php";
include_once "inc/resultats.ann.php"; 
include_once "inc/haut.inc.php";
?>
<body class="home">
<link type='text/css' href='css/contact.css' rel='stylesheet' media='screen' />



<div class="home_global">
	<div class="home_contenu">
		<div class="logo">
			<img src="images/logo.png" />
		</div>
		<div class="home_loupe"><img src="images/picto_recherche.png" /></div>
		<div class="home_search">
			<form method="POST" action="search.php">
			<div class="home_titre">Trouvez un Autocar</div>
			Au départ de
			<input name="depart" class="champs wickEnabled:mytable1" type="text" value="" autocomplete="off" />  
			vers <input name="arrive" class="champs wickEnabled:mytable2" type="text" value="" autocomplete="off" />  <input type="image" src="images/btn_ok.png" style="margin-top: 0;position: absolute;" />
			
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
		<div class="home_devis">
			<span class="bleu"><b>Devis immédiat</b></span></a><br /><br />
				Vous souhaitez un devis immédiat pour une location d'autocar ?<br /><br />
			<div id='container'>
				<div id='content'>
					<div id='contact-form'>
						<a href='#' class='contact'>Cliquez-ici »</a>
					</div>
					<div style="width:300px">
						<a href='autocarzone/' class='contact'>Accès professionnels (Inscription | Connexion) ici »</a>
					</div>
					<!-- preload the images -->
					<div style='display:none'>
						<img src='<?php echo PATH_ROOT?>images/loading.gif' alt='' />
					</div>
				</div>
			</div>
		</div>
		<div class="home_france"><img src="images/picto_france.png" /></div>
		<div class="home_dep">&nbsp; Trouvez un Autocar au départ de votre département :<br />
			<ul>
				<?php 
				$Qsql4="SELECT `nom_dep_maj`,nom_dep_min,departement_id
						FROM `departement` 
						ORDER BY `departement_id`";
				$Rsql4=mysql_query($Qsql4);
				
				while($Rsql4 && $row4=mysql_fetch_array($Rsql4))
				{
					echo "<li>".$row4['departement_id'].". <a href=\"".PATH_ROOT.DOSSIERANN.PREFIX.format(strtolower($row4[nom_dep_maj]))."-d.html\">".$row4['nom_dep_min']."</a></li>";
				}
				?>
			</ul>

			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>
			<script type="text/javascript">
			
			$(document).ready(function(){
			
			
			    $(".slidingDiv").hide();
				$(".show_hide").show();
				
				$('.show_hide').click(function(){
				$(".slidingDiv").slideToggle();
				});
			
			});
			
			</script>
			<div class="slidingDiv">
			   <?php 
				$Qsql4="SELECT `nom_dep_maj`,nom_dep_min,departement_id
						FROM `departement` 
						ORDER BY `departement_id` LIMIT 15,100";
				$Rsql4=mysql_query($Qsql4);
				
				while($Rsql4 && $row4=mysql_fetch_array($Rsql4))
				{
					echo "<li>".$row4['departement_id'].". ".$row4['nom_dep_min']."</li>";
				}
				?>
			</div>
			<p align="right"><a href="#" class="show_hide"></a></p><br />
		</div>
	</div>
</div>
<div class="footer_top">
	<div class="footer_texte">
	Autocar-pas-cher.com est un service national gratuit pour la recherche d’autocars avec chauffeur.<br />
	Nous avons tries sur le volet des autocaristes en France, répondant à nos critères de sélections :<br />
	Respect de la législation, chauffeurs expérimentés, flotte d’autocars récente.
	<br /><br />
	Le prix est un critère fondamental pour toute structure qui souhaite louer un autocar. Cela dit malgré une législation sans arrêt renforcée, il se trouve qu’il existe encore sur le marché certaines sociétés ne respectant pas les normes de sécurité, et de ce fait peuvent proposer des tarifs imbattables.<br />
	Chez autocar-pas-cher.com, nous ne travaillons pas du tout avec ce genre de sociétés, et nous vous promettons le meilleur rapport qualité prix lors de votre réservation.<br />
	Une fois votre demande déposée sur le site autocar-pas-cher.com, un conseiller vous contactera afin d’évaluer avec vous vos besoins en autocar, nous négocierons ensuite pour vous le meilleur tarif, et vous mettrons en relation directement avec la société autocariste afin que vous puissiez réserver en toute transparence.<br /><br />
	</div>
</div>
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/contact.js'></script>
<?php 
include_once "inc/bas.inc.php";
?>