<?php
$output = $css_class = '';

extract ( shortcode_atts ( array (
		'control_label' => '',
		'control_name' => '',
		'placeholder' => '',
		'help_text' => '',
		'required' => '1',
		'attributes' => '',
		'el_class' => '' ,
		'input_css'=>'',
), $atts ) );
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
	$output .='<label class="dhe-form-label" for="dhe_form_control_'.$name.'">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}

$output .='<div class="dhe-form-captcha">'."\n";
$filename = dhe_form_field_captcha_generate();
$prefix = substr( $filename, 0, strrpos( $filename, '.' ) );
$output .= '<input autocomplete="off" type="text" id="dhe_form_control_'.$name.'" name="'.$name.'" '
		.' class="dhe-form-control dhe-form-control-'.$name.' dhe-form-value'.(!empty($required) ? ' dhe-form-required-entry dhe-form-validate-captcha':'').'" '.(!empty($required) ? ' required aria-required="true"':'').' placeholder="'.$placeholder.'">' . "\n";
$output .= '<div class="dhe-form-captcha-img">';
$output .='<img class="dhe-form-captcha-img-'.$name.'" src="'.dhe_form_field_captcha_img_url($filename).'">';
$output .='<input type="hidden" name="_dhe_form_captcha_challenge_'.$name.'" value="'.$prefix.'" />';
$output .='</div>';
$output .='</div>';
if(!empty($help_text)){
	$output .='<span class="dhe-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;
