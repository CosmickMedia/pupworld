<footer class="site-footer text-light" style="background-color: #102624;">
    <div class="container-fluid py-4 px-3">
        <div class="row mb-3 align-items-center">
            <div class="col-lg-4 footer-branding d-flex align-items-center mb-3 mb-lg-0">
                <?php if ( has_custom_logo() ) : ?>
                    <a class="navbar-brand me-3" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php the_custom_logo(); ?>
                    </a>
                <?php endif; ?>
                <p class="footer-site-title mb-0 fw-bold"><?php bloginfo( 'name' ); ?></p>
            </div>

            <div class="col-lg-4 footer-navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                    'container'      => 'nav',
                    'container_class' => 'footer-nav',
                    'fallback_cb'    => false,
                ) );
                ?>
                <ul class="social-links list-inline mt-3">
                    <li class="list-inline-item"><a href="#" class="text-light"><i class="fab fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-light"><i class="fab fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#" class="text-light"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>

            <div class="col-lg-4 footer-contact text-lg-end text-center">
                <h5 class="mb-2">Contact us</h5>
                <p class="mb-1"><i class="fas fa-phone"></i> <a href="tel:2607109103" class="text-light text-decoration-none">260.710.9103</a></p>
                <p class="mb-1"><i class="fas fa-envelope"></i> <a href="mailto:01pupworld@gmail.com" class="text-light text-decoration-none">01pupworld@gmail.com</a></p>
                <p class="mb-0"><i class="fas fa-map-marker-alt"></i> 10512 Schwartz RD. Ft Wayne. IN 46835</p>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
