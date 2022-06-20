<?php
$output = $css_class ='';

extract(shortcode_atts(array(
	'control_label'=>'',
	'control_name'=>'',
	'help_text'=>'',
	'required'=>'',
	'attributes'=>'',
	'el_class'=> '',
	'input_css'=>'',
), $atts));

$name = $this->getControlName($control_name);
if(empty($name)){
	echo dhe_form_require_field_name_notice();
	return;
}
$label = $control_label;

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( 'dhe_form_shortcodes_css_class', $el_class, $atts );

$output .='<div class="dhe-form-group dhe-form-'.$name.'-box '.$css_class.dhe_form_shortcode_custom_css_class($input_css,' ').'">'."\n";
if(!empty($label)){
	$output .='<label class="dhe-form-label">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}
$output .='<div class="dhe-form-file">'."\n";
$output .='<label for="dhe_form_control_'.$name.'">';
$output .= '<span class="dhe-form-file-button">'."\n";
$output .= '<i>'.__('Browse','dhe-form').'</i>'."\n";
$output .= '</span>'."\n";
$output .='<input id="dhe_form_control_'.$name.'" data-field-name="'.$name.'" name="'.$name.'" class="dhe-form-value dhe-form-validate-extension dhe-form-control-'.$name.' '.(!empty($required) ? ' dhe-form-required-entry':'').'" type="file">';
$output .= '<input autocomplete="off" class="dhe-form-control" placeholder="'.esc_attr__('Choose file','dhe-form').'" type="text" value="" readonly="readonly">'."\n";
$output .= '</label>' . "\n";				
$output .='</div>';
if(!empty($help_text)){
	$output .='<span class="dhe-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;

