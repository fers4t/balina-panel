<?php

/**
 * Plugin Name:       Balina Panel
 * Plugin URI:        https://balina.pro/?ref=balina-panel
 * Description:       Minimalist theme for your panel
 * Version:           0.1
 * Author:            fers4t
 * Author URI:        https://twitter.com/fers4t
 * Text Domain:       balina-panel
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /l10n
 */

require(ABSPATH . '/wp-load.php');
// constants
DEFINE('BL_PANEL_PATH', plugin_dir_path(__FILE__));
DEFINE('BL_PANEL_URL', plugin_dir_url(__FILE__));

DEFINE('BL_PANEL_VIEW_PATH', plugin_dir_path(__FILE__) . "/view/");
DEFINE('BL_PANEL_VIEW_URL', plugin_dir_url(__FILE__) . "/view/");

DEFINE('BL_PANEL_CONTROLLER_PATH', plugin_dir_path(__FILE__) . "/controller/");
DEFINE('BL_PANEL_CONTROLLER_URL', plugin_dir_url(__FILE__) . "/controller/");

// panel
include BL_PANEL_CONTROLLER_PATH . "/panel/homepage.php";

// init styles
require_once(BL_PANEL_CONTROLLER_PATH . "/styles.php");

// run settings 
require_once(BL_PANEL_CONTROLLER_PATH . "/worker.php");

