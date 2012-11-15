<?php
/**
 * Classe de traitements et layoutions sur les mails
 * @author 		Patient Assontia <assontia@gmail.com>
 * @package 	MyFramework
 * @since 		Version 1.0
 * @version		1.0
 * @copyright 	Copyright (c) 2011, Bertrand, Patient et Fabrice
 * @license		GNU General Public License
 */

class mail
{
	var $To;
	var $Cc;
	var $Bcc;
	var $From;
	var $ReplayTo;
	var $Subject;
	var $Header;
	var $Body_html;
	var $Html_images;
	var $Body_txt;
	var $Attachments;
	var $Boundary;
        var $Priority;
	
	public function __construct() {
		$this->To = null;
		$this->Cc = null;
		$this->Bcc = null;
		$this->From = null;
		$this->ReplayTo = null;
		$this->Subject = "";
		$this->Header = null;
		$this->Body_html = null;
		$this->Html_images = null;
		$this->Body_txt = null;
		$this->Attachments = null;
		$this->Priority = null;
	}
	
	public function setHtmlBody($body) {
		$this->Body_html = $body;
	}
	
	public function setTextBody($body) {
		$this->Body_txt = $body;
	}
	
	public function setPriority($priority=3) {
		/**
		1: Highest Priority
		2: High Priority
		3: Normal (default if not defined)
		4: Low Priority
		5: Lowest Priority
		*/

		if($priority > 0 && $priority < 6)
		{
			$this->Priority = $priority;
			return true;
		}
		else 
			return false;
	}
	
	public function addTo($email) {
		if(!is_array($this->To))
			$this->To = array();
		if($this->checkMail($email))
		{
			$this->To[] = $email;
			return true;
		}
		return false;
	}
	
	public function addCc($email) {
		if(!is_array($this->Cc))
			$this->Cc = array();
		if($this->checkMail($email))
		{
			$this->Cc[] = $email;
			return true;
		}
		return false;
	}
	
	public function addBcc($email) {
		if(!is_array($this->Bcc))
			$this->Bcc = array();
		if($this->checkMail($email))
		{
			$this->Bcc[] = $email;
			return true;
		}
		return false;
	}
	
	public function setFrom($name)
	{
		$this->From = $name;
	}
	
	public function setSubject($subject)
	{
		$this->Subject = $subject;
	}
	
	public function setReplyTo($email)
	{
		if($this->checkMail($email))
		{
			$this->ReplayTo = $email;
			return true;
		}
		return false;
	}
	
	public function addAttachment($name, $type, $path, $encoding="base64")
	{
		if(!is_array($this->Attachments))
			$this->Attachments = array();
		$this->Attachments[] = array('name'=>$name, 'type'=>$type, 'path'=>$path, 'encoding'=>$encoding);
	}
	
	public function send()
	{
		$mail = $this->build();
		//var_dump($this->Header); die;
		foreach($this->To as $to)
			mail($to, $this->Subject, $mail, $this->Header);
	}
	
	public function build()
	{
		$this->getHeader();
		if($this->Body_html && !is_array($this->Attachments))
		{
			$boundary = "=-".md5(microtime());
			$this->Header = preg_replace("=\[BOUNDARY\]=", $boundary, $this->Header);
			$boundary_alt = "=-".md5(microtime());
			$this->parseHtml($boundary);
			$msg  = "--".$boundary."\n".
							"Content-Type: multipart/alternative; boundary=\"".$boundary_alt."\"\n\n".
							"--".$boundary_alt."\n".
							"Content-Type: text/plain; charset=utf-8\n".
							"Content-Transfer-Encoding: 7bit\n\n".
							$this->Body_txt."\n\n".
							"--".$boundary_alt."\n".
							"Content-Type: text/html; charset=utf-8\n".
							"Content-Transfer-Encoding: 7bit\n\n".
							$this->Body_html."\n\n".
							"--".$boundary_alt."--\n\n".
							$this->Html_images.
							"--".$boundary."--\n";
		}
		elseif($this->Body_html && is_array($this->Attachments))
		{
			$boundary = "=-".md5(microtime());
			$boundary_mail = "=-".md5(microtime());
			$this->Header = preg_replace("=\[BOUNDARY\]=", $boundary, $this->Header);
			$boundary_alt = "=-".md5(microtime());
			$this->parseHtml($boundary_mail);
			$msg  = "--".$boundary."\n".
							"Content-Type: multipart/related; type=\"multipart/alternative\"; boundary=\"".$boundary_mail."\"\n\n".
							"--".$boundary_mail."\n".
							"Content-Type: multipart/alternative; boundary=\"".$boundary_alt."\"\n\n".
							"--".$boundary_alt."\n".
							"Content-Type: text/plain; charset=iso-8859-1\n".
							"Content-Transfer-Encoding: 7bit\n\n".
							$this->Body_txt."\n\n".
							"--".$boundary_alt."\n".
							"Content-Type: text/html; charset=utf-8\n".
							"Content-Transfer-Encoding: 7bit\n\n".
							$this->Body_html."\n\n".
							"--".$boundary_alt."--\n\n".
							$this->Html_images.
							"--".$boundary_mail."--\n\n".
							$this->getAttachments($boundary).
							"--".$boundary."--\n";
		}
		elseif($this->Body_txt && is_array($this->Attachments))
		{
			$boundary = "=-".md5(microtime());
			$this->Header = preg_replace("=\[BOUNDARY\]=", $boundary, $this->Header);
			$msg = "--".$boundary."\n".
						 "Content-Type: text/plain; charset=UTF-8\n".
						 "Content-Transfer-Encoding: 7bit\n\n".
						 $this->Body_html."\n\n".
						 $this->getAttachments($boundary).
						 "--".$boundary."--\n";
		}
		else 
			$msg = $this->Body_txt;
		return $msg;
	}
	
