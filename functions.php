<?php
/**
 * Theme Functions
 *
 * @package 	WordPress
 * @subpackage 	Xeero WP
 * @author  Dino Latoga <dinolatoga@outlook.com>
 * @since	2014.07.07
 */

// Check if Timber Plugin is activated
if (!class_exists('Timber')) {
	add_action( 'admin_notices', function() {
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a></p></div>';
	});
	return;
}

// Use templates folder to store the templates
Timber::$dirname = array('templates', 'views');

/**
 * Constants
 *
 */
require_once(dirname(__FILE__).'/includes/constants.php');

/**
 * Implement Theme Setup Class
 *
 */
require_once(dirname(__FILE__).'/includes/theme-setup.php');

/**
 * Implement custom functions on Timber
 *
 */
require_once(dirname(__FILE__).'/includes/timber-setup.php');

/**
 * Enqueue scripts and styles.
 *
 */
require_once(dirname(__FILE__).'/includes/assets.php');

/**
 * Customizer
 *
 */
require_once(dirname(__FILE__).'/includes/customizer.php');
