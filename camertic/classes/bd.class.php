<?php
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Classe de traitements et layoutions sur la base de données
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	CamerticFramework
 * @since 		Version 1.0
 * @version		1.0
 * @copyright 	Copyright (c) 2011, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */

class bd extends CamerticConfig {

	/**
	 * Instance de notre objet BD
	 * @var string
	 */
	private static $instance = null;
	
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
	private $_pass;
	
	/**
	 * L'instance de la connexion layoutive
	 * @var string
	 */
	private $_con = null;
	private $_result = null;
	
	/**
	 * La requete
	 * @var string
	 */
	private $_sql;
	
	private $_debug = true;
	
	/**
	 * Constructeur de l'objet bd
	 *
	 * @param	string
	 * @since	1.0
	 */
	
	public function __construct() {
		parent::__construct();
		//var_dump(); die;$this->dsn
		$this->contruitDSN();
		$this->declareUser();
		$this->declarePass();
		$this->connexion();
	}
	
	/**
	 * Méthode pour se connecter à la bd
	 *
	 * @param	
	 * @since	1.0
	 */
	public function connexion() {
		try { 
			(!$this->_debug) ? error_reporting(0) : error_reporting(-1);
			$this->_con = new PDO($this->_dsn, $this->_user, $this->_pass/* , array( PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true, ) */);
			
			$this->getInstance()->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch(PDOException $e) {
			printf("Erreur de connexion : %s", $e->getMessage());
			if(!is_null($this->_con))  echo "<pre>". var_dump($this->_con->errorInfo()) . "</pre>";
			die;
		}
	}
	
	/**
	 * Méthode pour eviter de se connecter 2 fois
	 *
	 * @param	
	 * @since	1.0
	 */
	
	public function getInstance() {
		if(!$this->_con) {
			$this->connexion();
		}
		return $this->_con;
	}
	
	
	/**
	 * Méthode de construction du DSN
	 *
	 * @param	string
	 * @since	1.0
	 */
	private function contruitDSN() {
		$this->_dsn = $this->dsn;
	}
	
	/**
	 * Méthode pour tester affecter et vérifier le nom d'utilisateur de la bd
	 *
	 * @param	string
	 * @since	1.0
	 */
	private function declareUser() {
		$this->_user = $this->user;
	}
	
	/**
	 * Méthode pour tester affecter et vérifier le mot de passe de l'utilisateur de la bd
	 *
	 * @param	string
	 * @since	1.0
	 */
	private function declarePass() {
		$this->_pass = $this->pass;
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
	
	/*
	 * Method to make a single insertion in the database
	 * @param string		the query in a string
	 * @return integer 	the number of row affected or 0 if no save was done
	 */
	public function insert($requete, $motif = null) {
		//var_dump($requete); die;
		try {
			$this->getInstance()->exec("set names utf8");
			$this->_result = $this->getInstance()->exec($requete);
			if($this->traceSQL) $this->traceSQL($requete, $motif);
		} catch(PDOException $exception) {
			echo "Erreur de la requete : " . $exception->getMessage() . "<br>";
			echo "<pre>". var_dump($this->_con->errorInfo()) . "</pre>";
		}
		return ( $this->_result ) ? $this->_result : 0;
	}
	
	/*
	 * Method that helps to get traces of action into the database.
	 * You can both know the sql query sent to the database server and wich user generate the query
	 * @param sql 	The query in a string
	 * @param action 	The label of the intention
	 * @return void		Nothing return
	*/
	
	public function traceSQL($sql, $action = null) {
		
		if($this->traceSQL) 
			$req = $this->traceActions ? "INSERT INTO logs(`sql`, `idUser`, `date`) VALUES('".addslashes($sql)."', '".$_SESSION['iduser']."', NOW())" : "INSERT INTO logs(`actions`, `sql`, `idUser`, `date`) VALUES('".addslashes($action)."', '".addslashes($sql)."', '".$_SESSION['iduser']."', NOW())";
		//var_dump($req); die;
		switch ($this->logType) {
			case 'file' : include_once 'fichier.class.php'; $log = new fichier(); $log->logAction($log->sqlLogsFile, $sql); break;
			case 'sql' : $this->getInstance()->exec($req); break;
		}
	}
	
	/*
	 * Method to make a single insertion in the database
	 * @param string		the query in a string
	 * @return integer 	the number of row affected or 0 if no save was done
	 */
	public function update($requete) {
		return $this->insert($requete);
	}
	
	/*
	 * Method to make multiple insertion at a time
	 * Return 
	 */
	public function multiInsert($table, $champsbd, $valeurs) {
		$champs = $this->ConstruitChamps($champsbd);
		$requete = "INSERT INTO " . $table . " SET " . $champs; 
		
		$etat = $this->getInstance()->prepare($requete);
		
		foreach($valeurs as $val) {
			for($i = 1, $j = 0; $i <= count($champsbd); $i++, $j++) {
				$etat->bindParam($i, $val[$j]);
			}
			$etat->execute();
		}
	}
	
	/*
	 * Méthode qui tranforme en chaine de caractère le tableau des champs pour l'insertion dans la base de données
	*/
	private function ConstruitChamps($champsbd) {
		
		$champs = null;
		foreach($champsbd as $champ) {
			$champs .= $champ . " = ?, ";
		}
		
		return substr($champs, 0, strlen(rtrim($champs))-1);
	}
	
	/*
	 *Méthode de sélection
	 */
	public function select($requete, $motif = null) {
		try {
			// if($this->traceSQL == true) {
				// include_once 'fichier.class.php';
				// $log = new fichier();
				// $log->logAction($log->sqlLogsFile, $requete);
			// }
			//if(!is_null($motif)) $this->traceSQL($requete, $motif);
			//is_null($motif) ? : $this->traceSQL($requete, $motif);
			$this->_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if(preg_match("/date/", $requete)) $this->sql("SET lc_time_names = 'fr_FR';");
			$st = $this->getInstance()->query($requete);
		} catch (PDOException $e) {
			echo "Erreur de la requete : " . $e->getMessage() . "<br>";
			echo "<pre>". var_dump($this->_con->errorInfo()) . "</pre>";
		}
		
		return $st->fetchAll(PDO::FETCH_OBJ);
	}
	
	public function count($table) {
		$statement = $this->getInstance()->prepare("SELECT * FROM $table");
		$statement->execute();
		return $count = $statement->rowCount();
	}
	
	public function countResult($request) {
		$statement = $this->getInstance()->prepare($request);
		// Reflection::export(new ReflectionObject($statement));
		//var_dump(Reflection::export(new ReflectionObject($statement))); die;
		$statement->execute();
		return $count = $statement->rowCount();
	}
	
	/*
	 * Method to get the id of the last insertion
	 * @return integer	the value of the last inserted id
	 */
	public function lastId() {
		return $this->getInstance()->lastInsertId();
	}
	
	/** Methode permettant de construire une requete d'insertion */
	protected function buildInsertQuery($data, $table) {
		$fields = '';
		$values = '';
		foreach($data as $k => $v) {
			$fields .= "$k, ";
			($v == '') ? $values .= "NULL, " : $values .= "'$v', ";
		}
		$fields = removeLastChar($fields);
		$values = removeLastChar($values);
		$query = "SET FOREIGN_KEY_CHECKS=0; INSERT INTO $table($fields) VALUES($values);";
		return $query;
	}
	
	/** Methode permettant de construire une requete d'edition */
	protected function buildUpdateQuery($data, $table, $idRecordToUpdate, $primarykeyName = NULL) {
		$updates = '';
		$query = "UPDATE $table SET ";
		foreach($data as $k => $v) {
			if($k != "$primarykeyName")
				$updates .= ($v == '') ? "$k = NULL, " : "$k = '$v', ";
		}
		$updates = removeLastChar($updates);
		$query .= " $updates WHERE $primarykeyName = '$idRecordToUpdate';";
		return $query;
	}
	
	public function getPrimaryKey($table) {
		$sql = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";
		$res = $this->select($sql);
		return $res[0]->Column_name;
	}
	
	
	/** Methode permettant de construire une requete d'edition */
	protected function buildUpdateQueryWhere($data, $table, $idRecordToUpdate = NULL) {
		$updates = '';
		$query = "UPDATE $table SET ";
		foreach($data as $k => $v) {
			if($k != 'identificador')
				$updates .= ($v == '') ? "$k = NULL, " : "$k = '$v', ";
		}
		$updates = removeLastChar($updates);
		$query .= " $updates WHERE identificador = '$idRecordToUpdate';";
		return $query;
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
	public function sql($requete) {
		
		try {
			return $this->getInstance()->exec($requete);
		} catch(PDOException $e) {
			print "Erreur ! : " . $e->getMessage() . "<br />";
			//$this->noteErreur($this->protegeDonnee($e->getMessage()));
		}
		
	}
	
	/**
	 * Méthode pour executer une requete
	 * 
	 * return ressource
	 */
	public function sqls($requete) {
		
		try {
			return $this->getInstance()->query($requete);
		} catch(PDOException $e) {
			print "Erreur ! : " . $e->getMessage() . "<br />";
			//$this->noteErreur($this->protegeDonnee($e->getMessage()));
		}
		
	}
	/*
	 * Méthode pour rechercher dans des données
	 *
	 */
	public function search($word, $table, $champ = null, $champorder = null, $limit = false) {
		$req = "SELECT p.id, p.cip, p.designation, p.pcession, p.ppublic, p.idfournisseur, f.nom AS fournisseur FROM $table LEFT JOIN fournisseurs AS f ON p.idfournisseur = f.id WHERE $champ LIKE '%$word%' ";
		if($limit) { $limit = "LIMIT $limit"; } else { $limit = "LIMIT 200"; }
		$req .= "$limit ";
		//var_dump($req);
		return $this->select($req);
	}
	
	public function noteErreur($message) {
		try {
			$message = addslashes($message);
			$sql = "INSERT INTO error_log(ip, script, message, time, methode, navigateur) VALUES('". $_SERVER['REMOTE_ADDR'] ."', '". $_SERVER['SCRIPT_NAME'] ."', '". $message ."', NOW(), '". $_SERVER['REQUEST_METHOD'] ."', '". $_SERVER['HTTP_USER_AGENT'] ."')";
		//var_dump($sql);
			$this->getInstance()->exec($sql);
			
		}catch(PDOException $e) {
		
			 print "Erreur ! : " . $e->getMessage() . "<br />";

		}
	}
	
	public function cleanQuery($donnee) {
		//echo "cote gpc"; var_dump(get_magic_quotes_gpc());
		return get_magic_quotes_gpc() ? $this->getInstance()->quote($donnee) : $donnee;
		
	}
	/*
	 Methode pour nettoyer les valeurs entrees dans un formulaire
	*/
	public function cleanData($donnee) {
		//echo "cote gpc"; var_dump(get_magic_quotes_gpc());
		return get_magic_quotes_gpc() ? $donnee :  /* $this->getInstance()->quote( */$donnee/* ) */;
		
	}
	
	/**
	 * Méthode destructeur de la classe bd
	 * 
	 */
	public function __destruct() {
		return $this->_con ? $this->_con = null : $this->_con;
	}
	
}

?>