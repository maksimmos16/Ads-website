<?php
global $pacz_settings;


/*
 *
 * Contains all the dynamic css rules generated based on theme settings.
 *
 */

//function pacz_dynamic_css() {

	//wp_enqueue_style('pacz-style', get_stylesheet_uri(), false, false, 'all');

	

	$output = $typekit_fonts_1 = $attach = $custom_breadcrumb_page = $custom_breadcrumb_hover_color = $custom_breadcrumb_color = '';

/* Get skin color from global $_GET for skin switcher panel */
	if (isset($_GET['skin'])) {
		$accent_color = '#' . $_GET['skin'];
		$btn_hover = '#' . $_GET['btn-hover'];
		$pacz_settings['footer-link-color']['hover'] = '#' . $_GET['skin'];
		$pacz_settings['dashboard-link-color']['hover'] = '#' . $_GET['skin'];
		$pacz_settings['sidebar-link-color']['hover'] = '#' . $_GET['skin'];
		$pacz_settings['link-color']['hover'] = '#' . $_GET['skin'];
		$pacz_settings['footer-social-color']['hover'] = '#' . $_GET['skin'];
		$pacz_settings['main-nav-top-color']['hover'] = '#' . $_GET['skin'];
		$pacz_settings['main-nav-sub-color']['bg-hover'] = '#' . $_GET['skin'];
		$pacz_settings['main-nav-sub-color']['bg-active'] = '#' . $_GET['skin'];

	} else {
		$accent_color = $pacz_settings['accent-color'];
		$btn_hover = $pacz_settings['btn-hover'];
	}

/**
 * Typekit fonts
 * */

	$typekit_id = isset($pacz_settings['typekit-id']) ? $pacz_settings['typekit-id'] : '';
	$typekit_elements_list_1 = isset($pacz_settings['typekit-element-names']) ? $pacz_settings['typekit-element-names'] : '';
	$typekit_font_family_1 = isset($pacz_settings['typekit-font-family']) ? $pacz_settings['typekit-font-family'] : '';

	if ($typekit_id != '' && $typekit_elements_list_1 != '' && $typekit_font_family_1 != '') {
		if (is_array($typekit_elements_list_1)) {
			$typekit_elements_list_1 = implode(', ', $typekit_elements_list_1);
		} else {
			$typekit_elements_list_1 = $typekit_elements_list_1;
		}
		$typekit_fonts_1 = $typekit_elements_list_1 . ' {font-family: "' . $typekit_font_family_1 . '"}';

	}

###########################################
# Structure
###########################################

// Sidebar Width deducted from content width percentage
global $post;
if(is_page() && !has_shortcode($post->post_content, 'vc_row')){
	$output .= "
	.theme-content {padding:70px 0;}
	";
}
	$sidebar_width = 100 - $pacz_settings['content-width'];

	$boxed_layout_width = $pacz_settings['grid-width']+60;
	
Pacz_Static_Files::addGlobalStyle("
.pacz-grid,
.pacz-inner-grid
{
	max-width: {$pacz_settings['grid-width']}px;
}

.theme-page-wrapper.right-layout .theme-content, .theme-page-wrapper.left-layout .theme-content
{
	width: {$pacz_settings['content-width']}%;
}

.theme-page-wrapper #pacz-sidebar.pacz-builtin
{
	width: {$sidebar_width}%;
}



.pacz-boxed-enabled,
.pacz-boxed-enabled #pacz-header.sticky-header,
.pacz-boxed-enabled #pacz-header.transparent-header-sticky,
.pacz-boxed-enabled .pacz-secondary-header
{
	max-width: {$boxed_layout_width}px;

}
#pacz-header.postion-absolute{
	position:absolute;
}
@media handheld, only screen and (max-width: {$pacz_settings['grid-width']}px)
{

#sub-footer .item-holder
{
	margin:0 20px;
}

}

");

###########################################
# Backgrounds
###########################################

/**
 * Body background
 */
	$body_bg = 	$pacz_settings['body-bg']['background-color'] ? 'background-color:' . $pacz_settings['body-bg']['background-color'] . ';' : '';
	$body_bg .= $pacz_settings['body-bg']['background-image'] ? 'background-image:url(' . $pacz_settings['body-bg']['background-image'] . ');' : ' ';
	$body_bg .= $pacz_settings['body-bg']['background-position'] ? 'background-position:' . $pacz_settings['body-bg']['background-position'] . ';' : '';
	$body_bg .= $pacz_settings['body-bg']['background-attachment'] ? 'background-attachment:' . $pacz_settings['body-bg']['background-attachment'] . ';' : '';
	$body_bg .= $pacz_settings['body-bg']['background-repeat'] ? 'background-repeat:' . $pacz_settings['body-bg']['background-repeat'] . ';' : '';
	$body_bg .= $pacz_settings['body-bg']['background-size'] ? 'background-size:'. $pacz_settings['body-bg']['background-size'].';' : '';


/**
 * Page Title background
 */
	$page_title_bg = $pacz_settings['page-title-bg']['background-color'] ? 'background-color:' . $pacz_settings['page-title-bg']['background-color'] . ';' : '';
	$page_title_bg .= $pacz_settings['page-title-bg']['background-image'] ? 'background-image:url(' . $pacz_settings['page-title-bg']['background-image'] . ');' : ' ';
	$page_title_bg .= $pacz_settings['page-title-bg']['background-position'] ? 'background-position:' . $pacz_settings['page-title-bg']['background-position'] . ';' : '';
	$page_title_bg .= $pacz_settings['page-title-bg']['background-attachment'] ? 'background-attachment:' . $pacz_settings['page-title-bg']['background-attachment'] . ';' : '';
	$page_title_bg .= $pacz_settings['page-title-bg']['background-repeat'] ? 'background-repeat:' . $pacz_settings['page-title-bg']['background-repeat'] . ';' : '';
	$page_title_bg .= $pacz_settings['page-title-bg']['background-size'] ? 'background-size:'. $pacz_settings['page-title-bg']['background-size'].';' : '';
	//$page_title_bg .= $pacz_settings['page-title-bg']['border'] ? 'border-bottom:1px solid ' . $pacz_settings['page-title-bg']['border'] . ';' : '';

/**
 * Page background
 */
	$page_bg = $pacz_settings['page-bg']['background-color'] ? 'background-color:' . $pacz_settings['page-bg']['background-color'] . ';' : '';
	$page_bg .= $pacz_settings['page-bg']['background-image'] ? 'background-image:url(' . $pacz_settings['page-bg']['background-image'] . ');' : ' ';
	$page_bg .= $pacz_settings['page-bg']['background-position'] ? 'background-position:' . $pacz_settings['page-bg']['background-position'] . ';' : '';
	$page_bg .= $pacz_settings['page-bg']['background-attachment'] ? 'background-attachment:' . $pacz_settings['page-bg']['background-attachment'] . ';' : '';
	$page_bg .= $pacz_settings['page-bg']['background-repeat'] ? 'background-repeat:' . $pacz_settings['page-bg']['background-repeat'] . ';' : '';
	$page_bg .= $pacz_settings['page-bg']['background-size'] ? 'background-size:'. $pacz_settings['page-bg']['background-size'].';' : '';

/**
 * Footer background
 */
	$footer_bg = $pacz_settings['footer-bg']['background-color'] ? 'background-color:' . $pacz_settings['footer-bg']['background-color'] . ';' : '';
	$footer_bg .= $pacz_settings['footer-bg']['background-image'] ? 'background-image:url(' . $pacz_settings['footer-bg']['background-image'] . ');' : ' ';
	$footer_bg .= $pacz_settings['footer-bg']['background-position'] ? 'background-position:' . $pacz_settings['footer-bg']['background-position'] . ';' : '';
	$footer_bg .= $pacz_settings['footer-bg']['background-attachment'] ? 'background-attachment:' . $pacz_settings['footer-bg']['background-attachment'] . ';' : '';
	$footer_bg .= $pacz_settings['footer-bg']['background-repeat'] ? 'background-repeat:' . $pacz_settings['footer-bg']['background-repeat'] . ';' : '';
	$footer_bg .= $pacz_settings['footer-bg']['background-size'] ? 'background-size:'. $pacz_settings['footer-bg']['background-size'].';' : '';

	$page_title_color = $pacz_settings['page-title-color'];
	$page_title_size = $pacz_settings['page-title-size'];
	$page_title_padding = 200;
	$page_title_weight = '';
	$page_title_letter_spacing = '';

	$post_id = global_get_post_id();
	$enable = get_post_meta($post_id, '_custom_bg', true);
	if (global_get_post_id()) {


		$post_id = global_get_post_id();

		$intro = get_post_meta($post_id, '_page_title_intro', true);

		
		if($intro != 'none') {
			$attach = 'background-attachment: scroll;';
		}

		

		if ($enable == 'true') {
			$body_bg = get_post_meta($post_id, 'body_color', true) ? 'background-color: ' . get_post_meta($post_id, 'body_color', true) . ';' : '';
			$body_bg .= get_post_meta($post_id, 'body_image', true) ? 'background-image:url(' . get_post_meta($post_id, 'body_image', true) . ');' : '';
			$body_bg .= get_post_meta($post_id, 'body_repeat', true) ? 'background-repeat:' . get_post_meta($post_id, 'body_repeat', true) . ';' : '';
			$body_bg .= get_post_meta($post_id, 'body_position', true) ? 'background-position:' . get_post_meta($post_id, 'body_position', true) . ';' : '';
			$body_bg .= get_post_meta($post_id, 'body_attachment', true) ? 'background-attachment:' . get_post_meta($post_id, 'body_attachment', true) . ';' : '';
			$body_bg .= (get_post_meta($post_id, 'body_cover', true) == 'true') ? 'background-size: cover;background-repeat: no-repeat;-moz-background-size: cover;-webkit-background-size: cover;-o-background-size: cover;' : '';

			$header_bg = get_post_meta($post_id, 'header_color', true) ? 'background-color: ' . get_post_meta($post_id, 'header_color', true) . ';' : '';
			$header_bg_color = get_post_meta($post_id, 'header_color', true) ? 'background-color: ' . get_post_meta($post_id, 'header_color', true) . ';' : '';
			$header_bg .= get_post_meta($post_id, 'header_image', true) ? 'background-image:url(' . get_post_meta($post_id, 'header_image', true) . ');' : '';
			$header_bg .= get_post_meta($post_id, 'header_repeat', true) ? 'background-repeat:' . get_post_meta($post_id, 'header_repeat', true) . ';' : '';
			$header_bg .= get_post_meta($post_id, 'header_position', true) ? 'background-position:' . get_post_meta($post_id, 'header_position', true) . ';' : '';
			$header_bg .= get_post_meta($post_id, 'header_attachment', true) ? 'background-attachment:' . get_post_meta($post_id, 'header_attachment', true) . ';' : '';
			$header_bg .= (get_post_meta($post_id, 'header_cover', true) == 'true') ? 'background-size: cover;background-repeat: no-repeat;-moz-background-size: cover;-webkit-background-size: cover;-o-background-size: cover;' : '';

			$page_title_bg = get_post_meta($post_id, 'banner_color', true) ? 'background-color: ' . get_post_meta($post_id, 'banner_color', true) . ';' : '';
			$page_title_bg .= get_post_meta($post_id, 'banner_image', true) ? 'background-image:url(' . get_post_meta($post_id, 'banner_image', true) . ');' : '';
			$page_title_bg .= get_post_meta($post_id, 'banner_repeat', true) ? 'background-repeat:' . get_post_meta($post_id, 'banner_repeat', true) . ';' : '';
			$page_title_bg .= get_post_meta($post_id, 'banner_position', true) ? 'background-position:' . get_post_meta($post_id, 'banner_position', true) . ';' : '';
			$page_title_bg .= get_post_meta($post_id, 'banner_attachment', true) ? 'background-attachment:' . get_post_meta($post_id, 'banner_attachment', true) . ';' : '';
			$page_title_bg .= (get_post_meta($post_id, 'banner_cover', true) == 'true') ? 'background-size: cover;background-repeat: no-repeat;-moz-background-size: cover;-webkit-background-size: cover;-o-background-size: cover;' : '';

			$page_bg = get_post_meta($post_id, 'page_color', true) ? 'background-color: ' . get_post_meta($post_id, 'page_color', true) . ' !important;' : '';
			$page_bg .= get_post_meta($post_id, 'page_image', true) ? 'background-image:url(' . get_post_meta($post_id, 'page_image', true) . ') !important;' : '';
			$page_bg .= get_post_meta($post_id, 'page_repeat', true) ? 'background-repeat:' . get_post_meta($post_id, 'page_repeat', true) . ' !important;' : '';
			$page_bg .= get_post_meta($post_id, 'page_position', true) ? 'background-position:' . get_post_meta($post_id, 'page_position', true) . ' !important;' : '';
			$page_bg .= get_post_meta($post_id, 'page_attachment', true) ? 'background-attachment:' . get_post_meta($post_id, 'page_attachment', true) . ' !important;' : '';
			$page_bg .= (get_post_meta($post_id, 'page_cover', true) == 'true') ? 'background-size: cover;background-repeat: no-repeat;-moz-background-size: cover;-webkit-background-size: cover;-o-background-size: cover;' : '';

			$footer_bg = get_post_meta($post_id, 'footer_color', true) ? 'background-color: ' . get_post_meta($post_id, 'footer_color', true) . ';' : '';
			$footer_bg .= get_post_meta($post_id, 'footer_image', true) ? 'background-image:url(' . get_post_meta($post_id, 'footer_image', true) . ');' : '';
			$footer_bg .= get_post_meta($post_id, 'footer_repeat', true) ? 'background-repeat:' . get_post_meta($post_id, 'footer_repeat', true) . ';' : '';
			$footer_bg .= get_post_meta($post_id, 'footer_position', true) ? 'background-position:' . get_post_meta($post_id, 'footer_position', true) . ';' : '';
			$footer_bg .= get_post_meta($post_id, 'footer_attachment', true) ? 'background-attachment:' . get_post_meta($post_id, 'footer_attachment', true) . ';' : '';
			$footer_bg .= (get_post_meta($post_id, 'footer_cover', true) == 'true') ? 'background-size: cover;background-repeat: no-repeat;-moz-background-size: cover;-webkit-background-size: cover;-o-background-size: cover;' : '';

			$page_title_color = get_post_meta($post_id, '_page_title_color', true) ? get_post_meta($post_id, '_page_title_color', true) : $pacz_settings['page-title-color'];
			$page_title_weight = get_post_meta($post_id, '_page_title_weight', true) ? ('font-weight:' . get_post_meta($post_id, '_page_title_weight', true)) : '';
			$page_title_letter_spacing = get_post_meta($post_id, '_page_title_letter_spacing', true) ? ('letter-spacing:' . get_post_meta($post_id, '_page_title_letter_spacing', true) . 'px;') : '';

			$page_title_size = get_post_meta($post_id, '_page_title_size', true) ? get_post_meta($post_id, '_page_title_size', true) : $pacz_settings['page-title-size'];
			$page_title_padding = get_post_meta($post_id, '_page_title_padding', true) ? get_post_meta($post_id, '_page_title_padding', true) : 40;
			
			$header_grid_margin = get_post_meta($post_id, 'header-grid-margin-top', true) ? get_post_meta($post_id, 'header-grid-margin-top', true) : $pacz_settings['header-grid-margin-top'];
			$header_border_top = get_post_meta($post_id, 'header-border-top', true) ? get_post_meta($post_id, 'header-border-top', true) : $pacz_settings['header-border-top'];
		}
		/*** custom breadcrumb coloring ***/
		$custom_breadcrumb_page = get_post_meta($post_id, '_breadcrumb_skin', true) ? 1 : 0;
		$custom_breadcrumb_color = get_post_meta($post_id, '_breadcrumb_custom_color', true) ? get_post_meta($post_id, '_breadcrumb_custom_color', true) : '';
		$custom_breadcrumb_hover_color = get_post_meta($post_id, '_breadcrumb_custom_hover_color', true) ? get_post_meta($post_id, '_breadcrumb_custom_hover_color', true) : '';

	}

	$header_bottom_border = (isset($pacz_settings['header-bottom-border']) && !empty($pacz_settings['header-bottom-border'])) ? ('border-bottom:1px solid' . $pacz_settings['header-bottom-border'] . ';') : '';
	if($pacz_settings['header-grid']){
		$header_grid_margin = $pacz_settings['header-grid-margin-top'];
	}else{
		$header_grid_margin = '';
	}

		/**
		 * Header background
		 */
			$header_bg_color = $pacz_settings['header-bg']['background-color'] ? 'background-color:' . $pacz_settings['header-bg']['background-color'] . ';' : '';
			$header_bg = $pacz_settings['header-bg']['background-color'] ? 'background-color:' . $pacz_settings['header-bg']['background-color'] . ';' : '';
			$header_bg .= $pacz_settings['header-bg']['background-image'] ? 'background-image:url(' . $pacz_settings['header-bg']['background-image'] . ');' : ' ';
			$header_bg .= $pacz_settings['header-bg']['background-position'] ? 'background-position:' . $pacz_settings['header-bg']['background-position'] . ';' : '';
			$header_bg .= $pacz_settings['header-bg']['background-attachment'] ? 'background-attachment:' . $pacz_settings['header-bg']['background-attachment'] . ';' : '';
			$header_bg .= $pacz_settings['header-bg']['background-repeat'] ? 'background-repeat:' . $pacz_settings['header-bg']['background-repeat'] . ';' : '';
			$header_bg .= $pacz_settings['header-bg']['background-size'] ? 'background-size:'. $pacz_settings['header-bg']['background-size'].';' : '';
			
		/**

		 * Transparent Header background
		 */
			$theader_bg_color = isset($pacz_settings['theader-bg']['rgba']) ? 'background-color:' . $pacz_settings['theader-bg']['rgba'] . ';' : '';

			/**
		 * Header toolbar background
		 */
			$toolbar_bg = $pacz_settings['toolbar-bg']['background-color'] ? 'background-color:' . $pacz_settings['toolbar-bg']['background-color'] . ';' : '';
			$toolbar_bg .= $pacz_settings['toolbar-bg']['background-image'] ? 'background-image:url(' . $pacz_settings['toolbar-bg']['background-image'] . ');' : ' ';
			$toolbar_bg .= $pacz_settings['toolbar-bg']['background-position'] ? 'background-position:' . $pacz_settings['toolbar-bg']['background-position'] . ';' : '';
			$toolbar_bg .= $pacz_settings['toolbar-bg']['background-attachment'] ? 'background-attachment:' . $pacz_settings['toolbar-bg']['background-attachment'] . ';' : '';
			$toolbar_bg .= $pacz_settings['toolbar-bg']['background-repeat'] ? 'background-repeat:' . $pacz_settings['toolbar-bg']['background-repeat'] . ';' : '';
			$toolbar_bg .= $pacz_settings['toolbar-bg']['background-size'] ? 'background-size:'. $pacz_settings['toolbar-bg']['background-size'].';' : '';

			$logo_height = (isset($pacz_settings['logo_dimensions'])) ? $pacz_settings['logo_dimensions'] : 50;
			$pacz_header_padding = $pacz_settings['header-padding'];
			$squeeze_sticky_header = $pacz_settings['squeeze-sticky-header'];
			$header_shadow = ($enable)? get_post_meta($post_id, 'header_shadow', true): $pacz_settings['header_shadow'];
