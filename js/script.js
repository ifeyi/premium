function changeOnglet(){

    $(".onglet1").click(function(){
        $(".onglet1").addClass("actif");
        $(".onglet2").removeClass("actif");
        $(".onglet3").removeClass("actif");
        $(".onglet4").removeClass("actif");
        $(".onglet5").removeClass("actif");
        $(".onglet6").removeClass("actif");
        $(".tab1").slideDown();
        $(".tab2").slideUp();	    
        $(".tab3").slideUp();	    
        $(".tab4").slideUp();	    
        $(".tab5").slideUp();	    
        $(".tab6").slideUp();	    
	});    
    $(".onglet2").click(function(){
        $(".onglet2").addClass("actif");
        $(".onglet1").removeClass("actif");
        $(".onglet3").removeClass("actif");
        $(".onglet4").removeClass("actif");
        $(".onglet5").removeClass("actif");
        $(".onglet6").removeClass("actif");
        $(".tab2").slideDown();
        $(".tab1").slideUp();	    
        $(".tab3").slideUp();	    
        $(".tab4").slideUp();	    
        $(".tab5").slideUp();	    
        $(".tab6").slideUp();	    
	});    
    $(".onglet3").click(function(){
        $(".onglet3").addClass("actif");
        $(".onglet2").removeClass("actif");
        $(".onglet1").removeClass("actif");
        $(".onglet4").removeClass("actif");
        $(".onglet5").removeClass("actif");
        $(".onglet6").removeClass("actif");
        $(".tab3").slideDown();
        $(".tab2").slideUp();	    
        $(".tab1").slideUp();	    
        $(".tab4").slideUp();	    
        $(".tab5").slideUp();	    
        $(".tab6").slideUp();	    
	});    
    $(".onglet4").click(function(){
        $(".onglet4").addClass("actif");
        $(".onglet2").removeClass("actif");
        $(".onglet3").removeClass("actif");
        $(".onglet1").removeClass("actif");
        $(".onglet5").removeClass("actif");
        $(".onglet6").removeClass("actif");
        $(".tab4").slideDown();
        $(".tab2").slideUp();	    
        $(".tab3").slideUp();	    
        $(".tab1").slideUp();	    
        $(".tab5").slideUp();	    
        $(".tab6").slideUp();	    
	});    
	$(".onglet5").click(function(){
        $(".onglet5").addClass("actif");
       // $(".onglet6").addClass("actif");
        $(".onglet4").removeClass("actif");
        $(".onglet3").removeClass("actif");
        $(".onglet2").removeClass("actif");
        $(".onglet1").removeClass("actif");
        $(".tab5").slideDown();
        $(".tab3").slideUp();	    
        $(".tab2").slideUp();	    
        $(".tab1").slideUp();	    
        //$(".tab6").slideUp();	    
        $(".tab4").slideUp();	    
	}); 
	// $(".onglet6").click(function(){
        // $(".onglet6").addClass("actif");
        // $(".onglet2").removeClass("actif");
        // $(".onglet3").removeClass("actif");
        // $(".onglet1").removeClass("actif");
        // $(".onglet5").removeClass("actif");
        // $(".onglet4").removeClass("actif");
        // $(".tab6").slideDown();
        // $(".tab2").slideUp();	    
        // $(".tab3").slideUp();	    
        // $(".tab1").slideUp();	    
        // $(".tab5").slideUp();	    
        // $(".tab4").slideUp();	    
	// });
	/* $(".onglet7").click(function(){
        $(".onglet4").addClass("actif");
        $(".onglet2").removeClass("actif");
        $(".onglet3").removeClass("actif");
        $(".onglet1").removeClass("actif");
        $(".tab4").slideDown();
        $(".tab2").slideUp();	    
        $(".tab3").slideUp();	    
        $(".tab1").slideUp();	    
	}); */
}

$(document).ready(function(){
    changeOnglet()
});	