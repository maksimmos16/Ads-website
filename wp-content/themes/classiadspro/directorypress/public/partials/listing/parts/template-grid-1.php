<?php
	// Figure
	echo '<figure class="directorypress-listing-figure">';
		do_action('directorypress_listing_grid_thumbnail', $listing);
		do_action('directorypress_listing_grid_status_tag', $listing);
		echo '<div class="listing-logo-overlay"><a href="'.get_permalink().'"></a></div>';
	echo '</figure>';
	do_action('directorypress_wcfm_add_to_cart', $listing->post->ID, 'pacz-fic-shopping-basket');
	// content 
	echo '<div class="clearfix directorypress-listing-text-content-wrap">';
		do_action('directorypress_listing_grid_featured_tag', $listing);
		do_action('directorypress_listing_grid_title', $listing);
		do_action('directorypress_listing_grid_price_field', $listing);
	echo '</div>';