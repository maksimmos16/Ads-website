<?php  
require_once PACZ_THEME_PLUGINS_CONFIG . "/image-cropping.php"; 
?>
<script>
	(function($) {
		"use strict";

		window.directorypress_image_attachment_tpl_clogo = function(attachment_id, uploaded_file, title) {
			
			var image_attachment_tpl_clogo = '<div class="directorypress-attached-item-clogo">' +
				'<input type="hidden" name="attached_image_id[]" value="'+attachment_id+'" />' +
				'<a href="'+uploaded_file+'" data-lightbox="listing_images" class="directorypress-attached-item-img">' +
				'<img src="'+uploaded_file+'" alt="" />' +
				'</a>' +
				'<div class="thumb-links clearfix">' +
					'<div class="directorypress-attached-item-delete fa fa-trash-o" title="<?php esc_attr_e("remove", "DIRECTORYPRESS"); ?>"></div>' +
				'</div>' +
				'</div>';

			return image_attachment_tpl_clogo;
		};
		window.directorypress_check_images_attachments_number_clogo = function() {
			if ($("#directorypress-images-upload-wrapper.clogo .directorypress-attached-item-clogo").length == 0) {
				
				<?php if (is_admin()): ?>
				$("#directorypress-admin-upload-functions_clogo").show();
				<?php else: ?>
				$(".directorypress-upload-item-clogo").show();
				<?php endif; ?>
			} else {
				<?php if (is_admin()): ?>
				$("#directorypress-admin-upload-functions_clogo").hide();
				<?php else: ?>
				$(".directorypress-upload-item-clogo").hide();
				<?php endif; ?>
			}
		}
		$(function() {
			directorypress_check_images_attachments_number_clogo();

			$("#directorypress-attached-images-wrapper.clogo").on("click", ".directorypress-attached-item-delete", function() {
				$(this).parents(".directorypress-attached-item-clogo").remove();
	
				directorypress_check_images_attachments_number_clogo();
			});
			<?php if (!is_admin()): ?>
			$(document).on("click", ".directorypress-upload-item-button-clogo", function(e){
				e.preventDefault();
			
				$(this).parent().find("input").click();
			});
			$('.directorypress-upload-item-clogo').fileupload({
				sequentialUploads: true,
				dataType: 'json',
				url: '<?php echo admin_url('admin-ajax.php?action=directorypress_upload_image&post_id='.$listing->post->ID.'&_wpnonce='.wp_create_nonce('upload_images')); ?>',
				dropZone: $('.directorypress-drop-attached-item.clogo'),
				add: function (e, data) {
					var jqXHR = data.submit();
				},
				send: function (e, data) {
					directorypress_add_iloader_on_element($(this).find(".directorypress-drop-attached-item.clogo"));
				},
				done: function(e, data) {
					var result = data.result;
					if (result.uploaded_file) {
						$(this).before(directorypress_image_attachment_tpl_clogo(result.attachment_id, result.uploaded_file, data.files[0].name));
						directorypress_custom_input_controls();
					} else {
						$(this).find(".directorypress-drop-attached-item.clogo").append("<p>"+result.error_msg+"</p>");
					}
					$(this).find(".directorypress-drop-zone.clogo").show();
					directorypress_delete_iloader_from_element($(this).find(".directorypress-drop-attached-item.clogo"));

					directorypress_check_images_attachments_number_clogo();
					
					if ($('.directorypress-attached-item-clogo').length != 0) {
						$('.directorypress-upload-item-clogo').removeClass('full');
					}else{
						$('.directorypress-upload-item-clogo').addClass('full');
					}
				}
			});
			<?php endif; ?>
		});
		
		$(function() {
			if ($('.directorypress-attached-item-clogo').length != 0) {
				$('.directorypress-upload-item-clogo').removeClass('full');
			}else{
				$('.directorypress-upload-item-clogo').addClass('full');
			}
		});
	})(jQuery);
</script>

