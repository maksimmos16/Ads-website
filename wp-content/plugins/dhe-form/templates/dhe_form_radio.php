<?php
$output = $css_class ='';

extract(shortcode_atts(array(
	'control_label'=>'',
	'control_name'=>'',
	'options_list'=>'',
	'option_width'=>'',
	'help_text'=>'',
	'required'=>'',
	'disabled'=>'',
	'conditional'=>'',
	'el_class'=> '',
	'input_css'=>'',
), $atts));

$label = $control_label;
$name = $this->getControlName($control_name);
if(empty($name)){
	echo dhe_form_require_field_name_notice();
	return;
}
$option_width_pattern = '/^(\d*(?:\.\d+)?)\s*(px|\%|in|cm|mm|em|rem|ex|pt|pc|vw|vh|vmin|vmax)?$/';
// allowed metrics: http://www.w3schools.com/cssref/css_units.asp
$option_width_regexr = preg_match( $option_width_pattern, $option_width, $option_width_matches );
$option_width_value = isset( $option_width_matches[1] ) ? (float) $option_width_matches[1] : 0;
$option_width_unit = isset( $option_width_matches[2] ) ? $option_width_matches[2] : 'px';
$option_width_ = $option_width_value . $option_width_unit;

$inline_css = ( (float) $option_width_ > 0.0 ) ? ' style="width: ' . esc_attr( $option_width_ ) . '"' : '';

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( 'dhe_form_shortcodes_css_class', $el_class, $atts );

$output .='<div class="dhe-form-group dhe-form-'.$name.'-box '.$css_class.dhe_form_shortcode_custom_css_class($input_css,' ').'">'."\n";
if(!empty($label)){
	$output .='<label class="dhe-form-label">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}
$output .='<div class="dhe-form-radio'.(!empty($inline_css) ? ' dhe-form-radio__custom_w':'').(!empty($conditional) ? ' dhe-form-conditional':'').'">'."\n";
if(!empty($options_list)){
	$options_arr = json_decode(base64_decode($options_list));
	global $dhe_form;
	$options_arr = apply_filters('dhe_form_radio_options', $options_arr,$dhe_form,$name);
	if(!empty($options_arr)){
		$i = 0;
		foreach ($options_arr as $option){
			$id = uniqid('_');
			$label_image = '';
			$label_class = 'dhe-form-radio__option-label';
			$label_arr = explode('==', $option->option_label);
			if(isset($label_arr[1]) && 'http'===substr($label_arr[1], 0, 4 )){
				$label_class .= ' dhe-form-image-label';
				$label_image = '<span class="dhe-form-radio__image"><img src="'.$label_arr[1].'"/></span>';
			}
			$output .='<label class="'.$label_class.'" for="dhe_form_control_'.sanitize_title($option->option_value).$id.'" '.$inline_css.'>';
			$output .= '<input '.(!empty($conditional) ? 'data-conditional-name="'.$name.'" data-conditional="'.esc_attr(base64_decode($conditional)).'"': '' ).' type="radio" '.(!empty($disabled) ? ' disabled':'').' class="dhe-form-value dhe-form-control-'.$name.' '.(!empty($required) && $i ==0 ? 'dhe-form-required-entry':'').'"  id="dhe_form_control_'.sanitize_title($option->option_value).$id.'" '.($option->option_default === 'yes' ? 'checked="checked"' :'').' name="'.$name.'" value="'.esc_attr($option->option_value).'">';
			$output .= $label_image;
			$output .= '<i class="dhe-icon-radio"></i>';
			$output .= !empty($label_image) ? $label_arr[0] : $option->option_label;
			$output .= '</label>'."\n";
			$i++;
		}
	}
}
$output .='</div>';
if(!empty($help_text)){
	$output .='<span class="dhe-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;