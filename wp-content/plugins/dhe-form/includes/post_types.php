<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class DHE_Form_Post_Types
{
    public static function init()
    {
        add_action('init', array(__CLASS__, 'register_post_types'), 5);
    }
    
    public static function register_post_types()
    {
        if (!is_blog_installed() || post_type_exists('dheform')) {
            return;
        }
        
        register_post_type("dheform", apply_filters('dhe_form_register_post_type', array(
            'labels' => array(
                'name' => __('Forms', 'dhe-form'),
                'singular_name' => __('Form', 'dhe-form'),
                'menu_name' => _x('Forms', 'Admin menu name', 'dhe-form'),
                'add_new' => __('Add Form', 'dhe-form'),
                'add_new_item' => __('Add New Form', 'dhe-form'),
                'edit' => __('Edit', 'dhe-form'),
                'edit_item' => __('Edit Form', 'dhe-form'),
                'new_item' => __('New Form', 'dhe-form'),
                'view' => __('View Form', 'dhe-form'),
                'view_item' => __('View Form', 'dhe-form'),
                'search_items' => __('Search Forms', 'dhe-form'),
                'not_found' => __('No Forms found', 'dhe-form'),
                'not_found_in_trash' => __('No Forms found in trash', 'dhe-form'),
                'parent' => __('Parent Form', 'dhe-form')
            ),
            'description' => __('This is where you can add new form.', 'dhe-form'),
            'public' => true,
            'has_archive' => false,
            'show_in_nav_menus' => false,
            'exclude_from_search' => true,
        	'rewrite' => false,
            'show_ui' => true,
            'show_in_menu' => 'dhe-form',
            'query_var' => true,
            'capability_type' => 'dheform',
        	'map_meta_cap'=> true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array( 'title','editor','elementor')
        )));
    }
}
DHE_Form_Post_Types::init();