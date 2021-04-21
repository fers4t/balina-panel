<?php


$options = get_option("bl_panel_settings");
// widgets
if (isset($options['bl_panel_widget_setting'])) {
    require_once(BL_PANEL_CONTROLLER_PATH . "/workers/widget.php");
};
// admin url
if (isset($options['bl_panel_admin_url_field'])) {
    require_once(BL_PANEL_CONTROLLER_PATH . "/workers/admin-url.php");
}

if (isset($options['bl_panel_old_admin_image_field']) && !empty($options['bl_panel_old_admin_image_field'])) {
    require_once(BL_PANEL_CONTROLLER_PATH . "/workers/admin-logo.php");
}

if (isset($options['bl_panel_old_admin_left_image_field']) && !empty($options['bl_panel_old_admin_left_image_field'])) {
    require_once(BL_PANEL_CONTROLLER_PATH . "/workers/admin-left-image.php");
}
