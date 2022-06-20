<?php
if (!defined('ABSPATH')){
    exit; // Exit if accessed directly
}
class DHE_Form_ShortCode_Base {
	
	protected static $_instance = null;
	
	protected $shortcode, $html_template, $settings, $form_id, $atts;
	
	public function __construct($shortcode_tag=''){
		$this->shortcode = $shortcode_tag;
	}
	
	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	public function render($atts, $content = null, $shortcode_tag = null){
		global $dhe_form,$post;
		if(empty($dhe_form) && \Elementor\Plugin::$instance->editor->is_edit_mode()){
			$dhe_form = $post;
		}
		$shortcode_class = $this->getShortcodeClass($shortcode_tag);
		$shortcode_class->atts = $atts;
		$shortcode_class->enqueue();
		return $shortcode_class->output($atts,$content);
	}
	
	public function editor_enqueue($shortcode_tag=null){
		$this->getShortcodeClass($shortcode_tag)->enqueue();
	}
	
	/**
	 * Enqueue control scripts and styles.
	 *
	 */
	protected function enqueue() {}
	
	protected function getShortcodeClass($shortcode_tag){
		$class_name = 'DHE_Form_Shortcode_'.str_replace(' ', '_', ucwords(str_replace(array('dhe_form_','dhe_','_'), array('','',' '), $shortcode_tag)));
		if ( class_exists( $class_name ) && is_subclass_of( $class_name, 'DHE_Form_ShortCode_Base' ) ) {
			$shortcode_class = new $class_name($shortcode_tag);
		} else {
			$shortcode_class = new DHE_Form_ShortCode_Base($shortcode_tag);
		}
		return $shortcode_class;
	}
	
	protected function output( $atts, $content = null) {
		return $this->content( $atts, $content );
	}
	
	protected function content( $atts, $content = null ){
		return $this->loadTemplate($atts, $content);
	}
	
	protected function loadTemplate($atts, $content){
		$output = '';
		$this->findShortcodeTemplate();
		if ( $this->html_template ) {
			ob_start();
			include( $this->html_template );
			$output = ob_get_contents();
			ob_end_clean();
		} else {
			trigger_error( sprintf( __( 'Template file is missing for `%s` shortcode. Make sure you have `%s` file in your theme folder.', 'dhe-form' ), $this->shortcode, 'wp-content/themes/your_theme/dhe-form/' . $this->shortcode . '.php' ) );
		}
		
		return $output;
	}
	
	protected function setTemplate( $template ) {
		return $this->html_template = $template;
	}
	
	protected function getShortcodesTemplateDir( $template ) {
		return locate_template( 'dhe-form/' . $template );
	}
	
	/**
	 * Find html template for shortcode output.
	 */
	protected function findShortcodeTemplate()
	{
		// Check template in theme directory
		$user_template = $this->getShortcodesTemplateDir($this->getFilename() . '.php');
		
		if (is_file($user_template)) {
			return $this->setTemplate($user_template);
		}
		// Check default place
		$default_dir = DHE_FORM_TEMPLATE_DIR;
		if (is_file($default_dir . $this->getFilename() . '.php')) {
			return $this->setTemplate($default_dir . $this->getFilename() . '.php');
		}
		return '';
	}
	
	protected function getFileName()
	{
		return $this->shortcode;
	}
		
	protected function getControlName($control_name=''){
		return esc_attr(trim($control_name));
	}
	
	protected function getExtraClass( $el_class ) {
		$output = '';
		if ( '' !== $el_class ) {
			$output = ' ' . str_replace( '.', '', $el_class );
		}
	
		return $output;
	}
}

class DHE_Form_Shortcode_Form extends DHE_Form_ShortCode_Base {
	
	protected function enqueue(){
		wp_enqueue_script('dhe-form');
	}
	
