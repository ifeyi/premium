<?php 
include_once('../inc/config.php');  
include_once('../lib/connexion.php'); 
$continu = false;
if (!empty($_POST)) $continu=true;
if($continu){
	if (isset($_POST['ajouter'])){
	require('class/sb_flotte.php');
	$element = new flotteOBJ();
	$element->id_client = (int)(secure($_SESSION['id']));
	$element->nom_vehicule = secure($_POST['nom_vehicule']);
	$element->nombres_places = secure($_POST['nombres_places']);
	$element->quantite = secure($_POST['quantite']);
	$element->marque = secure($_POST['marque']);
	$element->equipement = secure($_POST['equipement']);
		// Insertion d'images
		$id_img = 0;
		if (isset($_FILES['image']) && $_FILES['image']['name'] != '' ){
			$resultat_img_query=$connexion->query("SELECT id FROM sb_images ORDER BY id DESC LIMIT 0,1 ");
			$resultat_img = $resultat_img_query->fetch(PDO::FETCH_OBJ);
			$id_img = ((int)($resultat_img->id))+1;
			$id_client = (int)(secure($_SESSION['id']));
			require('class/sb_image.php');
			$element2 = new imageOBJ();
			$element2->id = $id_img;
			$element2->id_client = $id_client;
			$element2->type = 'flotte';
			$element2->origine = $id_img.'_'.$id_client.'_flotte_'.$_FILES['image']['name'];
			$element2->src = $id_img.'_'.$id_client.'_flotte_min.png';
			if (upload_img($_FILES['image'],$id_img,$id_client))
					$element2->insert($element2);
		}
	$element->id_image = $id_img;
	$element->insert($element);
	}else if(isset($_POST['modifier'])){
	require('class/sb_flotte.php');
	$element = new flotteOBJ();
	if (isset($_POST['nom_vehicule'])) $element->nom_vehicule = secure($_POST['nom_vehicule']);
	if (isset($_POST['nombres_places'])) $element->nombres_places = secure($_POST['nombres_places']);
	if (isset($_POST['quantite'])) $element->quantite = secure($_POST['quantite']);
	if (isset($_POST['marque'])) $element->marque = secure($_POST['marque']);
	if (isset($_POST['equipement'])) $element->equipement = secure($_POST['equipement']);
		// Insertion d'images
		$id_img = 0;
		if (isset($_FILES['image']) && $_FILES['image']['name'] != '' ){
			$resultat_img_query=$connexion->query("SELECT id FROM sb_images ORDER BY id DESC LIMIT 0,1 ");
			$resultat_img = $resultat_img_query->fetch(PDO::FETCH_OBJ);
			$id_img = ((int)($resultat_img->id))+1;
			$id_client = (int)(secure($_SESSION['id']));
			require_once('class/sb_image.php');
			$element2 = new imageOBJ();
			$element2->id = $id_img;
			$element2->id_client = $id_client;
			$element2->type = 'flotte';
			$element2->origine = $id_img.'_'.$id_client.'_flotte.png';
			$element2->src = $id_img.'_'.$id_client.'_flotte_min.png';
			if (upload_img($_FILES['image'],$id_img,$id_client))
					$element2->insert($element2);
		}else{
			$id_img = (int)(secure($_POST['img_ex']));
		}
	$element->id_image = $id_img;
	print_r($_POST);
	$element->update($element,secure($_POST['id']));			
	}
}

	if (isset($_GET['del_fl']) ){
		require_once('class/sb_flotte.php');
		$element = new flotteOBJ();
		$element->delete((secure($_GET['del_fl'])));	
	}

?>
<div class="flotte">
	
    <div class="ajout_flotte"><span class="ajouter_flotte_btn" onclick="return ajouter_flotte();" >Ajouter <img src="images/add.png" width="15" /></span></div>
    <ul class="titre">
    	<li></li>
    	<li>Nombres de places</li>
    	<li>Quantite</li>
    	<li>Marque</li>
    	<li>Equipements</li>
    	<li>Image</li>
    	<li>enregistrer</li>
    	<li>Supprimer</li>
    </ul>
	<?php 
	$resultat_dn_query=$connexion->query("SELECT * FROM sb_flotte WHERE id_client = '".secure($_SESSION['id'])."' AND _isdeleted = 0 ");
	while( $resultat_dn = $resultat_dn_query->fetch(PDO::FETCH_OBJ) ) // on récupère la liste    
	{
		
    ?>
    <form action="dashboard.php?p=flotte" method="post" enctype="multipart/form-data" name="Up_<?php  echo $resultat_dn->id ?>" id="Up_<?php  echo $resultat_dn->id; ?>" >
    <input type="hidden" name="id" value="<?php echo $resultat_dn->id ?>"  />
    <ul class="titre">
    	<li><span id="nom_vehicule" class="valeur" onClick="return to_input('nom_vehicule');" ><?php echo $resultat_dn->nom_vehicule ?></span></li>
    	<li><span id="nombres_places" class="valeur" onClick="return to_input('nombres_places');" ><?php echo $resultat_dn->nombres_places ?></span></li>
    	<li><span id="quantite" class="valeur" onClick="return to_input('quantite');" ><?php echo $resultat_dn->quantite ?></span></li>
    	<li><span id="marque" class="valeur" onClick="return to_input('marque');" ><?php echo $resultat_dn->marque ?></span></li>
    	<li><span id="equipement" class="valeur" onClick="return to_input('equipement');" ><?php echo $resultat_dn->equipement ?></span></li>
    	<li style="overflow:hidden"><span id="image" class="valeur" ><input type="file" name="image"  /><input type="hidden" name="img_ex" value="<?php echo $resultat_dn->id_image ?>"  /></span></li>
    	<li><span id="ajouter" class="valeur" ><input type="submit" name="modifier" value=">>" class="ajouter"  /></span></li>
    	<li><span id="del" class="valeur" ><?php if ($resultat_dn->id != ''){ ?><a href="?p=flotte&del_fl=<?php echo $resultat_dn->id ?>" ><img src="images/del.png" width="15"  /></a><?php } ?></span></li>
    </ul>
    </form>
    <?php  } ?>
    
</div>