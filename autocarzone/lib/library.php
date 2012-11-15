<?php

define("DS", DIRECTORY_SEPARATOR);
define("AJAX_F", "_ajax/"); // DOSSIER DE SCRIPT SAJAX

global $viewFolder;
global $currentView;
global $layoutFolder;
global $globalViewFolder;
global $cssFolder;
global $jsFolder;

//$http = $_SERVER['HTTP_REFERER'];
$jsFolder = "js/";
$cssFolder = "css/";
$globalViewFolder = "views";
$layoutfolder = "";

function getView() {
	if(isset($_GET['view'])) {
		$path = $_SERVER['DOCUMENT_ROOT'].DS.'views'.DS.$_GET['view'].'.php';
		$path = realpath('.'.DS.'views'.DS.$_GET['view'].'.php');
		include_once($path);
	}
}

function isView() {
	if(isset($_GET['view'])) {
		// UNE VUE EST PRECISE
		$foldername = $_GET['view'];
		global $viewFolder;
		global $globalViewFolder;
		$vuedossier = $globalViewFolder . "/" . $foldername;
		if(is_dir($vuedossier)) {
			$viewFolder = $vuedossier;
			$_SESSION['currentView'] = $viewFolder;
			return true;
		} else {
			echo "Dossier de vue '$foldername' introuvable!";
			return false;
		}
	} else {
		// AFFICHAGE SANS VUE
		return false;
	}
}

function getLayout() {
	if(isset($_GET['layout'])) {
		$file = $_GET['layout'];
		global $viewFolder;
		global $layoutFolder;
		$filelayout = $viewFolder .'/'.$layoutFolder.$file .'.'. 'php';
		$camertic = new CamerticConfig;
		$folderlayout = $_SERVER['DOCUMENT_ROOT'] . $camertic->appfolder . '/' . $viewFolder .'/'.$layoutFolder.$file ;
		//var_dump($folderlayout);
		if(is_file($filelayout)) {
			include_once($filelayout);
			return true;
		}
		elseif(is_dir($folderlayout)) {
			if(isset($_GET['option'])) {
				$filelayout = $folderlayout . DS . $_GET['option'] . ".php";
				if(is_file($filelayout)) {
					include_once($filelayout);
					return true;
				}
				else {
					echo "Option '" . $_GET['option'] . "' introuvable!";
					return false;
				}
			}
			else {
				$filelayout = $folderlayout . DS . "default.php";
				try { includecss(array('iconview.css', 'tagtip.css', )); } catch(Exception $e) { echo $e->getMessage(); }
				try { includejs('tagtip.js'); } catch(Exception $e) { echo $e->getMessage(); }
				include_once($filelayout);
				return true;
			}
		}
		else {
			echo "Affichage '$file' introuvable!";
			return false;
		}
	} else {
		$view = $_SESSION['currentView'] . DS . "default.php";
		includecss('iconview.css');
		includecss('tagtip.css');
		includejs('tagtip.js');
		include($view);
		return false;
	}
}

function includecss($file) {
	global $cssFolder;
	$css = "";
	if(is_string($file)) {
		$file = $cssFolder . $file;
		if(is_file($file))
			$css .= '<link type="text/css" rel="stylesheet" href="'.$file.'">'. PHP_EOL;
		else
			throw new Exception('fichier(s) '.$file.' de feuille de style introuvable!');
	} elseif(is_array($file)) {//die('includeccss');
		
		foreach($file as $f) {
			$fi = $cssFolder . $f;
			$css .= '<link type="text/css" rel="stylesheet" href="'.$fi.'">'. PHP_EOL;
			
		}
	} else {
		throw new Exception('fichier(s) de feuille de style introuvable!');
	}//
	return $css;
}

function addStyle($style) {
	
}

function addScript($script) {
	
}

