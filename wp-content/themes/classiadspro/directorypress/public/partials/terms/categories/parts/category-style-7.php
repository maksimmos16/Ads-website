<?php
 
	global $DIRECTORYPRESS_ADIMN_SETTINGS,$directorypress_object;
	
	echo '<div id="directorypress-category-'.$instance->args['id'].'" class="cat-style-'.$instance->cat_style.'">';
			
		$terms_count = count($terms);
		$terms_number = count($terms);
		$counter = 0;
		$tcounter = 0;
		if($instance->scroll == 1){
			$scroll_attr = 'data-items="'.$instance->desktop_items.'" data-items-1024="'. $instance->tab_landscape_items.'" data-items-768="'. $instance->tab_items.'" data-autoplay="'.$instance->autoplay.'" data-loop="'.$instance->loop.'" data-arrow="'.$instance->owl_nav.'" data-delay="'.$instance->delay.'" data-autoplay-speed="'.$instance->autoplay_speed.'" data-gutter="'.$instance->gutter.'"';
			$scroll_class = 'dp-slick-carousel';
		}else{
			$scroll_attr = '';
			$scroll_class = '';
		}
		
		echo '<div class="row directorypress-categories-wrapper '.$scroll_class . ' clearfix" '.$scroll_attr.'>';
	
			foreach ($terms AS $key=>$term) {
				$tcounter++;
					if ($instance->scroll == 0 && count( get_term_children( $term->term_id, DIRECTORYPRESS_CATEGORIES_TAX ) ) > 0 ) {
						$more_cat_icon = '<i class="fas fa-plus-circle" data-popup-open="' . $term->term_id .'"></i>';
					}else{
						$more_cat_icon = '';
					} 
					if($cat_color_set = get_listing_category_color($term->term_id)){
						$cat_color = $cat_color_set;
					}else{
						$cat_color = $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_primary_color'];
					}
					
					// term wrapper
					echo '<div class="directorypress-category-item col-md-' . $instance->col . ' col-sm-' . $instance->col_tab . ' col-xs-' . $instance->col_mobile . '">';
						echo '<div id="cat-wrapper-'.$term->term_id.'" class="directorypress-category-holder clearfix">';		
							echo '<div class="cat-7-icon" id="cat-'.$term->term_id.'" style="border-color:'.$cat_color.'">' . $instance->termIcon($term->term_id) .'</div>';
							echo '<div class="cat-7-content">';
								echo '<div class="directorypress-parent-category"><a href="' . get_term_link($term) . '" title="' . $term->name . '"><span class="categories-name">'. $term->name .'</span><span class="categories-count">'.$instance->renderTermCount($term). '</span></a></div>';
								echo wp_kses_post($instance->_display($term->term_id, $instance->depth));
							echo '</div>';
							echo '<script>
								(function($){
									$("#cat-wrapper-'.$term->term_id.'").hover(function(e) {
										$("#cat-'.$term->term_id.'").css("background-color",e.type === "mouseenter"?"'.$cat_color.'":"transparent");
									});
								})(jQuery);
							</script>';
						echo '</div>';
					echo '</div>';
						
				$counter++;
							
				if ($counter == $instance->col) {
					$counter = 0;
				}
					
			}
		echo '</div>';		
	echo '</div>';