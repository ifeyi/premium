<?php 
//Private Message
if($_POST['action'] == "sendprivatemsg" AND $_POST['message_user_dest'] != ""){
	$query = "INSERT INTO message (message, message_user_exp, message_user_dest, message_etat,message_date) 
	VALUES('".$_POST['message']."','$userid','".$_POST['message_user_dest']."','0',NOW())";
	mysql_query($query);
	$msg = "<b><p align=\"center\">Message Envoyé</p></b>";
}

//message lu
IF($_GET['act'] == "updtmsg" AND $_GET['idmesg'] != ""){
	$query = "UPDATE message SET message_etat='1' WHERE message_id='".$_GET['idmesg'] ."'";
	mysql_query($query);
}

//Select Messages
record_set('message',"SELECT message_id,message,message_user_exp,message_etat,message_date FROM message WHERE message_etat='0' AND message_user_dest='$userid' ORDER BY message_date ASC");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Suivi Clients - CRM</title>
<link href="simplecustomer.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="texturevault.css">
<link rel="stylesheet" href="style.css">
<title><?php echo $pagetitle; ?></title>
<?php  if($pagetitle != 'Dashboard'){ ?>
<script src="includes/lib/prototype.js" type="text/javascript"></script>
<script src="includes/src/effects.js" type="text/javascript"></script>
<script src="includes/validation.js" type="text/javascript"></script>
<script src="includes/src/scriptaculous.js" type="text/javascript"></script>
<?php  } ?>
<style type="text/css" media="all">
	/* Ce style CSS ne dois pas être enlevé, sinon les divs ne se cacherons pas ... */
	.cachediv {
		visibility: hidden;
		overflow: hidden;
		height: 1px;
		margin-top: -1px;
		position: absolute;
	}
</style>

<!-- Script créé par KevBrok ;-) -->
<script type="text/javascript">
	/*
	* Montre / Cache un div
	*/
	function DivStatus( nom, numero )
		{
			var divID = nom + numero;
			if ( document.getElementById && document.getElementById( divID ) ) // Pour les navigateurs récents
				{
					Pdiv = document.getElementById( divID );
					PcH = true;
		 		}
			else if ( document.all && document.all[ divID ] ) // Pour les veilles versions
				{
					Pdiv = document.all[ divID ];
					PcH = true;
				}
			else if ( document.layers && document.layers[ divID ] ) // Pour les très veilles versions
				{
					Pdiv = document.layers[ divID ];
					PcH = true;
				}
			else
				{
					
					PcH = false;
				}
			if ( PcH )
				{
					Pdiv.className = ( Pdiv.className == 'cachediv' ) ? '' : 'cachediv';
				}
		}
		
	/*
	* Cache tous les divs ayant le même préfixe
	*/
	function CacheTout( nom )
		{	
			var NumDiv = 0;
			
			while ( document.getElementById( nom + NumDiv) ){
				SetDiv = document.getElementById( nom + NumDiv );
				if ( SetDiv && SetDiv.className != 'cachediv' )
				{
					DivStatus( nom, NumDiv );
				}
				NumDiv++;
			}
		}
		
		
	function test_heureminute(champ)
	{
			if (champ.value.length == 2 )
			{
			champ.value=champ.value+':'
			}
	}
</script>

<link rel="stylesheet" media="screen" type="text/css" href="includes/calendrier.css" />
<script type="text/javascript" src="includes/calendrier.js"></script>

	<script type='text/javascript' src='includes/jquery/jquery-1.4.4.min.js'></script>
<script type='text/javascript' src='includes/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="includes/jquery.autocomplete.css" />

