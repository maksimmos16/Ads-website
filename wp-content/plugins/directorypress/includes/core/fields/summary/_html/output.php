<?php 
global $DIRECTORYPRESS_ADIMN_SETTINGS;
if (has_excerpt() || ($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_cropped_content_as_excerpt'] && get_post()->post_content !== '')): ?>

<div class="directorypress-field-item directorypress-field-type-<?php echo $field->type; ?>">
	<?php if ($field->icon_image || !$field->is_hide_name): ?>
	<span class="field-label">
		<?php if ($field->icon_image): ?>
		<span class="directorypress-field-icon fa fa-lg <?php echo $field->icon_image; ?>"></span>
		<?php endif; ?>
		<?php if (!$field->is_hide_name): ?>
		<span class="directorypress-field-title"><?php echo $field->name?>:</span>
		<?php endif; ?>
	</span>
	<?php endif; ?>
	<?php  
		
	?>
	<span class="field-content">
		<?php
			ob_start();
			the_excerpt_max_charlength($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_excerpt_length']);
			echo ob_get_clean();
		?>
	</span>
</div>
<?php endif; ?>