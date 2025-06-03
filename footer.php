<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-branding">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="footer-logo">
                        <?php the_custom_logo(); ?>
                    </div>
                <?php endif; ?>
                <p class="footer-site-title"><?php bloginfo( 'name' ); ?></p>
            </div>

            <div class="footer-navigation">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                    'container'      => 'nav',
                    'container_class' => 'footer-nav',
                    'fallback_cb'    => false,
                ) );
                ?>

                <ul class="social-links">
                    <li><a href="https://instagram.com" target="_blank" rel="noopener">Instagram</a></li>
                    <li><a href="https://facebook.com" target="_blank" rel="noopener">Facebook</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-contact">
            <p><strong>Email:</strong> <a href="mailto:01pupworld@gmail.com">01pupworld@gmail.com</a> | <strong>Phone:</strong> <a href="tel:260-710-9103">(260) 710-9103</a></p>
            <p>10512 Schwartz RD. Ft Wayne. IN 46835</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>