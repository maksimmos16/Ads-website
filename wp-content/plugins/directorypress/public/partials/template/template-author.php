<?php 

/**
 * Template name: Listing Author Template
 * @package    DirectoryPress
 * @subpackage DirectoryPress/public/partials/templates
 * @author     DirectoryPress <team@directorypress.co>
*/


$host = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$author_slug = basename($host);
$author = get_user_by( 'slug', $author_slug );
if($author):
	global $post, $DIRECTORYPRESS_ADIMN_SETTINGS;
	$authorID = $author->ID;
	add_filter( 'pre_get_document_title', 'directorypress_author_page_title');
	get_header();

	if($DIRECTORYPRESS_ADIMN_SETTINGS['frontend_panel_social_links']){
		$author_fb = get_the_author_meta('author_fb', $authorID);
		$author_tw = get_the_author_meta('author_tw', $authorID);
		$author_ytube = get_the_author_meta('author_ytube', $authorID);
		$author_vimeo = get_the_author_meta('author_vimeo', $authorID);
		$author_flickr = get_the_author_meta('author_flickr', $authorID);
		$author_linkedin = get_the_author_meta('author_linkedin', $authorID);
		$author_gplus = get_the_author_meta('author_gplus', $authorID);
		$author_instagram = get_the_author_meta('author_instagram', $authorID);
		$author_behance = get_the_author_meta('author_behance', $authorID);
		$author_dribbble = get_the_author_meta('author_dribbble', $authorID);
	}
	
	$author_name = get_the_author_meta('display_name', $authorID);
	$author_email = get_the_author_meta('email', $authorID);
	$registered = date_i18n( "M d, Y", strtotime( get_the_author_meta( 'user_registered', $authorID ) ) );

	$author_website = get_the_author_meta('user_url', $authorID);
	$phone_number = get_the_author_meta('user_phone', $authorID);
	$author_address = get_the_author_meta('address', $authorID);
	
	$avatar_id = get_user_meta( $authorID, 'avatar_id', true );
	$author_avatar_url = wp_get_attachment_image_src( $avatar_id, 'full' ); 
	$image_src_array = (!empty($avatar_id) && is_numeric($avatar_id))? $author_avatar_url[0]:'';
			
	$author_log_status = '<span class="author-active"></span>';		
	
	get_header();
	echo '<div id="directorypress-auhtor-page">';
		echo '<div class="container">';
			echo '<div class="directorypress-author-content-top">';
				echo '<div class="author-detail-section clearfix">';
					echo '<div class="author-thumbnail">';
						if(!empty($image_src_array)) {
							$params = array( 'width' => 300, 'height' => 370, 'crop' => true );
								echo  '<img src="'. bfi_thumb( $image_src_array, $params ).'" alt="'.$author_name.'" />';
							} else { 
								$avatar_url = get_avatar_url($authorID, ['size' => '300']);
								echo '<img src="'.$avatar_url.'" alt="author" />';
							}
					echo '</div>';
					echo '<div class="author-content-section">';
						echo '<div class="author-title">'.$author_name.$author_log_status.'</div>';
						echo '<p class="author-reg-date">'. esc_html__('Member since', 'DIRECTORYPRESS').' '.$registered.'</p>';
						echo '<div class="author-details">';
							if($DIRECTORYPRESS_ADIMN_SETTINGS['frontend_panel_user_phone']){ 
								echo '<p class=" clearfix"><span class="author-info-title">'.esc_html__('Mobile ', 'DIRECTORYPRESS').'</span><span class="author-info-content">'.$phone_number.'</span></p>'; 
							}
							if($DIRECTORYPRESS_ADIMN_SETTINGS['frontend_panel_user_email']){ 
								echo '<p class=" clearfix"><span class="author-info-title">'.esc_html__('Email ', 'DIRECTORYPRESS').'</span><span class="author-info-content">'.$author_email.'</span></p>'; 
							}
							if($DIRECTORYPRESS_ADIMN_SETTINGS['frontend_panel_user_website']){
								echo '<p class=" clearfix"><span class="author-info-title">'.esc_html__('Website ', 'DIRECTORYPRESS').'</span><span class="author-info-content">'.$author_website.'</span></p>'; 
							}
							if($DIRECTORYPRESS_ADIMN_SETTINGS['frontend_panel_social_links']){
								if(!empty($author_fb) || !empty($author_tw) || !empty($author_linkedin) || !empty($author_ytube) || !empty($author_vimeo) || !empty($author_instagram) || !empty($author_flickr) || !empty($author_behance) || !empty($author_dribbble)){
									echo '<div class="author-details-info clearfix"><span class="author-info-title">'.esc_html__('Follow ', 'DIRECTORYPRESS').'</span>';
										echo '<ul class="author-info-content">';
													
														if(!empty($author_fb)){
															echo '<li><a href="'.$author_fb.'" target_blank><i class="fab fa-facebook-f"></i></a></li>';
														}
														if(!empty($author_tw)){
															echo '<li><a href="'.$author_tw.'" target_blank><i class="fab fa-twitter"></i></a></li>';
														}
														if(!empty($author_linkedin)){
															echo '<li><a href="'.$author_linkedin.'" target_blank><i class="fab fa-linkedin-in"></i></a></li>';
														}
														if(!empty($author_ytube)){
															echo '<li><a href="'.$author_ytube.'" target_blank><i class="fab fa-youtube"></i></a></li>';
														}
														if(!empty($author_vimeo)){
															echo '<li><a href="'.$author_vimeo.'" target_blank><i class="fab fa-vimeo-v"></i></a></li>';
														}
														if(!empty($author_instagram)){
															echo '<li><a href="'.$author_instagram.'" target_blank><i class="fab fa-instagram"></i></a></li>';
														}
														if(!empty($author_flickr)){
															echo '<li><a href="'.$author_flickr.'" target_blank><i class="fab fa-flickr"></i></a></li>';
														}
														if(!empty($author_behance)){
															echo '<li><a href="'.$author_behance.'" target_blank><i class="fab fa-behance"></i></a></li>';
														}
														if(!empty($author_dribbble)){
															echo '<li><a href="'.$author_dribbble.'" target_blank><i class="fab fa-dribbble"></i></a></li>';
														}
													
										echo '</ul>';
									echo '</div>';
								}
							}	
						echo '</div>';
					echo '</div>';
				echo '</div>';
				/* Run the blog loop shortcode to output the posts. */
					//$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
					$authorID = $author->ID;
					$listing_number = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['authorpage_ads_limit']))? $DIRECTORYPRESS_ADIMN_SETTINGS['authorpage_ads_limit'] : 4;
					$listing_column = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['authorpage_grid_col']))? $DIRECTORYPRESS_ADIMN_SETTINGS['authorpage_grid_col'] : 2;
					$listing_view_type = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['authorpage_view_type']))? $DIRECTORYPRESS_ADIMN_SETTINGS['authorpage_view_type'] : 'grid';
					$directorypress_listing_post_style = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_listing_post_style']))? $DIRECTORYPRESS_ADIMN_SETTINGS['directorypress_listing_post_style'] : 10; 
					$listing_order = (isset($DIRECTORYPRESS_ADIMN_SETTINGS['author_page_listing_order']) && !empty($DIRECTORYPRESS_ADIMN_SETTINGS['author_page_listing_order']))? $DIRECTORYPRESS_ADIMN_SETTINGS['author_page_listing_order'] : 'DESC';
					echo '<div class="author-listings">';
						echo do_shortcode( '[directorypress-listings listing_post_style="'.$directorypress_listing_post_style.'" author="'.$authorID.'" listing_has_featured_tag_style="'.$directorypress_listing_post_style.'" masonry_layout="1" perpage="'.$listing_number.'" hide_paginator="0" hide_order="1" hide_count="1" show_views_switcher="0" listings_view_type="'.$listing_view_type.'" order="'. $listing_order .'" listings_view_grid_columns="'.$listing_column.'"]' );
					echo '</div>';
			echo '</div>';	
		echo '</div>';	
	echo '</div>';
	get_footer();
else:
	wp_redirect(home_url('/error'));
	exit;
endif;	