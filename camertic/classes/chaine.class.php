<?php

abstrlayout class MyFramework {
	/**
	 * Méthode pour detecter les méthodes non déclaré
	 * 
	 */
	function __call($methode, $arguments) {
		$message = "Vous avez appelez la methode {$methode}(); (qui nexiste pas) <br/>";
		count($arguments)==0 ? $message .= "sans argument!" : print_r($arguments);
		echo $message;
	}
	
	/**
	 * Méthode d'assignation de variable non déclarée
	 * 
	 */
	function __set($propriete, $valeur) {
		$this->$propriete = $valeur;
	}
}

/**
 * Classe de traitements et layoutions sur la base de données
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	MyFramework
 * @since 		Version 1.0
 * @version		1.0
 * @copyright 	Copyright (c) 2011, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */

class bd extends MyFramework {

	/**
	 * Instance de notre objet BD
	 * @var string
	 */
	private static $instance;
	
	/**
	 * Le type de bd
	 * @var string
	 */
	protected $_type;
	
	/**
	 * L'hote de la bd généralement localhost
	 * @var string
	 */
	protected $_hote;
	
	/**
	 * Le nom de la bd
	 * @var string
	 */
	protected $_nombd;
	
	/**
	 * Le Data Source Name DSN 
	 * @var string
	 */
	protected $_dsn;
	
	/**
	 * Le nom d'utilisateur ayant des droits sur la bd
	 * @var string
	 */
	private $_user;
	
	/**
	 * Le nom d'utilisateur ayant des droits sur la bd
	 * @var string
	 */
	private $_pass = '';
	
	/**
	 * L'instance de la connexion layoutive
	 * @var string
	 */
	private $_con;
	
	/**
	 * La requete
	 * @var string
	 */
	private $_sql;
	
	/**
	 * Constructeur de l'objet bd
	 *
	 * @param	string
	 * @since	1.0
	 */
	public function __construct($type = 'mysql', $hote = '127.0.0.1', $nombd = 'camertic', $user = 'root', $pass = '') {
		$this->contruitDSN($type, $hote, $nombd);
		$this->declareUser($user);
		$this->declarePass($pass);
	}
	
	/**
	 * Méthode pour se connecter à la bd
	 *
	 * @param	
	 * @since	1.0
	 */
	public function connexion() {
		try {
			$this->_con = new PDO($this->_dsn, $this->_user, $this->_pass);
			$this->_con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch(PDOException $e) {
			printf("Erreur de connexion : %s", $e->getMessage());
			die;
		}
	}
	
	/**
	 * Méthode pour eviter de se connecter 2 fois
	 *
	 * @param	
	 * @since	1.0
	 */
	public static function unique($a, $b, $c, $d, $f) {
		if (!isset(self::$instance)) {
			$classe = __CLASS__;
			self::$instance = new $classe($a, $b, $c, $d, $f);
		}
		return self::$instance;
	}
	
	/**
	 * Méthode de construction du DSN
	 *
	 * @param	string
	 * @since	1.0
	 */
	private function contruitDSN($type, $hote, $nombd) {
		$this->_dsn = "$type:dbname=$nombd;host=$hote";
	}
	
	/**
	 * Méthode pour tester affecter et vérifier le nom d'utilisateur de la bd
	 *
	 * @param	string
	 * @since	1.0
	 */
	private function declareUser($user) {
		$this->_user = $user;
	}
	
	/**
	 * Méthode pour tester affecter et vérifier le mot de passe de l'utilisateur de la bd
	 *
	 * @param	string
	 * @since	1.0
	 */
	private function declarePass($pass) {
		$this->_pass = $pass;
	}
	
	/**
	 * Méthode utilisé pour faire un débuggage lors de l'echec de connexion à la bd
	 * Elle retrace fichier après fichier la ligne ou le script a été interrompu
	 * 
	 * return string
	 */
	 public function debugConnexion() {
		try {
			$this->_con = new PDO($this->_dsn, $this->_user, $this->_pass);
			echo "<pre>"; var_dump(get_class_methods(PDOException)); die;
		}
		catch(PDOException $e) {
			echo "<pre>";var_dump(get_class_methods(PDO)); die;
			print $e->getTraceAsString();
			die;
		}
	 }
	
	/**
	 * Pour empecher la clonage de notre instance
	 * 
	 */
	public function __clone() {
		trigger_error('Clonage non autorise.' , E_USER_ERROR);
	}
	
	/**
	 * Méthode pour executer une requete
	 * 
	 * return ressource
	 */
	public function executeRequete($requete, $typerequete = null, $donnees = null) {
		
		try {
			$this->_con->exec($requete);
		}catch(PDOException $e) {
		//	print "Erreur ! : " . $e->getMessage() . "<br />";
			$this->noteErreur($this->protegeDonnee($e->getMessage()));
		}
		
		
	}
	
	public function noteErreur($message) {
		try {
			$message = addslashes($message);
			$sql = "INSERT INTO error_log(ip, script, message, time, methode, navigateur) VALUES('". $_SERVER['REMOTE_ADDR'] ."', '". $_SERVER['SCRIPT_NAME'] ."', '". $message ."', NOW(), '". $_SERVER['REQUEST_METHOD'] ."', '". $_SERVER['HTTP_USER_AGENT'] ."')";
		//var_dump($sql);
			$this->_con->exec($sql);
			
		}catch(PDOException $e) {
		
			 print "Erreur ! : " . $e->getMessage() . "<br />";

		}
	}
	
	public function protegeDonnee($donnee) {
		//echo "cote gpc"; var_dump(get_magic_quotes_gpc());
		return get_magic_quotes_gpc() ? $donnee : $this->_con->quote($donnee);
		
	}
	
	/**
	 * Méthode destructeur de la classe bd
	 * 
	 */
	public function __destructor() {
		isset($this->_con) ? $this->_con = null : $this->_con;
	}
	
}

?>