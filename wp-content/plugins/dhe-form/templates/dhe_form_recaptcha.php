<?php
$output = $css_class ='';
extract(shortcode_atts(array(
	'captcha_type'=>'2',
	'type'=>'recaptcha',
	'theme'=>'red',
	'language'=>'en',
	'control_label'=>'',
	'control_name'=>'',
	'placeholder'=>'',
	'help_text'=>'',
	'required'=>'1',
	'attributes'=>'',
	'el_class'=> '',
	'input_css'=>'',
), $atts));

$name = $this->getControlName($control_name);
if(empty($name)){
	echo dhe_form_require_field_name_notice();
	return;
}
global $dhe_form;
$label = $control_label;
$language = apply_filters('dhe_form_language_code',$language);



if($captcha_type=='3'){
	$output .= '<input data-sitekey="'.dhe_form_get_option('recaptcha_public_key').'" type="hidden" id="g-recaptcha-response_'.$name.'" data-dheform-recaptcha="recaptcha" name="g-recaptcha-response" value="">';
}else{
	$el_class = $this->getExtraClass($el_class);
	
	$css_class = apply_filters( 'dhe_form_shortcodes_css_class', $el_class, $atts );
	
	$output .='<div class="dhe-form-group dhe-form-'.$name.'-box '.$css_class.dhe_form_shortcode_custom_css_class($input_css,' ').'">'."\n";
	if(!empty($label)){
		$output .='<label class="dhe-form-label" for="'.$name.'">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
	}
	
	$site_key = dhe_form_get_option('recaptcha_public_key');
	$secret_key	 = dhe_form_get_option('recaptcha_private_key');
	if ( ! empty( $site_key ) && ! empty( $secret_key ) ) {
		$output .='<div data-sitekey="'.dhe_form_get_option('recaptcha_public_key').'" data-theme="light" data-size="normal" type="recaptcha" data-dheform-recaptcha="recaptcha" class="dhe-form-recaptcha dhe-form-recaptcha2" id="'.$name.'"></div>';
	}else{
		$output .= __('To use reCAPTCHA, you need to add the API Key and complete the setup process in Dashboard > DHE Form > Settings > Integrations > reCAPTCHA settings.','dhe-form');
	}
	if(!empty($help_text)){
		$output .='<span class="help_text">'.$help_text.'</span>' . "\n";
	}
	$output .='</div>'."\n";
}

echo $output;
