<?php 
$page = 'contenu';
$texte_input_recherche = 'Entrez une localit&eacute;';
require_once "inc/config.inc.php";
require_once "inc/fonction.inc.php";
include_once "inc/recherche.ann.php";

// SI PAGE DOSSIER
if(isset($_GET['dossier_id']) && !isset($_GET['article_id']))    
{
    // REQUETE NOM + ACCROCHE DOSSIER
    $QDossier="	SELECT 	th_text_site_text,
                                cap_ob_cdossier_nom
            			FROM	th_text_site,
                                cap_ob_cdossier
            			WHERE	th_text_site_num_fiche = cap_ob_cdossier_num
                        AND     th_text_site_type = 3913
                        AND     th_text_site_num_fiche = {$_GET['dossier_id']}";
    $RDossier = mysql_query($QDossier);
    
    while($RDossier && $dossier=mysql_fetch_array($RDossier))
    {
    	/* CODE NON NECESSAIRE PUISQU'ON A ORGANISE LES METAS MANUELLEMENT
        switch($dossier['th_text_site_type'])
    	{
    		case TEXTE_TYPE_ACCROCHE:
    			$dossier_accroche = $dossier['th_text_site_text'];
    			break;
    		case TEXTE_TYPE_META_TITRE:
    			$dossier_metatitre = strip_tags($dossier['th_text_site_text']);
    			break;
    		case TEXTE_TYPE_META_DESCRIPTION:
    			$dossier_metadesc = strip_tags($dossier['th_text_site_text']);
    			break;
    		case TYPE_META_KEYWORD:
    			$dossier_metakw = strip_tags($dossier['th_text_site_text']);
    			break;
    	}
        */    
        $dossier_titre = $dossier['cap_ob_cdossier_nom'];
        $dossier_accroche = $dossier['th_text_site_text'];
    }
    
    // REQUETE LISTE ARTICLES
    $QartDossier="	SELECT	cap_ob_carticle_num,
                            cap_ob_carticle_ob_cdossier_num,
    						cap_ob_carticle_titre,
    						cap_ob_carticle_desc
    				FROM	cap_ob_carticle
    				WHERE	cap_ob_carticle_ob_cdossier_num={$_GET['dossier_id']}
    				ORDER BY cap_ob_carticle_order";
    $RartDossier=mysql_query($QartDossier);
}
// SI PAGE ARTICLE
elseif(isset($_GET['article_id']))
{
    // REQUETE METAS + CONTENU DE L'ARTICLE
    $Qarticle = "   SELECT 	cap_ob_carticle_titre,
							cap_ob_carticle_desc,
                            cap_ob_carticle_contenu,
							cap_ob_carticle_ob_carticle_num,
							cap_ob_carticle_metatitre,
							cap_ob_carticle_metadesc,
							cap_ob_carticle_metakw,
							cap_ob_cdossier_nom,
							cap_ob_cdossier_num
					FROM 	cap_ob_carticle,
							cap_ob_cdossier 
					WHERE 	cap_ob_cdossier_num=cap_ob_carticle_ob_cdossier_num
					AND		cap_ob_carticle_num='{$_GET['article_id']}'
                    ORDER BY cap_ob_carticle_order";	 						  
    
    $Rarticle=mysql_query($Qarticle);
    
    $article_titre          = mysql_result($Rarticle,0,"cap_ob_carticle_titre");
    $article_desc           = mysql_result($Rarticle,0,"cap_ob_carticle_desc");
    $article_contenu        = mysql_result($Rarticle,0,"cap_ob_carticle_contenu");
    $article_metatitre      = mysql_result($Rarticle,0,"cap_ob_carticle_metatitre");
    $article_metadesc       = mysql_result($Rarticle,0,"cap_ob_carticle_metadesc");
    $article_metakw         = mysql_result($Rarticle,0,"cap_ob_carticle_metakw");
    $dossier_titre          = mysql_result($Rarticle,0,"cap_ob_cdossier_nom");
    $dossier_num            = mysql_result($Rarticle,0,"cap_ob_cdossier_num");
   
    
    // remplacement des liens a l'interieur du contenu des articles (www.tmdr.fr -> www.viaretraite.fr OU AUTRE CHOSE)
    if($_SERVER['SERVER_NAME'] == "192.168.0.4")
        $article_contenu = str_replace("www.trouver-maison-de-retraite.fr", "192.168.0.4/site_trouvermaisonderetraite/viaretraite", $article_contenu);
    //else
        //$article_contenu = str_replace("www.trouver-maison-de-retraite.fr", "www.viaretraite.fr", $article_contenu);
        
    
    // REQUETE ARTICLES - A LIRE AUSSI
    $QartAussi = "  SELECT  cap_ob_carticle_titre,
                            cap_ob_carticle_num
                    FROM    cap_ob_carticle
                    WHERE   cap_ob_carticle_ob_cdossier_num = {$_GET['dossier_id']}
                    AND     cap_ob_carticle_num != {$_GET['article_id']}";
    $RartAussi = mysql_query($QartAussi);        
}

