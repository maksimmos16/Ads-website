<?php 

/**
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/single-listing
 * @author     DirectoryPress <team@directorypress.co>
*/

global $DIRECTORYPRESS_ADIMN_SETTINGS;
?>
<?php if(isset($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_single_listing_views']) && $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_single_listing_views']): ?>
	<div class="listing-views"><i class="fas fa-eye"></i><?php echo sprintf(__('Views: %d', 'DIRECTORYPRESS'), (get_post_meta($listing->post->ID, '_total_clicks', true) ? get_post_meta($listing->post->ID, '_total_clicks', true) : 0)); ?></div>
<?php endif; ?>