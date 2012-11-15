<?php 
// stockage des POST
$nom_emploi = $_POST['nom_emploi'];
$email_emploi = $_POST['email_emploi'];

// sauvegarde du CV sur server + envoi mail avec CV en piece joitne
if (!empty($_FILES['cv']['tmp_name']))
{
    $candidat    = format($nom_emploi);
    list($cv_name,$extension) = explode(".",$_FILES['cv']['name']);
    $source      = $_FILES['cv']['tmp_name'];
    $destination = "cv/{$candidat}.{$extension}";
    
    // si le fichier a deja ete uploade auparavant, on sauvegarde une copie "_old"
    if (file_exists($destination))
    {
    	copy($destination,"cv/{$candidat}_old.{$extension}");
    	unlink($destination);
    }
        
    copy($source,$destination);
        
    // envoi 
    $cv=$_FILES['cv']['name'];
    
    $sujet="Demande d'emploi sur \"Via Retraite\" ";
	$courrier = "Une demande d'emploi a été postée sur le site \"Via Retraite\" :\n";
	$courrier .= "\nLes coordonnées du demandeur sont:\n\nNom : $nom_contact\n\n Email: $email\n\n";
    $courrier .= "NB : Le CV du demandeur a été enregistré sur le serveur dans le dossier CV\n";
			
	$fichier = $_SERVER['DOCUMENT_ROOT'].'/'.$destination;
    sendMail ($sujet, $courrier, $fichier); // sendMail est defini dans fonction.inc.php   
}       
?>