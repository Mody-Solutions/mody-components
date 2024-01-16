<?php

namespace mody\tutorials;

const MODY_TUTORIAL_POST_TYPE = 'tutorial';

add_action( 'admin_menu', function () {
	add_menu_page(
		__( 'Tutorials', 'mody' ),
		__( 'Tutorials', 'mody' ),
		'edit_posts',
		'mody-tutorials',
		'\mody\tutorials\page',
		'dashicons-format-video',
		2.5 );
} );

function page() : void {
	$sidebar = '';
	$tutorials = get_posts([
		'post_type' => MODY_TUTORIAL_POST_TYPE,
		'status' => 'publish',
		'posts_per_page' => 1,
	]);
	if(count($tutorials) > 0) {
		$content = '<h2 class="title">' . __('Please select a video from the menu', 'mody') . '</h2>';
		$template = 'index-sidebar-left';
	} else {
		$content = '<h2 class="title">' . __('There are no tutorials available', 'mody') . '</h2>';
		$template = 'index-full';
	}
	$page = \mody\load_template( "admin/{$template}", [
		'page_title' => __( 'Tutorials', 'mody' ),
		'class_name' => MODY_TUTORIAL_POST_TYPE,
		'sidebar' => $sidebar,
		'content' => $content,
	] );
	echo $page;
}

add_action('admin_init', function(){
	wp_register_script(
		'mody_plugin_tutorials',
		MODY_PLUGIN_DIST_DIR . 'tutorial.js',
		[],
		MODY_PLUGIN_VER,
		['in_footer' => true ]
	);
});

add_action('admin_enqueue_scripts', function( $hook ){
	if($hook !== 'toplevel_page_mody-tutorials'){ return; }
	wp_enqueue_style(
		'mody_plugin_style',
		MODY_PLUGIN_DIST_DIR . 'styles.css',
		[],
		MODY_PLUGIN_VER
	);

	$video_tutorials = get_posts([
		'post_type' => MODY_TUTORIAL_POST_TYPE,
		'posts_per_page' => -1,
		'post_status' => 'publish'
	]);
	$video_tutorials = array_map(function($tutorial){
		$tutorial->video_url = get_field('video', $tutorial);
		return $tutorial;
	}, $video_tutorials);
	wp_localize_script('mody_plugin_tutorials', 'mody_tutorials', $video_tutorials);
	wp_enqueue_script('mody_plugin_tutorials');
});

add_action( 'init', function() {
	register_post_type( MODY_TUTORIAL_POST_TYPE, array(
		'labels' => array(
			'name' => 'Tutorials',
			'singular_name' => 'Tutorial',
			'menu_name' => 'Tutorials',
			'all_items' => 'All Tutorials',
			'edit_item' => 'Edit Tutorial',
			'view_item' => 'View Tutorial',
			'view_items' => 'View Tutorials',
			'add_new_item' => 'Add New Tutorial',
			'new_item' => 'New Tutorial',
			'parent_item_colon' => 'Parent Tutorial:',
			'search_items' => 'Search Tutorials',
			'not_found' => 'No tutorials found',
			'not_found_in_trash' => 'No tutorials found in Trash',
			'archives' => 'Tutorial Archives',
			'attributes' => 'Tutorial Attributes',
			'insert_into_item' => 'Insert into tutorial',
			'uploaded_to_this_item' => 'Uploaded to this tutorial',
			'filter_items_list' => 'Filter tutorials list',
			'filter_by_date' => 'Filter tutorials by date',
			'items_list_navigation' => 'Tutorials list navigation',
			'items_list' => 'Tutorials list',
			'item_published' => 'Tutorial published.',
			'item_published_privately' => 'Tutorial published privately.',
			'item_reverted_to_draft' => 'Tutorial reverted to draft.',
			'item_scheduled' => 'Tutorial scheduled.',
			'item_updated' => 'Tutorial updated.',
			'item_link' => 'Tutorial Link',
			'item_link_description' => 'A link to a tutorial.',
		),
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => false,
		'show_in_nav_menus' => false,
		'show_in_admin_bar' => false,
		'show_in_rest' => true,
		'rest_namespace' => 'mody/v2',
		'menu_icon' => 'dashicons-format-video',
		'supports' => array(
			0 => 'title',
			1 => 'editor',
			2 => 'thumbnail',
		),
		'rewrite' => array(
			'with_front' => false,
			'pages' => false,
		),
		'delete_with_user' => false,
	) );
} );

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key' => 'group_659fc8b21d85f',
		'title' => 'Tutorial fields',
		'fields' => array(
			array(
				'key' => 'field_659fc8b22718a',
				'label' => 'Video',
				'name' => 'video',
				'aria-label' => '',
				'type' => 'file',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'wpml_cf_preferences' => 1,
				'return_format' => 'url',
				'library' => 'all',
				'min_size' => '',
				'max_size' => '',
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'tutorial',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => true,
		'acfml_field_group_mode' => 'translation',
	) );
} );