<div id="directorypress-images-upload-wrapper col-md-12" class="clogo directorypress-content-wrap">
	<p class="directorypress-submit-section-label directorypress-submit-field-title"><?php _e('Company Logo', 'DIRECTORYPRESS'); ?></p>
	<div id="directorypress-attached-images-wrapper" class="clogo clearfix">
		
		<?php //$src = wp_get_attachment_image_src($attachment_id, array(250, 250)); ?>
		<?php
		$attachment_id = get_post_meta($listing->post->ID, '_attached_image_clogo', true);
		$src_full = wp_get_attachment_image_src($attachment_id, 'full');
				require_once PACZ_THEME_PLUGINS_CONFIG . "/image-cropping.php"; 
				$image_src_array = wp_get_attachment_image_src($attachment_id, 'full');
				$image_src  = bfi_thumb($image_src_array[0], array(
					'width' => 132,
					'height' => 102,
					'crop' => true
				));
		?>
			<div class="directorypress-attached-item-clogo">
				
				<input type="hidden" name="attached_image_id[]" value="<?php echo $attachment_id; ?>" />
				<a href="<?php echo $src_full[0]; ?>" data-lightbox="listing_images" class="directorypress-attached-item-img"><img src="<?php echo directorypress_thumbnail_image_gen($image_src, 100, 70); ?>" width="250" height="250" alt="cover image" /></a>
				<div class="thumb-links clearfix">
				<div class="directorypress-attached-item-delete fa fa-trash-o" title="<?php _e("delete", "DIRECTORYPRESS"); ?>"></div>
			</div>
		</div>
		<?php if (!is_admin()): ?>
		<div class="directorypress-upload-item-clogo full">
			<div class="directorypress-drop-attached-item clogo">
				<div class="directorypress-drop-zone clogo">
					<div class="dropzone-content">
						<span class="drophere"><?php _e("Drop here", "DIRECTORYPRESS"); ?></span>
						<button class="directorypress-upload-item-button-clogo btn btn-primary"><?php _e("Browse", "DIRECTORYPRESS"); ?></button>
						<input type="file" name="browse_file_clogo" />
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<?php if (is_admin() && current_user_can('upload_files')): ?>
	<script>
		(function($) {
			"use strict";
		
			$(function() {
				$('#directorypress-admin-upload-image_clogo').click(function(event) {
					event.preventDefault();
			
					var frame = wp.media({
						title : 'covor images',
						multiple : false,
						library : { type : 'image'},
						button : { text : '<?php echo esc_js(__('Insert', 'DIRECTORYPRESS')); ?>'},
					});
					frame.on('select', function() {
						var selection = frame.state().get('selection');
						selection.each(function(attachment) {
							attachment = attachment.toJSON();
							if (attachment.type == 'image') {
								if ($("#directorypress-attached-images-wrapper.clogo .directorypress-attached-item-clogo").length == 0) {
									directorypress_ajax_loader_show();

									$.ajax({
										type: "POST",
										url: directorypress_js_instance.ajaxurl,
										dataType: 'json',
										data: {
											'action': 'directorypress_upload_media_image',
											'attachment_id': attachment.id,
											'post_id': <?php echo $listing->post->ID; ?>,
											'_wpnonce': '<?php echo wp_create_nonce('upload_images'); ?>',
										},
										attachment_id: attachment.id,
										attachment_url: attachment.sizes.full.url,
										attachment_title: attachment.title,
										success: function (response_from_the_action_function){
										$("#directorypress-attached-images-wrapper.clogo").append(directorypress_image_attachment_tpl_clogo(this.attachment_id, this.attachment_url, this.attachment_title));
										directorypress_check_images_attachments_number_clogo();
										
										directorypress_ajax_loader_hide();
										}
									});
								}
							}
						});
					});
					frame.open();
				});
			});
		})(jQuery);
	</script>
	<div id="directorypress-admin-upload-functions_clogo">
		<div class="directorypress-upload-option">
			<input
				type="button"
				id="directorypress-admin-upload-image_clogo"
				class="btn btn-primary"
				value="<?php esc_attr_e('Upload image', 'DIRECTORYPRESS'); ?>" />
		</div>
	</div>
	<?php endif; ?>
</div>

