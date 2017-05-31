<?php

add_action( 'wp_enqueue_scripts', 'jsg_enqueue_assets' );
/**
 * Enqueue theme assets.
 */
function jsg_enqueue_assets() {
	
	wp_enqueue_style( 'jsg-google-fonts', 'http://fonts.googleapis.com/css?family=Oswald:300|Roboto:300,300i,700', false ); 
	wp_enqueue_style( 'unslider-css', get_stylesheet_directory_uri() . '/css/unslider.css' );

	// Load mobile responsive menu
	wp_enqueue_script( 'jsg-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'unslider', get_stylesheet_directory_uri() . '/js/unslider.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'site-scripts', get_stylesheet_directory_uri() . '/js/sitescripts.js', array( 'jquery' ), false, true );


	// Keyboard navigation (dropdown menus) script
	wp_enqueue_script( 'genwpacc-dropdown',  get_stylesheet_directory_uri() . '/js/genwpacc-dropdown.js', array( 'jquery' ), false, true );

	// Load skiplink scripts only if Genesis Accessible plugin is not active
	if ( ! utility_pro_genesis_accessible_is_active() ) {
		wp_enqueue_script( 'genwpacc-skiplinks-js',  get_stylesheet_directory_uri() . '/js/genwpacc-skiplinks.js', array(), '1.0.0', true );
	}

}
