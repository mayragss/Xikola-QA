<?php
if (function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    if (in_array('mod_rewrite', $modules)) {
        echo "mod_rewrite is enabled";
    } else {
        echo "mod_rewrite is NOT enabled";
    }
} else {
    echo "Cannot check Apache modules";
}
?>

