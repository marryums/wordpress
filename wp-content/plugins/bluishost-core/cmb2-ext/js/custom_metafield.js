window.CMB2 = (function(window, document, $, undefined){
	'use strict';

    // Switcher
	$(".cmb2-enable").click(function(){
        var parent = $(this).parents('.cmb2-switch');
        $('.cmb2-disable',parent).removeClass('selected');
        $(this).addClass('selected');        
    });
    $(".cmb2-disable").click(function(){
        var parent = $(this).parents('.cmb2-switch');
        $('.cmb2-enable',parent).removeClass('selected');
        $(this).addClass('selected');
    });
    // Select Image
    $('ul.cmb2-image-select-list li input[type="radio"]').click(
    function(e) {
        e.stopPropagation(); // stop the click from bubbling
        $(this).closest('ul').find('.cmb2-image-select-selected').removeClass('cmb2-image-select-selected');
        $(this).parent().closest('li').addClass('cmb2-image-select-selected');
    });


    var $layout_value = $('.cmb2-switch input[type="radio"]:checked').val();
    var $layout = $('.cmb2-id--bluishost-header-layout-switcher .cmb2-switch input[type="radio"]');

    if( 1 ==  $layout_value ){
        $('.cmb2-id--bluishost-header-custom-layout').show();
    }else{
        $('.cmb2-id--bluishost-header-custom-layout').hide();
    }

    $layout.on('change',function(){
        if($(this).val() != "0") {
            $('.cmb2-id--bluishost-header-custom-layout').show();
        }else{
            $('.cmb2-id--bluishost-header-custom-layout').hide();
        }
    });

    // Footer Setting Metabox
    var $ftlayout = $('.cmb2-id--bluishost-footer-layout-switcher .cmb2-switch input[type="radio"]')
    var $ftlayout_value = $('.cmb2-id--bluishost-footer-layout-switcher .cmb2-switch input[type="radio"]:checked').val();

    if( 1 ==  $ftlayout_value ){
        $('.cmb2-id--bluishost-footer-custom-layout').show();
    }else{
        $('.cmb2-id--bluishost-footer-custom-layout').hide();
    }

    $ftlayout.on('change',function(){
        if($(this).val() != "0") {
            $('.cmb2-id--bluishost-footer-custom-layout').show();
        }else{
            $('.cmb2-id--bluishost-footer-custom-layout').hide();
        }
    });
    
})(window, document, jQuery);
