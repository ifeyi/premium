<?php 

function curl($url){

    $headers[]  = "User-Agent:Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13";
    $headers[]  = "Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
    $headers[]  = "Accept-Language:en-us,en;q=0.5";
    $headers[]  = "Accept-Encoding:gzip,deflate";
    $headers[]  = "Accept-Charset:ISO-8859-1,utf-8;q=0.7,*;q=0.7";
    $headers[]  = "Keep-Alive:115";
    $headers[]  = "Connection:keep-alive";
    $headers[]  = "Cache-Control:max-age=0";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_ENCODING, "gzip");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;

}


$data = curl('http://www.google.fr/search?hl=fr&q=site%3A'.$_GET['url']);
$regex = '#<div id=resultStats>(.*?)<nobr>#mis';
preg_match($regex,$data,$match);
//var_dump($match); 
$resultats = $match[1];
$resultats = str_replace("Environ ","",$resultats);
$resultats = str_replace("&nbsp;","",$resultats);
$resultats = str_replace("Â","",$resultats);
$resultats = str_replace("résultats","",$resultats);
$resultats = str_replace("&Acirc;&nbsp;","", htmlentities($resultats));
echo htmlentities($resultats);  
 ?>