function includejs($file) {
	global $jsFolder;
	$js = "";
	if(is_string($file)) {
		//$file = $jsFolder . $file;
		$js .= "<script type='text/javascript' src='$file'></script>". PHP_EOL;
	} elseif(is_array($file)) {
		foreach($file as $f) {
			$fi = $jsFolder . $f;
			$js .= "<script type='text/javascript' src='$fi'></script>". PHP_EOL;
		}
	} else 
		throw new Exception('fichier(s) '. $file .' de script introuvable!');
		//var_dump($js); die;
	return $js;
}

function getLayoutView() {
	$layout = '?view=';
	if(isset($_GET['view'])) {
		$layout .= $_GET['view'];
		if(isset($_GET['layout'])) {
			$layout .= '&layout='.$_GET['layout'];
		}
	} else {
		
	}
	return $layout;
} 

function jrMoisSuivant($date) {	
	list($year, $month, $day) = explode('-', $date);
	$next = date('Y-m-d', mktime(0, 0, 0, $month + 1, $day, $year));
	return $next;
}

function jrSuivant($date) {
	$date = strtotime("+1 day", strtotime($date));
	return date("Y-m-d", $date);
}

function dateDifference($start, $end) {
	$start_ts = strtotime(dateMysql($start));
	$end_ts = strtotime(dateMysql($end));
	$diff = $end_ts - $start_ts;
	return round($diff / 86400);
}

// function changeFormatDate($date1, $date2 = null) {
	// $tab = array();
	// $tab = explode('-', $date1);
	// $date2 = '';
	// for($i = 2; $i >= 0; $i--) {
		// $date2 .= $tab[$i] . "/";
	// }
	// return substr($date2, 0, strlen(rtrim($date2))-1);	
// }

function removeLastChar($string) {
	return substr($string, 0, strlen(rtrim($string))-1);
}

function removeLastWord($string) {
	$string = trim($string);
	$array = explode(" ", $string);
	$count = count($array);
	$lastWordLength = strlen($array[$count-1]);
	$string = substr($string, 0, -$lastWordLength);
	return $string;
}

function FormatDateLecture($date) {
	list($year, $month, $day) = explode('-', $date);
	return date('d F Y', mktime(0, 0, 0, $month, $day, $year));
}

function ajouteJour($date, $nbjr) {
	$date = strtotime("+$nbjr day", strtotime($date));
	return date("Y-m-d", $date);
}

function diffJour($d1, $d2) {
	$datetime1 = new DateTime($d1);
	$datetime2 = new DateTime($d2);
	$interval = $datetime1->diff($datetime2);
	return $interval->format('%R%a');
} 

// function translateMois($m) {
	// switch($m) {
		// case 'January': return 'Janvier'; break;
		// case 'Tuesday': return 'Mardi'; break;
		// case 'Wednesday': return 'Mercredi'; break;
		// case 'Thursday': return 'Jeudi'; break;
		// case 'Friday': return 'Vendredi'; break;
		// case 'Saturday': return 'Samedi'; break;
		// case 'Sunday': return 'Dimanche'; break;
	// }
// }

// function translateJrSemaine($j) {
	// switch($j) {
		// case 'Monday': return 'Lundi'; break;
		// case 'Tuesday': return 'Mardi'; break;
		// case 'Wednesday': return 'Mercredi'; break;
		// case 'Thursday': return 'Jeudi'; break;
		// case 'Friday': return 'Vendredi'; break;
		// case 'Saturday': return 'Samedi'; break;
		// case 'Sunday': return 'Dimanche'; break;
	// }
// }

function todayDate() {
	setlocale(LC_ALL, 'fr_FR');
	return date("D j F Y");
}

// function dateMysql($date1, $date2 = null) {
	// $tab = array();
	// $tab = explode('/', $date1);
	// $date2 = '';
	// for($i = 2; $i >= 0; $i--) {
		// $date2 .= $tab[$i] . "-";
	// }
	// return substr($date2, 0, strlen(rtrim($date2))-1);	
// }

