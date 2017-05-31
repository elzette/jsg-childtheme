<?php

/**
 * Register the widget areas enabled by default in Utility.
 *
 * @since  1.0.0
 *
 * @return string Markup for each sidebar ID
 */
function jsg_register_widget_areas() {

	$widget_areas = array(
		array(
			'id'          => 'jsg-home-welcome',
			'name'        => __( 'Home Welcome', 'utility-pro' ),
			'description' => __( 'This is the welcome section at the top of the home page.', 'utility-pro' ),
		),
		array(
			'id'          => 'jsg-home-about',
			'name'        => __( 'Home About', 'utility-pro' ),
			'description' => __( 'This is About section on the home page.', 'utility-pro' ),
		),
		array(
			'id'          => 'jsg-home-about-side',
			'name'        => __( 'Home About Side', 'utility-pro' ),
			'description' => __( 'This is About side section on the home page.', 'utility-pro' ),
		),
	);

	$widget_areas = apply_filters( 'utility_pro_default_widget_areas', $widget_areas );

	foreach ( $widget_areas as $widget_area ) {
		genesis_register_sidebar( $widget_area );
	}
}
