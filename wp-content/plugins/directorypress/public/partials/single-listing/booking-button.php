<?php 

/**
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/single-listing
 * @author     DirectoryPress <team@directorypress.co>
*/

global $DIRECTORYPRESS_ADIMN_SETTINGS;
$post_id = $listing->post->ID;

$text_string = ($button_text)? esc_html__('Book Now', 'DIRECTORYPRESS'): '';

?>
<?php if($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_listing_resurva_booking']): ?>
	<a class="directorypress-booking-link button-style-<?php echo $button_style; ?>" data-popup-open="single_reserva_booking_form" href="#"><?php echo $text_string; ?></a>
	<?php echo do_action('single-listing-resurva-booking-form', $listing); ?>
<?php endif; ?>	



 