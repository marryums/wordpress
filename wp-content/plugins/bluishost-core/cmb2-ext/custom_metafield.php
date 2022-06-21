<?php
function cmb2_render_switch( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {
	$switch = '<div class="cmb2-switch">';
	$conditional_value =(isset($field->args['attributes']['data-conditional-value'])?'data-conditional-value="' .esc_attr($field->args['attributes']['data-conditional-value']).'"':'');
    $conditional_id =(isset($field->args['attributes']['data-conditional-id'])?' data-conditional-id="'.esc_attr($field->args['attributes']['data-conditional-id']).'"':'');
    $label_on =(isset($field->args['label'])?esc_attr($field->args['label']['on']):'On');
    $label_off =(isset($field->args['label'])?esc_attr($field->args['label']['off']):'Off');
    $switch .= '<input '.$conditional_value.$conditional_id.' type="radio" id="' . $field->args['_id'] . '1" value="1"  '. ($escaped_value == 1 ? 'checked="checked"' : '') . ' name="' . esc_attr($field->args['_name']) . '" />
		<input '.$conditional_value.$conditional_id.' type="radio" id="' . $field->args['_id'] . '2" value="0" '. (($escaped_value == '' || $escaped_value == 0) ? 'checked="checked"' : '') . ' name="' . esc_attr($field->args['_name']) . '" />
		<label for="' . $field->args['_id'] . '1" class="cmb2-enable '.($escaped_value == 1?'selected':'').'"><span>'.$label_on.'</span></label>
		<label for="' . $field->args['_id'] . '2" class="cmb2-disable '.(($escaped_value == '' || $escaped_value == 0)?'selected':'').'"><span>'.$label_off.'</span></label>';

	$switch .= '</div>';
	$switch .= $field_type_object->_desc( true );
	echo $switch;
}add_action( 'cmb2_render_switch', 'cmb2_render_switch', 10, 5 );

/* CMB2 image_select Field */ 
function cmb2_render_image_select( $field, $escaped_value, $object_id, $object_type, $field_type_object ) {		
	
    $default_value = !empty( $field->args['default'] ) ? $field->args['default'] : 1 ;  

	$image_select = '<ul id="cmb2-image-select'.$field->args['_id'].'" class="cmb2-image-select-list">';
	foreach ( $field->options() as $value => $item ) {
		$selected = ( $value == ($escaped_value =='' ? $default_value : $escaped_value ) ) ? 'checked="checked"' : '';	
		$image_select .= '<li class="cmb2-image-select '.($selected!= ''?'cmb2-image-select-selected':'').'"><label for="' . $field->args['_id'] . esc_attr( $value ) . '">
			<input type="radio" id="'. $field->args['_id'] . esc_attr( $value ) . '" name="' . $field->args['_name'] . '" value="' . esc_attr( $value ) . '" ' . $selected . ' class="cmb2-option"><img class="" style=" width: auto; " alt="' . $item['alt'] . '" src="' . $item['img'] . '">
			</label></li>';
	}
	$image_select .= '</ul>';
	$image_select .= $field_type_object->_desc( true );
	echo $image_select;
}
add_action( 'cmb2_render_image_select', 'cmb2_render_image_select', 10, 5 );

/* CMB2 Core File Enque */
function bluishost_core_styles_scripts_admin(){
	
	// CMB2
	wp_enqueue_style( 'switch_metafield', plugins_url( 'css/custom_metafield.css', __FILE__ ) , array(), '1.0' );
	
	wp_enqueue_script( 'switch_metafield', plugins_url( 'js/custom_metafield.js', __FILE__ ) , array('jquery'), '1.0', true );
	
}
add_action( 'admin_enqueue_scripts', 'bluishost_core_styles_scripts_admin' );
