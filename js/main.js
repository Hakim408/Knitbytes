(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    // Initiate the wowjs
    new WOW().init();

    // Sticky Navbar (No logo resize)
    $(window).scroll(function () {
        var scrollTop = $(this).scrollTop();

        // Sticky navbar handling
        if (scrollTop > 45) {
            $('.navbar').addClass('sticky-top shadow-sm'); // Add sticky class with shadow
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm'); // Remove sticky class and shadow
        }

        // Back to top button visibility
        if (scrollTop > 100) {
            $('.back-to-top').fadeIn('slow'); // Show the button
        } else {
            $('.back-to-top').fadeOut('slow'); // Hide the button
        }
    });

    // Smooth scroll to top functionality when back-to-top button is clicked
    $('.back-to-top').on('click', function () {
        $('html, body').animate({ scrollTop: 0 }, 'slow'); // Smooth scroll to top
        return false;
    });

    // Ensure mobile menu toggles correctly (open & close on button click)
    $('.navbar-toggler').on('click', function () {
        $('.navbar-collapse').toggleClass('show');
    });

    // Close menu when clicking a menu item (optional for better UX)
    $('.navbar-nav .nav-link').on('click', function () {
        $('.navbar-collapse').removeClass('show');
    });

})(jQuery);
