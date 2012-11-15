<?php
/**
 * Classe de traitements et layoutions sur la base de données
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	MyFramework
 * @since 		Version 1.0
 * @version		1.0
 * @copyright 	Copyright (c) 2011, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */

class url {

	public static $url;
	public static $uri;
	public static $params;
	
	public function __construct() {
		self::$url = $_SERVER['PHP_SELF'];
		self::$params = '';
	}
	
	public static function getVars() {
		
	}
	
	public function setUrlVar($key, $val) {
		if(isset($_SESSION['url'])){
			$flag = false;
			$tab = explode('?', $_SESSION['url']);
			self::$uri = $tab[0];
			$vars = explode('&', $tab[1]);
			foreach($vars as &$t){
				$var = explode('=', $t);
				if($key == $var[0]) {
					$t = $var[0].'='.$val;
					$flag = true;
				}
			}
			if(!$flag) return false;
			$query = implode('&', $vars);
			self::$params = $query;
			return true;
			//var_dump($query); die;
			
		} else {
			$params = $_GET;
			foreach($params as $k => &$var) {
				if($k == $key) {
					$params[$k] = $val;
					self::$params = $params;
					return true;
				}
			}
		}
		
		return false;
	}
	
	public static function saveUrl() {
		$_SESSION['url'] = $_SERVER['PHP_SELF'] . '?' . self::getUrlParams();
	}
	
	public static function getUrlParams() {
		$params = $_GET;
		$vars = '';
		foreach($params as $k => $var) {
			$vars .= $k . '=' . $var . '&';
		}
		return substr($vars, 0, strlen(rtrim($vars))-1);
	}
	
	public static function getUrl() {
		// if(isset($_SESSION['url']))
			// return $_SESSION['url'];
		return $_SERVER['PHP_SELF'] . self::$params;
	}
	
	public function delUrlVar() {
	
	}
	
	public function rewriteUrl() {
		
	}
	
	public function url() {
		
	}
	
	public function __destructor() {
		
	}
}

?>