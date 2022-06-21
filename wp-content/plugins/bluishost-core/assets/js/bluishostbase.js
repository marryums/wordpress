(function($){
    "use strict";
    if( bluishostbase.basevalue == 100 ) {
        $(".ocdi__button-container").find('.button').removeAttr('disabled');
    } else {
        $(".ocdi__button-container").find('.button').attr('disabled','');
    }
})(jQuery);