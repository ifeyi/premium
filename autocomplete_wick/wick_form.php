<form method="POST" action="#">
	<div style="position:relative;text-align:left">
		<table id="MYCUSTOMFLOATER" class="myCustomFloater">
    		<tr>
                <td>
    			<div class="myCustomFloaterContent">
    			</div>
    		    </td>
            </tr>
		</table>
		<div id="recherche_left">
        <input id="recherche" name="recherche" class="wickEnabled:MYCUSTOMFLOATER" type="text" value="<?php echo $texte_input_recherche?>" autocomplete="off"
        onclick="if(this.value=='Ou Recherchez une localit&eacute;' || this.value=='Localit&eacute; non reconnue !' || this.value=='Entrez une localit&eacute;') {this.value=''; this.style.fontStyle='normal';}"
        onblur="if(this.value=='') {this.value='Ou Recherchez une localit&eacute;'; this.style.fontStyle='italic';}"
        onkeypress="if(this.value=='Ou Recherchez une localit&eacute;' || this.value=='Localit&eacute; non reconnue !' || this.value=='Entrez une localit&eacute;') {this.value=''; this.style.fontStyle='normal';}"
        />    
        </div>
            
        <div id="recherche_right" style="">
        <input type="image" id="submit" name="submit"  src="<?php echo PATH_ROOT?>images/recherche-right.png" />
        </div>
	</div>
</form>
<!-- onsubmit="return checkForm()" -->