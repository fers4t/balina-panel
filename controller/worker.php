<?php 


$options = get_option("bl_panel_settings" );
// widgets
if(isset($options['bl_panel_widget_setting'])){
    $bl_panel_widget_setting = $options['bl_panel_widget_setting'];
    if ($bl_panel_widget_setting == 1) {
        function remove_dashboard_widgets()
        {
            global $wp_meta_boxes;

            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
            unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
            unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
        }

        add_action('wp_dashboard_setup', 'remove_dashboard_widgets');

        remove_action('welcome_panel', 'wp_welcome_panel');
    }
};
// admin url
if(isset($options['bl_panel_admin_url_field'])) {

    if (!function_exists('get_home_path')) {
        include_once ABSPATH . '/wp-admin/includes/file.php';
    }
    if($options['bl_panel_admin_url_field'] != "wp-login") {
        $new_login = $options['bl_panel_admin_url_field'];
        if(file_exists(get_home_path() . "/wp-login.php")){
            $wp_login = get_home_path() . "/wp-login.php";
        } else {
            $wp_login = get_home_path() . "/wp_login_backup_bl.php";
        }
        $new_login = get_home_path() . "$new_login.php";
        copy($wp_login, $new_login);

        if (isset(parse_url($_SERVER['REQUEST_URI'])['query'])) {
            if (parse_url($_SERVER['REQUEST_URI'])['query'] == "page=bl_panel") {
                $old_url = $options["bl_panel_old_admin_url_field"];
                if (!empty($options["bl_panel_old_admin_url_field"])) {
                    if (file_exists(get_home_path() . "/$old_url.php")) {
                        unlink(get_home_path() . "/$old_url.php");
                    }
                }
            }
        }
        
        if(!file_exists(get_home_path() . "/wp_login_backup_bl.php")) {
            rename($wp_login, get_home_path() . "/wp_login_backup_bl.php");
        }
    } else {
        $old_url = $options["bl_panel_old_admin_url_field"];
        if (!empty($options["bl_panel_old_admin_url_field"])) {
            if (file_exists(get_home_path() . "/$old_url.php")) {
                unlink(get_home_path() . "/$old_url.php");
            }
        }
        rename(get_home_path() . "/wp_login_backup_bl.php", get_home_path() . "/wp-login.php");
    }
    

    if ($options['bl_panel_admin_url_field'] != "wp-login") {
        function bl_block_wp_login_php()
        {
            // Get path to main .htaccess for WordPress
            $htaccess = ABSPATH . ".htaccess";

            $lines = array();
            $lines[] =
            "# Block WordPress wp-login.php requests
                <Files wp-login.php>
                order allow,deny
                Deny from all
                </Files>
                <Files wp_login_backup_bl.php>
                order allow,deny
                Deny from all
                </Files>
                ";

            insert_with_markers($htaccess, "wpLoginBlocker", $lines);
        }
        add_action('admin_init', 'bl_block_wp_login_php');
    } else {
        function bl_enable_wp_login_php()
        {
            // Get path to main .htaccess for WordPress
            $htaccess = get_home_path() . ".htaccess";

            $lines = array();
            $lines[] = "";

            insert_with_markers($htaccess, "wpLoginBlocker", $lines);
        }

        add_action('admin_init', 'bl_enable_wp_login_php');
    }
};