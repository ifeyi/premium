<?php 

/*
 * SimpleModal Contact Form
 * http://www.ericmmartin.com/projects/simplemodal/
 * http://code.google.com/p/simplemodal/
 *
 * Copyright (c) 2009 Eric Martin - http://ericmmartin.com
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Revision: $Id: contact-dist.php 254 2010-07-23 05:14:44Z emartin24 $
 *
 */

// User settings
$to = "mika26@gmail.com";
//$ccm="yadjedj@gmail.com";
$subject = "Devis Immédiat de Autocar";

// Include extra form fields and/or submitter data?
// false = do not include
$extra = array(
	"form_subject"	=> true,
	"form_cc"		=> true,
	"ip"			=> true,
	"user_agent"	=> true
);

// Process
$action = isset($_POST["action"]) ? $_POST["action"] : "";
if (empty($action)) {
	// Send back the contact form HTML
	$output = "
	
	<div style='display:none'>
	<div class='contact-top'></div>
	<div class='contact-content'>
		<h1 class='contact-title'>Devis Imm&eacute;diat</h1>
		
		<div class='contact-loading' style='display:none'></div>
		<div class='contact-message' style='display:none'></div>
		<form action='#' style='display:none'>
			<label for='contact-name'>Votre Nom:</label>
			<input type='text' id='contact-name' class='contact-input' name='nom' tabindex='1001' />
			<label for='contact-email'>Votre Email :</label>
			<input type='text' id='contact-email' class='contact-input' name='email' tabindex='1002' />
			<label for='contact-email'>Votre T&eacute;l&eacute;phone :</label>
			<input type='text' id='contact-tel' class='contact-input' name='telephone' tabindex='1003' />
			<label for='contact-email'>Ville de d&eacute;part :</label>
			<input type='text' id='contact-villedepart' class='contact-input' name='villedepart' tabindex='1004' />
			<label for='contact-email'>Ville d'arriv&eacute;e :</label>
			<input type='text' id='contact-villearrivee' class='contact-input' name='villearrivee' tabindex='1005' />
			<label for='contact-email'>Date de d&eacute;part :</label>
			<input type='text' id='contact-datedepart' class='contact-input' style='width:150px' name='datedepart' tabindex='1005' />
			<label for='contact-email'>Date de retour :</label>
			<input type='text' id='contact-dateretour' class='contact-input' style='width:150px' name='dateretour' tabindex='1005'   />
			<label for='contact-email'>Nombre de passagers :</label>
			<input type='text' id='contact-nombre' class='contact-input' style='width:50px' name='nombre' tabindex='1006' />
			<label for='contact-email'>Message :</label>
			<textarea name='message'></textarea>
			";
			


	$output .= "
			<label>&nbsp;</label>
			<button type='submit' class='contact-send contact-button' tabindex='1006'>Envoyer ma demande</button>
			<br/>
			<input type='hidden' name='token' value='" . smcf_token($to) . "'/>
		</form>
	</div>
	<div class='contact-bottom'></div>
</div>

";

	echo $output;
}
else if ($action == "send") {
	// Send the email
	$name = isset($_POST["nom"]) ? $_POST["nom"] : "";
	$email = isset($_POST["email"]) ? $_POST["email"] : "";
	$token = isset($_POST["token"]) ? $_POST["token"] : "";

	$message = 'Nom : '.$_POST['nom']."\r\n";                                               
	$message .= 'Telephone : '.$_POST['telephone']."\r\n";                                  
	$message .= 'Email : '.$_POST['email']."\r\n";                                                                                    
	$message .= 'Itineraire recherche : '.$_POST['villedepart'].' vers '.$_POST['villearrivee']."\r\n";
	$message .= 'Nombre Passager : '.$_POST['nombre']."\r\n"; 
	$message .= 'Date de depart : '.$_POST['datedepart']."\r\n"; 
	$message .= 'Date d\'arrivee : '.$_POST['dateretour']."\r\n"; 
	$message .= 'Message : '.$_POST['message']."\r\n"; 
	
	
 
	// make sure the token matches
	if ($token === smcf_token($to)) {
		smcf_send($name, $email, $subject, $message, $ccm);
		echo 'Votre message a bien &eacute;t&eacute; envoy&eacute;<!-- Google Code for Lead Conversion Page -->
				<script type="text/javascript">
				/* <![CDATA[ */
				var google_conversion_id = 985815772;
				var google_conversion_language = "en";
				var google_conversion_format = "2";
				var google_conversion_color = "ffffff";
				var google_conversion_label = "JZmvCJyAoQQQ3LWJ1gM";
				var google_conversion_value = 0;
				/* ]]> */
				</script>
				<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
				</script>';
		
		$db = mysql_connect("localhost", "root", "bCcWom9A", true) or die("MySQL error: ".mysql_error());
		 mysql_select_db("crmapc", $db) or die("MySQL error: ".mysql_error());
		 
		 //--- Verification des doublons
			$_POST['tel'] = str_replace(" ","",$_POST['tel']);
			$_POST['tel'] = str_replace(".","",$_POST['tel']);
			$_POST['tel'] = str_replace("/","",$_POST['tel']);
			$_POST['tel'] = str_replace("-","",$_POST['tel']);
			
			$sql="SELECT contact_id FROM contacts WHERE ((contact_phone='".$_POST['telephone']."' AND contact_last like '%".$_POST['nom']."%') OR (contact_email='".$_POST['email']."' AND contact_last like '%".$_POST['nom']."%') OR (contact_email='".$_POST['email']."' AND contact_phone='".$_POST['telephone']."'))";
			$result = mysql_query($sql);
			$nrows  = mysql_num_rows($result);
			
			IF($nrows == 0){	
				$query = "INSERT INTO contacts(contact_last,contact_phone,contact_email,contact_date_creation) VALUES('".$_POST['nom']."','".$_POST['telephone']."','".$_POST['email']."',NOW())";				
				mysql_query($query);
					
				$id = mysql_insert_id();
				
				
				$monUrl = str_replace("\r\n","<br/>",$message);
				
				$query = "INSERT INTO notes(note_contact,note_text,note_date,note_status,note_user) VALUES('$id','".addslashes($monUrl)."',".time().",'1','4')";
				//echo $query;
				mysql_query($query);
			}
			else{
				
				$contact_id = mysql_result($result,0,"contact_id");
				$monUrl = str_replace("\r\n","<br/>",$message);
				
				$query = "INSERT INTO notes(note_contact,note_text,note_date,note_status,note_user) VALUES('$contact_id','".addslashes($monUrl)."',".time().",'1','4')";
				//echo $query;
				mysql_query($query);
			}
		 
		 mysql_close($db);

	}
	else {
		echo "Nous somme d&eacute;sol&eacute; mais votre message n'a pu etre envoy&eacute;";
	}
}

