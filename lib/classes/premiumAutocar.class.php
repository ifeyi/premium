<?php
@session_start();
/**
 * Classe de gestion des projets
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	Camertic Framework
 * @since 		Version 1.0
 * @version		1.1
 * @copyright 	Copyright (c) 2012, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */

class premiumAutocar extends bd {
	
	public $title = 'Autocar Premium';
	public $urlIndex = 'dashboard.php';
	
	public function __construct() {
		//GLOBAL $app, $user;
		parent::__construct();
		//$app = new premiumAutocar; //var_dump($this); die;
		$user = new utilisateur;
		if($this->checkSession()) { 
			if($user->isAdministrator()) { //die('checkss');
				$this->title = "Autocar Admin";} }
		$this->checkSession();
	}
	
	public function envoyerDemande($POST) {
		
	}
	
	public function checkSession() {
		if(!isset($_SESSION['u']['statut']))
			return false;
		else return true;
	}
	
	public function setLang() {
		
	}
	
	public function initiliaseProject() {
		
		function generateCode($numchars=5,$digits=1,$letters=1){
			$dig = "012345678923456789";
			$abc = "ABCDEFGHJKLMNOPQRSTUVWXYZ";
			$str = '';$randomized='';
			if($letters == 1){
				$str .= $abc;
			}

			if($digits == 1){
				$str .= $dig;
			}

			for($i=0; $i < $numchars; $i++){
				$randomized .= $str{rand() % strlen($str)};
			}

			return $randomized;
		}
		
		if(!isset($_SESSION['codeP'])) {
			$code = generateCode('6','1','1');
			
			while($this->checkCode($code))
				$code = generateCode('6','1','1');
			
			$this->code = $_SESSION['codeP'] = $code;
			
			if(!isset($_SESSION['iduser']))
				$this->newUser();
			
			$this->newProject($code);
		} else {
			$this->getProject($this->getCodeP());
		}
	//	return $this->code;
	}
	
	public function newProject($code) {
		$req = "INSERT INTO $this->table_projects(code, idUser, idStep, status) VALUES('$this->code', '$this->idUser', '0', '1')";
		$this->insert($req);
	}
	
	public function initializePages() {
		$req = "SELECT * FROM $this->table_pages WHERE codeProject = '".$_SESSION['codeP']."' LIMIT 3";
		$res = $this->countResult($req);
		if($res == 0) {
			if($this->getTypePages() == 'custom'){
				$req1 = "INSERT INTO $this->table_pages (`id`, `title`, `content`, `order`, `id_html`, `codeProject`) VALUES (NULL, 'Home', '', '0', 'id0', '".$_SESSION['codeP']."');";
				//$req1 = "INSERT INTO $this->table_pages(id, title, content, order, codeProject) VALUES(NULL, 'Home', '', '1', '".$_SESSION['codeP']."')";
				//var_dump($req1);
				$this->insert($req1);
				return null;
			} else {
				$i = 1;
				foreach($this->standardPages as $page) {
					//$req1 = "INSERT INTO $this->table_pages (`id`, `title`, `content`, `order`, `codeProject`) VALUES (NULL, 'Home', '', '1', '".$_SESSION['codeP']."');";
					$req1 = "INSERT INTO $this->table_pages (`id`, `title`, `content`, `order`, `codeProject`) VALUES(NULL, '".$page."', '', '".$i."', '".$_SESSION['codeP']."')";
					$this->insert($req1);
					$i++;
				}
				return null;
			}
		} else {
			return $this->getPages();
		}
	}
	
	public function addPage($title, $idhtml) {
		if(isset($_SESSION['orderpage'])){
			$_SESSION['orderpage']++;
		} else $_SESSION['orderpage'] = 1;
		$req1 = "INSERT INTO $this->table_pages (`id`, `title`, `content`, `order`, `id_html`, `codeProject`) VALUES (NULL, '".$title."', '', '".$_SESSION['orderpage']."', '$idhtml', '".$_SESSION['codeP']."');";
		//var_dump($req1);
		$this->insert($req1);
	}
	
	public function delPage($id) {
		$req = "DELETE FROM $this->table_pages WHERE id = '$id' LIMIT 1;";
		$this->sql($req);
	}
	
