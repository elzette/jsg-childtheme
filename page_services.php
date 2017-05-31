<?php
/**
 * Template Name: Services
 */
 
add_action( 'genesis_meta', 'jsg_servicepage_setup' );

function jsg_servicepage_setup() {
	add_filter( 'body_class', 'utility_add_body_class' );
	add_action( 'genesis_before_footer', 'jsg_add_services_repeater', 1 );
}

// Add custom body class to the head
function utility_add_body_class( $classes ) {
   $classes[] = 'services';
   return $classes;
}

function jsg_add_services_repeater() {
	$rows = get_field('services');
	if($rows) {
		foreach($rows as $row) {
			echo '<section class="service-row"><div class="wrap">';
			echo '<h2 id="' . $row['id_for_header'] . '">' . $row['service_title'] . '</h2>';
			
			
			$image = wp_get_attachment_image_src( $row['service_project_image'], 'thumbnail');
			if ($image) {
				echo '<a href="' . $row['link_to_project'] . '" class="project-photo"><aside class="service-project"><figure>';
				echo '<img src="' . $image[0] . '" alt="' . $row['service_title'] . '">';
				echo '</figure><b>' . $row['service_project_name'] . '</b><br><em>' . $row['service_project_area'] . '</em></aside></a>';
			}
				
			echo '<div class="service-content">' . $row['service_content'] . '</div></div><!-- .wrap --></section><!-- .service-row -->';
		}
	}
}

//* Run the Genesis loop
genesis();
