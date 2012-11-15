var ajax = '_ajax/';
function login() {
	var domain;
	user = jQuery('#email').val();
	pass = jQuery('#pass').val();
	jQuery('#message').html('Authentification...');
	//alert(user);
	  jQuery.ajax({
		  type: "POST",
		  url: ajax+"login.php",
		  data: "email="+user+"&pass="+pass,
		  cache: false,
		  success: function(html){
			if(html == 'true') {
				jQuery('#message').html('Authentication reussi! Redirection vers votre page...');
				jQuery('#message').removeClass('error');
				jQuery('#message').addClass('success');
				setTimeout(function() {
					window.location='edit-autocar.php'
				}, 2000);
			} else {
				jQuery('#message').html('Echec authentification!!!');
				jQuery('#message').removeClass('success');
				jQuery('#message').addClass('error');
				return false;
			}
		  }
		});
	return false;
}