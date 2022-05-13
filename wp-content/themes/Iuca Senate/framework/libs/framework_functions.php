<?php

function _assets() {
    return get_template_directory_uri().'/assets';
}

function _mt_assets() {
    return get_template_directory_uri().'/framework/assets';
}


function _vd($a) {
    if (is_user_logged_in()) {
        echo '<pre style="padding: 50px 50px; border: 2px solid black; margin: 20px 20px; background: #ffff78;">';
        var_dump($a);
        echo '</pre>';
    }
}


