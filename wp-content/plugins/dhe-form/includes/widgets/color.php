<?php

class DHE_Form_Widget_Color extends DHE_Form_Widget_Base {
	
	public function get_name() {
		return 'dhe_form_color';
	}
	
	public function get_title() {
		return __( 'Color Field', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-color';
	}
	
	public function get_keywords() {
		return array('color');
	}
	
	protected function _register_controls(){
		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'dhe-form' ),
			)
		);
		
		$this->add_control(
			'control_label',
			array(
				'label' => __( 'Label', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
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
			'default_value',
			array(
				'label' => __( 'Default value', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::COLOR,
			)
		);
		
		$this->add_control(
			'placeholder',
			array(
				'label' => __( 'Placeholder text', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			)
		);
		
		$this->add_control(
			'help_text',
			array(
				'label' => __( 'Help text', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'description'=>__('This is the help text for this form control.', 'dhe-form')
			)
		);
		
		$this->add_control(
			'required',
			array(
				'label' => __( 'Required ?', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'dhe-form' ),
				'label_on' => __( 'Yes', 'dhe-form' ),
			)
		);
		
		$this->add_control(
			'readonly',
			array(
				'label' => __( 'Readonly ?', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'dhe-form' ),
				'label_on' => __( 'Yes', 'dhe-form' ),
			)
		);
		
		$this->add_control(
			'attributes',
			array(
				'label' => __( 'Attributes', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				 'description' => __('Add attribute for this form control,eg: <em>onclick="" onchange="" </em> or \'<em>data-*</em>\'  attributes HTML5, not in attributes: <span style="color:#ff0000">type, value, name, required, placeholder, maxlength, id</span>', 'dhe-form')
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

function dhe_form_field_color_validation_filter($result, $field){
	$name = $field->get_name();
	$value = isset( $_POST[$name] ) ? trim( strtr( (string) $_POST[$name], "\n", " " ) ) : '';
	if($field->is_required() && ''==$value){
		$result->invalidate($field, dhe_form_get_message('invalid_required'));
	}
	return $result;

}
add_filter( 'dhe_form_validate_color', 'dhe_form_field_color_validation_filter', 10, 2 );

