jQuery(function($){

    // jQuery Match Height init
    $('.services-section .entry-container, .video-post-wrap .hentry, .featured-content-section  .hentry').matchHeight();

// Enable menuToggle.

 ( function() {

        // Assume the initial scroll position is 0.
        var scroll = 0;

        // Wait for a click on one of our menu toggles.
        $('.menu-toggle').on( 'click', function(e) {

            e.preventDefault();

            // Assign this (the button that was clicked) to a variable.
            var button = this;

            // Gets the actual menu (parent of the button that was clicked).
            var menu = $( this ).parents( '.menu-wrapper' );

            // Remove selected classes from other menus.
            $( '.menu-toggle' ).not( button ).removeClass( 'selected' );
            $( '.menu-wrapper' ).not( menu ).removeClass( 'is-open' );

            // Toggle the selected classes for this menu.
            $( button ).toggleClass( 'selected' );
            $( menu ).toggleClass( 'is-open' );

            // Is the menu in an open state?
            var is_open = $( menu ).hasClass( 'is-open' );

            // If the menu is open and there wasn't a menu already open when clicking.
            if ( is_open && ! jQuery( 'body' ).hasClass( 'menu-open' ) ) {

                // Get the scroll position if we don't have one.
                if ( 0 === scroll ) {
                    scroll = $( 'body' ).scrollTop();
                }

                // Add a custom body class.
                $( 'body' ).addClass( 'menu-open' );

            // If we're closing the menu.
            } else if ( ! is_open ) {

                $( 'body' ).removeClass( 'menu-open' );
                $( 'body' ).scrollTop( scroll );
                scroll = 0;
            }

        } );

        // Close menus when somewhere else in the document is clicked.
        $( document ).click( function() {
            $( 'body' ).removeClass( 'menu-open' );
            $( '.menu-toggle' ).removeClass( 'selected' );
            $( '.menu-wrapper' ).removeClass( 'is-open' );
        } );

        // Stop propagation if clicking inside of our main menu.
        $( '.menu-toggle, .dropdown-toggle, .search-field, #site-navigation, #search-container, .site-primary-menu' ).on( 'click', function( e ) {
            e.stopPropagation();
        } );

      } )();

    /*.menu-item-has-children*/
    $('.menu-item-has-children > a, .main-navigation .page_item_has_children > a').after( '<button class="dropdown-toggle" aria-expanded="false"><span class="screen-reader-text">expand child menu</span></button>');

    $('.main-navigation button.dropdown-toggle').click(function() {
        $(this).stop(true, true).toggleClass('active');
        $(this).parent().find('.children, .sub-menu').first().stop(true, true).slideToggle();
        $(this).attr( 'aria-expanded', $(this).attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
    });


    /*Scroll Top*/
    var offset = 250;
    var duration = 300;

    $(window).scroll(function() {
        if ($(this).scrollTop() >= offset) {
            $("#scrollup").fadeIn(duration);
        } else {
            $("#scrollup").fadeOut(duration);
        }
    });

    $('body').on('click','.scrollup', function(e){
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, duration);
        return false;
    })

    // Add header video class after the video is loaded.
    $( document ).on( 'wp-custom-header-video-loaded', function() {
        $('body').addClass( 'has-header-video' );
    });


    /*Fixed Nav on Scroll*/
    var  mainNav = $(".nav-search-wrap");
    scrolledNav = "main-nav-scrolled";
    navOffset = $('.nav-search-wrap').offset().top;

    $(window).scroll(function() {
      if( $(this).scrollTop() > navOffset ) {
        mainNav.addClass(scrolledNav);
      } else {
        mainNav.removeClass(scrolledNav);
      }
    });

    /*How Hours on Mobile while click on hours icon.*/
    $('.hours .fa').on('click', function(){
        $('.mobile-hours').stop(true, true).slideToggle(200);
    });

});
