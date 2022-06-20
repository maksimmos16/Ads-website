<?php
/**
 * Elementor test Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
use Elementor\Plugin;
class DirectoryPress_Elementor_Category_Widget extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		
		add_action('wp_enqueue_scripts', array($this, 'scripts'));
		$this->scripts();
	}
	public function scripts() {
		//if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			//wp_enqueue_style('directorypress_category');
		//}
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
		return 'categories';
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
		return __( 'Categories', 'DIRECTORYPRESS' );
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
		return 'fas fa-folder';
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
		//$ordering = directorypress_sorting_options();
		$directories = directorypress_directorytypes_array_options();
		$categories = directorypress_categories_array_options();
		//$locations = directorypress_locations_array_options();
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
			'cat_style',
			[
				'label' => __('category styles', 'DIRECTORYPRESS'),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => apply_filters("directorypress_categories_styles" , "directorypress_categories_styles_function"),
				'default' => '1',
			]
		);
		$this->add_control(
			'parent',
			[
				'label' => __('Parent category', 'DIRECTORYPRESS'),
				'description' => __('ID of parent category (default 0 – this will build whole categories tree starting from the root).', 'DIRECTORYPRESS'),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'Inset Id', 'DIRECTORYPRESS' ),
			]
		);
		$this->add_control(
			'depth',
			[
				'label' => __('Categories sub level', 'DIRECTORYPRESS'), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'description' => __('The max depth of categories tree. When set to 1 – only root categories will be listed.', 'DIRECTORYPRESS'),
				'multiple' => false,
				'options' => [
					'1' => __( 'Level 1', 'DIRECTORYPRESS' ),
					'2' => __( 'Level 2', 'DIRECTORYPRESS' ),
				],
				//'condition' => [
					//'cat_style' => [ '3', '6', '7', '10' ],
				//],
				'default' => 1,
			]
		);
		$this->add_control(
			'subcats',
			[
				'label' => __('Show subcategories items number', 'DIRECTORYPRESS'),
				'description' => __('This is the number of subcategories those will be displayed in the table, when category item includes more than this number "View all" link appears at the bottom.', 'DIRECTORYPRESS'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'condition' => [
					'depth' => [ '2' ],
				],
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 5,
			]
		);
		
		$this->add_control(
			'columns_set1',
			[
				'label' =>__('Categories columns number', 'DIRECTORYPRESS'),
				'description' => __('Categories list is divided by columns.', 'DIRECTORYPRESS'),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'1' => __( '1 Column', 'DIRECTORYPRESS' ),
					'2' => __( '2 Column', 'DIRECTORYPRESS' ),
					'3' => __( '3 Column', 'DIRECTORYPRESS' ),
					'4' => __( '4 Column', 'DIRECTORYPRESS' ),
					//'5' => __( '5 Column', 'DIRECTORYPRESS' ),
					//'6' => __( '6 Column', 'DIRECTORYPRESS' ),
					//'inline' => __( 'Inline', 'DIRECTORYPRESS' ),
				],
				'default' => 4,
				'condition' => [
					'cat_style' => [ '3', '6', '7', '10' ],
				],
			]
		);
		$this->add_control(
			'columns_set2',
			[
				'label' =>__('Categories columns number', 'DIRECTORYPRESS'),
				'description' => __('Categories list is divided by columns.', 'DIRECTORYPRESS'),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'1' => __( '1 Column', 'DIRECTORYPRESS' ),
					'2' => __( '2 Column', 'DIRECTORYPRESS' ),
					'3' => __( '3 Column', 'DIRECTORYPRESS' ),
					'4' => __( '4 Column', 'DIRECTORYPRESS' ),
					'5' => __( '5 Column', 'DIRECTORYPRESS' ),
					'6' => __( '6 Column', 'DIRECTORYPRESS' ),
					'inline' => __( 'Inline', 'DIRECTORYPRESS' ),
				],
				'default' => 4,
				'condition' => [
					'cat_style' => [ '1', '2', '5', '8', '9', '11' ],
				],
			]
		);
		$this->add_control(
			'cat_icon_type',
			[
				'label' => __('Select Categories icon type', 'DIRECTORYPRESS'),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'1' => __( 'Font Icons', 'DIRECTORYPRESS' ),
					'2' => __( 'Image Icons', 'DIRECTORYPRESS' ),
				],
				'default' => 1,
			]
		);
		$this->add_control(
			'count',
			[
				'label' =>  __('Show category listings count?', 'DIRECTORYPRESS'),
				'description' => __('Whether to show number of listings assigned with current category in brackets.', 'DIRECTORYPRESS'), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'0' => __( 'No', 'DIRECTORYPRESS' ),
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
				],
				'default' => 1,
			]
		);
		$this->add_control(
			'hide_empty',
			[
				'label' =>  __('Hide Empty Ctegories?', 'DIRECTORYPRESS'), 
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
			'directorytype',
			[
				'label' => __( 'Select Directory', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => $directories,
				'default' => 0,
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
				'default' => 0,
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
				'default' => 0,
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
				'condition' => [
					'cat_style' => [ '1', '2', '4', '5', '8', '9', '11' ],
				],
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
				'condition' => [
					'scroll' => [ '1' ],
				],
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
				'condition' => [
					'scroll' => [ '1' ],
				],
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
				'condition' => [
					'scroll' => [ '1' ],
				],
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
				'condition' => [
					'scroll' => [ '1' ],
				],
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
				'condition' => [
					'scroll' => [ '1' ],
				],
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
				'condition' => [
					'scroll' => [ '1' ],
				],
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
				'condition' => [
					'scroll' => [ '1' ],
				],
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
				'condition' => [
					'scroll' => [ '1' ],
				],
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
			'item_border_title',
			[
				'label' => __( 'Box Border', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'after',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border',
				'label' => __( 'Box Border', 'DIRECTORYPRESS' ),
				'selector' => '{{WRAPPER}} .directorypress-category-holder',
			]
		);
		$this->add_control(
			'item_border_title_hover',
			[
				'label' => __( 'Box Border Hover', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'box_border_hover',
				'label' => __( 'Box Border Hover', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .directorypress-category-holder:hover',
			]
		);
		$this->add_control(
			'box_border_radius',
			[
				'label' => __( 'Box Border Radius', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-holder' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'item_padding',
			[
				'label' => __( 'Item Space between items', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-item' => 'padding-left: {{SIZE}}{{UNIT}} !important;padding-right: {{SIZE}}{{UNIT}} !important;margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .directorypress-categories-wrapper' => 'margin-left: -{{SIZE}}{{UNIT}} !important;margin-right: -{{SIZE}}{{UNIT}} !important;',
				],
			]
		);
		$this->add_control(
			'item_title_color',
			[
				'label' => __( 'Title Color', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-holder .directorypress-parent-category a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'item_title_color_hover',
			[
				'label' => __( 'Title Color Hover', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-holder:hover .directorypress-parent-category a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'item_typo_title',
			[
				'label' => __( 'Item Typography', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'item_typography',
				'label' => __( 'Typography', 'DIRECTORYPRESS' ),
				'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .directorypress-category-holder .directorypress-parent-category a',
			]
		);
		$this->add_control(
			'box_shadow_title',
			[
				'label' => __( 'Box Shadow', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => __( 'Box Shadow', 'DIRECTORYPRESS' ),
				'selector' => '{{WRAPPER}} .directorypress-category-holder',
			]
		);
		$this->add_control(
			'box_shadow_title_hover',
			[
				'label' => __( 'Box Shadow Hover', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow_hover',
				'selector' => '{{WRAPPER}} .directorypress-category-holder:hover',
			]
		);
		$this->add_control(
			'box_bg_title',
			[
				'label' => __( 'Box Background', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_background',
				'label' => __( 'Box Background', 'DIRECTORYPRESS' ),
				'description' => __( 'Category Box Background', 'DIRECTORYPRESS' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .directorypress-category-holder',
			]
		);
		$this->add_control(
			'box_bg_title_hover',
			[
				'label' => __( 'Box Background Hover', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_background_hover',
				'label' => __( 'Box Background', 'DIRECTORYPRESS' ),
				'description' => __( 'Category Box Background', 'DIRECTORYPRESS' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .directorypress-category-holder:hover',
			]
		);
		$this->end_controls_section(); 
		
		// Icon Style
		$this->start_controls_section(
			'icon_style_section',
			[
				'label' => __( 'Icon', 'DIRECTORYPRESS' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_width',
			[
				'label' => __( 'Icon Width', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-item .cat-icon' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_height',
			[
				'label' => __( 'Icon Height', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-item .cat-icon' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_margin_top_bottom',
			[
				'label' => __( 'Margin Top/Bottom', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'allowed_dimensions' => ['top', 'bottom'],
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-item .cat-icon' => 'margin-top: {{TOP}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_margin_left_right',
			[
				'label' => __( 'Margin Left/Right', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'allowed_dimensions' => 'horizontal',
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-item .cat-icon' => 'margin-right: {{RIGHT}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_size',
			[
				'label' => __( 'Icon Font Size', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-item .cat-icon.font-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_line_height',
			[
				'label' => __( 'Line Height', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-item .cat-icon.font-icon' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_border_title',
			[
				'label' => __( 'Icon Box Border', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => __( 'Icon Box Border', 'DIRECTORYPRESS' ),
				'selector' => '{{WRAPPER}} .directorypress-category-item .cat-icon.font-icon',
			]
		);
		$this->add_control(
			'icon_border_title_hover',
			[
				'label' => __( 'Icon Box Border Hover', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border_hover',
				'label' => __( 'Icon Box Border Hover', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .directorypress-category-item:hover .cat-icon.font-icon',
			]
		);
		$this->add_control(
			'icon_border_radius',
			[
				'label' => __( 'Icon Border Radius', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					]
				],
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-item .cat-icon.font-icon' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'icon_shadow_title',
			[
				'label' => __( 'Icon Box Shadow', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow',
				'selector' => '{{WRAPPER}} .directorypress-category-item .cat-icon.font-icon',
			]
		);
		$this->add_control(
			'icon_shadow_title_hover',
			[
				'label' => __( 'Icon Box Shadow Hover', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_shadow_hover',
				'selector' => '{{WRAPPER}} .directorypress-category-item:hover .cat-icon.font-icon',
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => __( 'Icon Color', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-item .cat-icon.font-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_color_hover',
			[
				'label' => __( 'Icon Color Hover', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'scheme' => [
					'type' => \Elementor\Core\Schemes\Color::get_type(),
					'value' => \Elementor\Core\Schemes\Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .directorypress-category-item:hover .cat-icon.font-icon' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon_background_title',
			[
				'label' => __( 'Icon Box Background', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_background',
				'label' => __( 'Icon Background', 'DIRECTORYPRESS' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .directorypress-category-item .cat-icon.font-icon',
			]
		);
		$this->add_control(
			'icon_background_title_hover',
			[
				'label' => __( 'Icon Box Background Hover', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'icon_background_hover',
				'label' => __( 'Icon Background Hover', 'DIRECTORYPRESS' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .directorypress-category-item:hover .cat-icon.font-icon',
			]
		);
		$this->add_control(
			'icon_section_bottom_divider',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
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
		if( $settings['cat_style'] == 3 || $settings['cat_style'] == 6 || $settings['cat_style'] == 7 || $settings['cat_style'] == 10){
			$columns = $settings['columns_set1'];
		}else{
			$columns = $settings['columns_set2'];
		}
		$instance = array(
				//'custom_home' => 0,
				'directorytype' => $settings['parent'],
				'parent' => $settings['parent'],
				'depth' => $settings['depth'],
				'columns' => $columns,
				'count' => $settings['count'],
				'hide_empty' => $settings['hide_empty'],
				'subcats' => $settings['subcats'],
				'categories' => $settings['categories'],
				'packages' => $settings['packages'],
				'cat_style' => $settings['cat_style'],
				'cat_icon_type' => $settings['cat_icon_type'],
				'scroll' => $settings['scroll'], 
				'desktop_items' => $settings['desktop_items'], 
				//'tab_landscape_items' => '3' , 
				//'tab_items' => '2' , 
				'autoplay' => $settings['autoplay'], 
				'loop' => $settings['loop'], 
				'owl_nav' => $settings['owl_nav'], 
				'delay' => $settings['delay'] , 
				'autoplay_speed' => $settings['autoplay_speed'], 
				'gutter' => $settings['gutter'], 
				//'scroller_nav_style' => $settings['scroller_nav_style'],
				//'cat_font_size' => '' , //cz custom
				//'cat_font_weight' => '' , //cz custom
				//'cat_font_line_height' => '' , //cz custom
				//'cat_font_transform' => '' , //cz custom
				//'child_cat_font_size' => '' , //cz custom
				//'child_cat_font_weight' => '' , //cz custom
				//'child_cat_font_line_height' => '' , //cz custom
				//'child_cat_font_transform' => '' , //cz custom
				//'parent_cat_title_color' => '' , //cz custom
				//'parent_cat_title_color_hover' => '' , //cz custom
				//'parent_cat_title_bg' => '' , //cz custom
				//'parent_cat_title_bg_hover' => '' , //cz custom
				//'subcategory_title_color' => '' , //cz custom
				//'subcategory_title_color_hover' => '' , //cz custom
				//'cat_bg' => '' , //cz custom
				//'cat_bg_hover' => '' , //cz custom
				//'cat_border_color' => '' , //cz custom
				//'cat_border_color_hover' => '' , //cz custom
				
		);
		
		$directorypress_handler = new directorypress_categories_handler();
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