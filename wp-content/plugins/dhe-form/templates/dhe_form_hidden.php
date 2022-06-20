<?php
$output ='';
global $dhe_form;
extract(shortcode_atts(array(
	'control_name'=>'',
	'is_math_fied'=>'',
	'default_value'=>'',
), $atts));
$name = $this->getControlName($control_name);
if(empty($name)){
	echo dhe_form_require_field_name_notice();
	return;
}
global $dhe_form;
$default_value = esc_attr($default_value);
$default_value = apply_filters('dhe_form_hidden_default_value', $default_value,$dhe_form,$name);
$data_math_field = '';
if('yes'===$is_math_fied){
	$data_math_field = ' data-calculation_value_format="'.esc_attr(apply_filters( 'dhe_form_calculation_value_format','%v', $dhe_form, $name )).'" data-field_calculation="'.$default_value.'"';
	$default_value = '';
}
$output .= '<input '.$data_math_field.' type="hidden" class="dhe-form-value" data-field-name="'.$name.'" id="dhe_form_control_'.$name.'" name="'.$name.'" value="'.$default_value.'">' . "\n";
echo $output;