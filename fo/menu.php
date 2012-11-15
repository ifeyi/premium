<div class="menu_dashboard">
	<center><h2>Bienvenue sur votre espace personnel.</h2></center>
	<div class="menu_onglet">
    	<ul class="menu_ul">
        	<li <?php  if(!isset($_GET['p'])) echo 'class="active"'; ?> onClick="return load_here(this.innerHTML,this);">Profil</li>
        	<li <?php  if(isset($_GET['p']) && secure($_GET['p']) == 'flotte' ) echo 'class="active"'; ?> onClick="return load_here(this.innerHTML,this);">Flotte</li>
        	<li <?php  if(isset($_GET['p']) && secure($_GET['p']) == 'presentation') echo 'class="active"'; ?> onClick="return load_here(this.innerHTML,this);">Presentation</li>
        	<li <?php  if(isset($_GET['p']) && secure($_GET['p']) == 'services') echo 'class="active"'; ?> onClick="return load_here(this.innerHTML,this);">Services</li>
        	<li <?php  if(isset($_GET['p']) && secure($_GET['p']) == 'infos_contacts') echo 'class="active"'; ?> onClick="return load_here(this.innerHTML,this);">Infos & Contacts</li>
        	<li <?php  if(isset($_GET['p']) && secure($_GET['p']) == 'pack') echo 'class="active"'; ?> onClick="return load_here(this.innerHTML,this);">Choix Du Pack</li>
        	<li <?php  if(isset($_GET['p']) && secure($_GET['p']) == 'stat') echo 'class="active"'; ?> onClick="return load_here(this.innerHTML,this);">Statistiques</li>
        </ul>
    </div>
</div>