<?php

/**
 * @since      1.0.0
 * @package    Classiadspro_Core
 * @subpackage Classiadspro_Core/includes
 * @author     Designinvento <team@designinvento.net>
 */
 
// get attachment id from source
function pacz_get_attachment_id_from_src($image_src) {

    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
    $id = $wpdb->get_var($query);
    return $id;

}


// Media upload functionality
function pacz_add_media_upload_scripts() {
    if ( is_admin() ) {
         return;
       }
    wp_enqueue_media();
}
add_action('wp_enqueue_scripts', 'pacz_add_media_upload_scripts');

add_action('admin_init', 'pacz_allow_contributor_uploads');

function pacz_allow_contributor_uploads() {
    $contributor1 = get_role('subscriber');
    $contributor1->add_cap('upload_files');
	
	$contributor2 = get_role('customer');
	if($contributor2 != null){
		$contributor2->add_cap('upload_files');
	}
}

// get user's avatar url
function pacz_get_avatar_url($author_id, $size){
    $get_avatar = get_avatar( $author_id, $size );
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
    return ( $matches[1] );
}


// assign listings to author page instead of blog posts
function pacz_custom_post_author_archive( &$query )
{
	if(class_exists('alsp_plugin')){
    if ( $query->is_author )
        $query->set( 'post_type', 'alsp_listing' );
		remove_action( 'pre_get_posts', 'pacz_custom_post_author_archive' ); // run once!
	}
}
add_action( 'pre_get_posts', 'pacz_custom_post_author_archive' );


//Limit the number of tags displayed by Tag Cloud widget *
add_filter( 'widget_tag_cloud_args', 'pacz_tag_cloud_limit' );
function pacz_tag_cloud_limit($args){ 
	if ( isset($args['taxonomy']) && ($args['taxonomy'] == 'alsp-tag' || $args['taxonomy'] == 'directorypress-tag') ){
		$args['number'] = 8;
 	}
	return $args;
}


// Adds Schema.org tags

if (!function_exists('pacz_html_tag_schema')) {
      function pacz_html_tag_schema()
      {
            $schema = 'http'.((is_ssl()) ? 's' : '').'://schema.org/';
            if (is_single()) {
                  $type = "Article";
            } elseif (is_author()) {
                  $type = 'ProfilePage';
            } elseif (is_search()) {
                  $type = 'SearchResultsPage';
            } else {
                  $type = 'WebPage';
            }
            
            echo 'itemscope="itemscope" itemtype="' . $schema . $type . '"';
      }
}

