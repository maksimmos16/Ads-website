<?php 

/**
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/single-listing
 * @author     DirectoryPress <team@directorypress.co>
*/

$address = array();
foreach ($listing->locations AS $location){
	$address[] = $location->get_location();
}
$output = implode(', ', $address);
?>
<?php if($listing->locations && !empty($output)): ?>
	<div class="single-location-address">
		<i class="fas fa-map-marker-alt"></i>
		<?php echo $output; ?>
	</div>
<?php endif; ?>

 