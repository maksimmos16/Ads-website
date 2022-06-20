<?php

$output = $css_class ='';

extract ( shortcode_atts ( array (
		'control_label' => '',
		'control_name' => '',
		'rate_option'=>'',
		'help_text' => '',
		'conditional'=>'',
		'el_class' => '',
		'input_css'=>'',
), $atts ) );

$name = $this->getControlName($control_name);
if(empty($name)){
	echo dhe_form_require_field_name_notice();
	return;
}
$label = esc_html($control_label);

$el_class = $this->getExtraClass($el_class);
$css_class = apply_filters( 'dhe_form_shortcodes_css_class', $el_class, $atts );

$output .='<div class="dhe-form-group dhe-form-'.$name.'-box '.$css_class.dhe_form_shortcode_custom_css_class($input_css,' ').'">'."\n";
if(!empty($label)){
	$output .='<label class="dhe-form-label">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}
$output .='<div class="dhe-form-rate '.(!empty($conditional) ? ' dhe-form-conditional':'').' dhe-form-control-'.$name.'">'."\n";
$rate_option_64 = base64_decode($rate_option);
$rate_option_arr = json_decode($rate_option_64);

if(is_array($rate_option_arr) && !empty($rate_option_arr)){
	$c = count($rate_option_arr);
	for($i = $c;$i--;$i > 0 ){
		$v = $rate_option_arr[$i];
		$output .='<input data-field-name="'.$name.'" '.(!empty($conditional) ? 'data-conditional-name="'.$name.'" data-conditional="'.esc_attr(base64_decode($conditional)).'"': '' ).' name="'.$name.'" value="'.$v->option_value.'" id="'.sanitize_title($name).'-'.$v->option_value.'" class="dhe-form-value" type="radio">' . "\n";
		$output .='<label class="dhe-form-rate-star" data-toggle="tooltip" data-original-title="'.esc_html($v->option_label).'" for="'.sanitize_title($name).'-'.$v->option_value.'"><i class="dhe-icon-star"></i></label>' . "\n";
	}
}
$output .='</div>';
if(!empty($help_text)){
	$output .='<span class="dhe-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;