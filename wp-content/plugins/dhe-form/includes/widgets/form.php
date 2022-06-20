<?php

class DHE_Form_Widget_Form extends DHE_Form_Widget_Base {
	
	public function show_in_panel() {
		return 'dheform'!==get_post_type();
	}
	
	public function get_name() {
		return 'dhe_form';
	}
	
	public function get_title() {
		return __( 'Form', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-form';
	}
	
	public function get_categories() {
		return array('dhe-form');
	}
	
	public function get_keywords() {
		return array('form');
	}
	
	protected function get_forms_options(){
		$args = array(
			'post_type' => 'dheform',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'meta_query' => array(
				array(
					'key' => '_form_popup',
					'compare' => 'NOT EXISTS'
				)
			)
		);
		$forms  = get_posts($args);
		$forms_options  = array(''=>'');
		foreach ($forms as $form) {
			if (empty($form->post_title)){
				$form->post_title = $form->ID;
			}
			$forms_options[$form->ID] = $form->post_title;
		}
		return $forms_options;
	}
	
	protected function _register_controls(){
		
		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'dhe-form' ),
			)
		);
		
		$this->add_control(
			'form_id',
			array(
				'label' => __( 'Form', 'dhe-form' ),
				'type'   => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => $this->get_forms_options()
			)
		);
	
		$this->end_controls_section();
	}

}

