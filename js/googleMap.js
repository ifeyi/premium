/* Javascript */	 
var geocoder;
var map;

var infowindow;
var la_position;
var startPoint;
var endPoint;

  
function initialize() 
{	
	var myOptions = {	zoom: 6,
						center: new google.maps.LatLng(46.08558305, 2.213749),
						mapTypeId: google.maps.MapTypeId.ROADMAP
					}
	map = new google.maps.Map(document.getElementById("google_map"), myOptions);
 	geocoder = new google.maps.Geocoder(); 	
}

 
function geocode() 
{
	var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address, 'partialmatch': true} , geocodeResult);    
}

function geocodeEnter() 
{
	if (event.keyCode == 13) 
	{
		geocode();
	} 
}

function geocodeResult(results, status) 
{
	if (status == 'OK' && results.length > 0) 
	{			
		map.fitBounds(results[0].geometry.viewport);
		map.setZoom(15); 	
	   	la_position = results[0].geometry.location;
	   	var marker_contact = new google.maps.Marker({ position: la_position , map: map });
    }
}