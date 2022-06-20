<?php 

/**
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/single-listing
 * @author     DirectoryPress <team@directorypress.co>
*/

global $DIRECTORYPRESS_ADIMN_SETTINGS;
$post_id = $listing->post->ID;

$text_string = ($button_text)? esc_html__('Share', 'DIRECTORYPRESS'): '';
$tooltip = (!$button_text)? 'data-toggle="tooltip" title="'.esc_attr__('Share', 'DIRECTORYPRESS').'"':'';
$enabled = $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_share_buttons']['enabled'];
unset($enabled['placebo']);
?>

<?php if (!empty($enabled)): ?>
	<a class="directorypress-sharing-link button-style-<?php echo $button_style; ?>"  data-popup-open="single_sharing_data" href="#" <?php echo $tooltip; ?>><i class="fas fa-share-alt"></i><?php echo $text_string; ?></a>
	<div class="directorypress-custom-popup" data-popup="single_sharing_data">
		<div class="directorypress-custom-popup-inner single-contact">
			<div class="directorypress-popup-title"><?php echo esc_html__('Share This Listing', 'DIRECTORYPRESS'); ?><a class="directorypress-custom-popup-close" data-popup-close="single_sharing_data" href="#"><i class="far fa-times-circle"></i></a></div>
			<div class="directorypress-popup-content">
				<div class="directorypress-share-buttons">
					<?php foreach ($enabled AS $button): ?>	
						<div class="directorypress-share-button">
							<?php directorypress_social_sharing_display($post_id, $button); ?>
						</div>	
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>



 