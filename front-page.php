<?php
/**
 * Custom front page rebuilt from static backup.
 *
 * @package Pup World
 */

get_header();
?>

<main id="primary" class="site-main homepage">
    <section class="hero text-center text-white d-flex align-items-center">
        <div class="container">
            <h1 class="display-4 mb-3">Find your best friend!</h1>
            <a class="btn btn-cta btn-lg" href="/all-puppies">See puppies <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
    </section>

    <section class="adoption mb-5">
        <div class="container py-5">
            <div class="row mb-4 align-items-start">
                <div class="col-md-6">
                    <h2 class="section-title">Available for adoption</h2>
                    <p class="subtitle">17 Available breeds</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="adoption-copy">Our puppies are waiting for loving homes. Choose your perfect companion and experience unconditional love.</p>
                </div>
            </div>
            <?php
            $parent = get_term_by( 'slug', 'puppies-for-sale', 'product_cat' );
            $categories = [];
            if ( $parent ) {
                $categories = get_terms( [
                    'taxonomy'   => 'product_cat',
                    'parent'     => $parent->term_id,
                    'hide_empty' => true,
                ] );
            }
            ?>
            <div id="adoptionCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
                        <?php foreach ( $categories as $index => $cat ) : ?>
                            <?php
                            $thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                            $image    = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium' ) : wc_placeholder_img_src();
                            ?>
                            <div class="carousel-item <?php echo 0 === $index ? 'active' : ''; ?>">
                                <article class="breed mx-auto" style="max-width:300px;">
                                    <div class="card h-100 text-center position-relative">
                                        <img class="card-img-top img-fluid" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $cat->name ); ?>">
                                        <div class="card-body">
                                            <h3 class="card-title"><?php echo esc_html( $cat->name ); ?></h3>
                                            <p class="card-text"><?php echo esc_html( $cat->description ); ?></p>
                                            <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="arrow-link"><i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#adoptionCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#adoptionCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div class="text-center mt-3">
                <a href="/all-breeds" class="btn btn-cta">See All Breeds <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </section>

    <div class="container py-4">

    <section class="financing py-5">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-4 mb-md-0">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/finance-pet.png" alt="Finance Pet" class="img-fluid d-block mb-3" />
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/splitit.png" alt="Splitit" class="img-fluid d-block" />
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-money-bill-wave fa-2x me-3"></i>
                    <h2 class="display-5 mb-0">Financing Options</h2>
                </div>
                <p class="lead">We offer financing through IGW and Splitit, making it easier than ever to bring home your new best friend. Contact us to learn more or to get started!</p>
                <a href="/financing" class="btn btn-cta btn-lg">Learn More <i class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </section>

    <?php
    echo do_blocks( '<!-- wp:pattern {"slug":"bark/about"} /-->' );
    ?>
    </div>
</main>

<?php
get_footer();
