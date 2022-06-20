<?php

class DHE_Form_Widget_Rate extends DHE_Form_Widget_Base {
	
	public function get_name() {
		return 'dhe_form_rate';
	}
	
	public function get_title() {
		return __( 'Rate field', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-rate';
	}
	
	public function get_keywords() {
		return array('Rate');
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
		for($i=0;$i<5;$i++){
			$value = $i+1;
			$option = new stdClass();
			$option->label = $value.'/5';
			$option->value = $value;
			$value_arr[] = $option;
		}
		$this->add_control(
			'rate_option',
			array(
				'label' => __( 'Options', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => array(
					array(
						'option_label' => '1/5',
						'option_value' => '1',
					),
					array(
						'option_label' => '2/5',
						'option_value' => '2',
					),
					array(
						'option_label' => '3/5',
						'option_value' => '3',
					),
					array(
						'option_label' => '4/5',
						'option_value' => '4',
					),
					array(
						'option_label' => '5/5',
						'option_value' => '5',
					),
				),
				'title_field' => '{{{ option_label }}}',
			)
		);
		
		
		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_conditional',
			array(
				'label' => __( 'Conditionals Logic', 'dhe-form' ),
			)
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'type',
			array(
				'label' => __( 'If value this element', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options'=>array(
					'=' => __('Equals','dhe-form'),
					'>' => __('Is greater than','dhe-form'),
					'<' => __('Is less than','dhe-form'),
					'not_empty' => __('Not empty','dhe-form'),
					'is_empty' => __('Is empty','dhe-form'),
				)
			)
		);
		
		$repeater->add_control(
			'value',
			array(
				'label' => __( 'Value', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'condition' =>array(
					'type!'=>array('not_empty','is_empty')
				),
			)
		);
		
		$repeater->add_control(
			'action',
			array(
				'label' => __( 'Then', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options'=>array(
					'show'=>__('Show','dhe-form'),
					'hide'=>__('Hide','dhe-form')
				)
			)
		);
		
		$repeater->add_control(
			'element',
			array(
				'label' => __( 'Element(s) name', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder'=>'element_1,element_2'
			)
		);
		
		$this->add_control(
			'conditional',
			array(
				'label' => __( 'Conditionals Logic', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ type }}}',
				'prevent_empty' => false,
			)
		);
		
		$this->end_controls_section();
	}
	
	protected function _parse_settings(){
		$settings = $this->get_settings_for_display();
		$settings['rate_option'] = isset($settings['rate_option']) ? base64_encode(json_encode($settings['rate_option'])) : array();
		$settings['conditional'] = isset($settings['conditional']) ? base64_encode(json_encode($settings['conditional'])) : array();
		return $settings;
	}
}

function dhe_form_field_rate_validation_filter($result, $field){
	$name = $field->get_name();
	$value = isset( $_POST[$name] ) ? (string) $_POST[$name] : '';
	if($field->is_required() && ''==$value)
		$result->invalidate($field, dhe_form_get_message('invalid_required'));
	return $result;

}
add_filter( 'dhe_form_validate_rate', 'dhe_form_field_rate_validation_filter', 10, 2 );

