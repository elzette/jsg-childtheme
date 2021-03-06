<?php
/**
 * JSG Construction.
 *
 * @package      jsg-childtheme
 * @author       Semblance
 */

add_action( 'genesis_meta', 'jsg_servicepage_setup' );
/**
 * Initialise JSG service page setup.
 */
function jsg_servicepage_setup() {
	add_filter( 'body_class', 'jsg_add_body_class' );
	add_action( 'genesis_before_footer', 'jsg_add_services_repeater', 1 );
}

/**
 * Add custom body class to the head.
 *
 * @param type $classes Add class to body.
 */
function jsg_add_body_class( $classes ) {
	$classes[] = 'services';
	return $classes;
}

/**
 * List services as repeater.
 */
function jsg_add_services_repeater() {
	$rows = get_field( 'services' );
	if ( $rows ) {
		foreach ( $rows as $row ) {
			echo '<section class="service-row"><div class="wrap">';
			echo '<h2 id="' . esc_attr( $row['id_for_header'] ) . '">' . esc_html( $row['service_title'] ) . '</h2>';

			$image = wp_get_attachment_image_src( $row['service_project_image'], 'thumbnail' );
			if ( $image ) {
				echo '<a href="' . esc_url( $row['link_to_project'] ) . '" class="project-photo"><aside class="service-project"><figure>';
				echo '<img src="' . esc_url( $image[0] ) . '" alt="' . esc_attr( $row['service_title'] ) . '">';
				echo '</figure><b>' . esc_html( $row['service_project_name'] ) . '</b><br><em>' . esc_html( $row['service_project_area'] ) . '</em></aside></a>';
			}

			echo '<div class="service-content">' . esc_html( $row['service_content'] ) . '</div></div><!-- .wrap --></section><!-- .service-row -->';
		}
	}
}

genesis();
