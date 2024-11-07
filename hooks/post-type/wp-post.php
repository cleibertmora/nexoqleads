<?php

function child_add_custom_content_cta_post($content)
{
    // Obtener el id del post
    global $post;
    $postId = $post->ID;

    // Obtener configuracion a nivel del postid
    $show = get_post_meta($postId, 'setting_page_show_cta', true);
    
    $renderCTA = '';
    $location = [];
    if ($show && $show === '1') {
        // Usar con prioridad datos del post
        $text = get_post_meta($postId, 'setting_page_text_cta', true);
        $textButton = get_post_meta($postId, 'setting_page_text_button_cta', true);
        $location = get_post_meta($postId, 'setting_page_location_cta', true);
        $radius = get_post_meta($postId, 'setting_page_border_radius_cta', true);
        $backgroundText = get_post_meta($postId, 'setting_page_background_cta', true);
        $backgroundButton = get_post_meta($postId, 'setting_page_background_button_cta', true);
        $hrefButton = get_post_meta($postId, 'setting_page_href_button_cta', true);

        if ($location === '') {
            $location = [];
        }

        if ($textButton === '') {
            $textButton = 'Más información';
        }


        // Obtener html a renderizar
        $renderCTA = child_render_content_cta($text, $textButton, $radius, $backgroundText, $backgroundButton, $hrefButton);
    } else {
        // Usar datos globales

        // Id para excluid
        $excluded = get_option('setting_excluded_cta', '');

        if (!$excluded) {
            $excluded = '';
        }

        // Lista de ids
        $list = explode(',', $excluded);

        // Validar si se debe omitir
        if (!in_array($postId, $list)) {
            $text = get_option('setting_text_cta', '');
            $textButton = get_option('setting_text_button_cta', 'Más información');
            $location = get_option('setting_location_cta', []);
            $radius = get_option('setting_border_radius_cta', '');
            $backgroundText = get_option('setting_background_cta', '');
            $backgroundButton = get_option('setting_background_button_cta', '');
            $hrefButton = get_option('setting_href_button_cta', '');

            if ($location === '') {
                $location = [];
            }

            if ($textButton === '') {
                $textButton = 'Más información';
            }

            // Obtener html a renderizar
            $renderCTA = child_render_content_cta($text, $textButton, $radius, $backgroundText, $backgroundButton, $hrefButton);
        }
    }

    $renderCustom = $content;
    foreach ($location as $loc) {
        switch ($loc) {
            case 'inicio': {
                $renderCustom = $renderCTA . $renderCustom;
                break;
            }
            case 'mitad': {
                // Dividir el contenido en dos partes                
                $closingTag = '</p>';
                $paragraphs = explode($closingTag, $renderCustom);

                // Mitad
                $half = floor(count($paragraphs) / 2);

                foreach ($paragraphs as $index => $paragraph) {

                    // Recuperar estructura del tag
                    if (trim($paragraph)) {
                        $paragraphs[$index] .= $closingTag;
                    }

                    // Validar si 
                    if ($half == $index + 1) {
                        $paragraphs[$index] .= $renderCTA;
                    }
                }

                $renderCustom = implode('', $paragraphs);

                break;
            }
            case 'final': {
                $renderCustom = $renderCustom . $renderCTA;
                break;
            }
        }
    }

    return $renderCustom;
}

// Agregar Hook
add_filter('the_content', 'child_add_custom_content_cta_post');


function child_render_content_cta($text, $textButton, $radius, $background, $backgroundButton, $hrefButton)
{
    if (!$radius) {
        $radius = '0px';
    } else if ($radius === '') {
        $radius = '0px';
    }

    $styleButton = [
        "border-radius: {$radius}",
        "--bs-btn-bg: {$backgroundButton}",
        "--bs-btn-hover-bg: {$backgroundButton}DB",
        "--bs-btn-border-color: {$backgroundButton}",
        "--bs-btn-hover-border-color: var(--bs-btn-border-color)",
        "--bs-btn-active-bg: var(--bs-btn-hover-bg)",
        "--bs-btn-active-border-color: var(--bs-btn-border-color)"
    ];

    $styleButton = implode(';', $styleButton);

    return <<<EOT
        <div class="container_cta mb-4">
            <p>
                {$text}
            </p>
            <div class="d-grid justify-content-center">
                <a class="btn btn-primary text-decoration-none px-5 py-2" href="{$hrefButton}" target="_blank" rel="noreferrer noopener" style="{$styleButton}">
                    {$textButton}
                </a>
            </div>
        </div>
   EOT;
}