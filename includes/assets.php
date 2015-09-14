<?php
/**
 * Theme Assets Loader
 *
 * @package 	WordPress
 * @subpackage 	Xeero WP Timber
 * @author  Dino Latoga <dinolatoga@outlook.com.au>
 * @since	0.2.0
 */

class Theme_Assets {

	function __construct() {
		// Load up the stylesheets
		add_action( 'wp_enqueue_scripts', array( $this, 'loadStyles' ) );

		// Call the scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'loadScripts' ) );

		// Instead of hiding the entire admin bar, we override the admin-bar's top margin
		add_action( 'wp_head', array( $this, 'disableAdminBarBump' ), 11 );

		// Call the Google Analytics tracking code
		//add_action( 'wp_footer', array( $this, 'loadGA' ) );
	}

	function loadStyles() {
		// Register the styles
		//wp_register_style( 'montserrat', 'http://fonts.googleapis.com/css?family=Montserrat:400,700', null, null );
		wp_register_style( 'main', get_stylesheet_directory_uri() . '/assets/build/css/styles.min.css', null, THEME_ASSET_VERSION );
		// Enqueue them
		//wp_enqueue_style('montserrat');
		wp_enqueue_style('main');
	}

	function loadScripts() {
		// Deregister the default libraries
		wp_deregister_script( 'jquery' );
		// use jQuery libs from Google CDN
		wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js', array(), null, true );
		// register global js
		wp_register_script( 'global', get_stylesheet_directory_uri() . '/assets/build/js/global.min.js', array('jquery'), THEME_ASSET_VERSION, true );
		// Enqueue the scripts
		//wp_enqueue_script( 'jquery' );
		//wp_enqueue_script( 'global' );
	}

	function loadGA() {
	?>
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', '<?php echo ANALYTICS_ID; ?>', 'auto');
	ga('send', 'pageview');

	</script>
	<?php
	}

	/**
	 * Override the top margin added by the WordPress admin bar
	 *
	 */
	function disableAdminBarBump() {
		if ( is_user_logged_in() ) {
		?>
		<style type="text/css">html { margin-top:0!important; }</style>
		<?php
		}
	}

}

new Theme_Assets();
