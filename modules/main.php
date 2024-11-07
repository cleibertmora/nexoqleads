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
    ?>
    <div class="wrap">
        <h1>NexoQ Tools</h1>
        <p>Settings de nuestro sitio nicho :)</p>

        <?php
        // Check if the user is allowed to update options
        if (!current_user_can('manage_options')) {
            return;
        }

        // Handle form submission
        if (isset($_POST['nexoq_options_update'])) {
            // Check security nonce
            check_admin_referer('nexoq_update_options');

            // Sanitize and update options
            update_option('nexoq_leads_website_industry', sanitize_text_field($_POST['nexoq_leads_website_industry']));
            update_option('nexoq_leads_website_iframe', wp_kses($_POST['nexoq_leads_website_iframe'], nexoq_kses_allowed_html(wp_kses_allowed_html())));
            // Feedback to the user
            echo '<div id="message" class="updated fade"><p>Settings saved.</p></div>';
        }

        // Fetch current settings
        $industry = get_option('nexoq_leads_website_industry', '');
        $iframe = get_option('nexoq_leads_website_iframe', '');
        ?>

        <form method="post" action="">
            <?php wp_nonce_field('nexoq_update_options'); ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="nexoq_leads_website_industry">Industria:</label></th>
                    <td><input type="text" id="nexoq_leads_website_industry" name="nexoq_leads_website_industry" value="<?php echo esc_attr($industry); ?>" class="regular-text" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="nexoq_leads_website_iframe">Formulario (iframe):</label></th>
                    <td><textarea id="nexoq_leads_website_iframe" name="nexoq_leads_website_iframe" rows="10" cols="50" class="large-text code"><?php echo esc_textarea($iframe); ?></textarea></td>
                </tr>
            </table>

            <p class="submit">
                <input type="submit" name="nexoq_options_update" id="submit" class="button button-primary" value="Save Changes">
            </p>
        </form>
    </div>
    <?php
}