	public function getTypePages() {
		$req = "SELECT typePages FROM $this->table_projects WHERE code = '".$_SESSION['codeP']."' LIMIT 1";
		$res = $this->select($req);
		return $res[0]->typePages;
	}
	
	public function updatePageType($type) {
		if($this->getTypePages() != $type) {
			$req = "UPDATE $this->table_projects SET typePages = '$type' WHERE code = '".$_SESSION['codeP']."'";
			$this->update($req);
			$req1 = "DELETE FROM $this->table_pages WHERE codeProject = '".$_SESSION['codeP']."'";
			$this->sql($req1);
		}
	}
	
	public function updatePage($id, $title, $textarea = null, $type = null) {
		if(!is_null($textarea)) {
			$req = "UPDATE $this->table_pages SET title = '$title', content = '$textarea', type = '$type', modified = '1' WHERE id = '$id'";
			$this->update($req);
		} else {
			$req = "UPDATE $this->table_pages SET title = '$title' WHERE id_html = '$id'";
			$this->update($req);
		}
	}
	
	public function updateOrder() {
		
	}
	
	public function setDesiredDomain($domain) {
		$req = "UPDATE $this->table_projects SET desiredDomain = '$domain' WHERE code = '".$_SESSION['codeP']."';";
		$this->update($req);
	}
	
	public function getButtonInfod($idPage) {
		$req = "SELECT * FROM $this->table_pages WHERE id = '".$idPage."' LIMIT 1";
		$res = $this->select($req);
		return $res[0];
	}
	
	public function getNextStep($idStep) {
		if($idStep == 0) {
			return true;
		} else {
			if($this->checkCurrentStep($idStep)) {
				$this->saveStep($idStep);
			}
		}
	}
	
	public function saveActivity($classe, $other = null) {
		switch($classe) {
			case 'activityPlumber': 
				$req = "UPDATE $this->table_projects SET idActivity = '".$this->getActivityId($classe)."', activity = '' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'activityArchitect': 
				$req = "UPDATE $this->table_projects SET idActivity = '".$this->getActivityId($classe)."', activity = '' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'activityCompany': 
				$req = "UPDATE $this->table_projects SET idActivity = '".$this->getActivityId($classe)."', activity = '' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'activityRestaurant': 
				$req = "UPDATE $this->table_projects SET idActivity = '".$this->getActivityId($classe)."', activity = '' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'activityInsurer': 
				$req = "UPDATE $this->table_projects SET idActivity = '".$this->getActivityId($classe)."', activity = '' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'activity': 
				$req = "UPDATE $this->table_projects SET idActivity = '".$this->getActivityId($classe)."', activity = '$other' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
		}
	}
	
	public function saveCompanyDetails($post) {
			$name = addslashes($post['name']);
			$desc = addslashes($post['description']);
			$f1 = addslashes($post['f1']);
			$f2 = addslashes($post['f2']);
			$f3 = addslashes($post['f3']);
		
		if(!isset($_SESSION['companyName'])) {
			$_SESSION['companyName'] = $name;
			$req = "INSERT INTO $this->table_infos(codeProject, name, description, force1, force2, force3) VALUES('".$_SESSION['codeP']."', '$name', '$desc', '$f1', '$f2', '$f3');";
			return $this->insert($req);
		} else {
			$_SESSION['companyName'] = $name;
			$req = "UPDATE $this->table_infos SET name = '$name', description = '$desc', force1 = '$f1', force2 = '$f2', force3 = '$f3' WHERE codeProject = '".$_SESSION['codeP']."'";
			return $this->update($req);
		}
	}
	
	public function getCompanyDetails($code) {
		$req = "SELECT * FROM $this->table_infos WHERE codeProject = '$code' LIMIT 1";
		//var_dump($req);
		$res = $this->select($req);
		if(empty($res))
			return null;
		else
			return $res[0];
	}
	
