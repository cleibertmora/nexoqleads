<?php
// Agregar una opción de menú en el lateral del panel de administración
function child_add_menu_page_cta()
{
    // Submenu for CTA
    add_submenu_page(
        'nexo-q-main', // Parent menu slug
        'CTAs', // Page title
        'CTA', // Menu title
        'manage_options', // Capability
        'page-cta', // Menu slug
        'child_render_page_customizable_cta' // Function to display the content
    );
}

add_action('admin_menu', 'child_add_menu_page_cta');

// Función que muestra el contenido de la página
function child_render_page_customizable_cta()
{

    // Procesar informacion de la seccion del elemento Sticky
    if (isset($_POST['submit_form_cta'])) {
        $fields = [
            'setting_text_cta',
            'setting_text_button_cta',
            'setting_location_cta',
            'setting_excluded_cta',
            'setting_border_radius_cta',
            'setting_background_cta',
            'setting_background_button_cta',
            'setting_href_button_cta'
        ];

        foreach ($fields as $field) {
            update_option($field, $_POST[$field] ?? '');
        }

        // Mensaje de éxito
        echo '<div id="message" class="updated notice is-dismissible"><p>Guardado exitosamente.</p></div>';
    }


    // Ubicaciones seleccionadas
    $locations = get_option('setting_location_cta', []);
    if ($locations === '') {
        $locations = [];
    }

    ?>

    <div class="wrap">
        <h2>Configuración</h2>

        <div>
            <form method="post" action="">
                <h5 class="my-3">General</h5>

                <div class="row" style="--bs-gutter-y: 18px;">

                    <!-- Texto CTA -->
                    <div class="col-12 col-md-6">
                        <label for="setting_text_cta" class="form-label">Texto CTA</label>
                        <input type="text" class="form-control" id="setting_text_cta" name="setting_text_cta"
                            placeholder="CTA" value="<?= get_option('setting_text_cta', ''); ?>">
                    </div>

                    <!-- Texto Boton -->
                    <div class="col-12 col-md-6">
                        <label for="setting_text_button_cta" class="form-label">Texto Botón</label>
                        <input type="text" class="form-control" id="setting_text_button_cta" name="setting_text_button_cta"
                            placeholder="Más información" value="<?= get_option('setting_text_button_cta', ''); ?>">
                    </div>

                    <!-- Ubicacion -->
                    <div class="col-12 col-md-6 d-grid">
                        <label for="setting_location_cta" class="form-label">Ubicación</label>
                        <select class="form-select setting_location_cta" id="setting_location_cta"
                            name="setting_location_cta[]" multiple style="width: 100%;">
                            <option value="inicio" <?= in_array('inicio', $locations) ? 'selected' : '' ?>>Inicio</option>
                            <option value="mitad" <?= in_array('mitad', $locations) ? 'selected' : '' ?>>Mitad</option>
                            <option value="final" <?= in_array('final', $locations) ? 'selected' : '' ?>>Final</option>
                        </select>
                    </div>

                    <!-- Exclusion -->
                    <div class="col-12 col-md-6">
                        <label for="setting_excluded_cta" class="form-label">Exclusión de Posts</label>
                        <input type="text" class="form-control" id="setting_excluded_cta" name="setting_excluded_cta"
                            placeholder="..." value="<?= get_option('setting_excluded_cta', ''); ?>">
                    </div>

                    <!-- Redireccion -->
                    <div class="col-12 col-md-6">
                        <label for="setting_href_button_cta" class="form-label">Acción del botón</label>
                        <input type="text" class="form-control" id="setting_href_button_cta" name="setting_href_button_cta"
                            placeholder="http" value="<?= get_option('setting_href_button_cta', ''); ?>">
                    </div>

                    <h5 class="mb-0">Personalización visual</h5>

                    <!-- Border radius -->
                    <div class="col-12 col-md-6">
                        <label for="setting_border_radius_cta" class="form-label">Border radius</label>
                        <input type="text" class="form-control" id="setting_border_radius_cta"
                            name="setting_border_radius_cta" placeholder="0px"
                            value="<?= get_option('setting_border_radius_cta', ''); ?>">
                    </div>

                    <!-- Color -->
                    <div class="col-12 col-md-12 d-grid">
                        <label for="setting_background_cta" class="form-label">Color de fondo del texto</label>
                        <input type="text" id="setting_background_cta" class="color_picker form-control"
                            name="setting_background_cta" value="<?= get_option('setting_background_cta', ''); ?>">
                    </div>

                    <!-- Color -->
                    <div class="col-12 col-md-12 d-grid">
                        <label for="setting_background_button_cta" class="form-label">Color de fondo del boton</label>
                        <input type="text" id="setting_background_button_cta" class="color_picker form-control"
                            name="setting_background_button_cta"
                            value="<?= get_option('setting_background_button_cta', ''); ?>">
                    </div>

                </div>

                <!-- Guardar datos -->
                <div class="d-grid justify-content-center mt-5 submit">
                    <input class="btn btn-primary" type="submit" name="submit_form_cta" id="submit_form_cta"
                        value="Actualizar información" />
                </div>
            </form>
        </div>

        <?php
}



// Habilitar Bootstrap en panel admin
add_action('admin_enqueue_scripts', 'child_enqueue_scripts_page_config_cta');

function child_enqueue_scripts_page_config_cta()
{
    // Validar si es admin
    if (!is_admin()) {
        return;
    }

    // Validar si no existen datos del post type o la pagina
    if (!isset($_GET['page'])) {
        return;
    }

    // Validar si no esta en el custom post type o en la pagina
    if ($_GET['page'] !== 'page-cta') {
        return;
    }

    // Validar para cargar el plugin
    if (!did_action('wp_enqueue_media')) {
        wp_enqueue_media();
    }

    // Hacer cargar de css y js
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('child_bootstrap_css', get_stylesheet_directory_uri() . '/src/plugins/bootstrap/bootstrap.min.css', array(), '5.3.3');
    wp_enqueue_style('child_admin_css', get_stylesheet_directory_uri() . '/src/css/admin.css', array(), '');
    wp_enqueue_script('child_bootstrap_scripts', get_stylesheet_directory_uri() . '/src/plugins/bootstrap/bootstrap.bundle.min.js', ['jquery', 'wp-element'], '1.0.0', true);
    wp_enqueue_script('child_admin_scripts', get_stylesheet_directory_uri() . '/public/build/admin_child.js', ['jquery', 'wp-element', 'wp-color-picker'], '1.0.0', true);
    wp_enqueue_script('child_select2', get_stylesheet_directory_uri() . '/src/plugins/select2/select2.min.js', ['jquery', 'wp-element'], '1.0.0', true);
    wp_enqueue_style('child_select2_css', get_stylesheet_directory_uri() . '/src/plugins/select2/select2.min.css', array(), '');

}