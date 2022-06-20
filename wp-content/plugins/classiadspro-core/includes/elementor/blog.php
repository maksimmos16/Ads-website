<?php

use Elementor\Plugin;
class Pacz_Elementor_Blog_Widget extends \Elementor\Widget_Base {
	
	public function get_name() {
		return 'pacz_posts';
	}
	
	public function get_title() {
		return __( 'Classiads Posts', 'DIRECTORYPRESS' );
	}

	public function get_icon() {
		return 'fab fa-searchengin';
	}

	public function get_categories() {
		return [ 'general' ];
	}
	protected function _register_controls() {
		
		$this->start_controls_section(
			'setting_section',
			[
				'label' => __( 'Setting', 'DIRECTORYPRESS' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'post_style',
			[
				'label' => __( 'Post Style', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'tile' => __( 'Tile', 'DIRECTORYPRESS' ),
					'tile_elegant' => __( 'Tile Elegant', 'DIRECTORYPRESS' ),
					'tile_mod' => __( 'Tile Modern', 'DIRECTORYPRESS' ),
					//'masonry' => __( 'Masonary', 'DIRECTORYPRESS' ),
				],
				'default' => 'tile_elegant',
				//'condition' => [
					//'scroll' => [ '1' ],
				//],
			]
		);
		$this->add_control(
			'columns',
			[
				'label' => __( 'Turn On Ajax Keyword Search', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'2' => __( '2 Columns', 'DIRECTORYPRESS' ),
					'3' => __( '3 Columns', 'DIRECTORYPRESS' ),
					'4' => __( '4 Columns', 'DIRECTORYPRESS' ),
				],
				'default' => 3,
				//'condition' => [
					//'show_keywords_search' => [ '1' ],
				//],
			]
		);
		$this->add_control(
			'pagination',
			[
				'label' => __( 'Turn On Ajax Keyword Search', 'DIRECTORYPRESS' ), 
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => [
					'0' => __( 'No', 'DIRECTORYPRESS' ),
					'1' => __( 'Yes', 'DIRECTORYPRESS' ),
				],
				'default' => 0,
				//'condition' => [
					//'show_keywords_search' => [ '1' ],
				//],
			]
		);
		$this->add_control(
			'count',
			[
				'label' => __( 'Per Page Items', 'DIRECTORYPRESS' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
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
		global $pacz_settings, $classiadspro_dynamic_styles;
		$settings = $this->get_settings_for_display();
		$grid_width    = $pacz_settings['grid-width'];
		$content_width = $pacz_settings['content-width'];
		if (is_page()) {
			global $post;
			$layout = get_post_meta($post->ID, '_layout', true);
		} else {

			if (is_archive()) {
				$layout = $pacz_settings['archive-layout'];
			} else {
				$layout = 'right';
			}


		}
		$atts = array(
			'style' => $settings['post_style'],
			'layout' => $layout,
			'column' => $settings['columns'],
			'thumb_column' => '',
			'disable_meta' => 'true',
			'image_height' => '260',
			'image_width' => '370', // Scroller Style Only
			'count' => $settings['count'],
			'offset' => 0,
			'cat' => '',
			'posts' => '',
			'author' => '',
			//'pagination' => ,
			'pagination_style' => '1',
			'orderby' => 'date',
			'order' => 'DESC',
			'grid_avatar' => 'true',
			'read_more' => 'false',
			'sortable' => 'false',
			'classic_excerpt' => 'excerpt',
			'magazine_strcutre' => 1,
			'excerpt_length' => 120,
			'cropping' => 'true',
			'slideshow_layout' => 'default',
			'author' => 'true',
			'item_id' => '',
			'autoplay' => 'false',
			'tab_landscape_items' => 3,
			'tab_items' => 2,
			'desktop_items' => 5,
			'autoplay_speed' => 2000,
			'delay' => 1500,
			'item_loop' => 'false',
			'owl_nav' => 'false',
			'gutter_space' => 0,
			'scroll' => 'false',
			'item_row' => 1,
			'grid_width'    => $pacz_settings['grid-width'],
			'content_width' => $pacz_settings['content-width'],
		);
		
		// convert to vars
			$style = $settings['post_style'];
			$column = $settings['columns'];
			$thumb_column = '';
			$disable_meta = 'true';
			$image_height = '260';
			$image_width = '350'; // Scroller Style Only
			$count = $settings['count'];
			$offset = 0;
			$cat = '';
			$posts = '';
			$author = '';
			$pagination = $settings['pagination'];
			$pagination_style = '1';
			$orderby = 'date';
			$order = 'DESC';
			$grid_avatar = 'true';
			$read_more = 'false';
			$sortable = 'false';
			$classic_excerpt = 'excerpt';
			$magazine_strcutre = 1;
			$excerpt_length = 120;
			$cropping = 'true';
			$slideshow_layout = 'default';
			$author = 'true';
			$item_id = '';
			$autoplay = 'false';
			$tab_landscape_items = 3;
			$tab_items = 2;
			$desktop_items = 5;
			$autoplay_speed = 2000;
			$delay = 1500;
			$item_loop = 'false';
			$owl_nav = 'false';
			$gutter_space = 0;
			$scroll = 'false';
			$item_row = 1;
			$output = '';
		require_once PACZ_THEME_PLUGINS_CONFIG . "/image-cropping.php";


		$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);


		$query = array(
			'post_type' => 'post',
			'posts_per_page' => (int) $count,
			'paged' => $paged,
			'suppress_filters' => 0,
			'ignore_sticky_posts' => 1
		);
		
		if ($cat) {
			$query['cat'] = $cat;
		}
		if ($author) {
			$query['author'] = $author;
		}
		if ($posts) {
			$query['post__in'] = explode(',', $posts);
		}
		if ($orderby) {
			$query['orderby'] = $orderby;
		}
		if ($order) {
			$query['order'] = $order;
		}

		$id = uniqid();

		$item_id = (!empty($item_id)) ? $item_id : 1409305847;



		if ($offset && $pagination_style != 2) {
			$query['offset'] = $offset;
		}

		$query['paged'] = $paged;

		$r = new WP_Query($query);


		
		
		if ($style != 'scroller' && $style != 'slideshow') {
    wp_enqueue_script('jquery-isotope');
    wp_enqueue_script('jquery-jplayer');
}

if ($pagination_style == '2') {
    $paginaton_style_class = 'load-button-style';
    wp_enqueue_script('infinitescroll');
} else if ($pagination_style == '3') {
    $paginaton_style_class = 'scroll-load-style';
    wp_enqueue_script('infinitescroll');
} else {
    $paginaton_style_class = 'page-nav-style';
}


if ($sortable == 'true' && !is_archive() && $style != 'scroller' && $style != 'slideshow') {
    $output .= '<header class="pacz-isotop-filter"><ul>';

    $categories_args = array(
        'orderby' => 'name',
        'order' => 'ASC',
        'include' => $cat
    );

    $categories = get_categories($categories_args);
    $output .= '<li><a class="current" data-filter="*" href="#">' . esc_html__('All', 'pacz') . '</a></li>';
    foreach ($categories as $category) {
        $output .= '<li><a data-filter=".category-' . $category->slug . '" href="#">' . $category->name . '</a></li>';
    }

    $output .= '<div class="clearboth"></div></ul>';
    $output .= '<div class="clearboth"></div></header>';
}

$isotope_el_class = ($style != 'scroller' && $style != 'magazine' && $style != 'tile_elegant' && $style != 'tile_mod' && $style != 'tile' && $style != 'slideshow' && !is_archive() && !is_home() && !is_single()) ? 'isotop-enabled pacz-theme-loop ' : '';



switch ($magazine_strcutre) {
	case 1:
		$magazine_style_class = 'mag-one-column';
		break;
	case 2:
		$magazine_style_class = 'mag-two-column-left';
		break;
	case 3:
		$magazine_style_class = 'mag-two-column-right';
		break;

	default:
		$magazine_style_class = 'mag-one-column';
		break;
}



$output .= '<div class="loop-main-wrapper"><section id="pacz-blog-loop-' . $id . '" data-style="' . $style . '" data-uniqid="'.$item_id.'" class="row pacz-blog-container clearfix pacz-' . $style . '-wrapper '.$magazine_style_class.' ' . $paginaton_style_class . ' '.$isotope_el_class.'">' . "\n";

if ($scroll == 'true') {
    $output .= '<div class="slick-carousel" data-items="'.$desktop_items.'" data-items-768="'.$tab_landscape_items.'" data-items-1024="'.$tab_items.'" data-autoplay="'.$autoplay.'" data-gutter="'.$gutter_space.'" data-autoplay-speed="'.$autoplay_speed.'" data-delay="'.$delay.'" data-loop="'.$item_loop.'" data-arrow="'.$owl_nav.'" data-slide-to-scroll="1" data-slide-speed="1000" data-center="false" data-center-padding="0">';
}

$i = 0;
if (is_archive()):
    if (have_posts()):
        while (have_posts()):
            the_post();
            $i++;
            switch ($style) {

                case 'classic':
                    $output .= blog_classic_style($atts);
                    break;
                case 'masonry':
                    $output .= blog_masonry_style($atts);
                    break;
                case 'modern':
                    $output .= blog_modern_style($atts);
                    break;
                case 'list':
                    $output .= blog_list_style($atts);
                    break;
                case 'thumb':
                    $output .= blog_thumb_style($atts);
                    break;
                case 'magazine':
                    $output .= blog_magazine_style($atts, $i);
                    break;
                case 'tile':
                    $output .= blog_tile_style($atts, $i);
                    break;
				case 'tile_elegant':
                    $output .= blog_tile_elegant_style($atts, $i);
                    break;
                default:
                    $output .= blog_classic_style($atts);
            }
        endwhile;
    endif;
else:
    if ($r->have_posts()):
        while ($r->have_posts()):
            $r->the_post();
            $i++;
            switch ($style) {

                case 'classic':
                    $output .= blog_classic_style($atts);
                    break;
                case 'modern':
                    $output .= blog_modern_style($atts);
                    break;
                case 'masonry':
                    $output .= blog_masonry_style($atts);
                    break;
                case 'list':
                    $output .= blog_list_style($atts);
                    break;
                case 'thumb':
                    $output .= blog_thumb_style($atts);
                    break;
                case 'magazine':
                    $output .= blog_magazine_style($atts, $i);
                    break;
                case 'tile':
                    $output .= blog_tile_style($atts, $i);
                    break;
				case 'tile_elegant':
                    $output .= blog_tile_elegant_style($atts, $i);
                    break;
				case 'tile_mod':
                    $output .= blog_tile_modern_style($atts, $i);
                    break;
                default:
                    $output .= blog_classic_style($atts);
            }
        endwhile;
    endif;
endif;
if ($scroll == 'true') {
    $output .= '</div>';
}
$output .= '</section><div class="clearboth"></div>';


if ($pagination && $style != 'scroller' && $style != 'magazine'  && $style != 'slideshow') {
    $output .= '<a class="pacz-loadmore-button" style="display:none;" href="#"><i class="pacz-icon-circle-o-notch"></i><i class="pacz-icon-chevron-down"></i></a>';
    ob_start();
    pacz_theme_blog_pagenavi('', '', $r, $paged);
    $output .= ob_get_clean();
}
$output .= '</div>';
wp_reset_postdata();
echo '<div>'.$output.'</div>';
	}

}