Pacz_Static_Files::addGlobalStyle("
	body,.theme-main-wrapper{
		{$body_bg}
	}

");
if($header_shadow == 'false' || $header_shadow == 0){
	Pacz_Static_Files::addGlobalStyle("
		#pacz-header {
			box-shadow:none;
		}

	");
}
$listing_header_btn_color_regular = (isset($pacz_settings['listing-header-btn-color']['regular']))? $pacz_settings['listing-header-btn-color']['regular'] : '';
$listing_header_btn_color_hover = (isset($pacz_settings['listing-header-btn-color']['hover']))? $pacz_settings['listing-header-btn-color']['hover'] : '';
$listing_header_btn_color_bg = (isset($pacz_settings['listing-header-btn-color']['bg']))? $pacz_settings['listing-header-btn-color']['bg'] : '';
$listing_header_btn_color_bghover = (isset($pacz_settings['listing-header-btn-color']['bg-hover']))? $pacz_settings['listing-header-btn-color']['bg-hover'] : '';

$listing_header_btn_color_regular_transparent = (isset($pacz_settings['listing-header-btn-color-transparent']['regular']))? $pacz_settings['listing-header-btn-color-transparent']['regular'] : '';
$listing_header_btn_color_hover_transparent  = (isset($pacz_settings['listing-header-btn-color-transparent']['hover']))? $pacz_settings['listing-header-btn-color-transparent']['hover'] : '';
$listing_header_btn_color_bg_transparent  = (isset($pacz_settings['listing-header-btn-color-transparent']['bg']) && !empty($pacz_settings['listing-header-btn-color-transparent']['bg']))? $pacz_settings['listing-header-btn-color-transparent']['bg'] : 'none';
$listing_header_btn_color_bghover_transparent  = (isset($pacz_settings['listing-header-btn-color-transparent']['bg-hover']))? $pacz_settings['listing-header-btn-color-transparent']['bg-hover'] : 'none';



$post_id = global_get_post_id();
$header_border_top = get_post_meta($post_id, 'header-border-top', true) ? get_post_meta($post_id, 'header-border-top', true) : $pacz_settings['header-border-top'];
if (is_page() && $header_border_top == 'true') {
		
Pacz_Static_Files::addGlobalStyle("
		.theme-main-wrapper:not(.vertical-header) #pacz-header,
		.theme-main-wrapper:not(.vertical-header) .pacz-secondary-header
		{
			border-top:1px solid {$accent_color};
		}
");
}
else if (isset($pacz_settings['header-border-top']) && ($pacz_settings['header-border-top'] == 1)) {
		
Pacz_Static_Files::addGlobalStyle("
		.theme-main-wrapper:not(.vertical-header) #pacz-header,
		.theme-main-wrapper:not(.vertical-header) .pacz-secondary-header
		{
			border-top:1px solid {$accent_color};
		}
");
}
$listing_button_padding_top = (isset($pacz_settings['listing_button_padding']['padding-top'])) ? ('padding-top:'.$pacz_settings['listing_button_padding']['padding-top'].';') : '';
$listing_button_padding_bottom = (isset($pacz_settings['listing_button_padding']['padding-bottom'])) ? ('padding-bottom:'.$pacz_settings['listing_button_padding']['padding-bottom'].';') : '';
$listing_button_padding_left = (isset($pacz_settings['listing_button_padding']['padding-left'])) ? ('padding-left:'.$pacz_settings['listing_button_padding']['padding-left'].';') : '';
$listing_button_padding_right = (isset($pacz_settings['listing_button_padding']['padding-right'])) ? ('padding-right:'.$pacz_settings['listing_button_padding']['padding-right'].';') : '';

$listing_button_border_radius_top_left = (isset($pacz_settings['listing_button_border_radius']['padding-top']) && !empty($pacz_settings['listing_button_border_radius']['padding-top'])) ? ('border-top-left-radius:'.$pacz_settings['listing_button_border_radius']['padding-top'].';') : '';
$listing_button_border_radius_bottom_right = (isset($pacz_settings['listing_button_border_radius']['padding-bottom']) && !empty($pacz_settings['listing_button_border_radius']['padding-bottom'])) ? ('border-bottom-right-radius:'.$pacz_settings['listing_button_border_radius']['padding-bottom'].';') : '';
$listing_button_border_radius_bottom_left = (isset($pacz_settings['listing_button_border_radius']['padding-left']) && !empty($pacz_settings['listing_button_border_radius']['padding-left'])) ? ('border-bottom-left-radius:'.$pacz_settings['listing_button_border_radius']['padding-left'].';') : '';
$listing_button_border_radius_top_right = (isset($pacz_settings['listing_button_border_radius']['padding-right']) && !empty($pacz_settings['listing_button_border_radius']['padding-right'])) ? ('border-top-right-radius:'.$pacz_settings['listing_button_border_radius']['padding-right'].';') : '';

$listing_button_border_width = (isset($pacz_settings['listing_button_border_width']))? ('border-width: '. $pacz_settings['listing_button_border_width'].'px;'): '';
$listing_button_border_color = (isset($pacz_settings['header_listing_button_border_color']['rgba']) && !empty($pacz_settings['header_listing_button_border_color']['color'])) ? ('border-color:'.$pacz_settings['header_listing_button_border_color']['rgba'].';') : '';
$listing_button_border_color_hover = (isset($pacz_settings['header_listing_button_border_color_hover']['rgba']) && !empty($pacz_settings['header_listing_button_border_color_hover']['color'])) ? ('border-color:'.$pacz_settings['header_listing_button_border_color_hover']['rgba'].';') : '';


$listing_button_border_color_transparent = (isset($pacz_settings['header_listing_button_border_color_transparent']['rgba']) && !empty($pacz_settings['header_listing_button_border_color_transparent']['color'])) ? ('border-color:'.$pacz_settings['header_listing_button_border_color_transparent']['rgba'].';') : '';
$listing_button_border_color_hover_transparent = (isset($pacz_settings['header_listing_button_border_color_hover_transparent']['rgba']) && !empty($pacz_settings['header_listing_button_border_color_hover_transparent']['color'])) ? ('border-color:'.$pacz_settings['header_listing_button_border_color_hover_transparent']['rgba'].';') : '';

Pacz_Static_Files::addGlobalStyle(" 
#pacz-header,.pacz-secondary-header, #pacz-header.transparent-header.header-offset-passed,.pacz-secondary-header.transparent-header.header-offset-passed{
	{$header_bg};
	{$header_bg_color};
	}
#pacz-header.transparent-header,.pacz-secondary-header.transparent-header{
	{$theader_bg_color} !important;
	}
.listing-btn{
	display:inline-block;
	
	}
.listing-btn .listing-header-btn,
.listing-btn .directorypress-new-listing-button .btn-primary,
.listing-btn .submit-listing-button-single.btn-primary{
	color:{$listing_header_btn_color_regular};
	background:{$listing_header_btn_color_bg};
	{$listing_button_padding_top}
	{$listing_button_padding_bottom}
	{$listing_button_padding_left}
	{$listing_button_padding_right}
	{$listing_button_border_radius_top_left}
	{$listing_button_border_radius_top_right}
	{$listing_button_border_radius_bottom_right}
	{$listing_button_border_radius_bottom_left}
	{$listing_button_border_width}
	{$listing_button_border_color}
	border-style: solid;
}
.listing-btn .listing-header-btn span,
.listing-btn .directorypress-new-listing-button .btn-primary span,
.listing-btn .submit-listing-button-single.btn-primary span{
	color:{$listing_header_btn_color_regular};
}

.transparent-header:not(.sticky-trigger-header) .listing-btn .listing-header-btn,
.transparent-header:not(.sticky-trigger-header) .listing-btn .directorypress-new-listing-button .btn-primary,
.transparent-header:not(.sticky-trigger-header) .listing-btn .submit-listing-button-single.btn-primary{
	color:{$listing_header_btn_color_regular_transparent};
	background:{$listing_header_btn_color_bg_transparent};
	{$listing_button_border_color_transparent}
	border-style: solid;
}

.listing-btn .listing-header-btn:hover,
.listing-btn .directorypress-new-listing-button .btn-primary:hover,
.listing-btn .submit-listing-button-single.btn-primary:hover,
.listing-btn.mobile-submit .directorypress-new-listing-button .btn-primary:hover{
	background:{$listing_header_btn_color_bghover} !important;
	color:{$listing_header_btn_color_hover} !important;
	{$listing_button_border_color_hover}
}

.trans.listing-btn .listing-header-btn:hover span,
.listing-btn .directorypress-new-listing-button .btn-primary:hover span,
.listing-btn .submit-listing-button-single.btn-primary:hover span{
	color:{$listing_header_btn_color_hover};
}
.transparent-header:not(.sticky-trigger-header) .listing-btn .listing-header-btn:hover,
.transparent-header:not(.sticky-trigger-header) .listing-btn .directorypress-new-listing-button .btn-primary:hover,
.transparent-header:not(.sticky-trigger-header) .listing-btn .submit-listing-button-single.btn-primary:hover,
.transparent-header:not(.sticky-trigger-header) .listing-btn.mobile-submit .directorypress-new-listing-button .btn-primary:hover{
	background:{$listing_header_btn_color_bghover_transparent} !important;
	color:{$listing_header_btn_color_hover_transparent} !important;
	{$listing_button_border_color_hover_transparent}
}

.submit-page-buton.hours-field-btn,
.cz-creat-listing-inner .submit .button.btn{
	color:#fff;
	background:{$pacz_settings['accent-color']};
}
.submit-page-buton.hours-field-btn:hover,
.cz-creat-listing-inner .submit .button.btn:hover{
	background:{$pacz_settings['btn-hover']};
}

");

/**
 * Header Toolbar font settings
 */
$toolbar_font = (isset($pacz_settings['toolbar-font']['font-family']) && !empty($pacz_settings['toolbar-font']['font-family'])) ? ('font-family:' . $pacz_settings['toolbar-font']['font-family'] . ';') : '';
$toolbar_font .= (isset($pacz_settings['toolbar-font']['font-weight']) && !empty($pacz_settings['toolbar-font']['font-weight'])) ? ('font-weight:' . $pacz_settings['toolbar-font']['font-weight'] . ';') : '';
$toolbar_font .= (isset($pacz_settings['toolbar-font']['font-size']) && !empty($pacz_settings['toolbar-font']['font-size'])) ? ('font-size:' . $pacz_settings['toolbar-font']['font-size'] . ';') : '';
$logo_height = (!empty($pacz_settings['logo']['height'])) ? $pacz_settings['logo']['height'] : 50;
$toolbar_height = $pacz_settings['toolbar_height'];
$page_title_padding = $toolbar_height+($pacz_settings['header-padding'] * 2) + 50;
$page_title_height = $page_title_padding+ 94;
$toolbar_lineheight = $pacz_settings['toolbar_height'] - 2; 

$toolbar =(isset($pacz_settings['header-toolbar']) && !empty($pacz_settings['header-toolbar'])) ? $pacz_settings['header-toolbar'] : 0;
$toolbar_check = get_post_meta( $post_id, '_header_toolbar', true );
$toolbar_option = !empty($toolbar_check) ? $toolbar_check : 'true';

if($toolbar){
        if($toolbar_option == 'true'){
			$header_margin_top = $toolbar_height;
			$sticky_header_padding_top =$toolbar_height+($pacz_settings['header-padding'] * 2) +50;
		}
}else{
	$header_margin_top = 1;
	$sticky_header_padding_top =($pacz_settings['header-padding'] * 2) +50;
}
Pacz_Static_Files::addGlobalStyle("
	#pacz-header.sticky-trigger-header{
	
	}
");

if($pacz_settings['top-footer'] == 0){
	
Pacz_Static_Files::addGlobalStyle("
	#pacz-footer .main-footer-top-padding{padding-top:100px;}

");	
	
}elseif($pacz_settings['top-footer'] == 1 && $pacz_settings['footer_form_style'] == 2){
Pacz_Static_Files::addGlobalStyle("
#pacz-footer{padding-top:100px;}
	.footer-top{margin-bottom:100px;border-top:2px solid {$accent_color};}
");	
}
Pacz_Static_Files::addGlobalStyle("

.pacz-header-toolbar{
{$toolbar_bg};
{$toolbar_font};
height:{$toolbar_height}px;
line-height:{$toolbar_lineheight}px;
}

.sticky-header-padding {
	{$header_bg_color}
	
}

#pacz-header.transparent-header-sticky,
#pacz-header.sticky-header {
{$header_bottom_border}}


.transparent-header.light-header-skin,
.transparent-header.dark-header-skin
 {
  border-top: none !important;
  
}
#pacz-header{
	margin-top:{$header_grid_margin}px;
}
#pacz-page-title .pacz-page-title-bg {
{$page_title_bg};
{$attach}
}

#theme-page
{
{$page_bg}}

#pacz-footer
{
{$footer_bg}
}
#sub-footer
{
	background-color: {$pacz_settings['sub-footer-bg']};
}
.footer-top{
	background-color: {$pacz_settings['top-footer-bg']};
}



#pacz-page-title .pacz-page-heading{
	font-size:{$page_title_size}px;
	color:{$page_title_color};
	{$page_title_weight};
	{$page_title_letter_spacing};
}
#pacz-breadcrumbs {
	line-height:{$page_title_size}px;
}