<script type="text/javascript">
$().ready(function() {
	$("#s").autocomplete("rpc.php", {
		width: 260,
		matchContains: true,
		//mustMatch: true,
		minChars: 2,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
});
</script>

<?php  if($pagetitle == 'Dashboard'){ ?>
	<link rel='stylesheet' type='text/css' href='includes/redmond/theme.css' />
	<link rel='stylesheet' type='text/css' href='includes/fullcalendar/fullcalendar.css' />

	<script type='text/javascript' src='includes/jquery/jquery-ui-1.8.6.custom.min.js'></script>
	<script type='text/javascript' src='includes/fullcalendar/fullcalendar.min.js'></script>
	<script type='text/javascript'>
	
		$(document).ready(function() {
		
			var date = new Date();
			var d = date.getDate();
			var m = date.getMonth();
			var y = date.getFullYear();
			
			$('#calendar').fullCalendar({
				buttonText: {
			        prev:     '&nbsp;&#9668;&nbsp;',  // left triangle
				    next:     '&nbsp;&#9658;&nbsp;',  // right triangle
				    prevYear: '&nbsp;&lt;&lt;&nbsp;', // <<
				    nextYear: '&nbsp;&gt;&gt;&nbsp;', // >>
				    today:    'Aujourd\'hui',
				    month:    'Mois',
				    week:     'Semaine',
				    day:      'Jour'
	
			    },
	
				theme: true,
				firstHour : 8,
				minTime : 8,
				maxTime : 22,
				monthNames : ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
				monthNamesShort : ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
				dayNames : ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
				dayNamesShort : ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
				defaultView : 'basicDay',
				titleFormat: {
				    month: 'MMMM yyyy',                             // September 2009
				    week: "d[ yyyy]{ '&#8212;'[ MMM] d MMM yyyy}", // Sep 7 - 13 2009
				    day: 'dddd d MMM yyyy'                  // Tuesday, Sep 8, 2009
				},
				columnFormat: {
				    month: 'ddd',    // Mon
				    week: 'ddd d/MM', // Mon 9/7
				    day: 'dddd d/MM'  // Monday 9/7
				},
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'basicDay,basicWeek,month'
				},
				editable: true,
				events: "json_events.php",
	
				
				events: [
				
				<?php 
					record_set('appels',"SELECT appels.appel_id,appels.appel_contact,appels.appel_date,appels.appel_etat,appels.appel_sujet,appels.appel_important,appels.appel_commercial,appels.appel_action_par,contacts.contact_first,contacts.contact_last,contacts.contact_title,contacts.contact_type FROM contacts,appels WHERE contacts.contact_id=appels.appel_contact AND appels.appel_etat=0 AND appels.appel_commercial='$userid' AND appels.appel_date BETWEEN ('".date('Y-m-d')."' - INTERVAL 2 MONTH) AND ('".date('Y-m-d')."' + INTERVAL 2 MONTH)");
				
					if ($totalRows_appels > 0) {
						$j = 0;
						do { 
							
							if($row_appels['appel_important'] != 0){$important .= ' <img src = \'images/important.png\' border=\'0\' align=\'absmiddle\'/>';}
							
							$img = 'imageAfterTitle: $("'.$important.'"),';
							if($row_appels['appel_sujet'] != ""){$sujet = "(".addslashes($row_appels['appel_sujet']).")";}
							
							if($row_appels['appel_commercial'] != $row_appels['appel_action_par']){$classname = "className: 'autre',";}
							if($row_appels['appel_date'] < date('Y-m-d 00:00:00')){$classname = "className: 'retard',";$row_appels['appel_date']=date('Y-m-d 00:00:00');}
							
							echo "{
								title: ' : Appel ".$row_appels['contact_title']." ".addslashes(strtoupper($row_appels['contact_last']))." ".addslashes(ucfirst($row_appels['contact_first']))." $sujet ',
								$img
								$classname
								start: '".$row_appels['appel_date']."',
								url: 'contact-details.php?id=".$row_appels['appel_contact']."&appel=".$row_appels['appel_id']."&updateap=1',
								allDay: false
							},";
							
							$j++;$sujet="";	$important=""; $img=""; $classname="";
						} while ($row_appels = mysql_fetch_assoc($appels));	
					}
				?>
				
				{
					start: '1970-01-01'
				}
				],
				
				timeFormat: 'HH:mm', // uppercase H for 24-hour clock
				eventRender: function (event, eventElement)
		        {
		            if (event.imageAfterTime)
		                eventElement.find('span.fc-event-time').after($(event.imageAfterTime));
		
		            if (event.imageAfterTitle)
		                eventElement.find('span.fc-event-title').after($(event.imageAfterTitle));
		        }
	
			});
			
		});
	
	</script>
	<style type='text/css'>
		#calendar {
			width: 700px;
			margin: 0 auto;
			}
	
	</style>
<?php  } ?>
</head>
<body>
		

<div id="masterconbin">
	<div id="topmenu">
		<div class="searchbin">
			<form enctype="multipart/form-data" action="search.php" method="GET" name="form3" id="form3"  autocomplete="off">
      			<input type="text" value="" id="s" name="s" class="search_box" />
        		<input type="submit" value="Rechercher" name="Submit_search" class="go_button" >
  			</form>					
		</div>
		<ul>
			<li class="user">Identifié sous <b><?php echo $row_userinfo['user_nom']; ?> <?php  echo $row_userinfo['user_prenom']; ?></b> (<?php echo $row_userinfo['user_email']; ?>) | <a href="logout.php">Deconnexion</a> | <a href="profile.php">Mettre à jour mon profil</a></li>         
		</ul>
	</div>
	<div id="headerbin">
		<div id="logo"></div>    <div id="navbin">
		  <ul class="topnav">
   			<li <?php  if ($pagetitle == 'Dashboard') { echo "class=\"selected\""; } ?> ><a href="index.php">Mon Agenda</a></li>
   			<li <?php  if ($pagetitle== 'Formulaires') { echo 'class="selected"'; } ?>><a href="formulaires.php">Prospects (<?php echo $totalform?>)</a></li>
   			<li <?php  if ($pagetitle== 'Prospects / Clients' || $pagetitle == 'ContactDetails') { echo 'class="selected"'; } ?>><a href="contacts.php">Clients</a></li>
   			<li <?php  if ($pagetitle== 'Fournisseurs' || $pagetitle == 'FournisseursDetails') { echo 'class="selected"'; } ?>><a href="fournisseurs.php">Fournisseurs</a></li>
       		<li <?php  if ($pagetitle == 'Documents') { echo 'class="selected"'; } ?>><a href="documents.php">Documentation / Emails Type</a></li>
			<li <?php  if ($pagetitle == 'Users') { echo 'class="selected"'; } ?>><a href="users.php">Utilisateurs</a></li>
   		  </ul>
		</div>
	</div>
    <div id="conbinshadow">
		<div id="conbin">    

    	<div id="mainbin">