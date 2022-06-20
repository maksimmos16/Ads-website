<?php 

/**
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/single-listing
 * @author     DirectoryPress <team@directorypress.co>
*/
global $DIRECTORYPRESS_ADIMN_SETTINGS;

$listing_number = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['single_listing_related_limit']))? $DIRECTORYPRESS_ADIMN_SETTINGS['single_listing_related_limit'] : 2;
$listing_column = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['single_listing_related_grid_col']))? $DIRECTORYPRESS_ADIMN_SETTINGS['single_listing_related_grid_col'] : 2;
$listing_view_type = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['single_listing_related_view_type']))? $DIRECTORYPRESS_ADIMN_SETTINGS['single_listing_related_view_type'] : 'grid';
$directorypress_listing_post_style = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_listing_post_style']))? $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_listing_post_style'] : 10; 
$terms = get_the_terms($listing->post->ID, DIRECTORYPRESS_CATEGORIES_TAX);

if (is_array($terms) || is_object($terms)) {
	$term_ids = wp_list_pluck( $terms, 'term_id' );
	$categories = implode(',', $term_ids);
	$count = 0;
	foreach($terms AS $term){
		$count = $term->count;
	}

	//echo $count;
	if($DIRECTORYPRESS_ADIMN_SETTINGS['single_listing_related'] && $count > 1){
		echo '<div class="similar-listing">';
			echo '<h6 class="directorypress-similar-listinh-heading">'. esc_html__('Related Listings', 'DIRECTORYPRESS').'</h6>';
			echo do_shortcode( '[directorypress-listings listing_post_style="'.$directorypress_listing_post_style.'" post__not_in="'. $listing->post->ID .'" listing_has_featured_tag_style="'.$directorypress_listing_post_style.'" masonry_layout="1" perpage="'.$listing_number.'" hide_paginator="1" hide_order="1" hide_count="1" show_views_switcher="0" listings_view_type="'.$listing_view_type.'" listings_view_grid_columns="'.$listing_column.'" categories="'.$categories.'"]' );
		echo '</div>';
	}
}


 