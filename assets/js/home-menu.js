/**
 Home menu sticky.

 @since 0.1.0
 @package CrossFit
 */
(function ($) {
    'use strict';

    $(function () {
        var $homemenu = $('#home-nav'),
            $header = $('#site-header'),
            scrolled = false,
            $wpadminbar = $('#wpadminbar'),
            wpadminbar_height = $wpadminbar ? $wpadminbar.outerHeight() : 0;

        $(window).scroll(function () {

            if ($(this).scrollTop() > $(window).height()) {

                if (!scrolled) {

                    scrolled = true;

                    $header.css({
                        marginBottom: $homemenu.outerHeight()
                    });

                    $homemenu.css({
                        position: 'fixed',
                        top: -$homemenu.outerHeight(),
                        left: 0,
                        right: 0
                    }).stop().animate({
                        top: 0 + wpadminbar_height
                    });
                }
            } else {

                // If scroll back to view, force original position
                if ($(this).scrollTop() < $header.outerHeight() + $header.offset().top) {
                    $homemenu.finish();
                }

                if (scrolled) {

                    scrolled = false;

                    $homemenu.stop().animate({
                        top: -$homemenu.outerHeight()
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