<?php echo $args['before_widget']; ?>
<?php if (!empty($title))
echo $args['before_title'] . $title . $args['after_title'];
?>
<?php if (isset($style) && $style == 1){ ?>
<div class="directorypress-widget directorypress-locations-widget clearfix">
<?php }else{ ?>
	<div class="directorypress-widget directorypress-locations-widget style2 clearfix">	
<?php } ?>
	<?php directorypress_renderAllLocations($parent, $depth, 1, $counter, $sublocations); ?>
</div>
<?php echo $args['after_widget']; ?>