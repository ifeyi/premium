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

class utilisateur extends bd {

	var $table = 'utilisateurs';
	var $isLoggedIn = false;
	var $utilisateur;
	
	public function __construct() {
		parent::__construct();
	}
	
	/*
	
	*/
	public function login($user, $pass) {
		$this->utilisateur = parent::cleanData($user);
		$pass = parent::cleanData($pass);
		$salt = 'duo';
		$hash = md5($salt.md5($pass));
		//
		$requete = "SELECT id, motdepasse, salt FROM $this->table WHERE utilisateur = '$this->utilisateur' LIMIT 1;";
		var_dump($hash); die;
		if(parent::countResult($requete) == 0) {
			// utilisateur n'existe pas
			return false;
		} else {
			$userdatas = parent::select($requete); $userdatas = $userdatas[0];
			
			if(md5($salt.$userdatas->motdepasse) == $hash) {
				$this->isLoggedIn = true;
				
				$this->authenticateUser($userdatas->id);
				return true;
			}
			else {
				return false;
			}
			//$hash = hash('sha256', $userData['salt'] . hash('sha256', $password) );
		}
	}
	
	public function isLoggedIn() {
	
	}
	
	public function logout() {
	
	}
	
	
	
	/*
	
	*/
	public function authenticateUser($ids) {
		if($this->isLoggedIn == true) {
			$requete = "SELECT * FROM $this->table WHERE id = '$ids' LIMIT 1;";
			$_SESSION['statut'] = 1;
			// $_SESSION['nom'] = $record['nom'];
			// $_SESSION['last_login'] = $record['last_login'];
			// $_SESSION['ip'] = $record['ip'];
			// $_SESSION['iduser'] = $record['id'];
			// $_SESSION['utilisateur'] = $record['utilisateur'];
		}
		else {
			
		}
	}
	
	public function isAuthenticated() {
	
	}
	
	public function getAuthorisedMenus() {
		$req = "SELECT ";
		return $this->select($req);
	}
	
	public function createGroup() {
	
	}
	
	public function addFunctionToGroup() {
	
	}
	
	public function deconnexion() {
	
	}
	
	public function isAuthorised() {
	
	}
	
	public function __destructor() {
		
	}
	
}

?>