include_once "inc/haut.inc.php";

// INTITULE LIVE CHAT
switch($_GET['dossier_id'])
{
case 107:
    $chat_sujet = "les Maisons de Retraite";
    break;
case 108:
    $chat_sujet = "l'APA et les Subventions";
    break;
case 109:
    $chat_sujet = "la maladie d'Alzheimer";
    break;
case 110:
    $chat_sujet = "les EHPAD";
    break;
}

// tableau pour enlever les balises problematiques generees par la base dans les articles
$arrayTags = array("<p>", "</p>", "<br>", "<br/>", "<br />", "<b>", "</b>");
?>

<div id="main_area">
<div id="main">

    <!-- CONTENU -->
    <div class="content_small">
        
    <?phpif(isset($_GET['dossier_id'])){?>
        <!-- FIL ARIANNE -->
        <div id="fil_arianne">
        <a href="<?php echo PATH_ROOT?>">Accueil</a>
        &nbsp;&#155;&#155;&nbsp; <a href="<?php echo PATH_ROOT.format($dossier_titre)."/".format($dossier_titre)."-".$_GET['dossier_id'].".html"?>"><?php echo $dossier_titre?></a>    
        <?phpif(isset($_GET['article_id'])){?>
        &nbsp;&#155;&#155;&nbsp; <a href="<?php echo $_SERVER['REQUEST_URI']?>"><?php echo $article_titre?></a>
        <?}?>    
        </div>
    <?}?> 
        
    <?phpif(isset($_GET['dossier_id']) && !isset($_GET['article_id'])){?>
        <div class="content_small_titre">
        <span class="titre_bleu"><?php echo $dossier_titre?></span>
        </div>
        <span class="texte" style="font-style: italic; color: #494949;"><?$dossier_accroche=str_replace($arrayTags, "", $dossier_accroche); echo $dossier_accroche;?></span>
        </p></span><br />
                
        <?phpwhile($RartDossier && $artDossier=mysql_fetch_array($RartDossier)){?>	
        <img src="<?php echo PATH_ROOT?>images/puce-liste-articles.jpg" width="16" height="17" />&nbsp;&nbsp;<a class="titre_article" href="<?php echo PATH_ROOT.format($dossier_titre)."/".format($artDossier['cap_ob_carticle_titre'])."-".$artDossier['cap_ob_carticle_num']."-".$_GET['dossier_id'].".html"?>" class="lien_article"><?php echo $artDossier['cap_ob_carticle_titre']?></a><br />
        <a class="texte" href="<?php echo PATH_ROOT.format($dossier_titre)."/".format($artDossier['cap_ob_carticle_titre'])."-".$artDossier['cap_ob_carticle_num']."-".$_GET['dossier_id'].".html"?>" class="texte_courant">
        <?$artDossier['cap_ob_carticle_desc'] = str_replace($arrayTags, "", $artDossier['cap_ob_carticle_desc']); 
        $art=explode(" ",$artDossier['cap_ob_carticle_desc']);
    	for($i=0;$i<50;$i++)
    	   echo $art[$i]." ";?>...
        </a><br />
        <div class="suite">
        <a href="<?php echo PATH_ROOT.format($dossier_titre)."/".format($artDossier['cap_ob_carticle_titre'])."-".$artDossier['cap_ob_carticle_num']."-".$_GET['dossier_id'].".html"?>" class="lien_lire_suite">Lire la suite</a>
        </div>
        <br />
    <?}?>
    
    <?}
    elseif(isset($_GET['article_id'])){?>
        <!-- ARTICLE -->
        <span class="titre_bleu" href="<?php echo $_SERVER['REQUEST_URI']?>"><?php echo $article_titre?></span><br />
        <span class="space"><br /></span>
        
        <span class="texte" style="font-style: italic;"><?$article_desc = str_replace($arrayTags, "", $article_desc); echo DecodeQuiSommesNous($article_desc);?></span><br /><br />
        
        <span class="texte"><?$article_contenu = str_replace($arrayTags, "", $article_contenu); echo Decode($article_contenu);?></span></p><br />
    <?}?>
    
        <!-- BARRE RETOUR -->
        <div id="barre_retour_div">
            <div id="barre_retour_left">&nbsp;</div>
            <div id="barre_retour">
            <a href="#haut_de_page">&nbsp;&#171; Retour en haut de page</a>
            <?phpif(isset($_GET['article_id'])){?><a class="barre_retour_dossier" href="<?php echo PATH_ROOT.format($dossier_titre)."/".format($dossier_titre)."-".$_GET['dossier_id'].".html"?>">Retour à la liste &#187;</a><?}?>
            </div>
            <div id="barre_retour_right">&nbsp;</div>
        </div>
        
        <!-- CHAT -->
        <span class="titre_bold" style="font-size: 16px;"><img src="<?php echo PATH_ROOT?>images/puce-jaune.png" width="10px" height="12px" /> Vous désirez en savoir plus sur <?php  echo $chat_sujet?> ?</span><br />
        <a href="#" class="texte">Cliquez ici pour dialoguer en direct avec un conseiller spécialisé.</a><br /><br />
        
        <!-- A LIRE AUSSI -->
        <?php  if(isset($_GET['article_id']) && mysql_num_rows($RartAussi)!=0){?>
        <span class="titre_bold" style="font-size: 16px;"><img src="<?php echo PATH_ROOT?>images/puce-jaune.png" width="10px" height="12px" /> A lire également :</span><br />
        <ul>
        <?phpwhile($RartAussi && $artAussi = mysql_fetch_array($RartAussi)){?>
            <li>
                <a class="texte" href="<?php echo PATH_ROOT.format($dossier_titre)."/".format($artAussi['cap_ob_carticle_titre'])."-".$artAussi['cap_ob_carticle_num']."-".$_GET['dossier_id'].".html"?>"><?php echo $artAussi['cap_ob_carticle_titre']?></a>
            </li>
        <?}?>
        </ul>
        <br />
        <?}?>    
    
    </div><!-- end of content_small -->
    
    <!-- SIDE -->
    <div id="side">
        
        <!-- FORM VERTICAL -->
        <?phpinclude "inc/formulaire_vertical.php";?>
        
        <!-- SIDE BOUTONS -->
        <?phpinclude "inc/side_boutons.php";?>
        
        <!-- MINI CARTE -->
        <img src="<?php echo PATH_ROOT?>images/top-minicarte.jpg" width="288px" height="22px" class="marge_img" />
        <div class="mini_carte_box1" style="height: 110px;">
            <span class="side_titre">Recherchez une maison de retraite</span><br />
            <span class="space"><br /></span>
            <span class="side_texte">Choisissez un département dans la carte de France :</span><br />
        </div>
        <div class="mini_carte_box2" style="height: 320px;">
            <?phpinclude "inc/map_small.php";?>
        </div>
        <div class="mini_carte_box1" style="height: 50px;">
            <?phpinclude "autocomplete_wick/wick_form.php";?>
        </div>
        
        <img src="<?php echo PATH_ROOT?>images/bottom-minicarte.jpg" width="288px" height="22px" style="margin-bottom: 20px;" />
        
    </div><!-- end of side -->

</div><!-- end of main -->
</div><!-- end of main_area -->

<?php 
include_once "inc/bas.inc.php";
?>
