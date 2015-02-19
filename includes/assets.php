<?php
/**
 * Theme Assets Loader
 *
 * @package 	WordPress
 * @subpackage 	Xeero WP Timber
 * @author  Dino Latoga <dinolatoga@outlook.com.au>
 * @since	0.2.0
 */

class Theme_Assets
{

	function __construct()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'loadStyles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'loadScripts' ) );
	}

	function loadStyles()
	{
		// Register the styles
		wp_register_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Oxygen:400,300,700', null, null );
		wp_register_style( 'main', get_stylesheet_directory_uri() . '/assets/css/styles.min.css', null, THEME_ASSET_VERSION );
		// Enqueue them
		wp_enqueue_style('google-fonts');
		wp_enqueue_style('main');
	}

	function loadScripts()
	{
		// Deregister the default libraries
		wp_deregister_script( 'jquery' );
		// use jQuery libs from Google CDN
		wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array(), null, true );
		// register global js
		wp_register_script( 'global', get_stylesheet_directory_uri() . '/assets/js/global.min.js', array('jquery'), THEME_ASSET_VERSION, true );
		// Enqueue the scripts
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'global' );
	}

}

new Theme_Assets();
