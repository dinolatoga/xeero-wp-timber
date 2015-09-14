<?php
/**
 * SuperProxy Class
 */
class Xeero {
	/**
	 * Constructor
	 */
	function __construct() {
		// Register action/filter callbacks
		add_action('after_setup_theme', array($this, 'init'));
	}

	/**
	 * Theme setup
	 */
	function init() {
		// Enable support for Post Thumbnails
		add_theme_support('post-thumbnails');
		//add_theme_support('menus');
		// Register navigation menus
		register_nav_menus( array(
			'main_nav' => 'Main Navigation'
		) );

		// Let WordPress manage the document title - this means title tags in the template should be removed
		add_theme_support( 'title-tag' );

		// Setup the WordPress core custom background feature.
		add_theme_support( 'custom-background');
	}

	/**
	 * Filter callbacks
	 * ----------------
	 */


	/**
	 * Utility methods
	 * ---------------
	 */

	/**
	 * Get the category id from a category name
	 *
	 * @param string $cat_name The category name
	 * @return int The category ID
	 */
	function get_category_id ($cat_name) {
		$term = get_term_by('name', $cat_name, 'category');
		return $term->term_id;
	}
}

// Instantiate theme
$superproxy = new Xeero();
