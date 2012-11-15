<?php 
$page = 'home';
$texte_input_recherche = 'Entrez une localité';
include_once "inc/recherche.ann.php";
include_once "inc/haut.inc.php";

$QartHasard = " SELECT	cap_ob_carticle_num,
                        cap_ob_carticle_ob_cdossier_num,
						cap_ob_carticle_titre,
						cap_ob_carticle_desc,
                        cap_ob_cdossier_nom
				FROM	cap_ob_carticle,
                        cap_ob_cdossier
				WHERE	cap_ob_cdossier_num = cap_ob_carticle_ob_cdossier_num
                AND     cap_ob_carticle_ob_cdossier_num >= 107
                AND     cap_ob_carticle_ob_cdossier_num <= 110
				ORDER BY RAND()";
$RartHasard = mysql_query($QartHasard);
$compteur = 1;
while($RartHasard && $artHasard = mysql_fetch_array($RartHasard))
{
    if($artHasard['cap_ob_carticle_ob_cdossier_num'] != $dossierCourant)
      $compteur++;
    $dossierCourant = $artHasard['cap_ob_carticle_ob_cdossier_num'];
    $dossierHasard[$compteur] = $artHasard['cap_ob_carticle_ob_cdossier_num'];
    $articleHasard_num[$dossierCourant]         = $artHasard['cap_ob_carticle_num'];
    $articleHasard_titre[$dossierCourant]       = $artHasard['cap_ob_carticle_titre'];
    $articleHasard_desc[$dossierCourant]        = $artHasard['cap_ob_carticle_desc'];
    $articleHasard_dossierNom[$dossierCourant]  = $artHasard['cap_ob_cdossier_nom'];
}
?>

<div id="main_area">
<div id="main_home">
    
    <div class="content_small">
        <!-- ANNUAIRE -->
        <div class="content_small">
            
            <div class="content_small_titre" >
            <a class="titre_bleu" href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite.html">Annuaire des maisons de retraite</a><br />
            <span class="titre_small">Sélectionnez un département sur la carte interactive ci-dessous :</span><br />
            </div>
            
            <div id="home_content_left">
                <span class="titre_bold">Recherchez par ville</span><br />
                <span class="space"><br /></span>
                <ul>
                    <li><a class="texte" href="<?php echo PATH_ROOT?><?php echo DOSSIERANN?><?php echo PREFIX?>paris-d.html">maison de retraite Paris</a></li>
                    <li><a class="texte" href="<?php echo PATH_ROOT?><?php echo DOSSIERANN?><?php echo PREFIX?>marseille-v.html">maison de retraite Marseille</a></li>
                    <li><a class="texte" href="<?php echo PATH_ROOT?><?php echo DOSSIERANN?><?php echo PREFIX?>lyon-v.html">maison de retraite Lyon</a></li>
                    <li><a class="texte" href="<?php echo PATH_ROOT?><?php echo DOSSIERANN?><?php echo PREFIX?>toulouse-v.html">maison de retraite Toulouse</a></li>
                    <li><a class="texte" href="<?php echo PATH_ROOT?><?php echo DOSSIERANN?><?php echo PREFIX?>nice-v.html">maison de retraite Nice</a></li>
                    <li><a class="texte" href="<?php echo PATH_ROOT?><?php echo DOSSIERANN?><?php echo PREFIX?>nantes-v.html">maison de retraite Nantes</a></li>
                    <li><a class="texte" href="<?php echo PATH_ROOT?><?php echo DOSSIERANN?><?php echo PREFIX?>strasbourg-v.html">maison de retraite Strasbourg</a></li>
                    <li><a class="texte" href="<?php echo PATH_ROOT?><?php echo DOSSIERANN?><?php echo PREFIX?>montpellier-v.html">maison de retraite Montpellier</a></li>
                    <li><a class="texte" href="<?php echo PATH_ROOT?><?php echo DOSSIERANN?><?php echo PREFIX?>bordeaux-v.html">maison de retraite Bordeaux</a></li>
                </ul>
                
                <br /><br />
                
                <span class="titre_bold">Recherchez par localité :</span><br />
                <span class="space"><br /></span>
                <?phpinclude "autocomplete_wick/wick_form.php";?>
            </div>
            
            
            <div id="home_content_right">
                <?phpinclude "inc/map.php";?>
            </div>
        </div><!-- end of content_small -->
        
        
        <!-- ARTICLES -->
        <div class="content_small">
            
            <div class="content_small_titre" >
            <span class="titre_bleu">Actualité des maisons de retraite</span><br />
            <span class="titre_small">Des articles sur des sujets pratiques pour vous éclairer...</span><br />
            </div>
        
            <?phpforeach($articleHasard_titre as $key => $value){?>
            <div class="home_art">
                <div class="home_art_img">
                    <a href="<?php echo PATH_ROOT.format($articleHasard_dossierNom[$key])."/".format($value)."-".$articleHasard_num[$key]."-".$key.".html"?>"><img src="<?php echo PATH_ROOT?>images/pic-article.jpg" width="218px" height="110px" border="0" /></a>
                </div>
                
                <div class="home_art_txt">
                    <a class="titre_bold" href="<?php echo PATH_ROOT.format($articleHasard_dossierNom[$key])."/".format($value)."-".$articleHasard_num[$key]."-".$key.".html"?>"><?php echo $value?></a><br />
                    <!-- <span class="space"><br /></span> -->
                    <a class="texte" href="<?php echo PATH_ROOT.format($articleHasard_dossierNom[$key])."/".format($value)."-".$articleHasard_num[$key]."-".$key.".html"?>">
                    <?php 
                    $arrayTags = array("<p>", "</p>", "<b>", "</b>", "<br>", "<br/>", "<br />");
                    $articleHasard_desc[$key] = str_replace($arrayTags, "", $articleHasard_desc[$key]);
                    $artHasardDesc = explode(" ", $articleHasard_desc[$key]);
                    for($i=0; $i<=15; $i++)
                        echo $artHasardDesc[$i]." ";?>...</a><br />
                    <span class="space"><br /></span>
                    <a class="home_suite" href="<?php echo PATH_ROOT.format($articleHasard_dossierNom[$key])."/".format($value)."-".$articleHasard_num[$key]."-".$key.".html"?>">Lire la suite</a>
                </div>
            </div>
            <?}?>

            
        </div><!-- end of content_small -->
   </div><!-- end of content_small pour tout le contenu -->
    
    
</div>
</div>

<?php 
include_once "inc/bas.inc.php";
?>