");

Pacz_Static_Files::addGlobalStyle("
	
	#pacz-page-title
{
	padding-top:40px !important;
	height:100px !important;
}
	
");
###########################################
	# Mobile Header
###########################################
$mobile_header_listing_button_color_regular = (isset($pacz_settings['mobile-listing-button-skin']['regular']))? ('color:'. $pacz_settings['mobile-listing-button-skin']['regular'] .';') : '';
$mobile_header_listing_button_color_hover = (isset($pacz_settings['mobile-listing-button-skin']['hover']))? ('color:'. $pacz_settings['mobile-listing-button-skin']['hover'] .';') : '';
$mobile_header_listing_button_color_bg = (isset($pacz_settings['mobile-listing-button-skin']['bg']))? ('background-color:'. $pacz_settings['mobile-listing-button-skin']['bg'] .';') : '';
$mobile_header_listing_button_color_bghover = (isset($pacz_settings['mobile-listing-button-skin']['bg-hover']))? ('background-color:'. $pacz_settings['mobile-listing-button-skin']['bg-hover'] .';') : '';

$mobile_header_login_button_color_regular = (isset($pacz_settings['mobile-login-button-skin']['regular']))? ('color:'. $pacz_settings['mobile-login-button-skin']['regular'] .';') : '';
$mobile_header_login_button_color_hover = (isset($pacz_settings['mobile-login-button-skin']['hover']))? ('color:'. $pacz_settings['mobile-login-button-skin']['hover'] .';') : '';
$mobile_header_login_button_color_bg = (isset($pacz_settings['mobile-login-button-skin']['bg']))? ('background-color:'. $pacz_settings['mobile-login-button-skin']['bg'] .';') : '';
$mobile_header_login_button_color_bghover = (isset($pacz_settings['mobile-login-button-skin']['bg-hover']))? ('background-color:'. $pacz_settings['mobile-login-button-skin']['bg-hover'] .';') : '';

$mobile_header_search_button_color_regular = (isset($pacz_settings['mobile-search-button-skin']['regular']))? ('color:'. $pacz_settings['mobile-search-button-skin']['regular'] .';') : '';
$mobile_header_search_button_color_hover = (isset($pacz_settings['mobile-search-button-skin']['hover']))? ('color:'. $pacz_settings['mobile-search-button-skin']['hover'] .';') : '';
$mobile_header_search_button_color_bg = (isset($pacz_settings['mobile-search-button-skin']['bg']))? ('background-color:'. $pacz_settings['mobile-search-button-skin']['bg'] .';') : '';
$mobile_header_search_button_color_bghover = (isset($pacz_settings['mobile-search-button-skin']['bg-hover']))? ('background-color:'. $pacz_settings['mobile-search-button-skin']['bg-hover'] .';') : '';


$mobile_header_bg = $pacz_settings['mobile-header-bg']['background-color'] ? 'background-color:' . $pacz_settings['mobile-header-bg']['background-color'] . ';' : '';
$mobile_header_bg .= $pacz_settings['mobile-header-bg']['background-image'] ? 'background-image:url(' . $pacz_settings['mobile-header-bg']['background-image'] . ');' : ' ';
$mobile_header_bg .= $pacz_settings['mobile-header-bg']['background-position'] ? 'background-position:' . $pacz_settings['mobile-header-bg']['background-position'] . ';' : '';
$mobile_header_bg .= $pacz_settings['mobile-header-bg']['background-attachment'] ? 'background-attachment:' . $pacz_settings['mobile-header-bg']['background-attachment'] . ';' : '';
$mobile_header_bg .= $pacz_settings['mobile-header-bg']['background-repeat'] ? 'background-repeat:' . $pacz_settings['mobile-header-bg']['background-repeat'] . ';' : '';
$mobile_header_bg .= $pacz_settings['mobile-header-bg']['background-size'] ? 'background-size:'. $pacz_settings['mobile-header-bg']['background-size'].';' : '';

$mobile_header_menu_container_bg = $pacz_settings['mobile-header-menu-wrapper-bg']['background-color'] ? 'background-color:' . $pacz_settings['mobile-header-menu-wrapper-bg']['background-color'] . ';' : '';
$mobile_header_menu_container_bg .= $pacz_settings['mobile-header-menu-wrapper-bg']['background-image'] ? 'background-image:url(' . $pacz_settings['mobile-header-menu-wrapper-bg']['background-image'] . ');' : ' ';
$mobile_header_menu_container_bg .= $pacz_settings['mobile-header-menu-wrapper-bg']['background-position'] ? 'background-position:' . $pacz_settings['mobile-header-menu-wrapper-bg']['background-position'] . ';' : '';
$mobile_header_menu_container_bg .= $pacz_settings['mobile-header-menu-wrapper-bg']['background-attachment'] ? 'background-attachment:' . $pacz_settings['mobile-header-menu-wrapper-bg']['background-attachment'] . ';' : '';
$mobile_header_menu_container_bg .= $pacz_settings['mobile-header-menu-wrapper-bg']['background-repeat'] ? 'background-repeat:' . $pacz_settings['mobile-header-menu-wrapper-bg']['background-repeat'] . ';' : '';
$mobile_header_menu_container_bg .= $pacz_settings['mobile-header-menu-wrapper-bg']['background-size'] ? 'background-size:'. $pacz_settings['mobile-header-menu-wrapper-bg']['background-size'].';' : '';

$mobile_header_autor_bg = $pacz_settings['mobile-header-author-bg']['background-color'] ? 'background-color:' . $pacz_settings['mobile-header-author-bg']['background-color'] . ';' : '';
$mobile_header_autor_bg .= $pacz_settings['mobile-header-author-bg']['background-image'] ? 'background-image:url(' . $pacz_settings['mobile-header-author-bg']['background-image'] . ');' : ' ';
$mobile_header_autor_bg .= $pacz_settings['mobile-header-author-bg']['background-position'] ? 'background-position:' . $pacz_settings['mobile-header-author-bg']['background-position'] . ';' : '';
$mobile_header_autor_bg .= $pacz_settings['mobile-header-author-bg']['background-attachment'] ? 'background-attachment:' . $pacz_settings['mobile-header-author-bg']['background-attachment'] . ';' : '';
$mobile_header_autor_bg .= $pacz_settings['mobile-header-author-bg']['background-repeat'] ? 'background-repeat:' . $pacz_settings['mobile-header-author-bg']['background-repeat'] . ';' : '';
$mobile_header_autor_bg .= $pacz_settings['mobile-header-author-bg']['background-size'] ? 'background-size:'. $pacz_settings['mobile-header-author-bg']['background-size'].';' : '';

$mobile_header_autor_display_name_color = (isset($pacz_settings['mobile-header-author-display-name-color']))? ('color:'. $pacz_settings['mobile-header-author-display-name-color'] .';') : '';
$mobile_header_autor_nickname_color = (isset($pacz_settings['mobile-header-author-nickname-color']))? ('color:'. $pacz_settings['mobile-header-author-nickname-color'] .';') : '';
$mobile_header_autor_links_color_regular = (isset($pacz_settings['mobile-header-author-links-color']['regular']))? ('color:'. $pacz_settings['mobile-header-author-links-color']['regular'] .';') : '';
$mobile_header_autor_links_color_hover = (isset($pacz_settings['mobile-header-author-links-color']['hover']))? ('color:'. $pacz_settings['mobile-header-author-links-color']['hover'] .';') : '';

$mobile_header_menu_color_regular = (isset($pacz_settings['mobile-nav-top-color']['regular']))? ('color:'. $pacz_settings['mobile-nav-top-color']['regular'] .';') : '';
$mobile_header_menu_color_hover = (isset($pacz_settings['mobile-nav-top-color']['hover']))? ('color:'. $pacz_settings['mobile-nav-top-color']['hover'] .';') : '';
$mobile_header_menu_color_bg = (isset($pacz_settings['mobile-nav-top-color']['bg']))? ('background-color:'. $pacz_settings['mobile-nav-top-color']['bg'] .';') : '';
$mobile_header_menu_color_bghover = (isset($pacz_settings['mobile-nav-top-color']['bg-hover']))? ('background-color:'. $pacz_settings['mobile-nav-top-color']['bg-hover'] .';') : '';
$mobile_header_menu_color_bgactive = (isset($pacz_settings['mobile-nav-top-color']['bg-active']))? ('background-color:'. $pacz_settings['mobile-nav-top-color']['bg-active'] .';') : '';
$mobile_header_menu_border_color = (isset($pacz_settings['mobile-top-menu-border-color']))? ('border-color:'. $pacz_settings['mobile-top-menu-border-color'] .';') : '';

$mobile_header_sub_menu_color_regular = (isset($pacz_settings['mobile-nav-sub-menu-color']['regular']))? ('color:'. $pacz_settings['mobile-nav-sub-menu-color']['regular'] .';') : '';
$mobile_header_sub_menu_color_hover = (isset($pacz_settings['mobile-nav-sub-menu-color']['hover']))? ('color:'. $pacz_settings['mobile-nav-sub-menu-color']['hover'] .';') : '';
$mobile_header_sub_menu_color_bg = (isset($pacz_settings['mobile-nav-sub-menu-color']['bg']))? ('background-color:'. $pacz_settings['mobile-nav-sub-menu-color']['bg'] .';') : '';
$mobile_header_sub_menu_color_bghover = (isset($pacz_settings['mobile-nav-sub-menu-color']['bg-hover']))? ('background-color:'. $pacz_settings['mobile-nav-sub-menu-color']['bg-hover'] .';') : '';
$mobile_header_sub_menu_color_bgactive = (isset($pacz_settings['mobile-nav-sub-menu-color']['bg-active']))? ('background-color:'. $pacz_settings['mobile-nav-sub-menu-color']['bg-active'] .';') : '';		

$mobile_header_menu_burger_color_regular = (isset($pacz_settings['mobile-header-menu-icon-color']['regular']))? ('background-color:'. $pacz_settings['mobile-header-menu-icon-color']['regular'] .';') : '';
$mobile_header_menu_burger_color_hover = (isset($pacz_settings['mobile-header-menu-icon-color']['hover']))? ('background-color:'. $pacz_settings['mobile-header-menu-icon-color']['hover'] .';') : '';
$mobile_header_menu_burger_color_active = (isset($pacz_settings['mobile-header-menu-icon-color']['active']))? ('background-color:'. $pacz_settings['mobile-header-menu-icon-color']['active'] .';') : '';


Pacz_Static_Files::addGlobalStyle("
	#pacz-header.mobile-header{
		{$mobile_header_bg}
	}
	.mobile-active-menu-user-wrap{
		{$mobile_header_autor_bg}
	}
	.mobile-responsive-nav-container{
		{$mobile_header_menu_container_bg}
	}
	.mobile-responsive-nav-container .res-menu-close{
		{$mobile_header_autor_bg}
		color:#fff;
	}
	.mobile-active-menu-logreg-links .author-displayname{
		{$mobile_header_autor_display_name_color}
	}
	.mobile-active-menu-logreg-links .author-nicename{
		{$mobile_header_autor_nickname_color}
	}
	.mobile-active-menu-logreg-links a{
		{$mobile_header_autor_links_color_regular}
	}
	.mobile-active-menu-logreg-links a:hover{
		{$mobile_header_autor_links_color_hover}
	}
	.pacz-mobile-listing-btn .submit-listing-button-single,
	.pacz-mobile-listing-btn .dropdown-toggle,
	.desktop .submit-listing-button-single,
	.desktop .dropdown.directorypress-new-listing-button:last-child .dropdown-toggle{
		{$mobile_header_listing_button_color_regular}
		{$mobile_header_listing_button_color_bg}
	}
	.pacz-mobile-listing-btn .submit-listing-button-single:hover,
	.pacz-mobile-listing-btn .dropdown-toggle:hover,
	.desktop .submit-listing-button-single:last-child:hover,
	.desktop .dropdown.directorypress-new-listing-button:last-child .dropdown-toggle:hover{
		{$mobile_header_listing_button_color_hover}
		{$mobile_header_listing_button_color_bghover}
	}
	.pacz-mobile-login{
		{$mobile_header_login_button_color_regular}
		{$mobile_header_login_button_color_bg}
	}
	.pacz-mobile-login:hover{
		{$mobile_header_login_button_color_hover}
		{$mobile_header_login_button_color_bghover}
	}
	.responsive-nav-search-link .search-burgur{
		{$mobile_header_search_button_color_regular}
		{$mobile_header_search_button_color_bg}
	}
	.responsive-nav-search-link .search-burgur:hover{
		{$mobile_header_search_button_color_hover}
		{$mobile_header_search_button_color_bghover}
	}
	.responsive-nav-link .pacz-burger-icon div{
		{$mobile_header_menu_burger_color_regular}
	}
	.responsive-nav-link .pacz-burger-icon:hover div{
		{$mobile_header_menu_burger_color_hover}
	}
	.responsive-nav-link.active-burger .pacz-burger-icon div{
		{$mobile_header_menu_burger_color_active}
	}
	.pacz-responsive-nav li a{
		{$mobile_header_menu_color_regular}
		{$mobile_header_menu_color_bg}
		{$mobile_header_menu_border_color}
	}
	.pacz-responsive-nav li a:hover{
		{$mobile_header_menu_color_hover}
		{$mobile_header_menu_color_bghover}
	}
	.pacz-responsive-nav li.current-menu-item a{
		{$mobile_header_menu_color_bgactive}
	}
	.pacz-responsive-nav li ul li a,
	.pacz-responsive-nav li ul li .megamenu-title{
		{$mobile_header_sub_menu_color_regular}
		{$mobile_header_sub_menu_color_bg}
	}
	.pacz-responsive-nav li ul li a:hover,
	.pacz-responsive-nav li ul li .megamenu-title:hover{
		{$mobile_header_sub_menu_color_hover}
		{$mobile_header_sub_menu_color_bghover}
	}
	.pacz-responsive-nav li ul li.current-menu-item a,
	.pacz-responsive-nav li ul li.current-menu-item .megamenu-title{
		{$mobile_header_sub_menu_color_bgactive}
	}
	
");

###########################################
	# Widgets
###########################################

	$widget_font_family = (isset($pacz_settings['widget-title']['font-family']) && !empty($pacz_settings['widget-title']['font-family'])) ? ('font-family:' . $pacz_settings['widget-title']['font-family'] . ';') : '';
	$widget_font_size = (isset($pacz_settings['widget-title']['font-size']) && !empty($pacz_settings['widget-title']['font-size'])) ? ('font-size:' . $pacz_settings['widget-title']['font-size'] . ';') : '';
	$widget_font_weight = (isset($pacz_settings['widget-title']['font-weight']) && !empty($pacz_settings['widget-title']['font-weight'])) ? ('font-weight:' . $pacz_settings['widget-title']['font-weight'] . ';') : '';
	$widget_title_divider = (isset($pacz_settings['widget-title-divider']) && $pacz_settings['widget-title-divider'] == 1) ? '' : 'display: none;'; 

	if(isset($pacz_settings['footer-col-border']) && $pacz_settings['footer-col-border'] == 1){
Pacz_Static_Files::addGlobalStyle("
#pacz-footer [class*='pacz-col-'] {
  border-right:1px solid {$pacz_settings['footer-col-border-color']};
}
#pacz-footer [class*='pacz-col-']:last-of-type {
  border-right:none;
}
#pacz-footer .pacz-col-1-2:nth-child(2),
#pacz-footer [class*='pacz-col-']:last-child {
  border-right:none;
}

