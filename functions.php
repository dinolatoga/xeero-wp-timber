<?php
/**
 * Theme Functions
 *
 * @package 	WordPress
 * @subpackage 	Xeero WP
 * @author  Dino Latoga <dinolatoga@outlook.com>
 * @since	2014.07.07
 */

require_once(dirname(__FILE__).'/includes/constants.php');
require_once(dirname(__FILE__).'/includes/assets.php');
require_once(dirname(__FILE__).'/includes/helpers.php');

if (!class_exists('Timber')) {
	add_action( 'admin_notices', function() use ($text, $class){
		echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a></p></div>';
	});
	return;
}

class StarterSite extends TimberSite
{

	function __construct()
	{
		add_theme_support('post-formats');
		add_theme_support('post-thumbnails');
		add_theme_support('menus');
		add_filter('timber_context', array($this, 'add_to_context'));
		add_filter('get_twig', array($this, 'add_to_twig'));
		add_action('init', array($this, 'register_menus'));
		parent::__construct();
	}

	function register_menus ()
	{
		register_nav_menus( array(
			'main_nav' => 'Main Navigation'
		) );
	}

	function add_to_context($context)
	{
		if ( has_nav_menu( 'main_nav' ) )
			$context['main_nav'] = new TimberMenu('main_nav');
		// constants
		$context['asset_version'] = THEME_ASSET_VERSION;
		$context['css_dir'] = THEME_CSS;
		$context['js_dir'] = THEME_JS;
		$context['image_dir'] = THEME_IMAGES;

		$context['site'] = $this;

		return $context;
	}

	function add_to_twig($twig)
	{
		// this is where you can add your own fuctions to twig
		$twig->addExtension(new Twig_Extension_StringLoader());
		// $twig->addFunction('twig_call', new Twig_Function_Function('function_name'));

		return $twig;
	}

}

new StarterSite();
