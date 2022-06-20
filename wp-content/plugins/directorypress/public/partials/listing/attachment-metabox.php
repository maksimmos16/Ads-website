<?php if ($listing->package->images_allowed): ?>
<script>
	var images_allowed_gallary_images = <?php echo $listing->package->images_allowed; ?>;

	(function($) {
		"use strict";

		window.directorypress_image_attachment_tpl_gallary_images = function(attachment_id, uploaded_file, title) {
			
			var image_attachment_tpl_gallary_images = '<div class="directorypress-attached-item gallary_images">' +
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
					'<div class="directorypress-attached-item-delete gallary_images fas fa-trash-alt" title="<?php esc_attr_e("remove", "DIRECTORYPRESS"); ?>"></div>' +
				'</div>' +
				'</div>';

			return image_attachment_tpl_gallary_images;
		};

		window.directorypress_check_images_attachments_number_gallary_images = function() {
			if (images_allowed_gallary_images > $("#directorypress-images-upload-wrapper.gallery .directorypress-attached-item.gallary_images").length) {
				<?php if (is_admin()): ?>
				$("#directorypress-admin-upload-functions.gallary_images").show();
				<?php else: ?>
				$(".directorypress-upload-item.gallary_images").show();
				<?php endif; ?>
			} else {
				<?php if (is_admin()): ?>
				$("#directorypress-admin-upload-functions.gallary_images").hide();
				<?php else: ?>
				$(".directorypress-upload-item.gallary_images").hide();
				<?php endif; ?>
			}
		}

		$(function() {
			directorypress_check_images_attachments_number_gallary_images();

			$("#directorypress-attached-images-wrapper.gallery").on("click", ".directorypress-attached-item-delete.gallary_images", function() {
				$(this).parents(".directorypress-attached-item.gallary_images").remove();
	
				directorypress_check_images_attachments_number_gallary_images();
			});

			<?php if (!is_admin()): ?>
			$(document).on("click", ".directorypress-upload-item-button.gallary_images", function(e){
				e.preventDefault();
			
				$(this).parent().find("input").click();
			});

			$('.directorypress-upload-item.gallary_images').fileupload({
				sequentialUploads: true,
				dataType: 'json',
				url: '<?php echo admin_url('admin-ajax.php?action=directorypress_upload_image&post_id='.$listing->post->ID.'&_wpnonce='.wp_create_nonce('upload_images')); ?>',
				dropZone: $('.directorypress-drop-attached-item.gallary_images'),
				add: function (e, data) {
					var jqXHR = data.submit();
				},
				send: function (e, data) {
					
					directorypress_add_iloader_on_element($(this).find(".directorypress-drop-attached-item.gallary_images"));
				},
				done: function(e, data) {
					var result = data.result;
					if (result.uploaded_file) {
						$(this).before(directorypress_image_attachment_tpl_gallary_images(result.attachment_id, result.uploaded_file, data.files[0].name));
						//directorypress_custom_input_controls();
					} else {
						$(this).find(".directorypress-drop-attached-item.gallary_images").append("<p>"+result.error_msg+"</p>");
					}
					$(this).find(".directorypress-drop-zone.gallary_images").show();
					directorypress_delete_iloader_from_element($(this).find(".directorypress-drop-attached-item.gallary_images"));
					
					directorypress_check_images_attachments_number_gallary_images();
					
					if ($('.directorypress-attached-item.gallary_images').length != 0) {
						$('#directorypress-images-upload-wrapper.gallary_images').removeClass('full');
					}else{
						$('#directorypress-images-upload-wrapper.gallary_images').addClass('full');
					}
				}
			});
			<?php endif; ?>
		});
		$(function() {
			if ($('.directorypress-attached-item.gallary_images').length != 0) {
				$('#directorypress-images-upload-wrapper.gallary_images').removeClass('full');
			}else{
				//alert('test');
				$('#directorypress-images-upload-wrapper.gallary_images').addClass('full');
			}
		});
	})(jQuery);
