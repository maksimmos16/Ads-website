<?php

class DHE_Form_Widget_Steps extends DHE_Form_Widget_Base {
	
	public function get_name() {
		return 'dhe_form_steps';
	}
	
	public function get_title() {
		return __( 'Steps', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-steps';
	}
	
	
	public function get_keywords() {
		return array('Steps');
	}
	
	protected function _register_controls(){
		
		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'dhe-form' ),
			)
		);
		$this->add_control(
			'el_class',
			array(
				'label' => __( 'Extra class name', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
				'separator' => 'before',
				'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'dhe-form')
			)
		);
		
	
		$this->end_controls_section();
	}
}