<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header navbar navbar-expand-lg" style="background-color: #102624;">
    <div class="container d-flex align-items-center py-2">
        <a class="navbar-brand me-4" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <?php bloginfo( 'name' ); ?>
            <?php endif; ?>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#primaryOffcanvas" aria-controls="primaryOffcanvas" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="primaryOffcanvas" aria-labelledby="primaryOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="primaryOffcanvasLabel"><?php bloginfo( 'name' ); ?></h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'main',
                    'menu_id'        => 'primary-menu-mobile',
                    'container'      => false,
                    'menu_class'     => 'navbar-nav justify-content-end flex-grow-1 pe-3',
                    'fallback_cb'    => false,
                ) );
                ?>
                <div class="social-icons mt-3">
                    <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="business-info text-light mt-3">
                    <div class="business-name fw-bold mb-1"><?php bloginfo( 'name' ); ?></div>
                    <div class="header-phone"><i class="fas fa-phone"></i> <a href="tel:260-710-9103" class="text-light text-decoration-none">260.710.9103</a></div>
                </div>
            </div>
        </div>

        <div class="collapse navbar-collapse d-none d-lg-flex" id="primary-menu-collapse">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'main',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0',
                'fallback_cb'    => false,
            ) );
            ?>
            <div class="header-right d-flex align-items-center ms-3">
                <div class="social-icons me-3">
                    <a href="#" class="text-light me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="business-info text-end text-light">
                    <div class="business-name fw-bold"><?php bloginfo( 'name' ); ?></div>
                    <div class="header-phone"><i class="fas fa-phone"></i> <a href="tel:260-710-9103" class="text-light text-decoration-none">260.710.9103</a></div>
                </div>
            </div>
        </div>
    </div>
</header>
