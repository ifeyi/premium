<?php

class lang {

	var $phrases;
	const LANG_PATH = 'languages/';
	
	public function __construct($userlang = null) {
		is_null($userlang) ? $this->load_phrases($this->lang_id()) : $this->load_phrases($userlang);
	}
	
	public function load_phrases($lang_id) {
		$xml = new DomDocument('1.0');

		//path to language directory
		$path = realpath(self::LANG_PATH.DIRECTORY_SEPARATOR.$lang_id.'.xml');
		$lang_path=(self::LANG_PATH.DIRECTORY_SEPARATOR.$lang_id.'.xml');

		$xml->load($lang_path);

		//phrases are inside page tags, first we must get these
		$page = $xml->getElementsByTagName('page'); 
		$page_num=$page->length;

		for($i = 0; $i < $page_num; $i++) {
			
			$page = $xml->getElementsByTagName('page')->item($i);

			//get phase tags and store them into array
			foreach($page->getElementsByTagName('phase') as $phase) {
				$phase_name = $phase->getAttribute('name');
				$phrases[$phase_name] = $phase->firstChild->nodeValue;
				$phrases[$phase_name] = str_replace('\n','<br/>',$phrases[$phase_name]);//var_dump($phase_name);
			}
		}
		$phrases[''] = '';

		$this->phrases=$phrases;
	
	}

	public function lang_id() {
		//determine page language
		$lang_id= isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'en';

		//set the language cookie and update cookie expiration date
		if(!isset($_COOKIE['lang'])) {
			$expiration_date=time()+3600*24*365;
			setcookie('lang',$lang_id,$expiration_date,'/');
		}

		return $lang_id;
	}

	public function change_lang($lang_id) {
		setcookie('lang',$lang_id,$expiration_date,'/');  
	}
}
?>