	public function saveColor($classe) {
		switch($classe) {
			case 'noPreference':
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req);
			case 'blue': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'red': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'orange': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'green': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'purple': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'grey': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
			case 'black': 
				$req = "UPDATE $this->table_projects SET idColor = '".$this->getColorId($classe)."' WHERE code = '".$_SESSION['codeP']."'";
				return $this->update($req); break;
		}
	}
	
	public function getNetworksInfos() {
		$req = "SELECT t1.facebook, t1.twitter, t1.googleplus, t1.youtube, t1.pack1, t1.pack2 FROM $this->table_networks AS t1 WHERE t1.idProject = '".$_SESSION['codeP']."' LIMIT 1";
		$res = $this->select($req);
		if(empty($res))
			return null;
		else
			return $res[0];
	
	}
	
	public function saveNetworks($arr) {
		$facebook = addslashes($arr['f']);
		$twitter = addslashes($arr['t']);
		$youtube = addslashes($arr['y']);
		$googleplus = addslashes($arr['g']);
		$p1 = ($arr['p1'] == 'I want this pack') ? 0 : 1;
		$p2 = ($arr['p2'] == 'I want this pack') ? 0 : 1;
			
		if(!isset($_SESSION['networks'])) {
			$req = "INSERT INTO $this->table_networks(idProject, pack1, pack2, facebook, twitter, youtube, googleplus) VALUES('".$_SESSION['codeP']."', '$p1', '$p2', '$facebook', '$twitter', '$youtube', '$googleplus');";
			$this->insert($req);
			$_SESSION['networks'] = 1;
		} else {
			$req = "UPDATE $this->table_networks SET pack1 = '$p1', pack2 = '$p2', facebook = '$facebook', twitter = '$twitter', youtube = '$youtube', googleplus = '$googleplus' WHERE idProject = '".$_SESSION['codeP']."'";
			$this->update($req);
		}
	}
	
	public function pb() {
		// $req = "SELECT t1.idInfos, t2.name, t2.description, t2.force1, t2.force2, t2.force3 FROM $this->table_projects AS t1 INNER JOIN $this->table_infos AS t2 ON t1.idInfos = t2.codeProject WHERE t1.code = '$code' LIMIT 1";
		// $res = $this->select($req);
		// if(empty($res))
			// return null;
		// else
			// return $res[0];
	}
	
	private function getActivityId($cl) {
		$req = "SELECT id FROM $this->table_activities WHERE class = '$cl' LIMIT 1";
		$res = $this->select($req);
		return $res[0]->id;
	}
	
	public function getPages() {
		$req = "SELECT * FROM $this->table_pages WHERE codeProject = '".$_SESSION['codeP']."' ORDER BY `order` ASC";
		//var_dump($req); die;
		$res = $this->select($req);
		return $res;
	}
	
	public function updatePagesOrder($idspages) {
		//$listingCounter = 1;
		foreach($idspages as $order => $idp) {
			$this->updatePageOrder($idp, $order);
		}
		//die;
	}
	
	public function updatePageOrder($id, $order) {
		$query = "UPDATE $this->table_pages SET `order` = '" . $order . "' WHERE id = '" . $id . "';";
		//var_dump($query);
		$this->sql($query);
	}

	public function getPageInfos($id) {
		$req = "SELECT * FROM $this->table_pages WHERE id = '$id' LIMIT 1";
		$res = $this->select($req);
		if(empty($res))
			return null;
		else
			return $res[0];
	}
	
	public function updatePageInfos($post) {
		$f1 = addslashes($post['f1']);
		$f2 = addslashes($post['f2']);
		$f3 = addslashes($post['f3']);
	
	}
	
	public function getPageType($d) {
		switch($d) {
			case 'text': return 'Texte'; break;
			case 'gallery': return 'Image Gallery'; break;
			case 'contact': return 'Contact'; break;
			case 'map': return 'Google Map'; break;
			default : return 'Unknown'; break;
		}
	}
	
	public function goToPreviousStep($idStep) {
	
	}
	
	public function goToNextStep() {
		
	}
	
	public function checkCurrentStep($idStep) {
		
	}
	
	public function saveStep($idStep) {
		
	}
	
	public function newUser() {
		$req = "INSERT INTO $this->table_users(id, email) VALUES('', '');";
		$this->insert($req);
		$this->idUser = $_SESSION['iduser'] = $this->lastId();
		//return $this->idUser;
	}
	
	public function checkCode($code) {
		$req = "SELECT code FROM $this->table_projects WHERE code = '$code' LIMIT 1";
		$res = $this->countResult($req);
		if($res == 1)
			return true;
		else
			return false;
	}
	
	public function __destruct() {
		parent::__destruct();
	}
	
}

?>