<?php

abstract class DHE_Form_Widget_Base extends \Elementor\Widget_Base {
	
	public function show_in_panel() {
		return 'dheform'===get_post_type();;
	}

	protected function _parse_settings(){
		return $this->get_settings_for_display();
	}
	
	public function get_categories() {
		return array('dhe-form-fields');
	}
	
	protected function _parse_shortcode(){
		$settings = $this->_parse_settings();
		$shortcode_tag = $this->get_name();
		$atts = array();
		foreach (dhe_form_shortcode_deafult_atts() as $key=>$value){
			if(isset($settings[$key])){
				$atts[] = $key.'="'.( is_array( $settings[$key] ) ? implode( ',', $settings[$key] ) : trim( $settings[$key] ) ).'"';
			}
		}
		
		return "[{$shortcode_tag} ".implode(' ', $atts)."]";
	}
	
	protected function render(){
		echo do_shortcode($this->_parse_shortcode());
	}
	
	public function render_plain_content(){
		echo $this->_parse_shortcode();
	}
}