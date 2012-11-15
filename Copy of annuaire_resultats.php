<?php 
$page = 'annuaire_resultats';
$texte_input_recherche = 'Ou Recherchez une localité';
include_once "inc/recherche.ann.php";
include_once "inc/localites.ann.php";
include_once "inc/resultats.ann.php"; 
include_once "inc/haut.inc.php";

?>
<link type='text/css' href='<?php echo PATH_ROOT; ?>css/contact.css' rel='stylesheet' media='screen' />

<div id="main_area">
<div id="main">

    <div class="content_big_titre">
    <span class="titre_noir"><?php echo NOM_2?> <?php  echo strtoupper($lieu)?> (<?php echo $count?> <?php  echo NOM_1?> <?php  echo $prefix." ".strtoupper($lieu)?>)</span>
    </div>
    
    <div class="content_big" >
    

        <!-- LISTING ADRESSES -->
        <div id="ann_resultats">
        	<div id='container'>
				<div id='content'>
					<div id='contact-form'>
						&nbsp;&nbsp;&nbsp; <img src="<?php echo PATH_ROOT?>images/flechebas.gif" border="0" align="top" style="margin-bottom:5px" /><div style="float:right;margin-top:-7px;margin-right:45px"><a href='#' class='contact'>Pour obtenir un devis des Autocaristes cochés (5 max.), <font color="#CC2222">Cliquez-ici »</font></a></div>
					</div>
					<!-- preload the images -->
					<div style='display:none'>
						<img src='img/contact/loading.gif' alt='' />
					</div>
				</div>
			</div>
			<form class="formulaire-profil" id="form_profil" method="post">
            <?php 
			$i = 0;
			$Rmdr=mysql_query($Qmdr);
            while($Rmdr && $mdr=mysql_fetch_array($Rmdr)){?>
            <div class="ann_resultats_box" id="link<?php  echo $i?>" <?php if($mdr['etat'] == 'a') echo "style='background-color:#FCF5ED;'"; ?>>
            	
	            <a onmouseover="setMarkerImage(<?php echo $i?>)" onmouseout="delMarkerImage(<?php echo $i?>)" href="#">
					<div class="ann_resultats_check"><input type="checkbox" name="champ[]" value="<?php echo $i?>" onclick="limite_check(this.name, 5);" /></div>
					<div class="ann_resultats_adresse">
					<span class="texte_bleu"><b><?php if(strlen($mdr['mdr_nom'])>40) echo substr($mdr['mdr_nom'],0,70)."..."; else echo $mdr['mdr_nom'];?></b></span><br />
		            <br /><?php echo $mdr['mdr_adresse']?><br /><?php echo $mdr['mdr_cp']?> <?php  echo $mdr['mdr_ville']?>
					</div>
					<div class="ann_resultats_arrow"><img src="<?php echo PATH_ROOT?>images/search_arrow.png" border="0" /></div>
	            </a>
	            
            </div>
            <?php 
				$i++;
			}
			?> 
            </form>
            
			<div id='container'>
				<div id='content'>
					<div id='contact-form'>
						&nbsp;&nbsp;&nbsp; <img src="<?php echo PATH_ROOT?>images/flechehaut.gif" border="0" style="margin-top:3px;" /><a href='#' class='contact'>Pour obtenir un devis des Autocaristes cochés (5 max.), <font color="#CC2222">Cliquez-ici »</font></a>
					</div>
					<!-- preload the images -->
					<div style='display:none'>
						<img src='img/contact/loading.gif' alt='' />
					</div>
				</div>
			</div>

            <!-- MODULE PAGINATION -->
            <?php 	if($count>8){
                	include "inc/pagination.ann.php";
				}
			?>     
			<br /><br />
			<a name="formbas"></a>
			<form method="post" action="#formbas">
				<div class="formulaire_liste_bas">
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
					<div class="blocd">
						<b>Votre Nom</b> :<br />
						<input type="text" name="nom" value="<?php echo $_POST['nom']?>" />
					</div>
					<div class="bloc">
						<b>Votre Téléphone</b> :<br />
						<input type="text" name="telephone" value="<?php echo $_POST['telephone']?>" />
					</div>
					<div class="blocd">
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
			<span style="font-size:10px">
			L'ensemble des données ci-dessus sont recueillies dans le cadre de la présente simulation par Autocar Pas cher en qualité de responsable de traitement. Le destinataire de ces données est  Autocar Pas cher. Conformément à la loi Informatique et Libertés du 6 janvier 1978 modifiée en 2004, vous disposez d'un droit d'accès et de rectification des informations qui vous concernent. Vous pouvez exercer ce droit en vous adressant par mail à contact@autocar-pas-cher.com.</span><br />
        </div>
        
        
        
        <!-- CARTE -->
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
			<span style="font-size:10px">
			L'ensemble des données ci-dessus sont recueillies dans le cadre de la présente simulation par Autocar Pas cher en qualité de responsable de traitement. Le destinataire de ces données est  Autocar Pas cher. Conformément à la loi Informatique et Libertés du 6 janvier 1978 modifiée en 2004, vous disposez d'un droit d'accès et de rectification des informations qui vous concernent. Vous pouvez exercer ce droit en vous adressant par mail à contact@autocar-pas-cher.com.</span><br /><br />
		</form>
		
		<div style="border-top:5px solid #ff6600;border-bottom:2px solid #ff6600;height:50px;padding-top:10px;background-color:#ffcc99;font-weight:bold;text-align:center;float:left;width:412px;margin-bottom:25px">
			<div id='container'>
				<div id='content'>
					<div id='contact-form'>
						<a href='#' class='contact' style="text-decoration:none;color:#333333;">OBTENEZ UN DEVIS IMM&Eacute;DIAT <br/>POUR VOTRE LOCATION AUTOCAR</a>
					</div>
				</div>
			</div>
		</div>	
		
        <div class="carte">
			<div id="map_canvas" style="width:412px; height:412px"></div>
		</div>
		        
        <div id="ann_carte_div">
			<div id="ann_carte" style="height: 511px;margin-top:10px">
			<span class="titre_noir">Nouvelle recherche d'<?php echo NOM_1?></span>
            <?php include "inc/map.php"; ?>
            <span class="titre_small">
            <?php include "autocomplete_wick/wick_form.php"; ?></span>
            </div>
        </div>
    
    </div>
    
   <div style="clear: both;"></div> 
    
    <div class="textegauche">
		<div class="titrevert">Location Autocars <?php  echo strtoupper($lieu)?> : A propos des <?php  echo NOM_1?> <?php  echo $prefix." ".strtoupper($lieu)?></div>
		<div class="pttexte">
		<br/>Autocar-pas-cher.com est un service national gratuit pour la recherche d’autocars avec chauffeur <?php  echo $prefix." ".strtoupper($lieu)?> <?php  if($type_localite=='v'){ ?>et <?php  echo $prefixdpt?> <a href="<?php echo PREFIX.format(strtolower(stripcslashes($dptnom)))."-r.html";?>"><?php echo $dptnom?></a><?php } ?>.
