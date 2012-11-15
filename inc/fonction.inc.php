<?php 
function format($chaine) 
{ 
   $accent  ="ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ&+*°"; 
   $noaccent="aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby----"; 
   $format = strtr(trim($chaine),$accent,$noaccent);
   $format = str_replace(" - ","-",$format);
   $format = str_replace("(","",$format);
   $format = str_replace(")","",$format);
    $format = str_replace(".","",$format);
   $format = str_replace("/","",$format);
   $format = str_replace(" / ","-",$format);
   $format = str_replace("\"","",$format);
   $format = str_replace(" ","-",$format);
   $format = str_replace(":","",$format);
   $format = str_replace("--","-",$format);
   $format = str_replace("---","-",$format);
   $format = str_replace("'","",$format);
   $format = str_replace("\"","-",$format);
   $format = str_replace("-–-","-",$format);
   $format = str_replace("-?","",$format);
   $format = str_replace("?","",$format);
   $format = strtolower($format);
   
   return $format;
} 

function transform($name){
	$name = strtoupper($name);
	$name = str_replace("C.H ","C.H. ",$name);
	$name = str_replace("C.H. ","C.H. ",$name);
	$name = str_replace("CH ","C.H. ",$name);
	$name = str_replace("S/ ","SUR ",$name);
	$name = str_replace("HEBERG ","HEBERGEMENT ",$name);
	$name = str_replace("HEBERG. ","HEBERGEMENT ",$name);
	$name = str_replace("PERSON ","PERSONNES ",$name);
	$name = str_replace("PERS. ","PERSONNES",$name);
	$name = str_replace("MAIS. RETRAI. ","MAISON DE RETRAITE ",$name);
	$name = str_replace("M.R. ","MAISON DE RETRAITE ",$name);
	$name = str_replace("M R ","MAISON DE RETRAITE ",$name);
	$name = str_replace("M. R. ","MAISON DE RETRAITE ",$name);
	$name = str_replace("M.D.R ","MAISON DE RETRAITE ",$name);
	$name = str_replace("MDR ","MAISON DE RETRAITE ",$name);
	$name = str_replace("MAIS RETRAITE ","MAISON DE RETRAITE ",$name); 
	$name = str_replace("MAIS.DE.RETR.","MAISON DE RETRAITE ",$name); 
	$name = str_replace("MR ","MAISON DE RETRAITE ",$name);
	$name = str_replace("HOP ","HÔPITAL ",$name);
	$name = str_replace("RES ","RESIDENCE ",$name);
	$name = str_replace("LOG-FOYER ","FOYER LOGEMENT ",$name);
	$name = str_replace("LOG-FOY ","FOYER LOGEMENT ",$name);
	$name = str_replace("F.L. ","FOYER LOGEMENT ",$name);
	$name = str_replace("FOYER RES. ","FOYER RESIDENCE ",$name);
	$name = str_replace("CTRE ","CENTRE ",$name);
	$name = str_replace("GPE ","GROUPE ",$name);
	$name = str_replace("PERS AG ","PERSONNES AGEES ",$name);
	$name = str_replace("P.A","PERSONNES AGEES ",$name);
	$name = str_replace("PERS AGEES ","PERSONNES AGEES ",$name);
	$name = str_replace("PERS AGEE ","PERSONNES AGEES ",$name);
	$name = str_replace("PERSO AGEES ","PERSONNES AGEES ",$name);
	$name = str_replace("P AG ","PERSONNES AGEES ",$name);
	$name = str_replace("M  RETRAITE","MAISON DE RETRAITE ",$name);
	$name = str_replace("MAIS.RETR.","MAISON DE RETRAITE ",$name);
	$name = str_replace("M.R.- ","MAISON DE RETRAITE ",$name);
	$name = str_replace("MAIS.DE RETRAITE ","MAISON DE RETRAITE ",$name);
	$name = str_replace("M DE RETRAITE","MAISON DE RETRAITE",$name);
	$name = str_replace("M. DE RETRAITE ","MAISON DE RETRAITE ",$name);
	$name = str_replace("M RETRAITE ","MAISON DE RETRAITE ",$name);
	$name = str_replace("MAISON RETRAITE ","MAISON DE RETRAITE ",$name);
	$name = str_replace("MAIS.RET ","MAISON DE RETRAITE ",$name);
	$name = str_replace("MAIS.RETR. ","MAISON DE RETRAITE ",$name);
	$name = str_replace("M. R ","MAISON DE RETRAITE ",$name);
	$name = str_replace("MAIS. DE RETR. ","MAISON DE RETRAITE ",$name);
	$name = str_replace("RES.PERS.AGEES ","RESIDENCE POUR PERSONNES AGGES ",$name);
	$name = str_replace("RES. PERSONNES ","RESIDENCE POUR PERSONNES ",$name);
	$name = str_replace("RES.PERSONNES ","RESIDENCE POUR PERSONNES ",$name);
	$name = str_replace("MAIS ACCUEIL ","MAISON D'ACCUEIL ",$name);
	$name = str_replace("MAIS.ACCUEIL ","MAISON D'ACCUEIL ",$name);
	$name = str_replace("M.A.","MAISON D'ACCUEIL ",$name);
	$name = str_replace("RESIDENCE HEBERGEMENT TEMP ","RESIDENCE HEBERGEMENT TEMPORAIRE ",$name);
	$name = str_replace("RES.SEJ.TEMP.REPOS ","RESIDENCE DE SEJOUR TEMPORAIRE - REPOS ",$name);
	$name = str_replace("RPA"," RESIDENCE POUR PERSONNES AGEES",$name);
	$name = str_replace("PERSONNESAG ","PERSONNES AGEES ",$name);
	$name = str_replace("LOGT FOYER PA ","LOGEMENT FOYER POUR PERSONNES AGEES ",$name);
	$name = str_replace("LOGT","LOGEMENT",$name); 
	$name = str_replace("LOGEMENT FOYER","FOYER LOGEMENT",$name);
	$name = str_replace("LOGEMENT-FOYER","FOYER LOGEMENT",$name);
	$name = str_replace("LOG.FOYER","FOYER LOGEMENT",$name);
	$name = str_replace("LOG FOYER","FOYER LOGEMENT",$name);
	$name = str_replace("L. F.","FOYER LOGEMENT",$name);
	$name = str_replace("TEMPOR. ","TEMPORAIRE ",$name);
	$name = str_replace("E.H.PERSONNES AGEES .D ","ETABLISSEMENT HOSPITALIER POUR PERSONNES AGEES ",$name);
	$name = str_replace("E.H.PERSONNES AGEES .D. ","ETABLISSEMENT HOSPITALIER POUR PERSONNES AGEES ",$name);
	$name = str_replace("R.PERSONNES AGEES ","RESIDENCE POUR PERSONNES AGEES ",$name);
	$name = str_replace("\"","",$name);
	$name = str_replace(" R ","RUE ",$name);
	$name = str_replace("PL ","PLACE ",$name);
	$name = str_replace("CHE ","CHEMIN ",$name);
	$name = str_replace("BD ","BOULEVARD ",$name);
	$name = str_replace("RTE ","ROUTE ",$name);
	$name = str_replace(" AV "," AVENUE ",$name);
	$name = str_replace(" CHS "," CHAUSSEE ",$name);

	return $name;
}

