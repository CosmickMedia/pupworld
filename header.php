<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header navbar navbar-expand-lg navbar-dark" style="background-color: #102624;">
    <div class="container-fluid d-flex align-items-center justify-content-between py-2 px-3">
        <div class="d-flex align-items-center">
            <a class="navbar-brand me-4" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="/wp-content/uploads/2025/05/logo.min_.png" alt="<?php bloginfo( 'name' ); ?>" class="img-fluid" width="90" height="90" />
            </a>
            <div class="business-info ms-4 text-light">
                <div class="business-name fw-bold"><?php bloginfo( 'name' ); ?></div>
                <div class="header-phone"><i class="fas fa-phone"></i> <a href="tel:2607109103" class="text-light text-decoration-none">260.710.9103</a></div>
            </div>
        </div>

        <div class="mobile-icons d-lg-none d-flex align-items-center me-2">
            <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="text-light me-3 account-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path d="M2 14s-1 0-1-1 1-4 7-4 7 3 7 4-1 1-1 1H2z"/>
                </svg>
            </a>
            <?php pupworld_cart_link(); ?>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#primaryOffcanvas" aria-controls="primaryOffcanvas" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse d-none d-lg-flex justify-content-end" id="primary-menu-collapse">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'main',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'menu_class'     => 'navbar-nav me-3 mb-2 mb-lg-0',
                'fallback_cb'    => false,
            ) );
            ?>
            <div class="header-right d-flex align-items-center">
                <span class="text-light px-3">|</span>
                <div class="social-icons">
                    <a href="#" class="text-light me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                </div>
                <span class="text-light px-3">|</span>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="text-light me-3 account-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path d="M2 14s-1 0-1-1 1-4 7-4 7 3 7 4-1 1-1 1H2z"/>
                    </svg>
                </a>
                <?php pupworld_cart_link(); ?>
            </div>
        </div>
    </div>
</header>

<!-- Offcanvas menu for mobile -->
<div class="offcanvas offcanvas-end d-lg-none" tabindex="-1" id="primaryOffcanvas" aria-labelledby="primaryOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="primaryOffcanvasLabel"><?php bloginfo( 'name' ); ?></h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php
        wp_nav_menu( array(
            'theme_location' => 'main',
            'menu_id'        => 'primary-offcanvas-menu',
            'container'      => false,
            'menu_class'     => 'navbar-nav text-center',
            'fallback_cb'    => false,
        ) );
        ?>
    </div>
</div>
