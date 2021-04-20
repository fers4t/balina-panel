<?php

add_action('admin_enqueue_scripts', 'balina_admin_style');

function balina_admin_style()
{
    wp_enqueue_style('balina-style', BL_PANEL_VIEW_URL . '/assets/admin.css',1);
}