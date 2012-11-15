<?php 

header('Status: 301 Moved Permanently', false, 301);   
header('Location: /');   
exit();
  
$page = 'annuaire_detail';
$texte_input_recherche = 'Entrez une localit&eacute;';
require_once "inc/config.inc.php";
require_once "inc/fonction.inc.php";

// REQUETE COORDONNEES MDR
$Qmdr="SELECT 	mdr_nom,
				mdr_adresse,
				mdr_cp,
				mdr_dep,
				mdr_ville,
				mdr_ville_geo_lat,
				mdr_ville_geo_long
		FROM	mdr
		WHERE	mdr_id={$_GET['MDR_ID']}";
$Rmdr=query_full($Qmdr);

// PRE-REMPLISSAGE GEOLOCALISE DU FORMULAIRE
$dep_geoloc = $Rmdr['mdr_dep'];

// REQUETE TOTAL MDR DANS LA LOCALITE (necessaire pour le header)
$QmdrCount = "SELECT COUNT(*) AS mdr_id  
           FROM   mdr 
	       WHERE  mdr_ville = '{$Rmdr['mdr_ville']}'
           OR     mdr_ville = '{$Rmdr['mdr_ville']} CEDEX%'
           OR     mdr_ville = '{$Rmdr['mdr_ville']} cedex%'
          ";
$RmdrCount = mysql_query($QmdrCount);
$count = mysql_result($RmdrCount,0,"mdr_id");
$prefix = 'à';
$lieu =  $Rmdr['mdr_ville'];
 

include_once "inc/haut.inc.php";
?>

<div id="main_area">
<div id="main">

    <div class="content_big_titre">
    <span class="titre_bleu"><?php echo $Rmdr['mdr_nom']." à ".$Rmdr['mdr_ville']?></span>
    </div>
    
    <div class="content_big" >
        <!-- DETAIL -->
        <div id="ann_detail">
            <span class="titre_small" style="font-weight: bold;">Adresse de l'autocariste :</span><br />
            <span class="space"><br /></span>
            <span class="titre_small" style="line-height: 20px;">
            <?php  echo transform($Rmdr['mdr_adresse'])?><br />
            <?php  echo transform($Rmdr['mdr_cp'])?> <?php  echo transform($Rmdr['mdr_ville'])?><br /><br />
            </span>
            
            <span class="titre_small" style="font-weight: bold;">Plan d'accès :</span><br />
            <!-- GOOGLE MAP -->
            <?phpinclude("inc/googleMap.php");?>
            
        </div>
        
        <form method="post" action="#formbas">
	        <div class="formulaire_liste">
				<div class="titre">
					Vous recherchez un <?php  echo NOM_3?> <?php  echo $prefix." ".strtoupper($lieu)?> ?
				</div>
				<div class="texte">
					<?php  
						if($ER != ""){
							echo "<center><font color='#FFAAAA'><b>$ER</b></font></center><br/>";
						}
						else{ ?>
							Vous recherchez un <?php  echo NOM_2?> <?php  echo $prefix." ".strtoupper($lieu)?>, Merci de bien vouloir remplir le formulaire ci-dessous, un conseiller vous contactera dans les plus brefs delais.
					<?php 	}	?>
				</div>
				<div class="bloc">
					<b>Votre Nom</b> :<br />
					<input type="text" name="nom" value="<?php echo $_POST['nom']?>" />
				</div>
				<div class="bloc">
					<b>Votre Téléphone</b> :<br />
					<input type="text" name="telephone" value="<?php echo $_POST['telephone']?>" />
				</div>
				<div class="bloc">
					<b>Votre Email</b> :<br />
					<input type="text" name="email" value="<?php echo $_POST['email']?>" />
				</div>
				<div class="bloc">
					<br />
					<input type="hidden" name="action" value="send" />
					<input type="submit" value="Obtenir un Devis" class="button"/>
				</div>
				
			</div>
		</form>
        
        <!-- CARTE -->
        <div id="ann_carte_div">
			<div id="ann_carte" style="height: 511px;margin-top:10px">
			<span class="titre_noir">Nouvelle recherche d'<?php echo NOM_1?></span>
            <?phpinclude "inc/map.php";?>
            <span class="titre_small">
            <?phpinclude "autocomplete_wick/wick_form.php";?></span>
            </div>
        </div>
    </div>
    
    

</div><!-- end of main -->
</div><!-- end of main_area -->


<?php 
include_once "inc/bas.inc.php";
?>