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