function smcf_token($s) {
	return md5("smcf-" . $s . date("WY"));
}

// Validate and send email
function smcf_send($name, $email, $subject, $message, $cc) {
	global $to, $extra;

	// Filter and validate fields
	$nom = smcf_filter($name);
	$subject = smcf_filter($subject);
	$email = smcf_filter($email);
	if (!smcf_validate_email($email)) {
		$subject .= " - Email Invalide";
		$message .= "\n\nMauvais Email: $email";
		$email = $to;
		$cc = 0; // do not CC "sender"
	}

	// Add additional info to the message
	if ($extra["ip"]) {
		$message .= "\n\nIP: " . $_SERVER["REMOTE_ADDR"];
	}
	if ($extra["user_agent"]) {
		$message .= "\n\nUSER AGENT: " . $_SERVER["HTTP_USER_AGENT"];
	}

	// Set and wordwrap message body
	$body = "From: $name\n\n";
	$body .= "Message: $message";
	$body = wordwrap($body, 70);

	// Build header
	$headers = "From: $email\n";
	$headers .= "Cc: $cc\n";
	$headers .= "X-Mailer: PHP/SimpleModalContactForm";

	// UTF-8
	if (function_exists('mb_encode_mimeheader')) {
		$subject = mb_encode_mimeheader($subject, "UTF-8", "B", "\n");
	}
	else {
		// you need to enable mb_encode_mimeheader or risk 
		// getting emails that are not UTF-8 encoded
	}
	$headers .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/plain; charset=utf-8\n";
	$headers .= "Content-Transfer-Encoding: quoted-printable\n";

	// Send email
	@mail($to, $subject, $body, $headers) or 
		die("Unfortunately, a server issue prevented delivery of your message.");
}

// Remove any un-safe values to prevent email injection
function smcf_filter($value) {
	$pattern = array("/\n/","/\r/","/content-type:/i","/to:/i", "/from:/i", "/cc:/i");
	$value = preg_replace($pattern, "", $value);
	return $value;
}

// Validate email address format in case client-side validation "fails"
function smcf_validate_email($email) {
	$at = strrpos($email, "@");

	// Make sure the at (@) sybmol exists and  
	// it is not the first or last character
	if ($at && ($at < 1 || ($at + 1) == strlen($email)))
		return false;

	// Make sure there aren't multiple periods together
	if (preg_match("/(\.{2,})/", $email))
		return false;

	// Break up the local and domain portions
	$local = substr($email, 0, $at);
	$domain = substr($email, $at + 1);


	// Check lengths
	$locLen = strlen($local);
	$domLen = strlen($domain);
	if ($locLen < 1 || $locLen > 64 || $domLen < 4 || $domLen > 255)
		return false;

	// Make sure local and domain don't start with or end with a period
	if (preg_match("/(^\.|\.$)/", $local) || preg_match("/(^\.|\.$)/", $domain))
		return false;

	// Check for quoted-string addresses
	// Since almost anything is allowed in a quoted-string address,
	// we're just going to let them go through
	if (!preg_match('/^"(.+)"$/', $local)) {
		// It's a dot-string address...check for valid characters
		if (!preg_match('/^[-a-zA-Z0-9!#$%*\/?|^{}`~&\'+=_\.]*$/', $local))
			return false;
	}

	// Make sure domain contains only valid characters and at least one period
	if (!preg_match("/^[-a-zA-Z0-9\.]*$/", $domain) || !strpos($domain, "."))
		return false;	

	return true;
}

exit;

?>
