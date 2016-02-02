/**
 Home menu sticky.

 @since 0.1.0
 @package CrossFit
 */
(function ($) {
    'use strict';

    $(function () {
        var $primary_nav = $('#primary-nav'),
            $header = $('#site-header'),
            scrolled = false,
            $wpadminbar = $('#wpadminbar'),
            wpadminbar_height = $wpadminbar ? $wpadminbar.outerHeight() : 0;

        $(window).scroll(function () {

            if ($(this).scrollTop() > $(window).height()) {

                if (!scrolled) {

                    scrolled = true;

                    $header.css({
                        marginBottom: $primary_nav.outerHeight()
                    });

                    $primary_nav.css({
                        position: 'fixed',
                        top: -$primary_nav.outerHeight(),
                        left: 0,
                        right: 0
                    }).stop().animate({
                        top: 0 + wpadminbar_height
                    });
                }
            } else {

                // If scroll back to view, force original position
                if ($(this).scrollTop() < $header.outerHeight() + $header.offset().top) {
                    $primary_nav.finish();
                }

                if (scrolled) {

                    scrolled = false;

                    $primary_nav.stop().animate({
                        top: -$primary_nav.outerHeight()
                    }, {
                        complete: function () {

                            $header.css({
                                marginBottom: 0
                            });

                            $(this).css({
                                position: 'static',
                                top: 'auto'
                            });
                        }
                    });
                }
            }
        });
    });
})(jQuery);