<script>
	(function($) {
		"use strict";

		window.directorypress_image_attachment_tpl_cover = function(attachment_id, uploaded_file, title) {
			
			var image_attachment_tpl_cover = '<div class="directorypress-attached-item-cover">' +
				'<input type="hidden" name="attached_image_id[]" value="'+attachment_id+'" />' +
				'<a href="'+uploaded_file+'" data-lightbox="listing_images" class="directorypress-attached-item-img">' +
				'<img src="'+uploaded_file+'" alt="" />' +
				'</a>' +
				'<div class="thumb-links clearfix">' +
					'<div class="directorypress-attached-item-delete fa fa-trash-o" title="<?php esc_attr_e("remove", "DIRECTORYPRESS"); ?>"></div>' +
				'</div>' +
				'</div>';

			return image_attachment_tpl_cover;
		};
		window.directorypress_check_images_attachments_number_cover = function() {
			if ($("#directorypress-images-upload-wrapper.cover .directorypress-attached-item-cover").length == 0) {
				
				<?php if (is_admin()): ?>
				$("#directorypress-admin-upload-functions_cover").show();
				<?php else: ?>
				$(".directorypress-upload-item-cover").show();
				<?php endif; ?>
			} else {
				<?php if (is_admin()): ?>
				$("#directorypress-admin-upload-functions_cover").hide();
				<?php else: ?>
				$(".directorypress-upload-item-cover").hide();
				<?php endif; ?>
			}
		}
		$(function() {
			directorypress_check_images_attachments_number_cover();

			$("#directorypress-attached-images-wrapper.cover").on("click", ".directorypress-attached-item-delete", function() {
				$(this).parents(".directorypress-attached-item-cover").remove();
	
				directorypress_check_images_attachments_number_cover();
			});
			<?php if (!is_admin()): ?>
			$(document).on("click", ".directorypress-upload-item-button-cover", function(e){
				e.preventDefault();
			
				$(this).parent().find("input").click();
			});
			$('.directorypress-upload-item-cover').fileupload({
				sequentialUploads: true,
				dataType: 'json',
				url: '<?php echo admin_url('admin-ajax.php?action=directorypress_upload_image&post_id='.$listing->post->ID.'&_wpnonce='.wp_create_nonce('upload_images')); ?>',
				dropZone: $('.directorypress-drop-attached-item.cover'),
				add: function (e, data) {
					var jqXHR = data.submit();
				},
				send: function (e, data) {
					directorypress_add_iloader_on_element($(this).find(".directorypress-drop-attached-item.cover"));
				},
				done: function(e, data) {
					var result = data.result;
					if (result.uploaded_file) {
						$(this).before(directorypress_image_attachment_tpl_cover(result.attachment_id, result.uploaded_file, data.files[0].name));
						directorypress_custom_input_controls();
					} else {
						$(this).find(".directorypress-drop-attached-item.cover").append("<p>"+result.error_msg+"</p>");
					}
					$(this).find(".directorypress-drop-zone.cover").show();
					directorypress_delete_iloader_from_element($(this).find(".directorypress-drop-attached-item.cover"));

					directorypress_check_images_attachments_number_cover();
					
					if ($('.directorypress-attached-item-cover').length != 0) {
						$('.directorypress-upload-item-cover').removeClass('full');
					}else{
						$('.directorypress-upload-item-cover').addClass('full');
					}
				}
			});
			<?php endif; ?>
		});
		
		$(function() {
			if ($('.directorypress-attached-item-cover').length != 0) {
				$('.directorypress-upload-item-cover').removeClass('full');
			}else{
				$('.directorypress-upload-item-cover').addClass('full');
			}
		});
	})(jQuery);
</script>

