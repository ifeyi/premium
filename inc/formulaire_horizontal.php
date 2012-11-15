<div id="form_horiz_div"> 
    <?php if(!empty($MSG))
    {
        echo '<div id="form_horiz_confirmation">';
        echo $MSG ;
    }
    else
    { ?>
	<div class="titre_bleu" style="margin-bottom: 10px;"><?php echo str_replace("#DEST#",strtoupper($lieu),FORMULAIRE)?></div>
    <div id="form_horiz">
        
                
        <form method="POST" action="#" id="form_horizontal">
        <input type="hidden" name="ACTION" value="DOC" />
        <div id="tooltip_form" style="width: 270px;">
            <div id="tooltip_fleche">&nbsp;</div>
            <div id="tooltip_bg" style="width: 270px;">&nbsp;</div>
        </div>
        
        <table width="946px" cellpadding="0px" cellspacing="0px">
        <tr>
            <td class="form_horiz_td_titre" >Votre trajet & Vos besoins</td>
            <td class="form_horiz_td_titre" >Vos informations de contact</td>
            <td class="form_horiz_td_titre" >Recevez vos devis d'Autocaristes</td>
        </tr>
        <tr>
            <td class="form_horiz_td" style="background: url(<?php echo PATH_ROOT?>images/champ.png) no-repeat;" id="TTtel">                                                                
                <input type="text" name="ville_de_depart" id="ville_de_depart" value="Ville de départ :" 
                onclick="if(this.value=='Ville de départ :') this.value=''; "
                onblur="if(this.value=='') this.value='Ville de départ :';"
                />
            </td>
            <td class="form_horiz_td" style="background: url(<?php echo PATH_ROOT?>images/champ.png) no-repeat;" id="TTnom">
                 
                 <input type="text" name="nom_contact" id="nom_contact" value="Nom :"
                onclick="if(this.value=='Nom :') this.value='';"
                onkeypress="if(this.value=='Nom :') this.value='';"
                onblur="if(this.value=='') this.value='Nom :';"
                 />
            </td>
            <td rowspan="3" valign="top" class="texte">
                <img src="<?php echo PATH_ROOT?>images/bouton.png" width="315px" height="52px" onclick="checkMainForm('form_horizontal');" style="cursor: pointer;" />
                <span class="form_horiz_contact" >Vous serez contacté par téléphone ou par mail</span><br />
                <span class="space"><br /></span>
                <span class="form_confidentialite" >Viaretraite adopte une politique de strict respect de la confidentialité de vos données, conformément à la loi n&#176;78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés.</span>
            </td>
        </tr>
        <tr>
           <td class="form_horiz_td" style="background: url(<?php echo PATH_ROOT?>images/champ.png) no-repeat;" id="TTtel">                                                                
                <input type="text" name="ville_d_arrivee" id="ville_de_depart" value="Ville d'arrivée :" 
                onclick="if(this.value=='Ville d\'arrivée :') this.value=''; "
                onblur="if(this.value=='') this.value='Ville d\'arrivée :';"
                />
            </td>
            <td class="form_horiz_td" style="background: url(<?php echo PATH_ROOT?>images/champ.png) no-repeat;" id="TTtel">                                                                
                <input type="text" name="tel_personnel_contact" id="tel_personnel_contact" value="Tel :" 
                onclick="if(this.value=='Tel :') this.value=''; "
                onkeypress="if(this.value=='Tel :') this.value=''; tape(this,2,'.');"
                onblur="if(this.value=='') this.value='Tel :';"
                maxlength="14"
                />
            </td>
        </tr>
        <tr>
			<td class="form_horiz_td" style="background: url(<?php echo PATH_ROOT?>images/champ.png) no-repeat;" id="TTtel">                                                                
                <input type="text" name="nombre_de_passager" id="nombre_de_passager" value="Nombre de voyageurs :" 
                onclick="if(this.value=='Nombre de voyageurs :') this.value=''; "
                onblur="if(this.value=='') this.value='Nombre de voyageurs :';"
                />
			</td>
            <td class="form_horiz_td" style="background: url(<?php echo PATH_ROOT?>images/champ.png) no-repeat;" id="TTemail">
                <input type="text" name="email" id="email" value="Email :" 
                onclick="if(this.value=='Email :') this.value='';"
                onkeypress="if(this.value=='Email :') this.value='';"
                onblur="if(this.value=='') this.value='Email :';"
                />
            </td>
        </tr>
        </table>
        </form>
    <?}?>        
    </div>  
    
</div>
    
    <script type="text/javascript">
	//<![CDATA[
	$("#demo-default-usage .demoControls").find('.replace').bind('click', function(){
	$("#DEPT").selectbox();
	});
	$("#demo-default-usage .demoControls").find('.undo').bind('click', function(){
	$("#DEPT").parents('.jquery-selectbox').unselectbox();
	});
	//]]>
	</script>
	
    <script type="text/javascript">
	//<![CDATA[
	$("#demo-default-usage .demoControls").find('.replace').bind('click', function(){
	$("#date_entree").selectbox();
	});
	$("#demo-default-usage .demoControls").find('.undo').bind('click', function(){
	$("#date_entree").parents('.jquery-selectbox').unselectbox();
	});
	//]]>
	</script>
	
    <script type="text/javascript">
	//<![CDATA[
		$("#date_entree").selectbox('jquery-selectbox').bind('change', function(){
			$('<div>&nbsp;</div>').appendTo('#demo-default-usage .demoTarget').fadeOut(5000, function(){
				$(this).remove();
			});
		});
	//]]>
	</script>
    
    <script type="text/javascript">
	//<![CDATA[
		$("#DEPT").selectbox('jquery-selectbox').bind('change', function(){
			$('<div>&nbsp;</div>').appendTo('#demo-default-usage .demoTarget').fadeOut(5000, function(){
				$(this).remove();
			});
		});
	//]]>
	</script>