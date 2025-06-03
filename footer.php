<footer class="site-footer bg-light py-4">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-4 footer-branding">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="footer-logo mb-2">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php endif; ?>
                <p class="footer-site-title mb-0"><?php bloginfo( 'name' ); ?></p>
            </div>

            <div class="col-md-8 footer-navigation">
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
                    <li class="list-inline-item"><a href="https://instagram.com" target="_blank" rel="noopener">Instagram</a></li>
                    <li class="list-inline-item"><a href="https://facebook.com" target="_blank" rel="noopener">Facebook</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-contact text-center">
            <p class="mb-1"><strong>Email:</strong> <a href="mailto:01pupworld@gmail.com">01pupworld@gmail.com</a> | <strong>Phone:</strong> <a href="tel:260-710-9103">(260) 710-9103</a></p>
            <p class="mb-0">10512 Schwartz RD. Ft Wayne. IN 46835</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>