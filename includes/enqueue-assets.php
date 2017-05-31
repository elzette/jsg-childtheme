<?php

add_action( 'wp_enqueue_scripts', 'jsg_enqueue_assets' );
/**
 * Enqueue theme assets.
 *
 * @since 1.0.0
 */
function jsg_enqueue_assets() {

	wp_enqueue_style( 'unslider-css', get_stylesheet_directory_uri() . '/css/unslider.css' );

	// Load mobile responsive menu
	wp_enqueue_script( 'utility-pro-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'unslider', get_stylesheet_directory_uri() . '/js/unslider.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'site-scripts', get_stylesheet_directory_uri() . '/js/sitescripts.js', array( 'jquery' ), false, true );

	$localize = array(
		'buttonText'     => __( 'Menu', 'utility-pro' ),
		'buttonLabel'    => __( 'Primary Navigation Menu', 'utility-pro' ),
		'subButtonText'  => __( 'Menu', 'utility-pro' ),
		'subButtonLabel' => __( 'Sub Navigation Menu', 'utility-pro' ),
	);

	// Localize the responsive menu script (for translation)
	wp_localize_script( 'utility-pro-responsive-menu', 'utilityResponsiveL10n', $localize );

	// Keyboard navigation (dropdown menus) script
	wp_enqueue_script( 'genwpacc-dropdown',  get_stylesheet_directory_uri() . '/js/genwpacc-dropdown.js', array( 'jquery' ), false, true );

	// Load skiplink scripts only if Genesis Accessible plugin is not active
	if ( ! utility_pro_genesis_accessible_is_active() ) {
		wp_enqueue_script( 'genwpacc-skiplinks-js',  get_stylesheet_directory_uri() . '/js/genwpacc-skiplinks.js', array(), '1.0.0', true );
	}

	// Load remaining scripts only if custom background is being used
	// and we're on the home page or a page using the landing page template
	if ( ! get_background_image() || ( !  ( is_front_page() || is_page_template( 'page_landing.php' ) ) ) ) {
		return;
	}

	wp_enqueue_script( 'utility-pro-backstretch', get_stylesheet_directory_uri() . '/js/backstretch.min.js', array( 'jquery' ), '2.0.1', true );
	wp_enqueue_script( 'utility-pro-backstretch-args', get_stylesheet_directory_uri() . '/js/backstretch.args.js', array( 'utility-pro-backstretch' ), CHILD_THEME_VERSION, true );

	wp_localize_script( 'utility-pro-backstretch-args', 'utilityBackstretchL10n', array( 'src' => get_background_image() ) );
}
