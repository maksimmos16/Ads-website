<?php

class DHE_Form_Widget_Paypal extends DHE_Form_Widget_Base {
	
	public function get_name() {
		return 'dhe_form_paypal';
	}
	
	public function get_title() {
		return __( 'Paypal Field', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-paypal';
	}
	
	public function get_keywords() {
		return array('Paypal');
	}
	
	protected function _register_controls(){
		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'dhe-form' ),
			)
		);
		
		$this->add_control(
			'order_description',
			array(
				'label' => __( 'Paypal Order Description', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default'=>'DHE Form Order',
			)
		);
		
		$this->add_control(
			'item_text',
			array(
				'label' => __( 'Item text', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default'=>'Items'
			)
		);
		
		$this->add_control(
			'qty_text',
			array(
				'label' => __( 'Qty text', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default'=>'Qty'
			)
		);
		
		$this->add_control(
			'price_text',
			array(
				'label' => __( 'Price text', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default'=>'Price'
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
			'section_item_list',
			array(
				'label' => __( 'Items list', 'dhe-form' ),
			)
		);
		
		$repeater = new \Elementor\Repeater();
		
		$repeater->add_control(
			'item_label',
			array(
				'label' => __( 'Item Label', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			)
		);
		
		$repeater->add_control(
			'item_qty',
			array(
				'label' => __( 'Item Qty', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			)
		);
		
		$repeater->add_control(
			'item_price',
			array(
				'label' => __( 'Item Price', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			)
		);
		
		$this->add_control(
			'item_list',
			array(
				'label' => __( 'Item list', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => array(
					array(
						'item_label' => 'Item #1',
						'item_qty' => '1',
						'item_price' => '100',
					),
					array(
						'item_label' => 'Item #2',
						'item_qty' => '2',
						'item_price' => '200',
					),
				),
				'title_field' => '{{{ item_label }}}',
			)
		);
		
		$this->end_controls_section();
		
	}
	
	protected function _parse_settings(){
		$settings = $this->get_settings_for_display();
		$settings['item_list'] = isset($settings['item_list']) ? base64_encode(json_encode($settings['item_list'])) : array();
		return $settings;
	}
}


