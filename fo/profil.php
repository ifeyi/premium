<?php 
include_once('../inc/config.php');  
include_once('../lib/connexion.php'); 
	if (!isset($_SESSION['id']) || !isset($_SESSION['id_comptes']) ){
			$resultat=$connexion->query("SELECT id FROM sb_clients WHERE secure = '".secure($_SESSION['secure'])."' ");
			$result = $resultat->fetch(PDO::FETCH_OBJ);
			if (!empty($result)){
				$_SESSION['id'] = $result->id;
			}
			$resultat2=$connexion->query("SELECT id FROM sb_comptes WHERE secure = '".secure($_SESSION['secure'])."' ");
			$result2 = $resultat2->fetch(PDO::FETCH_OBJ);
			if (!empty($result2)){
				$_SESSION['id_comptes'] = $result2->id;
			}
	}
	
	if(!empty($_POST)){
		$sql = 'UPDATE sb_clients SET id=id ';
		if ( isset($_POST['nom_societe']) ) $sql .= ' , nom_societe = "'.secure($_POST['nom_societe']).'" ';
		if ( isset($_POST['nom_responsable']) ) $sql .= ' , nom_responsable = "'.secure($_POST['nom_responsable']).'" ';
		if ( isset($_POST['no_siret']) ) $sql .= ' , no_siret = "'.secure($_POST['no_siret']).'" ';
		if ( isset($_POST['no_license_trans']) ) $sql .= ' , no_license_trans = "'.secure($_POST['no_license_trans']).'" ';
		if ( isset($_POST['adresse_societe']) ) $sql .= ' , adresse_societe = "'.secure($_POST['adresse_societe']).'" ';
		if ( isset($_POST['code_postal']) ) $sql .= ' , code_postal = "'.secure($_POST['code_postal']).'" ';
		if ( isset($_POST['ville']) ) $sql .= ' , ville = "'.secure($_POST['ville']).'" ';
		if ( isset($_POST['region']) ) $sql .= ' , region = "'.secure($_POST['region']).'" ';
		if ( isset($_POST['telephone']) ) $sql .= ' , telephone = "'.secure($_POST['telephone']).'" ';
		if ( isset($_POST['fax']) ) $sql .= ' , fax = "'.secure($_POST['fax']).'" ';
		if ( isset($_POST['email']) ) $sql .= ' , email = "'.secure($_POST['email']).'" ';
		if ( isset($_POST['site_internet']) ) $sql .= ' , site_internet = "'.secure($_POST['site_internet']).'" ';
		$sql .= ' WHERE id = "'.secure($_SESSION['id']).'" ';
		
		if (isset($_POST['email'])){
			$sql3 = 'UPDATE sb_comptes SET email =  "'.secure($_POST['email']).'" WHERE id = "'.$_SESSION['id_comptes'].'" ';
			mysql_query($sql3);
		}
		if (mysql_query($sql)) $message = 'Modications Reussies';
	}
	if ( !empty($_POST) && isset($_POST['pass']) && secure($_POST['pass']) != '' && secure($_POST['pass_bis']) != '' && secure($_POST['pass']) == secure($_POST['pass_bis']) ){
		$sql2 = 'UPDATE sb_comptes SET id=id';
		if ( isset($_POST['user']) ) $sql2 .= ' , user = "'.secure($_POST['user']).'" ';
		if ( isset($_POST['pass']) ) $sql2 .= ' , pass = "'.secure($_POST['pass']).'" ';
		if ( isset($_POST['pass_bis']) ) $sql2 .= ' , pass_bis = "'.secure($_POST['pass_bis']).'" ';
		if ( isset($_POST['email']) ) $sql2 .= ' , email = "'.secure($_POST['email']).'" '; else $sql2 .= ', email = "'.secure($_POST['email_bis']).'" ';
		$sql2 .= 'WHERE id = "'.$_SESSION['id_comptes'].'"';
		
		if (mysql_query($sql2)) $message = 'Modifications Reussies';
	}else if (!empty($_POST) && isset($_POST['pass']) && secure($_POST['pass']) != secure($_POST['pass_bis']) ){
		$message = 'Mot de passe incorrect';
	}
	


	$resultat_dn_query=$connexion->query("SELECT * FROM sb_clients WHERE id = '".secure($_SESSION['id'])."' ");
	$resultat_dn = $resultat_dn_query->fetch(PDO::FETCH_OBJ);
	$resultat_cn_query=$connexion->query("SELECT * FROM sb_comptes WHERE id = '".secure($_SESSION['id_comptes'])."' ");
	$resultat_cn = $resultat_cn_query->fetch(PDO::FETCH_OBJ);
	
