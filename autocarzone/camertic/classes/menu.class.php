<?php

/**
 * Classe de traitements et layoutions sur les fichier
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	MyFramework
 * @since 		Version 1.0
 * @version		1.0
 * @copyright 	Copyright (c) 2011, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */

class menu extends utilisateur {
	
	
	
	public function __construct() {
		parent::__construct();
	}
	
	/*
	
	*/
	public function getMenus($id = null) {
		if(is_null($id)) {
			$req = "SELECT m.id, m.titre as titremenu, m.lien as lienmenu, f.parent_id as parent, ud.droits as acces ";
			$req .= "FROM utilisateurs_menus_droits as ud ";
			$req .= "LEFT JOIN utilisateurs_fonctions_menus as m ON m.id = ud.idMenu ";
			$req .= "LEFT JOIN utilisateurs_fonctions as f ON f.id=m.fonction WHERE m.etat = 1 AND m.parent = 0 AND ud.droits = 1 AND ud.idUser= ".$_SESSION['iduser'];
			$req .= " ORDER BY m.ordre ASC";
			
		} else {
			$req = "SELECT m.id, m.titre as titremenu, m.lien as lienmenu, f.parent_id as parent, ud.droits as acces ";
			$req .= "FROM utilisateurs_menus_droits as ud ";
			$req .= "LEFT JOIN utilisateurs_fonctions_menus as m ON m.id = ud.idMenu ";
			$req .= "LEFT JOIN utilisateurs_fonctions as f ON f.id=m.fonction WHERE m.etat = 1 AND m.parent = ".$id." AND ud.droits = 1 AND ud.idUser= ".$_SESSION['iduser'];
			$req .= " ORDER BY m.ordre ASC";	//var_dump($req); die;
		}
		return $this->select($req);
	}
	
	public function getEtat() {}
	
	public function afficheMenus($id = null) {
		$html = ''; 
		$menus = array();
		$menus = (is_null($id)) ? $this->getMenus() : $this->getMenus($id);
		
		$html .= '<ul>';
		foreach($menus as $m) {
			$html .= '<li>';
			$html .= '<a href="'.$m->lienmenu.'">'.$m->titremenu.'</a>';
			$html .= '</li>';
		}
		$html .= '</ul>';
		return $html;
	}
	/*
	*  Teste si un menu possede des fils (est parent)
	*/
	public function isParent($idmenu) {
		
		if(count($this->getMenus($idmenu)) > 0)
			return true;
		else
			return false;
	}
	
	public function deconnexion() {
	
	}
	
	public function writeUrl () {
	
	}
	
	public function isAuthorise() {
	
	}
	
	public function __destructor() {
		
	}
	
}

?>