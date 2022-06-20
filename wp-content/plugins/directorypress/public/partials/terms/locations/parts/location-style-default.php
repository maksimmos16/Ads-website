<?php
 
	global $DIRECTORYPRESS_ADIMN_SETTINGS,$directorypress_object;
	$terms_count = count($terms);
	$terms_number = count($terms);
	$counter = 0;
	$tcounter = 0;
	$row = '';
	$gutter = 'padding:'.$instance->location_padding.'px;';
	echo '<div id="loaction-styles'.$instance->args['id'].'" class="'.$row.' location-style-'.$instance->location_style.' grid-item directorypress-locations-columns clearfix" style="'.$gutter.'">';
			
		foreach ($terms AS $key=>$term) {
			$tcounter++;
			$term_count = ($instance->count) ? '('.$instance->getCount($term).')': '';
			$icon_image = '<span class="location-icon"><i class="fas fa-map-marker-alt"></i></span>';
			
			echo '<div class="directorypress-location-item col-md-' . $instance->col . ' col-sm-' . $instance->col_tab . ' col-xs-' . $instance->col_mobile . '">';	
				echo '<div class="directorypress-location-item-holder">';
					echo '<div class="directorypress-parent-location">';
						echo '<a href="' . get_term_link($term) . '" title="' . $term->name .$term_count . '"><span class="location-icon"><i class="fas fa-map-marker-alt"></i></span><span class="loaction-name">' . $term->name .'</span><span class="location-item-numbers">'.$term_count.'</span></a>';
					echo '</div>';
					if($instance->depth > 1){
						echo $instance->_display($term->term_id, $instance->depth);
					}
				echo '</div>';		
			echo '</div>';
					
			$counter++;
			if ($counter == $instance->col) {
				$counter = 0;
			}
				
		}
	echo '</div>';