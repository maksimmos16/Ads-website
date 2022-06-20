<?php global $DIRECTORYPRESS_ADIMN_SETTINGS; ?>
<?php echo $args['before_widget']; ?>
<?php if (!empty($title))
echo $args['before_title'] . $title . $args['after_title'];
?>
<div class=" directorypress-widget directorypress_bids_widget"><!-- content class removed directorypress -->
	<ul>
		<?php
		$listing = $GLOBALS['listing_id'];
		echo '<li><span class="bid-item-label">'.esc_html__('Total Bids', 'DIRECTORYPRESS').'</span><span class="bid-item-value">'.$listing->bidcount().'</span></li>';
		echo '<li><span class="bid-item-label">'.esc_html__('Highest Bid', 'DIRECTORYPRESS').'</span><span class="bid-item-value">'.round($listing->highestbid(), 2).'</li>';
		echo '<li><span class="bid-item-label">'.esc_html__('Lowest Bid', 'DIRECTORYPRESS').'</span><span class="bid-item-value">'.round($listing->lowestbid(),2).'</li>'; 
		echo '<li><span class="bid-item-label">'.esc_html__('Average Bid', 'DIRECTORYPRESS').'</span><span class="bid-item-value">'.round($listing->avgbid(),2).'</li>';
		
		?>
	</ul>
</div>
<?php echo $args['after_widget']; ?>