<div id="directorypress-images-upload-wrapper col-md-12" class="cover directorypress-content-wrap">
	<p class="directorypress-submit-section-label directorypress-submit-field-title"><?php _e('Listing Cover image', 'DIRECTORYPRESS'); ?></p>
	<div id="directorypress-attached-images-wrapper" class="cover clearfix">
		
		<?php //$src = wp_get_attachment_image_src($attachment_id, array(250, 250)); ?>
		<?php
		$attachment_id = get_post_meta($listing->post->ID, '_attached_image_cover', true);
		$src_full = wp_get_attachment_image_src($attachment_id, 'full');
				require_once PACZ_THEME_PLUGINS_CONFIG . "/image-cropping.php"; 
				$image_src_array = wp_get_attachment_image_src($attachment_id, 'full');
				$image_src  = bfi_thumb($image_src_array[0], array(
					'width' => 132,
					'height' => 102,
					'crop' => true
				));
		?>
			<div class="directorypress-attached-item-cover">
				
				<input type="hidden" name="attached_image_id[]" value="<?php echo $attachment_id; ?>" />
				<a href="<?php echo $src_full[0]; ?>" data-lightbox="listing_images" class="directorypress-attached-item-img"><img src="<?php echo directorypress_thumbnail_image_gen($image_src, 100, 70); ?>" width="250" height="250" alt="cover image" /></a>
				<div class="thumb-links clearfix">
				<div class="directorypress-attached-item-delete fa fa-trash-o" title="<?php _e("delete", "DIRECTORYPRESS"); ?>"></div>
			</div>
		</div>
		<?php if (!is_admin()): ?>
		<div class="directorypress-upload-item-cover full">
			<div class="directorypress-drop-attached-item cover">
				<div class="directorypress-drop-zone cover">
					<div class="dropzone-content">
						<span class="drophere"><?php _e("Drop here", "DIRECTORYPRESS"); ?></span>
						<button class="directorypress-upload-item-button-cover btn btn-primary"><?php _e("Browse", "DIRECTORYPRESS"); ?></button>
						<input type="file" name="browse_file_cover" />
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<?php if (is_admin() && current_user_can('upload_files')): ?>
	<script>
		(function($) {
			"use strict";
		
			$(function() {
				$('#directorypress-admin-upload-image_cover').click(function(event) {
					event.preventDefault();
			
					var frame = wp.media({
						title : 'covor images',
						multiple : false,
						library : { type : 'image'},
						button : { text : '<?php echo esc_js(__('Insert', 'DIRECTORYPRESS')); ?>'},
					});
					frame.on('select', function() {
						var selection = frame.state().get('selection');
						selection.each(function(attachment) {
							attachment = attachment.toJSON();
							if (attachment.type == 'image') {
								if ($("#directorypress-attached-images-wrapper.cover .directorypress-attached-item-clogo").length == 0) {
									directorypress_ajax_loader_show();

									$.ajax({
										type: "POST",
										url: directorypress_js_instance.ajaxurl,
										dataType: 'json',
										data: {
											'action': 'directorypress_upload_media_image',
											'attachment_id': attachment.id,
											'post_id': <?php echo $listing->post->ID; ?>,
											'_wpnonce': '<?php echo wp_create_nonce('upload_images'); ?>',
										},
										attachment_id: attachment.id,
										attachment_url: attachment.sizes.full.url,
										attachment_title: attachment.title,
										success: function (response_from_the_action_function){
										$("#directorypress-attached-images-wrapper.cover").append(directorypress_image_attachment_tpl_cover(this.attachment_id, this.attachment_url, this.attachment_title));
										directorypress_check_images_attachments_number_cover();
										
										directorypress_ajax_loader_hide();
										}
									});
								}
							}
						});
					});
					frame.open();
				});
			});
		})(jQuery);
	</script>
	<div id="directorypress-admin-upload-functions_cover">
		<div class="directorypress-upload-option">
			<input
				type="button"
				id="directorypress-admin-upload-image_cover"
				class="btn btn-primary"
				value="<?php esc_attr_e('Upload image', 'DIRECTORYPRESS'); ?>" />
		</div>
	</div>
	<?php endif; ?>
</div>

