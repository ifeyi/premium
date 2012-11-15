<?php
/**
 * Classe de gestion des entites
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	Camertic Framework
 * @since 		Version 1.0
 * @version		1.1
 * @copyright 	Copyright (c) 2012, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */

abstract class entity extends bd {
	
	protected $table;
	public $id;
	protected $primaryKey;
	/**  Variable pour les données surchargées.  */
    private $data = array();

    /**  La surcharge n'est pas utilisée sur les propriétés déclarées.  */
    public $declared = 1;
	 /**  La surcharge n'est lancée que lorsque l'on accède à la classe depuis l'extérieur.  */
    private $hidden = 2;

    public function __set($name, $value) {
       // echo "Définition de '$name' à la valeur '$value'\n";
        $this->$name = $value;
    }

    public function __get($name) {
       // echo "Récupération de '$name'\n";
        //if (array_key_exists($name, $this->data)) {
            //return $this->data[$name];
            return $this->$name;
        //}

        $trace = debug_backtrace();
        trigger_error(
            'Propriété non-définie via __get(): ' . $name .
            ' dans ' . $trace[0]['file'] .
            ' à la ligne ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }

    /**  Depuis PHP 5.1.0  */
    public function __isset($name) {
        //echo "Est-ce que '$name' est défini ?\n";
        return isset($this->$name);
    }

    /**  Depuis PHP 5.1.0  */
    public function __unset($name) {
        //echo "Effacement de '$name'\n";
        unset($this->$name);
    }
	public function __construct($table = null) {
		parent::__construct();
		if(is_null($table))
			return 'Table nom specifiee pour ' . __CLASS__;
		$this->setTableName($table);
		//var_dump($table);
		$this->primaryKey = $this->getPrimaryKey($this->table);
	}
	
	protected function setTableName($tableName) {
		$this->table = $tableName;
	}
	
	public function getAllFields() {
		$fieldList = array();
		$req = "SHOW FIELDS FROM $this->table";
		$res = $this->select($req);
		foreach($res as $f)
			$fieldList[] = $f->Field;
		return $fieldList;
	}
	
	/** Methode de sauvegarde ou de mise a jour d'un enregistrement */
	public function saveRecord($post, $exceptions = null) {
		if($exceptions)
			if(is_array($exceptions))
				foreach($exceptions as $e)
					unset($post[$e]);
		//var_dump($post);die;
		isset($post["$this->primaryKey"]) ? $this->updateRecord($post) : $this->newRecord($post);
	}
	
	/** Methode de sauvegarde d'un nouvel enregistrement */
	protected function newRecord($post) {
		foreach($post as $index => $valeur) {
			$this->$index = $valeur;
			$this->data[$index] = $valeur;
		}
		$query = $this->buildInsertQuery($this->data, $this->table);
		//var_dump($query); die;
		$this->insert($query);
	}
	
	/** Methode de mise a jour d'un enregistrement */
	protected function updateRecord($post) {
		foreach($post as $index => $valeur) {
			$this->$index = $valeur;
			$this->data[$index] = $valeur;
		}
		//
		$query = $this->buildUpdateQuery($this->data, $this->table, $post["$this->primaryKey"], $this->primaryKey);
		$query = "SET FOREIGN_KEY_CHECKS=0; " . $query;
		//var_dump($query); 
		$this->update($query);
	}
	
	public function getRecord($id){
		$req = "SELECT * FROM $this->table WHERE $this->id = '$id' LIMIT 1";
		$res = $this->select($req);
		return $res[0];
	}
	
	
	public function getName($id, $table, $field = null) {
		if($id == '' || is_null($id))
			return '';
		//
		if(is_null($field))
			$req = "SELECT nombre FROM $table WHERE identificador = '$id' LIMIT 1";
		else
			$req = "SELECT $field as nombre FROM $table WHERE identificador = '$id' LIMIT 1";
		//var_dump($req); 
		$res = $this->select($req);
		return $res[0]->nombre;
	}
	
	public function log() {
		$req = "INSERT INTO ";
	}
	
	public function getAllRecords($track = false, $motif = null) {
		$req = "SELECT * FROM $this->table";
		$motif = is_null($motif) ? "Displays the records for $this->table" : $motif;
		//var_dump($motif); die;
		if($track == false || ($track == false && is_null($motif)))
			$res = $this->select($req);
		else
			$res = $this->select($req, $motif);
		return $res;
	}
	
	protected function buildUpdateQueryWhere($data, $keys, $table = null) {
		$table = is_null($table) ? $table = __CLASS__ : $table;
		$updates = '';
		$where = '';
		$query = "UPDATE $table SET ";
		
		foreach($data as $k => $v)
			if(!in_array($v, $keys))
				$updates .= ($v == '') ? "$k = NULL, " : "$k = '$v', ";
		$updates = removeLastChar($updates);
		
		foreach($keys as $k => $v)
			$where .= "$k = '$v' AND "; 
		$where = removeLastWord(trim($where));
		
		$query .= " $updates WHERE $where";
		return $query;
	}
	
	public function delRecord($id) {
		$id = is_array($id) ? $id['identificador'] : $id;
		$req = "DELETE FROM $this->table WHERE identificador = '$id';";
		//var_dump($req); die;
		$this->sql($req);
	}
	
	public function __destruct() {
		parent::__destruct();
	}
	
}

?>