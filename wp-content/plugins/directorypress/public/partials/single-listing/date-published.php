<?php 

/**
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/single-listing
 * @author     DirectoryPress <team@directorypress.co>
*/

global $DIRECTORYPRESS_ADIMN_SETTINGS;
?>
<?php if(isset($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_single_listing_publish_date']) && $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_single_listing_publish_date']): ?>
	<div class="directorypress-listing-date" datetime="<?php echo date("Y-m-d", mysql2date('U', $listing->post->post_date)); ?>T<?php echo date("H:i", mysql2date('U', $listing->post->post_date)); ?>"><i class="fas fa-clock"></i><?php echo get_the_date(); ?></div>
<?php endif; ?>


 