<?php if ($listing->package->images_allowed): ?>
<script>
	var images_allowed = <?php echo $listing->package->images_allowed; ?>;

	(function($) {
		"use strict";

		window.directorypress_image_attachment_tpl = function(attachment_id, uploaded_file, title) {
			
			var image_attachment_tpl = '<div class="directorypress-attached-item">' +
				'<input type="hidden" name="attached_image_id[]" value="'+attachment_id+'" />' +
				'<a href="'+uploaded_file+'" data-lightbox="listing_images" class="directorypress-attached-item-img">' +
				'<img src="'+uploaded_file+'" alt="" />' +
				'</a>' +
				'<div class="thumb-links clearfix">' +
					'<div class="directorypress-attached-item-logo directorypress-radio checkbox">' +
						'<label>' +
							'<input type="radio" name="attached_image_as_logo" value="`+attachment_id+`">' +
							'<span class="radio-check-item"></span>' +
						'</label>' +
					'</div>' +
					'<div class="directorypress-attached-item-delete fa fa-trash-o" title="<?php esc_attr_e("remove", "DIRECTORYPRESS"); ?>"></div>' +
				'</div>' +
				'</div>';

			return image_attachment_tpl;
		};

		window.directorypress_check_images_attachments_number = function() {
			if (images_allowed > $("#directorypress-images-upload-wrapper.gallery .directorypress-attached-item").length) {
				<?php if (is_admin()): ?>
				$("#directorypress-admin-upload-functions").show();
				<?php else: ?>
				$(".directorypress-upload-item").show();
				<?php endif; ?>
			} else {
				<?php if (is_admin()): ?>
				$("#directorypress-admin-upload-functions").hide();
				<?php else: ?>
				$(".directorypress-upload-item").hide();
				<?php endif; ?>
			}
		}

		$(function() {
			directorypress_check_images_attachments_number();

			$("#directorypress-attached-images-wrapper.gallery").on("click", ".directorypress-attached-item-delete", function() {
				$(this).parents(".directorypress-attached-item").remove();
	
				directorypress_check_images_attachments_number();
			});

			<?php if (!is_admin()): ?>
			$(document).on("click", ".directorypress-upload-item-button", function(e){
				e.preventDefault();
			
				$(this).parent().find("input").click();
			});

			$('.directorypress-upload-item').fileupload({
				sequentialUploads: true,
				dataType: 'json',
				url: '<?php echo admin_url('admin-ajax.php?action=directorypress_upload_image&post_id='.$listing->post->ID.'&_wpnonce='.wp_create_nonce('upload_images')); ?>',
				dropZone: $('.directorypress-drop-attached-item'),
				add: function (e, data) {
					var jqXHR = data.submit();
				},
				send: function (e, data) {
					directorypress_add_iloader_on_element($(this).find(".directorypress-drop-attached-item"));
				},
				done: function(e, data) {
					var result = data.result;
					if (result.uploaded_file) {
						$(this).before(directorypress_image_attachment_tpl(result.attachment_id, result.uploaded_file, data.files[0].name));
						directorypress_custom_input_controls();
					} else {
						$(this).find(".directorypress-drop-attached-item").append("<p>"+result.error_msg+"</p>");
					}
					$(this).find(".directorypress-drop-zone").show();
					directorypress_delete_iloader_from_element($(this).find(".directorypress-drop-attached-item"));

					directorypress_check_images_attachments_number();
					
					if ($('.directorypress-attached-item').length != 0) {
						$('.directorypress-upload-item').removeClass('full');
					}else{
						$('.directorypress-upload-item').addClass('full');
					}
				}
			});
			<?php endif; ?>
		});
		$(function() {
			if ($('.directorypress-attached-item').length != 0) {
				$('.directorypress-upload-item').removeClass('full');
			}else{
				$('.directorypress-upload-item').addClass('full');
			}
		});
	})(jQuery);
</script>

