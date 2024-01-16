<?php

namespace mody;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use WpOrg\Requests\Exception;

/**
 * Plugin Name: Mody Solutions
 */

define( 'MODY_PLUGIN_VER', '1.0.0' );
define( 'MODY_PLUGIN_DIR_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'MODY_PLUGIN_DIR_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'MODY_PLUGIN_DIST_DIR', trailingslashit( MODY_PLUGIN_DIR_URL . 'dist' ) );

require_once MODY_PLUGIN_DIR_PATH . 'vendor/autoload.php';

foreach(glob(MODY_PLUGIN_DIR_PATH . 'src/modules/*.php') as $php_file) {
	if(file_exists($php_file)) {
		require_once $php_file;
	}
}

/**
 * @param string $template
 * @param array $data
 *
 * @return string
 */
function load_template( string $template, array $data = [] ): string {
	$loader = new \Twig\Loader\FilesystemLoader( MODY_PLUGIN_DIR_PATH . 'src/views' );
	$twig   = new \Twig\Environment( $loader, [
		'cache'       => MODY_PLUGIN_DIR_PATH . 'cache/',
		'auto_reload' => true,
		'debug'       => true,
	] );
	try {
		$template = $twig->load( "{$template}.html" );

		return $template->render( $data );
	} catch ( Exception|LoaderError|RuntimeError|SyntaxError $e ) {
		return $e->getMessage();
	}
}