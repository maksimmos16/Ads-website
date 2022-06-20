<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class DHE_Form_Assets {
	
	public static function init(){
		if(is_admin()){
			add_action('admin_init', array( __CLASS__, 'register_assets' ));
		}else{
			add_action( 'template_redirect', array( __CLASS__, 'register_assets' ) );
			add_action( 'template_redirect', array( __CLASS__, 'frontend_scripts' ) );
			add_action('wp_enqueue_scripts', array(__CLASS__, 'frontend_enqueue_assets'));
		}
	}
	
	public static function register_assets(){
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		
		wp_register_script('jquery-blockui',DHE_FORM_URL.'/assets/js/jquery.blockUI.min.js',array('jquery'),'2.70',true);
		
		wp_register_style('jquery-xdsoft-datetimepicker',DHE_FORM_URL.'/assets/datetimepicker/jquery.datetimepicker.css', array(),'2.2.9');
		wp_register_script('jquery-xdsoft-datetimepicker',DHE_FORM_URL.'/assets/datetimepicker/jquery.datetimepicker'.$suffix.'.js',array('jquery'),'2.4.6',true);
		
		wp_register_style('jquery-minicolors',DHE_FORM_URL.'/assets/minicolors/jquery.minicolors'.$suffix.'.css', array(),'2.1');
		wp_register_script('jquery-minicolors',DHE_FORM_URL.'/assets/minicolors/jquery.minicolors'.$suffix.'.js',array('jquery'),'2.1',true);
	
		wp_register_style('bootstrap-tooltip',DHE_FORM_URL.'/assets/css/bootstrap-tooltip.css', array(),'3.2.0');
		wp_register_script('bootstrap-tooltip',DHE_FORM_URL.'/assets/js/bootstrap-tooltip.js',array('jquery'),'3.2.0',true);

		wp_register_script('js-cookie',DHE_FORM_URL.'/assets/js/js.cookie.min.js',array(),'2.1.4',true);		
		
	}
	
	public static function frontend_scripts(){
		
		wp_register_style('dhe-form',DHE_FORM_URL.'/assets/css/style.css', array(), DHE_FORM_VERSION);
		wp_register_script('dhe-form',DHE_FORM_URL.'/assets/js/script.min.js',array('jquery'),DHE_FORM_VERSION,true);
		
		$dhe_form_params = array(
			'ajax_url'=>admin_url( 'admin-ajax.php', 'relative' ),
			'ajax_submit_url'=> add_query_arg( 'dhe-form-ajax', 'submit',  home_url( '/', 'relative' ) ),
			'plugin_url'=>DHE_FORM_URL,
			'recaptcha_public_key'=>dhe_form_get_option('recaptcha_public_key'),
			'_ajax_nonce'=>wp_create_nonce( 'dhe_form_ajax_nonce' ),
			'date_format'=>dhe_form_get_option('date_format','Y/m/d'),
			'time_format'=>dhe_form_get_option('time_format','H:i'),
			'time_picker_step'=>dhe_form_get_option('time_picker_step',60),
			'dayofweekstart'=>apply_filters('dhe_form_dayofweekstart',1),
			'datetimepicker_lang'=>dhe_form_get_option('datetimepicker_lang','en'),
			'container_class'=>dhe_form_get_option('container_class','.elementor-column-wrap'),
			'is_edit_mode'=> \Elementor\Plugin::$instance->editor->is_edit_mode() ? 'yes':'no',
			'is_preview_mode'=> \Elementor\Plugin::$instance->preview->is_preview_mode() ? 'yes':'no'
		);
		
		wp_localize_script('dhe-form', 'dhe_form_params', $dhe_form_params);
	}
	
	public static function frontend_enqueue_assets(){
		wp_enqueue_style('dhe-form');
	}
}

DHE_Form_Assets::init();