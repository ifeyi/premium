<?php 
//--- Fontion Socket
function send_form($toPost,$code)
{
 // code des resultats :
 // 1 socket ok et action effectuée
 // 2 erreur de connection socket
 // 3 socket ok et action pas effectuée
 // 4 (1 paramètre absent)

 if($code>0 && count($toPost)>0)
 {
  $poststring='codeOrigineClient='.$code;
  foreach($toPost as $k=>$v)
  {
   $poststring.='&'.$k.'='.urlencode($v);
  }
  
  if($_SERVER['SERVER_NAME'] == "192.168.0.4")
  	$host = "www.capretraite.lan";
  else
  	$host = "www.logalys.org";

  $port = 80;
  $path = "/inject/parse.php";

  $fp = fsockopen($host, 80, $errno, $errstr, 30);
  if(!$fp)
  {
   $result=2;
  }
  else
  {
   fputs($fp, "POST $path HTTP/1.1\r\n");
   fputs($fp, "Host: $host\r\n");
   fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
   fputs($fp, "Content-length: ".strlen($poststring)."\r\n");
   fputs($fp, "Connection: close\r\n\r\n");
   fputs($fp, $poststring . "\r\n\r\n");
   while(!feof($fp))
   {
    $resultat.= fgets($fp, 4096);
   }
   fclose($fp);
   if(ereg("parsingOK",$resultat))
   {
    $result=1;
   }
   else
   {
    $result=3;
   }
  }
 }
 else
 {
  $result=4;
 }
 return $result;
}
?>
