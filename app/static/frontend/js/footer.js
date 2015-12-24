/**
 * Created by GuoHao on 2015/12/25.
 */
$(document).ready(function() {
    var $pathName = window.location.pathname;
    try {
        var $firstPath = $pathName.replace(/^\/+/, '').split('/').shift();
    } catch (e) {
        return '';
    }

    var $path = '';
    $('footer a').each(function() {
        $path = $(this).attr('data-path');

        if ($firstPath === $path) {
            $('.cur').removeClass('cur');
            $(this).addClass('cur');

        }
    })
});