<?php

// DirectoryPress filters
add_action('directorypress_register_listing_styles', 'pacz_directorypress_register_styles');
add_filter ("directorypress_listing_gridview_styles" , "pacz_directorypress_listing_gridview_styles");
add_filter ("directorypress_listing_gridview_styles_featured_tags" , "pacz_directorypress_listing_gridview_styles_featured_tags");

add_filter ("directorypress_listing_listview_styles" , "pacz_directorypress_listing_listview_styles");

add_filter ("directorypress_single_listing_styles" , "pacz_directorypress_single_listing_styles");
add_filter ("directorypress_archive_page_styles" , "pacz_directorypress_archive_page_styles");
add_filter ("directorypress_sorting_panel_styles" , "pacz_directorypress_listing_sorting_styles");
add_action ("directorypress_listing_before_attachment_metabox" , "pacz_directorypress_listing_before_attachment_metabox");
add_action ("directorypress_pricing_plan_styles" , "pacz_directorypress_pricing_plan_styles");

add_action ("directorypress_after_dynamic_style" , "pacz_directorypress_after_dynamic_style");



// call back function 

function pacz_directorypress_register_styles() {
	wp_register_style('pacz_directorypress_common', PACZ_THEME_DIR_URI . '/directorypress/assets/css/common.css');
	wp_register_style('pacz_directorypress_rtl', PACZ_THEME_DIR_URI . '/directorypress/assets/css/common-rtl.css');
	wp_enqueue_style('pacz_directorypress_common');
	// listings
	wp_register_style('directorypress_listing_style_1', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-1.css');
	wp_register_style('directorypress_listing_style_2', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-2.css');
	wp_register_style('directorypress_listing_style_3', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-3.css');
	wp_register_style('directorypress_listing_style_4', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-4.css');
	wp_register_style('directorypress_listing_style_5', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-5.css');
	wp_register_style('directorypress_listing_style_6', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-6.css');
	wp_register_style('directorypress_listing_style_7', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-7.css');
	wp_register_style('directorypress_listing_style_8', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-8.css');
	wp_register_style('directorypress_listing_style_9', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-9.css');
	wp_register_style('directorypress_listing_style_10', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-10.css');
	wp_register_style('directorypress_listing_style_11', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-11.css');
	wp_register_style('directorypress_listing_style_12', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-12.css');
	wp_register_style('directorypress_listing_style_13', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-13.css');
	wp_register_style('directorypress_listing_style_14', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-14.css');
	wp_register_style('directorypress_listing_style_15', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-15.css');
	wp_register_style('directorypress_listing_style_16', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-16.css');
	wp_register_style('directorypress_listing_style_17', PACZ_THEME_DIR_URI . '/directorypress/assets/css/listing/listing-style-17.css');
	if(is_rtl()){
		wp_enqueue_style('pacz_directorypress_rtl');
	}
}

add_filter ("directorypress_listing_gridview_styles" , "pacz_directorypress_listing_gridview_styles");
function pacz_directorypress_listing_gridview_styles($styles){
	$styles = $styles + array(
		'1' => __('style 1 ', 'classiadspro'),	
		'2' => __('style 2 Emo ', 'classiadspro'),							
		'3' => __('style 3 Lemo', 'classiadspro'),						
		'4' => __('style 4 Max', 'classiadspro'),							
		'5' => __('style 5', 'classiadspro'),							
		'6' => __('style 6 Exo', 'classiadspro'),							
		'7' => __('style 7 Exotic', 'classiadspro'),							
		'8' => __('style 8 Snow', 'classiadspro'),							
		'9' => __('style 9 Zee', 'classiadspro'),							
		'10' => __('style 10 Ultra', 'classiadspro'),							
		'11' => __('style 11 Mintox', 'classiadspro'),							
		'12' => __('style 12 Solic', 'classiadspro'),							
		'13' => __('style 13 Zoco', 'classiadspro'),
		'14' => __('style 14 Fantro', 'classiadspro'),
		'15' => __('style 15 Directory', 'classiadspro'),
		'16' => __('style 16 ', 'classiadspro'),
		'17' => __('style 17 ', 'classiadspro')
	);
	return $styles;
}

function pacz_directorypress_listing_listview_styles($styles){
	$styles = $styles + array(
		'listview_ultra' => __('Ultra', 'classiadspro'),
		'listview_mod' => __('Modern', 'classiadspro'),
	);
	return $styles;
}

function pacz_directorypress_listing_gridview_styles_featured_tags($styles){
	$styles = $styles + array(
		'1' => __('style 1', 'classiadspro'),
		'2' => __('style 2 Emo ', 'classiadspro'),							
		'3' => __('style 3 Lemo', 'classiadspro'),						
		'4' => __('style 4 Max', 'classiadspro'),							
		'5' => __('style 5 default', 'classiadspro'),							
		'6' => __('style 6 Exo', 'classiadspro'),							
		'7' => __('style 7 Exotic', 'classiadspro'),							
		'8' => __('style 8 Snow', 'classiadspro'),							
		'9' => __('style 9 Zee', 'classiadspro'),							
		'10' => __('style 10 Ultra', 'classiadspro'),							
		'11' => __('style 11 Mintox', 'classiadspro'),							
		'12' => __('style 12 Solic', 'classiadspro'),							
		'13' => __('style 13 Zoco', 'classiadspro'),
		'14' => __('style 14 Fantro', 'classiadspro'),
		'15' => __('style 15 Directory', 'classiadspro'),
		'16' => __('style 16 ', 'classiadspro'),
		'17' => __('style 17 ', 'classiadspro')
	);
	return $styles;
}

function pacz_directorypress_single_listing_styles($styles){
	$styles = $styles + array(
		'2' => __('style 2 Radius ', 'classiadspro'),
		'3' => __('style 3 Directory ', 'classiadspro')
	);
	return $styles;
}

function pacz_directorypress_archive_page_styles($styles){
	$styles = $styles + array(
		'3' => __('Sticky Map ', 'classiadspro')
	);
	return $styles;
}

function pacz_directorypress_listing_sorting_styles($styles){
	$styles = $styles + array(
		'2' => __('style 2 Fantro ', 'classiadspro'),
		'3' => __('style 3 Zoco ', 'classiadspro'),
		'4' => __('style 4 ', 'classiadspro')
	);
	return $styles;
}
function pacz_directorypress_pricing_plan_styles($styles){
	$styles = $styles + array(
		'pplan-style-2' => __('Style 2', 'classiadspro'),
		'pplan-style-3' => __('style 3', 'classiadspro'),
		'pplan-style-4' => __('style 4 Zoco', 'classiadspro'),
	);
	return $styles;
}

function pacz_directorypress_listing_before_attachment_metabox(){
	$listing = directorypress_pull_current_listing_admin();
	directorypress_display_template('partials/listing/company-logo-metabox.php', array('listing' => $listing));
	directorypress_display_template('partials/listing/company-cover-metabox.php', array('listing' => $listing));
}

add_filter ("directorypress_category_styles" , "pacz_directorypress_category_styles");
function pacz_directorypress_category_styles($styles){
	$styles = $styles + array(
		'2' => __('Style 2 Echo', 'classiadspro'),
		'3' => __('Style 3 Zee', 'classiadspro'),
		'4' => __('Style 4 Wox', 'classiadspro'),
		'5' => __('Style 5 Ultra', 'classiadspro'),
		'6' => __('Style 6 Mintox', 'classiadspro'),
		'7' => __('Style 7 Zoco', 'classiadspro'),
		'8' => __('Style 8 Fantro (List)', 'classiadspro'),
		'9' => __('Style 9 ', 'classiadspro'),
		'10' => __('Style 10 ', 'classiadspro'),
		'11' => __('Style 11 ', 'classiadspro'),						
	);
	return $styles;
}

add_filter ("directorypress_location_styles" , "pacz_directorypress_location_styles");
function pacz_directorypress_location_styles($styles){
	$styles = $styles + array(
		'2' => __('Style 2 Echo', 'classiadspro'),
		'3' => __('Style 3 Zee', 'classiadspro'),						
	);
	return $styles;
}


// dynamic styles

function pacz_directorypress_after_dynamic_style(){
	###########################################
	# Categories
	###########################################
	global $DIRECTORYPRESS_ADIMN_SETTINGS, $pacz_settings;
	$directorypress_primary_color = $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_primary_color'];
	$directorypress_secondary_color = $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_secondary_color'];
	
	$parent_cat_title_color = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['parent_cat_title_color']['regular'])) ? ('color:'.$DIRECTORYPRESS_ADIMN_SETTINGS['parent_cat_title_color']['regular']. ';') : '';
	$parent_cat_title_color_hover = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['parent_cat_title_color']['hover'])) ?('color:'.$DIRECTORYPRESS_ADIMN_SETTINGS['parent_cat_title_color']['hover']. ';') : '';
	$parent_cat_title_bg = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['parent_cat_title_color']['bg'])) ? ('background:'.$DIRECTORYPRESS_ADIMN_SETTINGS['parent_cat_title_color']['bg']. ';') : '';
	$parent_cat_title_bg_hover = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['parent_cat_title_color']['bg-hover'])) ? ('background:'.$DIRECTORYPRESS_ADIMN_SETTINGS['parent_cat_title_color']['bg-hover']. ';') : '';

	$subcategory_title_color = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['subcategory_title_color']['regular'])) ? ('color:'.$DIRECTORYPRESS_ADIMN_SETTINGS['subcategory_title_color']['regular']. ';') : '';
	$subcategory_title_color_hover = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['subcategory_title_color']['hover'])) ? ('color:'.$DIRECTORYPRESS_ADIMN_SETTINGS['subcategory_title_color']['hover']. ';') : '';

	$cat_bg = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['cat_bg_color']['rgba']) && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['cat_bg_color']['color'])) ? ('background:'.$DIRECTORYPRESS_ADIMN_SETTINGS['cat_bg_color']['rgba'].';') : '';
	$cat_bg_hover = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['cat_bg_color_hover']['rgba']) && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['cat_bg_color_hover']['color'])) ? ('background:'.$DIRECTORYPRESS_ADIMN_SETTINGS['cat_bg_color_hover']['rgba'].';') : '';

	$cat_border_color = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_color']['rgba'])  && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_color']['color'])) ? ('border-color:'.$DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_color']['rgba']. ';') : '';
	$cat_border_color_hover = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_color_hover']['rgba'])  && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_color_hover']['color'])) ? ('border-color:'.$DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_color_hover']['rgba']. ';') : '';

	$cat_box_shadow = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_color']['rgba'])  && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_color']['color'])) ? ('box-shadow: 0 2px 0 0'.$DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_color']['rgba']. ';') : '';
	$cat_box_shadow_hover = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_color_hover']['rgba'])  && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_color_hover']['color'])) ? ('box-shadow: 0 2px 0 0'.$DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_color_hover']['rgba']. ';') : '';


	$cat_border_radius_top = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_radius']['padding-top']) && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_radius']['padding-top'])) ? ('border-top-left-radius:'.$DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_radius']['padding-top'].';') : '';
	$cat_border_radius_bottom = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_radius']['padding-bottom']) && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_radius']['padding-bottom'])) ? ('border-bottom-right-radius:'.$DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_radius']['padding-bottom'].';') : '';
	$cat_border_radius_left = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_radius']['padding-left']) && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_radius']['padding-left'])) ? ('border-bottom-left-radius:'.$DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_radius']['padding-left'].';') : '';
	$cat_border_radius_right = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_radius']['padding-right']) && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_radius']['padding-right'])) ? ('border-top-right-radius:'.$DIRECTORYPRESS_ADIMN_SETTINGS['cat_border_radius']['padding-right'].';') : '';



	DirectoryPress_Static_Files::addGlobalStyle("

		.cat-style-2 .directorypress-category-holder .directorypress-parent-category a .cat-icon,
		.cat-style-3 .directorypress-category-holder,
		.cat-style-4 .directorypress-category-holder,
		.cat-style-5 .directorypress-category-holder,
		.cat-style-6 .directorypress-category-holder,
		.cat-style-7 .directorypress-category-holder,
		.cat-style-8 .directorypress-category-holder,
		.cat-style-9 .directorypress-category-holder{
			{$cat_bg}
			{$cat_border_radius_top}
			{$cat_border_radius_right}
			{$cat_border_radius_bottom}
			{$cat_border_radius_left}
			
		}
		.cat-style-2 .directorypress-category-holder .directorypress-parent-category a .cat-icon:hover,
		.cat-style-2 .directorypress-category-holder .directorypress-parent-category a:hover .cat-icon,
		.cat-style-3 .directorypress-category-holder:hover,
		.cat-style-4 .directorypress-category-holder:hover,
		.cat-style-5 .directorypress-category-holder:hover,
		.cat-style-6 .directorypress-category-holder:hover,
		.cat-style-7 .directorypress-category-holder:hover,
		.cat-style-8 .directorypress-category-holder:hover,
		.cat-style-9 .directorypress-category-holder:hover{
			{$cat_bg_hover}
		}
		
		.cat-style-6 .directorypress-category-holder{
			{$cat_box_shadow}
			{$cat_border_color}
		}
		.cat-style-6 .directorypress-category-holder:hover{
			{$cat_box_shadow_hover}
			{$cat_border_color_hover}
		}
		.cat-style-6 .directorypress-category-holder .directorypress-parent-category{
			{$parent_cat_title_bg}
		}
		.cat-style-6 .directorypress-category-holder:hover .directorypress-parent-category{
			{$parent_cat_title_bg_hover}
		}
		.cat-style-6 .directorypress-categories-wrapper .directorypress-category-holder .subcategories ul li a.view-all-btn{
			{$cat_border_color}
		}

		.cat-style-6 .directorypress-categories-wrapper .directorypress-category-holder:hover .subcategories ul li a.view-all-btn{
			{$cat_border_color_hover}
		}

		.cat-style-7 .directorypress-category-holder{
			{$cat_border_color}
		}

		.cat-style-7 .directorypress-category-holder:hover{
			border-color: {$cat_border_color_hover};
		}
		
		.cat-style-3 .directorypress-category-holder:hover .directorypress-parent-category a,
		.cat-style-4 .directorypress-category-holder:hover .directorypress-parent-category a,
		.cat-style-5 .directorypress-category-holder:hover .directorypress-parent-category a,
		.cat-style-6 .directorypress-category-holder:hover .directorypress-parent-category a,
		.cat-style-7 .directorypress-category-holder:hover .directorypress-parent-category a,
		.cat-style-9 .directorypress-category-holder:hover .directorypress-parent-category a{
			{$parent_cat_title_color_hover}
		}
		.subcategories ul li a:hover,
		.subcategories ul li a:hover span{
			{$subcategory_title_color_hover}
		}
		
	");
	
	// locations dynamic styles
	DirectoryPress_Static_Files::addGlobalStyle("
		.location-style2.directorypress-locations-columns .directorypress-location-item  .directorypress-parent-location a:before{
			background-color:{$directorypress_primary_color};
		}
		.location-style2.directorypress-locations-columns .directorypress-location-item  .directorypress-parent-location a:hover:before{
			background-color:{$directorypress_secondary_color};
		}
		
	");
	
	// Pricing dynamic styles
	DirectoryPress_Static_Files::addGlobalStyle("
	
		.pplan-style-3 .directorypress-choose-plan ul li .directorypress-price del .woocommerce-Price-amount,
		.pplan-style-3 .directorypress-choose-plan ul li .directorypress-price del .woocommerce-Price-amount .woocommerce-Price-currencySymbol,
		.pplan-style-3 .directorypress-choose-plan ul li .directorypress-price del,
		.directorypress-choose-plan ul li .directorypress-price del,
		.directorypress-price del .woocommerce-Price-amount,
		.pplan-style-3 .directorypress-choose-plan ul li .directorypress-price span,
		.pplan-style-3 .directorypress-choose-plan ul li .directorypress-price{
			color:{$pacz_settings['heading-color']} !important;
		}
		.pplan-style-3 .directorypress-choose-plan:hover ul li.directorypress-list-group-item:first-child {
			background-color:{$directorypress_primary_color} !important;
			border-color:#fff;
			box-shadow:none;
			
		}
		.pplan-style-3 .directorypress-choose-plan:hover ul li.directorypress-list-group-item:first-child span,
		.pplan-style-3 .directorypress-choose-plan:hover ul li.directorypress-list-group-item:first-child,
		.pplan-style-3 .directorypress-choose-plan:hover ul li.directorypress-list-group-item:first-child .directorypress-price,
		.pplan-style-3 .directorypress-choose-plan:hover ul li.directorypress-list-group-item:first-child .directorypress-price span{
			color:#fff !important;
		}
		
	");
	
	// listing dynamic styling
	$price_tag_height = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_tag_height'])) ? ('min-height:'. $DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_tag_height'] .'px;') : '';
	$price_tag_bg = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_bg']['rgba']) && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_bg']['color'])) ? $DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_bg']['rgba'] : $directorypress_primary_color;
	
	$price_tag_border_top_color_hover = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_bg_hover']['rgba'])  && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_bg_hover']['color'])) ? ('border-top-color:'. $DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_bg_hover']['rgba'] .';') : '';
	$price_tag_border_bottom_color_hover = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_bg_hover']['rgba'])  && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_bg_hover']['color'])) ? ('border-bottom-color:'. $DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_bg_hover']['rgba'] .';') : '';
	$price_tag_border_left_color_hover = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_bg_hover']['rgba'])  && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_bg_hover']['color'])) ? ('border-left-color:'. $DIRECTORYPRESS_ADIMN_SETTINGS['listing_price_bg_hover']['rgba'] .';') : '';
	$has_featured_text = esc_html__('Featured', 'classiadspro');
	
	DirectoryPress_Static_Files::addGlobalStyle("
		.listing-post-style-2 .has_featured-ad{
			background:{$directorypress_primary_color};
		}
		.listing-post-style-2:hover .has_featured-ad{
			background:{$directorypress_secondary_color};
		}
		.directorypress-listings-grid .listing-post-style-3 .directorypress-listing-item-holder:hover .directorypress-listing-text-content-wrap{
			background:{$pacz_settings['heading-color']};
		}
		.directorypress-listings-grid .listing-post-style-3 .directorypress-listing-item-holder:hover .directorypress-listing-text-content-wrap .directorypress-field-type-categories .directorypress-label-primary a{
			color:{$directorypress_secondary_color} !important;
		}
		.listing-post-style-3 figure .price,
		.listing-post-style-7 figure .price .directorypress-field-type-price .field-content{
			background:{$directorypress_primary_color};
		}
		.listing-post-style-3:hover figure .price,
		.listing-post-style-7:hover figure .price .directorypress-field-type-price .field-content{
			background:{$directorypress_secondary_color};
		}
		.directorypress-listings-grid .listing-post-style-3 .directorypress-listing-text-content-wrap .directorypress-field-type-price,
		.directorypress-listings-grid .listing-post-style-5 .directorypress-listing-text-content-wrap .directorypress-field-type-categories .field-content .directorypress-label,
		.directorypress-listings-grid .listing-post-style-9 .directorypress-listing-text-content-wrap .directorypress-field-type-categories .field-content .directorypress-label,
		.popular-package{
			background-color:{$directorypress_primary_color} !important;
		}
		.directorypress-listings-grid .listing-post-style-3 .directorypress-listing-item-holder:hover .directorypress-listing-text-content-wrap .directorypress-field-type-categories .field-content .directorypress-label,
		.directorypress-listings-grid .listing-post-style-5 .directorypress-listing-text-content-wrap .directorypress-field-type-price,
		.directorypress-listings-grid .listing-post-style-9 .directorypress-listing-text-content-wrap .directorypress-field-type-price {
			color:{$directorypress_primary_color} !important;
		}
		.directorypress-listing.listing-post-style-6.directorypress-has_featured .directorypress-listing-figure a.directorypress-listing-figure-img-wrap:after{
			content: '{$has_featured_text}';
			font-family: inherit;
			display: inline-block;
			height: auto;
			width: auto;
			padding: 7px 12px;
			position: absolute;
			bottom:30px;
			left:30px !important;
			color:#fff;
			z-index:1;
			font-size:14px;
			border-radius:3px;
			line-height:1;
			text-transform:uppercase;
			background-color:{$directorypress_secondary_color};
		}
		.directorypress-listings-grid .listing-post-style-7 .directorypress-listing-text-content-wrap .second-content-field .directorypress-field-type-string .field-label .directorypress-field-icon {
			color:{$directorypress_primary_color};
		}
		.directorypress-listing.listing-post-style-9 .directorypress-listing-figure .price .directorypress-field-item span.field-content{
			font-weight:bold;
		}
		.directorypress-listing.listing-post-style-9 .directorypress-listing-figure .price .directorypress-field-item span.field-content{
			background:{$pacz_settings['btn-hover']} !important;
		}
		.directorypress-listings-grid .listing-post-style-10 .directorypress-listing-item-holder .directorypress-listing-text-content-wrap .listing-location i{
			color:{$pacz_settings['body-txt-color']};
		}
		.directorypress-listings-grid .listing-post-style-10 .directorypress-listing-text-content-wrap .directorypress-field-type-price{
			color:{$pacz_settings['heading-color']};
		}
		.directorypress-listings-grid .listing-post-style-10 .directorypress-listing-text-content-wrap .listing-cat{
			color:{$pacz_settings['body-txt-color']};
		}
		
		.listing-post-style-14 .listing-rating.grid-rating .rating-numbers,
		.listing-post-style-listview_ultra .listing-rating.grid-rating .rating-numbers{
			background-color:{$directorypress_primary_color};
		}
		.listing-post-style-13 .directorypress-listing-item-holder figure .price .field-content::after {
			border-bottom-color: {$price_tag_bg};
			border-left-color: {$price_tag_bg};
			border-top-color: {$price_tag_bg};
			{$price_tag_height}
		}
		.listing-post-style-13 .directorypress-listing-item-holder:hover figure .price .field-content::after {
			{$price_tag_border_top_color_hover}
			{$price_tag_border_left_color_hover}
			{$price_tag_border_bottom_color_hover}
		}
		
		.cz-listview .listing-post-style-listview_ultra .directorypress-listing-text-content-wrap .price span.field-content{
			background:{$price_tag_bg} !important;
		}
		.view_swither_panel_style3 .btn.btn-primary.directorypress-list-view-btn,
		.view_swither_panel_style3 .btn.btn-primary.directorypress-grid-view-btn{
			color:{$directorypress_primary_color};
			background:#fff !important;
		}
		.view_swither_panel_style4 .btn.btn-primary.directorypress-list-view-btn,
		.view_swither_panel_style4 .btn.btn-primary.directorypress-grid-view-btn{
			background:{$directorypress_primary_color};
			border-color:{$directorypress_primary_color};
		}
		.view_swither_panel_style4 .btn.btn-primary.directorypress-list-view-btn:hover,
		.view_swither_panel_style4 .btn.btn-primary.directorypress-grid-view-btn:hover{
			background:{$directorypress_secondary_color};
			border-color:{$directorypress_secondary_color};
		}
		.directorypress-content-wrap .switcher-panel-style-4 .btn-primary.directorypress-grid-view-btn,
		.directorypress-content-wrap .switcher-panel-style-4 .btn-primary.directorypress-list-view-btn,
		.directorypress-content-wrap .switcher-panel-style-4 .directorypress-map_toggle_button.active{
			color:{$directorypress_primary_color} !important;
			border-color:{$directorypress_primary_color} !important;
			border-radius:50%;
			background:none !important;
		}
		.switcher-panel-style-4 .directorypress_search_toggle_button.active
		.switcher-panel-style-4 .directorypress_search_toggle_button:hover{
			background-color:{$directorypress_primary_color} !important;
			border-color:{$directorypress_primary_color} !important;
			border-radius:50%;
			color:#fff;
		}
		.map-wrapper .directorypress-map_toggle_button.active{
			color:{$directorypress_primary_color} !important;
			border-color:{$directorypress_primary_color} !important;
			border-radius:4px;
			background:#fff !important;
		}

		.view_swither_panel_style2 .btn-primary.directorypress-grid-view-btn,
		.view_swither_panel_style2 .btn-primary.directorypress-list-view-btn{
			background:none !important;
			color:{$pacz_settings['btn-hover']} !important;
			border:none !important;
		}
		.directorypress-content-wrap .switcher-panel-style-4 .btn-primary.directorypress-grid-view-btn,
		.directorypress-content-wrap switcher-panel-style-4 .btn-primary.directorypress-list-view-btn{
				color:{$directorypress_primary_color} !important;
				border-color:{$directorypress_primary_color} !important;
				border-radius:50%;
				background:none !important;
		}
		.view_swither_panel_style2 .directorypress-orderby-links a.btn-default:hover,
		.view_swither_panel_style2 .directorypress-orderby-links a.btn-primary,
		.view_swither_panel_style2 .directorypress-orderby-links a.btn-primary:hover{
			border-color:{$pacz_settings['link-color']['hover']} !important;
		}
	");
}

