<?php

class DHE_Form_Widget_Submit_Button extends DHE_Form_Widget_Base {
	
	public function get_name() {
		return 'dhe_form_submit_button';
	}
	
	public function get_title() {
		return __( 'Submit button', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-submit-button';
	}
	
	public function get_keywords() {
		return array('submit');
	}
	
	protected function _register_controls(){
		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'dhe-form' ),
			)
		);
		
		$this->add_control(
			'label',
			array(
				'label' => __( 'Label', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default'=>'Submit'
			)
		);
		
		$this->add_responsive_control(
			'align',
			array(
				'label' => __( 'Alignment', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options'=>array(
					'left'=> array(
						'title' => __( 'Left', 'dhe-form' ),
						'icon' => 'fa fa-align-left',
					),
					'center'=> array(
						'title' => __( 'Center', 'dhe-form' ),
						'icon' => 'fa fa-align-center',
					),
					'right'=> array(
						'title' => __( 'Right', 'dhe-form' ),
						'icon' => 'fa fa-align-right',
					),
					'justify'=> array(
						'title' => __( 'Justified', 'dhe-form' ),
						'icon' => 'fa fa-align-justify',
					)
				),
				'prefix_class' => 'elementor%s-align-',
				'default' => '',
			)
		);
		
		$this->add_control(
			'button_size',
			array(
				'label' => __( 'Size', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					'' => __( 'Default', 'dhe-form' ),
					'xs' => __( 'Extra Small', 'dhe-form' ),
					'sm' => __( 'Small', 'dhe-form' ),
					'md' => __( 'Medium', 'dhe-form' ),
					'lg' => __( 'Large', 'dhe-form' ),
					'xl' => __( 'Extra Large', 'dhe-form' ),
				),
				'style_transfer' => true,
			)
		);
		
		
		$this->add_control(
			'icon',
			array(
				'label' => __( 'Icon', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'label_block' => true,
				'default' => '',
			)
		);
		
		$this->add_control(
			'icon_align',
			array(
				'label' => __( 'Icon Position', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => array(
					'left' => __( 'Before', 'dhe-form' ),
					'right' => __( 'After', 'dhe-form' ),
				),
				'condition' => array(
					'icon!' => '',
				),
			)
		);
		
		$this->add_control(
			'icon_indent',
			array(
				'label' => __( 'Icon Spacing', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => array(
					'px' => array(
						'max' => 50,
					),
				),
				'condition' => array(
					'icon!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .dhe-form-submit__icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dhe-form-submit__icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
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
			'section_style',
			array(
				'label' => __( 'Button', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name' => 'typography',
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .dhe-form-submit',
			)
		);
		
		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'elementor' ),
			)
		);

		$this->add_control(
			'button_text_color',
			array(
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .dhe-form-submit' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'background_color',
			array(
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .dhe-form-submit' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'elementor' ),
			)
		);

		$this->add_control(
			'hover_color',
			array(
				'label' => __( 'Text Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .dhe-form-submit:disabled,
					{{WRAPPER}} .dhe-form-submit:disabled:hover,
					{{WRAPPER}} .dhe-form-submit:hover,
					{{WRAPPER}} .dhe-form-submit:active,
					{{WRAPPER}} .dhe-form-submit:focus' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_background_hover_color',
			array(
				'label' => __( 'Background Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' =>array(
					'{{WRAPPER}} .dhe-form-submit:disabled,
					{{WRAPPER}} .dhe-form-submit:disabled:hover,
					{{WRAPPER}} .dhe-form-submit:hover,
					{{WRAPPER}} .dhe-form-submit:active,
					{{WRAPPER}} .dhe-form-submit:focus' => 'background-color: {{VALUE}};',
				),
			)
		);
		
		$this->add_control(
			'button_hover_border_color',
			array(
				'label' => __( 'Border Color', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'condition' => array(
					'border_border!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .dhe-form-submit:disabled,
					{{WRAPPER}} .dhe-form-submit:disabled:hover,
					{{WRAPPER}} .dhe-form-submit:hover,
					{{WRAPPER}} .dhe-form-submit:active,
					{{WRAPPER}} .dhe-form-submit:focus' => 'border-color: {{VALUE}};',
				),
			)
		);
		
		$this->add_control(
			'hover_animation',
			array(
				'label' => __( 'Hover Animation', 'elementor' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
			)
		);
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();
		
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name' => 'border',
				'selector' => '{{WRAPPER}} .dhe-form-submit',
				'separator' => 'before',
			)
		);
		
		$this->add_control(
			'border_radius',
			array(
				'label' => __( 'Border Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => array(
					'{{WRAPPER}} .dhe-form-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .dhe-form-submit',
			)
		);
		
		$this->add_responsive_control(
			'text_padding',
			array(
				'label' => __( 'Padding', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors' => array(
					'{{WRAPPER}} .dhe-form-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator' => 'before',
			)
		);
		
		
		$this->end_controls_section();
	}
}