<?php
// Agregar una opción de menú en el lateral del panel de administración
function child_add_menu_page_form_lead()
{
    add_menu_page(
        'Configuracion Formulario', // Título de la página
        'Formulario Lead', // Texto del menú
        'manage_options', // Capacidad requerida
        'page-form-lead', // Identificador único del menú
        'child_render_page_customizable_attr', // Función que muestra el contenido de la página
        'dashicons-media-document' // Ícono
    );
}

add_action('admin_menu', 'child_add_menu_page_form_lead');

// Función que muestra el contenido de la página
function child_render_page_customizable_attr()
{

    // Procesar informacion de la seccion del elemento Sticky
    if (isset($_POST['submit_sticky'])) {
        $fields = ['setting_image_sticky_element_lead'];

        foreach ($fields as $field) {
            update_option($field, $_POST[$field] ?? '');
        }

        // Mensaje de éxito
        echo '<div id="message" class="updated notice is-dismissible"><p>Guardado exitosamente.</p></div>';
    }

    // Procesar informacion de la seccion del Formulario Lead
    if (isset($_POST['submit_form_lead'])) {
        $fields = [
            'setting_title_introduction_lead',
            'setting_text_button_introduction_lead',
            'setting_descrption_introduction_lead',
            'setting_title_services_lead',
            'setting_text_button_services_lead',
            'setting_descrption_services_lead',
            'setting_title_recolect_data_lead',
            'setting_text_button_recolect_data_lead',
            'setting_descrption_recolect_data_lead',
            'setting_title_confirmation_lead',
            'setting_text_button_confirmation_lead',
            'setting_descrption_confirmation_lead'
        ];

        foreach ($fields as $field) {
            update_option($field, $_POST[$field] ?? '');
        }

        // Mensaje de éxito
        echo '<div id="message" class="updated notice is-dismissible"><p>Guardado exitosamente.</p></div>';
    }

    // Procesar informacion de la seccion de Legales
    if (isset($_POST['submit_form_legales'])) {
        $fields = ['setting_habeas_data'];

        foreach ($fields as $field) {
            update_option($field, $_POST[$field] ?? '');
        }

        // Mensaje de éxito
        echo '<div id="message" class="updated notice is-dismissible"><p>Guardado exitosamente.</p></div>';
    }
    ?>

    <div class="wrap">
        <h2>Configuración</h2>

        <div>
            <!-- TABS -->
            <ul class="nav nav-tabs my-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="sticky_element_tab" data-bs-toggle="pill"
                        data-bs-target="#content_sticky_element" type="button" role="tab"
                        aria-controls="content_sticky_element" aria-selected="true">
                        Boton Sticky
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="form_lead_tab" data-bs-toggle="pill"
                        data-bs-target="#content_form_general_lead" type="button" role="tab"
                        aria-controls="content_form_general_lead" aria-selected="false">
                        Formulario Lead
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="form_legales_tab" data-bs-toggle="pill"
                        data-bs-target="#content_form_legales_lead" type="button" role="tab"
                        aria-controls="content_form_legales_lead" aria-selected="false">
                        Legales
                    </button>
                </li>
            </ul>

            <!-- CONTENIDO TABS -->
            <div class="tab-content" id="pills-tabContent">

                <!-- CONTENIDO PARA EL TAB DE BOTON STICKY -->
                <div class="tab-pane fade show active" id="content_sticky_element" role="tabpanel"
                    aria-labelledby="sticky_element_tab" tabindex="0">
                    <form method="post" action="">
                        <div class="row">
                            <div class="col-6">
                                <div class="container_upload_image">
                                    <label for="upload_sticky" class="form-label">Imagen para el boton</label>

                                    <?php if ($image = wp_get_attachment_image_url(get_option('setting_image_sticky_element_lead'), 'medium')): ?>

                                        <!-- Preview de la image -->
                                        <button class="upload_single_image border-0">
                                            <img src="<?= esc_url($image) ?>" class="img-fluid image_preview_upload" />
                                        </button>

                                        <!-- Eliminar imagen -->
                                        <a href="#" class="upload_single_remove">Remove Image</a>

                                        <!-- Campo oculto -->
                                        <input type="hidden" name="setting_image_sticky_element_lead"
                                            value="<?= get_option('setting_image_sticky_element_lead') ?>">

                                    <?php else: ?>
                                        <!-- Configurar imagen -->
                                        <button href="#"
                                            class="btn btn-outline-primary d-flex align-items-center gap-2 upload_single_image">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                class="bi bi-upload" viewBox="0 0 16 16">
                                                <path
                                                    d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5" />
                                                <path
                                                    d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708z" />
                                            </svg>
                                            Subir imagen
                                        </button>

                                        <!-- Eliminar imagen -->
                                        <a href="#" class="upload_single_remove" style="display:none">Remove Logo</a>

                                        <!-- Campo oculto -->
                                        <input type="hidden" name="setting_image_sticky_element_lead" value="null">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Guardar datos -->
                        <div class="d-grid justify-content-center mt-5 submit">
                            <input class="btn btn-primary" type="submit" name="submit_sticky" id="submit_sticky"
                                value="Actualizar información"></input>
                        </div>
                    </form>
                </div>

                <!-- CONTENIDO PARA EL TAB DE FORMULARIO LEAD -->
                <div class="tab-pane fade" id="content_form_general_lead" role="tabpanel" aria-labelledby="form_lead_tab"
                    tabindex="1">

                    <form method="post" action="">
                        <!-- ACCORDION -->
                        <div class="accordion" id="accordion_config_lead">

                            <!-- INTRODUCCION -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        INTRODUCCION
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordion_config_lead">
                                    <div class="accordion-body">
                                        <div class="row">

                                            <!-- TITULO -->
                                            <div class="col-12 col-md-6">
                                                <label for="setting_title_introduction_lead"
                                                    class="form-label">Título</label>
                                                <input type="text" class="form-control" id="setting_title_introduction_lead"
                                                    name="setting_title_introduction_lead" placeholder="Bienvenido"
                                                    value="<?= get_option('setting_title_introduction_lead', ''); ?>">
                                            </div>

                                            <!-- MENSAJE DEL BOTON -->
                                            <div class="col-12 col-md-6">
                                                <label for="setting_text_button_introduction_lead" class="form-label">Texto
                                                    del botón</label>
                                                <input type="text" class="form-control"
                                                    id="setting_text_button_introduction_lead"
                                                    name="setting_text_button_introduction_lead" placeholder="Siguiente"
                                                    value="<?= get_option('setting_text_button_introduction_lead', ''); ?>">
                                            </div>

                                            <!-- CONTENIDO -->
                                            <div class="col-12 mt-3">
                                                <label for="setting_descrption_introduction_lead"
                                                    class="form-label">Descripción</label>
                                                <?= wp_editor(get_option('setting_descrption_introduction_lead', ''), "setting_descrption_introduction_lead", [
                                                    'tinymce' => array(
                                                        'height' => 200
                                                    ),
                                                    'media_buttons' => false,
                                                    // This setting removes the media button.
                                                    'textarea_name' => "setting_descrption_introduction_lead",
                                                    // Set custom name.
                                                    'textarea_rows' => 10,
                                                    //Determine the number of rows.
                                                    'quicktags' => false,
                                                    // Remove view as HTML button.
                                                ]); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SELECCIÓN DE SERVICIOS -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        SELECCIÓN DE SERVICIOS
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordion_config_lead">
                                    <div class="accordion-body">
                                        <div class="row">

                                            <!-- TITULO -->
                                            <div class="col-12 col-md-6">
                                                <label for="setting_title_services_lead" class="form-label">Título</label>
                                                <input type="text" class="form-control" id="setting_title_services_lead"
                                                    name="setting_title_services_lead" placeholder="Bienvenido"
                                                    value="<?= get_option('setting_title_services_lead', ''); ?>">
                                            </div>

                                            <!-- MENSAJE DEL BOTON -->
                                            <div class="col-12 col-md-6">
                                                <label for="setting_text_button_services_lead" class="form-label">Texto del
                                                    botón</label>
                                                <input type="text" class="form-control"
                                                    id="setting_text_button_services_lead"
                                                    name="setting_text_button_services_lead" placeholder="Siguiente"
                                                    value="<?= get_option('setting_text_button_services_lead', ''); ?>">
                                            </div>

                                            <!-- CONTENIDO -->
                                            <div class="col-12 mt-3">
                                                <label for="setting_descrption_services_lead"
                                                    class="form-label">Descripción</label>
                                                <?= wp_editor(get_option('setting_descrption_services_lead', ''), "setting_descrption_services_lead", [
                                                    'tinymce' => array(
                                                        'height' => 200
                                                    ),
                                                    'media_buttons' => false,
                                                    // This setting removes the media button.
                                                    'textarea_name' => "setting_descrption_services_lead",
                                                    // Set custom name.
                                                    'textarea_rows' => 10,
                                                    //Determine the number of rows.
                                                    'quicktags' => false,
                                                    // Remove view as HTML button.
                                                ]); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- RECOLECCIÓN DE DATOS -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        RECOLECCIÓN DE DATOS
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordion_config_lead">
                                    <div class="accordion-body">
                                        <div class="row">

                                            <!-- TITULO -->
                                            <div class="col-12 col-md-6">
                                                <label for="setting_title_recolect_data_lead"
                                                    class="form-label">Título</label>
                                                <input type="text" class="form-control"
                                                    id="setting_title_recolect_data_lead"
                                                    name="setting_title_recolect_data_lead" placeholder="Bienvenido"
                                                    value="<?= get_option('setting_title_recolect_data_lead', ''); ?>">
                                            </div>

                                            <!-- MENSAJE DEL BOTON -->
                                            <div class="col-12 col-md-6">
                                                <label for="setting_text_button_recolect_data_lead" class="form-label">Texto
                                                    del
                                                    botón</label>
                                                <input type="text" class="form-control"
                                                    id="setting_text_button_recolect_data_lead"
                                                    name="setting_text_button_recolect_data_lead" placeholder="Siguiente"
                                                    value="<?= get_option('setting_text_button_recolect_data_lead', ''); ?>">
                                            </div>

                                            <!-- CONTENIDO -->
                                            <div class="col-12 mt-3">
                                                <label for="setting_descrption_recolect_data_lead"
                                                    class="form-label">Descripción</label>
                                                <?= wp_editor(get_option('setting_descrption_recolect_data_lead', ''), "setting_descrption_recolect_data_lead", [
                                                    'tinymce' => array(
                                                        'height' => 200
                                                    ),
                                                    'media_buttons' => false,
                                                    // This setting removes the media button.
                                                    'textarea_name' => "setting_descrption_recolect_data_lead",
                                                    // Set custom name.
                                                    'textarea_rows' => 10,
                                                    //Determine the number of rows.
                                                    'quicktags' => false,
                                                    // Remove view as HTML button.
                                                ]); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- CONFIRMACIÓN -->
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        CONFIRMACIÓN
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    data-bs-parent="#accordion_config_lead">
                                    <div class="accordion-body">
                                        <div class="row">

                                            <!-- TITULO -->
                                            <div class="col-12 col-md-6">
                                                <label for="setting_title_confirmation_lead"
                                                    class="form-label">Título</label>
                                                <input type="text" class="form-control" id="setting_title_confirmation_lead"
                                                    name="setting_title_confirmation_lead" placeholder="Bienvenido"
                                                    value="<?= get_option('setting_title_confirmation_lead', ''); ?>">
                                            </div>

                                            <!-- MENSAJE DEL BOTON -->
                                            <div class="col-12 col-md-6">
                                                <label for="setting_text_button_confirmation_lead" class="form-label">Texto
                                                    del
                                                    botón</label>
                                                <input type="text" class="form-control"
                                                    id="setting_text_button_confirmation_lead"
                                                    name="setting_text_button_confirmation_lead" placeholder="Siguiente"
                                                    value="<?= get_option('setting_text_button_confirmation_lead', ''); ?>">
                                            </div>

                                            <!-- CONTENIDO -->
                                            <div class="col-12 mt-3">
                                                <label for="setting_descrption_confirmation_lead"
                                                    class="form-label">Descripción</label>
                                                <?= wp_editor(get_option('setting_descrption_confirmation_lead', ''), "setting_descrption_confirmation_lead", [
                                                    'tinymce' => array(
                                                        'height' => 200
                                                    ),
                                                    'media_buttons' => false,
                                                    // This setting removes the media button.
                                                    'textarea_name' => "setting_descrption_confirmation_lead",
                                                    // Set custom name.
                                                    'textarea_rows' => 10,
                                                    //Determine the number of rows.
                                                    'quicktags' => false,
                                                    // Remove view as HTML button.
                                                ]); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Guardar datos -->
                        <div class="d-grid justify-content-center mt-5 submit">
                            <input class="btn btn-primary" type="submit" name="submit_form_lead" id="submit_form_lead"
                                value="Actualizar información" />
                        </div>
                    </form>
                </div>

                <!-- CONTENIDO PARA EL TAB DE FORMULARIO LEGALES -->
                <div class="tab-pane fade" id="content_form_legales_lead" role="tabpanel" aria-labelledby="form_legales_tab"
                    tabindex="1">
                    <form method="post" action="">
                        <div class="row">
                            <!-- CONTENIDO -->
                            <div class="col-12 mt-3">
                                <label for="setting_habeas_data" class="form-label">Texto legal</label>
                                <?= wp_editor(get_option('setting_habeas_data', ''), "setting_habeas_data", [
                                    'tinymce' => array(
                                        'height' => 200
                                    ),
                                    'media_buttons' => false,
                                    'textarea_name' => "setting_habeas_data",
                                    'textarea_rows' => 20,
                                    'quicktags' => false,

                                ]); ?>
                            </div>
                        </div>

                        <!-- Guardar datos -->
                        <div class="d-grid justify-content-center mt-5 submit">
                            <input class="btn btn-primary" type="submit" name="submit_form_legales" id="submit_form_legales"
                                value="Actualizar información" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php
}



// Habilitar Bootstrap en panel admin
add_action('admin_enqueue_scripts', 'child_enqueue_scripts_page_config_form_lead');

function child_enqueue_scripts_page_config_form_lead()
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
    if ($_GET['page'] !== 'page-form-lead') {
        return;
    }

    // Validar para cargar el plugin
    if (!did_action('wp_enqueue_media')) {
        wp_enqueue_media();
    }

    // Hacer cargar de css y js
    wp_enqueue_style('child_bootstrap_css', get_stylesheet_directory_uri() . '/plugins/bootstrap/bootstrap.min.css', array(), '5.3.3');
    wp_enqueue_style('child_admin_css', get_stylesheet_directory_uri() . '/styles/admin.css', array(), '');
    wp_enqueue_script('child_bootstrap_scripts', get_stylesheet_directory_uri() . '/plugins/bootstrap/bootstrap.bundle.min.js', ['jquery', 'wp-element'], '1.0.0', true);
    wp_enqueue_script('child_admin_scripts', get_stylesheet_directory_uri() . '/public/build/admin_child.js', ['jquery', 'wp-element'], '1.0.0', true);
}