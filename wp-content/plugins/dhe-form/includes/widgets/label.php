<?php

class DHE_Form_Widget_Label extends DHE_Form_Widget_Base {
	
	public function get_name() {
		return 'dhe_form_label';
	}
	
	public function get_title() {
		return __( 'Label field', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-label';
	}
	
	public function get_keywords() {
		return array('Label');
	}
	
	protected function _register_controls(){
		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'dhe-form' ),
			)
		);
		
		$this->add_control(
			'control_name',
			array(
				'label' => __( 'Name', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __('Field name is required.  Please enter single word, no spaces, no start with number. Underscores(_) allowed', 'dhe-form')
			)
		);
		
		$this->add_control(
			'is_math_fied',
			array(
				'label' => __( 'Is Math field ?', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'dhe-form' ),
				'label_on' => __( 'Yes', 'dhe-form' ),
				'description'=>__('Allow use math value for this field with other field value. Example enter content value: price_field * 2','dhe-form')
			)
		);
		
		$this->add_control(
			'content',
			array(
				'label' => __( 'Text', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'deafult' => 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
			)
		);
		
		$this->end_controls_section();
	}
	
	protected function _parse_shortcode(){
		$settings = $this->_parse_settings();
		$content = isset($settings['content']) ? $settings['content'] : '';
		$atts = array();
		foreach (dhe_form_shortcode_deafult_atts() as $key=>$value){
			if(isset($settings[$key])){
				$atts[] = $key.'="'.(is_array($settings[$key]) ? implode(',', $settings[$key]) : $settings[$key]).'"';
			}
		}
		return "[dhe_form_label ".implode(' ', $atts)."]{$content}[/dhe_form_label]";
	}
}