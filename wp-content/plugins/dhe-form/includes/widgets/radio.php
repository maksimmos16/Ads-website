<?php

class DHE_Form_Widget_Radio extends DHE_Form_Widget_Base {

	public function get_name() {
		return 'dhe_form_radio';
	}

	public function get_title() {
		return __( 'Radio Field', 'dhe-form' );
	}

	public function get_icon() {
		return 'dhe-form-icon-widget-radio';
	}

	public function get_keywords() {
		return array('radio');
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
		
		$this->add_control(
			'option_width',
			array(
				'label' => __( 'Option with', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'description' => __('Enter option item width (Note: CSS measurement units allowed),ex: 50%', 'dhe-form')
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
		$settings['options_list'] = isset($settings['options_list']) ? base64_encode(json_encode($settings['options_list'])) : array();
		$settings['conditional'] = isset($settings['conditional']) ? base64_encode(json_encode($settings['conditional'])) : array();
		return $settings;
	}
}


function dhe_form_field_radio_validation_filter($result, $field){
	$name = $field->get_name();
	$value = isset( $_POST[$name] ) ? (string) $_POST[$name] : '';
	if($field->is_required() && ''==$value){
		$result->invalidate($field, dhe_form_get_message('invalid_required'));
	}
	return $result;

}
add_filter( 'dhe_form_validate_radio', 'dhe_form_field_radio_validation_filter', 10, 2 );


