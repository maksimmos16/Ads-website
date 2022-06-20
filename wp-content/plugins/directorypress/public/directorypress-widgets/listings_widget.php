<?php global $DIRECTORYPRESS_ADIMN_SETTINGS; ?>
<?php echo $args['before_widget']; ?>
<?php if (!empty($title))
echo $args['before_title'] . $title . $args['after_title'];
if($is_slider_view){	
?>
<div class=" directorypress-widget directorypress_recent_listings_widget"><!-- content class removed directorypress -->
	<ul class="dp-slick-carousel owl-on-grid clearfix" data-items="1" data-items-tab-ls="1" data-items-tab="1" data-autoplay="true" data-autowidth="false" data-center="false" data-loop="true" data-nav="true" data-delay="1000" data-autoplay-speed="1000" data-gutter="0">
		<?php foreach ($listings AS $listing): ?>
		<li class="directorypress-widget-listing <?php if ($listing->package->has_featured): ?>directorypress-has_featured<?php endif; ?>">
			<div class="directorypress-widget-listing-logo">
				<?php 
					$img = wp_get_attachment_image_src($listing->logo_image, 'full');
					$img_src  = $img[0];
					$param = array(
							'width' => $width,
							'height' => $height,
							'crop' => true
					);
				?>
				<a href="<?php echo get_permalink($listing->post->ID); ?>" title="<?php echo esc_attr($listing->title()); ?>" rel="nofollow">
					<img src="<?php echo bfi_thumb($img_src,$param); ?>" alt="listing logo" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /><!-- width removed directorypress -->
				</a>
			
				<div class="price">
					<?php 
						global $wpdb;
						$field_ids = $wpdb->get_results('SELECT id, type, slug FROM '.$wpdb->prefix.'directorypress_fields');
						foreach( $field_ids as $field_id ) {
							$singlefield_id = $field_id->id;
							if($field_id->type == 'price' && ($field_id->slug == 'price' || $field_id->slug == 'Price') ){			
								$listing->display_content_field($singlefield_id);
							}				
						}	
					?>
				</div>
			
			</div>
	
			<div class="directorypress-widget-listing-title">
				<a href="<?php echo get_permalink($listing->post->ID); ?>" title="<?php echo esc_attr($listing->title()); ?>" rel="nofollow"><?php echo $listing->title(); ?></a>
				<br />
				<?php echo human_time_diff(mysql2date('U', $listing->post->post_date), time()); ?> <?php _e('ago', 'DIRECTORYPRESS'); ?>
				
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
<?php }else{ ?>
<div class=" directorypress-widget directorypress_recent_listings_widget"><!-- content class removed directorypress -->
	<ul class="clearfix">
		<?php foreach ($listings AS $listing): ?>
		<li class="directorypress-widget-listing <?php if ($listing->package->has_featured): ?>directorypress-has_featured<?php endif; ?>">
			<div class="directorypress-widget-listing-logo">
			<?php if ($listing->logo_image && ($img = wp_get_attachment_image_src($listing->logo_image))): ?>
				<?php 
				$img = wp_get_attachment_image_src($listing->logo_image, 'full');
					$img_src  = bfi_thumb($img[0], array(
							'width' => $img[2],
							'height' => $img[2],
							'crop' => true
					));
				$img_width = $img[2]; ?>
			<?php else: ?>
				<?php 
				$img_width = '150';
				$img = $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_nologo_url']['url'];
				$img_src = $img;
					$param = array(
							'width' => $img_width,
							'height' => $img_width,
							'crop' => true
					);
				?>
			<?php endif; ?>
				<a href="<?php echo get_permalink($listing->post->ID); ?>" title="<?php echo esc_attr($listing->title()); ?>" rel="nofollow">
					<img src="<?php echo bfi_thumb($img_src, $param); ?>" alt="listing logo" width="<?php echo $img_width; ?>" height="<?php echo $img_width; ?>" /><!-- width removed directorypress -->
					<div class="listing-widget-hover-overlay"><i class="directorypress-icon-share"></i></div>
				</a>
			</div>
	
			<div class="directorypress-widget-listing-title">
				<a href="<?php echo get_permalink($listing->post->ID); ?>" title="<?php echo esc_attr($listing->title()); ?>" rel="nofollow"><?php echo $listing->title(); ?></a>
				<br />
				<?php echo human_time_diff(mysql2date('U', $listing->post->post_date), time()); ?> <?php _e('ago', 'DIRECTORYPRESS'); ?>
				
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
</div>
<?php } ?>
<?php echo $args['after_widget']; ?>