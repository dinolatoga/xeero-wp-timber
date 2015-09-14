<?php
/**
 * Extend Timber Class and define own functions
 */
class StarterSite extends TimberSite {

	function __construct() {
		add_filter('timber_context', array($this, 'add_to_context'));
		add_filter('get_twig', array($this, 'add_to_twig'));
		parent::__construct();
	}

	function add_to_context($context) {
		if ( has_nav_menu( 'main_nav' ) ) {
			$context['main_nav'] = new TimberMenu('main_nav');
		}
		// constants
		$context['asset_version'] = THEME_ASSET_VERSION;
		$context['css_dir'] = THEME_CSS;
		$context['js_dir'] = THEME_JS;
		$context['image_dir'] = THEME_IMAGES;
		$context['site'] = $this;
		// fetch site icon if it is available
		if ( has_site_icon() ) {
			$context['site_icon'] = get_site_icon_url();
		}

		return $context;
	}

	function add_to_twig($twig) {
		// this is where you can add your own fuctions to twig
		$twig->addExtension(new Twig_Extension_StringLoader());
		// $twig->addFunction('twig_call', new Twig_Function_Function('function_name'));

		return $twig;
	}

}

new StarterSite();
