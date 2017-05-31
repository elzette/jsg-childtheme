<?php

function jsg_register_widget_areas() {

	$widget_areas = array(
		array(
			'id'          => 'jsg-home-welcome',
			'name'        => __( 'Home Welcome', 'jsg-theme' ),
			'description' => __( 'This is the welcome section at the top of the home page.', 'jsg-theme' ),
		),
		array(
			'id'          => 'jsg-home-about',
			'name'        => __( 'Home About', 'utility-pro' ),
			'description' => __( 'This is About section on the home page.', 'jsg-theme' ),
		),
		array(
			'id'          => 'jsg-home-about-side',
			'name'        => __( 'Home About Side', 'utility-pro' ),
			'description' => __( 'This is About side section on the home page.', 'jsg-theme' ),
		),
	);

	foreach ( $widget_areas as $widget_area ) {
		genesis_register_sidebar( $widget_area );
	}
}
