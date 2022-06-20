<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class DHE_Form_Admin{
	
	public function __construct(){
		add_action( 'init', array( $this, 'init' ) );
		
		add_filter( 'post_updated_messages', array( $this, 'post_updated_messages' ) );
		add_action( 'admin_print_scripts', array( $this, 'disable_autosave' ) );
		
		add_action( 'admin_enqueue_scripts', array($this,'enqueue_scripts') );
		
		add_action('delete_post', array($this,'delete_post'));
		
		// Admin Columns
		add_filter( 'manage_edit-dheform_columns', array( $this, 'edit_columns' ) );
		add_action( 'manage_dheform_posts_custom_column', array( $this, 'custom_columns' ), 2 );
		
		// Views and filtering
		add_filter( 'views_edit-dheform', array( $this, 'custom_order_views' ) );
		add_filter( 'post_row_actions', array( $this, 'remove_row_actions' ), 100, 1 );
		add_filter( 'post_row_actions', array( $this, 'add_row_actions' ), 100, 2 );
		
	}

	public function init(){
		add_action( 'admin_menu', array( $this, 'create_admin_menu' ));
	}
	
	public function enqueue_scripts($hook_suffix){
		$screen         = get_current_screen();
		if('dheform'===$screen->post_type || false!==strpos($hook_suffix, 'dhe-form')){
			wp_enqueue_style('dhe_form_admin',DHE_FORM_URL.'/assets/css/admin.css');
			
			wp_register_script( 'dhe_form_admin', DHE_FORM_URL.'/assets/js/admin.js', array( 'jquery' ,'jquery-blockui'), DHE_FORM_VERSION, true );
			wp_localize_script( 'dhe_form_admin', 'dhe_form_admin', array(
				'ajax_url'=>admin_url( 'admin-ajax.php', 'relative' ),
				'plugin_url'=>DHE_FORM_URL,
				'delete_confirm'=>__('Are your sure?','dhe-form'),
				'recipient_tmpl'=>$this->_recipient_tmpl(),
			) );
			wp_enqueue_script('dhe_form_admin');
		}
	}
	
	protected function _recipient_tmpl(){
		$recipient_tmpl = '';
		$recipient_tmpl .=  '<tr>';
		$recipient_tmpl .=  '<td>';
		$recipient_tmpl .=  '<input type="text" name="" value="" />';
		$recipient_tmpl .=  '</td>';
		$recipient_tmpl .=  '<td>';
		$recipient_tmpl .=  '<a href="#" class="button" onclick="return dhe_form_recipient_remove(this)">'.__('Remove','dhe-form').'</a>';
		$recipient_tmpl .=  '</td>';
		$recipient_tmpl .=  '</tr>';
		return $recipient_tmpl;
	}
	
	public function create_admin_menu(){
		add_menu_page(__('DHE Forms','dhe-form'), __('DHE Forms','dhe-form'), 'edit_dheforms', 'dhe-form',null,DHE_FORM_URL.'/assets/images/menu-icon.svg','59.5');
	}
	
	public function delete_post($post_id){
		global $dheform_db;
		if ( ! current_user_can( 'delete_posts' ) )
			return;
	
	
		if ( $post_id > 0 ) {
			$post_type = get_post_type( $post_id );
			if($post_type === 'dheform')
				$dheform_db->delete_entry_by_form($post_id);
		}
	}
	
	public function disable_autosave(){
		global $post;
	
		if ( $post && get_post_type( $post->ID ) === 'dheform' ) {
			wp_dequeue_script( 'autosave' );
		}
	}
	
	public function post_updated_messages( $messages ) {
		global $post;
		$messages['dheform'] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => __( 'Form updated.', 'dhe-form' ),
			2 => __( 'Custom field updated.', 'dhe-form' ),
			3 => __( 'Custom field deleted.', 'dhe-form' ),
			4 => __( 'Form updated.', 'dhe-form' ),
			5 => isset($_GET['revision']) ? sprintf( __( 'Form restored to revision from %s', 'dhe-form' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => __( 'Form updated.', 'dhe-form' ),
			7 => __( 'Form saved.', 'dhe-form' ),
			8 => __( 'Form submitted.', 'dhe-form' ),
			9 => sprintf( __( 'Form scheduled for: <strong>%1$s</strong>.', 'dhe-form' ),date_i18n( __( 'M j, Y @ G:i', 'dhe-form' ), strtotime( $post->post_date ) ) ),
			10 => __( 'Form draft updated.', 'dhe-form' )
		);
		return $messages;
	}
	
	public function edit_columns( $existing_columns ) {
		$columns = array();
	
		$columns['cb']             = isset($existing_columns['cb']) ? $existing_columns['cb'] : '';
		$columns['form_id']        = __( 'ID', 'dhe-form' );
		$columns['title']          = __( 'Title', 'dhe-form' );
		$columns['shortcode']      = __( 'Shortcode', 'dhe-form' );
	
		unset($existing_columns['title']);
		unset($existing_columns['cb']);
	
		return array_merge($columns,$existing_columns);
	}
	
	public function custom_columns( $column ) {
		global $post;
		switch ( $column ) {
			case 'shortcode':
				echo '<input class="wp-ui-text-highlight code" type="text" onfocus="this.select();" readonly="readonly" value="'.esc_attr('[dhe_form form_id="'.$post->ID.'"]').'" style="width:99%">';
				break;
			case 'form_id':
				echo get_the_ID();
				break;
		}
	}
	
	public function custom_order_views($views){
		unset( $views['publish'] );
	
		if ( isset( $views['trash'] ) ) {
			$trash = $views['trash'];
			unset( $views['draft'] );
			unset( $views['trash'] );
			$views['trash'] = $trash;
		}
	
		return $views;
	}
	
	public function add_row_actions($actions){
		global $post;
		$actions['delete'] = "<a class='submitdelete' id='dhe_form_submitdelete' title='" . esc_attr( __( 'Delete this item permanently' ) ) . "' href='" . get_delete_post_link( $post->ID, '', true ) . "'>" . __( 'Delete Permanently' ) . "</a>";
		return $actions;
	}
	
	public function remove_row_actions( $actions ) {
		if ( 'dheform' === get_post_type() ) {
			unset( $actions['view'] );
			unset( $actions['edit_vc'] );
			unset( $actions['trash'] );
			unset( $actions['inline hide-if-no-js'] );
		}
	
		return $actions;
	}
}
new DHE_Form_Admin();