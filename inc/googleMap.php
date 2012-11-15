<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo PATH_ROOT?>js/googleMap.js"></script>

<div id="google_map_input" style="visible: hidden; display: none;">
	<input 	type="text" id="address" style="width: 350px;" 
			value = "<?php echo transform($Rmdr['mdr_adresse'])?> <?php  echo transform($Rmdr['mdr_cp'])?> <?php  echo transform($Rmdr['mdr_ville'])?>" 
			onkeydown ="javascript:geocodeEnter()"/>
    <input  type="button" onclick="javascript:geocode()" value="me situer" />
</div>


<div id="google_map"></div>	

<script type="text/javascript">initialize();geocode();</script>
  
