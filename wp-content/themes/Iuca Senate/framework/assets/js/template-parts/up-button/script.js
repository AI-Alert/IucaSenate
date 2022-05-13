$(window).scroll(function(){	
    var scrollTop = $(window).height()*1;	
    if ($(this).scrollTop() > scrollTop) {			
        $(".up").addClass("is-visible");
    } else {			
        $(".up").removeClass("is-visible");
    };
});		

$('.up').click(function() {
    $('body,html').animate({scrollTop: 0}, 1000);
});	