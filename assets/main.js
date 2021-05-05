jQuery(function($) {
    $(document).ready(function () {
        // mobile menu
        $('.mobile-menu-trigger').on('click touch', function(){
            $(this).toggleClass('change');
            $('#mobile-navbar').toggle('slide', {direction: 'right'}, 400);
            $('body').toggleClass('noscroll');
        });

        // statistics page
    	// add styles for years select
    	$('.page-statistics .statistics_wrapper ul.nav.nav-pills').on('click touch', 'a', function(){
    		// $(this).nextAll().removeClass( "before" );
    		$(this).removeClass( "before" );
    		$(this).parent('li').nextAll().find('a').removeClass( "before" );
    		$(this).parent('li').prevAll().find('a').addClass( "before" );
    	});
        // hide intro
        // $('.btn-show-statistc-full').click(function() {
        //     $('.page-statistics-intro').fadeOut(300, function() {
        //         $('.page-statistics-wrapper').fadeIn(300);
        //     });
        // });
    });
    $(window).resize(function () {
       
    });
});