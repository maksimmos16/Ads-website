<?php

$output ='';
extract(shortcode_atts(array(
	'label'=>__('Submit','dhe-form'),
	'icon'=>'',
	'icon_align'=>'',
	'icon_indent'=>'',
	'button_size'=>'',
	'hover_animation'=>'',
	'el_class'=>'',
	'input_css'=>'',
), $atts));

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( 'dhe_form_shortcodes_css_class', $el_class, $atts );

$icon_html = '';
if(!empty($icon)){
	$icon_html = '<span class="dhe-form-submit__icon dhe-form-submit__icon-'.$icon_align.'"><i class="'.$icon.'" aria-hidden="true"></i></span>';
}
$hover_animation_class='';
if(!empty($hover_animation)){
	$hover_animation_class = ' elementor-animation-'.$hover_animation;
}
$output = '
<div class="dhe-form-action '.$css_class.dhe_form_shortcode_custom_css_class($input_css,' ').'">
	<button type="submit" class="button dhe-form-submit dhe-form-submit--size-'.$button_size.$hover_animation_class.'">
		<span class="dhe-form-submit-label">'.$icon_html.esc_html($label).'</span>
		<span class="dhe-form-submit-spinner">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="25 25 50 50"  xml:space="preserve">
				<circle class="path" cx="50" cy="50" r="20" stroke-dasharray="89, 200" stroke="currentColor" stroke-dashoffset="-35" fill="none" stroke-width="5" stroke-miterlimit="10"/>
			</svg>
		</span>
	</button>
</div>';

echo $output;