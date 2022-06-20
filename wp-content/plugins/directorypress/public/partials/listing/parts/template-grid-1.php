<?php
	global $DIRECTORYPRESS_ADIMN_SETTINGS, $directorypress_object, $wpdb;
	$field_ids = $wpdb->get_results('SELECT id, type, slug, on_exerpt_page FROM '.$wpdb->prefix.'directorypress_fields');
	if (directorypress_bookmark_list($listing->post->ID)){
		$bookmark = '<a id="'.$listing->post->ID.'" href="javascript:void(0);" class="add_to_favourites btn"><span class="style1 checked fas fa-heart"></span></a>';
	}else{
		$bookmark = '<a id="'.$listing->post->ID.'" href="javascript:void(0);" class="add_to_favourites btn"><span class="style1 unchecked far fa-heart"></span></a>';
	}
	// style one elca
	echo '<figure class="directorypress-listing-figure">';
					echo '<a href="'.get_permalink().'"><img alt="'.$listing->title().'" src="'. bfi_thumb($image_src, $param).'" width="'.$width.'" height="'.$height.'" /></a>';
					echo '<div class="listing-logo-overlay"><a href="'.get_permalink().'"></a></div>';
					if ($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_favourites_list'] && $directorypress_object->action != 'myfavourites'){
						echo $bookmark;
					}
	echo '</figure>';
	echo '<div class="clearfix directorypress-listing-text-content-wrap">';
					if ($is_has_featured == 'has_featured-ad'){
						echo $feature_tag;
					}
					echo '<header class="directorypress-listing-title">';
						echo $listing_title;
					echo '</header>';
					
					echo '<div class="price">';
						$field_ids = $wpdb->get_results('SELECT id, type, slug, on_exerpt_page FROM '.$wpdb->prefix.'directorypress_fields');
						foreach( $field_ids as $field_id ) {
							$singlefield_id = $field_id->id;
							if($field_id->type == 'price' && ($field_id->slug == 'price' || $field_id->slug == 'Price') ){				
								if($field_id->on_exerpt_page == 1){
									$listing->display_content_field($singlefield_id);
								}
							}				
						}
					echo '</div>';
					do_action('directorypress_listing_title_html', $listing);
	echo '</div>';