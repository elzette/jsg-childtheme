<?php
/**
 * JSG Construction.
 *
 * @package      jsg-childtheme
 * @author       Semblance
 */

add_action( 'genesis_meta', 'jsg_singlepage_setup' );
/**
 * Initialise JSG single page setup.
 */
function jsg_singlepage_setup() {

	// * Remove the entry meta in the entry header
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

	// * Remove the entry footer markup (requires HTML5 theme support)
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
	remove_action( 'genesis_entry_footer', 'genesis_post_meta', 10 );
	remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

	add_action( 'genesis_before_entry', 'jsg_single_featured_image', 1 );
	add_action( 'genesis_entry_content', 'jsg_single_meta_content', 1 );
	add_action( 'genesis_after_entry', 'jsg_single_gallery_content', 8 );
	add_action( 'genesis_after_entry', 'jsg_archive_content', 15 );
}

/**
 * Add big background image at top.
 */
function jsg_single_featured_image() {
	$background = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'feature-large' ); ?>
	<div class="archive-single">
	<figure class="featured-image" style="background-image: url('<?php echo esc_url( $background[0] ); ?>'); background-position: center;"></figure>
	<?php the_post_navigation();
	echo '<div class="wrap">';
}

/**
 * Adding custom meta content for single post.
 */
function jsg_single_meta_content() {
	echo '<p class="project-info"><b>' . get_field( 'finished_date' ) . ' // </b> <em>' . get_field( 'project_area' ) . '</em></p>';
}

/**
 * Adding custom gallery content for single post.
 */
function jsg_single_gallery_content() {
	echo '</div><!-- .wrap --></div><!-- .archive-single --><div class="wrap archive-content"><aside class="aside-gallery">';
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
}

/**
 * Settings for archive list on single page.
 */
function jsg_archive_content() {
	global $post;
	// * arguments, adjust as needed
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 30,
		'post_status'    => 'publish',
	);

	/**
	 * Overwrite $wp_query with our new query.
	 * The only reason we're doing this is so the pagination functions work,
	 * since they use $wp_query. If pagination wasn't an issue,
	 * use: https://gist.github.com/3218106
	*/
	global $wp_query;
	$wp_query = new WP_Query( $args );
	if ( have_posts() ) :
		echo '<aside class="aside-archive">';
		echo '<div class="archive-description"><h1 class="archive-title">More Projects</h1></div>';
		while ( have_posts() ) : the_post();
			echo '<article class="post-' . esc_attr( $post->ID ) . ' entry" itemscope="" itemtype="http://schema.org/CreativeWork">';
			echo '<a class="entry-image-link" href="' . get_the_permalink() . '" aria-hidden="true">';
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'feature-archive' );
			}
			echo '</a>';
			echo '<h2 class="entry-title" itemprop="headline"><a class="entry-image-link" href="' . get_the_permalink() . '" aria-hidden="true" rel="bookmark">' . get_the_title() . '</a></h2>';
			echo '</article>';
		endwhile;
	endif;
	echo '</aside><!-- .aside-archive --></div><!-- .archive-content -->';
	wp_reset_query();
}

genesis();
