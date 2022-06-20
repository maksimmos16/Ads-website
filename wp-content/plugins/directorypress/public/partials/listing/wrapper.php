<?php	
	global $DIRECTORYPRESS_ADIMN_SETTINGS, $directorypress_object;
	$listing_style_to_show = $public_handler->listing_view;
	$id = uniqid();
	global $directorypress_dynamic_styles;
	$directorypress_styles = '';
	if($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_listing_listview_post_style'] == 'listview_mod'){
		$lwidth= 250;
		$lheight= 224;
					
	}else{
		$lwidth= 130;
		$lheight= 130;
	}
	$calc_content_width = $lwidth + 145;
	$directorypress_styles .= '
	.listing-post-style-listview_default .directorypress-listing-text-content-wrap,
	.listing-post-style-listview_ultra .directorypress-listing-text-content-wrap {
		width:calc(100% - '.$lwidth.'px);
		width: -webkit-calc(100% - '.$lwidth.'px);
		width: -moz-calc(100% - '.$lwidth.'px);
		float:left;
	}
	.listing-post-style-listview_mod .directorypress-listing-text-content-wrap {
		width:calc(100% - '.$calc_content_width.'px);
		width: -webkit-calc(100% - '.$calc_content_width.'px);
		width: -moz-calc(100% - '.$calc_content_width.'px);
		float:left;
	}
	.listing-post-style-listview_default figure,
	.listing-post-style-listview_ultra figure,
	.listing-post-style-listview_mod figure{
		width:'.$lwidth.'px;
		
		float:left;
	}
	.listing-post-style-listview_mod .list-author-content-area{
		height:'. $lheight .'px;
	}
	';
	// Hidden styles node for head injection after page load through ajax
	echo '<div id="ajax-'.$id.'" class="directorypress-dynamic-styles">';
	echo '</div>';


	// Export styles to json for faster page load
	$directorypress_dynamic_styles[] = array(
	  'id' => 'ajax-'.$id ,
	  'inject' => $directorypress_styles
	);
	
	$grid_padding = (isset($public_handler->args['grid_padding']))? $public_handler->args['grid_padding'] : $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_grid_padding'];
	$directorypress_grid_margin_bottom = $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_grid_margin_bottom'];
			
			
			if($public_handler->args['2col_responsive'] && $listing_style_to_show == 'show_grid_style' && ($public_handler->args['listing_post_style'] == 10 || $public_handler->args['listing_post_style'] == 14)){
				$directorypress_responsive_col = 'responsive-2col';
			 }else{
				$directorypress_responsive_col = '';
			 }
			 if($public_handler->args['scroll'] == 1){
				 $carousel = 'carousel-active';
			 }else{
				 $carousel = 'no-carousel';
			 }
