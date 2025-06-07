<?php
/**
 * Template Name: Available Breeds Template
 */

get_header();
?>
<main id="primary" class="site-main available-breeds">
    <div class="container py-5">
        <div class="text-center mb-4">
            <input type="text" id="breed-search" class="form-control form-control-lg w-50 mx-auto" placeholder="Search Breeds...">
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="breedsGrid">
            <?php
            $parent = get_term_by( 'slug', 'puppies-for-sale', 'product_cat' );
            $categories = [];
            if ( $parent ) {
                $categories = get_terms([
                    'taxonomy'   => 'product_cat',
                    'parent'     => $parent->term_id,
                    'hide_empty' => true,
                    'orderby'    => 'name',
                    'order'      => 'ASC',
                ]);
            }
            if ( $categories && ! is_wp_error( $categories ) ) :
                foreach ( $categories as $cat ) :
                    $thumb_id = get_term_meta( $cat->term_id, 'thumbnail_id', true );
                    $image    = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'medium' ) : wc_placeholder_img_src();
                    $count    = $cat->count;
            ?>
            <div class="col breed-card" data-breed="<?php echo strtolower( esc_attr( $cat->name ) ); ?>">
                <div class="card h-100 text-center">
                    <img class="card-img-top img-fluid" src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $cat->name ); ?>">
                    <div class="card-body d-flex flex-column">
                        <h3 class="h5 card-title"><?php echo esc_html( $cat->name ); ?></h3>
                        <p class="mb-2"><?php echo esc_html( $count ); ?> Available</p>
                        <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="btn btn-gold mt-auto">View all <?php echo esc_html( $cat->name ); ?>'s</a>
                    </div>
                </div>
            </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var input = document.getElementById('breed-search');
    input.addEventListener('keyup', function() {
        var filter = input.value.toLowerCase();
        document.querySelectorAll('#breedsGrid .breed-card').forEach(function(card) {
            var name = card.getAttribute('data-breed');
            if (name.indexOf(filter) > -1) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
</script>
<?php
get_footer();
?>
