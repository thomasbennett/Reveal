<?php

/* Add admin settings page */
function wds_settings() {
	$name = 'wds_settings';
	$title = __( 'Settings' , 'wds');
	$description = __( '
		<p>Infinite SEO aims to take care of every SEO option that a site requires, in one easy bundle.</p>
		<p>It is made of several components which you complete as you work through our simple SEO Set Up Wizard:</p>
		<ul>
			<li><b>Step 1 Settings</b>: allows you to choose which steps you want to include in your SEO Set Up Wizard. In most situations you would want to leave all four of the active components below checked.</li>
			<li><b>Step 2 XML Sitemap</b>: generates an xml sitemap which helps search engines to better index your site.</li>
			<li><b>Step 3 Title & Meta Optimization</b>: allows you to optimize title and meta tags on every page of your site.</li>
			<li><b>Step 4 SEOmoz Report</b>: provides detailed and accurate SEO information about your Web pages. It uses the SEOmoz Free API.</li>
			<li><b>Step 5 Automatic Links</b>: allows you to automatically link phrases in your posts, pages, custom post types and comments to corresponding posts, pages, custom post types, categories, tags, custom taxonomies and external urls.</li>
		</ul>
	' , 'wds');
	$fields = array(
		'components' => array(
			'title' => __( 'Active Components' , 'wds'),
			'intro' => __( 'In most situations you would want to leave all four of these components checked.' , 'wds'),
			'options' => array(
				array(
					'type' => 'checkbox',
					'name' => 'active-components',
					'title' => __( 'Check/uncheck the boxes to add/remove a step from the SEO Set Up Wizard' , 'wds'),
					'items' => array(
						'autolinks' => __( 'Automatic Links' , 'wds'),
						'onpage' => __( 'Title & Meta Optimization' , 'wds'),
						'seomoz' => __( 'SEOmoz Report' , 'wds'),
						//'sitemaps' => __( 'XML Sitemap' , 'wds'), // Removed plural
						'sitemap' => __( 'XML Sitemap' , 'wds'), // Added singular
					),
					'description' => ''
				)
			)
		),
		array(
			'title' => __('Show metaboxes to users', 'wds'),
			'intro' => __('This applies to create/edit Post pages', 'wds'),
			'options' => array (
				array(
					'title' => __('Show SEO metabox to role', 'wds'),
					'type' => 'dropdown',
					'name' => 'seo_metabox_permission_level',
					'items' => array(
						'manage_network' => __('Super Admin'),
						'activate_plugins' => __('Site Admin'),
						'moderate_comments' => __('Editor'),
						'edit_published_posts' => __('Author'),
						'edit_posts' => __('Contributor'),
					)
				),
				array(
					'title' => __('Show SEOmoz metabox to role', 'wds'),
					'type' => 'dropdown',
					'name' => 'urlmetrics_metabox_permission_level',
					'items' => array(
						'manage_network' => __('Super Admin'),
						'activate_plugins' => __('Site Admin'),
						'moderate_comments' => __('Editor'),
						'edit_published_posts' => __('Author'),
						'edit_posts' => __('Contributor'),
					)
				),
			)
		),
	);

	$contextual_help = '';

	if ( wds_is_wizard_step( '1' ) )
		$settings = new WDS_Core_Admin_Tab( $name, $title, $description, $fields, 'wds', $contextual_help );
}
add_action( 'init', 'wds_settings' );

/* Default settings */
function wds_defaults() {
	if( is_multisite() && WDS_SITEWIDE == true ) {
		$defaults = get_site_option( 'wds_settings_options' );
	} else {
		$defaults = get_option( 'wds_settings_options' );
	}

	if( ! is_array( $defaults ) ) {
		$defaults = array(
			'onpage' => 'on', // 'on' instead of 1
			'seo_metabox_permission_level' => (is_multisite() ? 'manage_network_options' : 'activate_plugins'), // Default to highest permission level available
			'autolinks' => 'on', // 'on' instead of 1
			'seomoz' => 'on', // 'on' instead of 1
			'urlmetrics_metabox_permission_level' => (is_multisite() ? 'manage_network_options' : 'activate_plugins'), // Default to highest permission level available
			'sitemap' => 'on', // Added singular. Also, changed to 'on' instead of 1
		);
	}
	apply_filters( 'wds_defaults', $defaults );

	if( is_multisite() && WDS_SITEWIDE == true ) {
		update_site_option( 'wds_settings_options', $defaults );
	} else {
		update_option( 'wds_settings_options', $defaults );
	}
}
add_action( 'init', 'wds_defaults' );