function pr($r)
{
	echo "<pre>";
	print_r($r);
	echo "</pre>";
}

// decodage pour texte extrait du DB
function Decode($txt)
{
	// Gestion des Titres de paragraphes
		$txt	= str_replace("[titre_article]",'<h2 class="convient'.$_GET['esp'].'">',$txt);
		$txt	= str_replace("[/titre_article]",'</h2>',$txt);
		$txt	= str_replace("src=\"","src=\"".PATH_ROOT,$txt);
	return 	$txt;
}

function DecodeQuiSommesNous($txt)
{
	// Gestion des Titres de paragraphes
		$txt	= str_replace("<p>",'',$txt);
		$txt	= str_replace("</p>",'',$txt);
	return 	$txt;
}

// extraction des photos du DB (A FORMATER SELON CHARTE GRAPHIQUE DU SITE VIA_RETRAITE)
function dev_charge_rs_photos($fiche_num,$objet_num)
{
	/** CHARGE PHOTOS **/	
	//Chargement de toute les photos de l'article - L'id est l'identifiant du type de d'image
	$req_photos = sprintf("
							SELECT  `cap_photos_num`,
									`cap_photos_type`,
									`cap_photos_ext`,
									 cap_photos_objet_num,
									 cap_photos_fiche_num,
									`cap_photos_desc` 
							FROM 	`cap_photos`,
									cap_ob_carticle									 
							WHERE   cap_photos_fiche_num=cap_ob_carticle_ob_cdossier_num
							AND		`cap_ob_carticle_num`='%s' 
							AND 	`cap_photos_type`='%s'" ,
									 intval($fiche_num),intval($objet_num)
						);
	$result_photos 			= mysql_query ($req_photos);
	while ($retours_photos 	= mysql_fetch_array($result_photos))
	{
		$article_photos[$retours_photos["cap_photos_type"]]["id"]		=$retours_photos["cap_photos_num"];
		$article_photos[$retours_photos["cap_photos_type"]]["ext"]		=$retours_photos["cap_photos_ext"];
		$article_photos[$retours_photos["cap_photos_type"]]["desc"]		=$retours_photos["cap_photos_desc"];
		$article_photos[$retours_photos["cap_photos_type"]]["objnum"]	=$retours_photos["cap_photos_objet_num"];
		$article_photos[$retours_photos["cap_photos_type"]]["fichnum"]	=$retours_photos["cap_photos_fiche_num"];
		$article_photos[$retours_photos["cap_photos_type"]]["path"]		=PATH_ROOT.'photos/'.$retours_photos['cap_photos_objet_num'].'/'.$retours_photos['cap_photos_fiche_num'].'/'.$retours_photos['cap_photos_num'].'.'.$retours_photos['cap_photos_ext'];
		//echo '<img src="'.$article_photos[$retours_photos["cap_photos_type"]]["path"].'" alt="'.$article_photos[$retours_photos["cap_photos_type"]]["path"].'" >';
	}
	return $article_photos;	
}
function dev_charge_rs_photos_art($fiche_num,$objet_num)
{
	/** CHARGE PHOTOS **/	
	//Chargement de toute les photos de l'article - L'id est l'identifiant du type de d'image
	$req_photos = sprintf("
							SELECT  `cap_photos_num`,
									`cap_photos_type`,
									`cap_photos_ext`,
									 cap_photos_objet_num,
									 cap_photos_fiche_num,
									`cap_photos_desc` 
							FROM 	`cap_photos`,
									cap_ob_carticle									 
							WHERE   cap_photos_fiche_num=cap_ob_carticle_num
							AND		`cap_ob_carticle_num`='%s' 
							AND 	`cap_photos_type`='%s'" ,
									 intval($fiche_num),intval($objet_num)
						);
	$result_photos 			= mysql_query ($req_photos);
	while ($retours_photos 	= mysql_fetch_array($result_photos))
	{
		$article_photos[$retours_photos["cap_photos_type"]]["id"]		=$retours_photos["cap_photos_num"];
		$article_photos[$retours_photos["cap_photos_type"]]["ext"]		=$retours_photos["cap_photos_ext"];
		$article_photos[$retours_photos["cap_photos_type"]]["desc"]		=$retours_photos["cap_photos_desc"];
		$article_photos[$retours_photos["cap_photos_type"]]["objnum"]	=$retours_photos["cap_photos_objet_num"];
		$article_photos[$retours_photos["cap_photos_type"]]["fichnum"]	=$retours_photos["cap_photos_fiche_num"];
		$article_photos[$retours_photos["cap_photos_type"]]["path"]		=PATH_ROOT.'photos/'.$retours_photos['cap_photos_objet_num'].'/'.$retours_photos['cap_photos_fiche_num'].'/'.$retours_photos['cap_photos_num'].'.'.$retours_photos['cap_photos_ext'];
		//echo '<img src="'.$article_photos[$retours_photos["cap_photos_type"]]["path"].'" alt="'.$article_photos[$retours_photos["cap_photos_type"]]["path"].'" >';
	}
	return $article_photos;	
}

