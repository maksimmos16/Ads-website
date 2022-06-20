<?php

class DHE_Form_Widget_File extends DHE_Form_Widget_Base {
	
	public function get_name() {
		return 'dhe_form_file';
	}
	
	public function get_title() {
		return __( 'File field', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-file';
	}
	
	public function get_keywords() {
		return array('File');
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

function dhe_form_field_file_validation_filter($result, $field){
	$name = $field->get_name();
	$file = isset( $_FILES[$name] ) ? $_FILES[$name] : null;
	if ( $file['error'] && UPLOAD_ERR_NO_FILE != $file['error'] ) {
		$result->invalidate( $tag, dhe_form_get_message( 'upload_failed_php_error' ) );
		return $result;
	}
	if ( empty( $file['tmp_name'] ) && $field->is_required() ) {
		$result->invalidate( $field, dhe_form_get_message( 'invalid_required' ) );
		return $result;
	}
	if ( ! is_uploaded_file( $file['tmp_name'] ) ) {
		return $result;
	}
	$file_type_pattern = implode( '|', dhe_form_allowed_file_extension() );
	$file_type_pattern = trim( $file_type_pattern, '|' );
	$file_type_pattern = '(' . $file_type_pattern . ')';
	$file_type_pattern = '/\.' . $file_type_pattern . '$/i';
	if ( ! preg_match( $file_type_pattern, $file['name'] ) ) {
		$result->invalidate( $field, dhe_form_get_message( 'upload_file_type_invalid' ) );
		return $result;
	}
	
	$allowed_size = dhe_form_allowed_size(); // default size 1 MB
	
	if ( $file['size'] > $allowed_size ) {
		$result->invalidate( $field, dhe_form_get_message( 'upload_file_too_large' ) );
		return $result;
	}
	
	if ( $submission = DHE_Form_Submission::get_instance() ) {
		$submission->add_upload_files( $name, $file );
	}
	
	return $result;

}
add_filter( 'dhe_form_validate_file', 'dhe_form_field_file_validation_filter', 10, 2 );