<div id="directorypress-images-upload-wrapper col-md-12" class="directorypress-content-wrap">
	<p class="directorypress-submit-section-label directorypress-submit-field-title"><?php _e('Listing images', 'DIRECTORYPRESS'); ?></p>
	<div id="directorypress-attached-images-wrapper" class="gallery clearfix">
		<?php foreach ($listing->images AS $attachment_id=>$attachment): ?>
		<?php $src = wp_get_attachment_image_src($attachment_id, array(250, 250)); ?>
		<?php $src_full = wp_get_attachment_image_src($attachment_id, 'full');
				require_once PACZ_THEME_PLUGINS_CONFIG . "/image-cropping.php"; 
				$image_src_array = wp_get_attachment_image_src($attachment_id, 'full');
				$image_src  = bfi_thumb($image_src_array[0], array(
					'width' => 132,
					'height' => 102,
					'crop' => true
				));
		?>
		<div class="directorypress-attached-item">
			
			<input type="hidden" name="attached_image_id[]" value="<?php echo $attachment_id; ?>" />
			<a href="<?php echo $src_full[0]; ?>" data-lightbox="listing_images" class="directorypress-attached-item-img"><img src="<?php echo directorypress_thumbnail_image_gen($image_src, 100, 70); ?>" width="250" height="250" alt="<?php echo esc_attr_e($attachment['post_title']); ?>" /></a>
			<div class="thumb-links clearfix">
			<div class="directorypress-attached-item-logo directorypress-radio checkbox">
				<label title="<?php _e("Set as Thumbnail Image", "DIRECTORYPRESS"); ?>">
					<input type="radio" name="attached_image_as_logo" value="<?php echo $attachment_id; ?>" <?php checked($listing->logo_image, $attachment_id); ?>>
					<span class="radio-check-item"></span>
				</label>
			</div>
			<div class="directorypress-attached-item-delete fa fa-trash-o" title="<?php _e("delete", "DIRECTORYPRESS"); ?>"></div>
		</div>
		</div>
		<?php endforeach; ?>
		<?php if (!is_admin()): ?>
		<div class="directorypress-upload-item full">
			<div class="directorypress-drop-attached-item">
				<div class="directorypress-drop-zone">
					<div class="dropzone-content">
						<span class="drophere"><?php _e("Drop here", "DIRECTORYPRESS"); ?></span>
						<button class="directorypress-upload-item-button btn btn-primary"><?php _e("Browse", "DIRECTORYPRESS"); ?></button>
						<input type="file" name="browse_file" multiple />
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
	</div>
	<div class="directorypress-clearfix"></div>

	<?php if (is_admin() && current_user_can('upload_files')): ?>
	<script>
		(function($) {
			"use strict";
		
			$(function() {
				$('#directorypress-admin-upload-image').click(function(event) {
					event.preventDefault();
			
					var frame = wp.media({
						title : '<?php echo esc_js(sprintf(__('Upload image (%d maximum)', 'DIRECTORYPRESS'), $listing->package->images_allowed)); ?>',
						multiple : true,
						library : { type : 'image'},
						button : { text : '<?php echo esc_js(__('Insert', 'DIRECTORYPRESS')); ?>'},
					});
					frame.on('select', function() {
						var selection = frame.state().get('selection');
						selection.each(function(attachment) {
							attachment = attachment.toJSON();
							if (attachment.type == 'image') {
								if (images_allowed > $("#directorypress-attached-images-wrapper.gallery .directorypress-attached-item").length) {
									directorypress_ajax_loader_show();

									$.ajax({
										type: "POST",
										url: directorypress_js_instance.ajaxurl,
										dataType: 'json',
										data: {
											'action': 'directorypress_upload_media_image',
											'attachment_id': attachment.id,
											'post_id': <?php echo $listing->post->ID; ?>,
											'_wpnonce': '<?php echo wp_create_nonce('upload_images'); ?>',
										},
										attachment_id: attachment.id,
										attachment_url: attachment.sizes.full.url,
										attachment_title: attachment.title,
										success: function (response_from_the_action_function){
										$("#directorypress-attached-images-wrapper.gallery").append(directorypress_image_attachment_tpl(this.attachment_id, this.attachment_url, this.attachment_title));
										directorypress_check_images_attachments_number();
										
										directorypress_ajax_loader_hide();
										}
									});
								}
							}
						});
					});
					frame.open();
				});
			});
		})(jQuery);
	</script>
	<div id="directorypress-admin-upload-functions">
		<div class="directorypress-upload-option">
			<input
				type="button"
				id="directorypress-admin-upload-image"
				class="btn btn-primary"
				value="<?php esc_attr_e('Upload image', 'DIRECTORYPRESS'); ?>" />
		</div>
	</div>
	<?php endif; ?>
</div>
<?php endif; ?>


<?php if ($listing->package->videos_allowed): ?>
<script>
	var videos_allowed = <?php echo $listing->package->videos_allowed; ?>;

	(function($) {
		"use strict";

		window.directorypress_video_attachment_tpl = function(video_id, image_url) {
			var video_attachment_tpl = `
				<div class="directorypress-attached-item">
				<input type="hidden" name="attached_video_id[]" value="`+video_id+`" />
				<div class="directorypress-attached-item-img" style="background-image: url(`+image_url+`)"></div>
				<div class="directorypress-attached-item-delete directorypress-fa directorypress-fa-trash-o" title="<?php _e("delete", "DIRECTORYPRESS"); ?>"></div>
			</div>`;

			return video_attachment_tpl;
		};

		window.directorypress_check_videos_attachments_number = function() {
			if (videos_allowed > $("#directorypress-attached-videos-wrapper .directorypress-attached-item").length) {
				$(".directorypress-attach-videos-functions").show();
			} else {
				$(".directorypress-attach-videos-functions").hide();
			}
		}

		$(function() {
			directorypress_check_videos_attachments_number();

			$("#directorypress-attached-videos-wrapper").on("click", ".directorypress-attached-item-delete", function() {
				$(this).parents(".directorypress-attached-item").remove();
	
				directorypress_check_videos_attachments_number();
			});
		});
	})(jQuery);
