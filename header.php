<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header navbar navbar-expand-lg navbar-dark" style="background-color: var(--wp--preset--color--theme-5);">
    <div class="container">
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
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
                <a href="tel:260-710-9103" class="btn btn-primary mt-3 d-lg-none">260.710.9103</a>
            </div>
        </div>

        <div class="collapse navbar-collapse d-none d-lg-flex" id="primary-menu-collapse">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'main',
                'menu_id'        => 'primary-menu',
                'container'      => false,
                'menu_class'     => 'navbar-nav me-auto mb-2 mb-lg-0',
                'fallback_cb'    => false,
            ) );
            ?>
            <a href="tel:260-710-9103" class="btn btn-primary ms-lg-3">260.710.9103</a>
        </div>
    </div>
</header>