");
}
Pacz_Static_Files::addGlobalStyle("
.widgettitle
{
{$widget_font_family}
{$widget_font_size}
{$widget_font_weight}
}

.widgettitle:after{
	{$widget_title_divider}
}

#pacz-footer .widget_posts_lists ul li .post-list-title{
	color:{$pacz_settings['footer-title-color']};
}
#pacz-footer .widget_posts_lists ul li .post-list-title:hover{
	color: {$pacz_settings['footer-link-color']['hover']};
}
.widget_posts_lists ul li {
	border-color:{$pacz_settings['footer-recent-lisitng-border-color']};
}
.classiadspro-form-row .classiadspro-subscription-button{
	background-color:{$accent_color};
}
.classiadspro-form-row .classiadspro-subscription-button:hover{
	background-color:{$pacz_settings['btn-hover']};
}
.widget-social-container.simple-style a.dark{
	color: {$pacz_settings['footer-social-color']['regular']} !important;
}
.widget-social-container.simple-style a.dark:hover{
	color: {$pacz_settings['footer-social-color']['hover']}!important;
}
.widget .phone-number i,
.widget .email-id i{
	color: {$pacz_settings['footer-social-color']['hover']}!important;
}
#pacz-sidebar .widgettitle,
#pacz-sidebar .widgettitle  a
{
	color: {$pacz_settings['sidebar-title-color']};
}


#pacz-sidebar,
#pacz-sidebar p
{
	color: {$pacz_settings['sidebar-txt-color']};
}


#pacz-sidebar a
{
	color: {$pacz_settings['sidebar-link-color']['regular']};
}

#pacz-sidebar a:hover
{
	color: {$pacz_settings['sidebar-link-color']['hover']};
}

#pacz-footer .widgettitle,
#pacz-footer .widgettitle a
{
	color: {$pacz_settings['footer-title-color']};
}

#pacz-footer,
#pacz-footer p
{
	color: {$pacz_settings['footer-txt-color']};
}

#pacz-footer a
{
	color: {$pacz_settings['footer-link-color']['regular']};
}

#pacz-footer a:hover
{
	color: {$pacz_settings['footer-link-color']['hover']};
}

.pacz-footer-copyright,
.pacz-footer-copyright a {
	color: {$pacz_settings['footer-socket-color']} !important;
}

.sub-footer .pacz-footer-social li a i{
	color: {$pacz_settings['footer-social-color']['regular']} !important;
}

.sub-footer .pacz-footer-social a:hover {
	color: {$pacz_settings['footer-social-color']['hover']}!important;
}

#sub-footer .pacz-footer-social li a.icon-twitter i,
#sub-footer .pacz-footer-social li a.icon-linkedin i,
#sub-footer .pacz-footer-social li a.icon-facebook i,
#sub-footer .pacz-footer-social li a.icon-pinterest i,
#sub-footer .pacz-footer-social li a.icon-google-plus i,
#sub-footer .pacz-footer-social li a.icon-instagram i,
#sub-footer .pacz-footer-social li a.icon-dribbble i,
#sub-footer .pacz-footer-social li a.icon-rss i,
#sub-footer .pacz-footer-social li a.icon-youtube-play i,
#sub-footer .pacz-footer-social li a.icon-behance i,
#sub-footer .pacz-footer-social li a.icon-whatsapp i,
#sub-footer .pacz-footer-social li a.icon-vimeo i,
#sub-footer .pacz-footer-social li a.icon-weibo i,
#sub-footer .pacz-footer-social li a.icon-spotify i,
#sub-footer .pacz-footer-social li a.icon-vk i,
#sub-footer .pacz-footer-social li a.icon-qzone i,
#sub-footer .pacz-footer-social li a.icon-wechat i,
#sub-footer .pacz-footer-social li a.icon-renren i,
#sub-footer .pacz-footer-social li a.icon-imdb i{
	color: {$pacz_settings['footer-social-color']['regular']} !important;
	
}
#sub-footer .pacz-footer-social li a:hover i{color: {$pacz_settings['footer-social-color']['hover']}!important;}

#sub-footer .pacz-footer-social li a.icon-twitter:hover,
#sub-footer .pacz-footer-social li a.icon-linkedin:hover,
#sub-footer .pacz-footer-social li a.icon-facebook:hover,
#sub-footer .pacz-footer-social li a.icon-pinterest:hover,
#sub-footer .pacz-footer-social li a.icon-google-plus:hover,
#sub-footer .pacz-footer-social li a.icon-instagram:hover,
#sub-footer .pacz-footer-social li a.icon-dribbble:hover,
#sub-footer .pacz-footer-social li a.icon-rss:hover,
#sub-footer .pacz-footer-social li a.icon-youtube-play:hover,
#sub-footer .pacz-footer-social li a.icon-tumblr:hover,
#sub-footer .pacz-footer-social li a.icon-behance:hover,
#sub-footer .pacz-footer-social li a.icon-whatsapp:hover,
#sub-footer .pacz-footer-social li a.icon-vimeo:hover,
#sub-footer .pacz-footer-social li a.icon-weibo:hover,
#sub-footer .pacz-footer-social li a.icon-spotify:hover,
#sub-footer .pacz-footer-social li a.icon-vk:hover,
#sub-footer .pacz-footer-social li a.icon-qzone:hover,
#sub-footer .pacz-footer-social li a.icon-wechat:hover,
#sub-footer .pacz-footer-social li a.icon-renren:hover,
#sub-footer .pacz-footer-social li a.icon-imdb:hover{
	background-color: {$pacz_settings['footer-social-color']['bg-hover']}!important;
	
}

#sub-footer .pacz-footer-social li a{
	background-color: {$pacz_settings['footer-social-color']['bg']}!important;
	box-shadow:none;
	}
#pacz-footer .widget_tag_cloud a,
#pacz-footer .widget_product_tag_cloud a {
  border-color:{$pacz_settings['footer-link-color']['regular']};
  
  
}
#pacz-footer .widget_tag_cloud a:hover,
#pacz-footer .widget_product_tag_cloud:hover a {
  border-color:{$pacz_settings['accent-color']};
  background-color:{$pacz_settings['accent-color']};
  
  
}

.widget_tag_cloud a:hover,
.widget_product_tag_cloud:hover a,
#pacz-sidebar .widget_tag_cloud a:hover,
#pacz-sidebar .widget_product_tag_cloud a:hover {
  border-color:{$pacz_settings['accent-color']};
  background-color:{$pacz_settings['accent-color']};
  
  
}
#pacz-sidebar .widget_posts_lists ul li .post-list-meta data {
  background-color:{$pacz_settings['accent-color']};
  color:#fff;
}
#pacz-sidebar .widget_posts_lists ul li .post-list-title{
	color:{$pacz_settings['heading-color']};
	
}
#pacz-sidebar .widget_archive ul li a:before,
#pacz-sidebar .widget_categories a:before{
	color:{$pacz_settings['accent-color']};
	
}
#pacz-sidebar .widget_archive ul li a:hover:before,
#pacz-sidebar .widget_categories a:hover:before{
	
}
#pacz-sidebar .widgettitle:before {
	background-color:{$pacz_settings['accent-color']};
	
}

.hover-overlay{
	 background: {$pacz_settings['accent-color']} !important;
}

");



###########################################
	# Typography & Coloring
	###########################################

	$body_font_backup = (isset($pacz_settings['body-font']['font-backup']) && !empty($pacz_settings['body-font']['font-backup'])) ? ('font-family:' . $pacz_settings['body-font']['font-backup'] . ';') : '';
	$body_font_family = (isset($pacz_settings['body-font']['font-family']) && !empty($pacz_settings['body-font']['font-family'])) ? ('font-family:' . $pacz_settings['body-font']['font-family'] . ';') : '';
	$heading_font_family = (isset($pacz_settings['heading-font']['font-family']) && !empty($pacz_settings['heading-font']['font-family'])) ? ('font-family:' . $pacz_settings['heading-font']['font-family'] . ';') : '';
	$heading_font_family_h2 = (isset($pacz_settings['heading-font-h2']['font-family']) && !empty($pacz_settings['heading-font-h2']['font-family'])) ? ('font-family:' . $pacz_settings['heading-font-h2']['font-family'] . ';') : $heading_font_family ;
	$heading_font_family_h3 = (isset($pacz_settings['heading-font-h3']['font-family']) && !empty($pacz_settings['heading-font-h3']['font-family'])) ? ('font-family:' . $pacz_settings['heading-font-h3']['font-family'] . ';') : $heading_font_family ;
	$heading_font_family_h4 = (isset($pacz_settings['heading-font-h4']['font-family']) && !empty($pacz_settings['heading-font-h4']['font-family'])) ? ('font-family:' . $pacz_settings['heading-font-h4']['font-family'] . ';') : $heading_font_family ;
	$heading_font_family_h5 = (isset($pacz_settings['heading-font-h5']['font-family']) && !empty($pacz_settings['heading-font-h5']['font-family'])) ? ('font-family:' . $pacz_settings['heading-font-h5']['font-family'] . ';') : $heading_font_family ;
	$heading_font_family_h6 = (isset($pacz_settings['heading-font-h6']['font-family']) && !empty($pacz_settings['heading-font-h6']['font-family'])) ? ('font-family:' . $pacz_settings['heading-font-h6']['font-family'] . ';') : $heading_font_family ;
	$p_font_size = (isset($pacz_settings['p-text-size']) && !empty($pacz_settings['p-text-size'])) ? $pacz_settings['p-text-size'] : $pacz_settings['body-font']['font-size'];
	$cart_link_color_regular = (isset($pacz_settings['header_cart_link_color']['regular']))? ('color:'. $pacz_settings['header_cart_link_color']['regular'] .';') : '';
	$cart_link_color_hover = (isset($pacz_settings['header_cart_link_color']['hover']))? ('color:'. $pacz_settings['header_cart_link_color']['hover'] .';') : '';
	$cart_link_color_bg = (isset($pacz_settings['header_cart_link_color']['bg']) && !empty($pacz_settings['header_cart_link_color']['bg']))? ('background:'. $pacz_settings['header_cart_link_color']['bg'] .';') : '';
	$cart_link_color_bghover = (isset($pacz_settings['header_cart_link_color']['bg-hover']) && !empty($pacz_settings['header_cart_link_color']['bg-hover']))? ('background:'. $pacz_settings['header_cart_link_color']['bg-hover'] .';') : '';
	$cart_link_color_border = (isset($pacz_settings['header_cart_link_color']['bg']) && !empty($pacz_settings['header_cart_link_color']['bg']))? ('border-color:'. $pacz_settings['header_cart_link_color']['bg'] .';') : '';
	$cart_link_color_borderhover = (isset($pacz_settings['header_cart_link_color']['bg-hover']) && !empty($pacz_settings['header_cart_link_color']['bg-hover']))? ('border-color:'. $pacz_settings['header_cart_link_color']['bg-hover'] .';') : '';
	Pacz_Static_Files::addGlobalStyle("
	
	body{
	line-height: 20px;
{$body_font_backup}
{$body_font_family}
	font-size:{$pacz_settings['body-font']['font-size']};
	color:{$pacz_settings['body-txt-color']};
}

{$typekit_fonts_1}

p {
	font-size:{$p_font_size}px;
	color:{$pacz_settings['body-txt-color']};
	line-height:{$pacz_settings['p-line-height']}px;
}

#pacz-footer p {
	font-size:{$pacz_settings['footer-p-text-size']}px;
}
a {
	color:{$pacz_settings['link-color']['regular']};
}

a:hover {
	color:{$pacz_settings['link-color']['hover']};
}


.outline-button{
	background-color:{$pacz_settings['accent-color']} !important;
	}
.tweet-icon{
	border-color:{$pacz_settings['accent-color']};
	color:{$pacz_settings['accent-color']};
	
	}
.tweet-user,
.tweet-time{
	color:{$pacz_settings['accent-color']};
	
	}
#theme-page .pacz-custom-heading h4:hover{
	color:{$pacz_settings['heading-color']};
	
}

