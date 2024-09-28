<?php
class FormLeadHookAjax
{
    public function __construct()
    {
        add_action('wp_ajax_save_form_general_lead', [$this, 'save_form_general_lead']);
        add_action('wp_ajax_nopriv_save_form_general_lead', [$this, 'save_form_general_lead']);
    }

    public function save_form_general_lead()
    {
        try {
            // Extraer el cuerpo de la peticion 
            $data = util_recursive_sanitize_text_field($_POST);

            // Objecto de wordpress
            global $wpdb;

            // Nombre de la tabla
            $tableLead = 'lead_gen_data';

            // Emails config
            $emails = [];
            $emailCustomerGlobal = get_option('setting_email_customer_global', '');
            $emailAdminGlobal = get_option('setting_email_admin_global', '');
            $emailsCopy = get_option('setting_emails_copy', '');

            if ($emailAdminGlobal !== '') {
                $emails[] = $emailAdminGlobal;
            }

            if ($emailsCopy !== '') {
                $copy = explode(',', $emailsCopy);
                foreach ($copy as $cpEmail) {
                    $emails[] = $cpEmail;
                }
            }

            // Preparar los datos para insertar en la tabla
            $fields = ['nombre', 'apellidos', 'telefono', 'email', 'fecha_agenda', 'servicios_id'];
            $payload = ['wp_blog' => get_current_blog_id()];
            foreach ($fields as $field) {
                if ($field === 'servicios_id') {
                    $ids = explode(',', $data[$field] ?? '');
                    $names = [];
                    foreach ($ids as $id) {
                        $names[] = get_the_title($id);

                        // Emails
                        $email = get_post_meta($id, 'email_para_datos', true);
                        if ($email && $email !== '') {
                            $emails[] = $email;
                        } else if ($emailCustomerGlobal !== '' && !in_array($emailCustomerGlobal, $emails)) {
                            $emails[] = $emailCustomerGlobal;
                        }
                    }

                    $payload['servicios'] = implode(',', $names);
                } else {
                    $payload[$field] = $data[$field] ?? '';
                }

            }

            // Insertar los datos en la tabla
            $insert = $wpdb->insert($tableLead, $payload);

            // Enviar correo

            if (count($emails) > 0) {
                // Headers del email
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type:text/html;charset=UTF-8' . "\r\n";

                $content = child_theme_email_simple_layout([
                    'title' => 'Nuevos datos registros',
                    'description' => '<p style="margin-bottom: 15px; margin-top: 15px;">Se han registrados los siguientes datos en el sitio web</p>',
                    'table' => [
                        'Nombre' => $data['nombre'] ?? '-',
                        'Apellidos' => $data['apellidos'] ?? '-',
                        'Celular' => $data['telefono'] ?? '-',
                        'Email' => $data['email'] ?? '-',
                        'Fecha en la que planea usar el servicio' => $data['fecha_agenda'] ?? '',
                        'Servicios' => $payload['servicios'] ?? ''
                    ]
                ]);

                foreach ($emails as $email) {
                    wp_mail($email, "Datos registros en el sitio web", $content, $headers);
                }
            }

            return wp_send_json(['success' => true, 'insert' => $insert]);
        } catch (\Throwable $th) {
            return wp_send_json(['success' => false, 'error' => $th->getMessage()]);
        }
    }
}