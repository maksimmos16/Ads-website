<?php
/**
 * Elementor test Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

class DirectoryPress_Elementor_Listing_Widget extends \Elementor\Widget_Base {
	public $post_style;
	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		
		add_action('wp_enqueue_scripts', array($this, 'scripts'));
		$this->scripts();
	}
	public function scripts() {
			
			$available_css_files = apply_filters('directorypress_listing_grid_styles', 'directorypress_listing_grid_styles_fuction');  
			if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
				wp_enqueue_style('directorypress_listings');
				foreach($available_css_files as $key=>$style){
					wp_enqueue_style('directorypress_listing_style_'.$key);
					
				}
			}
			
	}
	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'listings';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Listings', 'DIRECTORYPRESS' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fas fa-ad';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'directorypress' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$ordering = directorypress_sorting_options();
		$directories = directorypress_directorytypes_array_options();
		$categories = directorypress_categories_array_options();
		$locations = directorypress_locations_array_options();
		$packages = directorypress_packages_array_options();
		
		// Setting Section
		$this->start_controls_section(
			'setting_section',
			[
				'label' => __( 'Setting', 'DIRECTORYPRESS' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'listings_view_type',
			[
				'label' => __( 'Defualt Listing View Type', 'DIRECTORYPRESS' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'grid' => __( 'Grid View', 'DIRECTORYPRESS' ),
					'list' => __( 'List View', 'DIRECTORYPRESS' ),
				],
				'default' => 'grid',
			]
		);
		$this->add_control(
			'listing_post_style',
			[
				'label' => __( 'Grid View Style', 'DIRECTORYPRESS' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => apply_filters("directorypress_listing_grid_styles" , "directorypress_listing_grid_styles_fuction"),
				'default' => 1,
			]
		);
		$this->add_control(
			'listing_has_featured_tag_style',
			[
				'label' => __( 'Grid View Featured Tag Style', 'DIRECTORYPRESS' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => apply_filters("directorypress_listing_grid_styles_featured_tags" , "directorypress_listing_grid_styles_featured_tags_function"),
				'default' => 1,
			]
		);
		$this->add_control(
			'onepage',
			[
				'label' => __( 'Show All listings', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'0' => __( 'No', 'DIRECTORYPRESS' ),
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
				],
				'default' => 0,
			]
		);
		
		$this->add_control(
			'perpage',
			[
				'label' => __( 'Number of Items to show', 'DIRECTORYPRESS' ),
				//'description' => __( 'This option will work only if above option is set to (No)', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'condition' => [
					'onepage' => [ '0' ],
				],
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 10,
			]
		);
		$this->add_control(
			'listings_view_grid_columns',
			[
				'label' => __( 'Grid View Columns Per Row', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'label_block' => true,
				'min' => 1,
				'max' => 6,
				'step' => 1,
				'default' => 4,
			]
		);
		$this->add_control(
			'has_sticky_has_featured',
			[
				'label' => __( 'Show Featured Listing Only', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'0' => __( 'No', 'DIRECTORYPRESS' ),
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
				],
				'default' => 0,
			]
		);
		$this->add_control(
			'show_views_switcher',
			[
				'label' => __( 'Show Listing View Switcher', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
					'0' => __( 'No', 'DIRECTORYPRESS' ),
				],
				'default' => 1,
			]
		);
		$this->add_control(
			'hide_order',
			[
				'label' => __( 'Hide Sorting', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'0' => __( 'No', 'DIRECTORYPRESS' ),
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
				],
				'default' => 0,
			]
		);
		$this->add_control(
			'hide_count',
			[
				'label' => __( 'Hide Listing Count', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'0' => __( 'No', 'DIRECTORYPRESS' ),
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
				],
				'default' => 0,
			]
		);
		$this->add_control(
			'hide_paginator',
			[
				'label' => __( 'Hide Pagination', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'0' => __( 'No', 'DIRECTORYPRESS' ),
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
				],
				'default' => 0,
			]
		);
		$this->add_control(
			'scrolling_paginator',
			[
				'label' => __( 'Infinite Scroll', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'0' => __( 'No', 'DIRECTORYPRESS' ),
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
				],
				'default' => 0,
			]
		);
		$this->add_control(
			'order_by',
			[
				'label' => __( 'Listing Sort By', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => $ordering,
				'default' => 'post_date',
			]
		);
		$this->add_control(
			'order',
			[
				'label' => __( 'Order Listing As', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'ASC' => __( 'ASC', 'DIRECTORYPRESS' ),
					'DESC' => __( 'Descending', 'DIRECTORYPRESS' ),
				],
				'default' => 'ASC',
			]
		);
		$this->add_control(
			'listing_order_by_txt',
			[
				'label' => __( 'Order By Text', 'DIRECTORYPRESS' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Custom Order By Text', 'DIRECTORYPRESS' ),
			]
		);
		
		$this->end_controls_section(); 
		
		// content section
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'DIRECTORYPRESS' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'directorytypes',
			[
				'label' => __( 'Select Directory', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $directories,
				'default' => [0],
			]
		);
		$this->add_control(
			'uid',
			[
				'label' => __( 'Unique ID', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'description' => __( 'Insert unique id if you like to connect this module to a specific module like map or search(optional)', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '',
			]
		);
		$this->add_control(
			'categories',
			[
				'label' => __( 'Select Specific Categories', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $categories,
				'default' => [0],
			]
		);
		$this->add_control(
			'custom_category_link',
			[
				'label' => __( 'Custom Category Link', 'DIRECTORYPRESS' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'url to any category', 'DIRECTORYPRESS' ),
			]
		);
		$this->add_control(
			'custom_category_link_text',
			[
				'label' => __( 'Custom Category Link Text', 'DIRECTORYPRESS' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Explore Category', 'DIRECTORYPRESS' ),
			]
		);
		$this->add_control(
			'locations',
			[
				'label' => __( 'Select Specific Locations', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $locations,
				'default' => [0],
			]
		);
		$this->add_control(
			'packages',
			[
				'label' => __( 'Select Packages', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $packages,
				'default' => [0],
			]
		);

		$this->end_controls_section();
		
		// Slider
		$this->start_controls_section(
			'slider_section',
			[
				'label' => __( 'Slider', 'DIRECTORYPRESS' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'scroll',
			[
				'label' => __( 'Turn On Slider', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'0' => __( 'No', 'DIRECTORYPRESS' ),
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
				],
				'default' => 0,
			]
		);
		$this->add_control(
			'desktop_items',
			[
				'label' => __( 'Items Per Slide', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'label_block' => true,
				'min' => 1,
				'max' => 10,
				'step' => 1,
				'default' => 3,
			]
		);
		$this->add_control(
			'gutter',
			[
				'label' => __( 'Space Between Slides', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'label_block' => true,
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => 30,
			]
		);
		$this->add_control(
			'autoplay',
			[
				'label' => __( 'Turn On Autoplay', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'0' => __( 'No', 'DIRECTORYPRESS' ),
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
				],
				'default' => 0,
			]
		);
		$this->add_control(
			'autoplay_speed',
			[
				'label' => __( 'Autoplay Speed', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'label_block' => true,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
				'default' => 1000,
			]
		);
		$this->add_control(
			'loop',
			[
				'label' => __( 'Turn On Loop', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'0' => __( 'No', 'DIRECTORYPRESS' ),
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
				],
				'default' => 0,
			]
		);
		$this->add_control(
			'owl_nav',
			[
				'label' => __( 'Turn On Navigation', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'0' => __( 'No', 'DIRECTORYPRESS' ),
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
				],
				'default' => 0,
			]
		);
		$this->add_control(
			'scroller_nav_style',
			[
				'label' => __( 'Navigation Style', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'1' => __( 'Style 1', 'DIRECTORYPRESS' ),
					'2' => __( 'Style 2', 'DIRECTORYPRESS' ),
				],
				'default' => 2,
			]
		);
		$this->add_control(
			'delay',
			[
				'label' => __( 'Delay', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'label_block' => true,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
				'default' => 1000,
			]
		);
		
		$this->end_controls_section();
		
		// Style tab and section
		$this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Style', 'DIRECTORYPRESS' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'grid_thumb_dimension',
			[
				'label' => __( 'Grid Thumbnail Dimension', 'DIRECTORYPRESS' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'description' => __( 'Crop the original image size to any custom size. Set custom width or height to keep the original size ratio.', 'DIRECTORYPRESS' ),
				'default' => [
					'width' => '',
					'height' => '',
				],
			]
		);
		$this->add_control(
			'grid_padding',
			[
				'label' => __( 'Grid Column Gap', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				//'label_block' => true,
				'description' => __( 'Padding would effect grid item left and right, a 15px value means 30px gap between items', 'DIRECTORYPRESS' ),
				'min' => 0,
				'max' => 50,
				'step' => 1,
				'default' => 15,
			]
		);
		$this->add_control(
			'grid_margin_bottom',
			[
				'label' => __( 'Grid Column margin bottom', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .directorypress-listing.listing-grid-item' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$directorytypes = implode(", ", $settings['directorytypes']);
		$categories = implode(", ", $settings['categories']);
		$locations = implode(", ", $settings['locations']);
		$packages = implode(", ", $settings['packages']);
		//$locations = ($locations != 0)? $locations:'';
		$grid_thumb_width = $settings['grid_thumb_dimension']['width'];
		$grid_thumb_height = $settings['grid_thumb_dimension']['height'];
		$instance = array(
				'directorytypes' => $directorytypes,
				'uid' => $settings['uid'],
				'categories' => $categories,
				'locations' => $locations,
				'packages' => $packages,
				'custom_category_link' => $settings['custom_category_link'],
				'custom_category_link_text' => $settings['custom_category_link_text'],
				'listings_view_type' => $settings['listings_view_type'],
				'listing_post_style' => $settings['listing_post_style'],
				'listing_has_featured_tag_style' => $settings['listing_has_featured_tag_style'],
				'grid_padding' => $settings['grid_padding'],
				'onepage' => $settings['onepage'],
				'perpage' => $settings['perpage'],
				'listings_view_grid_columns' =>  $settings['listings_view_grid_columns'],
				'has_sticky_has_featured' => $settings['has_sticky_has_featured'],
				'hide_order' => $settings['hide_order'],
				'hide_count' => $settings['hide_count'],
				'hide_paginator' => $settings['hide_paginator'],
				'scrolling_paginator' => $settings['scrolling_paginator'],
				'show_views_switcher' => $settings['show_views_switcher'],
				'order_by' => $settings['order_by'],
				'order' => $settings['order'],
				'listing_order_by_txt' => $settings['listing_order_by_txt'],
				//'hide_content' => $settings['order'],
				//'author' => $settings['order'],
				'scroll' => $settings['scroll'], 
				'desktop_items' => $settings['desktop_items'], 
				'tab_landscape_items' => '3' , 
				'tab_items' => '2' , 
				'autoplay' => $settings['autoplay'], 
				'loop' => $settings['loop'], 
				'owl_nav' => $settings['owl_nav'], 
				'delay' => $settings['delay'] , 
				'autoplay_speed' => $settings['autoplay_speed'], 
				'gutter' => $settings['gutter'], 
				'listing_image_width' => $grid_thumb_width,
				'listing_image_height' => $grid_thumb_height,
				'scroller_nav_style' => $settings['scroller_nav_style'],
		);
		$this->post_style = $instance['listing_post_style'];
		$directorypress_handler = new directorypress_listings_handler();
		$directorypress_handler->init($instance);

		echo '<div class="directorypress-elementor-listing-widget">';
			echo $directorypress_handler->display();
		echo '</div>';
		if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
		echo '<script>
			( function( $ ) {
				directorypress_slik_init();	
			} )( jQuery );
		</script>';
		}
	}

}