function dev_charge_rs_photos_dossier($fiche_num,$objet_num)
{
	/** CHARGE PHOTOS **/	
	//Chargement de toute les photos de l'article - L'id est l'identifiant du type de d'image
	$req_photos = sprintf("
							SELECT  `cap_photos_num`,
									`cap_photos_type`,
									`cap_photos_ext`,
									 cap_photos_objet_num,
									 cap_photos_fiche_num,
									`cap_photos_desc`,
									cap_ob_cdossier_nom 
							FROM 	`cap_photos`,
									cap_ob_cdossier								 
							WHERE   cap_photos_fiche_num=cap_ob_cdossier_num
							AND		`cap_ob_cdossier_num`='%s' 
							AND 	`cap_photos_type`='%s'" ,
									 intval($fiche_num),intval($objet_num)
						);
	$result_photos 			= mysql_query ($req_photos);
	while ($retours_photos 	= mysql_fetch_array($result_photos))
	{
		$article_photos[$retours_photos["cap_photos_type"]]["nom"]		=$retours_photos["cap_ob_cdossier_nom"];
		$article_photos[$retours_photos["cap_photos_type"]]["id"]		=$retours_photos["cap_photos_num"];
		$article_photos[$retours_photos["cap_photos_type"]]["ext"]		=$retours_photos["cap_photos_ext"];
		$article_photos[$retours_photos["cap_photos_type"]]["desc"]		=$retours_photos["cap_photos_desc"];
		$article_photos[$retours_photos["cap_photos_type"]]["objnum"]	=$retours_photos["cap_photos_objet_num"];
		$article_photos[$retours_photos["cap_photos_type"]]["fichnum"]	=$retours_photos["cap_photos_fiche_num"];
		$article_photos[$retours_photos["cap_photos_type"]]["path"]		=PATH_ROOT.'photos/'.$retours_photos['cap_photos_objet_num'].'/'.$retours_photos['cap_photos_fiche_num'].'/'.$retours_photos['cap_photos_num'].'.'.$retours_photos['cap_photos_ext'];
		//echo '<img src="'.$article_photos[$retours_photos["cap_photos_type"]]["path"].'" alt="'.$article_photos[$retours_photos["cap_photos_type"]]["path"].'" >';
	}
	return $article_photos;	
}


