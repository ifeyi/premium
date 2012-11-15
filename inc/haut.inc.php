<?php 

@session_start();

if(@$_POST['action'] == "send"){
	if(($_POST['nom'] == "") OR ($_POST['telephone'] == "") OR ($_POST['email'] == "")){		
		$ER = "Merci de bien vouloir remplir tous les champs";
	}
	else{
		 $to      = 'yadjedj@gmail.com';
		 $cc      = 'mika26@gmail.com';
	     $subject = 'Formulaire Autocar';
	     $message = 'Nom : '.$_POST['nom']."\r\n";
	     $message .= 'Téléphone : '.$_POST['telephone']."\r\n";
	     $message .= 'Email : '.$_POST['email']."\r\n";
	     
	     $message .= 'Itinéraire recherché : '.$_SESSION['depart'].' vers '.$_SESSION['arrive']."\r\n";
	     
	     $message .= 'Envoyé à partir de : http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."\r\n";
	     
	     $headers = 'From: noreply@autocar' . "\r\n" .
	     'Reply-To: noreply@autocar' . "\r\n" .
	     'X-Mailer: PHP/' . phpversion();
	
	     mail($to, $subject, $message, $headers);
	     mail($cc, $subject, $message, $headers);
	     
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
				
				$monUrl = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
				
				$query = "INSERT INTO notes(note_contact,note_text,note_date,note_status,note_user) VALUES('$id','".$monUrl."',".time().",'1','4')";
				mysql_query($query);
			}
			else{
				$contact_id = mysql_result($result,0,"contact_id");
				$query = "INSERT INTO notes(note_contact,note_text,note_date,note_status,note_user) VALUES('$contact_id','".$monUrl."',".time().",'1','4')";
				mysql_query($query);
			}
		 
		 mysql_close($db);
	     
	     $ER = "Votre demande à bien été prise en compte.<br/>Elle sera traitée dans les plus brefs délais";
	     $ER .='<!-- Google Code for Lead Conversion Page -->
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
				</script>
				<noscript>
				<div style="display:inline;">
				<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/985815772/?value=0&amp;label=JZmvCJyAoQQQ3LWJ1gM&amp;guid=ON&amp;script=0"/>
				</div>
				</noscript>';
	     
	     include("inc/config.inc.php");
	}
}                                                                    
?>
<!DOCTYPE html>

<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<!-- METAS -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<?php 
if($page=='annuaire_resultats'){ ?>
    <title><?php echo NOM_2?> <?php  echo $prefix." ".$lieu?> : Location <?php  echo NOM_2?> <?php  echo $prefix." ".$lieu?>, liste <?php  echo NOM_1?> <?php  echo $prefix." ".$lieu?> - Autocar pas cher</title>
    <meta name="description" content="<?php echo NOM_2?> <?php  echo $prefix." ".$lieu?>, listes <?php  echo NOM_1?> <?php  echo $prefix." ".$lieu?> : avec Autocar pas cher un devis pour location de bus avec Chauffeur"/>
<?php }
elseif($page=='annuaire_detail'){
    $mdr_nom = $Rmdr['mdr_nom'];
    $mdr_ville = ucfirst(strtolower($Rmdr['mdr_ville']));?>
    <title><?php echo $mdr_nom?> à <?php  echo $mdr_ville?> : Location <?php  echo NOM_2?> <?php  echo $prefix." ".$lieu?>, liste <?php  echo NOM_1?> <?php  echo $prefix." ".$lieu?> - Autocar pas cher</title>
    <meta name="description" content="<?php echo $mdr_nom?> - <?php  echo NOM_2?> <?php  echo $prefix." ".$lieu?>, listes <?php  echo NOM_1?> <?php  echo $prefix." ".$lieu?> : avec Autocar pas cher un devis pour location de bus avec Chauffeur"/>
<?php }
else{ ?>
    <title>Location Bus & Location d'autocars avec Autocars pas cher.</title>
    <meta name="description" content="Autocar pas cher est une centrale nationale de location d'autocar et de location d'autobus avec chauffeur. "/>
<?php } ?>
<!-- css -->
<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>css/font-awesome.css">
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>css/normalize.css">
<link rel="stylesheet" href="<?php echo PATH_ROOT ?>css/main.css">

<link rel="stylesheet" type="text/css" title="style" href="<?php echo PATH_ROOT ?>css/style.css" />
<link rel="stylesheet" type="text/css" title="style" href="<?php echo PATH_ROOT ?>css/jquery.selectbox.css" />
<link rel="stylesheet" type="text/css" title="style" href="<?php echo PATH_ROOT ?>autocomplete_wick/wick.css" />
<link rel="stylesheet" media="screen" type="text/css" title="Design" href="<?php echo PATH_ROOT ?>css/design.css" />
<!-- js -->
<!--[if IE 7]><link rel="stylesheet" href="css/ie.css"><![endif]-->
<script type="text/javascript" src="<?php echo PATH_ROOT ?>js/vendor/modernizr-2.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo PATH_ROOT ?>js/javascript.js"></script>
<script type="text/javascript" src="<?php echo PATH_ROOT ?>js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="<?php echo PATH_ROOT ?>js/jquery.selectbox-0.6.3.js"></script>
<script type="text/javascript" src="<?php echo PATH_ROOT ?>autocomplete_wick/wick_data.js"></script>
<script type="text/javascript" src="<?php echo PATH_ROOT ?>autocomplete_wick/wick.js"></script>

