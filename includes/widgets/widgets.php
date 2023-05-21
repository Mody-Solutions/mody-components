<?php

add_action( 'elementor/elements/categories_registered', function ( $elements_manager ) {

	$elements_manager->add_category(
		'mody',
		[
			'title' => esc_html__( 'Mody Solutions', 'kink-advisor' ),
			'icon' => 'fa fa-plug',
		]
	);
} );

add_action( 'elementor/widgets/register', function ( $widgets_manager ) {
	$widget_dir_files = glob( KINK_ADVISOR_PLUGIN_DIR . '/includes/widgets/*.php' );
	foreach ( $widget_dir_files as $widget ) {
		if(str_contains(basename($widget), 'widgets.php')) { continue; }
		require_once $widget;
		$path_info  = pathinfo( $widget, PATHINFO_FILENAME );
		$class_name = ucwords(
			strtolower(
				str_replace(
					'-',
					'',
					$path_info
				)
			)
		);
		$widgets_manager->register( new $class_name() );
	}
} );