    protected function output($atts, $content = null)
    {
        global $dhe_form;
        
        extract(shortcode_atts(array(
            'form_id' => ''
        ), $atts));
        
        $output = '';
        
        if (empty($form_id)){
            return __('No form yet! You should add some...', 'dhe-form');
        }
        
        $form = get_post($form_id);
       
        if (empty($form)){
            return __('No form yet! You should add some...', 'dhe-form');
        }
        
        if(empty($dhe_form)){
        	$dhe_form = $form;
        }
        $method      = 'post';
        $action      = '';
        $action_type = get_post_meta($form->ID, '_action_type', true);
        $form_attr_class = array();
        $form_attr_class[] = 'dheform dheform-'.$form->ID;
        if ($action_type === 'external_url'){
        	$method = get_post_meta($form->ID, '_method', true);
            $action = get_post_meta($form->ID, '_action_url', true);
            $form_attr_class[] = 'dheform-action-external-url';
        }else{
        	$form_attr_class[] = 'dheform-action-default';
        }
        
        if ($form && $form->post_status === 'publish' && apply_filters('dhe_form_display', true, $form->ID)) {
        	
            do_action('dheform_before_render_form', $form);

            $_message_position = get_post_meta($form->ID, '_message_position', true);
            if(dhe_form_has_shortcode($form, 'dhe_form_steps')){
            	$_message_position = 'bottom';
            }
            $output .= '<div id="dheform-' . $form->ID . '"  class="dhe-form-container dhe-form-icon-pos-' . dhe_form_get_elementor_page_settings($form->ID, 'input_icon_position') . ' dhe-form-' . dhe_form_get_elementor_page_settings($form->ID, 'form_layout') . ' dhe-form-flat">' . "\n";
            $use_ajax     = true;
            $form_message = '';
            if(!dhe_form_has_shortcode($form,'dhe_form_response')){
	            $form_message = '<div class="dhe-form-message dhe-form-message-'.$_message_position.'" style="display:none"></div>' . "\n";
            }
            if ($_message_position !== 'bottom') {
                $output .= $form_message;
            }

            $paypal_currency = dhe_form_get_paypal_currency($form->ID);
            $output .= '<form novalidate data-currency="'.esc_attr($paypal_currency).'" data-currency_symbol="'.esc_attr(dhe_form_get_currency_symbol($paypal_currency)).'" data-price_format="'.esc_attr( str_replace( array( '%1$s', '%2$s' ), array( '%s', '%v' ), dhe_form_get_paypal_currency_format($form->ID) ) ).'"   data-scroll_to_msg="' . apply_filters('dhe_form_attr_scroll_to_msg', 1, $form->ID) . '" data-ajax_reset_submit="' . apply_filters('dhe_form_attr_ajax_reset_submit', 1, $form->ID) . '" data-popup="' . (get_post_meta($form->ID, '_form_popup', true) ? '1' : '0') . '" autocomplete="off" data-use-ajax="' . (int) $use_ajax . '" method="' . $method . '" class="'.implode(' ', $form_attr_class).'" enctype="' . apply_filters('dhe_form_attr_enctype', 'multipart/form-data', $form->ID) . '" target="' . apply_filters('dhe_form_attr_target', '_self', $form->ID) . '" ' . (!empty($action) ? ' action="' . $action . '"' : '') . '>' . "\n";
           
            $output .= '<div class="dhe-form-inner">';
            if(\Elementor\Plugin::$instance->preview->is_preview_mode()){
            	$output .= apply_filters('the_content',$form->post_content);
            }else{
            	$output .= \Elementor\Plugin::$instance->frontend->get_builder_content($form->ID);
            }
            
            $output .= '</div>';
            
            if (!\Elementor\Plugin::$instance->preview->is_preview_mode() && !dhe_form_has_submit_shortcode($form)) {      
            	$output .= do_shortcode('[dhe_form_submit_button label="'.__('Submit', 'dhe-form').'"]');          
            }
            if ($_message_position === 'bottom') {
                $output .= $form_message;
            }
            if ($method === 'post') {
            	$output .= '<div style="display: none;">' . "\n";
            	if ($use_ajax) {
            		$output .= '<input type="hidden" name="action" value="dhe_form_ajax">' . "\n";
            	}
            	if ($action_type === 'default') {
            		$form_action = get_post_meta($form->ID, '_form_action', true);
            		if (in_array($form_action, dhe_form_get_actions())) {
            			$output .= '<input type="hidden" name="_dhe_form_action" value="' . $form_action . '">' . "\n";
            		}
            	}
            	if(dhe_form_has_shortcode($form, 'dhe_form_steps')){
	            	$output .= '<input type="hidden" id="_dhe_form_current_step" name="_dhe_form_current_step" value="1">' . "\n";
	            	$output .= '<input type="hidden" id="_dhe_form_steps" name="_dhe_form_steps" value="1">' . "\n";
            	}
            	$output .= '<input type="hidden" id="_dhe_form_hidden_fields" name="_dhe_form_hidden_fields" value="">' . "\n";
            	$output .= '<input type="hidden" name="_dhe_form_id" value="' . $form->ID . '">' . "\n";
            	$output .= '<input type="hidden" name="_dhe_form_url" value="' . esc_attr(dhe_form_get_current_url()) . '">' . "\n";
            	$output .= '<input type="hidden" name="_dhe_form_referer" value="' . esc_attr(dhe_form_get_http_referer()) . '">' . "\n";
            	$output .= '<input type="hidden" name="_dhe_form_post_id" value="' . get_the_ID() . '">' . "\n";
            	$output .= '<input type="hidden" name="_dhe_form_nonce" value="' . wp_create_nonce('dhe-form-' . $form->ID) . '">' . "\n";
            	$output .= '</div>' . "\n";
            }
            $output .= '</form>' . "\n";
            $output .= '</div>' . "\n";
            
            $output .= $this->_edit_form_link($form->ID);
            
            do_action('dheform_after_render_form', $form);
            wp_reset_postdata();
            return apply_filters('dheform_render_form_output', $output, $form);
        }
        return __('No form yet! You should add some...', 'dhe-form');
    }
    