.title-divider span{background:{$pacz_settings['accent-color']};}
#theme-page h1,
#theme-page h2,
#theme-page h3,
#theme-page h4,
#theme-page h5,
#theme-page h6,
.subscription-form .title h5
{
	font-weight:{$pacz_settings['heading-font']['font-weight']};
	color:{$pacz_settings['heading-color']};
}
#theme-page h1:hover,
#theme-page h2:hover,
#theme-page h3:hover,
#theme-page h4:hover,
#theme-page h5:hover,
#theme-page h6:hover
{
	
}
.blog-tile-entry .blog-entry-heading .blog-title a,
.blog-title a,
.leave-comment-heading{
	color:{$pacz_settings['heading-color']};
}

.blog-tile-entry .blog-entry-heading .blog-title a:hover,
.blog-title a:hover,
.blog-tile-entry .item-holder .metatime a{
	color:{$pacz_settings['accent-color']};
}
.blog-tile-entry.tile-elegant .metatime a,
.blog-tile-entry.tile-elegant .blog-comments,
.blog-tile-entry.tile-elegant .author,
.blog-tile-entry.tile-elegant .author span:hover{
	color:{$pacz_settings['link-color']['regular']};
}
.blog-tile-entry.tile-elegant .metatime a:hover,
.blog-tile-entry.tile-elegant .blog-comments:hover,
.blog-tile-entry.tile-elegant .author:hover{
	color:{$pacz_settings['link-color']['hover']};
}
.tile-elegant .blog-readmore-btn a{
	color:{$pacz_settings['heading-color']};
}
.author-title{
	color:{$pacz_settings['heading-color']};
	{$heading_font_family}
}
.tile-elegant .blog-readmore-btn a:hover{
	color:{$pacz_settings['accent-color']};
}

.tile-elegant .blog-readmore-btn:hover:before,
.blog-tile-entry.tile-elegant .blog-meta::before{
	background:{$pacz_settings['accent-color']};
}

.countdown_style_five ul li .countdown-timer{
	color:{$pacz_settings['heading-color']} !important;
	
}
.owl-nav .owl-prev, .owl-nav .owl-next{
	color:{$pacz_settings['accent-color']};
	
	}
.owl-nav .owl-prev:hover, .owl-nav .owl-next:hover{
	background:{$pacz_settings['accent-color']};
	
	}

.countdown_style_five ul li .countdown-text{
	color:{$pacz_settings['body-txt-color']} !important;
	
}

.single-social-share li a:hover,
.pacz-next-prev .pacz-next-prev-wrap a:hover {
  color: {$pacz_settings['accent-color']};
}


h1, h2, h3, h4, h5, h6{
	{$heading_font_family}
}
h2{
	{$heading_font_family_h2}
}
h3{
	{$heading_font_family_h3}
}
h4{
	{$heading_font_family_h4}
}
h5{
	{$heading_font_family_h5}
}
h5{
	{$heading_font_family_h6}
}
#pacz-footer .widget_posts_lists ul li .post-list-title{
	{$heading_font_family_h6}
}

input,
button,
textarea {
{$body_font_family}}

.comments-heading-label{
	{$heading_font_family_h5}
	color:{$pacz_settings['heading-color']};
	
}
");

###########################################
# Main Navigation
###########################################

	$nav_text_align = (isset($pacz_settings['nav-alignment']) && !empty($pacz_settings['nav-alignment'])) ? ('text-align:' . $pacz_settings['nav-alignment'] . ';') : ('text-align:left;');

	$main_nav_font_family = (isset($pacz_settings['main-nav-font']['font-family']) && !empty($pacz_settings['main-nav-font']['font-family'])) ? ('font-family:' . $pacz_settings['main-nav-font']['font-family'] . ';') : '';

	if($pacz_settings['header-structure'] == 'vertical'){
		$main_nav_top_level_space = (isset($pacz_settings['main-nav-item-space']) && !empty($pacz_settings['main-nav-item-space']) && isset($pacz_settings['vertical-nav-item-space']) && !empty($pacz_settings['vertical-nav-item-space'])) ? ('padding:'. $pacz_settings['vertical-nav-item-space'] . 'px ' . $pacz_settings['main-nav-item-space'] . 'px;') : ('padding: 9px 15px;');
		$plus_for_submenu = $pacz_settings['main-nav-item-space'] + 10;
		$main_nav_top_level_space_lr = (isset($pacz_settings['main-nav-item-space'])) && !empty($pacz_settings['main-nav-item-space']) ? ('padding: 0 '.$plus_for_submenu .'px ;') : ('padding: 0 15px;');

		$main_nav_top_level_space_bt = isset($pacz_settings['vertical-nav-item-space']) && !empty($pacz_settings['vertical-nav-item-space']) ? ('padding:'. $pacz_settings['vertical-nav-item-space'] . 'px 0;') : ('padding: 9px 0;');

		
	}else{
		$main_nav_top_level_space = (isset($pacz_settings['main-nav-item-space'])) && !empty($pacz_settings['main-nav-item-space']) ? ('padding: 0 ' . $pacz_settings['main-nav-item-space'] . 'px;') : ('padding: auto 17px;');
	}
	

	$main_nav_top_level_font_size = 'font-size:' . $pacz_settings['main-nav-font']['font-size'] . ';';

	$main_nav_top_level_font_transform = (isset($pacz_settings['main-nav-top-transform']) && !empty($pacz_settings['main-nav-top-transform'])) ? ('text-transform: ' . $pacz_settings['main-nav-top-transform'] . ';') : ('text-transform: uppercase;');

	$main_nav_top_level_font_weight = 'font-weight:' . $pacz_settings['main-nav-font']['font-weight'] . ';';

	$main_nav_sub_level_font_size = (isset($pacz_settings['sub-nav-top-size']) && !empty($pacz_settings['sub-nav-top-size'])) ? ('font-size:' . $pacz_settings['sub-nav-top-size'] . 'px;') : ('font-size:' . $pacz_settings['main-nav-font']['font-size'] . 'px;');

	$main_nav_sub_level_font_transform = (isset($pacz_settings['sub-nav-top-transform']) && !empty($pacz_settings['sub-nav-top-transform'])) ? ('text-transform: ' . $pacz_settings['sub-nav-top-transform'] . ';') : ('text-transform: uppercase;');
	
	$main_nav_sub_level_font_weight = (isset($pacz_settings['sub-nav-top-weight']) && !empty($pacz_settings['sub-nav-top-weight'])) ? ('font-weight:' . $pacz_settings['sub-nav-top-weight'] . ';') : ('font-weight:' . $pacz_settings['main-nav-font']['font-weight'] . ';');
	
	
	$header_toolbar_height = $logo_height;
	$header_height = ($pacz_header_padding * 2) + $logo_height;
	if ($squeeze_sticky_header) {
		$sticky_logo_height = round($logo_height / 1.5);
		$sticky_header_padding = round($pacz_header_padding / 2);
		$header_sticky_height = $sticky_logo_height + $pacz_header_padding;
	} else {
		$sticky_logo_height = $logo_height;
		$sticky_header_padding = $pacz_header_padding;
		$header_sticky_height = round($logo_height+(($pacz_header_padding) * 2));
	}
	$resposive_logo_height = round($logo_height / 1.5);
	$responsive_header_height = ($pacz_header_padding * 2) + $resposive_logo_height;
	$header_vertical_width = (isset($pacz_settings['header-vertical-width']) && !empty($pacz_settings['header-vertical-width'])) ? $pacz_settings['header-vertical-width'] : ('280');
	$header_vertical_padding = (isset($pacz_settings['header-padding-vertical']) && !empty($pacz_settings['header-padding-vertical'])) ? $pacz_settings['header-padding-vertical'] : ('30'); 

	$vertical_nav_width = $header_vertical_width - ($header_vertical_padding * 2);
	
	# Header Toolbar
	if($pacz_settings['header-toolbar'] == 1){
		$header_height_with_toolbar = $header_toolbar_height+($pacz_settings['header-padding'] * 2) + 30;
	}else{
		$header_height_with_toolbar = $logo_height+($pacz_settings['header-padding'] * 2);
	}
	$toolbar_border = isset($pacz_settings['toolbar-border-top']) && ($pacz_settings['toolbar-border-top'] == 1) ? '' : 'border:none;';
	$sticky_triger_translate = $header_toolbar_height + 60;
	//$sticky_header_padding_top = $logo_height+($pacz_settings['header-padding'] * 2) +100;
	$header_hover_style1_padding = $pacz_settings['header-padding'] / 1.8;
	if($pacz_settings['header-toolbar'] == 1){
		Pacz_Static_Files::addGlobalStyle("
		#pacz-header {
    box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
}
		");
	}
	$header_style = 'transparent';
	if($pacz_settings['header-toolbar'] == 1 && $header_style == 'transparent'){
		Pacz_Static_Files::addGlobalStyle("
		#pacz-header.transparent-header{
			top: {$toolbar_height}px;
			
		}
		#pacz-header.transparent-header.sticky-trigger-header {
			top: 0px !important;
			position:fixed !important;
			
		}
		");
	}else{
		$header_height_with_toolbar = $logo_height+($pacz_settings['header-padding'] * 2);
	}
if($pacz_settings['header-structure'] == 'full'){
	Pacz_Static_Files::addGlobalStyle("
	#pacz-header{
		padding-left:60px;
		padding-right:60px;
	}
	#pacz-header .pacz-grid{
		width:100%;
		max-width:100%;
	}
");
}
if($pacz_settings['header-logo-location'] == 'header_toolbar' && $pacz_settings['header-align'] == 'left'){
Pacz_Static_Files::addGlobalStyle("	
#pacz-header{border:0;}
#pacz-main-navigation{}
#pacz-main-navigation > ul { float: left;}
#pacz-main-navigation > ul li.menu-item { float: left;}
");
}


Pacz_Static_Files::addGlobalStyle("
.header-searchform-input input[type=text]{
	background-color:{$pacz_settings['header-bg']['background-color']};
}

.theme-main-wrapper:not(.vertical-header) .sticky-header.sticky-header-padding {
	
}
body:not(.vertical-header).sticky--header-padding .sticky-header-padding.sticky-header {
	
}

.bottom-header-padding.none-sticky-header {
	padding-top:{$header_height}px;	
}

.bottom-header-padding.none-sticky-header {
	padding-top:{$header_height}px;	
}

.bottom-header-padding.sticky-header {
	padding-top:{$header_sticky_height}px;	
}
.listing-btn{
	display:inline-block;
	
	}
");
if($pacz_settings['preset_headers'] != 12){
Pacz_Static_Files::addGlobalStyle("
#pacz-header:not(.header-structure-vertical) #pacz-main-navigation > ul > li.menu-item,
#pacz-header:not(.header-structure-vertical) #pacz-main-navigation > ul > li.menu-item > a,
#pacz-header:not(.header-structure-vertical) .pacz-header-search,
#pacz-header:not(.header-structure-vertical) .pacz-header-search a,
#pacz-header:not(.header-structure-vertical) .pacz-header-wpml-ls,
#pacz-header:not(.header-structure-vertical) .pacz-header-wpml-ls a,
#pacz-header:not(.header-structure-vertical) .pacz-shopping-cart,
#pacz-header:not(.header-structure-vertical) .pacz-responsive-cart-link,
#pacz-header:not(.header-structure-vertical) .dashboard-trigger,
#pacz-header:not(.header-structure-vertical) .pacz-header-social,
#pacz-header:not(.header-structure-vertical) .pacz-margin-header-burger,
#pacz-header:not(.header-structure-vertical) .listing-btn,
#pacz-header:not(.header-structure-vertical) .logreg-header,
.theme-main-header .responsive-nav-link
{
	height:{$header_height}px;
	line-height:{$header_height}px;
}
");
}
if($pacz_settings['preset_headers'] == 12){
	Pacz_Static_Files::addGlobalStyle("
	#pacz-header:not(.header-structure-vertical){
		padding-top:25px;
		padding-bottom:25px;
	}
	.classiads-fantro-logo{
		min-height:1px;
	}
	.pacz-header-logo{
		margin:0 !important;
		position:absolute;
		top:50%;
		left:0;
		transform:translateY(-50%);
	}
	.logreg-header .dropdown{
		margin-top:-10px;
	}
	.logreg-header .dropdown .author-nicename{
		display:none;
	}
	.logreg-header .dropdown .author-displayname {
		font-size: 14px;
	}
	.search-form-style-header1 .listing-btn{float:right;}
	.search-form-style-header1 .listing-btn .listing-header-btn,
	.search-form-style-header1 .listing-btn .directorypress-new-listing-button .btn-primary,
	.search-form-style-header1 .listing-btn .submit-listing-button-single.btn-primary{
		font-size:14px;
		min-width:150px;
		line-height:44px;
		min-height:44px;
		border-radius:5px;
		margin-left:15px;
	}
");
}
Pacz_Static_Files::addGlobalStyle("
#pacz-header:not(.header-structure-vertical).sticky-trigger-header #pacz-main-navigation > ul > li.menu-item,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header #pacz-main-navigation > ul > li.menu-item > a,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header .pacz-header-search,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header .pacz-header-search a,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header .pacz-shopping-cart,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header .pacz-responsive-cart-link,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header .dashboard-trigger,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header .pacz-header-social,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header .pacz-margin-header-burger,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header .pacz-header-wpml-ls,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header .pacz-header-wpml-ls a,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header .listing-btn,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header .logreg-header
{
	height:{$header_sticky_height}px;
	line-height:{$header_sticky_height}px;
}
#pacz-header:not(.header-structure-vertical).header-style-v12.sticky-trigger-header #pacz-main-navigation > ul > li.menu-item,
#pacz-header:not(.header-structure-vertical).header-style-v12.sticky-trigger-header #pacz-main-navigation > ul > li.menu-item > a,
#pacz-header:not(.header-structure-vertical).header-style-v12.sticky-trigger-header .pacz-header-search,
#pacz-header:not(.header-structure-vertical).header-style-v12.sticky-trigger-header .pacz-header-search a,
#pacz-header:not(.header-structure-vertical).header-style-v12.sticky-trigger-header .pacz-shopping-cart,
#pacz-header:not(.header-structure-vertical).header-style-v12.sticky-trigger-header .pacz-responsive-cart-link,
#pacz-header:not(.header-structure-vertical).header-style-v12.sticky-trigger-header .dashboard-trigger,
#pacz-header:not(.header-structure-vertical).header-style-v12.sticky-trigger-header .pacz-header-social,
#pacz-header:not(.header-structure-vertical).header-style-v12.sticky-trigger-header .pacz-margin-header-burger,
#pacz-header:not(.header-structure-vertical).header-style-v12.sticky-trigger-header .pacz-header-wpml-ls,
#pacz-header:not(.header-structure-vertical).header-style-v12.sticky-trigger-header .pacz-header-wpml-ls a,
#pacz-header:not(.header-structure-vertical).header-style-v12.sticky-trigger-header .listing-btn 
{
	height:auto;
	line-height:inherit;
}
.main-navigation-ul a.pacz-login-2,
.main-navigation-ul a.pacz-logout-2,
.main-navigation-ul a.pacz-register-2{
	line-height:{$header_height}px;
	color:{$pacz_settings['main-nav-top-color']['regular']};
	background-color:{$pacz_settings['main-nav-top-color']['bg']};
	
}
.main-navigation-ul .logreg-header i{
	color:{$pacz_settings['main-nav-top-color']['regular']};
}
.main-navigation-ul a.pacz-login-2:hover,
.main-navigation-ul a.pacz-logout-2:hover,
.main-navigation-ul a.pacz-register-2:hover{
	line-height:{$header_height}px;
	color:{$pacz_settings['main-nav-top-color']['hover']};
	background-color:{$pacz_settings['main-nav-top-color']['bg-hover']};
	
}
.transparent-header:not(.sticky-trigger-header) .main-navigation-ul a.pacz-login-2,
.transparent-header:not(.sticky-trigger-header) .main-navigation-ul a.pacz-logout-2,
.transparent-header:not(.sticky-trigger-header) .main-navigation-ul a.pacz-register-2{
	line-height:{$header_height}px;
	color:{$pacz_settings['main-nav-top-color-transparent']['regular']};
	background-color:{$pacz_settings['main-nav-top-color-transparent']['bg']};
	
}
.transparent-header:not(.sticky-trigger-header) .main-navigation-ul .logreg-header .pacz-login-2-div,
.transparent-header:not(.sticky-trigger-header) .main-navigation-ul .logreg-header i{
	color:{$pacz_settings['main-nav-top-color-transparent']['regular']};
}
.transparent-header:not(.sticky-trigger-header) .main-navigation-ul a.pacz-login-2:hover,
.transparent-header:not(.sticky-trigger-header) .main-navigation-ul a.pacz-logout-2:hover,
.transparent-header:not(.sticky-trigger-header) .main-navigation-ul a.pacz-register-2:hover{
	line-height:{$header_height}px;
	color:{$pacz_settings['main-nav-top-color-transparent']['hover']};
	background-color:{$pacz_settings['main-nav-top-color-transparent']['bg-hover']};
	
}
");

	if (isset($pacz_settings['squeeze-sticky-header']) && ($pacz_settings['squeeze-sticky-header'])) {
		Pacz_Static_Files::addGlobalStyle("
	#pacz-header:not(.header-structure-vertical).sticky-trigger-header #pacz-main-navigation > ul > li.menu-item > a {
		padding-left:15px;
		padding-right:15px;
	}
	");
	}

	Pacz_Static_Files::addGlobalStyle(".pacz-header-logo,
.pacz-header-logo a{
	height:{$logo_height}px;
	line-height:{$logo_height}px;
}

#pacz-header:not(.header-structure-vertical).sticky-trigger-header .pacz-header-logo,
#pacz-header:not(.header-structure-vertical).sticky-trigger-header .pacz-header-logo a{
	height:{$sticky_logo_height}px;
	line-height:{$sticky_logo_height}px;
}

.vertical-expanded-state #pacz-header.header-structure-vertical,
.vertical-condensed-state  #pacz-header.header-structure-vertical:hover{
	width: {$header_vertical_width}px !important;
}

#pacz-header.header-structure-vertical{
	padding-left: {$header_vertical_padding}px !important;
	padding-right: {$header_vertical_padding}px !important;
}

.vertical-condensed-state .pacz-vertical-menu {
  width:{$vertical_nav_width}px;
}


.theme-main-wrapper.vertical-expanded-state #theme-page > .pacz-main-wrapper-holder,
.theme-main-wrapper.vertical-expanded-state #theme-page > .pacz-page-section,
.theme-main-wrapper.vertical-expanded-state #theme-page > .wpb_row,
.theme-main-wrapper.vertical-expanded-state #pacz-page-title,
.theme-main-wrapper.vertical-expanded-state #pacz-footer {
	padding-left: {$header_vertical_width}px;
}

@media handheld, only screen and (max-width:{$pacz_settings['res-nav-width']}px) {
	.theme-main-wrapper.vertical-expanded-state #theme-page > .pacz-main-wrapper-holder,
	.theme-main-wrapper.vertical-expanded-state #theme-page > .pacz-page-section,
	.theme-main-wrapper.vertical-expanded-state #theme-page > .wpb_row,
	.theme-main-wrapper.vertical-expanded-state #pacz-page-title,
	.theme-main-wrapper.vertical-expanded-state #pacz-footer,
	.theme-main-wrapper.vertical-condensed-state #theme-page > .pacz-main-wrapper-holder,
	.theme-main-wrapper.vertical-condensed-state #theme-page > .pacz-page-section,
	.theme-main-wrapper.vertical-condensed-state #theme-page > .wpb_row,
	.theme-main-wrapper.vertical-condensed-state #pacz-page-title,
	.theme-main-wrapper.vertical-condensed-state #pacz-footer {
		padding-left: 0px;
	}
	.pacz-header-logo{
		
	}
	.header-align-left .pacz-header-logo{
		left:30px;
		right:auto;
	}
	.header-align-right .pacz-header-logo{
		left:auto;
		right:30px;
	}

.pacz-header-logo a{
	height:{$resposive_logo_height}px;
	line-height:{$resposive_logo_height}px;
	margin-top: 0px !important;
	margin-bottom: 0px !important;
}

	
}

