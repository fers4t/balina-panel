<?php

// admin logo & colors 
function wpb_custom_logo()
{
    $options = get_option('bl_panel_settings');
    if (isset($options['bl_panel_old_admin_image_field']) && !empty($options['bl_panel_old_admin_image_field'])) {
        $logo = $options['bl_panel_old_admin_image_field'];
    }

    echo '
            <style type="text/css">
            .login h1 a {
            background-image: url(' . get_home_url() . $logo . ') !important;
            background-position: 0 0;
            color:rgba(0, 0, 0, 0);
            width:150px !important;
            height: 150px !important;
            background-size: contain !important;
            }
            #wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
            background-position: 0 0;
            }
            </style>';
}

//hook into the administrative header output
add_action('login_enqueue_scripts', 'wpb_custom_logo');