<?php

if (!function_exists('wp_handle_upload')) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
}

add_action('admin_menu', 'bl_panel_add_admin_menu');
add_action('admin_init', 'bl_panel_settings_init');


function bl_panel_add_admin_menu()
{
    add_menu_page('Balina Theme Settings', 'Balina Panel', 'manage_options', 'bl_panel', 'bl_panel_options_page');
}

function bl_panel_settings_init()
{

    register_setting('bl_panel_pluginPage', 'bl_panel_settings');
    register_setting('bl_admin_settings', 'bl_panel_settings');

    add_settings_section(
        'fers4t_bl_panel_pluginPage_section',
        __('Balina Theme Settings', 'Theme Settings'),
        '',
        'bl_panel_pluginPage'
    );

    add_settings_field(
        'bl_panel_widget_setting',
        __('Disable built-in WordPress widgets', 'Theme Settings'),
        'bl_panel_bl_panel_widget_setting_render',
        'bl_panel_pluginPage',
        'fers4t_bl_panel_pluginPage_section'
    );

    add_settings_field(
        'bl_panel_position_field',
        __('Message for old posts', 'Theme Settings'),
        'bl_panel_bl_panel_position_field_render',
        'bl_panel_pluginPage',
        'fers4t_bl_panel_pluginPage_section'
    );


    add_settings_section(
        'fers4t_bl_panel_pluginPage_section',
        __('Balina Admin Panel Settings', 'Theme Settings'),
        '',
        'bl_admin_settings'
    );

    add_settings_field(
        'bl_panel_admin_url_field',
        __('Rename Admin URL', 'Theme Settings'),
        'bl_panel_admin_url_field_render',
        'bl_admin_settings',
        'fers4t_bl_panel_pluginPage_section'
    );

    add_settings_field(
        'bl_panel_old_admin_url_field',
        __('Old Admin URL', 'Theme Settings'),
        'bl_panel_old_admin_url_field_render',
        'bl_admin_settings',
        'fers4t_bl_panel_pluginPage_section',
        [
            'class' => 'hidden'
        ]
    );

    add_settings_field(
        'bl_panel_old_admin_image_field',
        __('Login Brand Image URL', 'Theme Settings'),
        'bl_panel_old_admin_image_field_render',
        'bl_admin_settings',
        'fers4t_bl_panel_pluginPage_section'
    );

    add_settings_field(
        'bl_panel_old_admin_left_image_field',
        __('Login Left Big Image URL', 'Theme Settings'),
        'bl_panel_old_admin_left_image_field_render',
        'bl_admin_settings',
        'fers4t_bl_panel_pluginPage_section'
    );

    add_settings_field(
        'bl_panel_old_admin_color_field',
        __('Custom Panel CSS', 'Theme Settings'),
        'bl_panel_old_admin_color_field_render',
        'bl_admin_settings',
        'fers4t_bl_panel_pluginPage_section'
    );
}


function bl_panel_bl_panel_widget_setting_render()
{

    $options = get_option('bl_panel_settings');
?>
    <input placehold type='checkbox' name='bl_panel_settings[bl_panel_widget_setting]' <?php isset($options['bl_panel_widget_setting']) ? checked($options['bl_panel_widget_setting'], 1) : "" ?> value="1">
<?php

}


function bl_panel_bl_panel_position_field_render()
{

    $options = get_option('bl_panel_settings');
?>
    <input type='text' name='bl_panel_settings[bl_panel_position_field]' value="<?php echo isset($options['bl_panel_position_field']) ? $options['bl_panel_position_field'] : ""; ?>">
<?php

}

function bl_panel_admin_url_field_render()
{

    $options = get_option('bl_panel_settings');
?>
    <input type='text' name='bl_panel_settings[bl_panel_admin_url_field]' value="<?php echo isset($options['bl_panel_admin_url_field']) ? $options['bl_panel_admin_url_field'] : ""; ?>"><br>
    <small>Use "wp-login" for default panel</small> <br>
    <?php
    if (isset($options['bl_panel_admin_url_field'])) {
    ?>
        <small>Your panel url is <a href="<?php echo get_home_url() . "/" . $options['bl_panel_admin_url_field'] . ".php" ?>"><?php echo get_home_url() . "/" . $options['bl_panel_admin_url_field'] . ".php" ?></a></small>
    <?php
    }
    ?>
<?php

}

function bl_panel_old_admin_url_field_render()
{
    $options = get_option('bl_panel_settings');
?>
    <input type='hidden' name='bl_panel_settings[bl_panel_old_admin_url_field]' value="<?php echo isset($options['bl_panel_admin_url_field']) ? $options['bl_panel_admin_url_field'] : ""; ?>">
<?php

}

function bl_panel_old_admin_image_field_render()
{
    $options = get_option('bl_panel_settings');
?>
    <input type='text' name='bl_panel_settings[bl_panel_old_admin_image_field]' value="<?php echo isset($options['bl_panel_old_admin_image_field']) ? $options['bl_panel_old_admin_image_field'] : ""; ?>">

<?php
}

function bl_panel_old_admin_left_image_field_render()
{
    $options = get_option('bl_panel_settings');
?>
    <input type='text' name='bl_panel_settings[bl_panel_old_admin_left_image_field]' value="<?php echo isset($options['bl_panel_old_admin_left_image_field']) ? $options['bl_panel_old_admin_left_image_field'] : ""; ?>">

<?php
}

function bl_panel_old_admin_color_field_render()
{
    $options = get_option('bl_panel_settings');
?>
    <textarea rows="4" cols="50" type='text' name='bl_panel_settings[bl_panel_old_admin_color_field]'><?php echo isset($options['bl_panel_old_admin_color_field']) ? $options['bl_panel_old_admin_color_field'] : ""; ?></textarea>

<?php
}

function bl_panel_options_page()
{

?>
    <form action='options.php' method='post'>

        <?php
        settings_fields('bl_panel_pluginPage');
        do_settings_sections('bl_panel_pluginPage');

        settings_fields('bl_admin_settings');
        do_settings_sections('bl_admin_settings');
        submit_button();
        ?>

    </form>
<?php

}