<br/>Nous avons triés sur le volet des autocaristes <?php  echo $prefix." ".strtoupper($lieu)?>, répondant à nos critères de sélections :
<br/>Respect de la législation, chauffeurs expérimentés, flotte d’autocars et bus récente.
<br/>Ainsi Autocar pas cher vous propose le meilleur devis pour 
<?php  if($type_localite=='v'){ ?>votre location d'autocar  <?php  echo $prefix." ".strtoupper($lieu)?>, votre location d'autocar <a href="<?php echo PREFIX.format(strtolower(stripcslashes($dptnom)))."-d.html";?>"><?php echo $dptnom?></a> ou votre location d'autocars <a href="<?php echo PREFIX.format(strtolower(stripcslashes($regnom)))."-r.html";?>"><?php echo $regnom?></a>
<?php  }elseif($type_localite=='d'){ ?>votre location d'autocar <a href="<?php echo PREFIX.format(strtolower(stripcslashes($dptnom)))."-d.html";?>"><?php echo $dptnom?></a> ou votre location d'autocars <a href="<?php echo PREFIX.format(strtolower(stripcslashes($regnom)))."-r.html";?>"><?php echo $regnom?></a>
<?php  }elseif($type_localite=='r'){ ?>votre location de car <a href="<?php echo PREFIX.format(strtolower(stripcslashes($regnom)))."-r.html";?>"><?php echo $regnom?></a><?php } ?>.</div><br /><br />
		<?php  if($type_localite!='r'){ ?>
			<div class="titrenoir">Que visiter en Autocar <?php  echo $prefix." ".strtoupper($lieu)?> ?</div>
			<br/>
			<div class="pttexte">
			<?php  if($type_localite=='v'){ ?>
				<?php  echo strtoupper($lieu)?> est une ville <?php  if($ville_geo_habitants != ""){echo $ville_geo_habitants." habitants";}?> qui se situe <?php  echo $prefixdpt?> <a href="<?php echo PREFIX.format(strtolower(stripcslashes($dptnom)))."-d.html";?>"><?php echo $dptnom?></a>.
			<?php  }elseif($type_localite=='d'){ ?>
				<?php  echo strtoupper($lieu)?> est un département qui se situe <?php  echo $prefixreg?> <a href="<?php echo PREFIX.format(strtolower(stripcslashes($regnom)))."-r.html";?>"><?php echo $regnom?></a>.
			<?php  }elseif($type_localite=='r'){ ?>
			
			<?php  } ?>
			<br />
			<?php 
				function decoupeChaineEnTableau($chaineADecouper)
				{
					$tabchaine=0;
				     $j = strlen($chaineADecouper);
				     for($i = 0 ; $i < $j ; $i++)
				     {
				        $tabchaine += substr($chaineADecouper,$i,1); 
				     }
				     
				     return $tabchaine;
				}
			
				//--- SELECTION DES LOISIRS
				if($mdr_dep==75){$mdr_ville_geo_num=1231;$type_localite='v';}
				
				$SelectLoisirs="	SELECT	mdr_nom,
									mdr_ville_geo_num,
									mdr_categorie
							FROM	mdr
							WHERE	(mdr_categorie = 'Musees' OR mdr_categorie = 'Galeries d\'art' OR mdr_categorie = 'Offices de tourisme, syndicats d\'initiative'  OR mdr_categorie = 'Parcs animaliers, parcs zoologiques' OR mdr_categorie = 'Parcs d\'attractions, de loisirs' OR mdr_categorie = 'Tourisme (sites, circuits)'  OR mdr_categorie = 'Piscines' OR mdr_categorie = 'Thalasso' OR mdr_categorie = 'Hammams' OR mdr_categorie = 'Spas'  OR mdr_categorie = 'Relaxation' OR mdr_categorie = 'HOTELS')
							
							AND (mdr_dep='$mdr_dep'";
				if($type_localite=='v'){		
					$SelectLoisirs .= "OR		mdr_ville_geo_num ='$mdr_ville_geo_num'";		
				}
				$SelectLoisirs .= ")
									GROUP BY mdr_nom";
									
				//echo $SelectLoisirs;
				$RArticleAssoc=	mysql_query($SelectLoisirs);
				
				$musee = array();
				$gallerie = array();
				$office = array();
				$zoo = array();
				$attraction = array();
				$sites = array();
				$piscine = array();
				$relaxation = array();
				$hotels = array();
				
				
				while($RArticleAssoc && $row=mysql_fetch_array($RArticleAssoc)){
					if(!ereg("Mairie",$row['mdr_nom'])){
						if($row['mdr_categorie'] == "Musees"){
							if($row['mdr_ville_geo_num'] == $mdr_ville_geo_num){$musee['ville'][]=$row['mdr_nom'];}
							else{$musee['dpt'][]=$row['mdr_nom'];}
						}
						elseif(ereg("Galeries",$row['mdr_categorie'])){
							if($row['mdr_ville_geo_num'] == $mdr_ville_geo_num){$gallerie['ville'][]=$row['mdr_nom'];}
							else{$gallerie['dpt'][]=$row['mdr_nom'];}
						}
						elseif(ereg("Offices",$row['mdr_categorie'])){
							if($row['mdr_ville_geo_num'] == $mdr_ville_geo_num){$office['ville'][]=$row['mdr_nom'];}
							else{$office['dpt'][]=$row['mdr_nom'];}
						}
						elseif(ereg("animaliers",$row['mdr_categorie'])){
							if($row['mdr_ville_geo_num'] == $mdr_ville_geo_num){$zoo['ville'][]=$row['mdr_nom'];}
							else{$zoo['dpt'][]=$row['mdr_nom'];}
						}
						elseif(ereg("attractions",$row['mdr_categorie'])){
							if($row['mdr_ville_geo_num'] == $mdr_ville_geo_num){$attraction['ville'][]=$row['mdr_nom'];}
							else{$attraction['dpt'][]=$row['mdr_nom'];}
						}
						elseif(ereg("circuits",$row['mdr_categorie'])){
							if($row['mdr_ville_geo_num'] == $mdr_ville_geo_num){$sites['ville'][]=$row['mdr_nom'];}
							else{$sites['dpt'][]=$row['mdr_nom'];}
						}
						elseif(ereg("Piscines",$row['mdr_categorie'])){
							if($row['mdr_ville_geo_num'] == $mdr_ville_geo_num){$piscine['ville'][]=$row['mdr_nom'];}
							else{$piscine['dpt'][]=$row['mdr_nom'];}
						}
						elseif(ereg("Thalasso",$row['mdr_categorie']) OR ereg("Hammams",$row['mdr_categorie'])  OR ereg("Spas",$row['mdr_categorie'])  OR ereg("Relaxation",$row['mdr_categorie'])){
							if($row['mdr_ville_geo_num'] == $mdr_ville_geo_num){$relaxation['ville'][]=$row['mdr_nom'];}
							else{$relaxation['dpt'][]=$row['mdr_nom'];}
						}
						elseif(ereg("HOTELS",$row['mdr_categorie'])){
							if($row['mdr_ville_geo_num'] == $mdr_ville_geo_num){$hotels['ville'][]=$row['mdr_nom'];}
							else{$hotels['dpt'][]=$row['mdr_nom'];}
						}
					}
				}

				$nombre = decoupeChaineEnTableau($mdr_ville_geo_num);
				
				if (($nombre%2 == 0) and ($mdr_dep%2 == 0)){
					$l=3;
					$p=0;
				}
				elseif(($nombre%2 != 0) and ($mdr_dep%2 == 0)){
					$l=2;
					$p=1;
				}
				else{
					$l=1;
					$p=2;
				}
				
				/* Determine les data a afficher */
				/** **/if(($type_localite=='v') AND sizeof($musee['ville']) > 1){$lignes = sizeof($musee['ville'])-1;$musee_parc = "\"".$musee['ville'][0]."\" ou \"".$musee['ville'][$lignes]."\"";}
				else{$lignes = sizeof($musee['dpt'])-$l;$musee_parc = "\"".$musee['dpt'][$p]."\" ou \"".$musee['dpt'][$lignes]."\"";	}
				
				/** **/if(($type_localite=='v') AND sizeof($gallerie['ville']) > 1){$lignes = sizeof($gallerie['ville'])-1;$gallerie_parc = "\"".$gallerie['ville'][0]."\" ou \"".$gallerie['ville'][$lignes]."\"";}
				else{$lignes = sizeof($gallerie['dpt'])-$l;$gallerie_parc = "\"".$gallerie['dpt'][$p]."\" ou \"".$gallerie['dpt'][$lignes]."\"";	}
				
				
				/** **/if(($type_localite=='v') AND sizeof($office['ville']) > 1){$lignes = sizeof($office['ville'])-1;$office_parc = "\"".$office['ville'][0]."\" ou \"".$office['ville'][$lignes]."\"";}
				else{$lignes = sizeof($office['dpt'])-$l;$office_parc = "\"".$office['dpt'][$p]."\" ou \"".$office['dpt'][$lignes]."\"";	}
				
				/** **/if(($type_localite=='v') AND sizeof($zoo['ville']) > 1){$lignes = sizeof($zoo['ville'])-1;$zoo_parc = "\"".$zoo['ville'][0]."\" ou \"".$zoo['ville'][$lignes]."\"";}
				else{$lignes = sizeof($zoo['dpt'])-$l;$zoo_parc = "\"".$zoo['dpt'][$p]."\" ou \"".$zoo['dpt'][$lignes]."\"";}
				
				/** **/if(($type_localite=='v') AND sizeof($attraction['ville']) > 1){$lignes = sizeof($attraction['ville'])-1;$attraction_parc = "\"".$attraction['ville'][0]."\" ou \"".$attraction['ville'][$lignes]."\"";}
				else{$lignes = sizeof($attraction['dpt'])-$l;$attraction_parc = "\"".$attraction['dpt'][$p]."\" ou \"".$attraction['dpt'][$lignes]."\"";	}
				
				/** **/if(($type_localite=='v') AND sizeof($sites['ville']) > 1){$lignes = sizeof($sites['ville'])-1;$sites_parc = "\"".$sites['ville'][0]."\" ou \"".$sites['ville'][$lignes]."\"";}
				else{$lignes = sizeof($sites['dpt'])-$l;$sites_parc = "\"".$sites['dpt'][$p]."\" ou \"".$sites['dpt'][$lignes]."\"";	}
				
				/** **/if(($type_localite=='v') AND sizeof($piscine['ville']) > 1){$lignes = sizeof($piscine['ville'])-1;$piscine_parc = "\"".$piscine['ville'][0]."\" ou \"".$piscine['ville'][$lignes]."\"";}
				else{$lignes = sizeof($piscine['dpt'])-$l;$piscine_parc = "\"".$piscine['dpt'][$p]."\" ou \"".$piscine['dpt'][$lignes]."\"";	}
				
				/** **/if(($type_localite=='v') AND sizeof($relaxation['ville']) > 1){$lignes = sizeof($relaxation['ville'])-1;$relaxation_parc = "\"".$relaxation['ville'][0]."\" ou \"".$relaxation['ville'][$lignes]."\"";}
				else{$lignes = sizeof($relaxation['dpt'])-$l;$relaxation_parc = "\"".$relaxation['dpt'][$p]."\" ou \"".$relaxation['dpt'][$lignes]."\"";	}
				
				/** **/if(($type_localite=='v') AND sizeof($hotels['ville']) > 1){$lignes = sizeof($hotels['ville'])-1;$hotels_parc = "\"".$hotels['ville'][0]."\" ou \"".$hotels['ville'][$lignes]."\"";}
				else{$lignes = sizeof($hotels['dpt'])-$l;$hotels_parc = "\"".ucfirst(strtolower($hotels['dpt'][$p]))."\" ou \"".ucfirst(strtolower($hotels['dpt'][$lignes]))."\"";	}
				/* Determine les data a afficher */
				
				/*
				if (($nombre%2 == 0) and ($mdr_dep%2 == 0)){$parcours = "visiter des musées tels que $musee_parc";}
				elseif(($nombre%2 != 0) and ($mdr_dep%2 == 0)){
					
					if(sizeof($sites) > 0){
						$parcours .="allez vous divertir  dans un sites touristiques de la ville ou du département comme $sites_parc. Ca pourra être un moment de détente instructif et agréable";
					}
					
					if(sizeof($office) > 0){
						$parcours .="Si vous souhaitez en savoir plus sur la ville et sur ce qu'il est possible de faire, nos autocaristes $prefix ".strtoupper($lieu)." peuvent vous guider ou vous pouvez vous rendre à $office_parc.";
					}
					
					$parcours = "<br/>Vous pourrez ensuite continuer votre visite en y associant un touche de culture dans un des musées ($musee_parc par exemple) ou l'une des galleries d'art ($gallerie_parc) de la ville ou de la region. ";
									
					if(sizeof($attraction) > 0){
						$parcours .="<br/>Si vous n'êtes toujours pas rassasié et que vous voulez continuer à amortir votre location d'autocar, pourquoi ne demandriez vous pas à votre chauffeur de vous amener dans un parc animalier, parc zoologique ou dans un parc d'attaction ? $attraction_parc vous satisfairont pleinement !";
						}
							
						$parcours .="
					<br/>
					Pour finir, demandez à votre chauffeur d'autocar de vous conduire pour un moment de détente dans une des piscines, spa ou centre de relaxation de la région. Les choix sont nombreux et variés. Cela pourra être par exemple $relaxation_parc ou encore $piscine_parc
					<br/>Après une bonne journée bien rempli, le chauffeur de votre autobus aura grand besoin de repos et vous aussi, vous pourrez vous diriger vers un des hôtels de la ville. Pourquoi pas le $hotels_parc ?
					<br/>Profitez bien de votre location de car ".$prefix." ".strtoupper($lieu)." et dites à votre chauffeur d'autocar d'être prudent ! ;-)";

					
				}
				else{
					*/
					$parcours = "visiter des musées tels que $musee_parc puis admirer des galleries d'art comme $gallerie_parc. ";
				
					if(sizeof($office) > 0){
						$parcours .="Si vous souhaitez en savoir plus sur la ville et sur ce qu'il est possible de faire, nos autocaristes $prefix ".strtoupper($lieu)." peuvent vous guider ou vous pouvez vous rendre à $office_parc.";
					}
					
					if(sizeof($sites) > 0){
						$parcours .="<br/>Que diriez vous ensuite de faire une petite pause dans un des nombreux sites touristiques de la ville ou du département ? Cela peut être $sites_parc.";					}
					
					if(sizeof($attraction) > 0){
						$parcours .="<br/>
					Si vous n'êtes toujours pas rassasié et que vous voulez continuer à amortir votre location d'autocar, pourquoi ne demandriez vous pas à votre chauffeur de vous amener dans un parc animalier, parc zoologique ou dans un parc d'attaction ? $attraction_parc vous satisfairont pleinement !";
						}
							
						$parcours .="
					<br/>
					Pour finir, demandez à votre chauffeur d'autocar de vous conduire pour un moment de détente dans une des piscines, spa ou centre de relaxation de la région. Les choix sont nombreux et variés. Cela pourra être par exemple $relaxation_parc ou encore $piscine_parc
					<br/>Après une bonne journée bien rempli, le chauffeur de votre autobus aura grand besoin de repos et vous aussi, vous pourrez vous diriger vers un des hôtels de la ville. Pourquoi pas le $hotels_parc ?
					<br/>Profitez bien de votre location de car ".$prefix." ".strtoupper($lieu)." et dites à votre chauffeur d'autocar d'être prudent ! ;-)";
				//}
			?>
			En autocar, <?php  echo $prefix." ".strtoupper($lieu)?> <?php  if($type_localite=='v'){ ?>ou <?php  echo $prefixdpt?> <a href="<?php echo PREFIX.format(strtolower(stripcslashes($dptnom)))."-r.html";?>"><?php echo $dptnom?></a><?php } ?> vous pourrez <?php  echo $parcours?></div>
			
			<?php  if($type_localite=='d'){ ?>
				
			<?php  } ?>
			
		<?php  } ?>
	</div>
	<div class="textedroite">
		<div class="titreorange">Dernières demandes de Location d'autocars au départ de <?php  echo strtoupper($lieu)?></div>
		<br /><ul>
		<?php 
			$Qtrajet = "SELECT ville_depart,dep,ville_arrive,passagers,nombre,nom,structure FROM autocar_trajets WHERE ville_depart='$mdr_ville_geo_num' LIMIT 0,12";
			$Rtrajet=	mysql_query($Qtrajet);
			
			while($Rtrajet && $row=mysql_fetch_array($Rtrajet)){
				$queryforum = "SELECT mdr_ville FROM mdr WHERE mdr_ville_geo_num='".$row['ville_arrive']."' LIMIT 0,1";
				$resultforum = mysql_query($queryforum);
				$mdr_ville = @mysql_result($resultforum,0,"mdr_ville");

				
				echo "<li>$lieu - <a href=\"".PREFIX.format(strtolower(stripcslashes($mdr_ville)))."-v.html\">".ucfirst(strtolower($mdr_ville))."</a> : Demande de ".$row[nom]." - ".$row[passagers]." voyageurs, ".$row[nombre]." ".$row[structure]."</li>";	
			}	
			
		?>
		</ul>
	</div>
    
    
</div><!-- end of main_area -->
</div><!-- end of main -->
<script type='text/javascript' src='<?php echo PATH_ROOT?>js/jquery.js'></script>
<script type='text/javascript' src='<?php echo PATH_ROOT?>js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='<?php echo PATH_ROOT?>js/contactann.js'></script>
<?php 
include_once "inc/bas.inc.php";
?>