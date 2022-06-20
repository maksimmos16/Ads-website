<?php
/**
* Class and Function List:
* Function list:
* - init()
* - constants()
* - widgets()
* - supports()
* - functions()
* - language()
* - add_metaboxes()
* - admin()
* - post_types()
* - pacz_theme_enqueue_scripts()
* - pacz_preloader_script() 
*/
function classiadspro_load_textdomain() {
    load_theme_textdomain( 'classiadspro', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'classiadspro_load_textdomain' );
$theme = new Classiadspro_Theme();
$theme->init(array(
		"theme_name" => "Classiadspro",
		"theme_slug" => "classiadspro",
));

class Classiadspro_Theme
{
		function init($options)
		{
				$this->pacz_constants($options);
				$this->pacz_functions();
				$this->pacz_admin();
				
				add_action('init', array(&$this,
						'pacz_add_metaboxes',
				));
				
				add_action('after_setup_theme', array(&$this,
						'pacz_supports',
				));
				add_action('after_setup_theme', array(&$this,
						'pacz_settings',
				));
		}
		function pacz_settings()
		{
			global $pacz_settings;
			if(class_exists('Classiadspro_Core')){
				$pacz_settings = get_option('pacz_settings');
			}else{
				
				$data = '{"last_tab":"","grid-width":"1170","content-width":"67","pages-layout":"right","error_page":"1","error-layout":"full","error_page_small_text":"Far far away, behind the word mountains, far from the countries Vokalia and there live the blind texts. Sepraed. they live in Boo marksgrove right at the coast of the Semantics, a large language ocean A small river named Duden flows by their place and su plies it.","search-layout":"full","breadcrumb":"1","smooth-scroll":"1","pages-comments":"0","custom-sidebar":[],"typekit-id":"","main-nav-top-color":{"regular":"#222222","hover":"#ec5319","bg":"","bg-hover":"#ffffff","bg-active":""},"main-nav-top-color-transparent":{"regular":"#fff","hover":"#c32026","bg":"","bg-hover":"","bg-active":""},"main-nav-sub-bg":"#FFFFFF","main-nav-sub-color":{"regular":"#222222","hover":"#ec5319","bg":"","bg-hover":"#f1f1f1","bg-active":""},"navigation-border-top":"1","toolbar-border-top":"1","toolbar-border-bottom-color":"#EEEEEE","toolbar-text-color":"#666666","toolbar-phone-email-icon-color":"#FFFFFF","toolbar-link-color":{"regular":"#666666","hover":"#73cf42"},"toolbar-social-link-color":{"regular":"#ffffff","hover":"#73cf42","bg":"","bg-hover":""},"toolbar-social-link-color-bg":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"header-search-icon-color":"#222222","header_cart_link_color":{"regular":"#ffffff","hover":"#ffffff","bg":"#c32026","bg-hover":"#c32026"},"listing-header-btn-color":{"regular":"#ffffff","hover":"#ffffff","bg":"#ec5319","bg-hover":"#15a949"},"listing-header-btn-color-transparent":{"regular":"#ffffff","hover":"#fff","bg":"#3d51b2","bg-hover":"#77c04b"},"header_listing_button_border_color":{"color":"","alpha":"1","rgba":"rgba(0,0,0,1)"},"header_listing_button_border_color_transparent":{"color":"","alpha":"1","rgba":"rgba(0,0,0,1)"},"header_listing_button_border_color_hover":{"color":"","alpha":"1","rgba":"rgba(0,0,0,1)"},"header_listing_button_border_color_hover_transparent":{"color":"","alpha":"1","rgba":"rgba(0,0,0,1)"},"header-contact-select":"header_toolbar","header-contact-align":"right","header-toolbar-phone":"","header-toolbar-phone-icon":"","header-toolbar-email":"","header-toolbar-email-icon":"","header-social-select":"disabled","header-social-align":"left","header-social-facebook":"","header-social-twitter":"","header-social-rss":"","header-social-dribbble":"","header-social-pinterest":"","header-social-instagram":"","header-social-google-plus":"","header-social-linkedin":"","header-social-youtube":"","header-social-vimeo":"","header-social-spotify":"","header-social-tumblr":"","header-social-behance":"","header-social-WhatsApp":"","header-social-qzone":"","header-social-vkcom":"","header-social-imdb":"","header-social-renren":"","header-social-weibo":"","pacz-logreg-header-btn":"1","pacz-login-slug":"login","pacz-register-slug":"register","pacz-forgot-slug":"forget-password","header-login-reg-location":"header_section","pacz-logreg-style":"2","log-reg-btn-align":"right","header-toolbar":"0","toolbar-grid":"0","toolbar-custom-menu":"","header-logo-location":"header_section","header-logo-align":"left","logo_dimensions":{"width":"","height":"","units":"px"},"logo":{"url":"https:\/\/classiads.designinvento.net\/elementor\/classiads-ultra\/wp-content\/uploads\/2018\/07\/logo.png","id":"2665","height":"43","width":"189","thumbnail":"https:\/\/classiads.designinvento.net\/elementor\/classiads-ultra\/wp-content\/uploads\/2018\/07\/logo-150x43.png"},"transparent-logo":{"url":"","id":"","height":"","width":"","thumbnail":""},"logo-retina":{"url":"https:\/\/classiads.designinvento.net\/elementor\/classiads-ultra\/wp-content\/uploads\/2018\/07\/logo.png","id":"2665","height":"43","width":"189","thumbnail":"https:\/\/classiads.designinvento.net\/elementor\/classiads-ultra\/wp-content\/uploads\/2018\/07\/logo-150x43.png"},"transparent-logo-retina":{"url":"","id":"","height":"","width":"","thumbnail":""},"listing-btn-location":"header_section","listing-btn-align":"right","listing-btn-text":"Post Your Ad","listing_button_padding":{"units":"px","padding-top":"","padding-right":"","padding-bottom":"","padding-left":""},"listing_button_border_width":"0","search_keyword_field":"1","search_keyword_ajax_field":"1","search_keyword_categories_field":"1","search_address_field":"1","search_address_locations_field":"1","search_button_icon":"fas fa-search-plus","listing_button_border_radius":{"units":"px","padding-top":"","padding-right":"","padding-bottom":"","padding-left":""},"header-bg":{"background-color":"#ffffff","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"theader-bg":{"color":"","alpha":"1","rgba":"rgba(0,0,0,1)"},"header-bottom-border":"","header_shadow":"1","toolbar-bg":{"background-color":"#ffffff","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"res-nav-width":"1170","preset_headers":"11","_header_style":"block_module","preset_headers_skin":"","header-structure":"standard","header-location":"top","vertical-header-state":"expanded","header-vertical-width":"280","header-padding":"30","header-padding-vertical":"30","header-align":"left","nav-alignment":"right","boxed-header":"1","header-grid":"0","header-grid_postion":"","header-grid-margin-top":"0","_header_search_form":"0","toolbar_height":"100","sticky-header":"1","squeeze-sticky-header":"1","sticky_header_offset":"0","header-hover-style":"","header-border-top":"0","header-search":"0","header-search-location":"right","header-wpml":"0","page-title-pages":"1","loggedin_menu":"primary-menu","mobile-header-bg":{"background-color":"#ffffff","background-repeat":"repeat","background-size":"","background-attachment":"scroll","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"mobile-logo":{"url":"https:\/\/classiads.designinvento.net\/elementor\/classiads-ultra\/wp-content\/uploads\/2018\/07\/logo.png","id":"2665","height":"43","width":"189","thumbnail":"https:\/\/classiads.designinvento.net\/elementor\/classiads-ultra\/wp-content\/uploads\/2018\/07\/logo-150x43.png"},"mobile-logo-retina":{"url":"https:\/\/classiads.designinvento.net\/elementor\/classiads-ultra\/wp-content\/uploads\/2018\/07\/logo.png","id":"2665","height":"43","width":"189","thumbnail":"https:\/\/classiads.designinvento.net\/elementor\/classiads-ultra\/wp-content\/uploads\/2018\/07\/logo-150x43.png"},"mobile-listing-button":"1","mobile-listing-button-skin":{"regular":"#1c1e21","hover":"#fff","bg":"#F2F3F5","bg-hover":"#f35359"},"mobile-listing-button-icon":"fas fa-plus","mobile-login-button":"1","mobile-login-button-skin":{"regular":"#1c1e21","hover":"#fff","bg":"#F2F3F5","bg-hover":"#f35359"},"mobile-login-button-icon":"far fa-user","mobile-search-button":"1","mobile-search-button-skin":{"regular":"#1c1e21","hover":"#fff","bg":"#F2F3F5","bg-hover":"#f35359"},"mobile-search-button-icon":"fas fa-search","mobile-header-author-bg":{"background-color":"#15a949","background-repeat":"repeat","background-size":"","background-attachment":"scroll","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"mobile-header-author-display-name-color":"#333333","mobile-header-author-nickname-color":"#FFFFFF","mobile-header-author-links-color":{"regular":"#393c71","hover":"#393c71"},"mobile-header-menu-icon-color":{"regular":"#1c1e21","hover":"#f35359","active":"#f35359"},"mobile-header-menu-wrapper-bg":{"background-color":"#fff","background-repeat":"repeat","background-size":"","background-attachment":"scroll","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"mobile-nav-top-color":{"regular":"#333333","hover":"#c32026","bg":"#fff","bg-hover":"","bg-active":""},"mobile-top-menu-border-color":"#EEEEEE","mobile-nav-sub-menu-color":{"regular":"#333","hover":"#fff","bg":"#f5f5f5","bg-hover":"#555","bg-active":"#333"},"footer":"1","footer-layout":"third_sub_fourth","top-footer":"1","footer_form_style":"4","footer_top_logo":{"url":"https:\/\/classiads.designinvento.net\/elementor\/classiads-ultra\/wp-content\/uploads\/2018\/07\/logo.png","id":"2665","height":"43","width":"189","thumbnail":"https:\/\/classiads.designinvento.net\/elementor\/classiads-ultra\/wp-content\/uploads\/2018\/07\/logo-150x43.png"},"form_id":"3848","footer_mailchimp_listid":"http:\/\/designsvilla.us10.list-manage.com\/subscribe\/post?u=8d6fd5258003daa5d449677a9&id=fb984af59f","sub-footer":"1","back-to-top":"1","back_to_top_style":"4","footer_sell_btn":"1","sell_btn_text":"Sell","footer-copyright":"All Copyrights reserved @ 2021 - Design by Designinvento","subfooter-logos-src":{"url":"","id":"","height":"","width":"","thumbnail":""},"subfooter-logos-link":"","footer-social-location":"3","social-facebook":"#","social-twitter":"#","social-rss":"","social-dribbble":"#","social-pinterest":"","social-instagram":"","social-google-plus":"","social-linkedin":"#","social-youtube":"#","social-vimeo":"","social-spotify":"","social-tumblr":"","social-behance":"","social-whatsapp":"","social-wechat":"","social-qzone":"","social-vkcom":"","social-imdb":"","social-renren":"","social-weibo":"","body-font":{"font-family":"Roboto","font-options":"","google":"1","font-backup":"","font-weight":"400","font-style":"","subsets":"","text-align":"","font-size":"14px"},"heading-font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"latin","text-align":""},"heading-font-h2":{"font-family":"","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":""},"heading-font-h3":{"font-family":"","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":""},"heading-font-h4":{"font-family":"","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":""},"heading-font-h5":{"font-family":"","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":""},"heading-font-h6":{"font-family":"","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"","text-align":""},"widget-title":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"700","font-style":"","subsets":"latin","text-align":"","font-size":"18px"},"page-title-size":"36","p-text-size":"14","p-line-height":"26","footer-p-text-size":"14","main-nav-font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"500","font-style":"","text-align":"","font-size":"14px"},"main-nav-item-space":"15","vertical-nav-item-space":"0","main-nav-top-transform":"capitalize","sub-nav-top-size":"12","sub-nav-top-transform":"capitalize","sub-nav-top-weight":"normal","toolbar-font":{"font-family":"Roboto","font-options":"","google":"1","font-weight":"400","font-style":"","text-align":"","font-size":"14px"},"typekit-font-family":"","typekit-element-names":"","accent-color":"#15A949","body-txt-color":"#888888","heading-color":"#333333","link-color":{"regular":"#888888","hover":"#15a949","active":"#15a949"},"page-title-color":"#FFFFFF","sidebar-title-color":"#333333","sidebar-txt-color":"#888888","sidebar-link-color":{"regular":"#888888","hover":"#15a949","active":""},"footer-title-color":"#FFFFFF","footer-txt-color":"#888888","footer-link-color":{"regular":"#888888","hover":"#15a949","active":""},"footer-recent-lisitng-border-color":"transparent","sub-footer-border-top":"1","sub-footer-border-top-color":{"color":"#ffffff","alpha":"0.1","rgba":"rgba(255,255,255,0.1)"},"footer-col-border":"0","footer-col-border-color":"#EEEEEE","footer-social-color":{"regular":"#ffffff","hover":"#ffffff","bg":"rgba(255, 255, 255, 0.1)","bg-hover":"#15a949"},"footer-socket-color":"#888888","btn-hover":"#EC5319","subs-btn-hover":"#EC5319","breadcrumb-skin":"light","breadcrumb-skin-custom":{"regular":"#ffffff","hover":"#ffffff"},"custom-css":".user-panel-main .sidebar-menu li {\r\n    border-bottom: none;\r\n}\r\n.cat-style-8 .directorypress-category-item {\r\n    width: 100%;\r\n}\r\n.author-active {\r\n    position: absolute;\r\n    bottom: 0;\r\n    right: 0;\r\n}","custom-js":"jQuery(document).ready(function(){});","preloader-bg-color":"#FFFFFF","preloader-logo":{"url":"","id":"","height":"","width":"","thumbnail":""},"body-layout":"full","body-bg":{"background-color":"#d3d3d3","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"main-searchbar-bg-color":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"main-searchbar-border-color":"transparent","page-title-bg":{"background-color":"#1c2431","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"page-bg":{"background-color":"#e4e4e4","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"footer-bg":{"background-color":"#201932","background-repeat":"","background-size":"","background-attachment":"","background-position":"","background-image":"","media":{"id":"","height":"","width":"","thumbnail":""}},"sub-footer-bg":"#201932","top-footer-bg":"#F9F9F9","page-title-blog":"1","blog-featured-image":"1","blog-image-crop":"1","blog-single-image-height":"380","blog-single-about-author":"1","blog-single-social-share":"1","blog-single-comments":"1","archive-layout":"right","archive-columns":"1","archive-loop-style":"classic","archive-page-title":"1","woo-shop-layout":"full","woo-shop-columns":"3","woo-loop-thumb-height":"270","woo_loop_image_size":"crop","woo-single-thumb-height":"480","woo_single_image_size":"crop","woo-single-layout":"full","woo-single-related-columns":"3","checkout-box":"0","checkout-box-location":"disabled","checkout-box-align":"right","woo-image-quality":"1","woo-single-title":"1","woo-single-show-title":"1","woo-shop-loop-title":"1","remove-js-css-ver":"1","typekit-info":"","redux-backup":1}';
				$pacz_settings = json_decode($data, true);
			}
			
		}
		function pacz_constants($options)
		{		$theme_data = wp_get_theme("classiadspro");
				$pacz_parent_theme = get_file_data(
					get_template_directory() . '/style.css',
					array( 'Asset Version' ),
					get_template()
				);
				define("PACZ_THEME_DIR", get_template_directory());
				define("PACZ_THEME_DIR_URI", get_template_directory_uri());
				define("PACZ_THEME_NAME", $options["theme_name"]);
				define("PACZ_THEME_VERSION", $theme_data['Version']);
				define("CLASSIADSPRO_THEME_OPTIONS_BUILD", $options["theme_name"] . '_options_build');
				define("PACZ_THEME_SLUG", $options["theme_slug"]);
				define("PACZ_THEME_STYLES_DYNAMIC", PACZ_THEME_DIR_URI . "/styles/dynamic");
				define("PACZ_THEME_STYLES", PACZ_THEME_DIR_URI . "/styles/css");
				define("PACZ_THEME_IMAGES", PACZ_THEME_DIR_URI . "/images");
				define("PACZ_THEME_JS", PACZ_THEME_DIR_URI . "/js");
				define("PACZ_THEME_INCLUDES", PACZ_THEME_DIR . "/includes");
				define("PACZ_THEME_FRAMEWORK", PACZ_THEME_INCLUDES . "/framework");
				define("PACZ_THEME_ACTIONS", PACZ_THEME_INCLUDES . "/actions");
				define("PACZ_THEME_PLUGINS_CONFIG", PACZ_THEME_INCLUDES . "/plugins-config");
				define("PACZ_THEME_PLUGINS_CONFIG_URI", PACZ_THEME_DIR_URI . "/includes/plugins-config");
				define('PACZ_THEME_METABOXES', PACZ_THEME_FRAMEWORK . '/metaboxes');
				define('PACZ_THEME_ADMIN_URI', PACZ_THEME_DIR_URI . '/includes');
				define('PACZ_THEME_ADMIN_ASSETS_URI', PACZ_THEME_DIR_URI . '/includes/assets');
				define( 'THEME_VERSION', $pacz_parent_theme[0] );
				define("PACZ_THEME_SETTINGS", 'classiads_settings');
				define("PACZ_THEME_DASHBOARD_STRING", esc_attr__( 'Classiads Dashboard', 'classiadspro' ));
				define( 'PACZ_THEME_CONTROL_PANEL', PACZ_THEME_FRAMEWORK . '/pacz-panel' );
				define( 'PACZ_THEME_CONTROL_PANEL_URI', PACZ_THEME_DIR_URI . '/includes/framework/pacz-panel' );
		
		}
		
		function pacz_supports()
		{
				global $pacz_settings;
				$content_width = '';
				if (!isset($content_width)) {
						$content_width = $pacz_settings['grid-width'];
				}
				
				if (function_exists('add_theme_support')) {
						add_theme_support('automatic-feed-links');
						add_theme_support('editor-style');
						add_theme_support( 'title-tag' );
						add_theme_support( 'custom-header' );
						add_theme_support( 'custom-background' );
						add_theme_support( 'wc-product-gallery-zoom' );
						add_theme_support( 'wc-product-gallery-lightbox' );
						add_theme_support( 'wc-product-gallery-slider' );
						/* Add Woocmmerce support */
						add_theme_support('woocommerce');
						
						add_theme_support('post-formats', array(
								'image',
								'video',
								'quote',
								'link'
						));
						register_nav_menus(array(
								'primary-menu' => 'Primary Navigation',
								'second-menu' => 'Second Navigation',
								'third-menu' => 'Third Navigation',
								'fourth-menu' => 'Fourth Navigation',
								'fifth-menu' => 'Fifth Navigation',
								'sixth-menu' => 'Sixth Navigation',
								'seventh-menu' => 'Seventh Navigation',
						));
						
						add_theme_support('post-thumbnails');
				}
		}
		
		function pacz_functions()
		{
				
				require_once PACZ_THEME_FRAMEWORK . "/general.php";
				if(class_exists('Classiadspro_Core')){
					require_once PACZ_THEME_FRAMEWORK . "/options-config.php";
				}
				require_once PACZ_THEME_FRAMEWORK . "/woocommerce.php";
				require_once PACZ_THEME_PLUGINS_CONFIG . "/ajax-search.php";
				require_once PACZ_THEME_PLUGINS_CONFIG . "/wp-nav-custom-walker.php";
				require_once PACZ_THEME_FRAMEWORK . '/sidebar-generator.php';
				require_once PACZ_THEME_PLUGINS_CONFIG . "/pagination.php";
				require_once PACZ_THEME_PLUGINS_CONFIG . "/image-cropping.php";
				require_once PACZ_THEME_PLUGINS_CONFIG . "/tgm-plugin-activation/request-plugins.php";

				
				require_once PACZ_THEME_PLUGINS_CONFIG . "/love-this.php";
				require_once PACZ_THEME_INCLUDES . "/thirdparty-integration/wpml-fix/pacz-wpml.php";
				require_once PACZ_THEME_DIR . "/directorypress/functions.php";
				/*
				Theme elements hooks
				*/
				require_once (trailingslashit( get_template_directory() )."includes/actions/header.php");
				require_once (trailingslashit( get_template_directory() )."includes/actions/posts.php");
				require_once (trailingslashit( get_template_directory() )."includes/actions/general.php");
				
				/* Blog Styles @since V1.0 */
				require_once (trailingslashit( get_template_directory() )."includes/custom-post/blog-styles/classic.php");
				
				/* Blog Styles @since V1.0 */
				require_once (trailingslashit( get_template_directory() )."includes/custom-post/blog-styles/thumb.php");
				require_once (trailingslashit( get_template_directory() )."includes/custom-post/blog-styles/tile.php");
				require_once (trailingslashit( get_template_directory() )."includes/custom-post/blog-styles/tile-elegant.php");
				require_once (trailingslashit( get_template_directory() )."includes/custom-post/blog-styles/tile-modern.php");
				require_once (trailingslashit( get_template_directory() )."includes/custom-post/blog-styles/scroller.php");
				require_once (trailingslashit( get_template_directory() )."includes/custom-post/blog-styles/masonry.php");
				
		}
		
		
		function pacz_add_metaboxes()
		{
				require_once PACZ_THEME_FRAMEWORK . '/metabox-generator.php';
				require_once PACZ_THEME_METABOXES . '/metabox-layout.php';
				require_once PACZ_THEME_METABOXES . '/metabox-posts.php';
				require_once PACZ_THEME_METABOXES . '/metabox-employee.php';
				require_once PACZ_THEME_METABOXES . '/metabox-pages.php';
				require_once PACZ_THEME_METABOXES . '/metabox-clients.php';
				require_once PACZ_THEME_METABOXES . '/metabox-testimonials.php';
				include_once PACZ_THEME_METABOXES . '/metabox-skinning.php';
		}
		
		function pacz_admin()
		{
				if (is_admin()) {
						
						require_once PACZ_THEME_FRAMEWORK . '/admin.php';
						require_once PACZ_THEME_PLUGINS_CONFIG . '/mega-menu.php';
						require_once PACZ_THEME_CONTROL_PANEL . "/pacz-admin.php";
						require_once PACZ_THEME_FRAMEWORK . '/pacz-panel/index.php';
						
				}
		}
		
		
		
}

function pacz_theme_enqueue_scripts()
{
		if (!is_admin()) {
				
				global $pacz_settings;
				$theme_data = wp_get_theme("classiadspro");
				
				wp_enqueue_script('jquery-ui-tabs');
				wp_register_script('jquery-jplayer', PACZ_THEME_JS . '/jquery.jplayer.min.js', array(
						'jquery'
				) , $theme_data['Version'], true);
				wp_register_script('instafeed', PACZ_THEME_JS . '/instafeed.min.js', array(
						'jquery'
				) , $theme_data['Version'], true);
				if ( ! wp_script_is( 'bootstrap', 'enqueued' ) ) {
					wp_enqueue_script('bootstrap', PACZ_THEME_JS . '/bootstrap.min.js', array(
							'jquery'
					) , $theme_data['Version'], true);
				}
				wp_enqueue_script('masonry', PACZ_THEME_JS . '/masonry.pkgd.min.js', array(
						'jquery'
				) , $theme_data['Version'], true);
				//if ( ! wp_script_is( 'select2', 'enqueued' ) ) {
				wp_enqueue_script('select2', PACZ_THEME_JS . '/select2.min.js', array(
						'jquery'
				) , $theme_data['Version'], true);
				//}
				wp_enqueue_script('slick-js', PACZ_THEME_JS . '/slick.min.js', array(
						'jquery'
				) , $theme_data['Version'], true);
				
				wp_enqueue_script('pacz-theme-plugins', PACZ_THEME_JS . '/plugins.min.js', array(
						'jquery'
				) , $theme_data['Version'], true);
				wp_enqueue_script('pacz-theme-scripts', PACZ_THEME_JS . '/theme-scripts.js', array(
						'jquery'
				) , $theme_data['Version'], true);
				wp_enqueue_script('pacz-slick-triger', PACZ_THEME_JS . '/triger.min.js', array(
						'jquery'
				) , $theme_data['Version'], true);
				$custom_js_file = get_stylesheet_directory() . '/custom.js';
				$custom_js_file_uri = get_stylesheet_directory_uri() . '/custom.js';
				
				if (file_exists($custom_js_file)) {
						wp_enqueue_script('pacz-custom-js', $custom_js_file_uri, array(
								'jquery'
						) , $theme_data['Version'], true);
				}
				
				if (is_singular()) {
						wp_enqueue_script('comment-reply');
				}
				global $pacz_settings, $pacz_accent_color, $post, $classiadspro_json,$level_num,$uID;
				$post_id = global_get_post_id();
				$pacz_header_trans_offset = (!empty(get_post_meta($post_id, '_trans_header_offset', true ))) ? get_post_meta($post_id, '_trans_header_offset', true ) : $pacz_settings['sticky_header_offset'];
				$rtl = (is_rtl())? 'true':'false';
				wp_localize_script(
					'pacz-theme-scripts',
					'pacz_js',
					array(
						'pacz_images_dir' => PACZ_THEME_IMAGES,
						'pacz_theme_js_path' => PACZ_THEME_JS,
						'pacz_header_toolbar' => (get_post_meta( $post_id, '_header_toolbar', true ) =='true') ?  get_post_meta( $post_id, '_header_toolbar', true ) : $pacz_settings['header-toolbar'],
						'pacz_nav_res_width' => (isset($pacz_settings['res-nav-width']))? $pacz_settings['res-nav-width']: '',
						'pacz_header_sticky' => (get_post_meta( $post_id, '_custom_bg', true ) == 'true') ? get_post_meta( $post_id, 'sticky-header', true ) : $pacz_settings['sticky-header'],
						'pacz_grid_width' => esc_attr($pacz_settings['grid-width']),
						//'pacz_preloader_logo' => esc_url($pacz_settings['preloader-logo']['url']),
						'pacz_header_padding' => esc_attr($pacz_settings['header-padding']),
						'pacz_accent_color' => esc_attr($pacz_accent_color),
						'pacz_squeeze_header' => esc_attr($pacz_settings['squeeze-sticky-header']),
						'pacz_logo_height' => ($pacz_settings['logo']['height']) ? $pacz_settings['logo']['height'] : 50,
						//'pacz_preloader_txt_color' => ($pacz_settings['preloader-txt-color']) ? $pacz_settings['preloader-txt-color'] : '#fff',
						//'pacz_preloader_bg_color' => ($pacz_settings['preloader-bg-color']) ? $pacz_settings['preloader-bg-color'] : '#272e43',
						//'pacz_preloader_bar_color' => (isset($pacz_settings['preloader-bar-color']) && !empty($pacz_settings['preloader-bar-color'])) ? $pacz_settings['preloader-bar-color'] : $pacz_accent_color,
						'pacz_no_more_posts' => esc_html__('No More Posts', 'classiadspro'),
						'pacz_header_structure' => (get_post_meta( $post_id, '_custom_bg', true ) == 'true') ? get_post_meta( $post_id, 'header-structure', true ) : $pacz_settings['header-structure'],
						'pacz_boxed_header' => $pacz_settings['boxed-header'],
						'pacz_header_trans_offset' => $pacz_header_trans_offset,
						'pacz_is_rtl' => $rtl
					)
				);
				
				if ( ! wp_style_is( 'bootstrap', 'enqueued' ) ) {
					wp_enqueue_style('bootstrap', PACZ_THEME_STYLES . '/bootstrap.min.css', false, $theme_data['Version'], 'all');
				}
				if ( ! wp_style_is( 'slick', 'enqueued' ) ) {
					wp_enqueue_style('slick-css', PACZ_THEME_STYLES . '/slick/slick.css', false, $theme_data['Version'], 'all');
					wp_enqueue_style('slick-theme', PACZ_THEME_STYLES . '/slick/slick-theme.css', false, $theme_data['Version'], 'all');
				}
				
				wp_enqueue_style('pacz-styles-default', PACZ_THEME_STYLES . '/styles.css', false, $theme_data['Version'], 'all');
				wp_enqueue_style('pacz-styles', PACZ_THEME_STYLES . '/pacz-styles.css', false, $theme_data['Version'], 'all');
				wp_enqueue_style('pacz-blog', PACZ_THEME_STYLES . '/pacz-blog.css', false, $theme_data['Version'], 'all');
				
				if(!class_exists('Pacz_Static_Files')){
					wp_enqueue_style('pacz-dynamic-css', PACZ_THEME_STYLES . '/classiadspro-dynamic.css', false, $theme_data['Version'], 'all');
					wp_add_inline_style('pacz-dynamic-css', pacz_enqueue_font_icons());
				}
				
				wp_enqueue_style('pacz-common-shortcode', PACZ_THEME_STYLES . '/shortcode/common-shortcode.css', false, $theme_data['Version'], 'all');
				wp_enqueue_style('pacz-fonticon-custom', PACZ_THEME_STYLES . '/fonticon-custom.min.css', false, $theme_data['Version'], 'all');
				
				do_action('directorypress_register_listing_styles');
		}
}

add_action('wp_enqueue_scripts', 'pacz_theme_enqueue_scripts', 1);


/**
 * wpmail_content_type
 * allow html emails
 *
 * @author Joe Sexton <joe@webtipblog.com>
 * @return string
 */
function wpmail_content_type() {
 
    return 'text/html';
}

/* header script */

add_action('wp_enqueue_scripts', 'pacz_header_scripts', 1);
function pacz_header_scripts() { 
	 echo '<script>
		var classiadspro = {};
		var php = {};
	 </script>';
}

/* footer scripts */
add_action('wp_footer', 'pacz_footer_elements', 1);
function pacz_footer_elements() { 
global $pacz_settings, $pacz_accent_color, $post, $classiadspro_json;
 $post_id = global_get_post_id();


?>
<?php if($pacz_settings['custom-js']) : ?>
	<script>
	<?php echo esc_js($pacz_settings['custom-js']); ?>
	</script>

<?php endif; ?>

<?php
	global $classiadspro_dynamic_styles;

	$classiadspro_dynamic_styles_ids = array();
	$classiadspro_dynamic_styles_inject = '';
	if(!empty($classiadspro_dynamic_styles)){
		$classiadspro_styles_length = count($classiadspro_dynamic_styles);
	}else{
		$classiadspro_styles_length = 0;
	}
	if ($classiadspro_styles_length > 0) {
		foreach ($classiadspro_dynamic_styles as $key => $val) { 
			$classiadspro_dynamic_styles_ids[] = $val["id"]; 
			$classiadspro_dynamic_styles_inject .= $val["inject"];
		};
	}

?>
<script>
	window.$ = jQuery
	var dynamic_styles = '<?php echo pacz_clean_init_styles($classiadspro_dynamic_styles_inject); ?>';
	var dynamic_styles_ids = (<?php echo json_encode($classiadspro_dynamic_styles_ids); ?> != null) ? <?php echo json_encode($classiadspro_dynamic_styles_ids); ?> : [];

	var styleTag = document.createElement('style'),
		head = document.getElementsByTagName('head')[0];

	styleTag.type = 'text/css';
	styleTag.setAttribute('data-ajax', '');
	styleTag.innerHTML = dynamic_styles;
	head.appendChild(styleTag);


	$('.pacz-dynamic-styles').each(function() {
		$(this).remove();
	});

	function ajaxStylesInjector() {
		$('.pacz-dynamic-styles').each(function() {
			var $this = $(this),
				id = $this.attr('id'),
				commentedStyles = $this.html();
				styles = commentedStyles
						 .replace('<!--', '')
						 .replace('-->', '');

			if(dynamic_styles_ids.indexOf(id) === -1) {
				$('style[data-ajax]').append(styles);
				$this.remove();
			}

			dynamic_styles_ids.push(id);
		});
	};
</script>



<?php }
add_action('after_setup_theme', 'pacz_add_image_size');
function pacz_add_image_size($name = '', $width = '', $height = '', $crop = false){
	add_theme_support( $name );
	add_image_size( $name, $width, $height, $crop );
}