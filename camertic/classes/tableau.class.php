<?php

/**
 * Classe de traitements et layoutions sur les Tableaux
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	Camertic Framework
 * @since 		Version 1.0
 * @version		1.0
 * @copyright 	Copyright (c) 2011, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */

class tableau {

	/**
	 * Instance de notre objet 
	 * @var string
	 */
	 
	public $tableau;
	
	public function __construct($tableau) {
		$this->tableau = $tableau;
	}
	
	/**
	 * Méthode qui affiche un tableau
	 *
	 */	
	public function affiche() {
		print_r($this->tableau);
	}	
	
	/**
	 * Méthode destructeur de la classe bd
	 * 
	 */
	public function __destructor() {
		
	}
	
}

?>