<?php 
$page = '404';
include_once "inc/haut.inc.php";

// REQUETE LISTE ARTICLES PLAN
$QArticleAssoc="	SELECT	cap_ob_carticle_titre titre,
	 						cap_ob_carticle_num num,
	 						cap_ob_carticle_header_order header,
							cap_ob_cdossier_num numPere,
							cap_ob_cdossier_nom articlePere
					FROM	cap_ob_carticle,
			 				cap_ob_cdossier
					WHERE	cap_ob_carticle_ob_cdossier_num=cap_ob_cdossier_num
					AND		cap_ob_carticle_ob_carticle_num=0
					AND		cap_ob_cdossier_actif=1
					AND		cap_ob_cdossier_type=3917
					AND		cap_ob_cdossier_num!=111
                    ORDER BY cap_ob_cdossier_order,cap_ob_carticle_order";
$RArticleAssoc=	mysql_query($QArticleAssoc);
?>

<div id="main_area">
<div id="main">
    <!-- FIL ARIANNE -->
    <div id="fil_arianne">
    <a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>">Accueil</a>
    &nbsp;&#155;&#155;&nbsp; <a href="<?php echo $_SERVER['REQUEST_URI']?>">Erreur 404</a>    
    </div>
    
    <!-- CONTENU -->
    <div id="content">
    <?phpwhile($RArticleAssoc && $row=mysql_fetch_array($RArticleAssoc))
    {	  		
    if($row['articlePere']!=$pere)
    {
    	if($pere!="")
    	{
    		echo "</ul><br /><br />";
    	}
    	echo "<a class='plan_titre' target=\"_blank\" href='".PATH_ROOT.format($row['articlePere'])."/".format($row['articlePere'])."-{$row['numPere']}.html' title='{$row['articlePere']}'>{$row['articlePere']}</a>
        <ul>";
    	$pere=$row['articlePere'];	        			
    }        	
    	echo "<li><a class='plan_soustitre' target=\"_blank\" href='".PATH_ROOT.format($row['articlePere'])."/".format($row["titre"])."-{$row['num']}-{$row['numPere']}.html' title='{$row['titre']}'>{$row['titre']}</a></li>";       		
    }?>
    
    <br /><br />
    <a class="plan_titre" target="_blank" href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite.html">Annuaire maison de retraite</a>
    <ul>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-paris-d.html">Annuaire maison de retraite paris</a></li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-marseille-v.html">Annuaire maison de retraite marseille</a></li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-toulouse-v.html">Annuaire maison de retraite toulouse</a></li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-nice-v.html">Annuaire maison de retraite nice</li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-montpellier-v.html">Annuaire maison de retraite montpellier</a></li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-aix-en-provence-v.html">Annuaire maison de retraite aix-en-provence</a></li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-drancy-v.html">Annuaire maison de retraite drancy</a></li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-clermont-ferrand-v.html">Annuaire maison de retraite clermont-ferrand</a></li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-boulogne-billancourt-v.html">Annuaire maison de retraite boulogne-billancourt</a></li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-le-mans-v.html">Annuaire maison de retraite le mans</a></li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-toulon-v.html">Annuaire maison de retraite toulon</a></li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-lyon-v.html">Annuaire maison de retraite lyon</a></li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-levallois-perret-v.html">Annuaire maison de retraite levallois-perret</a></li>
        <li><a class='plan_soustitre' target='_blank' href="<?php echo PATH_ROOT?>annuaire-maison-de-retraite/maison-de-retraite-antony-v.html">Annuaire maison de retraite antony</a></li>
        <?phpwhile($RDep && $dept=mysql_fetch_array($RDep))
		{
            echo "<li><a class='plan_soustitre' target='_blank' href='annuaire-maison-de-retraite/maison-de-retraite-".format($dept['departement_id'])."-d.html' target='_blank' title='maison de retraite {$dept['nom_dep_min']}'>Annuaire maison de retraite ".ucfirst($dept['nom_dep_min'])." ({$dept['departement_id']})</a></li>";
		}
		?>
    </ul>
    <br /><br />
    
    <a class="plan_titre" target="_blank" href="<?php echo PATH_ROOT?>a-propos.html">A propos de Viaretraite.fr</a>
    <br /><br />
    
    <a class="plan_titre" target="_blank" href="<?php echo PATH_ROOT?>contact.html">Contactez-nous</a>
    <br /><br />
    
    <a class="plan_titre" target="_blank" href="<?php echo PATH_ROOT?>mentions-legales.html">Mentions légales</a>
    <br /><br />
    
    </div><!-- end of content -->
    
    <!-- SIDE -->
    <?phpinclude_once "inc/side.php";?>
</div>
</div>

<?php 
include_once "inc/bas.inc.php";
?>