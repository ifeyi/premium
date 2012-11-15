var ajax = '_ajax/';
function login() {
	var domain;
	user = jQuery('#username').val();
	pass = jQuery('#password').val();
	jQuery('#message').html('Authentification...');
	//alert(user);
	  jQuery.ajax({
		  type: "POST",
		  url: ajax+"login.php",
		  data: "user="+user+"&pass="+pass,
		  cache: false,
		  success: function(html){
			if(html == 'true') {
				jQuery('#message').html('Authentication reussi! Redirection...');
				jQuery('#message').removeClass('error');
				jQuery('#message').addClass('success');
				setTimeout(function() {
					window.location='dashboard.php'
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