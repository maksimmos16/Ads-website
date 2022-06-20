<?php

class DHE_Form_Widget_Multiple_Select extends DHE_Form_Widget_Base {
	
	public function get_name() {
		return 'dhe_form_multiple_select';
	}
	
	public function get_title() {
		return __( 'Multiple Select Field', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-select';
	}
	
	public function get_keywords() {
		return array('Multiple','select');
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
			'disabled',
			array(
				'label' => __( 'Disabled ?', 'dhe-form' ),
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
		
		$this->start_controls_section(
			'section_options',
			array(
				'label' => __( 'Options', 'dhe-form' ),
			)
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'option_default',
			array(
				'label' => __( 'Deafult', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'dhe-form' ),
				'label_on' => __( 'Yes', 'dhe-form' ),
			)
		);
		
		$repeater->add_control(
			'option_label',
			array(
				'label' => __( 'Option Label', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'show_label' => true,
			)
		);
		
		$repeater->add_control(
			'option_value',
			array(
				'label' => __( 'Option Value', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			)
		);
		
		$this->add_control(
			'options_list',
			array(
				'label' => __( 'Options', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => array(
					array(
						'option_label' => 'Option #1',
						'option_value' => 'value_1',
					),
					array(
						'option_label' => 'Option #2',
						'option_value' => 'value_2',
					),
				),
				'title_field' => '{{{ option_label }}}',
			)
		);
		
		$this->end_controls_section();
	}
	
	protected function _parse_settings(){
		$settings = $this->get_settings_for_display();
		$settings['options_list'] = isset($settings['options_list']) ? base64_encode(json_encode($settings['options_list'])) : array();
		return $settings;
	}
}
function dhe_form_field_multiple_select_validation_filter($result, $field){
	$name = $field->get_name();
	if ( isset( $_POST[$name] ) && is_array( $_POST[$name] ) ) {
		foreach ( $_POST[$name] as $key => $value ) {
			if ( '' === $value ) {
				unset( $_POST[$name][$key] );
			}
		}
	}

	$empty = ! isset( $_POST[$name] ) || empty( $_POST[$name] ) && '0' !== $_POST[$name];

	if($field->is_required() && $empty ){
		$result->invalidate($field, dhe_form_get_message('invalid_required'));
	}
	return $result;

}
add_filter( 'dhe_form_validate_multiple_select', 'dhe_form_field_multiple_select_validation_filter', 10, 2 );

