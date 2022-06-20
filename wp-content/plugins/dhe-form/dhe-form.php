<?php
/*
* Plugin Name: DHEForm
* Plugin URI: http://sitesao.com/
* Description: Easy Form Builder for WordPress with Elementor Page Builder
* Version: 1.0.8
* Author: Sitesao
* Author URI: http://sitesao.com/
* License: License GNU General Public License version 2 or later;
* Copyright 2014  Sitesao
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!defined('DHE_FORM'))
	define('DHE_FORM','dhe-form');

if(!defined('DHE_FORM_VERSION'))
	define('DHE_FORM_VERSION','1.0.8');

if(!defined('DHE_FORM_URL'))
	define('DHE_FORM_URL',untrailingslashit( plugins_url( '/', __FILE__ ) ));

if(!defined('DHE_FORM_DIR'))
	define('DHE_FORM_DIR',untrailingslashit( plugin_dir_path(__FILE__ ) ));

if(!defined('DHE_FORM_TEMPLATE_DIR'))
	define('DHE_FORM_TEMPLATE_DIR',DHE_FORM_DIR .'/templates/');

class DHEForm {
	
	public function __construct(){
		add_action( 'plugins_loaded', array($this,'plugins_loaded'), 9 );
		register_activation_hook(__FILE__,array($this, 'activate'));
	}
	
	public function plugins_loaded(){
		if(!defined('ELEMENTOR_VERSION')){
			add_action('admin_notices', array($this,'notice'));
			return;
		}
		$this->_includes();
		$this->_init_hooks();
		
		add_action( 'init', array( __CLASS__, 'define_ajax' ), 0 );
		add_action( 'template_redirect', array( __CLASS__, 'do_ajax' ), 0 );
	}
	
	public static function define_ajax(){
		if ( ! empty( $_GET['dhe-form-ajax'] ) ) {
			if(!defined('DOING_AJAX')){
				define('DOING_AJAX', true);
			}
			$GLOBALS['wpdb']->hide_errors();
		}
	}
	
	private static function _ajax_headers(){
		if ( ! headers_sent() ) {
			send_origin_headers();
			send_nosniff_header();
			if ( ! defined( 'DONOTCACHEPAGE' ) ) {
				define( 'DONOTCACHEPAGE', true );
			}
			if ( ! defined( 'DONOTCACHEOBJECT' ) ) {
				define( 'DONOTCACHEOBJECT', true );
			}
			if ( ! defined( 'DONOTCACHEDB' ) ) {
				define( 'DONOTCACHEDB', true );
			}
			nocache_headers();
			header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
			header( 'X-Robots-Tag: noindex' );
			status_header( 200 );
		} elseif ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			headers_sent( $file, $line );
			trigger_error( "dhe_form_ajax_headers cannot set headers - headers already sent by {$file} on line {$line}", E_USER_NOTICE );
		}
	}
	
	public static function do_ajax(){
		global $wp_query;
	
		if ( ! empty( $_GET['dhe-form-ajax'] ) ) {
			$wp_query->set( 'dhe-form-ajax', sanitize_text_field( wp_unslash( $_GET['dhe-form-ajax'] ) ) );
		}
	
		$action = $wp_query->get( 'dhe-form-ajax' );
	
		if ( $action ) {
			self::_ajax_headers();
			$action = sanitize_text_field( $action );
			do_action( 'dhe_form_ajax_' . $action );
			wp_die();
		}
	}
	
	private function _includes(){
		
		require_once DHE_FORM_DIR.'/includes/functions.php';
		require_once DHE_FORM_DIR.'/includes/shortcodes.php';
		require_once DHE_FORM_DIR.'/includes/scan_tag.php';
		require_once DHE_FORM_DIR.'/includes/form_actions.php';
		require_once DHE_FORM_DIR.'/includes/assets.php';
		require_once DHE_FORM_DIR.'/includes/db.php';
		require_once DHE_FORM_DIR.'/includes/post_types.php';
		
		require_once DHE_FORM_DIR.'/includes/editor.php';
		
		require_once DHE_FORM_DIR.'/includes/submission.php';
		require_once DHE_FORM_DIR.'/includes/field.php';
		require_once DHE_FORM_DIR.'/includes/paypal.php';
		
		if(is_admin()){
			require_once DHE_FORM_DIR.'/includes/admin.php';
			require_once DHE_FORM_DIR.'/includes/entries.php';
			require_once DHE_FORM_DIR.'/includes/settings.php';
			require_once DHE_FORM_DIR.'/includes/meta_box.php';
		}
	}
	
	private function _init_hooks(){
		
		load_plugin_textdomain( 'dhe-form', false, plugin_basename( DHE_FORM_DIR ) . '/languages' );
		
		add_action('init',array($this,'init'));
		
		add_filter('template_include',array($this,'single_template'),1000);
		
		dhe_form_get_request_uri();
		
		add_action('dhe_form_ajax_submit', array($this,'form_submit'));
		
		add_action( 'elementor/init', array( $this, 'elementor_init' ),20);
	}
	
	public function elementor_init(){
		
		require_once DHE_FORM_DIR.'/includes/widgets/base.php';
		
		require_once DHE_FORM_DIR.'/includes/widgets/form.php';
		add_shortcode('dhe_form', array(DHE_Form_ShortCode_Base::get_instance(),'render'));
		/**
		 * @param \Elementor\Widgets_Manager $widgets_manager
		 */
		add_action( 'elementor/widgets/widgets_registered', function($widgets_manager){
			$widgets_manager->register_widget_type( new DHE_Form_Widget_Form );
		});
		
		add_action('elementor/preview/enqueue_scripts', function() {
			DHE_Form_ShortCode_Base::get_instance()->editor_enqueue('dhe_form');
		},1);
			
		foreach (dhe_form_get_fields() as $shortcode_tag=>$setting){
			$file = DHE_FORM_DIR.'/includes/widgets/'.$setting['file'];
			if ( $file && is_readable( $file ) ) {
				require_once $file;
			}
			/**
			 * @param \Elementor\Widgets_Manager $widgets_manager
			 */
			add_action( 'elementor/widgets/widgets_registered', function($widgets_manager) use($setting){
				$class_name = $setting['widget_class'];
				$widgets_manager->register_widget_type( new $class_name );
			});
			
			add_action('elementor/preview/enqueue_scripts', function() use($shortcode_tag){
				DHE_Form_ShortCode_Base::get_instance()->editor_enqueue($shortcode_tag);
			},1);
			
			add_shortcode($shortcode_tag, array(DHE_Form_ShortCode_Base::get_instance(),'render'));
		}
	}
	
	
	public function init(){
		if(class_exists('WYSIJA')){
			define('DHE_FORM_SUPORT_WYSIJA', true);
		}
		
		if(defined('MYMAIL_DIR')){
			define('DHE_FORM_SUPORT_MYMAIL', true);
		}
		
		if(class_exists('Groundhogg')){
			define('DHE_FORM_SUPORT_GROUNDHOGG', true);
		}
		
		//Custom WP User URL
		add_filter('login_url', array($this,'login_url'));
		add_filter('logout_url', array($this,'logout_url'));
		add_filter('register_url', array($this,'register_url'));
		add_filter('lostpassword_url', array($this,'lostpassword_url'));
		
		if(!is_admin()){
			//Popup Form
			add_action('wp_head', array($this,'get_popup_form'),1);
			add_action( 'wp_footer',array($this,'print_form_popup'), 50 );
		}
	}
	
	public function single_template($template){
		$object = get_queried_object();
		if ( ! empty( $object->post_type ) && 'dheform'===$object->post_type ) {
			return DHE_FORM_DIR.'/includes/editor-templates/single.php';
		}
		return $template;
	}
	
	public function notice(){
		echo '<div class="updated">
			    <p>' . sprintf('<strong>%s</strong> requires <strong><a href="https://wordpress.org/plugins/elementor/" target="_blank">Elementor Page Builder</a></strong> plugin  to be installed and activated on your site.', 'dhe-form') . '</p>
			  </div>';
	}
	
	
	public function form_submit(){
		if ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && 'XMLHttpRequest' !== $_SERVER['HTTP_X_REQUESTED_WITH'] && $_SERVER['REQUEST_METHOD'] !== 'POST' )
			die(0);
		
		$submission = DHE_Form_Submission::get_instance(true);
		$result = array(
			'form_id' => $submission->get_form_id(),
			'status' => $submission->get_status(),
			'message' => $submission->get_response()
		);
		if ( $submission->is( 'validation_failed' ) ) {
			$result['invalid_fields'] = $submission->get_invalid_fields();
			
		}
		if($submission->is('success')){

			if('refresh'==$submission->get_on_success_action())
				$result['refresh'] = 1;
			elseif( $redirect = $submission->get_redirect_url())
				$result['redirect'] = $redirect;
			
			if($on_ok = $submission->get_on_ok())
				$result['onOk']  = $on_ok;
		}
		do_action( 'dhe_form_submit', $result, $submission);
		$response = apply_filters( 'dhe_form_ajax_json_echo', $result, $submission );
		wp_send_json($response);
		die();
	}
	
	public function activate(){
		if(!class_exists('DHE_Form_DB'))
			require_once DHE_FORM_DIR.'/includes/db.php';
		global $dheform_db;
		$this->_create_roles();
		$dheform_db->create_table();
		$this->_create_upload_dir();
		flush_rewrite_rules();
	}
	
	private function _create_upload_dir(){
		$upload_dir = wp_upload_dir();
		$dir = $upload_dir['basedir'] . '/dheform';
		wp_mkdir_p($dir);
	}
	
	private function _create_roles(){
		global $wp_roles;
	
		if ( class_exists( 'WP_Roles' ) ) {
			if ( ! isset( $wp_roles ) ) {
				$wp_roles = new WP_Roles();
			}
		}
	
		if ( is_object( $wp_roles ) ) {
	
			$capability = array(
				"edit_dheform",
				"read_dheform",
				"delete_dheform",
				"edit_dheforms",
				"edit_others_dheforms",
				"publish_dheforms",
				"read_private_dheforms",
				"delete_dheforms",
				"delete_private_dheforms",
				"delete_published_dheforms",
				"delete_others_dheforms",
				"edit_private_dheforms",
				"edit_published_dheforms",
			);
			foreach ( $capability as $cap ) {
				$wp_roles->add_cap( 'administrator', $cap );
			}
		}
	}
	
	private function _remove_roles(){
		global $wp_roles;
	
		if ( class_exists( 'WP_Roles' ) ) {
			if ( ! isset( $wp_roles ) ) {
				$wp_roles = new WP_Roles();
			}
		}
	
		if ( is_object( $wp_roles ) ) {
	
			$capability = array(
				"edit_dheform",
				"read_dheform",
				"delete_dheform",
				"edit_dheforms",
				"edit_others_dheforms",
				"publish_dheforms",
				"read_private_dheforms",
				"delete_dheforms",
				"delete_private_dheforms",
				"delete_published_dheforms",
				"delete_others_dheforms",
				"edit_private_dheforms",
				"edit_published_dheforms",
			);
			foreach ( $capability as $cap ) {
				$wp_roles->remove_cap( 'administrator', $cap );
			}
		}
	}
	
	public function login_url($login_url){
		$user_login = dhe_form_get_option('user_login');
		if($user_login){
			$login_url = get_permalink($user_login);
		}
		return $login_url;
	}
	
	public function register_url($register_url){
		$user_regiter = dhe_form_get_option('user_regiter');
		if($user_regiter){
			$register_url = get_permalink($user_regiter);
		}
		return $register_url;
	}
	
	public function logout_url($logout_url,$redirect=''){
		$user_logout = dhe_form_get_option('user_logout_redirect_to');
		$args = array();
		if($user_logout){
			$redirect_to = get_permalink($user_logout);
			$args['redirect_to'] = urlencode( $redirect_to );
		}
		return add_query_arg($args, $logout_url);
	}
	
	public function lostpassword_url($lostpassword_url){
		$user_forgotten = dhe_form_get_option('user_forgotten');
		if($user_forgotten){
			$lostpassword_url = get_permalink($user_forgotten);
		}
		return $lostpassword_url;
	}
	
	public function get_popup_form(){
		global $dhe_form_popup;
		
		if(\Elementor\Plugin::$instance->preview->is_preview_mode()){
			return;
		}
		
		$args = array(
			'post_type'=>'dheform',
			'posts_per_page'=> -1,
			'post_status'=>'publish',
			'meta_query' => array(
				array(
					'key' => '_form_popup',
					'value' => '1'
				)
			)
		);
		$form = new WP_Query($args);
		$popup = array();
		if($form->have_posts()):
		
			//enqueue cookie
			wp_enqueue_script('js-cookie');
		
			while ($form->have_posts()):
				$form->the_post(); global $post;
			
				$auto_open = get_post_meta($post->ID,'_form_popup_auto_open',true);
			
				$one = get_post_meta($post->ID,'_form_popup_one',true);
				$close = get_post_meta($post->ID,'_form_popup_auto_close',true);
				$title = get_post_meta($post->ID,'_form_popup_title',true);
				$data_attr = '';
				if(!empty($auto_open)){
					$data_attr = 'data-auto-open="1" data-open-delay="'.absint(get_post_meta($post->ID,'_form_popup_auto_open_delay',true)).'" '.(!empty($one) ? 'data-one-time="1"' : 'data-one-time="0"').' '.(!empty($close ) ? 'data-auto-close="1" data-close-delay="'.absint(get_post_meta($post->ID,'_form_popup_auto_close_delay',true)).'"':'data-auto-close="0"');
				}
				$popup[] = '<div id="dheformpopup-'.$post->ID.'" data-id="'.$post->ID.'" class="dhe-form-popup" '.$data_attr.' style="display:none">';
				$popup[] = '<div class="dhe-form-popup-container" style="width:'.absint(get_post_meta($post->ID,'_form_popup_width',true)).'px">';
				
				if(!empty($title)){
					$popup[] = '<div class="dhe-form-popup-header has-title">';
					$popup[] = '<h3>'.get_the_title($post->ID).'</h3>';
				}else{
					$popup[] = '<div class="dhe-form-popup-header">';
				}
				$popup[] = '<a class="dhe-form-popup-close"></a>';
				$popup[] = '</div>';
				$popup[] = '<div class="dhe-form-popup-body">';
				$popup[] = do_shortcode('[dhe_form form_id="'.$post->ID.'"]');
				$popup[] = '</div>';
				$popup[] = '</div>';
				$popup[] = '</div>';
			endwhile;
		endif;
		$dhe_form_popup = implode("\n", $popup);
		if(!empty($popup)){
			$dhe_form_popup .= '<div class="dhe-form-pop-overlay"></div>';
		}
		wp_reset_postdata();
	}
	
	public function print_form_popup(){
		global $dhe_form_popup;
		if(\Elementor\Plugin::$instance->preview->is_preview_mode()){
			return;
		}
		if(!empty($dhe_form_popup)){
			echo $dhe_form_popup;
		}
	}
	
}
new DHEForm();