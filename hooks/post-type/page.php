<?php
// Agregar un grupo de campos
function add_custom_group_field_custom_post_type_page()
{
    acf_add_local_field_group(
        array(
            'key' => 'custom_fields_page_cta',
            'title' => 'Configuración CTA', // Título del grupo de campos
            'fields' => array(
                array(
                    'key' => 'setting_page_show_cta',
                    'label' => 'Mostrar CTA',
                    'name' => 'setting_page_show_cta',
                    'type' => 'true_false',
                    'required' => false,
                ),
                array(
                    'key' => 'setting_page_text_cta',
                    'label' => 'Texto CTA',
                    'name' => 'setting_page_text_cta',
                    'type' => 'text',
                    'required' => false,
                ),
                array(
                    'key' => 'setting_page_text_button_cta',
                    'label' => 'Texto Botón',
                    'name' => 'setting_page_text_button_cta',
                    'type' => 'text',
                    'required' => false,
                ),
                array(
                    'key' => 'setting_page_href_button_cta',
                    'label' => 'Acción del botón',
                    'name' => 'setting_page_href_button_cta',
                    'type' => 'text',
                    'required' => false,
                ),
                array(
                    'key' => 'setting_page_location_cta',
                    'label' => 'Ubicación',
                    'name' => 'setting_page_location_cta',
                    'type' => 'select',
                    'required' => false,
                    'default_value' => '',
                    'multiple' => '1',
                    'ui' => 'select2',
                    'choices' => array(
                        'inicio' => 'Inicio',
                        'mitad' => 'Mitad',
                        'final' => 'Final',
                    ),
                ),
                array(
                    'key' => 'setting_page_border_radius_cta',
                    'label' => 'Border radius',
                    'name' => 'setting_page_border_radius_cta',
                    'type' => 'text',
                    'required' => false,
                ),
                array(
                    'key' => 'setting_page_background_cta',
                    'label' => 'Color de fondo del texto',
                    'name' => 'setting_page_background_cta',
                    'type' => 'color_picker',
                    'required' => false,
                ),
                array(
                    'key' => 'setting_page_background_button_cta',
                    'label' => 'Color de fondo del boton',
                    'name' => 'setting_page_background_button_cta',
                    'type' => 'color_picker',
                    'required' => false,
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'page',
                    ),
                ),
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'post',
                    ),
                ),
            ),
            'position' => 'side',
        )
    );
}
add_action('acf/init', 'add_custom_group_field_custom_post_type_page');