</script>
<div class="directorypress-clearfix"></div>
<div id="directorypress-images-upload-wrapper" class="gallary_images">
	<p class="directorypress-submit-field-title"><?php _e('Listing images', 'DIRECTORYPRESS'); ?></p>
	<div id="directorypress-attached-images-wrapper" class="gallery clearfix">
		<?php if(is_admin()){ ?>
			<div class="items">
		<?php } ?>
		<?php foreach ($listing->images AS $attachment_id=>$attachment): ?>
		<?php $src = wp_get_attachment_image_src($attachment_id, array(250, 250)); ?>
		<?php $src_full = wp_get_attachment_image_src($attachment_id, 'full');
				$image_src_array = wp_get_attachment_image_src($attachment_id, 'full');
				$image_src  = $image_src_array[0]; 
				$param = array(
					'width' => 126,
					'height' => 100,
					'crop' => true
				);
		?>
		
		<div class="directorypress-attached-item gallary_images">
			
			<input type="hidden" name="attached_image_id[]" value="<?php echo $attachment_id; ?>" />
			<a href="<?php echo $src_full[0]; ?>" data-lightbox="listing_images" class="directorypress-attached-item-img"><img src="<?php echo bfi_thumb($image_src, $param); ?>" width="126" height="100" alt="<?php echo esc_attr_e($attachment['post_title']); ?>" /></a>
			<div class="thumb-links clearfix">
				<div class="directorypress-attached-item-logo directorypress-radio checkbox">
					<label title="<?php _e("Set as Thumbnail Image", "DIRECTORYPRESS"); ?>">
						<input type="radio" name="attached_image_as_logo" value="<?php echo $attachment_id; ?>" <?php checked($listing->logo_image, $attachment_id); ?>>
						<span class="radio-check-item"></span>
					</label>
				</div>
				<div class="directorypress-attached-item-delete gallary_images fas fa-trash-alt" title="<?php _e("delete", "DIRECTORYPRESS"); ?>"></div>
			</div>
		</div>
		<?php endforeach; ?>
		<?php if(is_admin()){ ?>
			</div>
		<?php } ?>
		<?php if (!is_admin()): ?>
		<div class="directorypress-upload-item gallary_images">
			<div class="directorypress-drop-attached-item gallary_images">
				<div class="directorypress-drop-zone gallary_images">
					<div class="dropzone-content">
						<span class="drophere"><?php _e("Drop Image Here", "DIRECTORYPRESS"); ?></span>
						<button class="directorypress-upload-item-button gallary_images btn btn-primary"><?php _e("Browse", "DIRECTORYPRESS"); ?></button>
						<input type="file" name="browse_file" multiple />
					</div>
				</div>
			</div>
		</div>
		<?php endif; ?>
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
								if (images_allowed_gallary_images > $("#directorypress-attached-images-wrapper.gallery .directorypress-attached-item.gallary_images").length) {
									$('#directorypress-attached-images-wrapperdirectorypress-upload-option').append(loader);
										//alert(attachment.id);
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
										//alert(response_from_the_action_function);
										$("#directorypress-attached-images-wrapper.gallery .items").append(directorypress_image_attachment_tpl_gallary_images(this.attachment_id, this.attachment_url, this.attachment_title));
										directorypress_check_images_attachments_number_gallary_images();
										
										$('#directorypress-attached-images-wrapper').remove('.dpbackend-loader-wrapper');
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
				class="button button-primary"
				value="<?php esc_attr_e('Browse', 'DIRECTORYPRESS'); ?>" />
		</div>
	</div>
	<?php endif; ?>
	</div>
	<div class="directorypress-clearfix"></div>
</div>
<?php endif; ?>


<?php if ($listing->package->videos_allowed): ?>
<script>
	var videos_allowed = <?php echo $listing->package->videos_allowed; ?>;

	(function($) {
		"use strict";

		window.directorypress_video_attachment_tpl = function(video_id, image_url) {
			var video_attachment_tpl = '<div class="directorypress-attached-item">'+
				'<input type="hidden" name="attached_video_id[]" value="'+video_id+'" />'+
				'<div class="directorypress-attached-item-img"><img src="'+image_url+'" alt="<?php _e("Video Thumbnail", "DIRECTORYPRESS"); ?>" /></div>'+
				'<div class="thumb-links clearfix"><div class="directorypress-attached-item-delete fas fa-trash-alt" title="<?php _e("delete", "DIRECTORYPRESS"); ?>"></div></div>'+
			'</div>';

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

<div id="directorypress-video-attach-wrapper" class="">
	<p class="directorypress-submit-field-title"><?php _e("Listing videos", "DIRECTORYPRESS"); ?></p>
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
			<div class="directorypress-attached-item-img"><img src="<?php echo $image_url; ?>" alt="<?php _e("Video Thumbnail", "DIRECTORYPRESS"); ?>" /></div>
			<div class="thumb-links clearfix">
				<div class="directorypress-attached-item-delete fas fa-trash-alt" title="<?php _e("delete", "DIRECTORYPRESS"); ?>"></div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="directorypress-clearfix"></div>
	<script>
		(function($) {
			"use strict";
			$('body').on('click', '#addvideo', function(e){
				e.preventDefault();
				//alert('test');
				attachVideo();
			});
			window.attachVideo = function() {
				//$("#directorypress-attach-video-input").change(function(){
					if ($("#directorypress-attach-video-input").val()) {
						var regExp_youtube = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
						var regExp_vimeo = /https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/;
						var matches_youtube = $("#directorypress-attach-video-input").val().match(regExp_youtube);
						var matches_vimeo = $("#directorypress-attach-video-input").val().match(regExp_vimeo);
						var taeget = $("#directorypress-attach-video-input");
						if (matches_youtube && matches_youtube[2].length == 11) {
							var video_id = matches_youtube[2];
							var image_url = 'http://i.ytimg.com/vi/'+video_id+'/0.jpg';
							$("#directorypress-attached-videos-wrapper").append(directorypress_video_attachment_tpl(video_id, image_url));
							
							directorypress_check_videos_attachments_number();
							clearTarget(taeget);
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
				//});
			};
			//attachVideo();
			
			window.showVimeoThumb = function(data){
				var video_id = data[0].id;
			    var image_url = data[0].thumbnail_medium;
			    $("#directorypress-attached-videos-wrapper").append(directorypress_video_attachment_tpl(video_id, image_url));

			    directorypress_check_videos_attachments_number();
			};
			window.clearTarget = function(target) {
				 target.val("");
			};
			
		})(jQuery);
	</script>
	<div id="directorypress-attach-videos-functions">
		<div class="directorypress-upload-option">
			<input type="text" id="directorypress-attach-video-input" class="form-control" placeholder="<?php _e('Enter full YouTube or Vimeo video link', 'DIRECTORYPRESS'); ?>"  />
			<a id="addvideo" href="#" class="submit-listing-button"><?php echo esc_html__('Add Video', 'DIRECTORYPRESS'); ?></a>
		</div>
	</div>
</div>
<?php endif; ?>