<?php 
// on determine le nb total de pages a paginer
$nb_resultats_total = $count;
$total_pagination = 1;
while($nb_resultats_total > $nb_resultats_par_page)
{
    $nb_resultats_total = $nb_resultats_total-20;
    $total_pagination++;
}
// url
$url_pagination_debut = DOSSIERANN.PREFIX.format($lieu)."-".$type_localite."p";
$url_pagination_fin   = "-t".$count.".html";

?>
<div class="numerotation">
    <div class="numeros">
    <?php 
    
    if($page_courante==1) // si on est en premiere page
    {
    ?>
        <a title="<?php echo $page_courante?>" class="actuel" href="<?php echo PATH_ROOT.$url_pagination_debut.$page_courante.$url_pagination_fin?>"><?php echo $page_courante?></a> 
        <a title="<?php echo ($page_courante+1)?>" class="pageOff" href="<?php echo PATH_ROOT.$url_pagination_debut.($page_courante+1).$url_pagination_fin?>"><?php echo ($page_courante+1)?></a> 
        <?php if($total_pagination>2){?>
         <a title="<?php echo ($page_courante+2)?>" class="pageOff" href="<?php echo PATH_ROOT.$url_pagination_debut.($page_courante+2).$url_pagination_fin?>"><?php echo ($page_courante+2)?></a>
        <?php } ?>
        <a title="page suivante" class="pageOff" href="<?php echo PATH_ROOT.$url_pagination_debut.($page_courante+1).$url_pagination_fin?>"><i class="icon-chevron-right"></i></a>
        
    <?php   
    }
    elseif($page_courante==$total_pagination) // si on est en derniere page
    {
    ?>
        <a title="page pr?c?dente" class="pageOff" href="<?php echo PATH_ROOT.$url_pagination_debut.($page_courante-1).$url_pagination_fin; ?>">« Précétente&nbsp;</a>
        <?php if($total_pagination>2){ ?>
        <a title="<?php echo ($page_courante-2)?>" class="pageOff" href="<?php echo PATH_ROOT.$url_pagination_debut.($page_courante-2).$url_pagination_fin?>"><?php echo ($page_courante-2)?></a> 
        <?php } ?>
        <a title="<?php echo ($page_courante-1)?>" class="pageOff" href="<?php echo PATH_ROOT.$url_pagination_debut.($page_courante-1).$url_pagination_fin?>"><?php echo ($page_courante-1)?></a> 
        <a title="<?php echo $page_courante?>" class="actuel" href="<?php echo PATH_ROOT.$url_pagination_debut.$page_courante.$url_pagination_fin?>"><?php echo $page_courante?></a>   
    <?php 
    }
    else // si on est en milieu de pagination
    {
    ?>
        <a title="page precedente" class="pageOff" href="<?php echo PATH_ROOT.$url_pagination_debut.($page_courante-1).$url_pagination_fin?>">« Précétente&nbsp;</a>
        <a title="<?php echo ($page_courante-1)?>" class="pageOff" href="<?php echo PATH_ROOT.$url_pagination_debut.($page_courante-1).$url_pagination_fin?>"><?php echo ($page_courante-1)?></a> 
        <a title="<?php echo $page_courante?>" class="actuel" href="<?php echo PATH_ROOT.$url_pagination_debut.$page_courante.$url_pagination_fin?>"><?php echo $page_courante?></a> 
        <a title="<?php echo ($page_courante+1)?>" class="pageOff" href="<?php echo PATH_ROOT.$url_pagination_debut.($page_courante+1).$url_pagination_fin?>"><?php echo ($page_courante+1)?></a>
        <a title="page suivante" class="pageOff" href="<?php echo PATH_ROOT.$url_pagination_debut.($page_courante+1).$url_pagination_fin?>"><i class="icon-chevron-right"></i></a>
    <?php 
    }
    ?>
    </div>
	<p><!--1-10 sur --> <?php echo $count?> autocaristes</p>
</div>



<!--
<div class="numerotation">
	<div class="numeros">
		<a href="#" class="actuel">1</a>	
		<a href="#">2</a>	
		<a href="#">3</a>	
		<a href="#">4</a>	
		<a href="#">5</a>	
		<a href="#">6</a>	
		<a href="#">7</a>	
		<a href="#"><i class="icon-chevron-right"></i></a>	
	</div>
	<p>1-10 sur 125 autocaristes</p>
</div>-->