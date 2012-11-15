<?php 
if(isset($_POST['submit_x']))
{
    require_once "config.inc.php";
    require_once "fonction.inc.php";
    
    //initialisation $url
    $url = '';
    
    // region
    $Rregion='	SELECT 	region_nom
				FROM	region
				WHERE	UPPER(region_nom) LIKE UPPER("'.stripcslashes($_POST['recherche']).'")';
	$Qregion=mysql_query($Rregion);
	if(mysql_num_rows($Qregion)!=0)
	{
		$region=mysql_fetch_array($Qregion);
		$url=DOSSIERANN.PREFIX.format(strtolower(stripcslashes($region['region_nom'])))."-r.html";
	}
	else // dpt
	{
		$Rdpt="	SELECT 	departement_id,
						nom_dep_min
				FROM	departement
				WHERE	(nom_dep_maj    LIKE UPPER('".format(stripcslashes($_POST['recherche']))."')
                         OR  
                         departement_id = '".$_POST['recherche']."' )";
		$Qdpt=mysql_query($Rdpt);
	
		if(mysql_num_rows($Qdpt)!=0)
		{
			$dpt=mysql_fetch_array($Qdpt);
			$url=DOSSIERANN.PREFIX.format(strtolower(stripcslashes($dpt['nom_dep_min'])))."-d.html";
		}
		else // ville
		{
			$Rville = "	SELECT 	mdr_ville
						FROM	mdr
						WHERE	UPPER(mdr_ville) LIKE UPPER('".ucfirst(stripcslashes($_POST['recherche']))."')
						LIMIT 1";
			$Qville =	mysql_query($Rville); 
			
			if(mysql_num_rows($Qville)!=0)
			{
				$ville=mysql_fetch_array($Qville);
				$url=DOSSIERANN.PREFIX.format(strtolower(stripcslashes($ville['mdr_ville'])))."-v.html";
			}
			
            else // cp
			{	
			    $Rcp = "	SELECT 	mdr_cp,
                                        mdr_ville
        						FROM	mdr
        						WHERE	mdr_cp = '".$_POST['recherche']."'
        						LIMIT 1";
    			$Qcp =	mysql_query($Rcp);
                                
                if(mysql_num_rows($Qcp)!=0)
    			{
    				$ville=mysql_result($Qcp,0,'mdr_ville');
                    $url=DOSSIERANN.PREFIX.format(strtolower(stripcslashes($ville)))."-v.html";
    			}
                else
                {
                    header('Location: / ');
                }
			}
		}
	}
    
    if($url!="")
		header('Location: '.PATH_ROOT.$url);
        
}
?>