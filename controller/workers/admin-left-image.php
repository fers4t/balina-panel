<?php

if (isset($options['bl_panel_old_admin_left_image_field']) && !empty($options['bl_panel_old_admin_left_image_field'])) {
    add_action('login_header', 'balina_admin_header_content');
    function balina_admin_header_content()
    {
        global $options;
        $left_image = $options['bl_panel_old_admin_left_image_field'];
?>
        <div id="balina_panel">
            <div id="left_image">
                <img src="<?php echo get_home_url() . $left_image ?>" alt="">
            </div>

        <?php
    }

    add_action('login_footer', 'balina_admin_footer_content');
    function balina_admin_footer_content()
    {
        global $options;
        if (isset($options['bl_panel_old_admin_color_field'])) {
            $css = $options['bl_panel_old_admin_color_field'];
        } else {
            $css = "";
        }

        echo "</div>";
        ?>
            <style>
                #balina_panel {
                    display: flex;
                    flex-direction: row;
                }

                #left_image {
                    flex-basis: 1 !important;
                }

                #left_image img {
                    width: 100%;
                    height: 100vh;
                    object-fit: cover;
                    object-position: center center;
                }

                #balina_panel>div {
                    flex: 1;
                }

                #login {
                    flex: 2 !important;
                    justify-content: center !important;
                    text-align: center !important;
                    display: flex !important;
                    flex-direction: column !important;
                }

                #login form {
                    margin: 0 auto;
                    width: 270px !important;
                    background: unset !important;
                    border: unset !important;
                }

                #login form {
                    display: flex;
                    flex-direction: column;
                }

                form input {
                    width: 100%;
                    border: 1px solid #ced4da !important;
                    height: 48px;
                    color: #1a1e21;
                    padding: .375rem .75rem !important;
                }

                .login form .input,
                .login input[type=password],
                .login input[type=text] {
                    line-height: 1 !important;
                    min-height: unset !important;
                    font-size: 17px !important
                }

                .wp-pwd {
                    position: relative !important;
                    box-sizing: border-box !important;
                }

                .login .button.wp-hide-pw {
                    top: 4px !important;
                }

                p.submit {
                    order: 1;
                    padding-bottom: 17px !important;
                }

                p.forgetmenot {
                    order: 2;
                }

                form label[for="user_login"],
                form label[for="user_pass"] {
                    display: none !important
                }

                form input {
                    border: 1px solid rgba(0, 0, 0, .125) !important;
                }

                form input::placeholder {
                    font-size: 16px !important;
                    padding: 3px 5px !important;
                }

                <?php echo $css  ?>
            </style>
            <script>
                window.addEventListener("load", function() {
                    var one = jQuery("#loginform > p:nth-child(1) > label").text()
                    var two = jQuery("#loginform .user-pass-wrap label").text()

                    jQuery("input#user_login").attr("placeholder", one);
                    jQuery("input.password-input").attr("placeholder", two);
                });
            </script>
    <?php
    }
} else {
    $logo = "logo yok";
}
