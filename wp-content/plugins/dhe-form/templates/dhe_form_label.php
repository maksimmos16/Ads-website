<?php
$output ='';
extract(shortcode_atts(array(
	'control_name'=>'',
	'is_math_fied'=>'',
	'el_class'=> '',
	'input_css'=>'',
), $atts));
$name = $this->getControlName($control_name);
if(empty($name)){
	echo dhe_form_require_field_name_notice();
	return;
}
global $dhe_form;
$css_class = apply_filters( 'dhe_form_shortcodes_css_class', $el_class, $atts );
$data_math_field = '';
if('yes'===$is_math_fied){
	$data_math_field = ' data-calculation_value_format="'.esc_attr(apply_filters( 'dhe_form_calculation_value_format','%v', $dhe_form, $name )).'" data-field_calculation="'.esc_attr(wp_strip_all_tags($content,true)).'"';
	$content = '';
}
$output .='<div class="dhe-form-group dhe-form-'.$name.'-box '.$css_class.dhe_form_shortcode_custom_css_class($input_css,' ').'">'."\n";
$output .='<div '.$data_math_field.' class="dhe-form-control-label dhe-form-control-'.$name.'">'."\n";
$output .= dhe_form_remove_wpautop($content, true);
$output .='</div>';
$output .='</div>'."\n";
echo $output;