	public function getHeader()
	{
		$this->Header = "From: ".$this->From.($this->ReplayTo ? '<'.$this->ReplayTo.'>' : '')."\n";
		$this->Header .= "Subject: ".$this->Subject."\n";
		if($this->Priority)
			$this->Header .= "X-Priority: ".$this->Priority."\n";
		if(is_array($this->Cc))
			$this->Header .= "Cc: ".implode(',', $this->Cc)."\n";
		if(is_array($this->Bcc))
			$this->header .= "Bcc: ".implode(',', $this->Bcc)."\n";
		$this->Header .= "Date: ".date("D, d M Y H:i:s")."\n";
		$this->Header .= "Mime-Version: 1.0\n";
		$this->Header .= "Message-ID: <id_".md5(microtime()).">\n";
		if($this->Body_html)
			$this->Header .= is_array($this->Attachments) ? "Content-Type: multipart/mixed; boundary=\"[BOUNDARY]\"\n" : "Content-Type: multipart/related; type=\"multipart/alternative\"; boundary=\"[BOUNDARY]\"\n";
		else
			$this->Header .= is_array($this->Attachments) ? "Content-Type: multipart/mixed; boundary=\"[BOUNDARY]\"\n" : "Content-Type: text/plain; charset=UTF-8\nContent-Transfer-Encoding: 7bit\n\n";
		$this->Header .= "\n";
	}
	
	public function parseHtml($boundary) {
		$images = array();
		$html_images = "";
		preg_match_all("/src=\"[^\"]*\"/", $this->Body_html, $images);
		foreach($images[0] as $image)
		{
			$path = preg_replace(array("/src=/", "/\"/"), "", $image);
			$iname = explode('/', $path);
			$iname = $iname[count($iname)-1];
			$itype = explode('.', $iname);
			$itype = $itype[count($itype)-1];
			$cid = 'image_'.md5(microtime());
			$path = preg_replace("/http\:\/\//", "", $path);
			$path = explode("/", $path);
			$path[0] = substr($_SERVER['DOCUMENT_ROOT'],0,strlen($_SERVER['DOCUMENT_ROOT']));
			$path = implode("/", $path);
			$fp = fopen($path,'r');
			$data = chunk_split(base64_encode(fread($fp, filesize($path))));
			fclose($fp);
			$this->Body_html = preg_replace("/(".addcslashes($image, "./").")/", "src=\"cid:".$cid."\"", $this->Body_html);
			$html_images .= "--".$boundary."\n".
											"Content-Type: image/".$itype."; name=\"".$iname."\"\n".
											"Content-Transfer-Encoding: base64\n".
											"Content-ID: <".$cid.">\n".
											"Content-Disposition: attachment; filename=".$iname."\n\n".
											$data."\n\n";
		}
		$this->Html_images = $html_images;
		if(!$this->Body_txt)
			$this->Body_txt = strip_tags($this->Body_html);
	}
	
	public function getAttachments($boundary) {
		$attachments = "";
		foreach($this->Attachments as $attachment)
		{
			$attachments .= "--".$boundary."\n".
											"Content-Type: ".$attachment['type']."; name=\"".$attachment['name']."\"\n".
											"Content-Transfer-Encoding: ".$attachment['encoding']."\n".
											"Content-Disposition: attachment; filename=".$attachment['name']."\n\n";
			$fp = fopen($attachment['path'],'r');
			$data = fread($fp, filesize($attachment['path']));
			fclose($fp);
			$attachments .= ($attachment['encoding'] != 'base64' ? $data : chunk_split(base64_encode($data)))."\n\n";
		}
		return $attachments;
	}
	
	public function checkMail($email) {
	  if (!@ereg("^[^@]{1,64}@[^@]{1,255}$", $email))
	    return false;
	
	  $email_array = explode("@", $email);
	  $local_array = explode(".", $email_array[0]);
	  for ($i = 0; $i < sizeof($local_array); $i++)
	    if(!@ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",$local_array[$i]))
	      return false;
	
	  if (!@ereg("^\[?[0-9\.]+\]?$", $email_array[1])) 
		{
	    $domain_array = explode(".", $email_array[1]);
	    if (sizeof($domain_array) < 2)
	        return false;
	
	    for ($i = 0; $i < sizeof($domain_array); $i++)
	      if(!@ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$",$domain_array[$i]))
	        return false;
	  }
	
		if(@getmxrr($email_array[1], $MXHost)) 
		  return true;
		else 
		  return (@fsockopen($email_array[1], 25, $errno, $errstr, 30) ? true : false); 
	}
}
?>