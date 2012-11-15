<?php 
// si pas de id_visitor, on en cree un maintenant
if($_SESSION['id_visitor'] == "")
{
    @include_once("inc/config.php");
	
	$cars="ABCDEFGHIJKLOMNOPQRSTUVWXYZ0123456789";
	$wlong=strlen($cars);
	$id_visitor="";
	//mot de passe a 8 caracteres
	$taille=8;
	$tourMax = 4;
	$tour=1;
	while($tour<=$tourMax)
	{
		// On initialise la fonction aléatoire
		srand((double)microtime()*1000000);
		// On boucle sur le nombre de caractères voulus
		for($i=0;$i<$taille;$i++)
		{
		// Tirage aléatoire d'une valeur entre 1 et wlong
			 $wpos=rand(0,$wlong-1);
		// On cumule le caractère dans le mot de passe
		 	$id_visitor=$id_visitor.substr($cars,$wpos,1);
		// On continue avec le caractère suivant à générer      
		}
		$VerifID_Visitor = "SELECT 1
							FROM demandes
							WHERE ID_VISITOR = '$id_visitor'";
							
		$ResultVerif = mysql_query($VerifID_Visitor);
		$ResultatVerif = mysql_fetch_array($ResultVerif);
		if($ResultatVerif[0]==1)
			$tour++;
		else
			break;				
	}
	$_SESSION['id_visitor'] = $id_visitor;
}

//--- CODE DE CONVERSION
$COD_CONV="
<!-- Google Code for Formulaire rempli Conversion Page -->
<script type=\"text/javascript\">
/* <![CDATA[ */
var google_conversion_id = 1020732683;
var google_conversion_language = \"fr\";
var google_conversion_format =\"3\";
var google_conversion_color = \"ffffff\";
var google_conversion_label = \"lhpNCN2V4AEQi8rc5gM\";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type=\"text/javascript\" src=\"http://www.googleadservices.com/pagead/conversion.js\">
</script>
<noscript>
<div style=\"display:inline;\">
<img height=\"1\" width=\"1\" style=\"border-style:none;\ alt=\"\" src=\"http://www.googleadservices.com/pagead/conversion/1020732683/?label=lhpNCN2V4AEQi8rc5gM&amp;guid=ON&amp;script=0\"/>
</div>
</noscript>";

$MSG = "";

//--- si formulaire a ete envoye 
if($_POST['ACTION'] == "DOC")
{
	$nom 	= $_POST['nom_contact'];
	$tel    = $_POST['tel_personnel_contact'];
	$email  = $_POST['email'];
	$delai  = $_POST['date_entree'];
	$region = $_POST['REG'];
	$DPT    = $_POST['DEPT'];
	$msgConf= $_POST['msgConf'];
	$_POST['page_demande']=$_SERVER['REQUEST_URI'];
	
	$MSG = "Nous avons bien pris en compte votre demande.<br/> L'équipe de \"Viaretraite\" vous recontactera dans les plus brefs délais.";
	$MSG .=$COD_CONV;
	$MSG .= "<iframe SRC=\"merci1.html\" scrolling=\"no\" height=\"1\" width=\"1\" FRAMEBORDER=\"no\"></iframe>";
		
	//--- On test si la demande est dans la base		
	$query = "SELECT ID_DEMANDE, 
				     ID_VISITOR 
			 FROM demandes 
			 WHERE TEL_FIX='$tel' 
			 AND EMAIL='$email' 
			 AND NOM='$nom'";
	$req = mysql_query($query);
	$res = mysql_num_rows($req);
			
	IF($res == 0)
	{ //--- Si le client n'a jamais fait de demande
			
		//--- Enregistrement de la demande dans DB site
		$query = "INSERT INTO demandes( 
							ID_VISITOR,
							EMAIL,
							NOM,
							TEL_FIX,
                            DATE_ENTREE,
							NUM_GEO_DEMANDE,
							PROVENANCE,
							PROVENANCE_TPE,
							DATE,
							PAGE_DEMANDE) 
				VALUES ('$_SESSION[id_visitor]',
						'$email',
						'$nom',
						'$tel',
                        '$delai',
						'$DPT',
						'$_SESSION[provenance]',
						'$_SESSION[type]',
						NOW(),
						'{$_SERVER['REQUEST_URI']}')";
		$req = mysql_query($query);
				
		
        //--- Enregistrement de la demande dans DB base
        include("socket.php");
		$_POST['id_visitor']= $ID_VISITOR;
		send_form($_POST,4568); 
        // changer le code du site  !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!  4568 = site AdresseMDR
        // NE FONCTIONNE PAS AVEC LE CODE DE TMDR (4415), pq ???? I don't know
		    	
		
        //--- Envoi mail pour informer
        switch($delai)
		{
			case 1 : $delai_texte = "Le plus tôt possible";
					 break;
			case 3 : $delai_texte = "1 à 3 mois";
					 break;
			case 4 : $delai_texte = "3 à 6 mois";
					 break;
			case 5 : $delai_texte = "6 mois à 1 an";
					 break;
		}
		//$webmestre = "ytouitou@capretraite.fr";//--- Votre adresse email
        $webmestre = "deborah.na@upsider.co.il";
		$courrier = "\nFormulaire :\n$nom\nTel : $tel\nEmail : $email\nDelai : $delai_texte ($delai)\n\nID FORMULAIRE : $_SESSION[id_visitor]\n\nEnvoye pour $DPT\n";
		$sujet = "Demande d'information " ;
				
		// on envoie le mail au webmestre
		mail($webmestre, $sujet, $courrier, "From: site VIA RETRAITE"); 
	}	
}

?>
