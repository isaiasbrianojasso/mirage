/**
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 * We offer the best and most useful modules PrestaShop and modifications for your online store.
 *
 * @category  PrestaShop Module
 * @author    knowband.com <support@knowband.com>
 * @copyright 2016 Knowband
 * @license   see file: LICENSE.txt
 */
var click = 0;
$(document).ready(function() {
    console.log(version);
    if(version == 5 && layout==0 && position == 1) {
        $(".vss-next-link").css('right', '50%');
    }
    if(version == 5 && layout==0 && typeof (ismobile) != 'undefined' && ismobile == 1 && typeof (istablet) != 'undefined' && istablet == 0) {
        $(".vss-slider-li-0").css('width', '200px');
        $(".vss-slider").css('padding', '0px');
        $(".vss-link").css('top', '89%');
    }
    if(version ==5 && typeof (ismobile) != 'undefined' && ismobile==1 && position == 1 && typeof (istablet) != 'undefined' && istablet == 0) {
        $(".vss-product-video-module").insertBefore($("#buy_block"));
    }
    var selector = ".vss-slider-li-" + vssposition;
    $(".vss-slider").css('width', numberofvideos * $(selector).outerWidth() + 'px');
    console.log($(selector).outerWidth());
    if ( $(selector).outerWidth() <= 300) {
        $(".vss-overflow-hidden").css('width', $(selector).outerWidth()-52 + 'px');
    } else {
        $(".vss-overflow-hidden").css('width', $(selector).outerWidth() + 'px');    
    }
    $(document).keydown(function(e) {
        if (e.which == 37) { // 37 is the left arrow key code.
            if (layout == 0) {
                getVideo(1);
            } else {
                getThumbnailVideo($('.vss-border-color').prev($('.vss-thumbnail-slider-li')).attr('id'), 1);
            }
        }
        ;
        if (e.which == 39) { // 39 is the right arrow key code.
            if (layout == 0) {
                getVideo(2);
            } else {
                getThumbnailVideo($('.vss-border-color').next($('.vss-thumbnail-slider-li')).attr('id'), 2);
            }
        }
        ;
    });
})

$(window).on('load',function(){
    if (layout == 1) {
        var extra_width = Math.ceil(2 * numberofvideos * parseFloat($(".vss-thumbnail-slider-li").css('margin-left'))) + 20 + (2 * numberofvideos * parseFloat($(".vss-thumbnail-slider-li").css('padding-left')));
        $(".vss-center-thumbnails").css('width', parseFloat($(".vss-center-thumbnails").css('width')) + extra_width + 'px');
    }
})

function getVideo(a) {
    var selector = ".vss-slider-li-" + vssposition;
    var width = $(selector).outerWidth();
    if (a == 2 && click < numberofvideos - 1) {
        $(".vss-slider").animate({
            "left": "-=" + (width) + "px"}, "slow");
        click = click + 1;
        if (click == numberofvideos - 1) {
            $('.vss-next-link').hide();
        }
        $('.vss-prev-link').show();
    } else if (a == 1 && click > 0) {
        $(".vss-slider").animate({
            "left": "+=" + (width) + "px"}, "slow");
        click = click - 1;
        if (click == 0) {
            $('.vss-prev-link').hide();
        }
        $('.vss-next-link').show();
    }
}

function getThumbnailVideo(a, b)
{
    if (b == 0) {
        var id = $(a).attr('id').split("_");
    } else {
        var id = a.split("_");
    }
    var selec = '#' + id[0] + '_' + 'kbproductvideo';
    $('.vss-main-video').hide();
    $(selec).show();
    if (b == 0) {
        $(".vss-thumbnail-slider-li").attr('class', 'vss-thumbnail-slider-li')
        $(a).attr('class', 'vss-thumbnail-slider-li vss-border-color')
    } else if (b == 1) {
        $(".vss-thumbnail-slider-li").each(function() {
            if ($(this).hasClass('vss-border-color') && $(this).prev(".vss-thumbnail-slider-li").length !== 0) {
                $(this).prev(".vss-thumbnail-slider-li").attr('class', 'vss-thumbnail-slider-li vss-border-color');
                $(this).attr('class', 'vss-thumbnail-slider-li');
                return false;
            }
        })
    } else if (b == 2) {
        $(".vss-thumbnail-slider-li").each(function() {
            if ($(this).hasClass('vss-border-color') && $(this).next(".vss-thumbnail-slider-li").length !== 0) {
                $(this).next(".vss-thumbnail-slider-li").attr('class', 'vss-thumbnail-slider-li vss-border-color');
                $(this).attr('class', 'vss-thumbnail-slider-li');
                return false;
            }
        })
    }
}