function __autoload($class_name) {
	$file = getCamerticClassFile($class_name);
	//var_dump($file);
	try {
		if(is_file($file))
			include_once $file;
		else {
			if(getAppClassFile($class_name)) {
				include_once getAppClassFile($class_name);
			} else die('Classe '.$class_name.' introuvable!');
		}
	} catch (Exception $e) {
		throw new Exception("Impossible de charger $file");
		die;
	}
}

function getCamerticClassFile($file) {
	$path_to_file = '.' . DS .'camertic' . DS . 'classes' . DS .  $file . '.class' . '.php';
	$path2_to_file = '..' . DS .'camertic' . DS . 'classes' . DS .  $file . '.class' . '.php';
	$real_path = @realpath($path_to_file) ? @realpath($path_to_file) : @realpath($path2_to_file); //die($real_path);
	return $real_path;
}

function getAppClassFile($file) {
	$path_to_file = 'lib' . DS . 'classes' . DS .  $file . '.class' . '.php';
	$real_path = realpath($path_to_file);
	return $real_path;
}

function ajax_inclusion($view) {
	require_once('../config.php');
	require_once('../lib/library.php');
	require_once("../camertic/classes/bd.class.php");
	require_once("../camertic/classes/formulaire.class.php");
	require_once("../camertic/classes/url.class.php");
	if(is_array($view)) {
	
	}
	else {
		$classfile = "classes/$view.class.php";
		if(is_file("../camertic/$classfile"))
			require_once("../camertic/$classfile");
		else
			require_once("../lib/$classfile");
	}
}

function tronque($string, $max_length){ // fonction qui permet de tronquer un mot sans couper une phrase
    if (strlen($string) > $max_length){
        $string = substr($string, 0, $max_length);  
        $pos = strrpos($string, " ");  
        if($pos === false) {  
                return substr($string, 0, $max_length)."...";  
        }  
        return substr($string, 0, $pos)."...";  
    }else{  
        return $string;  
    }  
} 

function formatMoney($number, $fractional=false) { 
    if ($fractional) { 
        $number = sprintf('%.2f', $number); 
    } 
    while (true) { 
        $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1 $2', $number); 
        if ($replaced != $number) { 
            $number = $replaced; 
        } else { 
            break; 
        } 
    } 
    return $number; 
} 

function refactorMoney($cash) {
	$cash = explode(" ", $cash);
	$c = '';
	foreach($cash as $p) {
		$c .= $p;
	}
	return (int) $c;
}

function go($location) {
	//changeOption($location);
	$_SESSION['goto'] = url::$uri . '?' . changeOption($location);
}

function changeOption($option) {	
	url::setUrlVar('option', $option);
	return url::$params;
}

function trouvefichier($file) {
	$fichier = new fichier();
	return $fichier->localizeFile($file);
}

function enlevePoint($chaine) {

}

function enleveAccent($chaine) {
	$chaine = strtr($chaine,"ÀÂÄÇÈÉÊËÌÎÏÑÒÔÕÖÙÛÜ","AAACEEEEIIINOOOOUUU");
	$chaine = strtr($chaine,"àáâãäåçèéêëìíîïñòóôõöùúûüýÿ","aaaaaaceeeeiiiinooooouuuuyy");
	return $chaine;
}

function getComponent($component) {
	include_once('components'.DS.$component.'.php');
}

// $inclusion = function($nomfichier) {
	// $fichier = new fichier();
	// $dossierappli = $_SERVER['DOCUMENT_ROOT'] . $fichier->appfolder;
	// $fichier->getFoldersRecursion($dossierappli);
// };

// $trouvefichier = function($file) {
	// $fichier = new fichier();
	// echo $fichier->localizeFile($file);
// };

// $incluefichier = function($file) {
	// $fichier = new fichier();
	// include_once($fichier->localizeFile($file));
// };

// $librairie = function($lib) {
	// $fichier = new fichier();
	// include_once($fichier->localizeFile($lib));
// };

// $header = function() {
	// if(isset($_SESSION['goto'])) {
		// $go = $_SESSION['goto'];
		// unset($_SESSION['goto']);
		// header("location:$go");
		// die;
	// }
// };


// fin de la library