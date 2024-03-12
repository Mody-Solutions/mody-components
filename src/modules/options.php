<?php

namespace mody\options;

add_action( 'admin_menu', function () {
	$user    = wp_get_current_user();
	$roles   = [ 'administrator' ];
	$allowed = array_filter( $user->roles, function ( $role ) use ( $roles ) {
		return in_array( $role, $roles );
	}, ARRAY_FILTER_USE_BOTH );
	if ( ! $allowed ) {
		$blocked_pages = [
			'tools.php',
			'edit-comments.php',
			'admin.php?page=wpml-media',
			'edit.php?post_type=tutorial',
			'options-general.php?page=yes-sir',
			'edit.php?post_type=experience-slide',
			'edit.php?post_type=elementor_library',
			'admin.php?page=wccpoptionspro',
		];
		foreach ( $blocked_pages as $blocked_page ) {
			remove_menu_page( $blocked_page );
		}
	}
}, 100, 0 );