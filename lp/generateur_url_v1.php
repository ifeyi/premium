<?php 
include_once "inc/fonction.inc.php";
include_once "inc/config.inc.php";
?>

<html>
<body style="font-family:arial;">
<h3><b>VIA RETRAITE</b></h3>
<h3><b>Générateur d'URL pour landing V1 (test A/B)</b></h3> 
<br/>

	<table width="100%" style="border:1px solid gray;" cellpadding="3px" >
			<tr style="background-color:black; color:white; font-weight:bold;"> 
				<td width="10%">NUM</td>
				<td width="20%">LIEU</td>
				<td width="70%">URL</td>
			</tr>	
	<?php 
	
    if($_SERVER['SERVER_NAME'] == "192.168.0.4")
        $BASE_URL 	= "http://192.168.0.4/site_trouvermaisonderetraite/viaretraite/recherche-maison-de-retraite-v1";
    //else
        //$BASE_URL 	= "http://www.viaretraite.fr/lp/recherche-maison-de-retraite-v1";
	
	$STR_lieu 	= "SELECT * FROM `landing` ORDER BY ID_LANDING ASC "; 
	$RES_lieu 	= mysql_query($STR_lieu);
	$flag = true;
    $test = array(1=>"a", 2=>"b");
	
	while($RES_lieu && $ROW_lieu = mysql_fetch_array($RES_lieu))
	{
		foreach($test as $key => $value)
        {
            //extract($ROW_lieu);
    		$URL=$BASE_URL.$value."-".format($ROW_lieu['CODE_VILLE'])."-".($ROW_lieu['ID_LANDING']).".html";
            //$URL=$BASE_URL.$value."-".format($ROW_lieu['CODE_VILLE'])."-".($ROW_lieu['ID_LANDING']).".html";
    	?>
    		<tr <?phpif ($flag==true) echo "style='background-color:#B4E1FB;'"; ?>>
    			<td><?php echo $ROW_lieu['ID_LANDING'];?>&nbsp;</td>
    			<td><?php echo $ROW_lieu['CODE_VILLE'];?>&nbsp;</td>
    			<td><?php echo "<a href='".$URL."' target='blank'>".$URL."</a>";?>&nbsp;</td>
    		</tr>
    	<?php 	
    		if($flag==true)
    			$flag=false;
    		else
    			$flag=true;    
        }
	}
	?>
</table>
<br />
</body>
</html>