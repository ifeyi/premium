<div id="form_vert_top">
Contactez-nous<br /><span class="texte" style="color: white; font-weight: normal; line-height: 31px;">Un conseiller vous rappelle</span>
</div>

<?php if(!empty($MSG))
{
    echo '<div id="form_vert_confirmation">';
    echo $MSG ;
}
else
{ ?> 
<div id="form_vert">
<form action="#" method="POST" id="form_vertical">
<input type="hidden" name="ACTION" value="DOC" />
<div id="tooltip_form" style="width: 255px;">
    <div id="tooltip_fleche">&nbsp;</div>
    <div id="tooltip_bg" style="width: 255px;">&nbsp;</div>
</div>

    <span class="form_vert_label"><span style="font-size: 19px;">1.</span> Critères de recherche</span><br />
    
    <div class="form_vert_champ_deroulant" id="TTdepartement">
    <dl>
    <dd id="demo-default-usage">
    <div class="demoTargetPaca">
    <select name="DEPT" id="DEPT">
        <option value="0">Département :</option>
        <?phpwhile($RDep && $dep=mysql_fetch_array($RDep))
		{
		echo '<option value="'.$dep['departement_id'].'"';
        if($dep['departement_id'] == $dep_geoloc)
            echo ' selected="selected" '; 
        echo '>'.$dep['nom_dep_min'].' ('.$dep['departement_id'].')</option>';
       	}
		?>
    </select>
    </div>
    </dd>
    </dl>
    </div>
    
    <div class="form_vert_champ_deroulant" id="TTdelai">           
    <dl>
    <dd id="demo-default-usage">
    <div class="demoTargetPaca">
    <select name="date_entree" id="date_entree">
        <option value="0">Délai :                  </option>
        <option value="1"> Le plus tôt possible    </option>
		<option value="3"> 1 à 3 mois              </option>
		<option value="4"> 3 à 6 mois              </option>
		<option value="5"> Plus de 6 mois          </option>
    </select>
    </div>
    </dd>
    </dl>
    </div>

    <span class="space"><br /></span>
    
    <span class="form_vert_label"><span style="font-size: 19px;">2.</span> Informations confidentielles</span><br />
    <div class="form_vert_champ" id="TTnom">
    <input type="text" name="nom_contact" id="nom_contact" value="Nom :"
    onclick="if(this.value=='Nom :') this.value='';"
    onkeypress="if(this.value=='Nom :') this.value='';"
    onblur="if(this.value=='') this.value='Nom :';"
    />
    </div>
    
    <div class="form_vert_champ" id="TTtel">
    <input type="text" name="tel_personnel_contact" id="tel_personnel_contact" value="Tel :" 
    onclick="if(this.value=='Tel :') this.value=''; "
    onkeypress="if(this.value=='Tel :') this.value=''; tape(this,2,'.');"
    onblur="if(this.value=='') this.value='Tel :';"
    maxlength="14"
    />
    </div>
    
    <div class="form_vert_champ" id="TTemail">
    <input type="text" name="email" id="email" value="Email :" 
    onclick="if(this.value=='Email :') this.value='';"
    onkeypress="if(this.value=='Email :') this.value='';"
    onblur="if(this.value=='') this.value='Email :';"
    />
    </div>
    
    
    <img src="<?php echo PATH_ROOT?>images/form-vertical-envoyer.jpg" width="257px" height="51px" onclick="checkMainForm('form_vertical');" style="cursor: pointer; margin-top: 15px; margin-left: -5px;" /><br />
    <span class="form_vert_contact">Vous serez contacté par téléphone ou email</span><br />
    <span class="space"><br /><br /></span>
    <span class="form_confidentialite">
    Viaretraite adopte une politique de strict respect de la confidentialité &nbsp;de vos données, conformément à la loi n&#176;78-17 du 6 janvier 1978 &nbsp;relative à l'informatique, aux fichiers et aux libertés.<br />
    <a href="<?php echo PATH_ROOT?>mentions.php">mentions légales</a> | <a href="<?php echo PATH_ROOT?>confidentialite.php">politique de confidentialité</a>
    </span>
</form>

<script type="text/javascript">
//<![CDATA[
$("#demo-default-usage .demoControls").find('.replace').bind('click', function(){
$("#DEPT").selectbox();
});
$("#demo-default-usage .demoControls").find('.undo').bind('click', function(){
$("#DEPT").parents('.jquery-selectbox2').unselectbox();
});
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
$("#demo-default-usage .demoControls").find('.replace').bind('click', function(){
$("#date_entree").selectbox();
});
$("#demo-default-usage .demoControls").find('.undo').bind('click', function(){
$("#date_entree").parents('.jquery-selectbox2').unselectbox();
});
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
	$("#date_entree").selectbox('jquery-selectbox2').bind('change', function(){
		$('<div>&nbsp;</div>').appendTo('#demo-default-usage .demoTarget').fadeOut(5000, function(){
			$(this).remove();
		});
	});
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
	$("#DEPT").selectbox('jquery-selectbox2').bind('change', function(){
		$('<div>&nbsp;</div>').appendTo('#demo-default-usage .demoTarget').fadeOut(5000, function(){
			$(this).remove();
		});
	});
//]]>
</script>
<?}?>

</div>

<img src="<?php echo PATH_ROOT?>images/bottom-form-vertical.jpg" width="288px" height="22px" style="margin-bottom: 20px;"/>