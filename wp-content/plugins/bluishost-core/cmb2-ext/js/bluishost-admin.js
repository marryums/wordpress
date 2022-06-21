jQuery(function($){
    'use strict';

   
    /********** section media option redio button ************/
    $.metaplug = function( options ){
        
        var  settings = $.extend({
            
            // Default val set
            opt1:  "",
            opt2:  "",
            name:  "",
            cont:  "",
            media: ""
            
        }, options );

        
        //
        var $Cont  = $( settings.opt1 ),
        $Gmed      = $( settings.opt2 ),
        $Name      = settings.name, 
        $Content   = $( settings.cont ),
        $Media     = $( settings.media );
        
       
    
        $( 'input[type=radio][name='+$Name+']' ).on( 'click', function(){
            
            //
            if( $Cont.is(':checked') ){
               console.log( 'test' );
                $Content.css('display', 'block');
            
            }else{
                $Content.css('display', 'none');
            }
            //
            if( $Gmed.is(':checked') ){
                
                $Media.css('display', 'block');
            
            }else{
               $Media.css('display', 'none'); 
            }

            
        });  
     
        // Flat Content checked 
        if( $Cont.is(':checked') ){
            
            $Content.css('display', 'block');

        }else{
            $Content.css('display', 'none');
        } 
        //
        if( $Gmed.is(':checked') ){
            
            $Media.css('display', 'block');

        }else{
             $Media.css('display', 'none');
        }
    
          
    };
   
    /********** section media option Select box ************/
    $.metaplugSelectbox = function( options ){
        
        var  settings = $.extend({
            
            // Default val set
            selector:  "",
            matchval:  "",
            contdual:  "",
            contdualsame:  "",
            cont	:  ""
            
        }, options );

        
        //
        var $seltor  = $( settings.selector ),
        $Content     = $( settings.cont ),
        $Contentdual = $( settings.contdual ),
        $metval      = settings.matchval;
	  
       	var $selected =  $seltor.select();
			
		var $selectedVal = $selected.val();
    
        $( $seltor ).change( function(){
			
       		var $selected =  $( this ).select();
			
			var $selectedVal = $selected.val();
			
				
			
            //
            if( $selectedVal == $metval ){
                
                $Content.css('display', 'none');
                $Contentdual.css('display', 'block');
            
            }else{
                $Content.css('display', 'block');
                $Contentdual.css('display', 'none');
            }
            
        });  
     
        // Flat Content checked 
		if( $selectedVal == $metval ){
			$Content.css( 'display', 'none' );
			$Contentdual.css( 'display', 'block' );
		}else{
			$Content.css( 'display', 'block' );
			$Contentdual.css( 'display', 'none' );
		}

          
    };
	

    /********** Header Options Plugin ************/
    $.headerSelectbox = function( options ){
        
        var  settings = $.extend({
            
            // Default val set
            selector:  "",
            matchval:  "",
            contdual:  "",
            contdualsame:  "",
            cont	:  ""
            
        }, options );

        
        //
        var $seltor  = $( settings.selector ),
        $Content     = $( settings.cont ),
        $Contentdual = $( settings.contdual ),
        $metval      = settings.matchval;
	  
       	var $selected =  $seltor.select();
			
		var $selectedVal = $selected.val();
    
        $( $seltor ).change( function(){
			
       		var $selected =  $( this ).select();
			
			var $selectedVal = $selected.val();
			
				
			
            //
            if( $selectedVal == $metval ){
                
                $Content.css('display', 'block');
               
            
            }else{
                $Content.css('display', 'none');
            }
            
        });  
     
        // Flat Content checked 
		if( $selectedVal == $metval ){
			$Content.css( 'display', 'block' );
		}else{
			$Content.css( 'display', 'none' );
		}

          
    }; // End Header Options  Plugin


	
	// Select box global setting / page settings option
	$.metaplugSelectbox({
		
		selector  : "#_bluishost_page_header_settings",
		matchval  : "global",
		cont	  : ".page-setting",
		
	});
	
	
	// Header Options 
	$.headerSelectbox({
		selector  : "#_bluishost_slide_header_active",
		matchval  : "slider",
		cont	  : ".slider-settings",
	});
	$.headerSelectbox({
		selector  : "#_bluishost_slide_header_active",
		matchval  : "page_header",
		cont	  : ".page-header-settings",
	});
	$.headerSelectbox({
		selector  : "#_bluishost_slide_header_active",
		matchval  : "customslider",
		cont	  : ".slider-customShortcode",
	});
	
	// slider type
	$.headerSelectbox({
		selector  : "#_bluishost_slider-type",
		matchval  : "banner",
		cont	  : ".slider-ofb",
	});
	$.headerSelectbox({
		selector  : "#_bluishost_slider-type",
		matchval  : "slider",
		cont	  : ".slider-typeopt",
	});
	

	// Page template select condition
	var $selector = $( '#page_template' );
	function page_template_meta_box(){
		
		var $selector = $( '#page_template' ),
		$pageLayout = $( '#_bluishostpage_sliderPageheader_section' ),
		$pageLayoutSection = $( '#_bluishostpage_page_layout_section' );
		
		if( 'template-builder.php' == $selector.val() ){
				$pageLayout.show();
				$pageLayoutSection.show();
		}else{
			$pageLayout.hide();
			$pageLayoutSection.hide();
		}
		
	}
	// Default 
	page_template_meta_box();
	// Onchange 
	$selector.on( 'change', function(){
		page_template_meta_box();
	} );
	


    // Slider Info Conditinals
    $(".cmb-tab-slider1").hide();
    $(".cmb-tab-slider2").hide();
    $(".cmb-tab-slider3").hide();
    if( $("select#_bluishost_slider-version").val() == '2'  ){
        $(".cmb-tab-slider2").show();
    }else if( $("select#_bluishost_slider-version").val() == '3' ){
        $(".cmb-tab-slider3").show();
    }else{
        $(".cmb-tab-slider1").show();
    }

    $("select#_bluishost_slider-version").on("change",function(){
        if( $(this).val() == '1'  ){
            $(".cmb-tab-slider1").show();
            $(".cmb-tab-slider2").hide();
            $(".cmb-tab-slider3").hide();
        }else if( $(this).val() == '2' ){
            $(".cmb-tab-slider2").show();
            $(".cmb-tab-slider1").hide();
            $(".cmb-tab-slider3").hide();
        }else{
            $(".cmb-tab-slider3").show();
            $(".cmb-tab-slider1").hide();
            $(".cmb-tab-slider2").hide();
        }
    });

    $(".cmb2-id--bluishost-sliderthree-group-options .cmb-row.btnone-icon-trigger").each(function(){
        //$(this).find('select');    
        if(  $(this).find('select').val() == 'yes' ){
            $(this).siblings('.btnone-imgicon').show();
        }else{
            $(this).siblings('.btnone-imgicon').hide();
        }

        $(this).find('select').on('change',function(){
            if( $(this).val() == 'yes' ){
                $(this).parents('.btnone-icon-trigger').siblings('.btnone-imgicon').show();
                console.log( $(this).parents('.btnone-icon-trigger').siblings('.btnone-imgicon') );
            }else{
                $(this).parents('.btnone-icon-trigger').siblings('.btnone-imgicon').hide();
                console.log( $(this).parents('.btnone-icon-trigger').siblings('.btnone-imgicon') );
            }
        });

    });

    $(".cmb2-id--bluishost-sliderthree-group-options .cmb-row.btntwo-icon-trigger").each(function(){
        //$(this).find('select');    
        if(  $(this).find('select').val() == 'yes' ){
            $(this).siblings('.btntwo-imgicon').show();
        }else{
            $(this).siblings('.btntwo-imgicon').hide();
        }

        $(this).find('select').on('change',function(){
            if( $(this).val() == 'yes' ){
                $(this).parents('.btntwo-icon-trigger').siblings('.btntwo-imgicon').show();
            }else{
                $(this).parents('.btntwo-icon-trigger').siblings('.btntwo-imgicon').hide();
            }
        });

    });


    if( $('.cmb2-id--bluishost-slider-genbgov input[type="checkbox"]').is(":checked") ){
        $(".cmb2-id--bluishost-slider-genoverlaycolor").show();
        $(".cmb2-id--bluishost-slider-genoverlayopacity").show();
    }else{
        $(".cmb2-id--bluishost-slider-genoverlaycolor").hide();
        $(".cmb2-id--bluishost-slider-genoverlayopacity").hide();
    }

    $('.cmb2-id--bluishost-slider-genbgov input[type="checkbox"]').on("change",function(){
        if( $(this).is(":checked") ){
            $(".cmb2-id--bluishost-slider-genoverlaycolor").show();
            $(".cmb2-id--bluishost-slider-genoverlayopacity").show();
        }else{
            $(".cmb2-id--bluishost-slider-genoverlaycolor").hide();
            $(".cmb2-id--bluishost-slider-genoverlayopacity").hide();
        }
    });


    var $customHeader_val = $( ".cmb2-id--bluishost-page-header-settings select" ).val();
    var $customHeader = $( ".cmb2-id--bluishost-page-header-settings select" );

    if( 'pageset' == $customHeader_val ){
        $(".cmb2-id--bluishost-body-gradient-color-trigger").show();
        $(".cmb2-id--bluishost-body-gradient-color-one").show();
        $(".cmb2-id--bluishost-body-gradient-color-two").show();
        $(".cmb2-id--bluishost-body-bg-color").show();
        $(".cmb2-id--bluishost-body-pattern-trigger").show();
        $(".cmb2-id--bluishost-body-patternbg").show();
        $(".cmb2-id--bluishost-body-bg-trigger").show();
    }else{
        $(".cmb2-id--bluishost-body-gradient-color-trigger").hide();
        $(".cmb2-id--bluishost-body-gradient-color-one").hide();
        $(".cmb2-id--bluishost-body-gradient-color-two").hide();
        $(".cmb2-id--bluishost-body-bg-color").hide();
        $(".cmb2-id--bluishost-body-pattern-trigger").hide();
        $(".cmb2-id--bluishost-body-patternbg").hide();
        $(".cmb2-id--bluishost-body-bg-trigger").hide();
    }

    $customHeader.on("change",function(){
        if( $(this).val() == 'pageset' ){
            $(".cmb2-id--bluishost-body-gradient-color-trigger").show();
            
            $(".cmb2-id--bluishost-body-bg-color").show();
            $(".cmb2-id--bluishost-body-pattern-trigger").show();
            $(".cmb2-id--bluishost-body-patternbg").show();
            $(".cmb2-id--bluishost-body-bg-trigger").show();
        }else{
            $(".cmb2-id--bluishost-body-gradient-color-trigger").hide();
            
            $(".cmb2-id--bluishost-body-bg-color").hide();
            $(".cmb2-id--bluishost-body-pattern-trigger").hide();
            $(".cmb2-id--bluishost-body-patternbg").hide();
            $(".cmb2-id--bluishost-body-bg-trigger").hide();
        }
        
    });

    var $body_gradient_val = $(".cmb2-id--bluishost-body-gradient-color-trigger input[type='radio']:checked").val();
    var $body_gradient = $(".cmb2-id--bluishost-body-gradient-color-trigger input[type='radio']");

    if( $body_gradient_val == '1' ){
        $(".cmb2-id--bluishost-body-gradient-color-one").show();
        $(".cmb2-id--bluishost-body-gradient-color-two").show();
    }else{
        $(".cmb2-id--bluishost-body-gradient-color-one").hide();
        $(".cmb2-id--bluishost-body-gradient-color-two").hide();
    }

    $body_gradient.on("change",function(){
        if( $(this).val()  == '1'){
            $(".cmb2-id--bluishost-body-gradient-color-one").show();
            $(".cmb2-id--bluishost-body-gradient-color-two").show();
        }else{
            $(".cmb2-id--bluishost-body-gradient-color-one").hide();
            $(".cmb2-id--bluishost-body-gradient-color-two").hide();
        }
    });


    var $body_bg_val = $(".cmb2-id--bluishost-body-bg-trigger input[type='radio']:checked").val();
    var $body_bg = $(".cmb2-id--bluishost-body-bg-trigger input[type='radio']");

    if( $body_gradient_val == '1' ){
        $(".cmb2-id--bluishost-body-bg-color").show();
    }else{
        $(".cmb2-id--bluishost-body-bg-color").hide();
    }

    $body_bg.on("change",function(){
        if( $(this).val()  == '1'){
            $(".cmb2-id--bluishost-body-bg-color").show();
        }else{
            $(".cmb2-id--bluishost-body-bg-color").hide();
        }
    });

    var $body_bg_pattern_val = $(".cmb2-id--bluishost-body-pattern-trigger input[type='radio']:checked").val();
    var $body_bg_pattern = $(".cmb2-id--bluishost-body-pattern-trigger input[type='radio']");

    if( $body_bg_pattern_val == '1' ){
        $(".cmb2-id--bluishost-body-patternbg").show();
    }else{
         $(".cmb2-id--bluishost-body-patternbg").hide();
    }

    $body_bg_pattern.on("change",function(){
        if( $(this).val()  == '1'){
            $(".cmb2-id--bluishost-body-patternbg").show();
        }else{
            $(".cmb2-id--bluishost-body-patternbg").hide();
        }
    });

    // Foote Options Settings 
    var $back_to_top_val = $(".cmb2-id--bluishost-footer-back-to-top-button-switcher input[type='radio']:checked").val();
    var $back_to_top = $(".cmb2-id--bluishost-footer-back-to-top-button-switcher input[type='radio']");
    
    if( $back_to_top_val == '1'  ){
        $(".cmb2-id--bluishost-back-to-top-style").show();
    }else{
        $(".cmb2-id--bluishost-back-to-top-style").hide();
    }

    $back_to_top.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--bluishost-back-to-top-style").show();
        }else{
            $(".cmb2-id--bluishost-back-to-top-style").hide();
        }
    });

});