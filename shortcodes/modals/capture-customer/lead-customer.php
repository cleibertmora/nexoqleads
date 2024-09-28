<?php

function shortcode_child_modal_lead_customer($atts)
{
    // Parametros
    $args = shortcode_atts(
        array(
            'class_name' => '',
            'modal_id' => 'modalFormLead',
        ),
        $atts
    );

    // Extraer valores de los parametros
    $id = $args['modal_id'] ? $args['modal_id'] : '';
    $className = $args['class_name'] ? $args['class_name'] : '';

    // Clase css general para los botones
    $classGeneralButton = 'mt-5';

    // Funciones auxiliares
    function build_cards_services($posts, $hidden = false)
    {
        $services = [];

        // Iterar sobre los posts
        foreach ($posts as $post) {
            $imageUrl = get_the_post_thumbnail_url($post->ID, 'full') ?? '';
            $rangemin = get_post_meta($post->ID, 'precio_minimo', true) ?? '$0';
            $rangemax = get_post_meta($post->ID, 'precio_maximo', true) ?? '$0';
            $range = "Desde $$rangemin - $$rangemax";

            $styleInternal = '';
            if ($hidden) {
                $styleInternal = 'display: none;';
            }

            $services[] = <<<EOT
                <div class="col-12 col-md-4" style="{$styleInternal}">                
                    <div class="card card_services" data-services_id="{$post->ID}">
                        <img src="{$imageUrl}" class="card-img-top" alt="...">
                        
                        <div class="card-body">
                            <h5 class="card-title text-center">{$post->post_title}</h5>
                            <div class="text-center">
                                <p class="card-text rounded-0 badge text-bg-primary">{$range}</p>                        
                            </div>
                        </div>

                        <span class="position-absolute top-0 start-100 translate-middle check_service_card" style="display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
                            </svg>
                        </span>
                    </div>
                </div>
            EOT;
        }

        return implode(PHP_EOL, $services);
    }

    function build_table_services($posts, $hidden = false)
    {
        $services = [];

        // Iterar sobre los posts
        foreach ($posts as $key => $post) {
            $rangemin = get_post_meta($post->ID, 'precio_minimo', true) ?? '$0';
            $rangemax = get_post_meta($post->ID, 'precio_maximo', true) ?? '$0';
            $range = "Desde $$rangemin - $$rangemax";

            $styleInternal = '';
            if ($hidden) {
                $styleInternal = 'display: none;';
            }

            $index = $key + 1;

            $services[] = <<<EOT
                <tr style="{$styleInternal}" class="list_item_services" data-services_id="{$post->ID}">
                    <th scope="row" class="index_table">{$index}</th>
                    <td>{$post->post_title}</td>
                    <td class="range_prices">{$range}</td>                    
                </tr>
            EOT;
        }

        $renderServices = implode(PHP_EOL, $services);

        return <<<EOT
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Servicio</th>
                    <th scope="col">Precios</th>                    
                    </tr>
                </thead>
                <tbody>    
                    {$renderServices}
                    <tr style="{$styleInternal}" class="list_item_services summary_prices">
                        <th scope="row"></th>
                        <td class="text-end"><strong>Rango de precios</strong></td>
                        <td><strong class="total"></<strong>></td>                        
                    </tr>                              
                </tbody>
            </table>
        EOT;
    }

    // Datos para el paso uno (INTRODUCCION)
    $titleIntroduction = get_option('setting_title_introduction_lead', '');
    $buttonIntroduction = get_option('setting_text_button_introduction_lead', '');
    $descriptionIntroduction = wpautop(get_option('setting_descrption_introduction_lead', ''));

    if ($buttonIntroduction && $buttonIntroduction !== '') {
        $buttonIntroduction = "<button class='button_step_introduction {$classGeneralButton}'>{$buttonIntroduction}</button>";
    }

    // Datos para el paso dos (SELECCION DE SERVICIOS)
    $titleServices = get_option('setting_title_services_lead', '');
    $buttonServices = get_option('setting_text_button_services_lead', '');
    $descriptionServices = wpautop(get_option('setting_descrption_services_lead', ''));

    if ($buttonServices && $buttonServices !== '') {
        $buttonServices = "<button class='button_step_services {$classGeneralButton}' type='submit' disabled>{$buttonServices}</button>";
    }

    // Obtener los tipos de servicios
    $args = array(
        'post_type' => 'servicio',
        'post_status' => 'publish', // Obtener solo los posts publicados
        'posts_per_page' => -1, // Obtener todos los posts
    );

    // Realizar la consulta
    $posts = get_posts($args);

    $services = '';
    $servicesPreSelected = '';
    // Verificar si se encontraron posts
    if ($posts) {
        $services = build_cards_services($posts);
        $servicesPreSelected = build_table_services($posts, true);
    }

    // Datos para el paso dos (RECOLLECION DE DATOS)
    $titleRecolect = get_option('setting_title_recolect_data_lead', '');
    $buttonRecolect = get_option('setting_text_button_recolect_data_lead', '');
    $descriptionRecolect = wpautop(get_option('setting_descrption_recolect_data_lead', ''));

    if ($buttonRecolect && $buttonRecolect !== '') {
        $buttonRecolect = "<button class='button_step_recolect {$classGeneralButton}' type='submit'>{$buttonRecolect}</button>";
    }

    // Legales
    $textHabeas = get_option('setting_habeas_data', '');

    // Datos para el paso dos (CONFIRMACION)
    $titleConfirm = get_option('setting_title_confirmation_lead', '');
    $buttonConfirm = get_option('setting_text_button_confirmation_lead', '');
    $descriptionConfirm = wpautop(get_option('setting_descrption_confirmation_lead', ''));

    if ($buttonConfirm && $buttonConfirm !== '') {
        $buttonConfirm = "<button class='button_step_confirm {$classGeneralButton}'>{$buttonConfirm}</button>";
    }

    // Render
    return <<<EOT
        <!-- Modal -->
        <div class="modal fade {$className} modal_form_lead" id="{$id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">                    

                    <!-- CONTENIDO DEL MODAL -->
                    <div class="modal-body">

                        <!-- PASO UNO -->
                        <div class="modal-step-1">
                            <button type="button" class="btn-close button_close_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                            
                            <h2 class="text-center">{$titleIntroduction}</h2>
                            <div class="d-grid gap-3 mt-5">
                                <div>
                                    {$descriptionIntroduction}
                                </div>
                                <div class="d-grid justify-content-center">
                                    {$buttonIntroduction}
                                </div>
                            </div>
                        </div>


                        <!-- PASO DOS -->
                        <div class="modal-step-2" style="display: none;">
                            <button type="button" class="btn-close button_back_step" data-tostep="1" data-step="2"></button>

                            <h2 class="text-center">{$titleServices}</h2>
                            <div class="d-grid gap-3 mt-5">
                                <div>
                                    {$descriptionServices}
                                </div>

                                <!-- FORMULARIO PARA SOLICITAR SERVICIOS INTERESADOS -->
                                <form class="form_recolect_service">

                                    <p>Selecciona al menos un servicio: </p>
                                    
                                    <!-- SERVICIOS -->
                                    <div class="row" style="--bs-gutter-y: 20px;">
                                        {$services}
                                    </div>

                                    <!-- CAMPO OCULTO -->
                                    <input type="hidden" name="servicios[]" id="services_ids" required />

                                    <!-- BOTON -->
                                    <div class="d-grid justify-content-center">
                                        {$buttonServices}
                                    </div>                                
                                </form>

                            </div>
                        </div>


                        <!-- PASO TRES -->
                        <div class="modal-step-3" style="display: none;">
                            <button type="button" class="btn-close button_back_step" data-tostep="2" data-step="3"></button>

                            <h2 class="text-center">{$titleRecolect}</h2>
                            <div class="d-grid gap-3 mt-5">
                                <div>
                                    {$descriptionRecolect}
                                </div>

                                <!-- FORMULARIO PARA RECOLECTAR INFORMACION DEL USUARIO -->
                                <form class="form_recolect_data_lead">

                                    <!-- CAMPOS -->
                                    <div class="row" style="--bs-gutter-y: 20px;">

                                        <!-- Nombre -->
                                        <div class="col-12 col-md-6">
                                            <label for="name" class="form-label">Nombre</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="name"
                                                name="nombre"
                                                placeholder="Nombre"
                                                required
                                            />
                                        </div>
                                        
                                        <!-- Apellidos -->
                                        <div class="col-12 col-md-6">
                                            <label for="last_name" class="form-label">Apellidos</label>
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="last_name"
                                                name="apellidos"
                                                placeholder="Apellidos"
                                                required
                                            />
                                        </div>
                            
                                        <!-- Celular -->
                                        <div class="col-12 col-md-6">
                                            <label for="phone" class="form-label">Celular</label>
                                                <input
                                                type="text"
                                                class="form-control"
                                                id="phone"
                                                name="telefono"
                                                placeholder="Escribe tu número de celular"
                                                required
                                            />
                                        </div>
                            
                                        <!-- Email -->
                                        <div class="col-12 col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input
                                                type="email"
                                                class="form-control"
                                                id="email"
                                                name="email"
                                                placeholder="Escribe tu email"
                                                required
                                            />
                                        </div>
                                        
                                        <!-- Fecha -->
                                        <div class="col-12 col-md-6">
                                            <label for="fecha_para_servicio" class="form-label">Fecha en la que planea usar el servicio</label>
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="fecha_para_servicio"
                                                name="fecha_agenda"
                                                placeholder=""
                                                required
                                            />
                                        </div>                                                                                                                                    
                                    </div>

                                    <!-- SERVICIOS SELECCIONADOS ANTERIORMENTE -->
                                    <div class="row section_services_selected mt-4" style="--bs-gutter-y: 20px; display: none;">
                                        <p class="col-12 m-0"><strong>Servicios:</strong></p>                                        
                                        {$servicesPreSelected}
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="text_habeas_data" required>
                                        <label class="form-check-label" for="text_habeas_data">$textHabeas</label>
                                    </div>

                                    <!-- BOTON -->
                                    <div class="d-grid justify-content-center">
                                        {$buttonRecolect}
                                    </div>

                                    <!-- Spinner -->
                                    <div class="text-center col-12 loader_submit_form_lead" style="display:none;">  
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </form>                                
                            </div>
                        </div>


                        <!-- PASO CUATRO -->
                        <div class="modal-step-4" style="display: none;">
                            <button type="button" class="btn-close button_back_step" data-tostep="3" data-step="4"></button>

                            <h2 class="text-center">{$titleConfirm}</h2>
                            <div class="d-grid gap-3 mt-5">
                                <div>
                                    {$descriptionConfirm}
                                </div>
                                <div class="d-grid justify-content-center">
                                    {$buttonConfirm}
                                </div>
                            </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>
    EOT;

}

add_shortcode('child_modal_lead_customer', 'shortcode_child_modal_lead_customer');