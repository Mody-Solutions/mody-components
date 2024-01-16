<?php

namespace mody\options;

//add_action( 'acf/init', function () {
//	$site_url = MODY_PLUGIN_DIR_URL;
//	acf_add_options_page( array(
//		'page_title' => __( 'Mody Options', 'mody' ),
//		'menu_slug'  => 'mody-options',
//		'icon_url'   => "{$site_url}assets/img/mody-solutions-iso-white.png",
//		'menu_title' => 'Mody',
//		'position'   => 100,
//		'redirect'   => false,
//	) );
//} );

add_action( 'admin_menu', function () {
	$user    = wp_get_current_user();
	$roles   = [ 'administrator' ];
	$allowed = array_filter( $user->roles, function ( $role ) use ( $roles ) {
		return in_array( $role, $roles );
	}, ARRAY_FILTER_USE_BOTH );
	if ( ! $allowed ) {
		$blocked_pages = [
			'edit.php',
			'tools.php',
			'edit-comments.php',
			'admin.php?page=wpml-media',
			'edit.php?post_type=tutorial',
			'options-general.php?page=yes-sir',
			'edit.php?post_type=experience-slide',
			'edit.php?post_type=elementor_library',
		];
		foreach ( $blocked_pages as $blocked_page ) {
			remove_menu_page( $blocked_page );
		}
	}
}, 100, 0 );