<?php if($page=='annuaire_resultats'){?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
    function initialize() {
        var myOptions = {
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

        setMarkers(map, beaches);
    }

    /**
    * Data for the markers consisting of a name, a LatLng and a zIndex for
    * the order in which these markers should display on top of each
    * other.
    */
    var beaches = [

    	<?php 
    		/*
    		define("MAPS_HOST", "maps.google.com");
			define("KEY", "ABQIAAAAqb--c6DcwHvWtwnM8ER-uRRWHiKyG5ccqHmm_OxbMrDKTeSklBRyhlrleZ5xa8yioaomk-FcaiA6sg");
			$base_url = "http://" . MAPS_HOST . "/maps/geo?output=xml" . "&key=" . KEY;
			
			$i=0;
			$Rmdr=mysql_query($Qmdr);
            while($Rmdr && $mdr=mysql_fetch_array($Rmdr)){
            	$geocode_pending = true;
				
				while ($geocode_pending) {
					$address = $mdr['mdr_adresse'].", ".$mdr['mdr_cp']." ".$mdr['mdr_ville']." FR";
					$request_url = $base_url . "&q=" . urlencode($address);
					$xml = simplexml_load_file($request_url) or die("url not loading");
					$status = $xml->Response->Status->code;
					if (strcmp($status, "200") == 0) {
						// Successful geocode
						$geocode_pending = false;
						$coordinates = $xml->Response->Placemark->Point->coordinates;
						$coordinatesSplit = split(",", $coordinates);
						// Format: Longitude, Latitude, Altitude
						$lat = $coordinatesSplit[1];
						$lng = $coordinatesSplit[0];
						
						if($i != 0){echo ",";}
						
						echo "['".str_replace("'","\'",$mdr['mdr_nom'])."', $lat, $lng, $i, '".PATH_ROOT.DOSSIERANN.PREFIX.format($mdr['mdr_ville'])."/".format($mdr['mdr_nom'])."-".$mdr['mdr_id'].".html','link$i']";
					}
				}
				
            	$i++;
            }
            */
    	?>
    ];

    var markers = [];

    function setMarkers(map, locations) {
        // Add markers to the map

        // Marker sizes are expressed as a Size of X,Y
        // where the origin of the image (0,0) is located
        // in the top left of the image.

        // Origins, anchor positions and coordinates of the marker
        // increase in the X direction to the right and in
        // the Y direction down.
        var image = new google.maps.MarkerImage("<?php echo PATH_ROOT ?>images/home_act.png");
		var bounds = new google.maps.LatLngBounds();


        for (var i = 0; i < locations.length; i++) {
            var beach = locations[i];
            var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
            bounds.extend(myLatLng);
			map.fitBounds(bounds);
			
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                // shadow: shadow,
                icon: image,
                //shape: shape,
                zindex:beach[3],
				title: beach[0],
                url: beach[4],
                divb:beach[5]
            });
            
			
			google.maps.event.addListener(marker, 'click', function() {
		      window.location.href = this.url;
		    });
		    
		    google.maps.event.addListener(marker, 'mouseover', function() {
		    	document.getElementById(this.divb).className='ann_resultats_boxho';
		    });
		    
		    google.maps.event.addListener(marker, 'mouseout', function() {
		      document.getElementById(this.divb).className='ann_resultats_box';
		    });
			
			markers[i] = marker;
        }
        
        map.fitBounds(bounds);
        
        
    }

    function setMarkerImage(marker) {
        // http://code.google.com/apis/maps/documentation/javascript/reference.h...
        // "To scale the image, whether sprited or not, set the value of scaledSize to the size of the whole image and set size,
        // origin and anchor in scaled values. The MarkerImage cannot be changed once constructed."
        //
        var newImage = new google.maps.MarkerImage(
        // url:
            "<?php echo PATH_ROOT?>images/home_pas.png"
		);

        for (var i = 0; i < markers.length; i++) {
			if (marker != i) {
				markers[i].setIcon(null);
				markers[i].setIcon(newImage);
			}
        }

    }
	
	function delMarkerImage(marker) {
        // http://code.google.com/apis/maps/documentation/javascript/reference.h...
        // "To scale the image, whether sprited or not, set the value of scaledSize to the size of the whole image and set size,
        // origin and anchor in scaled values. The MarkerImage cannot be changed once constructed."
        //
        var newImage = new google.maps.MarkerImage(
        // url:
            "<?php echo PATH_ROOT?>images/home_act.png"
        );

        for (var i = 0; i < markers.length; i++) {
			if (marker != i) {
				markers[i].setIcon(null);
				markers[i].setIcon(newImage);
			}
        }

    }
</script>

<?php  } ?>
</head>

<?php if($page!='home'){ ?>
<body <?php if($page=='annuaire_resultats'){ ?>onload="initialize()"<?php } ?>>
<a name="haut_de_page"></a>
<!--
<div id="base-top">
    <div id="header_area">
        <img src="<?php echo PATH_ROOT?>images/header_photo.png" />
        <div class="overlay"></div>
    </div>
	<div id="header" align="right">
        <div id="logo">
	    <a href="<?php echo PATH_ROOT?>"><img src="<?php echo PATH_ROOT?>images/logo.png" border="0"/></a>
	    </div> 
	</div>
</div>
-->
<div id="header-container">
	<div id="header" class="wrapper clearfix">
		<div class="hgroup">
			<a style="text-decoration:none;" href="<?php echo PATH_ROOT?>"><h1>Trouver<span>AUTOCAR</span></h1></a>
			<h5>un</h5>
		</div>
		<div class="headerRight">
			<button onclick="window.location='<?php echo PATH_ROOT ?>login.php'" class="acces">Acc&egrave;s autocaristes</button>
			<div class="social">
				<a href="#" class="linkedin"><i class="icon-linkedin-sign icon-large"></i></a>
				<a href="#" class="facebook"><i class="icon-facebook-sign icon-large"></i></a>
				<a href="#" class="twitter"><i class="icon-twitter-sign icon-large"></i></a>
			</div>
		</div>
	</div>
</div>
<?php } ?>