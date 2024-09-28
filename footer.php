<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<!-- Template del Footer ASTRA -->
<?php astra_content_bottom(); ?>
</div> <!-- ast-container -->
</div><!-- #content -->

<!-- SHORTCODE PERSONALIZADO -->
<?= do_shortcode('[child_button_sticky_whatsapp]'); ?>


<!-- Template del Footer ASTRA -->
<?php
astra_content_after();
astra_footer_before();
astra_footer();
astra_footer_after();
?>
</div><!-- #page -->
<?php
astra_body_bottom();
wp_footer();
?>
</body>

</html>