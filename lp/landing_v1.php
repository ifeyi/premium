<?php 
$page = 'landing';
include_once "../inc/haut.inc.php";
?>

<div id="main_area">
<div id="main_landing">
<?php 
include "../inc/formulaire_horizontal.php";
?>

<div id="btn_emploi_landing">
    <a href="<?php echo PATH_ROOT?>emploi.html" target="_blank">
    <img src="<?php echo PATH_ROOT?>images/bouton-emploi-landing.jpg" width="385px" height="44px" border="0" 
    onmouseover="this.src='<?php echo PATH_ROOT?>images/bouton-emploi-landing-rollover.jpg';"
    onmouseout="this.src='<?php echo PATH_ROOT?>images/bouton-emploi-landing.jpg';"
    />
    </a>
</div>

</div><!-- end of main_area -->
</div><!-- end of main -->

<div style="clear:both;"></div>

<div id="footer_area" style="height: 110px;">
<div id="footer_landing">
    <ul>
        <li><a>Annuaire</a></li>
        <li><a>Apa &#38; Tarifs</a></li>
        <li><a>Maisons de retraite</a></li>
        <li><a>Alzheimer</a></li>
        <li><a>A propos</a></li>
        <li><a>Espace Emploi</a></li>
        <li><a>Mentions légales</a></li>
        <li><a style="border: none;">Politique de confidentialite</a></li>   
    </ul>
    <span class="space"><br /></span>
    <span style="font-size: 12px; color: white;;">Copyright 2011 Viaretraite © - Service gratuit d’écoute et d’orientation en maison de retraite</span>
</div>
</div>