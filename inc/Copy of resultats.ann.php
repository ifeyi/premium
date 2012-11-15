<?php 
require_once "inc/config.inc.php";
require_once "inc/fonction.inc.php";

if(isset($_GET['LOCALITE']))
{
    $localite = $_GET['LOCALITE'];
    $type_localite = $_GET['TYPE_LOCALITE'];
}

// PAGINATION
if(isset($_GET['p'])) // si pagination il y a
    $page_courante = $_GET['p'];
else
    $page_courante = 1;
$nb_resultats_par_page = 11;
$debut_resultats = ($page_courante - 1) * $nb_resultats_par_page; // parametres pour requetes

// REQUETES SELON TYPE LOCALITE
$COND = "";

if($type_localite=='r')  // SI REGION
{
    // definir nom region
    $region_nom = $localite;
    // definir num region
    foreach($regions as $key => $value)
        if($key == $region_nom)
            $region_num = $value;
    
    // requete liste mdr selon region
    $Qmdr="	SELECT		mdr_nom,
						mdr_adresse,
						mdr_ville,
						mdr_cp,
                        mdr_id,
						region_nom,
						region_prefix
			FROM		mdr,
						departement,
						region
			WHERE		departement_id=mdr_dep
			AND			region_id=id_region
			AND			region_id='{$region_num}'
			AND 		mdr_categorie = '".CATEGORY."'
			GROUP BY 	mdr_nom
			ORDER BY 	mdr_nom
			LIMIT       $debut_resultats,$nb_resultats_par_page"; 
            			
	$Rmdr=mysql_query($Qmdr);
	$prefix=mysql_result($Rmdr,"0","region_prefix");
	$lieu=mysql_result($Rmdr,"0","region_nom");
	$regnom=ucfirst(strtolower(mysql_result($Rmdr,"0","region_nom")));
	$prefixreg=strtolower(mysql_result($Rmdr,"0","region_prefix"));
	mysql_data_seek($Rmdr,0);
	$COND = ",departement
                   WHERE	departement_id=mdr_dep AND mdr_categorie = '".CATEGORY."' 
				   AND		id_region='{$region_num}'";    
}
elseif($type_localite=='d') // SI DEPARTEMENT
{
    // definir nom dpt
    $dpt_nom = $localite;
    // definir num dpt
    foreach($dpts as $key => $value)
        if($key == $dpt_nom)
            $dpt_num = $value;
    
    IF($dpt_nom == "cotes-darmor"){
		$dpt_num = "22";
	}
	ELSEIF($dpt_nom == "cote-dor"){
		$dpt_num = "21";
	}
    ELSEIF($dpt_nom == "val-doise"){
		$dpt_num = "95";
	}
	
    // requete liste mdr selon dpt
    $Qmdr="	SELECT		mdr_nom,
						mdr_adresse,
						mdr_ville,
						mdr_cp,
                        mdr_dep,
						mdr_id,
			  			prefix,
  			  			nom_dep_min,
						region_nom,
						region_prefix,
						mdr_ville_geo_num,
						etat
			FROM		mdr,
						departement,
						region
			WHERE		departement_id=mdr_dep
			AND			region_id=id_region
			AND			mdr_dep='{$dpt_num}'
			AND 		mdr_categorie = '".CATEGORY."'
			GROUP BY 	mdr_nom
			ORDER BY 	etat DESC, mdr_nom ASC
			LIMIT		$debut_resultats,$nb_resultats_par_page";
      //var_dump($Qmdr); die;      			
	$Rmdr=mysql_query($Qmdr);
	$prefix=mysql_result($Rmdr,"0","prefix");
	$lieu=ucfirst(strtolower(mysql_result($Rmdr,"0","nom_dep_min")));
	$dptnom=ucfirst(strtolower(mysql_result($Rmdr,"0","nom_dep_min")));
	$prefixdpt=strtolower(mysql_result($Rmdr,"0","prefix"));
	$regnom=ucfirst(strtolower(mysql_result($Rmdr,"0","region_nom")));
	$prefixreg=strtolower(mysql_result($Rmdr,"0","region_prefix"));
	$mdr_ville_geo_num = mysql_result($Rmdr,"0","mdr_ville_geo_num");
	$mdr_dep = mysql_result($Rmdr,"0","mdr_dep");
	$mdr_cp = mysql_result($Rmdr,"0","mdr_cp");
	mysql_data_seek($Rmdr,0);
	$COND = "WHERE mdr_categorie = '".CATEGORY."' AND 	mdr_dep='{$dpt_num}'";
    $dep_geoloc = $dpt_num;
}
elseif($type_localite=='v') // SI VILLE
{
    $COND_VILLE = "";
    
    // definir ville
    if(is_numeric($localite))
    {
        $ville_cp = $localite;
        $COND_VILLE = "AND mdr_cp = {$ville_cp}";
    }
    else
    {
        $ville_nom = strtoupper($localite);
        $COND_VILLE = "AND mdr_ville = '".str_replace("-"," ","$ville_nom")."' OR mdr_ville = '".str_replace("-"," ","$ville_nom")." CEDEX'";
    }
    
    // requete liste mdr selon ville
    $Qmdr="SELECT		mdr_nom,
						mdr_adresse,
						mdr_ville,
						mdr_cp,
                        mdr_dep,
						mdr_id,
						prefix,
  			  			nom_dep_min,
  			  			region_nom,
						region_prefix,
						mdr_ville_geo_num
			FROM		mdr,
						departement,
						region
			WHERE		departement_id=mdr_dep
			AND			region_id=id_region
			AND 		mdr_categorie = '".CATEGORY."'
			$COND_VILLE
			GROUP BY 	mdr_nom
			ORDER BY 	mdr_nom
			LIMIT		$debut_resultats,$nb_resultats_par_page";
     			
	$Rmdr=mysql_query($Qmdr);
	$nrows  = mysql_num_rows($Rmdr);
	
	if($nrows == 0){header("Location: /");}
	
	$prefix="à";
	$lieu=ucfirst(strtolower(mysql_result($Rmdr,"0","mdr_ville")));
	$dptnom=ucfirst(strtolower(mysql_result($Rmdr,"0","nom_dep_min")));
	$prefixdpt=strtolower(mysql_result($Rmdr,"0","prefix"));
	$regnom=ucfirst(strtolower(mysql_result($Rmdr,"0","region_nom")));
	$prefixreg=strtolower(mysql_result($Rmdr,"0","region_prefix"));
	$mdr_ville_geo_num = mysql_result($Rmdr,"0","mdr_ville_geo_num");
	$mdr_dep = mysql_result($Rmdr,"0","mdr_dep");
	$mdr_cp = mysql_result($Rmdr,"0","mdr_cp");
	mysql_data_seek($Rmdr,0);
	$COND ="WHERE mdr_categorie = '".CATEGORY."' AND 1=1 ".$COND_VILLE;
    $dep_geoloc = mysql_result($Rmdr,0,"mdr_dep");
    
    $selhabitant = "SELECT ville_geo_habitants FROM ville_geo WHERE ville_geo_num='$mdr_ville_geo_num'";
    $Qselhabitant=mysql_query($selhabitant);
	$ville_geo_habitants = mysql_result($Qselhabitant,"0","ville_geo_habitants");
}

// REQUETE COMPTE
$Qcount="	SELECT COUNT(1) count
			FROM 	    (   SELECT mdr_id
    						FROM		mdr
    						 {$COND}
    						GROUP BY mdr_nom) A";
 						
$Qcount=mysql_query($Qcount);
$count = mysql_result($Qcount,"0","count");
?>