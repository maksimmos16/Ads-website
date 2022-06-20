<?php
/**
 * Define the demo import files (local files).
 *
 * You have to use the same filter as in above example,
 * but with a slightly different array keys: local_*.
 * The values have to be absolute paths (not URLs) to your import files.
 * To use local import files, that reside in your theme folder,
 * please use the below code.
 * Note: make sure your import files are readable!
 */

function designinvento_templates_import_files() {
	$protocol		= 'https://';
	$url = $protocol .'assets.designinvento.net/demo-data/classiadspro/';
	return array(
		array(
			'id'                           => 0,
			'import_file_name'             => 'Classiads Ultra',
			'import_file_url'            => $url . 'wpb/classiads-ultra/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-ultra/widgets.wie',
			'import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-ultra/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-ultra/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-ultra/customizer.dat',
			'import_preview_image_url'     => $url . 'wpb/classiads-ultra/classiads-ultra.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-ultra/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 1,
			'import_file_name'             => 'Classiads Fantro',
			'import_file_url'            => $url . 'wpb/classiads-fantro/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-fantro/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-fantro/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-fantro/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-fantro/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-fantro/classiads-fantro.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-fantro/',
			'homepage'                     => 'home',
			'blog_page'                    => 'Blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'Footer',
			'page_builder'                 => 'wpbackery',
		),
		
		array(
			'id'                           => 2,
			'import_file_name'             => 'Classiads Zon',
			'import_file_url'            => $url . 'wpb/classiads-zon/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-zon/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-zon/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-zon/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-zon/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-zon/classiads-zon.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-zon/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => '',
			'page_builder'                 => 'wpbackery',
			
		),
		array(
			'id'                           => 3,
			'import_file_name'             => 'Classiads Wind',
			'import_file_url'            => $url . 'wpb/classiads-wind/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-wind/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-wind/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-wind/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-wind/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-wind/classiads-wind.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-wind/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 4,
			'import_file_name'             => 'Classiads Mono',
			'import_file_url'            => $url . 'wpb/classiads-mono/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-mono/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-mono/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-mono/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-mono/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-mono/classiads-mono.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-mono/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 5,
			'import_file_name'             => 'Classiads Nova',
			'import_file_url'            => $url . 'wpb/classiads-nova/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-nova/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-nova/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-nova/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-nova/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-nova/classiads-nova.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-nova/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 6,
			'import_file_name'             => 'Classiads Mintox',
			'import_file_url'            => $url . 'wpb/classiads-mintox/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-mintox/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-mintox/customizer.dat',
			'import_rev_slider_file_url' => $url . 'wpb/classiads-mintox/slider-mintox.zip',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-mintox/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-mintox/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-mintox/classiads-mintox.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-mintox/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 7,
			'import_file_name'             => 'Classiads Wox',
			'import_file_url'            => $url . 'wpb/classiads-wox/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-wox/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-wox/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-wox/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-wox/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-wox/classiads-wox.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-wox/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 8,
			'import_file_name'             => 'Classiads Flow',
			'import_file_url'            => $url . 'wpb/classiads-flow/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-flow/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-flow/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-flow/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-flow/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-flow/classiads-flow.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-flow/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 9,
			'import_file_name'             => 'Classiads Solic',
			'import_file_url'            => $url . 'wpb/classiads-solic/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-solic/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-solic/customizer.dat',
			'import_rev_slider_file_url' => $url . 'wpb/classiads-solic/slider2.zip',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-solic/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-solic/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-solic/classiads-solic.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-solic/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 10,
			'import_file_name'             => 'Classiads Zoco',
			'import_file_url'            => $url . 'wpb/classiads-zoco/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-zoco/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-zoco/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-zoco/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-zoco/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-zoco/classiads-zoco.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-zoco/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 11,
			'import_file_name'             => 'Classiads Exotic',
			'import_file_url'            => $url . 'wpb/classiads-exotic/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-exotic/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-exotic/customizer.dat',
			'import_rev_slider_file_url' => $url . 'wpb/classiads-exotic/slider-exotic.zip',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-exotic/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-exotic/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-exotic/classiads-exotic.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-exotic/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 12,
			'import_file_name'             => 'Classiads Echo',
			'import_file_url'            => $url . 'wpb/classiads-echo/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-echo/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-echo/customizer.dat',
			'import_rev_slider_file_url' => $url . 'wpb/classiads-echo/slider-echo.zip',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-echo/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-echo/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-echo/classiads-echo.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-echo/',
			'homepage'                     => 'home',
			'blog_page'                    => 'Blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'Footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 13,
			'import_file_name'             => 'Classiads Emo',
			'import_file_url'            => $url . 'wpb/classiads-emo/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-emo/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-emo/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-emo/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-emo/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-emo/classiads-emo.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-emo/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 14,
			'import_file_name'             => 'Classiads Elca',
			'import_file_url'            => $url . 'wpb/classiads-elca/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-elca/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-elca/customizer.dat',
			'import_rev_slider_file_url' => $url . 'wpb/classiads-elca/slider-elca.zip',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-elca/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-elca/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-elca/classiads-elca.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-elca/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 15,
			'import_file_name'             => 'Classiads Exo',
			'import_file_url'            => $url . 'wpb/classiads-exo/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-exo/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-exo/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-exo/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-exo/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-exo/classiads-exo.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-exo/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 16,
			'import_file_name'             => 'Classiads Lemo',
			'import_file_url'            => $url . 'wpb/classiads-lemo/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-lemo/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-lemo/customizer.dat',
			'import_rev_slider_file_url' => $url . 'wpb/classiads-lemo/slider-lemo.zip',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-lemo/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-lemo/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-lemo/classiads-lemo.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-lemo/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 17,
			'import_file_name'             => 'Classiads Moto',
			'import_file_url'            => $url . 'wpb/classiads-moto/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-moto/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-moto/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-moto/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-moto/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-moto/classiads-moto.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-moto/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 18,
			'import_file_name'             => 'Classiads dose',
			'import_file_url'            => $url . 'wpb/classiads-dose/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-dose/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-dose/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-dose/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-dose/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-dose/classiads-dose.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-dose/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		array(
			'id'                           => 19,
			'import_file_name'             => 'Classiads phone',
			'import_file_url'            => $url . 'wpb/classiads-phone/demo-content.xml',
			'import_widget_file_url'     => $url . 'wpb/classiads-phone/widgets.wie',
			'local_import_customizer_file' => DT_PATH . 'demos/classiads-phone/customizer.dat',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-phone/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/classiads-phone/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'import_preview_image_url'     => $url . 'wpb/classiads-phone/classiads-phone.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/classiads-phone/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'wpbackery',
		),
		// Elementor
		array(
			'id'                           => 20,
			'import_file_name'             => 'Classiads Ultra',
			'import_file_url'            => $url . 'elementor/classiads-ultra/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-ultra/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-ultra/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-ultra/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-ultra/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-ultra/classiads-ultra.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-ultra/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 21,
			'import_file_name'             => 'Classiads Fantro',
			'import_file_url'            => $url . 'elementor/classiads-fantro/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-fantro/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-fantro/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-fantro/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-fantro/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-fantro/classiads-fantro.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-fantro/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 22,
			'import_file_name'             => 'Classiads Wind',
			'import_file_url'            => $url . 'elementor/classiads-wind/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-wind/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-wind/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-wind/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-wind/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-wind/classiads-wind.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-wind/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 23,
			'import_file_name'             => 'Classiads Zon',
			'import_file_url'            => $url . 'elementor/classiads-zon/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-zon/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-zon/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-zon/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-zon/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-zon/classiads-zon.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-zon/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 24,
			'import_file_name'             => 'Classiads Mono',
			'import_file_url'            => $url . 'elementor/classiads-mono/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-mono/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-mono/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-mono/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-mono/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-mono/classiads-mono.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-mono/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 25,
			'import_file_name'             => 'Classiads Emo',
			'import_file_url'            => $url . 'elementor/classiads-emo/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-emo/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-emo/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-emo/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-emo/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-emo/classiads-emo.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-emo/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 26,
			'import_file_name'             => 'Classiads Moto',
			'import_file_url'            => $url . 'elementor/classiads-moto/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-moto/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-moto/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-moto/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-moto/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-moto/classiads-moto.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-moto/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 27,
			'import_file_name'             => 'Classiads Dose',
			'import_file_url'            => $url . 'elementor/classiads-dose/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-dose/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-dose/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-dose/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-dose/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-dose/classiads-dose.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-dose/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 28,
			'import_file_name'             => 'Classiads Phone',
			'import_file_url'            => $url . 'elementor/classiads-phone/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-phone/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-phone/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-phone/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-phone/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-phone/classiads-phone.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-phone/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 29,
			'import_file_name'             => 'Classiads Wox',
			'import_file_url'            => $url . 'elementor/classiads-wox/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-wox/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-wox/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-wox/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-wox/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-wox/classiads-wox.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-wox/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 30,
			'import_file_name'             => 'Classiads Mintox',
			'import_file_url'            => $url . 'elementor/classiads-mintox/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-mintox/widgets.wie',
			'import_rev_slider_file_url' => $url . 'elementor/classiads-mintox/slider-mintox.zip',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-mintox/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-mintox/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-mintox/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-mintox/classiads-mintox.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-mintox/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 31,
			'import_file_name'             => 'Classiads Solic',
			'import_file_url'            => $url . 'elementor/classiads-solic/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-solic/widgets.wie',
			'import_rev_slider_file_url' => $url . 'elementor/classiads-solic/slider2.zip',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-solic/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-solic/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-solic/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-solic/classiads-solic.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-solic/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 32,
			'import_file_name'             => 'Classiads Zoco',
			'import_file_url'            => $url . 'elementor/classiads-zoco/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-zoco/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-zoco/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-zoco/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-zoco/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-zoco/classiads-zoco.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-zoco/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 33,
			'import_file_name'             => 'Classiads Flow',
			'import_file_url'            => $url . 'elementor/classiads-flow/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-flow/widgets.wie',
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-flow/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-flow/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-flow/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-flow/classiads-flow.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-flow/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 34,
			'import_file_name'             => 'Classiads Echo',
			'import_file_url'            => $url . 'elementor/classiads-echo/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-echo/widgets.wie',
			'import_rev_slider_file_url' => $url . 'elementor/classiads-echo/slider-echo.zip',
			
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-echo/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-echo/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-echo/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-echo/classiads-echo.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-echo/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 35,
			'import_file_name'             => 'Classiads Elca',
			'import_file_url'            => $url . 'elementor/classiads-elca/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-elca/widgets.wie',
			'import_rev_slider_file_url' => $url . 'elementor/classiads-elca/slider-elca.zip',
			
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-elca/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-elca/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-elca/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-elca/classiads-elca.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-elca/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 36,
			'import_file_name'             => 'Classiads Exo',
			'import_file_url'            => $url . 'elementor/classiads-exo/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-exo/widgets.wie',
			
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-exo/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-exo/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-exo/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-exo/classiads-exo.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-exo/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 37,
			'import_file_name'             => 'Classiads Pets',
			'import_file_url'            => $url . 'elementor/classiads-pets/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-pets/widgets.wie',
			
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-pets/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-pets/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-pets/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-pets/classiads-pets.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-pets/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),
		array(
			'id'                           => 38,
			'import_file_name'             => 'Classiads Directory',
			'import_file_url'            => $url . 'elementor/classiads-directory/demo-content.xml',
			'import_widget_file_url'     => $url . 'elementor/classiads-directory/widgets.wie',
			
			'local_import_redux'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-directory/theme-settings.json',
					'option_name' => 'pacz_settings',
				),
			),
			'local_import_redux2'           => array(
				array(
					'file_path' => DT_PATH . 'demos/elementor/classiads-directory/directorypress-settings.json',
					'option_name' => 'directorypress_admin_settings',
				),
			),
			'local_import_customizer_file' => DT_PATH . 'demos/elementor/classiads-directory/customizer.dat',
			'import_preview_image_url'     => $url . 'elementor/classiads-directory/classiads-directory.jpg',
			'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'designinvento' ),
			'preview_url'                  => 'https://classiads.designinvento.net/elementor/classiads-directory/',
			'homepage'                     => 'home',
			'blog_page'                    => 'blog',
			'primary_menu'                 => 'main',
			'footer_menu'                  => 'footer',
			'page_builder'                 => 'elementor',
		),

	);
}
add_filter( 'designinvento_templates_import_files', 'designinvento_templates_import_files' );



function designinvento_register_query_vars( $vars ) {
	$vars[] = 'p';
	return $vars;
}
add_filter( 'query_vars', 'designinvento_register_query_vars' );