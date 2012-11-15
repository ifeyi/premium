<?

// acces server (A CHANGER AVEC NOUVEAU FTP !!!!!!!!!!!!)
$serveur = "localhost";
$user = "kiconnai";
$pass = "zpl4jllm";
$base = "premium";

DEFINE("PATH_ROOT","http://".$_SERVER['SERVER_NAME']."/premium/");
DEFINE("DOSSIERANN","annuaire-autocaristes/");
DEFINE("PREFIX","autocar-");
DEFINE("CATEGORY","autocar");

// fonction pour se connecter au DB
if(!function_exists('connexion'))
{
	function connexion($serveur,$user,$pass,$base)
	{
		$dbc = @mysql_connect($serveur,$user,$pass) or die("Impossible de se connecter à la base de données "); // Le @ ordonne a php de ne pas afficher de message d'erreur
		mysql_select_db($base,$dbc) or die("Impossible de se connecter à la base de données...");
		return $dbc;
	}
}
//Fonction pour fermer la connection au DB
if(!function_exists('close_db'))
{
 
	function close_db()
	{
		global $dbc;
		if(isset($dbc))
		{
			@mysql_close($dbc);
			unset($dbc);	
		}
		
	}
}

// connexion
$link = connexion($serveur,$user,$pass,$base);


// LISTE DES DEFINE A COMPLETER / A CHANGER SELON SITE + SELON DEV et PROD
DEFINE("ENCODING","ISO-8859-15");
//A MODIFIER EN PASSANT EN PROD 
DEFINE("DOSSIER_TYPE_UNIVERS","3916"); //Id de "Univers" dans la liste "dossier_type" 
DEFINE("DOSSIER_TYPE_DOSSIER","3917"); //Id de "Dossier" dans la liste "dossier_type" 
DEFINE("DOSSIER_TYPE_LANDING","3924"); //Id de "Dossier" dans la liste "dossier_type"
 
if (!defined("DOSSIER_TYPE_LANDING_PERSO"))
    define("DOSSIER_TYPE_LANDING_PERSO","4171");//Id de "Landing personalisé" dans la liste "dossier_type"(660) 

if (!defined("DOSSIER_LANDING"))
    define("DOSSIER_LANDING", 40);//[France mdr] Landing Perso  determine l'id du type de dossier  qui est fixer dans la 'BASE' comme etant une landing personalise dans `cap_ob_cdossier`
    
// UTILEEEEEEEEEEEEEEE    
DEFINE("TEXTE_TYPE_ACCROCHE","3913"); //Id de "Accroche" dans la liste des type de texte
DEFINE("TEXTE_TYPE_DESCRIPTION","3915"); //Id de "Description" dans la liste des type de texte
DEFINE("TEXTE_TYPE_SUPPLEMENT","3914"); //Id de "Description" dans la liste des type de texte
DEFINE("TEXTE_TYPE_META_TITRE","3925"); //Id de "TEXTE_TYPE_META_TITRE" dans la liste des type de texte
DEFINE("TEXTE_TYPE_META_DESCRIPTION","3926"); //Id de "TEXTE_TYPE_META_SUPPLEMENT" dans la liste des type de texte
define('TYPE_META_KEYWORD'		,3927);



DEFINE("ARTICLE_ACCUEIL_ID","47"); //Id de l'article d'accueil
DEFINE("PHOTO_TYPE_BANNIERE","3922"); //
DEFINE("PHOTO_TYPE_VIGNETTE","3921"); //`cap_liste_data`.`cap_liste_data_nom_FR` = Vignette
DEFINE("OBJET_DOSSIER","239");
DEFINE("OBJET_ARTICLE","240");
DEFINE("OBJET_GLOSSAIRE","241");

DEFINE("NOM_1","Autocaristes");
DEFINE("NOM_2","Autocar");
DEFINE("NOM_3","Autocariste");
DEFINE("FORMULAIRE","Obtenez des devis d'autocaristes pour votre trajet au départ de #DEST#");
?>