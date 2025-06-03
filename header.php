<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site-header">
    <div class="header-container">
        <header class="site-header-content">
            <div class="site-branding">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php endif; ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                </h1>
            </div>

            <div class="header-navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'main',
                    'menu_id'        => 'primary-menu',
                    'container'      => 'nav',
                    'container_class' => 'main-navigation',
                    'fallback_cb'    => false,
                ) );
                ?>

                <div class="header-buttons">
                    <a href="tel:260-710-9103" class="button">260.710.9103</a>
                </div>
            </div>
        </header>
    </div>
</div>