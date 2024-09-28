<?php

// MENU
require_once 'menu/add-customizable-form.php';
require_once 'menu/add-cta-page.php';
require_once 'menu/add-config-emails-page.php';

// AJAX
require_once 'ajax/form-lead.hook.php';

// POST TYPE
require_once 'post-type/page.php';
require_once 'post-type/wp-post.php';

// INICIALIZAR CLASES EN CASO DE SER NECESARIO
new FormLeadHookAjax();