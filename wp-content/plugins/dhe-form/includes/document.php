<?php

class DHE_Form_Document extends \Elementor\Core\Base\Document {
	
	public static function get_properties() {
		$properties = parent::get_properties();
		$properties['admin_tab_group'] = '';
		$properties['support_wp_page_templates'] = true;
		$properties['cpt'] = array('dheform');
		

		return $properties;
	}
	
	public function _get_initial_config() {
		$config = parent::_get_initial_config();
	
		$config['library'] = array(
			'save_as_same_type'=>true,
			'type'=>$this->get_name()
		);
	
		return $config;
	}
	
	public function get_name() {
		return 'dheform';
	}

	public static function get_title() {
		return __( 'DHE Form', 'dhe-form' );
	}

	public function get_css_wrapper_selector() {
		return '#dheform-' . $this->get_main_id();
	}
	
	protected static function get_editor_panel_categories() {
		$categories = parent::get_editor_panel_categories();
		unset($categories['theme-elements']);
		unset($categories['woocommerce-elements']);
		unset($categories['wordpress']);
		unset($categories['dhe-form']);
		$categories = array(
			'dhe-form-fields' => array(
				'title' => __( 'Form fields', 'dhe-form' ),
				'active' => true,
			)
		) + $categories;
		
	
		return $categories;
	}
	
