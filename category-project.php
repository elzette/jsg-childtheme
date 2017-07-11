<?php
/**
 * JSG Construction.
 *
 * @package      jsg-childtheme
 * @author       Semblance
 */

add_action( 'genesis_before_loop', 'jsg_custom_loop', 1 );
/**
 * Initialise category posts.
 */
function jsg_custom_loop() {
	global $post;
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 1,
		'post_status'    => 'publish',
	);

	/*
	 * Overwrite $wp_query with our new query.
	 * The only reason we're doing this is so the pagination functions work,
	 * since they use $wp_query. If pagination wasn't an issue,
	 * use: https://gist.github.com/3218106
	*/
	global $wp_query;
	$wp_query = new WP_Query( $args );
	if ( have_posts() ) :
		echo '<div class="archive-single">';
		while ( have_posts() ) : the_post();
			$background = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'feature-large' ); ?>
			<figure class="featured-image" style="background-image: url('<?php echo esc_url( $background[0] ); ?>'); background-position: center;">
			<?php echo '</figure>' . get_the_post_navigation() . '<div class="wrap"><article class="post-' . esc_url( $post->ID ) . ' entry" itemscope="" itemtype="http://schema.org/CreativeWork">';
			echo '<header class="entry-header"><h1 class="entry-title" itemprop="headline">' . get_the_title() . '</h1></header><p class="project-info"><b>' . get_field( 'finished_date' ) . ' // </b> <em>' . get_field( 'project_area' ) . '</em></p>' . get_the_content() . '</article></div><!-- .wrap --></div><!-- .archive-single --><aside class="aside-gallery">';
			$architect = get_field( 'project_architect' );
			$egineer = get_field( 'project_engineer' );
			if ( $architect || $egineer ) {
				echo '<section class="project-meta">';
				if ( $architect ) {
					echo '<div><b>Architect</b><br>' . esc_html( $architect ) . '</div>';
				}
				if ( $egineer ) {
					echo '<div><b>Engineer</b><br>' . esc_html( $egineer ) . '</div>';
				}
				echo '</section>';
			}
			echo '<section class="project-gallery">' . get_field( 'project_gallery' ) . '</section>';
			echo '</aside>';
		endwhile;
	endif;
	wp_reset_query();
}

// * Remove the entry meta in the entry header
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

// * Remove the entry image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

// * Add Image, Post Info, Title, Excerpt & Entry Footer Entry Meta
add_action( 'genesis_entry_header', 'genesis_do_post_image', 2 );

// * Remove the entry footer markup (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta', 10 );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

// * Run the Genesis loop
genesis();