$bookmark_page_class = '';
if(directorypress_is_bookmark_page()){
	$bookmark_page_class = 'infavourites';
}
if($listing_style_to_show == 'show_grid_style'){
	$listing_block_classes = 'directorypress-listings-grid '.$bookmark_page_class.' directorypress-listings-grid-'.$public_handler->args['listings_view_grid_columns'];
}else{
	$listing_block_classes = 'cz-listview';
}
$masonry_attr = 'data-masonry-false';
$masonry_item = '';
$masonry_wrapper = '';
if ($listing_style_to_show == 'show_grid_style' && !$public_handler->args['scroll']){
	$masonry_attr = 'data-masonry';
	$masonry_item = 'm-grid-item';
	$masonry_wrapper = 'm-grid';
}
$slider_arrow = ($public_handler->args['owl_nav'])? 'true': 'false';
$slider_loop = ($public_handler->args['loop'])? 'true': 'false';
$slider_autoplay = ($public_handler->args['autoplay'])? 'true': 'false';
?>
<div class="listing-parent" id="directorypress-handler-<?php echo $public_handler->hash; ?>" data-handler-hash="<?php echo $public_handler->hash; ?>">
	<script>
		directorypress_handler_args_array['<?php echo $public_handler->hash; ?>'] = <?php echo json_encode(array_merge(array('handler' => $public_handler->directorypress_client, 'base_url' => $public_handler->base_url), $public_handler->args)); ?>;	
	</script>
	<?php if ($public_handler->do_initial_load): ?>
		<div class="directorypress-container-fluid directorypress-listings-block <?php echo $listing_block_classes; ?>">
			
			<?php do_action('directorypress_listing_sorting_panel', $public_handler, $listing_style_to_show); ?>
			
			<?php if ($public_handler->listings): ?>
				<div 
					id="listing-block-<?php echo $public_handler->hash; ?>"
					class="directorypress-listings-block-content 
					<?php echo $carousel; ?> 
					<?php if($public_handler->args['scroller_nav_style'] == 2){ echo 'scroller_nav_style2'; } ?> 
					<?php echo $masonry_wrapper; ?>
					clearfix" 
					<?php if ($listing_style_to_show == 'show_grid_style'){ ?> 
					style="margin-left:-<?php echo $grid_padding; ?>px; 
					margin-right: -<?php echo $grid_padding; ?>px;" <?php } ?>
					<?php if($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_grid_masonry_display']){ ?> data-uniqid="<?php echo $public_handler->hash; } ?>" 
					<?php echo $masonry_attr; ?>='{ "itemSelector": ".m-grid-item", "percentPosition": true }'
				>
					<?php if ($public_handler->args['scroll']): ?>
						<?php if(!empty($public_handler->args['custom_category_link'])): ?>
							<div class="custom-category-link">
								<a href="<?php echo $public_handler->args['custom_category_link']; ?>"><?php echo esc_html($public_handler->args['custom_category_link_text']); ?></a>
							</div>
						<?php endif; ?>
						<div class="dp-slick-carousel owl-on-grid"
							data-items="<?php echo $public_handler->args['desktop_items']; ?>"
							data-items-1024="<?php echo $public_handler->args['tab_landscape_items']; ?>"
							data-items-768="<?php echo $public_handler->args['tab_items']; ?>"
							data-slide-to-scroll="1"
							data-slide-speed="1000"
							data-autoplay="<?php echo $slider_autoplay; ?>"
							data-center-padding ="<?php echo $public_handler->args['gutter']; ?>"
							data-center="false"
							data-autoplay-speed ="<?php echo $public_handler->args['autoplay_speed']; ?>"
							data-loop="<?php echo $slider_loop; ?>"
							data-list-margin="<?php echo $grid_padding; ?>"
							data-arrow="<?php echo $slider_arrow; ?>"
						>
					<?php endif; ?>
						<?php if($listing_style_to_show == 'show_list_style'): ?>
						<div class="listing-list-view-inner-wrap <?php echo $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_listing_listview_post_style']; ?>">
						<?php endif; ?>
								<?php while ($public_handler->query->have_posts()):
									$public_handler->query->the_post();
									if($public_handler->args['scroll']): 
								?>
										<div class="listing-box">	
									<?php endif; // slick listing box div ?>
											<article id="post-<?php the_ID(); ?>" class="<?php echo $public_handler->get_listing_location_class(); ?> <?php if ($public_handler->args['scroll'] == 1){ echo 'listing-scroll'; } ?> row directorypress-listing <?php  echo $directorypress_responsive_col . ' '. $masonry_item; ?> listing-post-style-<?php if ($listing_style_to_show == 'show_grid_style'){ echo $public_handler->args['listing_post_style'] . ' ' . 'listing-grid-item'; }else{ echo $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_listing_listview_post_style']; } ?> <?php if ($public_handler->listings[get_the_ID()]->package->has_featured) { echo 'directorypress-has_featured';} ?> <?php if ($public_handler->listings[get_the_ID()]->package->has_sticky) echo 'directorypress-has_sticky'; ?> clearfix" <?php if ($listing_style_to_show == 'show_grid_style'){ ?> style="padding-left:<?php echo $grid_padding; ?>px; padding-right: <?php echo $grid_padding; ?>px; margin-bottom: <?php echo $directorypress_grid_margin_bottom; ?>px;" <?php } ?>>
												<div class="directorypress-listing-item-holder clearfix">
													<?php $public_handler->listings[get_the_ID()]->display($public_handler); ?>
												</div>
											</article>
									<?php if($public_handler->args['scroll']): ?>
										</div>
									<?php endif; //slick listing box end ?>
								<?php endwhile; ?>
						<?php if($listing_style_to_show == 'show_list_style'): ?>
							</div>
						<?php endif; ?>
					<?php if ($public_handler->args['scroll']): ?>
						</div>
					<?php endif; ?>
				</div>
				<?php if (!$public_handler->args['hide_paginator']): ?>
					<?php directorypress_pagination_display($public_handler->query, $public_handler->hash, $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_show_more_button'], $public_handler); ?>
				<?php endif; ?>
			<?php else: ?>
					<?php printf(__('Found', "DIRECTORYPRESS") . ' <span class="badge">%d</span> %s', $public_handler->query->found_posts, _n($public_handler->directorypress_get_directoytype_of_listing()->single, $public_handler->directorypress_get_directoytype_of_listing()->plural, $public_handler->query->found_posts)); ?>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</div>