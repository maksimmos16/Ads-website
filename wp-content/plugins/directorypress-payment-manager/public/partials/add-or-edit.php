<?php $itab_id = uniqid(); ?>
<div class="directorypress-modal-content wp-clearfix">
	<ul class="nav nav-tabs" id="tabContent">
		
		<li class="active"><a href="#general-<?php echo $itab_id ?>" data-toggle="tab"><?php _e('General', 'directorypress-payment-manager'); ?></a></li>
		<li><a href="#expiry-<?php echo $itab_id ?>" data-toggle="tab"><?php _e('Expiry', 'directorypress-payment-manager'); ?></a></li>
		<li><a href="#features-<?php echo $itab_id ?>" data-toggle="tab"><?php _e('Features', 'directorypress-payment-manager'); ?></a></li>
		<li><a href="#resources-<?php echo $itab_id ?>" data-toggle="tab"><?php _e('Resources', 'directorypress-payment-manager'); ?></a></li>
		<li><a href="#dependency-<?php echo $itab_id ?>" data-toggle="tab"><?php _e('Dependency', 'directorypress-payment-manager'); ?></a></li>
	</ul>
	<div class="tab-content">
		<script>
			(function($) {
							"use strict";

							$(function() {
								$("body").on("click", "#package_no_expiry", function() {
									if ($('#package_no_expiry').is(':checked')) {
										$('#package_duration').attr('disabled', true);
										$('#package_duration_unit').attr('disabled', true);
										$('#change_package_id').attr('disabled', true);
									} else {
										$('#package_duration').removeAttr('disabled');
										$('#package_duration_unit').removeAttr('disabled');
										$('#change_package_id').removeAttr('disabled');
									}
								});
							});
			})(jQuery);
		</script>
		<form class="add-edit" method="POST" action="">
			<?php wp_nonce_field(DIRECTORYPRESS_PATH, 'directorypress_packages_nonce');?>
			<div class="tab-pane fade active in" id="general-<?php echo $itab_id ?>">				
				<div class="row clearfix">
					<div class="col-md-12">
						<label><?php _e('Package  Title', 'directorypress-payment-manager'); ?><span class="directorypress-red-asterisk">*</span></label>
					</div>
					<div class="col-md-12">
						<input name="name" type="text" class="regular-text" value="<?php echo esc_attr($item->name); ?>" />
						<?php directorypress_wpml_translation_notification_string(); ?>
					</div>
				</div>
				<div class="row clearfix">
					<div class="col-md-12">
						<label><?php _e('Package Summary', 'directorypress-payment-manager'); ?></label>
					</div>
					<div class="col-md-12">
						<p class="description"><?php _e("You can right a Short description for this package", 'directorypress-payment-manager'); ?></p>
						<textarea name="description" cols="60" rows="4" ><?php echo esc_textarea($item->description); ?></textarea>
						<?php directorypress_wpml_translation_notification_string(); ?>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="expiry-<?php echo $itab_id ?>">
				<div class="row clearfix">
					<div class="col-md-12"><label><?php _e('Package Expiry And Listing Number', 'directorypress-payment-manager'); ?></label></div>
					<div class="col-md-12"><p><?php _e("Listing will remain active for activation period", 'directorypress-payment-manager'); ?></p></div>
					<div class="col-md-12">
					<div><label><?php _e('Not Expirable?', 'directorypress-payment-manager'); ?></label></div>
						<label class="switch">
							<input name="package_no_expiry" type="checkbox" value="1" id="package_no_expiry" <?php checked($item->package_no_expiry); ?> />
							<span class="slider"></span>
						</label>
					</div>
					<div class="col-md-12">
						<div><label><?php _e('Set Duration', 'directorypress-payment-manager'); ?></label></div>
						<input name="package_duration" type="text" value="<?php echo $item->package_duration; ?>" id="package_duration" <?php disabled($item->package_no_expiry); ?> />
					</div>
					<div class="col-md-12">
						<div><label><?php _e('Select An interval', 'directorypress-payment-manager'); ?></label></div>
						<select name="package_duration_unit" id="package_duration_unit" <?php disabled($item->package_no_expiry); ?> >
							<option value="day" <?php if ($item->package_duration_unit == 'day') echo 'selected'; ?> ><?php _e("day(s)", "directorypress-payment-manager"); ?></option>
							<option value="week" <?php if ($item->package_duration_unit == 'week') echo 'selected'; ?> ><?php _e("week(s)", "directorypress-payment-manager"); ?></option>
							<option value="month" <?php if ($item->package_duration_unit == 'month') echo 'selected'; ?> ><?php _e("month(s)", "directorypress-payment-manager"); ?></option>
							<option value="year" <?php if ($item->package_duration_unit == 'year') echo 'selected'; ?> ><?php _e("year(s)", "directorypress-payment-manager"); ?></option>
						</select>
					</div>
					<div class="col-md-12">
						<div><label><?php _e('After expiry (Select an action after expired)', 'directorypress-payment-manager'); ?></label></div>
						<select name="change_package_id" id="change_package_id" <?php disabled($item->package_no_expiry); ?> >
							<option value="0" <?php if ($item->change_package_id == 0) echo 'selected'; ?> >- <?php _e("Just suspend", "directorypress-payment-manager"); ?> -</option>
							<?php foreach ($directorypress_object->packages->packages_array AS $new_item): ?>
								<?php if ($item->id != $new_item->id): ?>
									<option value="<?php echo $new_item->id; ?>" <?php if ($item->change_package_id == $new_item->id) echo 'selected'; ?> ><?php echo $new_item->name; ?></option>
								<?php endif; ?>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-12">
						<div><label><?php _e('Number of listings in package', 'directorypress-payment-manager'); ?></label></div>
						<input id="number_of_listings_in_package" name="number_of_listings_in_package" type="text" size="1" value="<?php echo $item->number_of_listings_in_package; ?>" />
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="features-<?php echo $itab_id ?>">
				<div class="row clearfix">
					<div class="col-md-12"><label><?php _e('Package Features', 'directorypress-payment-manager'); ?></label></div>
					<div class="col-md-12"><p><?php _e("Allow Extra features for this package", 'directorypress-payment-manager'); ?></p></div>
					<div class="col-md-12">
						<div><label><?php _e('Enable BumpUp/RaiseUp ', 'directorypress-payment-manager'); ?></label></div>
						<label class="switch">
							<input name="can_be_bumpup" type="checkbox" value="1" id="can_be_bumpup" <?php checked($item->can_be_bumpup); ?> />
							<span class="slider"></span>
						</label>
					</div>
					<div class="col-md-12">
						<div><label><?php _e('Enable Featured Option', 'directorypress-payment-manager'); ?></label></div>
						<label class="switch">
							<input name="has_featured" type="checkbox" value="1" id="has_featured" <?php checked($item->has_featured); ?> />
							<span class="slider"></span>
						</label>
					</div>
					<div class="col-md-12">
						<div><label><?php _e('Enable Sticky Option', 'directorypress-payment-manager'); ?></label></div>
						<label class="switch">
							<input name="has_sticky" type="checkbox" value="1" id="has_sticky" <?php checked($item->has_sticky); ?> />
							<span class="slider"></span>
						</label>
					</div>
					<div class="col-md-12">
						<div><label><?php _e('Make This Package Featured ', 'directorypress-payment-manager'); ?></label></div>
						<label class="switch">
							<input name="featured_package" type="checkbox" value="1" id="featured_package" <?php checked($item->featured_package); ?> />
							<span class="slider"></span>
						</label>
					</div>
				</div>
			</div>
			<div class="tab-pane fade" id="resources-<?php echo $itab_id ?>">
					<div class="row clearfix">
										<div class="col-md-12"><label><?php _e('Resources Available in This Package', 'directorypress-payment-manager'); ?></label></div>
										<div class="col-md-12"><p><?php _e("Allow number of categories,locations and fields", 'directorypress-payment-manager'); ?></p></div>
										<div class="col-md-12">
											<div><label><?php _e('Number of Images ', 'directorypress-payment-manager'); ?></label></div>
											<div>
												<input name="images_allowed" type="text" id="images_allowed" value="<?php echo esc_attr($item->images_allowed); ?>" />
											</div>
										</div>
										<div class="col-md-12">
											<div><label><?php _e('Video Attachment ', 'directorypress-payment-manager'); ?></label></div>
											<div>
												<input name="videos_allowed" type="text" id="videos_allowed" value="<?php echo esc_attr($item->videos_allowed); ?>" />
											</div>
										</div>
										<div class="col-md-12">
											<div><label><?php _e('Number of Address ', 'directorypress-payment-manager'); ?></label></div>
											<div>
												<input name="location_number_allowed" type="text" id="location_number_allowed" value="<?php echo esc_attr($item->location_number_allowed); ?>" />
											</div>
										</div>
										<div class="col-md-12">
											<div><label><?php _e('Number Of Categories', 'directorypress-payment-manager'); ?></label></div>
											<div><input name="category_number_allowed" id="category_number_allowed" type="text" size="1" value="<?php echo esc_attr($item->category_number_allowed); ?>" /></div>
										</div>
					</div>
					<?php do_action('directorypress_package_html', $item); ?>
			</div>
			<div class="tab-pane fade" id="dependency-<?php echo $itab_id ?>">
										<div class="row">
											<div class="col-md-12">
												<label><?php _e('Assigned categories', 'directorypress-payment-manager'); ?></label>
												<?php echo directorypress_wpml_supported_settings_description(); ?>
												<div>
													<p class="description"><?php _e('Assign specific Categories to this package (optional)', 'directorypress-payment-manager'); ?></p>
													<?php directorypress_termsSelectList('selected_categories', DIRECTORYPRESS_CATEGORIES_TAX, $item->selected_categories); ?>
												</div>
											</div>
											<div class="col-md-12">
												<div>
													<label><?php _e('Assigned locations', 'directorypress-payment-manager'); ?></label>
													<?php echo directorypress_wpml_supported_settings_description(); ?>
												</div>
												<div>
													<p class="description"><?php _e('Assign specific Locations to this package (optional)', 'directorypress-payment-manager'); ?></p>
													<?php directorypress_termsSelectList('selected_locations', DIRECTORYPRESS_LOCATIONS_TAX, $item->selected_locations); ?>
												</div>
											</div>
											<div class="col-md-12">
												<div>
													<label><?php _e('Assigned content fields', 'directorypress-payment-manager'); ?></label>
												</div>
												<div>
													<p class="description"><?php _e('Assign specific Fields to this package (optional)', 'directorypress-payment-manager'); ?></p>
													<select multiple="multiple" name="fields[]" class="selected_terms_list row form-group directorypress-select2" style="height: 300px">
													<option value="" <?php echo (!$item->fields) ? 'selected' : ''; ?>><?php _e('- Select All -', 'directorypress-payment-manager'); ?></option>
													<option value="0" <?php echo ($item->fields == array(0)) ? 'selected' : ''; ?>><?php _e('- No fields -', 'directorypress-payment-manager'); ?></option>
													<?php foreach ($fields AS $field): ?>
													<?php if (!$field->is_core_field): ?>
													<option value="<?php echo $field->id; ?>" <?php echo (in_array($field->id, $item->fields)) ? 'selected' : ''; ?>><?php echo $field->name; ?></option>

													<?php endif; ?>
													<?php endforeach; ?>
													</select>
												</div>
											</div>
										</div>
			</div>
			<div class="id">
				<input type="hidden" name="id" value="">
			</div>
		</form>
	</div>
</div>