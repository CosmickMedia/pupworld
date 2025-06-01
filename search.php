<?php get_header(); ?>
<main id="primary" class="site-main">
    <header class="page-header">
        <h1 class="page-title"><?php printf( esc_html__( 'Search results for: %s', 'bark' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
    </header>
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </header>
                <div class="entry-content">
                    <?php the_excerpt(); ?>
                </div>
            </article>
        <?php endwhile; ?>
        <?php the_posts_pagination(); ?>
    <?php else : ?>
        <p><?php esc_html_e( 'No results found.', 'bark' ); ?></p>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
