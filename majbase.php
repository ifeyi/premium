<?php 
$page = '404';
include_once "inc/config.inc.php";

// REQUETE LISTE ARTICLES PLAN
$QArticleAssoc="	SELECT	mdr_id,
							mdr_ville,
							ville_geo_dep,
							ville_geo_num,
							ville_geo_lat,
							ville_geo_lon
					FROM	ville_geo,
							mdr
					WHERE	mdr_dep=''
					AND  	mdr_id > '80000'
					AND  	mdr_id < '100000'
					AND		(mdr_cp=ville_geo_cp
					OR
							UCASE(LOWER(mdr_ville))=ville_geo_ville OR
							mdr_ville=ville_geo_ville_maj)
					GROUP BY mdr_id";
$RArticleAssoc=	mysql_query($QArticleAssoc);

while($RArticleAssoc && $row=mysql_fetch_array($RArticleAssoc))
{	  	
	$maj = "UPDATE mdr SET mdr_dep='".$row['ville_geo_dep']."',mdr_ville_geo_num='".$row['ville_geo_num']."',mdr_ville_geo_lat='".$row['ville_geo_lat']."',mdr_ville_geo_long='".$row['ville_geo_lon']."' WHERE mdr_id='".$row['mdr_id']."'";
	mysql_query($maj);
	
	//echo $maj.'<br/>';
}

$maj = "UPDATE mdr SET mdr_dep='75',mdr_ville_geo_num='1231',mdr_ville_geo_lat='48.866667',mdr_ville_geo_long='2.333333' WHERE mdr_ville='PARIS'";
mysql_query($maj);

$maj = "UPDATE mdr SET mdr_dep='69',mdr_ville_geo_num='18430',mdr_ville_geo_lat='45.75',mdr_ville_geo_long='4.85' WHERE mdr_ville='LYON'";
mysql_query($maj);

$maj = "UPDATE mdr SET mdr_dep='13',mdr_ville_geo_num='16471',mdr_ville_geo_lat='43.3',mdr_ville_geo_long='5.4' WHERE mdr_ville='MARSEILLE'";
mysql_query($maj);
	
?>
    
