<?php

/**
 * This file contains elements for theme internationalization.
 *
 * @package Utility_Pro
 * @author Carrie Dils
 * @license GPL-2.0+
 *
 */

add_action( 'wp_enqueue_scripts', 'utility_pro_enqueue_fonts' );
/**
 * Load fonts.
 *
 * @since 1.0.0
 */
function utility_pro_enqueue_fonts() {
    wp_enqueue_style( 'utility-pro-fonts', utility_pro_fonts_url(), array(), null );
}

/**
 * Build Google fonts URL.
 *
 * This function enqueues Google fonts in such a way that translators can easily turn on/off
 * the fonts if they do not contain the necessary character sets. Hat tip to Frank Klein for
 * the tutorial.
 *
 * @link http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
 * @since  1.0.0
 */
function utility_pro_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by this font, translate this to 'off'. Do not translate
    * into your own language.
    */
    $oswald = _x( 'on', 'Oswald font: on or off', 'utility-pro' );

    /* Translators: If there are characters in your language that are not
    * supported by this font, translate this to 'off'. Do not translate
    * into your own language.
    */
    $roboto = _x( 'on', 'Roboto font: on or off', 'utility-pro' );

    if ( 'off' !== $oswald || 'off' !== $roboto ) {
        $font_families = array();

        if ( 'off' !== $oswald ) {
            $font_families[] = 'Oswald:300';
        }

        if ( 'off' !== $roboto ) {
            $font_families[] = 'Roboto:300,300i,700';
        }

        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );

        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
    }

    return $fonts_url;
}
