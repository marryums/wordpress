<?php 
class bluishost_helper{
	
	// Constructor
	function __construct(){
		
	}
	
	// Typography helper function
	public function bluishost_fontcontainer( $string ){
		
		$fontsettings = explode( '|', $string ); 

		$fontperam = array();
		if( is_array( $fontsettings ) ){
			foreach( $fontsettings as $fontsetting ){
						$fontperam[] = explode( ':', $fontsetting );
			}
		}
		
		$tag =  '';
		$styleattr = '';
		foreach( $fontperam as $value ){
			
			if( !empty( $value[0] ) && $value[0] != 'tag' ){
				if( !empty( $value[0] ) && !empty( $value[1] ) ){

					if( $value[0] == 'font_size' || $value[0] == 'letter_spacing' || $value[0] == 'line_height' ){
						$unit = 'px';
					}else{
						$unit = '';
					}

					$styleattr .= str_replace( '_', '-', $value[0] ) .':'.str_replace( '%23','#',$value[1] ) .$unit.';';
				}
			}else{
				if( !empty( $value[1] ) ){
					$tag .= $value[1];
				}
				
			}

		}
		//
		if( $styleattr ){
			$style = 'style="'.esc_attr( $styleattr ).'"';
		}else{
			$style = '';
		}
		// 
		if( $tag ){
			$tag = $tag;
		}else{
			$tag = '';
		}
		//
		$style = array(
				'tag' 	=> $tag,
				'style' => $style
			);

		return $style;
	}
	// Overlay helper function
	public function bluishost_overlay( $string ){
		
		
		$fontsettings = explode( '|', $string ); 

		$fontperam = array();
		if( is_array( $fontsettings ) ){
			foreach( $fontsettings as $fontsetting ){
						$fontperam[] = explode( ':', $fontsetting );
			}
		}
				
		
		
		$styleattr = array();
		foreach( $fontperam as $value ){
			
			if( !empty( $value[0] ) ){
				
				$styleattr[$value[0]] = str_replace( '%23','#',$value[1] );
				
			}

		}

		return $styleattr;
	}
	
	// Font Icon Helper Function
	public function bluishost_font_icon_process( $type , $iconarray ){
        $ficon_val = '';
        if( $type == 'fontawesome'  ){
            $ficon_val = '<i class="'.esc_attr($iconarray['awesome']).'"></i>';
        }elseif( $type == 'openiconic' ){
            $ficon_val = '<i class="'.esc_attr($iconarray['openic']).'"></i>';
        }elseif( $type == 'entypo' ){
            $ficon_val = '<i class="'.esc_attr($iconarray['entypo']).'"></i>';
        }elseif( $type == 'typicons' ){
            $ficon_val = '<i class="'.esc_attr($iconarray['typicons']).'"></i>';
        }elseif( $type == 'linecons' ){
            $ficon_val = '<i class="'.esc_attr($iconarray['linecons']).'"></i>';
        }elseif( $type == 'monosocial' ){
            $ficon_val = '<i class="'.esc_attr($iconarray['monosocial']).'"></i>';
        }elseif( $type == 'material' ){
            $ficon_val = '<i class="'.esc_attr($iconarray['material']).'"></i>';
        }else{
            if( !empty( $iconarray['img'] ) ){
                $imgurl     = wp_get_attachment_image_src($iconarray['img'],'full');
                $ficon_val  = bluishost_img_tag( array( 'url' => $imgurl[0] ,'class' => 'svg' ));
            }
        }
        return $ficon_val;
	}
	
	// Inline css style tag 
	public function bluishost_style_tag( $args = array() ){
				
		if( count( $args ) > 0 ){
			
		$tags = implode( '', $args );
		
		$Styletag = 'style="'.$tags.'"'; 
		
		}else{
			$Styletag = '';
		}
		
		return $Styletag;

	}
	
	// Inline css helper function
	public function bluishost_inline_css( $css = '' ){
		
		$inlinestyle = '';
		if( $css ):

		$inlinestyle .= '<script type="text/javascript">';
			$inlinestyle .= '( function($){
				$("head").append( "<style>'.$css.'</style>" );
			})(jQuery);';
		$inlinestyle .= '</script>';
		

		endif;
		return $inlinestyle;
	}
	
}

?>