.theme-main-wrapper.vertical-header #pacz-page-title,
.theme-main-wrapper.vertical-header #pacz-footer,
.theme-main-wrapper.vertical-header #pacz-header,
.theme-main-wrapper.vertical-header #pacz-header.header-structure-vertical .pacz-vertical-menu{
	box-sizing: border-box;
}


@media handheld, only screen and (min-width:{$pacz_settings['res-nav-width']}px) {
	.vertical-condensed-state #pacz-header.header-structure-vertical:hover ~ #theme-page > .pacz-main-wrapper-holder,
	.vertical-condensed-state #pacz-header.header-structure-vertical:hover ~ #theme-page > .pacz-page-section,
	.vertical-condensed-state #pacz-header.header-structure-vertical:hover ~ #theme-page > .wpb_row,
	.vertical-condensed-state #pacz-header.header-structure-vertical:hover ~ #pacz-page-title,
	.vertical-condensed-state #pacz-header.header-structure-vertical:hover ~ #pacz-footer {
		padding-left: {$header_vertical_width}px ;
	}
}

.pacz-header-logo,
#pacz-header.header-style-v13 .search-form-style-header1-wrapper
 {
	margin-top: {$pacz_header_padding}px;
	margin-bottom: {$pacz_header_padding}px;
}


#pacz-header:not(.header-structure-vertical).sticky-trigger-header .pacz-header-logo,
#pacz-header:not(.header-structure-vertical).header-style-v13.sticky-trigger-header .search-form-style-header1-wrapper
{
	margin-top:{$sticky_header_padding}px;
	margin-bottom: {$sticky_header_padding}px;
}


#pacz-main-navigation > ul > li.menu-item > a {
	{$main_nav_top_level_space}
	{$main_nav_font_family}
	{$main_nav_top_level_font_size}
	{$main_nav_top_level_font_transform}
	{$main_nav_top_level_font_weight}
}

.pacz-header-logo.pacz-header-logo-center{
	{$main_nav_top_level_space}
}
#pacz-main-navigation > ul > li.pacz-shopping-cart {
	{$main_nav_top_level_space}
}
#pacz-main-navigation > ul > li.pacz-shopping-cart a.pacz-cart-link{
	{$cart_link_color_regular}
	{$cart_link_color_bg}
	{$cart_link_color_border}
}
#pacz-main-navigation > ul > li.pacz-shopping-cart a.pacz-cart-link:hover {
	{$cart_link_color_hover}
	{$cart_link_color_bghover}
	{$cart_link_color_borderhover}
}