	protected function _register_controls() {
		parent::_register_controls();
		self::register_style_controls( $this );
	}
	/**
	 * 
	 * @param \Elementor\Core\Base\Document $document
	 */
	protected function register_style_controls( $document ){
		
		$document->start_controls_section(
			'section_form_style',
			array(
				'label' => __( 'Form Style', 'dhe-form' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		
		$document->add_control(
			'form_layout',
			array (
				"type" => \Elementor\Controls_Manager::SELECT,
				"label" => __ ( "Form layout", 'dhe-form' ),
				"name" => "form_layout",
				"options" => array (
					'vertical'=>__ ( 'Vertical', 'dhe-form' ),
					'horizontal'=>__ ( 'Horizontal', 'dhe-form' ),
				),
			)
		);
		
		$document->add_control(
			'input_icon_position',
			array (
				"type" => \Elementor\Controls_Manager::SELECT,
				"label" => __ ( "Input icon position", 'dhe-form' ),
				"options" => array (
					'right'=>__ ( 'Right', 'dhe-form' ),
					'left'=>__ ( 'Left', 'dhe-form' ),
				),
			)
		);
		
		$document->end_controls_section();
		$document->start_controls_section(
			'section_form_label_style',
			array(
				'label' => __( 'Label Style', 'dhe-form' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		$document->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array (
				'name' => 'label_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .dhe-form-group .dhe-form-label,
					{{WRAPPER}} .dhe-form-group label:not(.dhe-form-rate-star):not(.dhe-form-radio__option-label):not(.dhe-form-checkbox__option-label)',
			)
		);
		$document->add_control(
			'label_color',
			array (
				'type' =>\Elementor\Controls_Manager::COLOR,
				'label' => __ ( 'Label Color', 'dhe-form' ),
				'selectors'=>array(
					'{{WRAPPER}} .dhe-form-group .dhe-form-label,
					{{WRAPPER}} .dhe-form-group label:not(.dhe-form-rate-star)'=>'color:{{VALUE}};'
				)
			)
		);
		$document->end_controls_section();
		
		$document->start_controls_section(
			'section_form_input_style',
			array(
				'label' => __( 'Input Style', 'dhe-form' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		
		$document->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array (
				'name' => 'input_typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .dhe-form-input input,
					{{WRAPPER}} .dhe-form-file input[type="text"],
					{{WRAPPER}} .dhe-form-captcha input,
					{{WRAPPER}} .dhe-form-select select,
					{{WRAPPER}} .dhe-form-textarea textarea,
					{{WRAPPER}} .dhe-form-group .dhe-form-radio__option-label,
					{{WRAPPER}} .dhe-form-group .dhe-form-checkbox__option-label',
			)
		);
		$document->add_control(
			'placeholder_color',
			array (
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __ ( 'Placeholder Text Color', 'dhe-form' ),
				'selectors'=>array( //{{SELECTOR}}
					'{{WRAPPER}} .dhe-form-group .dhe-form-add-on'=>'color:{{VALUE}};',
					'{{WRAPPER}} .dhe-form-group .dhe-form-control::placeholder'=>'color:{{VALUE}};',
					'{{WRAPPER}} .dhe-form-group .dhe-form-control::-webkit-input-placeholder'=>'color:{{VALUE}};',
					'{{WRAPPER}} .dhe-form-group .dhe-form-control::-moz-input-placeholder'=>'color:{{VALUE}};',
					'{{WRAPPER}} .dhe-form-group .dhe-form-control::-ms-input-placeholder'=>'color:{{VALUE}};',
					'{{WRAPPER}} .dhe-form-group .dhe-form-control:focus::-webkit-input-placeholder'=>'color:transparent;'
				),
			)
		);
		$document->add_control(
			'input_height',
			array (
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => __ ( 'Height', 'dhe-form' ),
				'size_units' => array('px', 'em', '%'),
				'selectors'=>array(
					'{{WRAPPER}} .dhe-form-input input,
					{{WRAPPER}} .dhe-form-file input[type="text"],
					{{WRAPPER}} .dhe-form-captcha input,
					{{WRAPPER}} .dhe-form-select select,
					{{WRAPPER}} .dhe-form-group .dhe-form-add-on,
					{{WRAPPER}} .dhe-form-file-button i,
					{{WRAPPER}} .dhe-form-select i'=>'height:{{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .dhe-form-select i,
					{{WRAPPER}} .dhe-form-file-button i,
					{{WRAPPER}} .dhe-form-group .dhe-form-add-on'=>'line-height:{{SIZE}}{{UNIT}}',
				),
			)
		);
		$document->add_control(
			'input_bg_color',
			array (
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __ ( 'Background Color', 'dhe-form' ),
				'selectors'=>array(
					'{{WRAPPER}} .dhe-form-input input,
					{{WRAPPER}} .dhe-form-file input[type="text"],
					{{WRAPPER}} .dhe-form-captcha input,
					{{WRAPPER}} .dhe-form-select select,
					{{WRAPPER}} .dhe-form-textarea textarea'=>'background-color:{{VALUE}};'
				)
			)
		);
		$document->add_control(
			'input_text_color',
			array (
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __ ( 'Text Color', 'dhe-form' ),
				'selectors'=>array(
					'{{WRAPPER}} .dhe-form-input input,
					{{WRAPPER}} .dhe-form-file input[type="text"],
					{{WRAPPER}} .dhe-form-captcha input,
					{{WRAPPER}} .dhe-form-select select,
					{{WRAPPER}} .dhe-form-textarea textarea'=>'color:{{VALUE}};'
				)
			)
		);
		
		$document->add_control(
			'border',
			array (
				'label' => __( 'Border Type', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'default' => __( 'Default', 'dhe-form' ),
					'none' => __( 'None', 'dhe-form' ),
					'solid' => _x( 'Solid', 'Border Control', 'dhe-form' ),
					'double' => _x( 'Double', 'Border Control', 'dhe-form' ),
					'dotted' => _x( 'Dotted', 'Border Control', 'dhe-form' ),
					'dashed' => _x( 'Dashed', 'Border Control', 'dhe-form' ),
					'groove' => _x( 'Groove', 'Border Control', 'dhe-form' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .dhe-form-input input, 
					{{WRAPPER}} .dhe-form-file input[type="text"], 
					{{WRAPPER}} .dhe-form-captcha input, 
					{{WRAPPER}} .dhe-form-select select,
					{{WRAPPER}} .dhe-form-textarea textarea' => 'border-style: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		
		$document->add_control(
			'border_width',
			array (
				'label' => __( 'Border Width', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'selectors' => array (
					'{{WRAPPER}} .dhe-form-input input, 
					{{WRAPPER}} .dhe-form-file input[type="text"], 
					{{WRAPPER}} .dhe-form-captcha input, 
					{{WRAPPER}} .dhe-form-select select,
					{{WRAPPER}} .dhe-form-textarea textarea' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition' =>array (
					'border!' => array('none','default'),
				),
				'responsive' => false,
			)
		);
		
		$document->add_control(
			'border_color',
			array (
				'label' => __( 'Border Color', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => array (
					'{{WRAPPER}} .dhe-form-input input, 
					{{WRAPPER}} .dhe-form-file input[type="text"], 
					{{WRAPPER}} .dhe-form-captcha input, 
					{{WRAPPER}} .dhe-form-select select,
					{{WRAPPER}} .dhe-form-textarea textarea' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .dhe-form-checkbox i,{{WRAPPER}} .dhe-form-radio i' => 'color: {{VALUE}};',
				),
				'condition' => array (
					'border!' => array('none','default'),
				),
			)
		);
		
		$document->end_controls_section();
	}
}