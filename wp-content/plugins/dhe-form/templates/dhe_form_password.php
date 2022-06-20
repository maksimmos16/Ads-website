<?php
$output = $css_class ='';

extract(shortcode_atts(array(
	'control_label'=>'',
	'control_name'=>'',
	'confirmation'=>'',
	'password_field'=>'',
	'maxlength'=>'',
	'placeholder'=>'',
	'icon'=>'',
	'help_text'=>'',
	'required'=>'',
	'readonly'=>'',
	'validator'=>'',
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

$input_class='';
$icon_html = '';
if(!empty($icon) && $icon != 'None'){
	$input_class = ' dhe-form-has-add-on';
	$icon_html ='<span class="dhe-form-add-on"><i class="'.$icon.'"></i></span>'."\n";
}

$output .='<div class="dhe-form-group dhe-form-'.$name.'-box '.$css_class.dhe_form_shortcode_custom_css_class($input_css,' ').'">'."\n";
if(!empty($label)){
	$output .='<label class="dhe-form-label" for="dhe_form_control_'.$name.'">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}
$output .='<div class="dhe-form-input '.$input_class.'">'."\n";
$output .= '<input data-field-name="'.$name.'" autocomplete="off" type="password" id="dhe_form_control_'.$name.'" name="'.$name.'" value="" '.(!empty($maxlength) ? ' maxlength="'.$maxlength.'"' : '')
		.' class="dhe-form-control dhe-form-control-'.$name.' dhe-form-value'.(!empty($required) ? ' dhe-form-required-entry':'').' '.(!empty($validator) ? (!empty($confirmation) ? 'dhe-form-validate-cpassword' : 'dhe-form-validate-password' )  : '' ).'" '.(!empty($required) ? ' required aria-required="true"':'').' '.(!empty($readonly) ? ' readonly':'').' '.(!empty($confirmation) ? 'data-validate-cpassword="'.$password_field.'"':'').' placeholder="'.$placeholder.'" '.$attributes.'>' . "\n";
$output .=$icon_html;
$output .='</div>';
if(!empty($help_text)){
	$output .='<span class="dhe-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;