</script>

<div id="directorypress-video-attach-wrapper" class="directorypress-content-wrap">
	<p class="directorypress-submit-section-label directorypress-submit-field-title"><?php _e("Listing videos", "DIRECTORYPRESS"); ?></p>
	
	<div id="directorypress-attached-videos-wrapper">
		<?php foreach ($listing->videos AS $video): ?>
		<div class="directorypress-attached-item">
			<input type="hidden" name="attached_video_id[]" value="<?php echo $video['id']; ?>" />
			<?php
			if (strlen($video['id']) == 11) {
				$image_url = "http://i.ytimg.com/vi/" . $video['id'] . "/0.jpg";
			} elseif (strlen($video['id']) == 8 || strlen($video['id']) == 9) {
				$data = file_get_contents("http://vimeo.com/api/v2/video/" . $video['id'] . ".json");
				$data = json_decode($data);
				$image_url = $data[0]->thumbnail_medium;
			} ?>
			<div class="directorypress-attached-item-img" style="background-image: url('<?php echo $image_url; ?>')"></div>
			<div class="directorypress-attached-item-delete fa fa-trash-o" title="<?php _e("delete", "DIRECTORYPRESS"); ?>"></div>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="directorypress-clearfix"></div>

	<script>
		(function($) {
			"use strict";
		
			window.attachVideo = function() {
				if ($("#directorypress-attach-video-input").val()) {
					var regExp_youtube = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
					var regExp_vimeo = /https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/;
					var matches_youtube = $("#directorypress-attach-video-input").val().match(regExp_youtube);
					var matches_vimeo = $("#directorypress-attach-video-input").val().match(regExp_vimeo);
					if (matches_youtube && matches_youtube[2].length == 11) {
						var video_id = matches_youtube[2];
						var image_url = 'http://i.ytimg.com/vi/'+video_id+'/0.jpg';
						$("#directorypress-attached-videos-wrapper").append(directorypress_video_attachment_tpl(video_id, image_url));

						directorypress_check_videos_attachments_number();
					} else if (matches_vimeo && (matches_vimeo[3].length == 8 || matches_vimeo[3].length == 9)) {
						var video_id = matches_vimeo[3];
						var url = "//vimeo.com/api/v2/video/" + video_id + ".json?callback=showVimeoThumb";
					    var script = document.createElement('script');
					    script.src = url;
					    $("#directorypress-attach-videos-functions").before(script);
					} else {
						alert("<?php esc_attr_e('Wrong URL or this video is unavailable', 'DIRECTORYPRESS'); ?>");
					}
				}
			};

			window.showVimeoThumb = function(data){
				var video_id = data[0].id;
			    var image_url = data[0].thumbnail_medium;
			    $("#directorypress-attached-videos-wrapper").append(directorypress_video_attachment_tpl(video_id, image_url));

			    directorypress_check_videos_attachments_number();
			};
		})(jQuery);
	</script>
	<div id="directorypress-attach-videos-functions">
		<div class="directorypress-upload-option">
			<p><?php _e('Enter full YouTube or Vimeo video link', 'DIRECTORYPRESS'); ?></p>
		</div>
		<div class="directorypress-upload-option">
			<input type="text" id="directorypress-attach-video-input" class="form-control" placeholder="https://youtu.be/XXXXXXXXXXXX" />
		</div>
		<div class="directorypress-upload-option">
			<input
				type="button"
				class="btn btn-primary"
				onclick="return attachVideo(); "
				value="<?php esc_attr_e('Attach video', 'DIRECTORYPRESS'); ?>" />
		</div>
	</div>
</div>
<?php endif; ?>