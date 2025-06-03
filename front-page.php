<?php
/**
 * Front page template for Bark.
 *
 * @package Bark
 */

get_header();
?>

    <main id="primary" class="site-main">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bark' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div>
            </article>
        <?php endwhile; ?>
    </main>

<?php
get_footer();