function top_chrono2()
{
	$chrono= microtime();
	$chrono= explode(" ",$chrono);
	$chrono= $chrono[1] + $chrono[0];
	return ($chrono);
}

function query_full($query)
{
 global $bdd, $serveur, $user, $pass,$cap_tpl,$debug,$logSql,$_SQL;
 $_SQL['query_full'][] = $query; /* add sql to array */
 $cap_tpl['_CAPTHISNBQUERY_']++;
 $dbh = mysql_connect($serveur, $user, $pass);
 if(!$dbh)
 {
      echo("<P><B>Echec connexion serveur SQL</B><P>");
      exit;
 }
 	 if($idduuser==210)
 		echo "<br>$query";
 $top1= top_chrono2();
	$db_selected = mysql_select_db($bdd, $dbh);	
	$result=mysql_query($query);
 if(!$result && $debug==1)
 {
      echo("<P><B>Echec SQL4 :: $query</B><P>");
      if($logSql == 1)
  		logSql($query,$sqlTime);
      exit;
 }
	$sqlTime = top_chrono2()-$top1;
 	$cap_tpl['_CAPTHISSQLPROCESSEDTIME_']=$cap_tpl['_CAPTHISSQLPROCESSEDTIME_']+$sqlTime;
 	if($logSql == 1)
  		logSql($query,$sqlTime);	
 $res = mysql_fetch_array($result);
 return $res;
}

// envoi d'un mail avec piece jointe (pour CV)
function sendMail ($subject, $message, $fileName)
{
	$mail = new PHPmailer();
	
    $mail->IsHTML(true);
	
	//$mail->From			=	"lauren.a@capretraite.fr";
	$mail->FromName		=	"Emploi Via Retraite"; 
	$mail->AddAddress("lauren.a@capretraite.fr");
	$mail->AddReplyTo('lauren.a@capretraite.fr');
    //$mail->AddCC("raphael.b@capretraite.fr");
	
	$mail->Subject		= $subject;
	
	$mail->Body			='<html><body><font size=2>'.$message.'</font><br></body></html>';
	
	$mail->AddAttachment($fileName);
	
	if(! $mail->Send())	
	   echo $mail->ErrorInfo;			
	
    unset($mail);
}


?>