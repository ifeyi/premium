<?php
@session_start();
/**
 * Classe de gestion des provinces
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	Camertic Framework
 * @since 		Version 1.0
 * @version		1.1
 * @copyright 	Copyright (c) 2012, Patient
 * @license		GNU General Public License
 */

class mdr extends entity {
	
	public function __construct() {
		parent::__construct(__CLASS__);
	}
	
	public function getAutocaristes() {
		$req = "SELECT * FROM $this->table WHERE mdr_categorie = 'autocar' LIMIT 0, 10";
		//var_dump($req); die;
		$res = $this->select($req);
		return $res;
	}
	
	public function demandeInscription($data) {
		$this->saveRecord($data);
	}
	
	public function login($form) {
		
	}
	
	public function getNbAutocariste() {
		$requete = "SELECT * FROM $this->table WHERE mdr_categorie = 'autocar';";
		return $this->countResult($requete);
	}
	
	public function __destruct() {
		parent::__destruct();
	}
	
}

?>