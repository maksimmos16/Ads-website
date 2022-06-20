<?php

class DHE_Form_Widget_Recaptcha extends DHE_Form_Widget_Base {
	
	public function get_name() {
		return 'dhe_form_recaptcha';
	}
	
	public function get_title() {
		return __( 'Recaptcha field', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-recaptcha';
	}
	
	public function get_keywords() {
		return array('recaptcha');
	}
	
	protected function _register_controls(){
		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'dhe-form' ),
			)
		);
		
// 		$this->add_control(
// 			'captcha_type',
// 			array(
// 				'label' => __( 'Type', 'dhe-form' ),
// 				'type' => \Elementor\Controls_Manager::SELECT,
// 				'default' => '2',
// 				'options' => array(
// 	                '2'=>__('Version 2', 'dhe-form'),
// 	            	'3'=>__('Version 3', 'dhe-form')
// 				),
// 				'description' => __('Select reCaptcha version you want use.', 'dhe-form')
// 			)
// 		);
		
		$this->add_control(
			'theme',
			array(
				'label' => __( 'Theme', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'red'=>__('Red', 'dhe-form'),
	                'clean'=> __('Clean', 'dhe-form'),
	                'white'=>__('White', 'dhe-form'),
	                'blackglass'=>__('BlackGlass', 'dhe-form')
				),
				'condition' =>array(
					'captcha_type'=>'1'
				),
				'description' => __('Defines which theme to use for reCAPTCHA.', 'dhe-form')
			)
		);
		
		$this->add_control(
			'language',
			array(
				'label' => __( 'Type', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'text',
				'options' => dhe_form_get_recaptcha_lang(),
				'condition' =>array(
					'captcha_type'=>'1'
				),
				'description' => __('Select the language you would like to use for the reCAPTCHA display from the available options.', 'dhe-form')
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
	}
}

function dhe_form_recaptcha_enqueue_api_script($ver='2'){
	if(!apply_filters('dhe_form_recaptcha_enqueue_api_script', true)){
		return;
	}
	$language = apply_filters('dhe_form_language_code','en');
	$render = '3'==$ver ? dhe_form_get_option('recaptcha_public_key','') : 'explicit'; 
	$api_script_url = add_query_arg(
		array(
			'render'=>$render,
			'hl'=>$language
		),
		'https://www.google.com/recaptcha/api.js'	
	);
	wp_enqueue_script( 'dhe-form-recaptcha', $api_script_url , array('jquery'), $ver,true );
}

function dhe_form_recaptcha_verify($response_token ) {
	$is_human = false;

	if ( empty( $response_token ) ) {
		return $is_human;
	}

	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$sitekey = dhe_form_get_option('recaptcha_public_key');
	$secret = dhe_form_get_option('recaptcha_private_key');
	$response = wp_safe_remote_post( $url, array(
		'body' => array(
			'secret' => $secret,
			'response' => $response_token,
			'remoteip' => $_SERVER['REMOTE_ADDR'] ) ) );

	if ( 200 != wp_remote_retrieve_response_code( $response ) ) {
		return $is_human;
	}

	$response = wp_remote_retrieve_body( $response );
	$response = json_decode( $response, true );
	$is_human = isset( $response['success'] ) && true == $response['success'];
	return $is_human;
}

/**
 * 
 * @param DHE_Form_Validation $result
 * @param DHE_Form_Field $field
 * @return DHE_Form_Validation
 */
function dhe_form_field_recaptcha_validation_filter($result, $field){
	$type = $field->attr('captcha_type');
	$into = 'div#'.$field->get_name().'.dhe-form-recaptcha';
	$response_token = isset( $_POST['g-recaptcha-response'] ) ? $_POST['g-recaptcha-response'] : '';
	if(empty($response_token)){
		$result->invalidate($field, dhe_form_get_message('recaptcha_not_check'), $into);
	}elseif (!dhe_form_recaptcha_verify($response_token)){
		$result->invalidate($field, dhe_form_get_message('invalid_recaptcha'), $into);
	}
	return $result;

}
add_filter( 'dhe_form_validate_recaptcha', 'dhe_form_field_recaptcha_validation_filter', 10, 2 );