/**
 Main functions file.

 @since 0.1.0
 @package CrossFit
 */
(function ($) {
    'use strict';

    $(document).foundation({
        abide: {
            validate_on_blur: false,
            focus_on_invalid: false
        }
    });

    // Reveal modal on load
    $(function () {

        var $modals = $('[data-reveal-onload]');

        if ($modals.length) {
            $modals.each(function () {
                $(this).foundation('reveal','open');
            });
        }
    });

    // Smooth scroll anchors
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

                var target = $(this.hash),
                    $wpadminbar = $('#wpadminbar'),
                    wpadminbar_height = $wpadminbar ? $wpadminbar.outerHeight() : 0,
                    $homemenu = $('#home-nav'),
                    homemenu_height = $homemenu ? $homemenu.outerHeight() : 0;

                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top - wpadminbar_height - homemenu_height
                    }, 400);
                    return false;
                }
            }
        });
    });
})(jQuery);