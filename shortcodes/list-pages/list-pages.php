<?php

function listar_paginas_shortcode($atts)
{
    // Extraer los atributos (argumentos) del shortcode
    $a = shortcode_atts(
        array(
            'excluir' => '',  // Si no se especifica el atributo 'excluir', será una cadena vacía por defecto
        ),
        $atts
    );

    // Convertir la cadena de IDs excluidos en un array
    $excluir_ids = !empty ($a['excluir']) ? explode(',', $a['excluir']) : array();

    $args = array(

        'post_type' => 'page',  // Estamos pidiendo páginas

        'post_status' => 'publish',  // Solo las páginas que están publicadas

        'posts_per_page' => -1,  // Todas las páginas

        'post__not_in' => $excluir_ids,  // Excluir páginas por ID

    );

    $query = new WP_Query($args);

    $output = '<div class="mi_wp_galeria">';

    while ($query->have_posts()) {

        $query->the_post();

        $output .= '<div class="mi_wp_galeria_pagina">';

        $output .= '<a class="mi_wp_pagina_link" href="' . get_permalink() . '">';

        $output .= get_the_post_thumbnail(null, 'medium'); // Asume que las páginas tienen imágenes destacadas. Ajusta el tamaño si es necesario.

        $output .= '<div class="nombre_pagina">' . get_the_title() . '</div>';

        $output .= '</a>';

        $output .= '</div>';

    }

    $output .= '</div>';

    // Restaurar la consulta original
    wp_reset_postdata();

    return $output;
}

add_shortcode('listar_paginas', 'listar_paginas_shortcode');