<?php

/*
	VIDEO WIDGET
*/

class Directorypress_Widget_Author extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'classname' => 'directorypress_widget_author', 'description' => 'DirectoryPress Author Widget' );
		WP_Widget::__construct( 'directorypress_author', 'directorypress-author', $widget_ops );


	}



	function widget( $args, $instance ) {
		global $DIRECTORYPRESS_ADIMN_SETTINGS, $directorypress_object;
		extract( $args );
		
		
		$title = isset( $instance['style'] ) ? $instance['title'] : '';
		$style = isset( $instance['style'] ) ? $instance['style'] : '1';
		
		
		$output = '';
		global $post;
		
		echo wp_kses_post($before_widget);
		if ( $title ){
			echo wp_kses_post($before_title . $title . $after_title);
		}
		if(class_exists('DirectoryPress')){
			if($style == 1){
				directorypress_display_template('partials/widgets/author/style-1.php', array('instance' => $instance));
				
			}elseif($style == 2){
				directorypress_display_template('partials/widgets/author/style-2.php', array('instance' => $instance));
				
			}elseif($style == 3){
				
				directorypress_display_template('partials/widgets/author/style-3.php', array('instance' => $instance));
				
			}
		}
		echo wp_kses_post($after_widget);
		//if(has_shortcode($post->post_content, 'directorypress-listing')){
			//echo $output;
		//}
	}


	function update( $new_instance, $old_instance ) {
		//$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['style'] = $new_instance['style'];
		$instance['show_phone_number'] = $new_instance['show_phone_number'];
		$instance['show_whatsapp_number'] = $new_instance['show_whatsapp_number'];
		$instance['show_email'] = $new_instance['show_email'];
		$instance['show_social_links'] = $new_instance['show_social_links'];
		$instance['show_contact'] = $new_instance['show_contact'];
		$instance['show_offer_button'] = $new_instance['show_offer_button'];
		$instance['hide_from_anonymous'] = $new_instance['hide_from_anonymous'];
		
		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$style = isset( $instance['style'] ) ? $instance['style'] : '';
		$show_phone_number = isset( $instance['show_phone_number'] ) ? $instance['show_phone_number'] : 1;
		$show_whatsapp_number = isset( $instance['show_whatsapp_number'] ) ? $instance['show_whatsapp_number'] : 1;
		$show_email = isset( $instance['show_email'] ) ? $instance['show_email'] : '1';
		$show_social_links = isset( $instance['show_social_links'] ) ? $instance['show_social_links'] : 1;
		$show_contact = isset( $instance['show_contact'] ) ? $instance['show_contact'] : '1';
		$show_offer_button = isset( $instance['show_offer_button'] ) ? $instance['show_offer_button'] : 1;
		$hide_from_anonymous = isset( $instance['hide_from_anonymous'] ) ? $instance['hide_from_anonymous'] : 0;
?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php echo esc_html__('Title', 'DIRECTORYPRESS'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'style' )); ?>"><?php esc_html_e('Style:', 'DIRECTORYPRESS'); ?></label>
    		<select name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>" class="widefat">
    			<option value="1"<?php selected( $style, '1');?>><?php echo esc_html__('One', 'DIRECTORYPRESS'); ?></option>
    			<option value="2"<?php selected( $style, '2');?>><?php echo esc_html__('Two', 'DIRECTORYPRESS'); ?></option>
				<option value="3"<?php selected( $style, '3');?>><?php echo esc_html__('Three', 'DIRECTORYPRESS'); ?></option>
    		</select>
  		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'show_phone_number' )); ?>"><?php esc_html_e('Show Phone Number:', 'DIRECTORYPRESS'); ?></label>
    		<select name="<?php echo esc_attr($this->get_field_name( 'show_phone_number' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'show_phone_number' )); ?>" class="widefat">
    			<option value="1"<?php selected( $show_phone_number, '1');?>><?php echo esc_html__('Yes', 'DIRECTORYPRESS'); ?></option>
    			<option value="0"<?php selected( $show_phone_number, '0');?>><?php echo esc_html__('No', 'DIRECTORYPRESS'); ?></option>
    		</select>
  		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'show_whatsapp_number' )); ?>"><?php esc_html_e('Show Whatsapp Number:', 'DIRECTORYPRESS'); ?></label>
    		<select name="<?php echo esc_attr($this->get_field_name( 'show_whatsapp_number' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'show_whatsapp_number' )); ?>" class="widefat">
    			<option value="1"<?php selected( $show_whatsapp_number, '1');?>><?php echo esc_html__('Yes', 'DIRECTORYPRESS'); ?></option>
    			<option value="0"<?php selected( $show_whatsapp_number, '0');?>><?php echo esc_html__('No', 'DIRECTORYPRESS'); ?></option>
    		</select>
  		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'show_email' )); ?>"><?php esc_html_e('Show Email Id:', 'DIRECTORYPRESS'); ?></label>
    		<select name="<?php echo esc_attr($this->get_field_name( 'show_email' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'show_email' )); ?>" class="widefat">
    			<option value="1"<?php selected( $show_email, '1');?>><?php echo esc_html__('Yes', 'DIRECTORYPRESS'); ?></option>
    			<option value="0"<?php selected( $show_email, '0');?>><?php echo esc_html__('No', 'DIRECTORYPRESS'); ?></option>
    		</select>
  		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'show_social_links' )); ?>"><?php esc_html_e('Show Social Links:', 'DIRECTORYPRESS'); ?></label>
    		<select name="<?php echo esc_attr($this->get_field_name( 'show_social_links' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'show_social_links' )); ?>" class="widefat">
    			<option value="1"<?php selected( $show_social_links, '1');?>><?php echo esc_html__('Yes', 'DIRECTORYPRESS'); ?></option>
    			<option value="0"<?php selected( $show_social_links, '0');?>><?php echo esc_html__('No', 'DIRECTORYPRESS'); ?></option>
    		</select>
  		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'show_contact' )); ?>"><?php esc_html_e('Show Contact:', 'DIRECTORYPRESS'); ?></label>
    		<select name="<?php echo esc_attr($this->get_field_name( 'show_contact' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'show_contact' )); ?>" class="widefat">
    			<option value="1"<?php selected( $show_contact, '1');?>><?php echo esc_html__('Yes', 'DIRECTORYPRESS'); ?></option>
    			<option value="0"<?php selected( $show_contact, '0');?>><?php echo esc_html__('No', 'DIRECTORYPRESS'); ?></option>
    		</select>
  		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'show_offer_button' )); ?>"><?php esc_html_e('Show Offer Button:', 'DIRECTORYPRESS'); ?></label>
    		<select name="<?php echo esc_attr($this->get_field_name( 'show_offer_button' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'show_offer_button' )); ?>" class="widefat">
    			<option value="1"<?php selected( $show_offer_button, '1');?>><?php echo esc_html__('Yes', 'DIRECTORYPRESS'); ?></option>
    			<option value="0"<?php selected( $show_offer_button, '0');?>><?php echo esc_html__('No', 'DIRECTORYPRESS'); ?></option>
    		</select>
  		</p>
		<p>
    		<label for="<?php echo esc_attr($this->get_field_id( 'hide_from_anonymous' )); ?>"><?php esc_html_e('Hide Contact Info from anonymous user:', 'DIRECTORYPRESS'); ?></label>
    		<select name="<?php echo esc_attr($this->get_field_name( 'hide_from_anonymous' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'hide_from_anonymous' )); ?>" class="widefat">
    			<option value="1"<?php selected( $hide_from_anonymous, '1');?>><?php echo esc_html__('Yes', 'DIRECTORYPRESS'); ?></option>
    			<option value="0"<?php selected( $hide_from_anonymous, '0');?>><?php echo esc_html__('No', 'DIRECTORYPRESS'); ?></option>
    		</select>
  		</p>
		
		
<?php

	}
}

/***************************************************/
