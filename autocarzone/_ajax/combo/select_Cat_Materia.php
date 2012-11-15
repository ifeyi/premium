<?php 
@session_start();
require_once '../config.php';
require_once '../lib/library.php';
require_once '../camertic/classes/bd.class.php';
require_once '../lib/classes/entity.class.php';
require_once '../lib/classes/materias.class.php';

$C = new CamerticConfig;
$p = new materias; 
$mun = $p->getMateriasFromCategory($_GET['id']);

//var_dump($mun); die;
$json = '['; // start the json array element
$json_names = array();

foreach ($mun as $id => $name) {
	$json_names[] = "{\"optionValue\": $name->identificador, \"optionDisplay\": \"".utf8_encode($name->nombre)."\"}";
}

$json .= implode(',', $json_names); // join the objects by commas;
$json .= ']'; // end the json array element
echo $json;

?>