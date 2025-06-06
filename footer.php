<footer class="site-footer text-light" style="background-color: #102624;">
    <div class="container-fluid py-4 px-3">
        <div class="row align-items-center">
            <div class="col-lg-4 d-flex align-items-center mb-3 mb-lg-0">
                <a class="navbar-brand me-3" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <img src="/wp-content/uploads/2025/05/logo.min_.png" alt="<?php bloginfo( 'name' ); ?>" class="img-fluid" width="90" height="90" />
                </a>
                <div>
                    <div class="fw-bold mb-1"><?php bloginfo( 'name' ); ?></div>
                    <div class="review-stars text-warning">
                        <?php for ( $i = 0; $i < 5; $i++ ) : ?>
                            <i class="fas fa-star"></i>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 text-lg-center mb-3 mb-lg-0">
                <div><strong>Hours:</strong> Mon - Fri 9AM - 5PM</div>
                <div><i class="fas fa-phone"></i> 260.710.9103</div>
                <div><i class="fas fa-map-marker-alt"></i> 1234 Puppy Lane, City, ST 00000</div>
            </div>

            <div class="col-lg-4 text-lg-end">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                    'container'      => 'nav',
                    'container_class' => 'footer-nav',
                    'fallback_cb'    => false,
                ) );
                ?>
                <div class="social-icons mb-2">
                    <a href="#" class="text-light me-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="copyright">&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
