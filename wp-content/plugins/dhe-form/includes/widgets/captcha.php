<?php

class DHE_Form_Widget_Captcha extends DHE_Form_Widget_Base {
	
	public function get_name() {
		return 'dhe_form_captcha';
	}
	
	public function get_title() {
		return __( 'Captcha Field', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-captcha';
	}
	
	public function get_keywords() {
		return array('captcha');
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


function dhe_form_field_captcha_tmp_dir() {
	return dhe_form_upload_dir('dir').'/captcha';
}

function dhe_form_field_captcha_tmp_url() {
	return dhe_form_upload_dir('url').'/captcha';
}

function dhe_form_field_captcha_img_url($filename) {
	$url = trailingslashit( dhe_form_field_captcha_tmp_url() ) . $filename;

	if ( is_ssl() && 'http:' == substr( $url, 0, 5 ) ) {
		$url = 'https:' . substr( $url, 5 );
	}

	return apply_filters( 'dhe_form_field_captcha_img_url', esc_url_raw( $url ) );
}

function dhe_form_field_captcha_init(){
	static $captcha = null;

	if ( $captcha ) {
		return $captcha;
	}
	
	if ( !class_exists( 'DHE_Form_Simple_Captcha' ) ) {
		include_once DHE_FORM_DIR.'/includes/simple_captcha.php';
	} 
	
	$captcha = new DHE_Form_Simple_Captcha();

	$dir = trailingslashit( dhe_form_field_captcha_tmp_dir() );

	$captcha->tmp_dir = $dir;
	if ( is_callable( array( $captcha, 'make_tmp_dir' ) ) ) {
		$result = $captcha->make_tmp_dir();

		if ( ! $result ) {
			return false;
		}

		return $captcha;
	}
}

function dhe_form_field_captcha_generate(){
	if ( ! $captcha = dhe_form_field_captcha_init() ) {
		return false;
	}

	if ( ! is_dir( $captcha->tmp_dir ) || ! wp_is_writable( $captcha->tmp_dir ) ) {
		return false;
	}

	$img_type = imagetypes();

	if ( $img_type & IMG_PNG ) {
		$captcha->img_type = 'png';
	} elseif ( $img_type & IMG_GIF ) {
		$captcha->img_type = 'gif';
	} elseif ( $img_type & IMG_JPG ) {
		$captcha->img_type = 'jpeg';
	} else {
		return false;
	}

	$captcha->img_size = array( 100, 30 );


	$prefix = wp_rand();
	$captcha_word = $captcha->generate_random_word();
	return $captcha->generate_image( $prefix, $captcha_word );
}

function dhe_form_field_captcha_remove( $prefix ) {
	if ( ! $captcha = dhe_form_field_captcha_init() ) {
		return false;
	}

	if ( preg_match( '/[^0-9]/', $prefix ) ) {
		return false;
	}

	$captcha->remove( $prefix );
}

function dhe_form_field_captcha_check( $prefix, $response ) {
	if ( ! $captcha = dhe_form_field_captcha_init() ) {
		return false;
	}
	return $captcha->check( $prefix, $response );
}

function dhe_form_field_captcha_ajax_refill( $items, $submission) {
	if ( ! is_array( $items ) ) {
		return $items;
	}

	$fes = dhe_form_find_field('captcha',$submission->get_form_id());
	if ( empty( $fes ) ) {
		return $items;
	}

	$refill = array();

	foreach ( $fes as $fe ) {
		$name = $fe->get_name();

		if ( empty( $name ) ) {
			continue;
		}
		if ( $filename = dhe_form_field_captcha_generate() ) {
			$captcha_url = dhe_form_field_captcha_img_url( $filename );
			$refill[$name] = $captcha_url;
		}
	}

	if ( ! empty( $refill ) ) {
		$items['captcha'] = $refill;
	}

	return $items;
}
add_filter( 'dhe_form_ajax_json_echo', 'dhe_form_field_captcha_ajax_refill',10,2);


function dhe_form_field_captcha_cleanup_files(){
	if ( ! $captcha = dhe_form_field_captcha_init() ) {
		return false;
	}
	if ( is_callable( array( $captcha, 'cleanup' ) ) ) {
		return $captcha->cleanup();
	}
}
add_action( 'template_redirect', 'dhe_form_field_captcha_cleanup_files', 20 );

function dhe_form_field_captcha_validation_filter($result, $field){
	$name = $field->get_name();

	$captchac = '_dhe_form_captcha_challenge_' . $name;

	$prefix = isset( $_POST[$captchac] ) ? (string) $_POST[$captchac] : '';
	$response = isset( $_POST[$name] ) ? (string) $_POST[$name] : '';
	$response = dhe_form_canonicalize( $response );

	if(''==$response){
		$result->invalidate($field, dhe_form_get_message('invalid_required'));
	}elseif ( 0 == strlen( $prefix ) || ! dhe_form_field_captcha_check( $prefix, $response ) ){
		$result->invalidate($field, dhe_form_get_message('captcha_not_match'));
	}

	if ( 0 != strlen( $prefix ) ) {
		dhe_form_field_captcha_remove( $prefix );
	}
	
	return $result;

}
add_filter( 'dhe_form_validate_captcha', 'dhe_form_field_captcha_validation_filter', 10, 2 );
