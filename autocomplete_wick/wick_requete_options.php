<?php 
include "../inc/fonction.inc.php";
include "../inc/config.inc.php";

$Qsql1="SELECT DISTINCT(`mdr_ville`)
		FROM `mdr`
		WHERE mdr_categorie='autocar'
		ORDER BY mdr_ville ";
$Rsql1=mysql_query($Qsql1);		
$Qsql4="SELECT `nom_dep_maj`
		FROM `departement` 
		ORDER BY `nom_dep_maj` ";
$Rsql4=mysql_query($Qsql4);

while($Rsql3 && $row3=mysql_fetch_array($Rsql3))
{
	$chaine.= '"'.strtolower($row3[0]).'",';
}
while($Rsql4 && $row4=mysql_fetch_array($Rsql4))
{
	$chaine.= '"'.strtolower($row4[0]).'",';
}
while($Rsql5 && $row5=mysql_fetch_array($Rsql5))
{
	$chaine.= '"'.$row5[0].'",';
}
while($Rsql1 && $row1=mysql_fetch_array($Rsql1))
{
	$chaine.= '"'.strtolower($row1[0]).'",';
}
while($Rsql2 && $row2=mysql_fetch_array($Rsql2))
{
	$chaine.= '"'.($row2[0]).'",';
}

// suppression de la derniere virgule dans la liste des options
$chaine = substr($chaine, 0, -1);

// ouverture
$fp=fopen("wick_data.js","w");

// ecriture
fputs($fp,"collection = [");
fputs($fp,$chaine);
fputs($fp,"];");

// fermeture
fclose($fp);

echo "le fichier autocomplete_wick/wick_data.js vient d'être mis à jour";

?>