<?php 
ini_set(set_time_limit(30000));

function generate($size) {
  $chars = 'AZERTYUIOPQSDFGHJKLMWXCVBN';
  $max = strlen($chars)-1;
  $generated = "";
  for($i=0; $i < $size; $i++) {
   $generated.= $chars{mt_rand(0, $max)};
  }
  return $generated;
}

include_once "inc/config.inc.php";

$QNom="	SELECT	prenom,sexe
					FROM	prenom";
$RNom=	mysql_query($QNom);

$prenom=array();
$i=0;
while($RNom && $row=mysql_fetch_array($RNom))
{	
	$prenom[$i][nom]=$row['prenom'];
	$prenom[$i][sexe]=$row['sexe'];
	
	$i++;
}

// REQUETE LISTE ARTICLES PLAN
$QArticleAssoc="	SELECT	mdr_ville_geo_num,mdr_dep
					FROM	mdr
					WHERE 	mdr_categorie= 'autocar'
					GROUP BY mdr_ville_geo_num";
$RArticleAssoc=	mysql_query($QArticleAssoc);

while($RArticleAssoc && $row=mysql_fetch_array($RArticleAssoc))
{	  	
	$Qville="SELECT	mdr_ville_geo_num
					FROM	mdr WHERE mdr_categorie= 'autocar' ORDER BY RAND() LIMIT 0,12";
	$Rville=	mysql_query($Qville);
	
	echo $row['mdr_ville_geo_num']."|";
	while($Rville && $rowville=mysql_fetch_array($Rville))
	{	  	
		$passagersun=rand(15,100);
		$passagersdeux=rand(15,400);
		$nbr=rand(1,4);
		if($nbr < 4){$passager = $passagersun;}
		else{$passager = $passagersdeux;}
		
		$randtype = rand(1,4);
		if($randtype == 1){$type="bus";}
		elseif($randtype == 2){$type="car";}
		elseif($randtype == 3){$type="autocar";}
		elseif($randtype == 4){$type="autobus";}
		elseif($randtype == 5){$type="autocar tourisme";}
		elseif($randtype == 6){$type="autocar grand tourisme";}
		
		
		if($passager < 21){
			$randmini= rand(1,2);
			if($randmini == 1){
				$nombre = "1 Minibus";
			}
			else{
				$nombre = "1 Minibus (- 20 places)";
			}
			$nombre = "1 Minibus";
		}
		elseif($passager > 20){
			$nbrbus = $passager / 55;
			$nombre = ceil($nbrbus)." $type";
			if((($randtype == 2) OR ($randtype == 3)) AND ceil($nbrbus) > 1){$nombre.="s";}
			elseif((($randtype == 5) OR ($randtype == 6)) AND ceil($nbrbus) > 1){$nombre=str_replace("autocar","autocars",$nombre);}
		}
		
		$randsoc = rand(1,25);
		if($randsoc == 1){$socie="pour sa société";}
		elseif($randsoc == 2){$socie="pour son CE";}
		elseif($randsoc == 3){$socie="pour son club sportif";}
		elseif($randsoc == 4){$socie="pour une école";}
		elseif($randsoc == 5){$socie="pour son association";}
		elseif($randsoc == 6){$socie="pour une colonie de vacances";}
		elseif($randsoc == 7){$socie="pour une sortie découverte";}
		elseif($randsoc == 8){$socie="pour un mouvement de jeunesse";}
		elseif($randsoc == 9){$socie="pour un événement  culturel";}
		elseif($randsoc == 10){$socie="pour son entreprise";}
		elseif($randsoc == 11){$socie="pour un événement  culturel";}
		elseif($randsoc == 12){$socie="pour un club de foot";}
		elseif($randsoc == 13){$socie="pour un club de hockey";}
		elseif($randsoc == 14){$socie="pour une chorale";}
		elseif($randsoc == 15){$socie="pour des musiciens";}
		elseif($randsoc == 16){$socie="pour des etudiants";}
		elseif($randsoc == 17){$socie="pour une association étudiant";}
		elseif($randsoc == 18){$socie="pour un week end d'integration etudiants";}
		elseif($randsoc == 19){$socie="pour une fête familiale";}
		elseif($randsoc == 20){$socie="pour un mariage";}	
		elseif($randsoc == 21){$socie="pour un anniversaire";}
		elseif($randsoc == 22){$socie="pour un meeting";}
		elseif($randsoc == 23){$socie="pour un séminaire";}
		elseif($randsoc == 24){$socie="pour un tournoi";}
		elseif($randsoc == 25){$socie="pour un spéctacle";}
		
		$randnom = rand(1,206);
		
		
		if($prenom[$randnom][sexe] == "M"){
			$denom = "M.";
		}else{
			$randdenom = rand(1,2);
			if($randdenom == 1){$denom = "Mme";}
			elseif($randdenom == 2){$denom = "Mlle";}
		}
		
		$nom = $denom." ".$prenom[$randnom][nom]." ".generate(1).".";
		
		$maj = "INSERT INTO autocar_trajets(ville_depart,dep,ville_arrive,passagers,nombre,nom,structure) VALUES('".$row['mdr_ville_geo_num']."','".$row['mdr_dep']."','".$rowville['mdr_ville_geo_num']."','$passager','$nombre','$nom','$socie')";
		mysql_query($maj);
		//echo $maj.'<br/>';
		$socie="";$randsoc="";$randtype="";$nbrbus="";$passager="";$nombre="";$nom="";$maj="";
	
	}
	
}
	
?>
    
