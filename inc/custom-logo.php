<?php


add_filter( 'get_custom_logo', 'change_logo_class' );

function change_logo_class( $html ) {

    // $html = str_replace( 'custom-logo', 'img-responsive', $html );
    $html = str_replace( 'img-responsive-link', 'ba-custom-logo-link', $html );

    return $html;
}