// purge dynamic css cache
function pacz_purge_cache_actions() {
    global $wpdb;
    
    $wpdb->query($wpdb->prepare("
                 DELETE FROM $wpdb->postmeta
                 WHERE meta_key = %s
                ", '_dynamic_styles'));
    $static = new Pacz_Static_Files(false);
    $static->DeleteThemeOptionStyles();
}

// clear cache on theme save options
add_action ('redux/options/pacz_settings/saved', 'pacz_purge_cache_actions');


// Removes version paramerters from scripts and styles.

if (!function_exists('pacz_remove_wp_ver_css_js')) {
      function pacz_remove_wp_ver_css_js($src)
      {
            global $pacz_settings;
            if ($pacz_settings['remove-js-css-ver']) {
                  if (strpos($src, 'ver='))
                        $src = remove_query_arg('ver', $src);
            }
            return $src;
      }
}
add_filter('style_loader_src', 'pacz_remove_wp_ver_css_js', 9999);
add_filter('script_loader_src', 'pacz_remove_wp_ver_css_js', 9999);

/* user status compatibility for older listing plugin */

//Update user online status
add_action('init', 'pacz_users_status_init');
add_action('admin_init', 'pacz_users_status_init');
function pacz_users_status_init(){
	$logged_in_users = get_transient('users_status'); 
	$user = wp_get_current_user();
	if ( !isset($logged_in_users[$user->ID]['last']) || $logged_in_users[$user->ID]['last'] <= time()-900 ){
		$logged_in_users[$user->ID] = array(
			'id' => $user->ID,
			'username' => $user->user_login,
			'last' => time(),
		);
		set_transient('users_status', $logged_in_users, 900);
	}
}
//Check if a user has been online in the last 15 minutes
function pacz_is_user_online($id){	
	$logged_in_users = get_transient('users_status');
	
	return isset($logged_in_users[$id]['last']) && $logged_in_users[$id]['last'] > time()-900;
}
//Check when a user was last online.
function pacz_user_last_online($id){
	$logged_in_users = get_transient('users_status');
	if ( isset($logged_in_users[$id]['last']) ){
		return $logged_in_users[$id]['last'];
	} else {
		return false;
	}
}



/*==========================
 This snippet shows how to add a column to the Users admin page with each users' last active date.
 ===========================*/
 
 //Add columns to user listings
add_filter('manage_users_columns', 'pacz_user_columns_head');
function pacz_user_columns_head($defaults){
    $defaults['status'] = 'Status';
    return $defaults;
}
add_action('manage_users_custom_column', 'pacz_user_columns_content', 15, 3);
function pacz_user_columns_content($value='', $column_name, $id){
    if ( $column_name == 'status' ){
		if ( pacz_is_user_online($id) ){
			return '<strong style="color: green;">Online Now</strong>';
		} else {
			return ( pacz_user_last_online($id) )? '<small>Last Seen: <br /><em>' . date('M j, Y @ g:ia', pacz_user_last_online($id)) . '</em></small>' : ''; //Return the user's "Last Seen" date, or return empty if that user has never logged in.
		}
	}
}

/*==========================
 Active users
 ===========================*/
add_action('wp_dashboard_setup', 'pacz_activeusers_metabox');
function pacz_activeusers_metabox(){
	global $wp_meta_boxes;
	wp_add_dashboard_widget('pacz_activeusers', 'Active Users', 'pacz_dashboard_activeusers');
}
function pacz_dashboard_activeusers(){
		$user_count = count_users();
		$users_plural = ( $user_count['total_users'] == 1 )? 'User' : 'Users'; //Determine singular/plural tense
		echo '<div><a href="users.php">' . $user_count['total_users'] . ' ' . $users_plural . '</a> <small>(' . pacz_online_users('count') . ' currently active)</small></div>';
}

function pacz_online_users($return='count'){
	$logged_in_users = get_transient('users_status');
	
	
	if ( empty($logged_in_users) ){
		return ( $return == 'count' )? 0 : false; 
	}
	
	$user_online_count = 0;
	$online_users = array();
	foreach ( $logged_in_users as $user ){
		if ( !empty($user['username']) && isset($user['last']) && $user['last'] > time()-900 ){ 
			$online_users[] = $user;
			$user_online_count++;
		}
	}
	return ( $return == 'count' )? $user_online_count : $online_users; //Return either an integer count, or an array of all online user data.

}
add_action('in_widget_form', 'pacz_in_widget_form',5,3);
function pacz_in_widget_form($t,$return,$instance){
    $instance = wp_parse_args( (array) $instance, array('margin' => '') );
    if ( !isset($instance['margin']) )
        $instance['margin'] = null;
    ?>
    <p>
		<label for="<?php echo $t->get_field_id('margin'); ?>"><?php _e('Margin Bottom'); ?></label>
        <input class="widefat" type="text" name="<?php echo $t->get_field_name('margin'); ?>" id="<?php echo $t->get_field_id('margin'); ?>" value="<?php echo $instance['margin'];?>" /> 
    </p>
    <?php
    $retrun = null;
    return array($t,$return,$instance);
}
add_filter('widget_update_callback', 'pacz_in_widget_form_update',5,3);
function pacz_in_widget_form_update($instance, $new_instance, $old_instance){
    if(isset($new_instance['margin'])){
		$instance['margin'] = $new_instance['margin'];
	}
    return $instance;
}
add_filter('dynamic_sidebar_params', 'pacz_dynamic_sidebar_params');
function pacz_dynamic_sidebar_params($params){
    global $wp_registered_widgets;
    $widget_id = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];
    if (isset($widget_opt[$widget_num]['margin'])){
		$margin = ' style="margin-bottom:'.$widget_opt[$widget_num]['margin'].'px"';
        $params[0]['before_widget'] = str_replace('>', $margin.'>',  $params[0]['before_widget']);
    }
    return $params;
}