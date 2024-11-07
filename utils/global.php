<?php
function util_recursive_sanitize_text_field($array)
{
    foreach ($array as $key => &$value) {
        if (is_array($value)) {
            $value = recursive_sanitize_text_field($value);
            continue;
        }
        $value = sanitize_text_field($value);
    }

    return $array;
}

function nexoq_kses_allowed_html($allowed_post_tags){
    $allowed_post_tags['iframe'] = array(
        'src' => true,
        'width' => true,
        'height' => true,
        'frameborder' => true,
        'allowfullscreen' => true
    );
    return $allowed_post_tags;
}