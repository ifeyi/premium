$('contlayoutForm').observe('keypress', function(event){
    if(event.keyCode == Event.KEY_RETURN) {
        // do something useful
        alert('Enter key was hit!');
        // stop processing the event
        Event.stop(event);
    }
});

$('contlayoutForm').observe('keypress', function(event){
    if(event.keyCode == Event.KEY_RETURN) {
        // do something useful
       // alert('Enter key was hit!');
		
		Modalbox.show('valider?close', {title: this.title, method: 'post', params: Form.serialize('contlayoutForm') });
		
		return false;
        // stop processing the event
		Event.stop(event);
		      
    }
});