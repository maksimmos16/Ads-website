<?php

function designinvento_template_plugin($selected_import_index)
{
	/**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
	 $protocol		= is_ssl() ? 'https://' : 'http://';
	$dynamic_url = $protocol .'assets.designinvento.net/plugins/';
    $plugins_default = array(



        // This is an example of how to include a plugin from the WordPress Plugin Repository
		
        array(
            'name' => 'ClassiadsPro Core',
            'slug' => 'classiadspro-core',
            'source' => $dynamic_url.'classiadspro/5-10-1/classiadspro-core.zip',
            'required' => true,
            'version' => '1.0.8',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'DirectoryPress',
            'slug' => 'directorypress',
            'source' => $dynamic_url.'directorypress/3-4-1/directorypress.zip',
            'required' => false,
            'version' => '3.4.1',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'DirectoryPress Extended Location',
            'slug' => 'directorypress-extended-locations',
            'source' => $dynamic_url.'directorypress/directorypress-addons/directorypress-extended-locations/1-7-0/directorypress-extended-locations.zip',
            'required' => false,
            'version' => '1.7.0',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'DirectoryPress Frontend Listing',
            'slug' => 'directorypress-frontend',
            'source' => $dynamic_url.'directorypress/directorypress-addons/directorypress-frontend/2-5-1/directorypress-frontend.zip',
            'required' => false,
            'version' => '2.5.1',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'DirectoryPress Maps',
            'slug' => 'directorypress-maps',
            'source' => $dynamic_url.'directorypress/directorypress-addons/directorypress-maps/1-4-0/directorypress-maps.zip',
            'required' => false,
            'version' => '1.4.0',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'DirectoryPress MultiDirectory',
            'slug' => 'directorypress-multidirectory',
            'source' => $dynamic_url.'directorypress/directorypress-addons/directorypress-multidirectory/2-8-0/directorypress-multidirectory.zip',
            'required' => false,
            'version' => '2.8.0',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'DirectoryPress Payment Manager',
            'slug' => 'directorypress-payment-manager',
            'source' => $dynamic_url.'directorypress/directorypress-addons/directorypress-payment-manager/2-9-0/directorypress-payment-manager.zip',
            'required' => false,
            'version' => '2.9.0',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'DirectoryPress Advanced Fields',
            'slug' => 'directorypress-advanced-fields',
            'source' => $dynamic_url.'directorypress/directorypress-addons/directorypress-advanced-fields/1-0-0/directorypress-advanced-fields.zip',
            'required' => false,
            'version' => '1.0.0',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'DirectoryPress Claim Listing',
            'slug' => 'directorypress-claim-listing',
            'source' => $dynamic_url.'directorypress/directorypress-addons/directorypress-claim-listing/1-0-0/directorypress-claim-listing.zip',
            'required' => false,
            'version' => '1.0.0',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'Frontend Messages DirectoryPress',
            'slug' => 'directorypress-frontend-messages',
            'source' => $dynamic_url.'directorypress/directorypress-addons/directorypress-frontend-messages/5-4-0/directorypress-frontend-messages.zip',
            'required' => false,
            'version' => '5.4.0',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'Slider Revolution',
            'slug' => 'revslider',
            'source' => $dynamic_url.'revolution/6-5-11/revslider.zip',
            'required' => false,
            'version' => '6.5.11',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'AccessPress Social Login',
            'slug' => 'AccessPress_Social_Login',
            'source' => $dynamic_url.'apsl/2-0-9/AccessPress_Social_Login.zip',
            'required' => false,
            'version' => '2.0.9',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'Taxonomy Terms Order',
            'slug' => 'taxonomy-terms-order',
            'source' => '',
            'required' => false,
            'version' => '',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        ),
		array(
            'name' => 'WooCommerce',
            'slug' => 'woocommerce',
            'source' => '',
            'required' => false,
            'version' => '',
            'force_activation' => false,
            'force_deactivation' => false
        )
	);
	$added = array();
	$wpb = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19);
	$elementor = array(20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40);
	if(in_array($selected_import_index, $wpb) || $selected_import_index == 9999){
		$added[] =	array(
            'name' => 'WPBakery Page Builder',
            'slug' => 'js_composer',
            'source' => $dynamic_url.'vc/6-7-0/js_composer.zip',
            'required' => true,
            'version' => '6.7.0',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        );
		$added[] =	array(
            'name' => ' Ultimate Addons for WPBakery Page Builder',
            'slug' => 'Ultimate_VC_Addons',
            'source' => $dynamic_url.'uvc/3-19-11/Ultimate_VC_Addons.zip',
            'required' => false,
            'version' => '3.19.11',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        );
		$added[] =	array(
            'name' => 'DHVC Form',
            'slug' => 'dhvc-form',
            'source' => $dynamic_url.'dhvc/2-3-3/dhvc-form.zip',
            'required' => false,
            'version' => '2.3.3',
			'is_automatic' => true, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        );
	}elseif(in_array($selected_import_index, $elementor)){
		$added[] =	array(
            'name' => 'Elementor',
            'slug' => 'elementor',
            'required' => false,
        );
		$added[] =	array(
            'name' => 'DHEForm',
            'slug' => 'dhe-form',
            'source' => $dynamic_url.'dhe/1-0-8/dhe-form.zip',
            'required' => false,
            'version' => '1.0.8',
			'is_automatic' => false, // automatically activate plugins after installation
            'force_activation' => false,
            'force_deactivation' => false
        );
	}

    if ( ! empty($added) ) {
		$plugins = array_merge($plugins_default, $added);
	} else {
		$plugins = $plugins_default;
	}

/**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'designinvento-templates',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'plugins.php',            // Parent menu slug.
		'capability'   => 'manage_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',  
    );

	tgmpa( $plugins, $config );
}