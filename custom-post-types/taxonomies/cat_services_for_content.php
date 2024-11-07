<?php

function create_servicios_taxonomy() {
    $labels = array(
        'name'              => _x( 'Servicios', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Servicio', 'taxonomy singular name', 'textdomain' ),
        'menu_name'         => __( 'Servicio', 'textdomain' ),
    );

    $args = array(
        'hierarchical'      => true, // Set this to 'true' for hierarchical taxonomy (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'servicio' ),
    );

    register_taxonomy( 'servicios', array( 'post', 'page' ), $args );
}

add_action( 'init', 'create_servicios_taxonomy', 0 );