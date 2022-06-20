<?php 

/**
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/single-listing
 * @author     DirectoryPress <team@directorypress.co>
*/
global $DIRECTORYPRESS_ADIMN_SETTINGS;
$text_string = ($button_text)? esc_html__('Download', 'DIRECTORYPRESS'): '';
$tooltip = (!$button_text)? 'data-toggle="tooltip" title="'.esc_attr__('Save listing in PDF', 'DIRECTORYPRESS').'"':'';
?>
<?php if($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_pdf_button']): ?>
	<a href="javascript:void(0);" class="directorypress-pdf-listing-link btn button-style-<?php echo $button_style; ?>" onClick="window.open('http://pdfmyurl.com/?url=<?php echo add_query_arg('directorypress_action', 'pdflisting', get_permalink($listing->post->ID)); ?>');" <?php echo $tooltip; ?>><i class="far fa-file-pdf"></i><?php echo $text_string; ?></a>
<?php endif; ?>