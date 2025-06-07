<?php
# Package: loop-product

# Get variable(s)
global $product, $wc_petkey_settings;

# Set variable(s)
$product_id = $product->get_id();
$product_short_desc = $product->get_short_description();
$image_size = 'large';
$product_image = $product->get_image( $image_size, [ 'class' => 'object-fit-cover', 'alt' => $product_short_desc ] );
$breed_name = wc_get_product_category_list( $product_id, ', ', '', '' );
$link = $product->get_permalink();
$price = $product->get_price_html();
$location = apply_filters( 'woocommerce_product_maybe_location', false, $product );
$status = $product->get_meta( 'status' );
$ref_id = $product->get_meta( 'reference_number' );
$birth_date = $product->get_meta( 'birth_date' );
$pet_name = $product->get_meta( 'pet_name' );
$gender = $product->get_attribute( 'pa_gender' );
$location_name = $product->get_attribute( 'pa_organization' );
$color = $product->get_attribute( 'pa_color' );
$location_phone = $wc_petkey_settings->location_phone;
$gform_pet_inquiry_popup = get_field( 'gform_pet_inquiry_popup', 'option' ) ?? '';
$featured_image_id = $product->get_image_id();
$featured_image_url = wp_get_attachment_image_url( $featured_image_id, $image_size );
$pet_type = wc_ukm_get_pet_type( $product_id, 'slug' );
$hidden_fields = [];

# Validate variable(s)
if ( $breed_name ) {
	$breed_name = str_replace( ' href="', ' class="text-reset" href="', $breed_name );
}

if ( ! empty( $gform_pet_inquiry_popup ) ) {
        $hidden_fields = [
                'type' => esc_attr( strToUpper( $pet_type ) ),
                'breed' => esc_attr( strip_tags( $breed_name ) ),
                // Use the product ID as the pet ID reference.
                'petid' => esc_attr( $product_id ),
                'reference' => esc_attr( $ref_id ),
		'gender' => esc_attr( $gender ),
		'color' => esc_attr( $color ),
		'dob' => esc_attr( date( 'm/d/Y', strtotime( $birth_date ) ) ),
		'loc' => esc_attr( $location_name ),
		'image' => esc_attr( $featured_image_url ),
	];
}
?>
<form id="petInquiry<?= $ref_id ?>">
	<?php foreach ( $hidden_fields as $key => $value ) : ?>
	<input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
	<?php endforeach ?>
</form>

<div class="card pet-card shadow-sm border-0 rounded-3 overflow-hidden transition-hover">
    <a href="<?= $link ?>" class="text-decoration-none position-relative" aria-label="View details for <?= strip_tags( $breed_name ) ?>">
        <!-- Card Header with Price -->
        <div class="position-relative">
            <div class="position-absolute top-0 end-0 m-2 z-index-1">
                <div class="product-price-tag badge bg-gold rounded-pill fs-6 py-2 px-3 shadow-sm">
                    <?= $price ?>
                </div>
            </div>

            <!-- Card Image -->
            <?= $product_image ?>
        </div>
    </a>

    <!-- Card Body -->
    <div class="card-body p-3">
        <div class="row">
            <div class="col">
                <!-- Pet Breed -->
                <div class="pet-breed mb-1">
                    <span class="badge bg-light text-dark rounded-pill fs-6"><?= $breed_name ?></span>
                </div>

                <!-- Pet Name (as card title) -->
                <h5 class="card-title pet-name fw-bold mb-2">Hi, my name is <?= $pet_name ?>!</h5>

                <!-- Pet Details -->
                <div class="card-text">
                    <div class="pet-detail pet-gender d-flex align-items-center mb-1">
                        <strong class="me-1">Gender:</strong> <?= $gender ?>
                    </div>

                    <div class="pet-detail pet-ref d-flex align-items-center">
                        <strong class="me-1">Ref:</strong> <span class="ref-id badge bg-light text-dark">#<?= $ref_id ?></span>
                    </div>
                </div>
            </div>

            <!-- Card Actions -->
            <div class="col-auto d-flex flex-column align-items-stretch justify-content-center gap-2">
                <a href="tel:<?= $location['phone'] ?>" class="btn btn-light btn-sm d-flex flex-column align-items-center gap-1 z-2 action-icon" title="Call Us">
                    <i class="fas fa-phone-alt"></i>
                    <small>Call</small>
                </a>

                <a href="mailto:01pupworld@gmail.com" class="btn btn-dark btn-sm d-flex flex-column align-items-center gap-1 z-2 action-icon" title="Email Us">
                    <i class="fas fa-envelope"></i>
                    <small>Email</small>
                </a>
            </div>
        </div>
    </div>

    <!-- Card Footer -->
    <div class="card-footer bg-transparent border-top-0 text-center p-2">
        <a href="<?= $link ?>" class="btn btn-gold w-100 stretched-link">View Details</a>
    </div>
</div>
