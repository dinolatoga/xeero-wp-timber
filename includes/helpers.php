<?php
/**
 * Theme Helper Functions
 *
 * @package 	WordPress
 * @subpackage 	Xeero WP Theme
 * @author  Dino Latoga <dino@mapcreative.com.au>
 * @since	0.2.0
 */

class ThemeHelpers
{

	function __construct()
	{
		add_filter('wp_title', array($this, 'wp_title_for_home'));
	}

	// Fix empty homepage title
	function wp_title_for_home( $title )
	{
		if( empty( $title ) && ( is_home() || is_front_page() ) ) {
			return get_bloginfo( 'name' );
		}
		return $title;
	}

}

new ThemeHelpers();
