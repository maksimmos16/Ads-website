<?php

class DHE_Form_Widget_Hidden extends DHE_Form_Widget_Base {
	
	public function get_name() {
		return 'dhe_form_hidden';
	}
	
	public function get_title() {
		return __( 'Hidden field', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-hidden';
	}
	
	public function get_keywords() {
		return array('Hidden');
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
				'description'=>__('Allow use math value for this field with other field value. Example enter default value: price_field * 2','dhe-form')
			)
		);
		
		$this->add_control(
			'default_value',
			array(
				'label' => __( 'Default value', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			)
		);
		
		$this->end_controls_section();
	}
}