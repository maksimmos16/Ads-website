<?php
$output = $css_class ='';

extract(shortcode_atts(array(
	'control_label'=>'',
	'control_name'=>'',
	'default_value'=>'',
	'options_list'=>'',
	'help_text'=>'',
	'required'=>'',
	'disabled'=>'',
	'attributes'=>'',
	'conditional'=>'',
	'el_class'=> '',
	'input_css'=>'',
), $atts));
$name = $this->getControlName($control_name);
if(empty($name)){
	echo dhe_form_require_field_name_notice();
	return;
}
$label = $control_label;
$default_value_arr = (array) explode(',',$default_value);
global $dhe_form;
$default_value_arr = apply_filters('dhe_form_select_default_value', $default_value_arr,$dhe_form,$name);
$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( 'dhe_form_shortcodes_css_class', $el_class, $atts );

$output .='<div class="dhe-form-group dhe-form-'.$name.'-box '.$css_class.dhe_form_shortcode_custom_css_class($input_css,' ').'">'."\n";
if(!empty($label)){
	$output .='<label class="dhe-form-label" for="dhe_form_control_'.$name.'">'.$label.(!empty($required) ? ' <span class="required">*</span>':'').'</label>' . "\n";
}
$output .='<div class="dhe-form-select'.(!empty($conditional) ? ' dhe-form-conditional':'').'">'."\n";
if(!empty($options_list)){
	$options_arr = json_decode(base64_decode($options_list));
	$options_arr = apply_filters('dhe_form_select_options', $options_arr,$dhe_form,$name);
	$select_name = ($this->shortcode =='dhe_form_multiple_select') ? $name.'[]' : $name;
	$output .= '<select data-field-name="'.$name.'" data-name="'.$name.'" '.(!empty($conditional) ? 'data-conditional-name="'.$name.'" data-conditional="'.esc_attr(base64_decode($conditional)).'"': '' ).' '.(!empty($disabled) ? ' disabled':'').'  id="dhe_form_control_'.$name.'" name="'.$select_name.'" '.(($this->shortcode =='dhe_form_multiple_select') ? 'multiple' :'' ).' class="dhe-form-control dhe-form-control-'.$name.' dhe-form-value '.(!empty($required) ? ' dhe-form-required-entry':'').'" '.(!empty($required) ? ' required aria-required="true"':'').' '.$attributes.'>'."\n";
	if(!empty($options_arr)){
		foreach ($options_arr as $option){
			$output .= '<option '.($option->option_default === 'yes' ? 'selected="selected"' :'').' value="'.esc_attr($option->option_value).'">'.esc_html($option->option_label).'</option>';
		}
	}
	$output .='</select><i class="dhe-icon-caret-down"></i>'."\n";
}
$output .='</div>';
if(!empty($help_text)){
	$output .='<span class="dhe-form-help">'.$help_text.'</span>' . "\n";
}
$output .='</div>'."\n";

echo $output;