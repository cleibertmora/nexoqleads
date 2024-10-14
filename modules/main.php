<?php

function add_custom_menu_item() {
    // Parameters for add_menu_page:
    // page_title, menu_title, capability, menu_slug, function, icon_url, position
    add_menu_page(
        'NexoQ Tools',
        '+NexoQ Tools',
        'manage_options',
        'nexo-q-main',
        'nexo_q_tools_main_page',
        'dashicons-lightbulb',
        2
    );
}

add_action('admin_menu', 'add_custom_menu_item');

// Displaying the page content
function nexo_q_tools_main_page() {
    echo '<h1>NexoQ Tools</h1>';
    echo '<p>Hola Aquí administrarás el sitio :)</p>';
}