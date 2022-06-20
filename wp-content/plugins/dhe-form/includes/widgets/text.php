<?php

class DHE_Form_Widget_Text extends DHE_Form_Widget_Base {
	
	public function get_name() {
		return 'dhe_form_text';
	}
	
	public function get_title() {
		return __( 'Text Field', 'dhe-form' );
	}
	
	public function get_icon() {
		return 'dhe-form-icon-widget-text';
	}
	
	public function get_keywords() {
		return array('text');
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
			'field_type',
			array(
				'label' => __( 'Field type', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text'=>__('Text','dhe-form'),
					'number'=>__('Number','dhe-form'),
					'search'=>__('Search','dhe-form'),
					'tel'=>__('Tel','dhe-form'),
					'time'=>__('Time','dhe-form'),
					'url'=>__('Url','dhe-form'),
					'week'=>__('Week','dhe-form'),
					'datetime'=>__('Datetime','dhe-form'),
					'color'=>__('Color','dhe-form'),
					'month'=>__('Month','dhe-form'),
					'week'=>__('Week','dhe-form'),
				),
				'description' => __( 'Select type of field', 'dhe-form' )
			)
		);
		
		$this->add_control(
			'is_math_fied',
			array(
				'label' => __( 'Is Math field ?', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'dhe-form' ),
				'label_on' => __( 'Yes', 'dhe-form' ),
				'condition' =>array(
					'field_type'=>array('text','number')
				),
				'description'=>__('Allow use math value for this field with other field value. Example enter default value: price_field * 2','dhe-form')
			)
		);
		
		$this->add_control(
			'default_value',
			array(
				'label' => __( 'Default value', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			)
		);
		
		$this->add_control(
			'minlength',
			array(
				'label' => __( 'Minimum length characters', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			)
		);
		
		$this->add_control(
			'maxlength',
			array(
				'label' => __( 'Maximum length characters', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::TEXT,
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
			'icon',
			array(
				'label' => __( 'Icon', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::ICON,
				'default' => '',
				'description'=> __( 'Select icon add-on for this control.', 'dhe-form' )
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
			'validator',
			array(
				'label' => __( 'Add validator ?', 'dhe-form' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple'=>true,
				'label_block'=>true,
				'condition' =>array(
					'readonly!'=>'yes'
				),
				'options'=>dhe_form_get_validation()
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
/**
 *
 * @param DHE_Form_Validation $result
 * @param DHE_Form_Field $field
 */
function dhe_form_field_text_validation_filter($result, $field){
	$name = $field->get_name();
	$value = isset( $_POST[$name] ) ? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) ) : '';
	if($field->is_required() && ''==$value){
		$result->invalidate($field, dhe_form_get_message('invalid_required'));
	}
	$minlenght = absint($field->attr('minlength'));
	if($minlenght > 0 && strlen($value) < $minlenght){
		$result->invalidate($field, dhe_form_get_message('invalid_too_short'));
	}
	if ( '' !== $value ) {
		foreach ($field->get_validator() as $validator){
			switch ($validator){
				case 'dhe-form-validate-date';
					if(!dhe_form_is_date($value)){
						$result->invalidate($field, dhe_form_get_message('invalid_date'));
					}
				break;
				case 'dhe-form-validate-number':
					if(!dhe_form_is_number($value)){
						$result->invalidate($field,dhe_form_get_message('invalid_number'));
					}
				break;
				case 'dhe-form-validate-number2':
					if(!dhe_form_is_number2($value)){
						$result->invalidate($field, dhe_form_get_message('invalid_number2'));
					}
				break;
				case 'dhe-form-validate-digits':
					if(!dhe_form_is_digits($value)){
						$result->invalidate($field, dhe_form_get_message('invalid_digits'));
					}
				break;
				case 'dhe-form-validate-alpha':
					if(!dhe_form_is_alpha($value)){
						$result->invalidate($field, dhe_form_get_message('invalid_alpha'));
					}		
				break;
				case 'dhe-form-validate-alphanum':
					if(!dhe_form_is_alphanum($value)){
						$result->invalidate($field, dhe_form_get_message('invalid_alphanum'));
					}
				break;
				case 'dhe-form-validate-url':
					if(!dhe_form_is_url($value)){
						$result->invalidate($field, dhe_form_get_message('invalid_url'));
					}
				break;
				case 'dhe-form-validate-zip':
					if(!dhe_form_is_zip($value)){
						$result->invalidate($field,dhe_form_get_message('invalid_zip'));
					}
				break;
				case 'dhe-form-validate-fax':
					if(!dhe_form_is_fax($value)){
						$result->invalidate($field,dhe_form_get_message('invalid_fax'));
					}
				break;
				default:
					if(!apply_filters('dhe_form_validation_filter', true, $validator, $value)){
						$result->invalidate($field,apply_filters('dhe_form_validation_filter_message', '', $validator, $value));
					}
				break;
			}
		}
	}
	return $result;

}
add_filter( 'dhe_form_validate_text', 'dhe_form_field_text_validation_filter', 10, 2 );
