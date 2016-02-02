/**
 Mobile Nav

 @since {{VERSION}}
 @package CrossFit
 */
(function ($) {
    'use strict';

    $(function () {

        var $mobile_nav = $('#mobile-nav');

        $mobile_nav.find('.toggle-mobile-nav').click(function () {

            $mobile_nav.toggleClass('active');
            $(this).siblings('.mobile-nav-menus').stop().slideToggle();
        });
    });
})(jQuery);