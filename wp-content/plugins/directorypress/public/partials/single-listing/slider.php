<?php 

/**
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/single-listing
 * @author     DirectoryPress <team@directorypress.co>
*/
global $DIRECTORYPRESS_ADIMN_SETTINGS;
$images = array();
$image_number = count($listing->images);
$full_with_image = $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_100_single_logo_width'];
if($full_with_image){
	$width = '';
	$height = '';
}else{
	$width = $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_single_logo_width'];
	$height = $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_single_logo_height'];
}
if(!$slider_nav){
	$nonav_class = 'slick-carousel-nonav';
}else{
	$nonav_class = 'slick-carousel2';
}

?>
<div class="directorypress-listing-figure-wrap directorypress-single-listing-logo-wrap" id="images">
<?php if (count($listing->images) > 1): ?>
	<div class="<?php echo $nonav_class; ?>">
		<?php
			foreach ($listing->images AS $attachment_id=>$image):
				$image_src_array = wp_get_attachment_image_src($attachment_id, 'full');
				$image_src = (is_array($image_src_array))? $image_src_array[0]: $image_src_array; 
				if(!$full_with_image){
					$param = array(
						'width' => $width,
						'height' => $height,
						'crop' => true
					);
					$url = bfi_thumb($image_src, $param);
				}else{
					$url = $image_src;
				}
												
				if ($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_enable_lighbox_gallery']){		
					$images = '<div><a class="slide-link" href="' . $image_src . '" data-lightbox="listing_images" title="images"><i class="directorypress-fic4-zoom-out"></i><img class="" data-lazy="' . esc_url($url) . '" width="'.$width.'" height="'.$height.'"  alt="images"/><i class="fas fa-expand"></i></a></div>';
				}else{
					$images = '<img class="slide-link" data-lazy="' . esc_url($url) . '" width="'.$width.'" height="'.$height.'"  alt="images"/>';
				}
				
				echo $images;
			endforeach;
		?>
	</div>
	<?php if($slider_nav): ?>
		<div class="slider-nav">
			<?php
				$param = array(
					'width' => 152,
					'height' => 100,
					'crop' => true
				);
				foreach ($listing->images AS $attachment_id=>$image):
					$image_src_array = wp_get_attachment_image_src($attachment_id, 'full');
					$image_src = (is_array($image_src_array))? $image_src_array[0]: $image_src_array;
					$images = '<img class="slide-link" data-lazy="' . bfi_thumb($image_src, $param) . '" width="152" height="100"  alt="thumbnail"/>';
					echo $images;
				endforeach;
			?>
		</div>
	<?php endif; ?>
<?php elseif (count($listing->images) == 1): ?>
	<?php
			foreach ($listing->images AS $attachment_id=>$image):
				$image_src_array = wp_get_attachment_image_src($attachment_id, 'full');
				$image_src = (is_array($image_src_array))? $image_src_array[0]: $image_src_array;
				if(!$full_with_image){
					$param = array(
						'width' => $width,
						'height' => $height,
						'crop' => true
					);
					$url = bfi_thumb($image_src, $param);
				}else{
					$url = $image_src;
				}
												
				$images = '<img class="media-link" src="' . esc_url($url) . '"  alt="Media" data-lightbox="listing_images" title="images"/>';
				echo $images;
			endforeach;
		?>
<?php else: ?>	

	<?php
		if(isset($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_nologo_url']['url']) && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_nologo_url']['url'])){
			$image_src = $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_nologo_url']['url'];
		}else{
			$image_src = DIRECTORYPRESS_RESOURCES_URL.'images/no-thumbnail.jpg';
		}
		$param = array(
			'width' => $width,
			'height' => $height,
			'crop' => true
		);
		$images = '<img src="' . bfi_thumb($image_src, $param) . '" alt="'.esc_attr__('no media', 'DIRECTORYPRESS').'"/>';
		echo $images;
	?>
<?php endif; ?>
</div>


 