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

class menus extends entity {

	var $id;
	var $table_rights = 'rights';
	
	public function __construct() {
		parent::__construct('menus');
	}
	
	public function saveMenu($post) {
		$fields = '';
		$values = '';
		$req = "INSERT INTO $this->table(nombre, descripcion) VALUES ('".$post['nombre']."', '".$post['descripcion']."')";
		$res = $this->insert($req);
		$this->insertRights();
		return $res;
	} 
	
	public function updateMenu($post) {
		$fields = '';
		$values = '';
		$req = "UPDATE $this->table SET nombre = '".$post['nombre']."', descripcion = '".$post['descripcion']."' WHERE identificador = '".$post['identificador']."'";
		$res = $this->update($req);
		return $res;
	} 
	
	public function insertRights() {
		$this->id = $this->lastId();
		$req = "INSERT INTO $this->table_rights(id_menu) VALUES('$this->id')";
		//var_dump($req); die;
		$res = $this->insert($req);
	}
	
	public function createAlias($string) {
		$string = strtolower($string);
		$tstring = explode(" ", $string);
		if(count($tstring) == 1) 
			return $string;
		
	}
	
	public function __destruct() {
		parent::__destruct();
	}
	
}

?>