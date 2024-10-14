<?php

// Agregar una opción de menú en el lateral del panel de administración
function child_add_menu_page_config_emails()
{
    // Submenu for Config Emails
    add_submenu_page(
        'nexo-q-main', // Parent menu slug
        'Config Emails', // Page title
        'Config Email', // Menu title
        'manage_options', // Capability
        'page-config-emails', // Menu slug
        'child_render_page_customizable_config_emails' // Function to display the content
    );
}

add_action('admin_menu', 'child_add_menu_page_config_emails');

// Función que muestra el contenido de la página
function child_render_page_customizable_config_emails()
{

    // Procesar informacion de la seccion del elemento Sticky
    if (isset($_POST['submit_form_emails'])) {
        $fields = [
            'setting_email_admin_global',
            'setting_email_customer_global',
            'setting_emails_copy'
        ];

        foreach ($fields as $field) {
            update_option($field, $_POST[$field] ?? '');
        }

        // Mensaje de éxito
        echo '<div id="message" class="updated notice is-dismissible"><p>Guardado exitosamente.</p></div>';
    }

    ?>

    <div class="wrap">
        <h2 class="mb-3">Configuración</h2>

        <div>
            <form method="post" action="">

                <div class="row" style="--bs-gutter-y: 18px;">

                    <!-- Administrador de Correo -->
                    <div class="col-12 col-md-6">
                        <label for="setting_email_admin_global" class="form-label">Administrador de Correo</label>
                        <input type="email" class="form-control" id="setting_email_admin_global"
                            name="setting_email_admin_global" placeholder="Email Admin"
                            value="<?= get_option('setting_email_admin_global', ''); ?>">
                    </div>

                    <!-- Correo del Cliente Global -->
                    <div class="col-12 col-md-6">
                        <label for="setting_email_customer_global" class="form-label">Correo del Cliente Global</label>
                        <input type="email" class="form-control" id="setting_email_customer_global"
                            name="setting_email_customer_global" placeholder="Email para el cliente"
                            value="<?= get_option('setting_email_customer_global', ''); ?>">
                    </div>

                    <!-- Opciones de Copia (CC) -->
                    <div class="col-12 col-md-6">
                        <label for="setting_emails_copy" class="form-label">
                            Correos adiciones de copia
                            (separar por comas en caso de múltiples)
                        </label>
                        <input type="text" class="form-control" id="setting_emails_copy" name="setting_emails_copy"
                            placeholder="Copias" value="<?= get_option('setting_emails_copy', ''); ?>">
                    </div>

                </div>

                <!-- Guardar datos -->
                <div class="d-grid justify-content-center mt-5 submit">
                    <input class="btn btn-primary" type="submit" name="submit_form_emails" id="submit_form_emails"
                        value="Actualizar información" />
                </div>
            </form>
        </div>

        <?php
}

// Habilitar Bootstrap en panel admin
add_action('admin_enqueue_scripts', 'child_enqueue_scripts_page_config_config_emails');

function child_enqueue_scripts_page_config_config_emails()
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
    if ($_GET['page'] !== 'page-config-emails') {
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
    wp_enqueue_script('child_admin_scripts', get_stylesheet_directory_uri() . '/public/build/admin_child.js', ['jquery', 'wp-element'], '1.0.0', true);
}