.pacz-vertical-menu > li.menu-item > a {
	{$main_nav_top_level_space}
	{$main_nav_font_family}
	{$main_nav_top_level_font_size}
	{$main_nav_top_level_font_transform}
	{$main_nav_top_level_font_weight}
}
");

	if ($pacz_settings['header-structure'] == 'vertical') {
		Pacz_Static_Files::addGlobalStyle("
	.header-structure-vertical .pacz-vertical-menu > .menu-item > .sub-menu {
		{$main_nav_top_level_space_lr}
	}
	");
	}

	Pacz_Static_Files::addGlobalStyle("


.pacz-vertical-menu li.menu-item > a,
.pacz-vertical-menu .pacz-header-logo {
	{$nav_text_align} 
}

.main-navigation-ul > li ul.sub-menu li.menu-item a.menu-item-link{
	{$main_nav_sub_level_font_size}
	{$main_nav_sub_level_font_transform}
	{$main_nav_sub_level_font_weight}
}

.pacz-vertical-menu > li ul.sub-menu li.menu-item a{
	{$main_nav_sub_level_font_size}
	{$main_nav_sub_level_font_transform}
	{$main_nav_sub_level_font_weight}
}

#pacz-main-navigation > ul > li.menu-item > a,
.pacz-vertical-menu li.menu-item > a
{
	color:{$pacz_settings['main-nav-top-color']['regular']};
	background-color:{$pacz_settings['main-nav-top-color']['bg']};
}
.transparent-header:not(.sticky-trigger-header) #pacz-main-navigation > ul > li.menu-item > a,
.transparent-header:not(.sticky-trigger-header) .pacz-vertical-menu li.menu-item > a
{
	color:{$pacz_settings['main-nav-top-color-transparent']['regular']};
	background-color:{$pacz_settings['main-nav-top-color-transparent']['bg']};
}

#pacz-main-navigation > ul > li.current-menu-item > a,
#pacz-main-navigation > ul > li.current-menu-ancestor > a,
#pacz-main-navigation > ul > li.menu-item:hover > a
{
	color:{$pacz_settings['main-nav-top-color']['hover']};
	background-color:{$pacz_settings['main-nav-top-color']['bg-hover']};
}
.transparent-header:not(.sticky-trigger-header) #pacz-main-navigation > ul > li.current-menu-item > a,
.transparent-header:not(.sticky-trigger-header) #pacz-main-navigation > ul > li.current-menu-ancestor > a,
.transparent-header:not(.sticky-trigger-header) #pacz-main-navigation > ul > li.menu-item:hover > a
{
	color:{$pacz_settings['main-nav-top-color-transparent']['hover']};
	background-color:{$pacz_settings['main-nav-top-color-transparent']['bg-hover']};
}
.header-hover-style-1 .nav-hover-style1{
	bottom: {$pacz_settings['header-padding']}px;
    left: 0;
    line-height: 2px !important;
    margin: 0 -1.5px;
    position: absolute;
    right: 0;
}

.header-hover-style-1.sticky-trigger-header .nav-hover-style1{
	bottom: {$header_hover_style1_padding}px;
}

.header-hover-style-1 .nav-hover-style1 span{
		margin:0 1.5px;
		display:inline-block;
		width:8px;
		height:2px;
		background:{$pacz_settings['main-nav-top-color']['hover']};
}
.transparent-header:not(.sticky-trigger-header) .header-hover-style-1 .nav-hover-style1 span{
	background:{$pacz_settings['main-nav-top-color-transparent']['hover']};
}
.header-hover-style-1 .sub-menu .nav-hover-style1{display:none;}
.pacz-vertical-menu > li.current-menu-item > a,
.pacz-vertical-menu > li.current-menu-ancestor > a,
.pacz-vertical-menu > li.menu-item:hover > a,
.pacz-vertical-menu ul li.menu-item:hover > a {
	color:{$pacz_settings['main-nav-top-color']['hover']};
}



#pacz-main-navigation > ul > li.menu-item > a:hover
{
	color:{$pacz_settings['main-nav-top-color']['hover']};
	background-color:{$pacz_settings['main-nav-top-color']['bg-hover']};
}

.dashboard-trigger,
.res-nav-active,
.pacz-responsive-cart-link {
	color:{$pacz_settings['main-nav-top-color']['regular']};
}

.dashboard-trigger:hover,
.res-nav-active:hover {
	color:{$pacz_settings['main-nav-top-color']['hover']};
}

.transparent-header:not(.sticky-trigger-header) #pacz-main-navigation > ul > li.menu-item > a:hover
{
	color:{$pacz_settings['main-nav-top-color-transparent']['hover']};
	background-color:{$pacz_settings['main-nav-top-color-transparent']['bg-hover']};
}

.transparent-header:not(.sticky-trigger-header) .dashboard-trigger,
.transparent-header:not(.sticky-trigger-header) .pacz-responsive-cart-link {
	color:{$pacz_settings['main-nav-top-color-transparent']['regular']};
}

.transparent-header:not(.sticky-trigger-header) .dashboard-trigger:hover{
	color:{$pacz_settings['main-nav-top-color-transparent']['hover']};
}

");

if (isset($pacz_settings['navigation-border-top']) && ($pacz_settings['navigation-border-top'] == 1)) {
		Pacz_Static_Files::addGlobalStyle("
		#pacz-main-navigation ul li.no-mega-menu > ul,
		#pacz-main-navigation ul li.has-mega-menu > ul,
		#pacz-main-navigation ul li.pacz-header-wpml-ls > ul{
			border-top:1px solid {$accent_color};
		}");
}


Pacz_Static_Files::addGlobalStyle("#pacz-main-navigation ul li.no-mega-menu ul,
#pacz-main-navigation > ul > li.has-mega-menu > ul,
.header-searchform-input .ui-autocomplete,
.pacz-shopping-box,
.shopping-box-header > span,
#pacz-main-navigation ul li.pacz-header-wpml-ls > ul {
	background-color:{$pacz_settings['main-nav-sub-bg']};
}

#pacz-main-navigation ul ul.sub-menu a.menu-item-link,
#pacz-main-navigation ul li.pacz-header-wpml-ls > ul li a
{
	color:{$pacz_settings['main-nav-sub-color']['regular']};
}

#pacz-main-navigation ul ul.sub-menu a.menu-item-link,
#pacz-main-navigation ul li.pacz-header-wpml-ls > ul li a
{
	color:{$pacz_settings['main-nav-sub-color']['regular']};
}

#pacz-main-navigation ul ul li.current-menu-item > a.menu-item-link,
#pacz-main-navigation ul ul li.current-menu-ancestor > a.menu-item-link {
	color:{$pacz_settings['main-nav-sub-color']['hover']};
	background-color:{$pacz_settings['main-nav-sub-color']['bg-active']} !important;
}


.header-searchform-input .ui-autocomplete .search-title,
.header-searchform-input .ui-autocomplete .search-date,
.header-searchform-input .ui-autocomplete i
{
	color:{$pacz_settings['main-nav-sub-color']['regular']};
}
.header-searchform-input .ui-autocomplete i,
.header-searchform-input .ui-autocomplete img
{
	border-color:{$pacz_settings['main-nav-sub-color']['regular']};
}

.header-searchform-input .ui-autocomplete li:hover  i,
.header-searchform-input .ui-autocomplete li:hover img
{
	border-color:{$pacz_settings['main-nav-sub-color']['hover']};
}


#pacz-main-navigation .megamenu-title,
.pacz-mega-icon,
.pacz-shopping-box .mini-cart-title,
.pacz-shopping-box .mini-cart-button {
	color:{$pacz_settings['main-nav-sub-color']['regular']};
}

#pacz-main-navigation ul ul.sub-menu a.menu-item-link:hover,
.header-searchform-input .ui-autocomplete li:hover,
#pacz-main-navigation ul li.pacz-header-wpml-ls > ul li a:hover
{
	color:{$pacz_settings['main-nav-sub-color']['hover']};
	background-color:{$pacz_settings['main-nav-sub-color']['bg-hover']} !important;
}

.header-searchform-input .ui-autocomplete li:hover .search-title,
.header-searchform-input .ui-autocomplete li:hover .search-date,
.header-searchform-input .ui-autocomplete li:hover i,
#pacz-main-navigation ul ul.sub-menu a.menu-item-link:hover i
{
	color:{$pacz_settings['main-nav-sub-color']['hover']};
}


.header-searchform-input input[type=text],
.dashboard-trigger,
.header-search-icon,
.header-search-close,
.header-wpml-icon
{
	color:{$pacz_settings['main-nav-top-color']['regular']};
}
.transparent-header:not(.sticky-trigger-header) .header-searchform-input input[type=text],
.transparent-header:not(.sticky-trigger-header) .dashboard-trigger,
.transparent-header:not(.sticky-trigger-header) .header-search-icon,
.transparent-header:not(.sticky-trigger-header) .header-search-close,
.transparent-header:not(.sticky-trigger-header) .header-wpml-icon
{
	color:{$pacz_settings['main-nav-top-color-transparent']['regular']};
}

");

$header_search_icon_color = (isset($pacz_settings['header-search-icon-color']) && !empty($pacz_settings['header-search-icon-color'])) ? $pacz_settings['header-search-icon-color'] : $pacz_settings['main-nav-top-color']['regular'];

Pacz_Static_Files::addGlobalStyle("
.header-search-icon {
	color:{$header_search_icon_color};	
}

.pacz-burger-icon div {
      background-color:{$pacz_settings['main-nav-top-color']['regular']};
 }



.header-search-icon:hover
{
	color: {$pacz_settings['main-nav-top-color']['regular']};
}


.responsive-shopping-box
{
	background-color:{$pacz_settings['main-nav-sub-bg']};
}

.pacz-responsive-nav a,
.pacz-responsive-nav .has-mega-menu .megamenu-title
{
	color:#fff;
	background-color:{$pacz_settings['main-nav-sub-color']['bg']};
}

");

$header_border_bottom_color = (isset($pacz_settings['toolbar-border-bottom-color']) && !empty($pacz_settings['toolbar-border-bottom-color'])) ? $pacz_settings['toolbar-border-bottom-color'] : 'transparent';
$header_phone_email_icon_color = (isset($pacz_settings['toolbar-phone-email-icon-color']) && !empty($pacz_settings['toolbar-phone-email-icon-color'])) ? $pacz_settings['toolbar-phone-email-icon-color'] : $pacz_settings['toolbar-text-color'];
if(isset($pacz_settings['toolbar-grid']) && $pacz_settings['toolbar-grid'] == 1){
Pacz_Static_Files::addGlobalStyle("
.pacz-header-toolbar {
	padding-left:50px;
	padding-right:50px;
}
");	
}

$social_link_bg = (isset($pacz_settings['toolbar-social-link-color-bg']['rgba'])) ? $pacz_settings['toolbar-social-link-color-bg']['rgba'] : '';
$social_link_bg_hover = (isset($pacz_settings['toolbar-social-link-color']['bg-hover'])) ? $pacz_settings['toolbar-social-link-color']['bg-hover'] : '';
Pacz_Static_Files::addGlobalStyle("
.pacz-header-toolbar {
	{$toolbar_border}	
	
	border-color:{$header_border_bottom_color};
}
.pacz-header-toolbar span {
	color:{$pacz_settings['toolbar-text-color']};	
}

.pacz-header-toolbar span i {
	color:{$header_phone_email_icon_color};	
}

.pacz-header-toolbar a{
	color:{$pacz_settings['toolbar-link-color']['regular']};	
}
.pacz-header-toolbar a:hover{
	color:{$pacz_settings['toolbar-link-color']['hover']};	
}

.pacz-header-toolbar a{
	color:{$pacz_settings['toolbar-link-color']['regular']};	
}
.pacz-header-toolbar .pacz-header-toolbar-social li a,
.pacz-header-social a{
	color:{$pacz_settings['toolbar-social-link-color']['regular']} !important;	
	background-color:{$social_link_bg};	
}
.pacz-header-toolbar .pacz-header-toolbar-social li a:hover,
.pacz-header-social a:hover{
	color:{$pacz_settings['toolbar-social-link-color']['hover']} !important;
	background-color:{$social_link_bg_hover};	
}

.single-listing .modal-dialog {
	margin-top:{$header_height}px;	
}
");

###########################################
	# Responsive Mode
	###########################################

	$grid_width_100 = $pacz_settings['grid-width']+100;

	Pacz_Static_Files::addGlobalStyle("

@media handheld, only screen and (max-width: {$grid_width_100}px)
{

.dashboard-trigger.res-mode {
	display:block !important;
}

.dashboard-trigger.desktop-mode {
	display:none !important;
}

}



@media only screen and (max-width: {$pacz_settings['res-nav-width']}px)
{

#pacz-header.sticky-header,
.pacz-secondary-header,
.transparent-header-sticky {
	position: relative !important;
	left:auto !important;
    right:auto!important;
    top:auto !important;
}

#pacz-header:not(.header-structure-vertical).put-header-bottom,
#pacz-header:not(.header-structure-vertical).put-header-bottom.sticky-trigger-header,
#pacz-header:not(.header-structure-vertical).put-header-bottom.header-offset-passed,
.admin-bar #pacz-header:not(.header-structure-vertical).put-header-bottom.sticky-trigger-header {
	position:relative;
	bottom:auto;
}

.pacz-margin-header-burger {
	display:none;
}

.main-navigation-ul li.menu-item,
.pacz-vertical-menu li.menu-item,
.main-navigation-ul li.sub-menu,
.sticky-header-padding,
.secondary-header-space
{
	display:none !important;
}
.theme-main-header .responsive-nav-link {
    display: inline-block;
}
.vertical-expanded-state #pacz-header.header-structure-vertical, .vertical-condensed-state #pacz-header.header-structure-vertical{
	width: 100% !important;
	height: auto !important;
}
.vertical-condensed-state  #pacz-header.header-structure-vertical:hover {
	width: 100% !important;
}
.header-structure-vertical .pacz-vertical-menu{
	position:relative;
	padding:0;
	width: 100%;
}
.header-structure-vertical .pacz-header-social.inside-grid{
	position:relative;
	padding:0;
	width: auto;
	bottom: inherit !important;
	height:{$header_height}px;
	line-height:{$header_height}px;
	float:right !important;
	top: 0 !important;
}
/*
.pacz-header-logo, .pacz-header-logo a {
	height:80px;
	line-height:80px;
}
#menu-main-navigation .pacz-header-logo {
	margin-bottom:20px;
	
}
.pacz-vertical-menu .responsive-nav-link {
	height:120px !important;
}
.pacz-vertical-header-burger {
	display:none!important;
}

.header-structure-vertical .pacz-header-social.inside-grid {
	height:120px;
	line-height:120px;
}
*/

.vertical-condensed-state .header-structure-vertical .pacz-vertical-menu>li.pacz-header-logo {
	-webkit-transform: translate(0,0);
	-moz-transform: translate(0,0);
	-ms-transform: translate(0,0);
	-o-transform: translate(0,0);
	opacity: 1!important;
	position: relative!important;
	left: 0!important;
}
.vertical-condensed-state .header-structure-vertical .pacz-vertical-header-burger{
	opacity:0 !important;
}


.pacz-header-logo {
	padding:0 !important;
}

.pacz-vertical-menu .responsive-nav-link{
	float:left !important;
	height:{$header_height}px;
}
.pacz-vertical-menu .responsive-nav-link i{
	height:{$header_height}px;
	line-height:{$header_height}px;
}
.pacz-vertical-menu .pacz-header-logo {
	float:left !important
}


.header-search-icon i,
.pacz-cart-link i{
	padding:0 !important;
	margin:0 !important;
	border:none !important;
}

.header-search-icon,
.pacz-cart-link{
	margin:0 8px !important;
	padding:0 !important;
}


.pacz-header-logo
{

	margin-left:20px !important;
	display:inline-block !important;
}


.main-navigation-ul
{
	text-align:center;
}
.header-align-left .main-navigation-ul{
	text-align:right;
}
.responsive-nav-link {
	display:inline-block !important;
}

.pacz-shopping-box {
	display:none !important;
}
.pacz-shopping-cart{
	display:none !important;
}
.pacz-responsive-shopping-cart{
	display: inline-block !important;
}

}


#pacz-header.transparent-header {
  position: absolute;
  left: 0;
}

.pacz-boxed-enabled #pacz-header.transparent-header {
  left: inherit;
}

.add-corner-margin .pacz-boxed-enabled #pacz-header.transparent-header {
  left: 0;
}

.transparent-header {
  transition: all 0.3s ease-in-out;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
}

.transparent-header.transparent-header-sticky {
  opacity: 1;
  left: auto !important;
}
.transparent-header #pacz-main-navigation ul li .sub {
  border-top: none;
}
.transparent-header .pacz-cart-link:hover,
.transparent-header .pacz-responsive-cart-link:hover,
.transparent-header .dashboard-trigger:hover,
.transparent-header .res-nav-active:hover,
.transparent-header .header-search-icon:hover {
  opacity: 0.7;
}
.transparent-header .header-searchform-input input[type=text] {
  background-color: transparent;
}
.transparent-header.light-header-skin .dashboard-trigger,
.transparent-header.light-header-skin .dashboard-trigger:hover,
.transparent-header.light-header-skin .res-nav-active,
.transparent-header.light-header-skin #pacz-main-navigation > ul > li.menu-item > a,
.transparent-header.light-header-skin #pacz-main-navigation > ul > li.current-menu-item > a,
.transparent-header.light-header-skin #pacz-main-navigation > ul > li.current-menu-ancestor > a,
.transparent-header.light-header-skin #pacz-main-navigation > ul > li.menu-item:hover > a,
.transparent-header.light-header-skin #pacz-main-navigation > ul > li.menu-item > a:hover,
.transparent-header.light-header-skin .res-nav-active:hover,
.transparent-header.light-header-skin .header-searchform-input input[type=text],
.transparent-header.light-header-skin .header-search-icon,
.transparent-header.light-header-skin .header-search-close,
.transparent-header.light-header-skin .header-search-icon:hover,
.transparent-header.light-header-skin .pacz-cart-link,
.transparent-header.light-header-skin .pacz-responsive-cart-link,
.transparent-header.light-header-skin .pacz-header-social a,
.transparent-header.light-header-skin .pacz-header-wpml-ls a{
  color: #fff;
}
.transparent-header.light-header-skin .pacz-burger-icon div {
  background-color: #fff;
}
.transparent-header.light-header-skin .pacz-light-logo {
  display: inline-block !important;
}
.transparent-header.light-header-skin .pacz-dark-logo {
  
}
.transparent-header.light-header-skin.transparent-header-sticky .pacz-light-logo {
  display: none !important;
}
.transparent-header.light-header-skin.transparent-header-sticky .pacz-dark-logo {
  display: inline-block !important;
}

");

	###########################################
	# Accent Color
	###########################################


	Pacz_Static_Files::addGlobalStyle("
.pacz-skin-color,
.rating-star .rated,
.widget_testimonials .testimonial-position,
.entry-meta .cats a,
.search-meta span a,
.search-meta span,
.single-share-trigger:hover,
.single-share-trigger.pacz-toggle-active,
.project_content_section .project_cats a,
.pacz-love-holder i:hover,
.blog-comments span,
.comment-count i:hover,
.widget_posts_lists li .cats a,
.pacz-tweet-shortcode span a,
.pacz-pricing-table .pacz-icon-star,
.pacz-process-steps.dark-skin .step-icon,
.pacz-sharp-next,
.pacz-sharp-prev,
.prev-item-caption,
.next-item-caption,
.pacz-employees.column_rounded-style .team-member-position, 
.pacz-employees.column-style .team-member-position,
.pacz-employees .team-info-wrapper .team-member-position,
.pacz-event-countdown.accent-skin .countdown-timer,
.pacz-event-countdown.accent-skin .countdown-text,
.pacz-box-text:hover i,
.pacz-process-steps.light-skin .pacz-step:hover .step-icon,
.pacz-process-steps.light-skin .active-step-item .step-icon,
.blog-tile-entry time a,
#login-register-password .userid:before,
#login-register-password .userpass:before,
#login-register-password .useremail:before,
#login-register-password .userfname:before,
#login-register-password .userlname:before,
.radio-check-item:before,
.reg-page-link
{
	color: {$accent_color};
}

.form-inner input.user-submit{
	background: {$accent_color} ;
	color:#fff;
}
.form-inner input.user-submit:hover{
	background: {$pacz_settings['btn-hover']} ;
	color:#fff;
}


.blog-thumb-entry .blog-thumb-content .blog-thumb-content-inner a.blog-readmore:hover:before,
.blog-thumb-entry.two-column  .blog-thumb-content .blog-thumb-metas:before{
	background: {$accent_color} ;
}
.pacz-employeee-networks li a:hover {
	background: {$accent_color} ;
	border-color: {$accent_color} !important;
	
}
.pacz-testimonial.creative-style .slide{
	
	
}
.pacz-testimonial.boxed-style .testimonial-content{
	border-bottom:2px solid {$accent_color} !important;
	
}
.pacz-testimonial.modern-style .slide{
	
	
}
.testimonial3-style .owl-dot.active span,
.testimonial4-style .owl-dot.active span{background: {$accent_color} !important;}
.pacz-testimonial.modern-style .slide .author-details .testimonial-position,
.pacz-testimonial.modern-style .slide .author-details .testimonial-company{
	color: {$accent_color} !important;
	
}
.pacz-love-holder .item-loved i,
.widget_posts_lists .cats a,
#pacz-breadcrumbs a:hover,
.widget_social_networks a.light,
.widget_posts_tabs .cats a {
	color: {$accent_color} !important;
}

a:hover,
.pacz-tweet-shortcode span a:hover {
	color:{$pacz_settings['link-color']['hover']};
}

.blog-meta time a,
.entry-meta time a,
.entry-meta .entry-categories a,
.blog-author span,
.blog-comments span,
.blog-categories a,
.blog-comments{
	color:{$pacz_settings['link-color']['regular']};
}
.blog-meta time a:hover,
.entry-meta time a:hover,
.entry-meta .entry-categories a:hover,
.blog-author span:hover,
.blog-comments span:hover,
.blog-categories a:hover,
.blog-comments{
	color:{$pacz_settings['link-color']['hover']};
}

/* Main Skin Color : Background-color Property */
#wp-calendar td#today,
div.jp-play-bar,
.pacz-header-button:hover,
.next-prev-top .go-to-top:hover,
.masonry-border,
.author-social li a:hover,
.slideshow-swiper-arrows:hover,
.pacz-clients-shortcode .clients-info,
.pacz-contact-form-wrapper .pacz-form-row i.input-focused,
.pacz-login-form .form-row i.input-focused,
.comment-form-row i.input-focused,
.widget_social_networks a:hover,
.pacz-social-network a:hover,
.blog-masonry-entry .post-type-icon:hover,
.list-posttype-col .post-type-icon:hover,
.single-type-icon,
.demo_store,
.add_to_cart_button:hover,
.pacz-process-steps.dark-skin .pacz-step:hover .step-icon,
.pacz-process-steps.dark-skin .active-step-item .step-icon,
.pacz-process-steps.light-skin .step-icon,
.pacz-social-network a.light:hover,
.widget_tag_cloud a:hover,
.widget_categories a:hover,
.sharp-nav-bg,
.gform_wrapper .button:hover,
.pacz-event-countdown.accent-skin li:before,
.masonry-border,
.pacz-gallery.thumb-style .gallery-thumb-lightbox:hover,
.fancybox-close:hover,
.fancybox-nav span:hover,
.blog-scroller-arrows:hover,
ul.user-login li a i,
.pacz-isotop-filter ul li a.current,
.pacz-isotop-filter ul li a:hover
{
	border-color: {$accent_color};
	color: {$accent_color};
}




::-webkit-selection
{
	background-color: {$accent_color};
	color:#fff;
}

::-moz-selection
{
	background-color: {$accent_color};
	color:#fff;
}

::selection
{
	background-color: {$accent_color};
	color:#fff;
}

.next-prev-top .go-to-top,
.pacz-contact-form-wrapper .text-input:focus, .pacz-contact-form-wrapper .pacz-textarea:focus,
.widget .pacz-contact-form-wrapper .text-input:focus, .widget .pacz-contact-form-wrapper .pacz-textarea:focus,
.pacz-contact-form-wrapper .pacz-form-row i.input-focused,
.comment-form-row .text-input:focus, .comment-textarea textarea:focus,
.comment-form-row i.input-focused,
.pacz-login-form .form-row i.input-focused,
.pacz-login-form .form-row input:focus,
.pacz-event-countdown.accent-skin li
{
	border-color: {$accent_color}!important;
}
.pacz-go-top {background-color:{$pacz_settings['btn-hover']};}

#wpadminbar {
  
}

