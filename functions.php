<?php

// Load internationalization components
// English users do not need to load the text domain and can comment out or remove
load_child_theme_textdomain( 'utility-pro', get_stylesheet_directory() . '/languages' );

// This file loads the Google fonts used in this theme
require get_stylesheet_directory() . '/includes/google-fonts.php';

// This file contains search form improvements
require get_stylesheet_directory() . '/includes/class-search-form.php';

add_action( 'genesis_setup', 'utility_pro_setup', 15 );
/**
 * Theme setup.
 *
 * Attach all of the site-wide functions to the correct hooks and filters. All
 * the functions themselves are defined below this setup function.
 *
 * @since 1.0.0
 */
function utility_pro_setup() {

	// Add HTML5 markup structure
	add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

	// Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );

	// Add support for custom background
	add_theme_support( 'custom-background', array( 'wp-head-callback' => '__return_false' ) );

	// Add support for three footer widget areas
	add_theme_support( 'genesis-footer-widgets', 1 );

	// Add support for structural wraps (all default Genesis wraps unless noted)
	add_theme_support(
		'genesis-structural-wraps',
		array(
			'footer',
			'footer-widgets',
			'footernav', // Custom
			'menu-footer', // Custom
			'header',
			'home-gallery', // Custom
			'nav',
			'site-inner',
			'site-tagline',
		)
	);

	// Add support for two navigation areas (theme doesn't use secondary navigation)
	add_theme_support(
		'genesis-menus',
		array(
			'primary'   => __( 'Primary Navigation Menu', 'utility-pro' ),
			'footer'    => __( 'Footer Navigation Menu', 'utility-pro' ),
		)
	);
	
	//* Reposition the primary navigation menu
	remove_action( 'genesis_after_header', 'genesis_do_nav' );
	add_action( 'genesis_header', 'genesis_do_nav', 12 );

	// Add custom image sizes
	add_image_size( 'feature-large', 1400, 740, true );
	add_image_size( 'slider-large', 800, 540, true );
	add_image_size( 'feature-archive', 523, 250, true );

	// Unregister secondary sidebar
	unregister_sidebar( 'sidebar-alt' );

	// Unregister layouts that use secondary sidebar
	genesis_unregister_layout( 'content-sidebar-sidebar' );
	genesis_unregister_layout( 'sidebar-content-sidebar' );
	genesis_unregister_layout( 'sidebar-sidebar-content' );

	// Register the default widget areas
	jsg_register_widget_areas();
	
	// Add featured image above page
	add_action( 'genesis_before_entry', 'featured_page_image', 8 );

	// Add a navigation area above the site footer
	add_action( 'genesis_before_footer', 'utility_pro_do_footer_nav' );

	// Remove Genesis archive pagination (Genesis pagination settings still apply)
	remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );

	// Add WordPress archive pagination (accessibility)
	add_action( 'genesis_after_endwhile', 'utility_pro_post_pagination' );

	// Load accesibility components if the Genesis Accessible plugin is not active
	if ( ! utility_pro_genesis_accessible_is_active() ) {

		// Load skip links (accessibility)
		include get_stylesheet_directory() . '/includes/skip-links.php';
	}

	// Apply search form enhancements (accessibility)
	add_filter( 'get_search_form', 'utility_pro_get_search_form', 25 );

	// Load files in admin
	if ( is_admin() ) {

		// Add suggested plugins nag
		include get_stylesheet_directory() . '/includes/suggested-plugins.php';
	}
}

function featured_page_image() {
  if ( ! is_page() )  return;
  	echo '<figure class="featured-image">';
	the_post_thumbnail('post-image');
	echo '</figure>';
}

add_filter( 'genesis_footer_creds_text', 'utility_pro_footer_creds' );
/**
 * Change the footer text.
 *
 * @since  1.0.0
 *
 * @return null Return early if not a single post or post does not have thumbnail.
 */
function utility_pro_footer_creds( $creds ) {
	return '<p>Copyright &copy; ' . date("Y") . ' &#8226; JSG Construction</p><p>All content and photography are owned by JSG Construction. All rights reserved.</p>';
}

add_filter( 'genesis_author_box_gravatar_size', 'utility_pro_author_box_gravatar_size' );
/**
 * Customize the Gravatar size in the author box.
 *
 * @since 1.0.0
 *
 * @return integer Pixel size of gravatar.
 */
function utility_pro_author_box_gravatar_size( $size ) {
	return 96;
}

// Add theme widget areas
include get_stylesheet_directory() . '/includes/widget-areas.php';

// Add footer navigation components
include get_stylesheet_directory() . '/includes/footer-nav.php';

// Add scripts to enqueue
include get_stylesheet_directory() . '/includes/enqueue-assets.php';

// Miscellaenous functions used in theme configuration
include get_stylesheet_directory() . '/includes/theme-config.php';

// Login logo
function custom_loginlogo() {
echo '<style type="text/css">
#login h1 a {background-image: url('.get_bloginfo('stylesheet_directory').'/images/login_logo.png) !important; }
</style>';
}
add_action('login_head', 'custom_loginlogo');