?>
<div class="profil">
  <form action="" method="post" enctype="multipart/form-data" >
	<div class="ligne">Nom de la societé : <span id="nom_societe" class="valeur"><?php echo $resultat_dn->nom_societe ?></span> - <img src="images/edit.png" onClick="return to_input('nom_societe');" class="edit" width="15" ></div>
	<div class="ligne">Nom du responsable : <span id="nom_responsable" class="valeur"><?php echo $resultat_dn->nom_responsable ?></span> - <img src="images/edit.png" onClick="return to_input('nom_responsable');" class="edit" width="15" ></div>
	<div class="ligne">N° de SIRET : <span id="no_siret" class="valeur"><?php echo $resultat_dn->no_siret ?></span> - <img src="images/edit.png" onClick="return to_input('no_siret');" class="edit" width="15" ></div>
	<div class="ligne">N° licsence du transporteur  : <span id="no_license_trans" class="valeur"><?php echo $resultat_dn->no_license_trans ?></span> - <img src="images/edit.png" onClick="return to_input('no_license_trans');" class="edit" width="15" ></div>
	<div class="ligne">Adresse de la societ&eacute; : <span id="adresse_societe" class="valeur"><?php echo $resultat_dn->adresse_societe ?></span> - <img src="images/edit.png" onClick="return to_input('adresse_societe');" class="edit" width="15" ></div>
	<div class="ligne">Code postal : <span id="code_postal" class="valeur"><?php echo $resultat_dn->code_postal ?></span> - <img src="images/edit.png" onClick="return to_input('code_postal');" class="edit" width="15" ></div>
	<div class="ligne">Ville : <span id="ville" class="valeur"><?php echo $resultat_dn->ville ?></span> - <img src="images/edit.png" onClick="return to_input('ville');" class="edit" width="15" ></div>
	<div class="ligne">Region : <span id="region" class="valeur"><?php echo $resultat_dn->region ?></span> - <img src="images/edit.png" onClick="return to_input('region');" class="edit" width="15" ></div>
	<div class="ligne">T&eacute;l&eacute;phone : <span id="telephone" class="valeur"><?php echo $resultat_dn->telephone ?></span> - <img src="images/edit.png" onClick="return to_input('telephone');" class="edit" width="15" ></div>
	<div class="ligne">Fax : <span id="fax" class="valeur"><?php echo $resultat_dn->fax ?></span> - <img src="images/edit.png" onClick="return to_input('fax');" class="edit" width="15" ></div>
	<div class="ligne">Email : <span id="email" class="valeur"><?php echo $resultat_dn->email ?></span> - <img src="images/edit.png" onClick="return to_input('email');" class="edit" width="15" ></div>
	<div class="ligne">Site Internet : <span id="site_internet" class="valeur"><?php echo $resultat_dn->site_internet ?></span> - <img src="images/edit.png" onClick="return to_input('site_internet');" class="edit" width="15" ></div>
	
    <fieldset>
    	<legend>Acc&eacute;s Compte</legend>
            <div class="ligne">Nom d'utilisateur : <span id="user" class="valeur"><?php echo $resultat_cn->user ?></span> - <img src="images/edit.png" onClick="return to_input('user');" class="edit" width="15" ></div>
            <div class="ligne">Mot de passe : <span id="pass" class="valeur"></span> - <img src="images/edit.png" onClick="return to_input('pass');" class="edit" width="15" ></div>
            <div class="ligne">Retapez votre Mot de passe : <span id="pass_bis" class="valeur"></span> - <img src="images/edit.png" onClick="return to_input('pass_bis');" class="edit" width="15" ></div>
            <input type="hidden" name="email_bis" value="<?php echo $resultat_dn->email ?>" />
            </fieldset>
    
    <input type="submit" name="enregistrer" value="Enregistrer" >
    </form>
</div>