<?php

/**
 * Classe de traitements et layoutions sur les formulaire
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	MyFramework
 * @since 		Version 1.0
 * @version		1.0
 * @copyright 	Copyright (c) 2011, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */

class formulaire {

	public function __construct() {
		
	}
	
	public function verifieEmail($email) {
		
		if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
			list($username, $domain) = explode('@',$email);
			
			if(!checkdnsrr($domain,'MX')) {
			  return false;
			}
			else return true;
		}
		else {
			return false; 
		}
	}
	
	public function check($data) {
		//var_dump(empty($_POST[$data]));
		if(empty($_GET[$data]) && !isset($_GET[$data]) && empty($_POST[$data]) && !isset($_POST[$data]) )
			return false;
		else return true;
	}
	
	public function get($data) {
		//var_dump($this->check($data));
		if($this->check($data)) 
			return isset($_GET[$data]) ? $_GET[$data] : $_POST[$data];
	}
	
	public static function getForm($data) {
		return $_REQUEST[$data];
	}
	
	public function isRequired($list) {
		
	
	}
	
	public function is($date) {
		
	}
	
	public function __destructor() {
		
	}
	
}

?>