");


if (isset($pacz_settings['sub-footer-border-top']) && ($pacz_settings['sub-footer-border-top'] == 1)) {
	$subfooter_border_top_color = (isset($pacz_settings['sub-footer-border-top-color']['rgba']))? $pacz_settings['sub-footer-border-top-color']['rgba'] : '';
	Pacz_Static_Files::addGlobalStyle("
	#sub-footer .pacz-grid{
		border-top:1px solid {$subfooter_border_top_color};
	}");
}


###########################################
	# Accent Color
	###########################################
	
	Pacz_Static_Files::addGlobalStyle("
.dynamic-btn{
		background-color:{$accent_color} !important;
		border-color:{$accent_color} !important;
		color:#fff !important;
	}
.dynamic-btn:hover{
		background-color:{$btn_hover} !important;
		border-color:{$btn_hover} !important;
		color:#fff !important;
	}
	
	
	
	
	
	");
###########################################
# MISC
###########################################
global $post;
//$post_id = global_get_post_id();
	$stick_template = get_post_meta($post_id, '_padding', true);
if(is_page() && !has_shortcode($post->post_content, 'vc_row')){
	Pacz_Static_Files::addGlobalStyle("
	.theme-content {padding:70px 0;}
	");
}
if($pacz_settings['header-grid'] && (is_page() || pacz_is_default_pages() || ($post_id && !$stick_template)) && !is_front_page()){
	Pacz_Static_Files::addGlobalStyle("
		.theme-page-wrapper{
			padding-top:{$header_height}px;
		}
	");
}
Pacz_Static_Files::addGlobalStyle("
.widget_author .classiadspro-author.style2 .author-social-follow-ul li a:hover{
	background-color:{$accent_color};
	color:#fff !important;
}
.pacz-divider .divider-inner i
{
	background-color: {$pacz_settings['page-bg']['background-color']};
}
.pacz-body-loader-overlay {
	background-color: {$pacz_settings['preloader-bg-color']};
}
.pacz-loader
{
	border: 2px solid {$accent_color};
}
.progress-bar.bar .bar-tip {
	color:{$accent_color};
	
}
.custom-color-heading{
	color:{$accent_color};
	
}

.alt-title span,
.single-post-fancy-title span
{
	
}

.pacz-box-icon .pacz-button-btn a.pacz-button:hover {
	background-color:{$accent_color};
	border-color:{$accent_color};
}


 
.ls-btn1:hover{
	color:{$accent_color} !important;
}
.pacz-commentlist li .comment-author a{
	font-weight:400 !important;
	color:{$pacz_settings['heading-color']} !important;
	{$heading_font_family_h5}
}

.form-submit #submit {
  color:#fff;
  background-color:{$accent_color};
}
.form-submit #submit:hover {
  background-color:{$pacz_settings['btn-hover']};
}

.pacz-pagination .current-page,
.pacz-pagination .page-number:hover,
.pacz-pagination .current-page:hover {
    background-color:{$accent_color} !important;
	border-color:{$accent_color} !important;
	color:#fff !important;
}
.pacz-pagination .page-number,
.pacz-pagination .current-page {
  color:{$accent_color};
  border-color:{$accent_color};
}
.pacz-pagination .pacz-pagination-next a,
.pacz-pagination .pacz-pagination-previous a {
  color:{$accent_color};
  border-color:{$accent_color};
}
.pacz-pagination .pacz-pagination-next:hover a,
.pacz-pagination .pacz-pagination-previous:hover a {
  background-color:{$accent_color} !important;
	border-color:{$accent_color} !important;
	color:#fff !important;
}
.pacz-loadmore-button:hover {
  background-color:{$accent_color} !important;
	color:#fff !important;
}
.pacz-searchform .pacz-icon-search:hover {
  background-color:{$accent_color} !important;
  color:#fff;
}
.footer-sell-btn a{
	background-color:{$accent_color};
}
.footer-sell-btn a:hover{
	background-color:{$pacz_settings['btn-hover']};
}
");



###########################################
# subscription form
###########################################

Pacz_Static_Files::addGlobalStyle("
	.subscription-form  form#signup-1 .subs-form-btn{
		background-color:{$accent_color} !important;
	}
	.subscription-form  form#signup-1 .subs-form-btn:hover{
		background-color:{$pacz_settings['subs-btn-hover']} !important;
		
	}
");

/* Login AND REGISTER Buttons */
$toolbar_content_padding_top = round($toolbar_height / 2) - 17;
Pacz_Static_Files::addGlobalStyle("
.transparent-header:not(.sticky-trigger-header) .author-displayname{
	color:#fff !important;
}
.author-displayname{
	color:{$pacz_settings['heading-color']} !important;
}
.pacz-header-toolbar .header-toolbar-contact{
	padding-top:{$toolbar_content_padding_top}px;

}
.pacz-header-toolbar .header-toolbar-contact i{
	background-color:{$accent_color};
	color:#fff !important;
}


");
if(!is_404() && !is_search() && !is_author() && class_exists('DHVCForm') && is_object($post)){
	$dhvc_input_border_color = get_post_meta( $post->ID, '_input_border_color', true );
	$dhvc_input_hover_border_color = get_post_meta( $post->ID, '_input_hover_border_color', true );
	$dhvc_input_focus_border_color = get_post_meta( $post->ID, '_input_focus_border_color', true );
	$dhvc_input_border_size = get_post_meta( $post->ID, '_input_border_size', true );
	$dhvc_input_height = get_post_meta( $post->ID, '_input_height', true );
	$dhvc_button_bg_color = get_post_meta( $post->ID, '_button_bg_color', true );
	$dhvc_button_height = get_post_meta( $post->ID, '_button_height', true );
if(isset($dhvc_input_border_color) && empty($dhvc_input_border_color)){
	Pacz_Static_Files::addGlobalStyle("
	.dhvc-form-flat .dhvc-form-input input, .dhvc-form-flat .dhvc-form-file input[type=text], .dhvc-form-flat .dhvc-form-captcha input, .dhvc-form-flat .dhvc-form-select select, .dhvc-form-flat .dhvc-form-textarea textarea, .dhvc-form-flat .dhvc-form-radio i, .dhvc-form-flat .dhvc-form-checkbox i {
	border-color:#eee;
	}
");
	}
if(isset($dhvc_input_border_size) && empty($dhvc_input_border_size)){
	Pacz_Static_Files::addGlobalStyle("
	.dhvc-form-flat .dhvc-form-input input, .dhvc-form-flat .dhvc-form-file input[type=text], .dhvc-form-flat .dhvc-form-captcha input, .dhvc-form-flat .dhvc-form-select select, .dhvc-form-flat .dhvc-form-textarea textarea, .dhvc-form-flat .dhvc-form-radio i, .dhvc-form-flat .dhvc-form-checkbox i {
	border-width:1px;
	}
");
	}
if(isset($dhvc_input_height) && empty($dhvc_input_height)){
	Pacz_Static_Files::addGlobalStyle("
	.dhvc-form-flat .dhvc-form-input input, .dhvc-form-flat .dhvc-form-file input[type=text], .dhvc-form-flat .dhvc-form-captcha input, .dhvc-form-flat .dhvc-form-select select, .dhvc-form-flat .dhvc-form-textarea textarea, .dhvc-form-flat .dhvc-form-radio i, .dhvc-form-flat .dhvc-form-checkbox i {
	height:50px;
	}
");
	}
if(isset($dhvc_button_bg_color) && empty($dhvc_button_bg_color)){
	Pacz_Static_Files::addGlobalStyle("
	.dhvc-form-submit, .dhvc-form-submit:focus, .dhvc-form-submit:hover, .dhvc-form-submit:active {
    background-color:{$accent_color};
}
");
	}
if(isset($dhvc_input_focus_border_color) && empty($dhvc_input_focus_border_color) || isset($dhvc_input_hover_border_color) && empty($dhvc_input_hover_border_color)){
	Pacz_Static_Files::addGlobalStyle("
	.dhvc-form-flat .dhvc-form-input input:focus, .dhvc-form-flat .dhvc-form-captcha input:focus, .dhvc-form-flat .dhvc-form-file:hover input[type='text']:focus, .dhvc-form-flat .dhvc-form-select select:focus, .dhvc-form-flat .dhvc-form-textarea textarea:focus, .dhvc-form-flat .dhvc-form-radio input:checked + i, .dhvc-form-flat .dhvc-form-checkbox input:checked + i{
	border-color:{$accent_color};
	}
");
	}
if(isset($dhvc_button_height) && empty($dhvc_button_height)){
	Pacz_Static_Files::addGlobalStyle("
	.dhvc-form-submit, .dhvc-form-submit:focus, .dhvc-form-submit:hover, .dhvc-form-submit:active {
    height: 50px;
}
");
	}
Pacz_Static_Files::addGlobalStyle("
	.dhvc-form-flat .dhvc-form-input input, .dhvc-form-flat .dhvc-form-file input[type=text], .dhvc-form-flat .dhvc-form-captcha input, .dhvc-form-flat .dhvc-form-select select, .dhvc-form-flat .dhvc-form-textarea textarea, .dhvc-form-flat .dhvc-form-radio i, .dhvc-form-flat .dhvc-form-checkbox i,.dhvc-form-flat .dhvc-form-action.dhvc_form_submit_button {
	margin:7px 0 !important;
	}
	.footer-form-style4 .dhvc-form-flat .dhvc-form-input input, .footer-form-style4 .dhvc-form-flat .dhvc-form-action.dhvc_form_submit_button{
		margin: 0 !important;
	}
	.dhvc-form-submit{
		background-color:{$accent_color};
		display:block;
		width:100%;
	}
	.dhvc-form-submit:hover, .dhvc-form-submit:active, .dhvc-form-submit:focus {
		background-color:{$pacz_settings['btn-hover']};
	}
	.dhvc-form-submit, .dhvc-form-submit:hover, .dhvc-form-submit:active, .dhvc-form-submit:focus {
		opacity:1;
	}
	.dhvc-form-add-on i{color:{$accent_color};}
	.dhvc-form-group .dhvc-form-control {padding-left:20px;padding-right:50px}
	.dhvc-register-link{color:{$accent_color}}
");
if(isset($dhvc_button_height) && !empty($dhvc_button_height)){
	Pacz_Static_Files::addGlobalStyle("
	.dhvc-form-add-on{width:{$dhvc_button_height}; line-height:{$dhvc_button_height};height:{$dhvc_button_height};}
");
	}else{
	Pacz_Static_Files::addGlobalStyle("
	.dhvc-form-add-on{width:50px !important;line-height:50px !important;height:50px !important;border-left:1px solid #eee;}
");	
	}
	
}
	
###########################################
# BREADCRUMB CUSTOM SKIN STYLES
###########################################

$breadcrumb_skin = (isset($pacz_settings['breadcrumb-skin']) && !empty($pacz_settings['breadcrumb-skin']) && $pacz_settings['breadcrumb-skin'] == 'custom' ) ? 1 : 0;
$breadcrumb_custom_color_regular = (isset($pacz_settings['breadcrumb-skin-custom']['regular']) && !empty($pacz_settings['breadcrumb-skin-custom']['regular']) ) ? $pacz_settings['breadcrumb-skin-custom']['regular'] : $custom_breadcrumb_color ;
$breadcrumb_custom_color_hover = (isset($pacz_settings['breadcrumb-skin-custom']['hover']) && !empty($pacz_settings['breadcrumb-skin-custom']['hover']) ) ? $pacz_settings['breadcrumb-skin-custom']['hover'] : $custom_breadcrumb_hover_color ;

if($breadcrumb_skin == 1){

	if($custom_breadcrumb_page == 1){
		
		Pacz_Static_Files::addGlobalStyle(" #pacz-breadcrumbs .custom-skin{
			color: {$breadcrumb_custom_color_regular} !important;
		}
		#pacz-breadcrumbs .custom-skin a{
			color: {$breadcrumb_custom_color_regular} !important;
		}
		#pacz-breadcrumbs .custom-skin a:hover{
			color: {$breadcrumb_custom_color_hover} !important;
		}

		");
	}

}
###########################################star-rating
	# PreLoader
###########################################
$preloader_background = ($pacz_settings['preloader-bg-color']) ? ('background-color:' . $pacz_settings['preloader-bg-color'] . ';') : '';
$preloader_image = ($pacz_settings['preloader-logo']['url']) ? ('background-image: url("' . $pacz_settings['preloader-logo']['url'] . '");') : '';
Pacz_Static_Files::addGlobalStyle("
	.pacz-preloader {
		{$preloader_image}
		{$preloader_background}
	}
");

###########################################star-rating
	# Eror 404
###########################################

Pacz_Static_Files::addGlobalStyle("
	.error-404-wrapper .error-404-home-button a{
		background: {$accent_color};
	}
	.error-404-wrapper .error-404-home-button a:hover{
		background: {$pacz_settings['btn-hover']};
	}
");
###########################################star-rating
	# WOOCOMMERCE DYNAMIC STYLES
	###########################################
if (class_exists('woocommerce')) {

	$accent_color_90 = pacz_convert_rgba($accent_color, 0.9);

	Pacz_Static_Files::addGlobalStyle("



	");

}

