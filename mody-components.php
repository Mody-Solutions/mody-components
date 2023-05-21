<?php
/**
 * Plugin Name: Mody Components
 * Description: Mody Solutions components.
 * Version:     1.0.0
 * Author:      phycticio
 * Author URI:  https://phycticio.com/
 * Text Domain: kink-advisor
 */

define('KINK_ADVISOR_PLUGIN_DIR', trailingslashit(__DIR__));

require_once KINK_ADVISOR_PLUGIN_DIR . 'includes/widgets/widgets.php';
require_once KINK_ADVISOR_PLUGIN_DIR . 'includes/wordpress/actions.php';
require_once KINK_ADVISOR_PLUGIN_DIR . 'includes/wordpress/filters.php';
