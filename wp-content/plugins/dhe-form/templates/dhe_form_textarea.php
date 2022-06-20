<?php
$output = $css_class ='';

extract(shortcode_atts(array(
	'control_label'=>'',
	'control_name'=>'',
	'default_value'=>'',
	'placeholder'=>'',
	'help_text'=>'',
	'required'=>'',
	'readonly'=>'',
	'attributes'=>'',
	'el_class'=> '',
	'input_css'=>'',
), $atts));
$name = $this->getControlName($control_name);
if(empty($name)){
	echo dhe_form_require_field_name_notice();
	return;
}
$default_value = esc_attr($default_value);
global $dhe_form;
$default_value = apply_filters('dhe_form_textarea_default_value', $default_value,$dhe_form,$name);
$label = $control_label;

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( 'dhe_form_shortcodes_css_class', $el_class, $atts );

$output .='<div class="dhe-form-group dhe-form-'.$name.'-box '.$css_class.dhe_form_shortcode_custom_css_class($input_css,' ').'">'."\n";
if(!empty($label)){
	$output .='<label class="dhe-form-label" for="dhe_form_control_'.$name.'">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}
$output .='<div class="dhe-form-textarea">'."\n";
$output .= '<textarea data-field-name="'.$name.'" id="dhe_form_control_'.$name.'" name="'.$name.'" '
		.' class="dhe-form-control dhe-form-control-'.$name.' dhe-form-value'.(!empty($required) ? ' dhe-form-required-entry':'').'" '.(!empty($required) ? ' required aria-required="true"':'').' '.(!empty($readonly) ? ' readonly':'').' placeholder="'.$placeholder.'" '.$attributes.'>'.$default_value.'</textarea>' . "\n";
$output .='</div>';
if(!empty($help_text)){
	$output .='<span class="dhe-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;

