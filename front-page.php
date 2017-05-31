<?php
/**
 * Front page
 */

add_action( 'genesis_meta', 'home_jsg_homepage_setup' );

function home_jsg_homepage_setup() {
	
	$home_sidebars = array(
		'jsg_home_welcome' 	   => is_active_sidebar( 'jsg-home-welcome' ),
		'jsg_home_about'   => is_active_sidebar( 'jsg-home-about' ),
	);

	// Return early if no sidebars are active
	if ( ! in_array( true, $home_sidebars ) ) {
		return;
	}

	// Get static home page number.
	$page = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;

	// Only show home page widgets on page 1.
	if ( 1 == $page ) {

		// Add home welcome area if "Home Welcome" widget area is active
		if ( $home_sidebars['jsg_home_welcome'] ) {
			add_action( 'genesis_after_header', 'jsg_add_home_welcome' );
		}

		// Add call to action area if "Call to Action" widget area is active
		if ( $home_sidebars['jsg_home_about'] ) {
			add_action( 'genesis_after_header', 'jsg_add_about_section' );
		}
	}
	
	add_action( 'genesis_after_header', 'jsg_add_services_section' );
	
	// Remove standard loop and replace with loop showing Posts, not Page content.
	remove_action( 'genesis_loop', 'genesis_do_loop' );
}

// Display content for the "Home Welcome" section
function jsg_add_home_welcome() {

	genesis_widget_area( 'jsg-home-welcome',
		array(
			'before' => '<div class="home-welcome"><div class="wrap">',
		)
	);
	
	global $post;
	// arguments, adjust as needed
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 4,
		'post_status'    => 'publish'	
	);
	/* 
	Overwrite $wp_query with our new query.
	The only reason we're doing this is so the pagination functions work,
	since they use $wp_query. If pagination wasn't an issue, 
	use: https://gist.github.com/3218106
	*/
	global $wp_query;
	$wp_query = new WP_Query( $args );
	if ( have_posts() ) : 
		echo '<div class="home-slider"><ul>';
		while ( have_posts() ) : the_post(); 
			$background = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'feature-large' ); ?>
			<li><figure class="featured-image" style="background-image: url('<?php echo $background[0]; ?>'); background-position: center;"></figure>
			<? foreach((get_the_category()) as $category) { 
				echo '<p class="project-info"><span class="service-name">' . $category->cat_name . '</span> <em>' . get_field('project_area') . ' </em> <a href="' . get_the_permalink() . '" alt="' .  get_the_title() . '" class="more-link">// View Project<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 7 12" xml:space="preserve"><path d="M0,0v3L3.5,6L0,9v3l7-6L0,0z"/></svg></a></p>'; 
			}
			echo '</figure></li>';
		endwhile;
		echo '</ul></div><!-- .home-slider -->';
	endif;
	wp_reset_query();
	
	echo '</div></div>';
}

// Display content for the "Home About" section
function jsg_add_about_section() {

	genesis_widget_area(
		'jsg-home-about',
		array(
			'before' => '<div class="home-about"><div class="wrap"><div class="home-about-content">',
			'after' => '</div><!-- .home-about-content -->',
		)
	);
	
	genesis_widget_area(
		'jsg-home-about-side',
		array(
			'before' => '<aside class="home-about-side">',
			'after' => '</aside></div><!-- .wrap --></div><!-- .home-about -->',
		)
	);
}

// Display services on the Home Page
function jsg_add_services_section() {
	echo '<div class="home-services"><div class="wrap"><h2>Our Services</h2><div class="services-content">';
	$rows = get_field('home_services', 'option');
	if($rows) {
		foreach($rows as $row) {
			$image = $row['home_service_images'];
			echo '<a href="' . site_url() . '/services/' . $row['button_link'] . '"><section><figure style="background-image: url(' . $image['sizes']['large'] . '); background-position: center;"></figure><h3><div class="button">' . $row['service_title'] . '</div></h3>';
			
			echo '</section></a>';
		}
	}
	echo '</div></div><!-- .wrap --></div><!-- .home-services -->';
}

genesis();
