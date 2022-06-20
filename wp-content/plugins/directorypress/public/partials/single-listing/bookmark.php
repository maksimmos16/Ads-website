<?php 

/**
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/single-listing
 * @author     DirectoryPress <team@directorypress.co>
*/
global $DIRECTORYPRESS_ADIMN_SETTINGS;
$add_string = ($button_text)? esc_html__('Bookmark', 'DIRECTORYPRESS'): '';
$remove_string = ($button_text)? esc_html__('Remove Bookmark', 'DIRECTORYPRESS'): '';
$tooltip_add = (!$button_text)? 'data-toggle="tooltip" title="'.esc_attr__('Bookmark', 'DIRECTORYPRESS').'"':'';
$tooltip_remove = (!$button_text)? 'data-toggle="tooltip" title="'.esc_attr__('Remove Bookmark', 'DIRECTORYPRESS').'"':'';
?>
<?php if ($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_favourites_list']): ?>
	<?php if (directorypress_bookmark_list($listing->post->ID)): ?>
		<a href="javascript:void(0);" class="add_to_favourites btn button-style-<?php echo $button_style; ?>" data-listingid="<?php echo $listing->post->ID; ?>" <?php echo $remove_string; ?>><i class="style1 checked fas fa-heart"></i><?php echo $remove_string; ?></a>
	<?php else: ?>
		<a href="javascript:void(0);" class="add_to_favourites btn button-style-<?php echo $button_style; ?>" data-listingid="<?php echo $listing->post->ID; ?>" <?php echo $tooltip_remove; ?>><i class="style1 unchecked far fa-heart"></i><?php echo $add_string; ?></a>
	<?php endif; ?>
<?php endif; ?>



 