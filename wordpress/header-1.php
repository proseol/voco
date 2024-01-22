<?php
    defined( 'ABSPATH' ) or die();
?>

<div class="header-row">

    <!-- Logo Block -->
    <?php
        if ( cosmecos_get_prefered_option('header_logo_status') == 'on' ) {
            echo '<div class="logo-container">' . cosmecos_get_logo_output() . '</div>';
        }
    ?>

    <!-- Menu Block -->
    <?php
        if ( cosmecos_get_prefered_option('header_menu_status') == 'on' ) {
            echo '<div class="header-menu-container">';
                echo '<nav>';
                    if ( !empty(cosmecos_get_prefered_option('header_menu_select')) && cosmecos_get_prefered_option('header_menu_select') != 'default' ) {
                        wp_nav_menu(
                            array(
                                'menu'          => cosmecos_get_prefered_option('header_menu_select'),
                                'menu_class'    => 'main-menu',
                                'depth'         => '0',
                                'container'     => ''
                            )
                        );
                    } else {
                        $menu_locations = get_nav_menu_locations();
                        if ( isset($menu_locations['main']) && $menu_locations['main'] !== 0 ) {
                            wp_nav_menu(
                                array(
                                    'theme_location'    => 'main',
                                    'menu_class'        => 'main-menu',
                                    'depth'             => '0',
                                    'container'         => ''
                                )
                            );
                        }
                    }
                echo '</nav>';
            echo '</div>';
        }
    ?>

    <!-- Icons Block -->
    <?php
        if (
            cosmecos_get_prefered_option('header_login_logout_status') == 'on' ||
            cosmecos_get_prefered_option('header_search_status') == 'on' ||
            cosmecos_get_prefered_option('side_panel_status') == 'on' ||
            (
                cosmecos_get_prefered_option('header_button_status') == 'on' &&
                !empty(cosmecos_get_prefered_option('header_button_text'))
            ) ||
            (
                class_exists('WooCommerce') && cosmecos_get_prefered_option('header_minicart_status') == 'on'
            ) ||
            (
                class_exists('WooCommerce') && function_exists('yith_plugin_registration_hook') && cosmecos_get_prefered_option('header_wishlist_status') == 'on'
            )
        ) {
            echo '<div class="header-icons-container">';

                // Header Login/Logout
                if ( cosmecos_get_prefered_option('header_login_logout_status') == 'on' ) {
                    if (class_exists('WooCommerce')) {
                        echo '<div class="header-icon login-logout">';
                            if ( is_user_logged_in() ) {
                                echo '<a href="' . wp_logout_url(home_url()) . '" title="' . esc_attr__('Logout', 'cosmecos') . '" class="link-logout"></a>';
                            } else {
                                echo '<a href="' . get_permalink(get_option('woocommerce_myaccount_page_id')) . '" title="' . esc_attr__('Login/Register', 'cosmecos') . '" class="link-login"></a>';
                            };
                        echo '</div>';
                    } else {
                        echo '<div class="header-icon login-logout">';
                            if ( is_user_logged_in() ) {
                                echo '<a href="' . wp_logout_url(home_url()) . '" title="' . esc_attr__('Logout', 'cosmecos') . '" class="link-logout"></a>';
                            } else {
                                echo '<a href="' . wp_login_url(get_permalink()) . '" title="' . esc_attr__('Login/Register', 'cosmecos') . '" class="link-login"></a>';
                            };
                        echo '</div>';
                    }
                }

                // Header Button
                if ( cosmecos_get_prefered_option('header_button_status') == 'on' && !empty(cosmecos_get_prefered_option('header_button_text')) ) {
                    echo '<div class="header-icon header-button-container">';
                        echo '<a class="cosmecos-button" href="' . ( !empty(cosmecos_get_prefered_option('header_button_url')) ? esc_url(cosmecos_get_prefered_option('header_button_url')) : esc_js('javascript:void(0);')) . '">';
                            echo esc_html(cosmecos_get_prefered_option('header_button_text'));
                        echo '</a>';
                    echo '</div>';
                }

                // Header Wishlist
                if ( class_exists('WooCommerce') && function_exists('yith_plugin_registration_hook') && cosmecos_get_prefered_option('header_wishlist_status') == 'on' ) {
                    echo '<div class="header-icon wishlist-link">';
                        echo '<a href="' . esc_url(YITH_WCWL()->get_wishlist_url()) . '" class="wishlist-link-icon"></a>';
                    echo '</div>';
                }

                // Header Product Cart
                if ( class_exists('WooCommerce') && cosmecos_get_prefered_option('header_minicart_status') == 'on' ) {
                    echo '<div class="header-icon mini-cart">';
                        echo '<a href="' . esc_url(wc_get_cart_url()) . '" class="mini-cart-trigger">';
                            echo '<i class="mini-cart-count">';
                                echo '<span>' . WC()->cart->cart_contents_count . '</span>';
                            echo '</i>';
                        echo '</a>';
                        woocommerce_mini_cart();
                    echo '</div>';
                }

                // Header Search
                if ( cosmecos_get_prefered_option('header_search_status') == 'on' ) {
                    echo '<div class="header-icon search-trigger">';
                        echo '<span class="search-trigger-icon"></span>';
                    echo '</div>';
                }

                // Header Side Panel
                if ( cosmecos_get_prefered_option('side_panel_status') == 'on' && is_active_sidebar('sidebar-side') ) {
                    echo '<div class="header-icon dropdown-trigger">';
                        echo '<div class="dropdown-trigger-item"></div>';
                    echo '</div>';
                }

            echo '</div>';
        }
    ?>

</div>
