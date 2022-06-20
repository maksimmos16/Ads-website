<?php 

/**
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/single-listing
 * @author     DirectoryPress <team@directorypress.co>
*/
global $DIRECTORYPRESS_ADIMN_SETTINGS;
$text_string = ($button_text)? esc_html__('Print', 'DIRECTORYPRESS'): '';
$tooltip = (!$button_text)? 'data-toggle="tooltip" title="'.esc_attr__('Print Listing', 'DIRECTORYPRESS').'"':'';
?>
<?php if ($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_print_button']): ?>
	<script>
		var window_width = 860;
		var window_height = 800;
		var leftPosition, topPosition;
		(function($) {
			"use strict";
				
			$(function() {
				leftPosition = (window.screen.width / 2) - ((window_width / 2) + 10);
				topPosition = (window.screen.height / 2) - ((window_height / 2) + 50);
			});
		})(jQuery);
	</script>
	<a href="javascript:void(0);" class="directorypress-print-listing-link btn button-style-<?php echo $button_style; ?>" onClick="window.open('<?php echo add_query_arg('directorypress_action', 'printlisting', get_permalink($listing->post->ID)); ?>', 'print_window', 'height='+window_height+',width='+window_width+',left='+leftPosition+',top='+topPosition+',menubar=yes,scrollbars=yes');" <?php echo $tooltip; ?>><i class="fas fa-print"></i><?php echo $text_string; ?></a>	
<?php endif; ?>



 