//database update
if(!get_option('pacz_directorypress_3_4_0')){
	pacz_directorypress_3_4_0_fix();
}
function pacz_directorypress_3_4_0_fix(){
	global $wpdb;
	$prefix = $wpdb->prefix;

	$old_values = array('"location_style":"1"','"location_style":"2"','"location_style":"3"','"location_style":"5"','"location_style":"6"','"location_style":"7"','"location_style":"10"');
	$new = '"location_style":"custom"';
	foreach($old_values AS $old_value){
		$wpdb->query("UPDATE `".$prefix."postmeta` SET `meta_value` = replace(meta_value, '".$old_value."', '".$new."')");
	}
	$old_value = '"location_style":"4"';
	$new_value = '"location_style":"2"';
	$wpdb->query("UPDATE `".$prefix."postmeta` SET `meta_value` = replace(meta_value, '".$old_value."', '".$new_value."')");
	
	$old_value = '"location_style":"8"';
	$new_value = '"location_style":"3"';
	$wpdb->query("UPDATE `".$prefix."postmeta` SET `meta_value` = replace(meta_value, '".$old_value."', '".$new_value."')");
	
	
	$old_value = '"location_style":"0"';
	$new_value = '"location_style":"default"';
	$wpdb->query("UPDATE `".$prefix."postmeta` SET `meta_value` = replace(meta_value, '".$old_value."', '".$new_value."')");
	
	
	$old_value = '"location_style":"9"';
	$new_value = '"location_style":"default"';
	$wpdb->query("UPDATE `".$prefix."postmeta` SET `meta_value` = replace(meta_value, '".$old_value."', '".$new_value."')");
	
	// shortcode update
	
	$old_value_1 = 'location_style="1"';
	$old_value_2 = 'location_style="2"';
	$old_value_3 = 'location_style="3"';
	$old_value_4 = 'location_style="4"';
	$old_value_5 = 'location_style="5"';
	$old_value_6 = 'location_style="6"';
	$old_value_7 = 'location_style="7"';
	$old_value_8 = 'location_style="8"';
	$old_value_9 = 'location_style="9"';
	$old_value_10 = 'location_style="10"';
	
	$new_value = 'location_style="custom"';
	$wpdb->query("UPDATE `".$prefix."posts` SET `post_content` = replace(post_content, '".$old_value_1."', '".$new_value."')");
	$wpdb->query("UPDATE `".$prefix."posts` SET `post_content` = replace(post_content, '".$old_value_2."', '".$new_value."')");
	$wpdb->query("UPDATE `".$prefix."posts` SET `post_content` = replace(post_content, '".$old_value_3."', '".$new_value."')");
	$wpdb->query("UPDATE `".$prefix."posts` SET `post_content` = replace(post_content, '".$old_value_5."', '".$new_value."')");
	$wpdb->query("UPDATE `".$prefix."posts` SET `post_content` = replace(post_content, '".$old_value_6."', '".$new_value."')");
	$wpdb->query("UPDATE `".$prefix."posts` SET `post_content` = replace(post_content, '".$old_value_7."', '".$new_value."')");
	
	$new_value = 'location_style="2"';
	$wpdb->query("UPDATE `".$prefix."posts` SET `post_content` = replace(post_content, '".$old_value_4."', '".$new_value."')");
	$new_value = 'location_style="3"';
	$wpdb->query("UPDATE `".$prefix."posts` SET `post_content` = replace(post_content, '".$old_value_8."', '".$new_value."')");
	$new_value = 'location_style="default"';
	$wpdb->query("UPDATE `".$prefix."posts` SET `post_content` = replace(post_content, '".$old_value_9."', '".$new_value."')");
	
	add_option('pacz_directorypress_3_4_0', 1);
	
	
}