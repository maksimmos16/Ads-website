<?php 
	global $DIRECTORYPRESS_ADIMN_SETTINGS, $directorypress_object;
	if ($directorypress_directory_handler = $directorypress_object->directorypress_get_property_of_shortcode(DIRECTORYPRESS_MAIN_SHORTCODE) && $DIRECTORYPRESS_ADIMN_SETTINGS['archive_page_style'] != 2){
		$field_width = $search_field->field->fieldwidth_archive;
	}elseif($directorypress_directory_handler = $directorypress_object->directorypress_get_property_of_shortcode(DIRECTORYPRESS_MAIN_SHORTCODE) && $DIRECTORYPRESS_ADIMN_SETTINGS['archive_page_style'] == 2){
		$field_width = '100';
	}else{
		$field_width = $search_field->field->fieldwidth;
	}
 ?>
<?php //$gap_in_fields = $DIRECTORYPRESS_ADIMN_SETTINGS['gap_in_fields']; ?>
<div class="search-element-col field-id-<?php echo $search_field->field->id; ?> field-form-id-<?php echo $search_form_id; ?> unique-form-field-id-<?php echo $search_field->field->id; ?>_<?php echo $search_form_id; ?> field-type-<?php echo $search_field->field->type; ?>  pull-left" style=" width:<?php echo $field_width; ?>%; padding:0 <?php echo $gap_in_fields; ?>px;">
	<?php if(!$search_field->field->is_hide_name_on_search){ ?>
		<label><?php echo $search_field->field->name; ?></label>
	<?php } ?>
	<div class="field-input-wrapper">
		<input type="text" class="form-control" name="field_<?php echo $search_field->field->slug; ?>" placeholder="<?php echo $search_field->field->name; ?>" value="<?php echo esc_attr($search_field->value); ?>" />
	</div>
</div>