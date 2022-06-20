<?php

class DHE_Form_Editor {

	public function __construct(){
		add_action( 'elementor/init', array( $this, 'add_category' ),15 );
		
		add_action( 'elementor/documents/register',array($this,'register_documents') );
		
		add_action('elementor/controls/controls_registered', array($this, 'controls_registered') );

		add_action( 'elementor/editor/after_enqueue_styles',array( $this, 'editor_enqueue_styles' ) );
		
		add_action( 'elementor/editor/after_save',array($this,'after_save'),10,2);

		add_action( 'elementor/preview/enqueue_scripts',array( $this, 'enqueue_preview_scripts' ) );
	
	}
	
	public function register_documents(){
		require_once DHE_FORM_DIR.'/includes/document.php';
		\Elementor\Plugin::$instance->documents->register_document_type('dheform', DHE_Form_Document::get_class_full_name());
	}
	
	public function after_save( $post_id, $editor_data ){
		$post = get_post($post_id);
		if ( empty( $post_id ) || empty( $post ) ) {
			return;
		}
		
		// Dont' save meta boxes for revisions or autosaves
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}
		
		// Check the post type
		if ('dheform'!==$post->post_type ) {
			return;
		}
		$scan_tag = new DHE_Form_Scan_Tag($post->post_content);
		update_post_meta($post->ID, '_form_control', $scan_tag->get_scaned_fields());
	}

	public function add_category(){
		\Elementor\Plugin::$instance->elements_manager->add_category( 'dhe-form', array(
			'title' => __( 'DHE Form', 'dhe-form' ),
		), 1 );
	}

	public function editor_enqueue_styles(){
		wp_enqueue_style('dhe_form_editor', DHE_FORM_URL.'/assets/css/editor.css',array(),DHE_FORM_VERSION);
	}

	public function enqueue_preview_scripts(){
		wp_enqueue_script('dhe_form_editor_preview',DHE_FORM_URL.'/assets/js/preview.js',array('jquery'),DHE_FORM_VERSION,true);
	}

	/**
	 *
	 * @param \Elementor\Controls_Manager $controls_manager
	 */
	public function controls_registered($controls_manager){
		
	}
	
}

new DHE_Form_Editor();