    protected function _edit_form_link($id)
    {
    	if(\Elementor\Plugin::$instance->preview->is_preview_mode()){
    		return;
    	}
        if (!apply_filters('dhe_form_show_edit_form_link', true)){
            return;
        }
        
        if (!$form = get_post($id)){
            return;
        }
        
        
        $action = '&amp;action=edit';
        
        $form_type_object = get_post_type_object($form->post_type);
        if (!$form_type_object){
            return;
        }
        
        if (!current_user_can('edit_dheform', $form->ID)){
            return;
        }
        
        $url  = admin_url(sprintf($form_type_object->_edit_link . $action, $form->ID));
        $link = '<div class="edit-link" style="margin-top: 10px; text-align: right;"><a class="post-edit-link" href="' . $url . '">' . __('Edit Form', 'dhe-form') . '</a></div>';
        return $link;
    }
}

class DHE_Form_Shortcode_Text extends DHE_Form_ShortCode_Base
{
    
}

class DHE_Form_Shortcode_Label extends DHE_Form_ShortCode_Base
{
    
}
class DHE_Form_Shortcode_Rate extends DHE_Form_ShortCode_Base
{
    protected function enqueue(){
    	wp_enqueue_style('bootstrap-tooltip');
    	wp_enqueue_script('bootstrap-tooltip');
    }
}
class DHE_Form_Shortcode_Slider extends DHE_Form_ShortCode_Base
{
    protected function enqueue(){
    	wp_enqueue_script('jquery-ui-slider');
    	wp_enqueue_script('jquery-ui-touch-punch',DHE_FORM_URL.'/assets/js/jquery.ui.touch-punch.min.js');
    }
}
class DHE_Form_Shortcode_Email extends DHE_Form_ShortCode_Base
{
    
}

class DHE_Form_Shortcode_Password extends DHE_Form_ShortCode_Base
{
    protected function loadTemplate($atts, $content = null)
    {
        extract(shortcode_atts(array(
            'confirmation' => '',
            'password_field' => ''
        ), $atts), EXTR_SKIP);
        if (!empty($confirmation) && empty($password_field)){
            return __('Passwords field name to validate match is required', 'dhe-form');
        }
        return parent::loadTemplate($atts, $content);
    }
}

class DHE_Form_Shortcode_Hidden extends DHE_Form_ShortCode_Base
{
	public function output($atts,$content=''){
		$html = parent::output($atts,$content);
		if(\Elementor\Plugin::$instance->editor->is_edit_mode())
			return '<span style="display: block;border: 1px dashed #969696;padding: 5px;">'.__('Hidden Field Widget Placeholder','dhe-form').'</span>'.$html;
		return $html;
	}
}

class DHE_Form_Shortcode_Recaptcha extends DHE_Form_ShortCode_Base
{
	protected function enqueue(){
		dhe_form_recaptcha_enqueue_api_script();
	}
	
    protected function loadTemplate($atts, $content = null)
    {
        $recaptcha_public_key = dhe_form_get_option('recaptcha_public_key', false);
        if (!$recaptcha_public_key) {
            return __('ReCaptcha plugin needs a public key to be set in its parameters. Please contact a site administrator.', 'dhe-form');
        }
        return parent::loadTemplate($atts, $content);
    }
}
class DHE_Form_Shortcode_Captcha extends DHE_Form_ShortCode_Base
{
    
}
class DHE_Form_Shortcode_DateTime extends DHE_Form_ShortCode_Base
{
    protected function enqueue(){
    	wp_enqueue_style('jquery-xdsoft-datetimepicker');
    	wp_enqueue_script('jquery-xdsoft-datetimepicker');
    }
}

class DHE_Form_Shortcode_Color extends DHE_Form_ShortCode_Base
{
    protected function enqueue(){
    	wp_enqueue_script('jquery-minicolors');
    	wp_enqueue_style('jquery-minicolors');
    }
}

class DHE_Form_Shortcode_Radio extends DHE_Form_ShortCode_Base
{
    
}
class DHE_Form_Shortcode_Checkbox extends DHE_Form_ShortCode_Base
{
    
}
class DHE_Form_Shortcode_File extends DHE_Form_ShortCode_Base
{
    
}
class DHE_Form_Shortcode_Select extends DHE_Form_ShortCode_Base
{
    
}
class DHE_Form_Shortcode_Multiple_Select extends DHE_Form_Shortcode_Select
{
    protected function getFileName()
    {
        return 'dhe_form_select';
    }
}
class DHE_Form_Shortcode_Textarea extends DHE_Form_ShortCode_Base
{
    
}

class DHE_Form_Shortcode_Submit_Button extends DHE_Form_ShortCode_Base
{

}

class DHE_Form_Shortcode_Response extends DHE_Form_ShortCode_Base
{
	public function output($atts,$content=''){
		if(\Elementor\Plugin::$instance->editor->is_edit_mode())
			return '<span style="display: block;border: 1px dashed #969696;padding: 5px;">'.__('Response Message Widget Placeholder','dhe-form').'</span>';
		return parent::output($atts,$content);
	}
}

class DHE_Form_Shortcode_Paypal extends DHE_Form_ShortCode_Base
{

}

class DHE_Form_Shortcode_Steps{
	
}

class DHE_Form_Shortcode_Step {
	
}