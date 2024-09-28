<?php

//----------------------------------------------------------------------------------------------

// UTILS
include_once 'utils/global.php';

// EMAILS TEMPLATES
include_once 'emails/register.php';

// SHORTCODES
include_once 'shortcodes/register.php';

// HOOKS
include_once 'hooks/register.php';

function astra_child_enqueue_styles()
{
    /* ------ Heredar del padre ------ */
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    /* ------ Estilos del hijo ------ */
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style'));


    /* ------ Globales y plugins ------ */
    wp_enqueue_style('child_bootstrap_css', get_stylesheet_directory_uri() . '/plugins/bootstrap/bootstrap.min.css', array(), '5.3.3');
    wp_enqueue_script('child_bootstrap_js', get_stylesheet_directory_uri() . '/plugins/bootstrap/bootstrap.bundle.min.js', array('jquery'), '5.3.3', true);
    wp_enqueue_script('child_theme_frontend_js', get_stylesheet_directory_uri() . '/public/build/frontend_child.js', array('jquery'), '', true);

    // Enviar variables
    wp_localize_script(
        'child_theme_frontend_js',
        'DATA_SETTINGS',
        [
            'site_url' => site_url(),
            'nonce' => wp_create_nonce('theme_child_astra_ajax_nonce'),
            'ajax_url' => admin_url('admin-ajax.php')
        ]
    );
}

// Agregar scripts y css
add_action('wp_enqueue_scripts', 'astra_child_enqueue_styles');


