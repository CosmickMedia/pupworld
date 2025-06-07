<?php

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure $product is valid
if ( ! $product instanceof WC_Product ) {
    return;
}

// --- Gather core product data ---
$product_id        = $product->get_id();
$product_name      = $product->get_name();
$product_type      = $product->get_type();
$pet_type          = function_exists('wc_ukm_get_pet_type') ? wc_ukm_get_pet_type( $product_id ) : 'Unknown';
$ref_id            = $product->get_meta('reference_number') ?: $product_id;
$status            = $product->get_status();
$video_url         = $product->get_meta('video');
$pet               = (function_exists('wc_ukm_get_pet') && ($p = wc_ukm_get_pet($product_id))) ? $p : new stdClass();
$pet_name          = $product->get_meta( 'pet_name' ) ?: $product_name;
$birth_date        = ! empty( $pet->dob ) && strtotime($pet->dob) ? date( 'm-d-Y', strtotime( $pet->dob ) ) : 'N/A';
$availability_meta = $product->get_meta('availability_date');
$availability      = ! empty($availability_meta) && strtotime($availability_meta) ? date( 'm-d-Y', strtotime($availability_meta) ) : 'N/A';
$coming_soon       = ( $status === 'coming_soon' );
$breed             = ! empty( $pet->breed ) ? $pet->breed : 'Unknown Breed';
$age               = ! empty( $pet->age ) ? $pet->age : 'N/A';
$gender            = ! empty( $pet->gender ) ? $pet->gender : 'N/A';
$color             = ! empty( $pet->color ) ? $pet->color : 'N/A';
$location          = ! empty( $pet->location ) ? $pet->location : 'N/A';
$location_phone    = ! empty( $pet->location_ph ) ? $pet->location_ph : '+1234567890';

// --- Sire & Dam Info ---
$sire_id            = get_post_meta( $product_id, 'sire_registration', true );
$dam_id             = get_post_meta( $product_id, 'dam_registration', true );
$sire_ofa           = $sire_id && function_exists('get_field') ? get_field( 'ofa_tested', $sire_id ) : false;
$dam_ofa            = $dam_id && function_exists('get_field') ? get_field( 'ofa_tested', $dam_id ) : false;
$parents_ofa_tested = ( $sire_ofa && $dam_ofa );
$ofa_tested_label   = $parents_ofa_tested ? 'Yes' : 'No';
$pet_sire    = isset( $pet->sire ) && is_object($pet->sire) ? $pet->sire : new stdClass();
$pet_dam     = isset( $pet->dam ) && is_object($pet->dam) ? $pet->dam : new stdClass();
$sire_photo  = ! empty( $pet_sire->photo ) ? esc_url( $pet_sire->photo ) : get_template_directory_uri() . '/images/placeholder.png';
$dam_photo   = ! empty( $pet_dam->photo ) ? esc_url( $pet_dam->photo ) : get_template_directory_uri() . '/images/placeholder.png';
$sire_breed  = ! empty( $pet_sire->breed ) ? esc_html( $pet_sire->breed ) : 'Unknown Breed';
$dam_breed   = ! empty( $pet_dam->breed ) ? esc_html( $pet_dam->breed ) : 'Unknown Breed';
$sire_registry = ! empty( $pet_sire->registry ) ? esc_html( $pet_sire->registry ) : 'N/A';
$dam_registry  = ! empty( $pet_dam->registry ) ? esc_html( $pet_dam->registry ) : 'N/A';
$sire_weight = ! empty( $pet_sire->weight ) ? esc_html( $pet_sire->weight . ' lbs' ) : 'N/A';
$dam_weight  = ! empty( $pet_dam->weight ) ? esc_html( $pet_dam->weight . ' lbs' ) : 'N/A';

// --- Vitals ---
$current_weight = $product->get_meta('current_weight') ?: 'N/A';
$current_temp   = $product->get_meta('current_temperature') ?: 'N/A';

// --- Determine Status Label ---
$status_label   = '';
$is_available   = false;
$is_purchasable = $product->is_purchasable();
switch ( $status ) {
    case 'publish':
        if ( $product->is_in_stock() ) {
            if ( $product->is_on_sale() ) { $status_label = 'On Sale'; $is_available = true; }
            else { $status_label = 'Available'; $is_available = true; }
        } else { $status_label = 'Sold'; }
        break;
    case 'coming_soon': $status_label = 'Coming Soon'; break;
    case 'on_hold': $status_label = 'On Hold'; break;
    case 'draft': case 'pending': $status_label = 'Unavailable'; break;
    default: $status_label = ucfirst( str_replace( '_', ' ', $status ) ); break;
}

// --- Breeder & CCC Check ---
$breeder_name = 'N/A';
if ( ! empty( $pet->breeders ) ) { $breeder_name = is_array($pet->breeders) ? implode(', ', $pet->breeders) : $pet->breeders; }
elseif ( isset($pet->breeder_obj) && is_object($pet->breeder_obj) && ! empty( $pet->breeder_obj->company ) ) { $breeder_name = $pet->breeder_obj->company; }
$ccc_from_object = ! empty( $pet->breeder_obj->caninecare_certified );
$ccc_from_acf    = false;
if ( ($breeders = get_the_terms( $product_id, 'breeders' )) && is_array($breeders) ) {
    foreach ( $breeders as $breeder ) { if ( function_exists( 'get_field' ) && get_field( 'caninecare_certified', 'breeders_' . $breeder->term_id ) ) { $ccc_from_acf = true; break; } }
}
$canine_care_certified = ( $ccc_from_object || $ccc_from_acf );
$ccc_label = $canine_care_certified ? 'Yes' : 'No';

// --- Sale Badge Text ---
$sale_badge_text = '';
$regular_price = floatval( $product->get_regular_price() );
$sale_price = floatval( $product->get_sale_price() );
$is_on_sale = $product->is_on_sale() && $status_label === 'On Sale';
if ( $is_on_sale && $regular_price > 0 && $sale_price > 0 && $sale_price < $regular_price ) {
    $discount_percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
    $sale_badge_text = ( $discount_percentage > 0 ) ? sprintf( 'Save %d%%', $discount_percentage ) : 'On Sale';
} elseif ($is_on_sale) { $sale_badge_text = 'On Sale'; }

// --- Gather Images ---
$images = [];
if ( has_post_thumbnail( $product_id ) && ($featured_image_url = get_the_post_thumbnail_url( $product_id, 'large' )) ) { $images[] = $featured_image_url; }
if ( function_exists('get_pet_data') && ($pet_images = get_pet_data( $product_id, 'Photos' )) && is_array($pet_images) ) {
    foreach ( $pet_images as $pimg ) { if (isset($pimg->BaseUrl, $pimg->Size800)) { $image_url = $pimg->BaseUrl . $pimg->Size800; if (!in_array($image_url, $images)) { $images[] = $image_url; } } }
}
if ( ($gallery_image_ids = $product->get_gallery_image_ids()) ) {
    foreach ( $gallery_image_ids as $gallery_image_id ) { if ( ($gimg_url = wp_get_attachment_image_url( $gallery_image_id, 'large' )) && !in_array($gimg_url, $images) ) { $images[] = $gimg_url; } }
}
if ( empty($images) ) { $placeholder_image = get_theme_mod('placeholder_image_url', get_template_directory_uri() . '/images/placeholder.png'); $images[] = esc_url($placeholder_image); }
$img_count = count( $images );

// --- Call Pet KB API Function ---
$pet_kb_data = null;
if ( function_exists( 'get_pet_kb_api_data' ) ) {
    $pet_kb_data = get_pet_kb_api_data( $product_id );
} else { error_log('Error: get_pet_kb_api_data() function not found. Ensure inc/pet-kb-api.php is included.'); }

// --- Color Hex Map (for Breed Info Tab display) ---
$color_hex_codes = [
    'black'     => '#000000', 'brown'     => '#964B00', 'white'     => '#FFFFFF',
    'red'       => '#A0522D', /* Sienna-like Red */ 'gold'      => '#FFD700',
    'yellow'    => '#FFFF00', 'gray'      => '#808080', 'grey'      => '#808080',
    'silver'    => '#C0C0C0', 'tan'       => '#D2B48C', 'chocolate' => '#D2691E',
    'orange'    => '#FFA500', 'purple'    => '#800080', /* Less common */ 'pink' => '#FFC0CB', /* Less common */
    'cream'     => '#FFFDD0', 'apricot'   => '#FBCEB1', 'fawn'      => '#E5AA70',
    'blue'      => '#647C9A', /* Grey-Blue */ 'wheaten'   => '#F5DEB3', 'liver'     => '#6C2E1F',
    'sienna'    => '#A0522D', // Alias for Red
    // Patterns are harder to represent: brindle, merle, sable, parti, ticked, roan
];

do_action( 'woocommerce_before_single_product' );
if ( post_password_required() ) { echo get_the_password_form(); return; }
?>

<div id="product-<?php echo esc_attr( $product_id ); ?>" <?php wc_product_class( 'container product pt-lg-5', $product ); ?>>

    <div class="row mb-4">
        <div class="col-12">
            <?php if ( function_exists( 'woocommerce_breadcrumb' ) ) : ?>
                <nav class="woocommerce-breadcrumb" aria-label="Breadcrumb"><?php woocommerce_breadcrumb(); ?></nav>
            <?php endif; ?>
        </div>
    </div>

    <div class="row gx-lg-5">
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="product-gallery">
                <?php
                $badge_base_class = 'badge-base';
                $badge_status_class = $badge_base_class . ' badge-status';
                $badge_sale_class = $badge_base_class . ' badge-sale';
                $badge_coming_soon_class = $badge_base_class . ' badge-coming-soon';
                $specific_status_class = ' status-' . sanitize_html_class( strtolower( $status_label ) );
                $allowed_status_badges = ['Sold', 'On Hold', 'Coming Soon'];
                if ( in_array( $status_label, $allowed_status_badges ) ) {
                    echo '<span class="' . esc_attr( $badge_status_class . $specific_status_class ) . '"><i class="fas fa-info-circle me-1"></i> ' . esc_html( $status_label ) . '</span>';
                } elseif ( ! empty( $sale_badge_text ) ) {
                    echo '<span class="' . esc_attr( $badge_sale_class ) . '"><i class="fas fa-tag me-1"></i> ' . esc_html( $sale_badge_text ) . '</span>';
                }
                if ( $coming_soon ) : ?>
                    <a href="#contact" data-bs-toggle="modal" class="<?php echo esc_attr( $badge_coming_soon_class ); ?>"><i class="fas fa-clock me-1"></i> Notify Me</a>
                <?php endif; ?>

                <div id="gallery" class="carousel slide carousel-fade" data-bs-ride="<?php echo ($img_count > 1) ? 'carousel' : 'false'; ?>" data-bs-interval="<?php echo ($img_count > 1) ? '10000' : 'false'; ?>">
                    <div class="carousel-inner">
                        <?php foreach ( $images as $i => $img_url ) : ?>
                            <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>"><img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $pet_name . ' - ' . $breed . ' - Image ' . ( $i + 1 ) ); ?>" loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>"/></div>
                        <?php endforeach; ?>
                    </div>
                    <?php if ( $img_count > 1 ) : ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#gallery" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#gallery" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
                        <div class="carousel-indicators">
                            <?php foreach ( $images as $i => $img_url ) : ?>
                                <button type="button" data-bs-target="#gallery" data-bs-slide-to="<?php echo $i; ?>" class="<?php echo $i === 0 ? 'active' : ''; ?>" aria-current="<?php echo $i === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?php echo $i + 1; ?>"></button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php do_action( 'pep_single_product_gallery' ); ?>
        </div>

        <div class="col-lg-6 product-primary-info">
            <h1 class="product_title entry-title"><?php echo esc_html( $pet_name ); ?></h1>
            <p class="breed-info"><?php echo esc_html( $breed ); ?></p>
            <span class="ref-id">Ref ID: #<?php echo esc_html( $ref_id ); ?></span>
            <div class="price mb-4"><?php echo $product->get_price_html(); ?></div>
            <ul class="short-details">
                <li><i class="fas fa-venus-mars fa-fw"></i> <strong>Gender:</strong> <?php echo esc_html( $gender ); ?></li>
                <li><i class="fas fa-hourglass-half fa-fw"></i> <strong>Age:</strong> <?php echo esc_html( $age ); ?></li>
                <li><i class="fas fa-map-marker-alt fa-fw"></i> <strong>Location:</strong> <?php echo esc_html( $location ); ?></li>
            </ul>
            <div class="finance-video-icons mb-4">
                <a href="#financeModal" data-bs-toggle="modal" class="finance-btn"><i class="fas fa-money-bill-wave"></i> Financing Available</a>
                <?php if ( ! empty( $video_url ) ) : ?>
                    <a href="#videoModal" data-bs-toggle="modal" data-src="<?php echo esc_url( $video_url ); ?>" class="youtube-btn"><i class="fab fa-youtube"></i> Watch Video</a>
                <?php endif; ?>
            </div>
            <div class="action-buttons">
                <div class="row g-2">
                    <div class="col-sm-4"><a href="tel:<?php echo esc_attr( preg_replace('/[^0-9+]/', '', $location_phone) ); ?>" class="btn btn-light w-100"><i class="fas fa-phone me-2"></i> Call Us</a></div>
                    <div class="col-sm-4"><a href="#contact" data-bs-toggle="modal" class="btn btn-dark w-100"><i class="fas fa-envelope me-2"></i> Ask Question</a></div>
                    <div class="col-sm-4"><a href="#planVisitModal" data-bs-toggle="modal" class="btn btn-dark w-100"><i class="fas fa-calendar-alt me-2"></i> Plan a Visit</a></div>
                    <div class="col-12 mt-2">
                        <?php if ($is_purchasable):
                            $wc_classes = 'single_add_to_cart_button button alt' . ($product->supports('ajax_add_to_cart') ? ' ajax_add_to_cart' : ''); ?>
                            <a href="<?php echo esc_url( wc_get_checkout_url() . '?add-to-cart=' . $product_id ); ?>" class="btn btn-gold btn-lg w-100 d-flex align-items-center gap-2 justify-content-center text-uppercase fw-bold <?php echo esc_attr($wc_classes); ?>" data-quantity="1" data-product_id="<?php echo esc_attr( $product_id ); ?>" data-product_sku="<?php echo esc_attr( $product->get_sku() ); ?>" aria-label="<?php echo esc_attr( $product->add_to_cart_description() ); ?>" rel="nofollow"><i class="fas fa-shopping-cart"></i> Take Me Home</a>
                        <?php else: ?>
                            <button type="button" class="btn btn-secondary btn-lg w-100 text-uppercase fw-bold" disabled>
                                <?php switch ($status_label) { case 'Coming Soon': echo '<i class="fas fa-clock me-2"></i> Coming Soon'; break; case 'On Hold': echo '<i class="fas fa-pause-circle me-2"></i> On Hold'; break; case 'Sold': echo '<i class="fas fa-times-circle me-2"></i> Sold'; break; default: echo '<i class="fas fa-ban me-2"></i> Not Available'; break; } ?>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="info-badges mt-4">
                <?php if ( $canine_care_certified ) : ?>
                    <a href="#canine-care-certified" data-bs-toggle="modal" class="d-inline-block me-2 mb-2" title="Canine Care Certified Breeder"><img src="<?php echo get_template_directory_uri(); ?>/images/cta-canine-care-certified.png" alt="Canine Care Certified" loading="lazy"></a>
                    <?php $ccc_modal_path = get_template_directory() . '/inc/ccc.php'; if (file_exists($ccc_modal_path)) include($ccc_modal_path); ?>
                <?php endif; ?>
                <?php if ( $pet_type === 'Dog' && function_exists('get_field') && get_field( 'puppy_ad_heading', 'option' ) ) : ?>
                    <a href="#warranty" data-bs-toggle="modal" class="d-inline-block me-2 mb-2" title="View Health Warranty"><img src="<?php echo get_template_directory_uri(); ?>/images/cta-warranty.png" alt="Warranty" loading="lazy"></a>
                    <?php $warranty_modal_path = get_template_directory() . '/inc/modal-warranty.php'; if (file_exists($warranty_modal_path)) include($warranty_modal_path); ?>
                <?php endif; ?>
                <?php if ( $parents_ofa_tested ) :?>
                    <a href="#ofa-modal" data-bs-toggle="modal" class="d-inline-block me-2 mb-2" title="Parents are OFA Tested"><img src="<?php echo get_template_directory_uri(); ?>/images/ofa.png" alt="OFA Certified Parents" loading="lazy"></a>
                    <?php $ofa_modal_path = get_template_directory() . '/inc/modal-ofa.php'; if (file_exists($ofa_modal_path)) include($ofa_modal_path); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row product-tabs mt-5">
        <div class="col-12">
            <nav>
                <div class="nav nav-tabs mb-0" id="product-tab" role="tablist">
                    <button class="nav-link active" id="nav-details-tab" data-bs-toggle="tab" data-bs-target="#nav-details" type="button" role="tab" aria-controls="nav-details" aria-selected="true">Details</button>
                    <button class="nav-link" id="nav-parents-tab" data-bs-toggle="tab" data-bs-target="#nav-parents" type="button" role="tab" aria-controls="nav-parents" aria-selected="false">Parents</button>
                    <button class="nav-link" id="nav-breedinfo-tab" data-bs-toggle="tab" data-bs-target="#nav-breedinfo" type="button" role="tab" aria-controls="nav-breedinfo" aria-selected="false">Breed Info</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact &amp; Pricing</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-details" role="tabpanel" aria-labelledby="nav-details-tab">

                        <h4 class="mb-4 visually-hidden">Puppy Specifications</h4>
                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <ul class="detail-list">
                                    <li><span class="detail-label"><i class="fas fa-paw fa-fw me-2 text-muted"></i>Breed</span><span class="detail-value"><?php echo esc_html( $breed ); ?></span></li>
                                    <li><span class="detail-label"><i class="fas fa-venus-mars fa-fw me-2 text-muted"></i>Gender</span><span class="detail-value"><?php echo esc_html( $gender ); ?></span></li>
                                    <li><span class="detail-label"><i class="fas fa-calendar-day fa-fw me-2 text-muted"></i>Date of Birth</span><span class="detail-value"><?php echo esc_html( $birth_date ); ?></span></li>
                                    <li><span class="detail-label"><i class="fas fa-hourglass-half fa-fw me-2 text-muted"></i>Age</span><span class="detail-value"><?php echo esc_html( $age ); ?></span></li>
                                    <li><span class="detail-label"><i class="fas fa-palette fa-fw me-2 text-muted"></i>Color</span><span class="detail-value"><?php echo esc_html( $color ); ?></span></li>
                                    <li><span class="detail-label"><i class="fas fa-weight-hanging fa-fw me-2 text-muted"></i>Current Weight</span><span class="detail-value"><?php echo esc_html( $current_weight ); ?></span></li>
                                    <li><span class="detail-label"><i class="fas fa-thermometer-half fa-fw me-2 text-muted"></i>Current Temp</span><span class="detail-value"><?php echo wp_kses_post( $current_temp ); ?></span></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="detail-list">
                                    <li><span class="detail-label"><i class="fas fa-map-marker-alt fa-fw me-2 text-muted"></i>Location</span><span class="detail-value"><?php echo esc_html( $location ); ?></span></li>
                                    <li><span class="detail-label"><i class="fas fa-hashtag fa-fw me-2 text-muted"></i>Reference ID</span><span class="detail-value"><?php echo esc_html( $ref_id ); ?></span></li>
                                    <li><span class="detail-label"><i class="fas fa-dna fa-fw me-2 text-muted"></i>Registered Parents</span><span class="detail-value">Yes</span></li>
                                    <li><span class="detail-label"><i class="fas fa-award fa-fw me-2 text-muted"></i>Breeder CCC</span><span class="detail-value"><?php echo esc_html( $ccc_label ); ?></span></li>
                                    <li><span class="detail-label"><i class="fas fa-stethoscope fa-fw me-2 text-muted"></i>Parents OFA Tested</span><span class="detail-value"><?php echo $ofa_tested_label; ?></span></li>
                                </ul>
                            </div>
                        </div>
                </div>
                <div class="tab-pane fade parent-info" id="nav-parents" role="tabpanel" aria-labelledby="nav-parents-tab">
                    <h4 class="mb-4">Meet the Parents</h4>
                    <div class="row g-4 align-items-start mt-3">
                        <div class="col-md-6 text-center">
                            <div class="card p-3">
                                <div class="d-flex justify-content-center mb-3"><img src="<?php echo $dam_photo; ?>" class="rounded-circle" alt="Dam (Mother)" loading="lazy"/></div>
                                <h5 class="fw-bold mb-3">I’m Mom</h5><p><?php echo $dam_breed; ?></p><p><strong>Registry:</strong> <?php echo $dam_registry; ?></p><p><strong>Weight:</strong> <?php echo $dam_weight; ?></p><p><strong>OFA Tested:</strong> <?php echo $dam_ofa ? 'Yes' : 'No'; ?></p>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <div class="card p-3">
                                <div class="d-flex justify-content-center mb-3"><img src="<?php echo $sire_photo; ?>" class="rounded-circle" alt="Sire (Father)" loading="lazy"/></div>
                                <h5 class="fw-bold mb-3">I’m Dad</h5><p><?php echo $sire_breed; ?></p><p><strong>Registry:</strong> <?php echo $sire_registry; ?></p><p><strong>Weight:</strong> <?php echo $sire_weight; ?></p><p><strong>OFA Tested:</strong> <?php echo $sire_ofa ? 'Yes' : 'No'; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-breedinfo" role="tabpanel" aria-labelledby="nav-breedinfo-tab">
                    <?php if ( ! is_wp_error( $pet_kb_data ) && ! empty( $pet_kb_data ) ) :
                        $kb_imageItems = [];
                        if ( ! empty( $pet_kb_data['featured_image_url'] ) ) { $kb_imageItems[] = ['content' => $pet_kb_data['featured_image_url'], 'alt' => esc_attr( $pet_kb_data['title'] ) . ' - Featured Image']; }
                        if ( ! empty( $pet_kb_data['sub_image_urls'] ) ) { foreach ( $pet_kb_data['sub_image_urls'] as $imgUrl ) { $kb_imageItems[] = ['content' => $imgUrl, 'alt' => esc_attr( $pet_kb_data['title'] ) . ' - Image']; } }
                        $kb_videoItems = $pet_kb_data['video_ids'] ?? [];
                        ?>
                        <h4>About The <?php echo esc_html( $pet_kb_data['title'] ?: $breed ); ?> Breed</h4>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="carousel-column-container">
                                    <?php if (!empty($kb_imageItems)): ?>
                                        <div id="petKbImageCarousel" class="carousel slide" data-bs-ride="false">
                                            <div class="carousel-inner">
                                                <?php foreach ($kb_imageItems as $index => $item): ?>
                                                    <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>"><img src="<?php echo esc_url($item['content']); ?>" class="d-block" alt="<?php echo esc_attr($item['alt']); ?>"></div>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php if (count($kb_imageItems) > 1): ?>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#petKbImageCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#petKbImageCarousel" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="media-placeholder">No breed images available</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="carousel-column-container">
                                    <?php if (!empty($kb_videoItems)): ?>
                                        <div id="petKbVideoCarousel" class="carousel slide" data-bs-ride="false">
                                            <div class="carousel-inner">
                                                <?php foreach ($kb_videoItems as $index => $ytId):
                                                    $yt_params = http_build_query(['controls'=>1, 'rel'=>0, 'modestbranding'=>1, 'showinfo'=>0, 'enablejsapi'=>1, 'origin'=>esc_attr(get_home_url())]);
                                                    $yt_src = "https://www.youtube.com/embed/".esc_attr($ytId)."?".$yt_params; ?>
                                                    <div class="carousel-item <?php echo ($index === 0) ? 'active' : ''; ?>"><iframe src="<?php echo esc_url($yt_src); ?>" title="YouTube video player - <?php echo esc_attr($pet_kb_data['title'] ?: $breed); ?>" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>
                                                <?php endforeach; ?>
                                            </div>
                                            <?php if (count($kb_videoItems) > 1): ?>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#petKbVideoCarousel" data-bs-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span></button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#petKbVideoCarousel" data-bs-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span></button>
                                            <?php endif; ?>
                                        </div>
                                    <?php else: ?>
                                        <div class="media-placeholder">No breed videos available</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <?php
                        $kb_stats = $pet_kb_data['stats'] ?? [];
                        $kb_size_info = $pet_kb_data['size'] ?? [];
                        $has_kb_stats = !empty($kb_stats['weight']['min']) || !empty($kb_stats['weight']['max']) ||
                            !empty($kb_stats['height']['min']) || !empty($kb_stats['height']['max']) ||
                            !empty($kb_stats['lifespan']['min']) || !empty($kb_stats['lifespan']['max']) ||
                            !empty($kb_stats['litter_size']['min']) || !empty($kb_stats['litter_size']['max']) ||
                            (!empty($kb_size_info) && is_array($kb_size_info));
                        ?>
                        <?php if ($has_kb_stats): ?>
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-5 text-center mb-4 gy-3">
                            <?php if(!empty($kb_stats['weight']['min']) || !empty($kb_stats['weight']['max'])): ?>
                                <div class="col"><i class="fas fa-weight-hanging fa-2x mb-2 stat-icon"></i><br/><strong>Weight:</strong><br/><?php echo esc_html($kb_stats['weight']['min']) . (isset($kb_stats['weight']['min'], $kb_stats['weight']['max']) && $kb_stats['weight']['min'] !== '' && $kb_stats['weight']['max'] !== '' ? ' - ' : '') . esc_html($kb_stats['weight']['max']) . (isset($kb_stats['weight']['unit']) ? ' ' . esc_html($kb_stats['weight']['unit']) : ''); ?></div>
                            <?php endif; ?>
                            <?php if(!empty($kb_stats['height']['min']) || !empty($kb_stats['height']['max'])): ?>
                                <div class="col"><i class="fas fa-ruler-vertical fa-2x mb-2 stat-icon"></i><br/><strong>Height:</strong><br/><?php echo esc_html($kb_stats['height']['min']) . (isset($kb_stats['height']['min'], $kb_stats['height']['max']) && $kb_stats['height']['min'] !== '' && $kb_stats['height']['max'] !== '' ? ' - ' : '') . esc_html($kb_stats['height']['max']) . (isset($kb_stats['height']['unit']) ? ' ' . esc_html($kb_stats['height']['unit']) : ''); ?></div>
                            <?php endif; ?>
                            <?php if(!empty($kb_stats['lifespan']['min']) || !empty($kb_stats['lifespan']['max'])): ?>
                                <div class="col"><i class="fas fa-heartbeat fa-2x mb-2 stat-icon"></i><br/><strong>Lifespan:</strong><br/><?php echo esc_html($kb_stats['lifespan']['min']) . (isset($kb_stats['lifespan']['min'], $kb_stats['lifespan']['max']) && $kb_stats['lifespan']['min'] !== '' && $kb_stats['lifespan']['max'] !== '' ? ' - ' : '') . esc_html($kb_stats['lifespan']['max']) . (isset($kb_stats['lifespan']['unit']) ? ' ' . esc_html($kb_stats['lifespan']['unit']) : ''); ?></div>
                            <?php endif; ?>
                            <?php if(isset($kb_stats['litter_size']['min']) && $kb_stats['litter_size']['min'] !== '' || isset($kb_stats['litter_size']['max']) && $kb_stats['litter_size']['max'] !== ''): ?>
                                <div class="col"><i class="fas fa-paw fa-2x mb-2 stat-icon"></i><br/><strong>Litter Size:</strong><br/><?php echo esc_html($kb_stats['litter_size']['min']) . (isset($kb_stats['litter_size']['min'], $kb_stats['litter_size']['max']) && $kb_stats['litter_size']['min'] !== '' && $kb_stats['litter_size']['max'] !== '' && $kb_stats['litter_size']['max'] != 0 ? ' - ' : '') . ($kb_stats['litter_size']['max'] != 0 ? esc_html($kb_stats['litter_size']['max']) : ''); ?></div>
                            <?php endif; ?>
                            <?php if ( !empty($kb_size_info) && is_array($kb_size_info) ): ?>
                                <div class="col"><i class="fas fa-dog fa-2x mb-2 stat-icon"></i><br/><strong>Size:</strong><br/><?php echo esc_html( implode(', ', $kb_size_info) ); ?></div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <?php $kb_colors = $pet_kb_data['colors'] ?? []; $kb_traits = $pet_kb_data['traits'] ?? []; ?>
                        <?php if (!empty($kb_colors) || !empty($kb_traits)): ?>
                        <div class="row mb-4 gy-3">
                            <?php if (!empty($kb_traits)): ?>
                                <div class="col-md-6">
                                    <h5 class="mb-3">Traits</h5>
                                    <div><?php foreach ($kb_traits as $traitName): ?><span class="badge badge-trait"><?php echo esc_html($traitName); ?></span><?php endforeach; ?></div>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($kb_colors)): ?>
                                <div class="col-md-6">
                                    <h5 class="mb-3">Color Varieties</h5>
                                    <div><?php foreach ($kb_colors as $colorName): $colorName_trimmed = trim($colorName); if (empty($colorName_trimmed)) continue; $color_lower = strtolower($colorName_trimmed); $hexCode = $color_hex_codes[$color_lower] ?? '#D3D3D3'; ?><span class="color-label"><span class="color-swatch" style="background-color: <?php echo esc_attr($hexCode); ?>;" title="<?php echo esc_attr($colorName_trimmed); ?>"></span><?php echo esc_html($colorName_trimmed); ?></span><?php endforeach; ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                        <?php $kb_characteristics = $pet_kb_data['characteristics'] ?? []; ?>
                        <?php if (!empty($kb_characteristics)): ?>
                        <div class="mb-4">
                            <h5 class="mb-3">Characteristics</h5>
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gy-3">
                                <?php foreach($kb_characteristics as $label => $rating_value): ?>
                                    <div class="col characteristic-item"><strong><?php echo esc_html($label); ?>:</strong><div class="level-bar mt-1"><?php for ($i = 1; $i <= 5; $i++): ?><div class="level-segment <?php echo ($rating_value >= $i) ? 'active' : ''; ?>"></div><?php endfor; ?></div></div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php $kb_descriptions = $pet_kb_data['descriptions'] ?? []; ?>
                        <?php if (!empty($kb_descriptions)): ?>
                        <div class="mb-4">
                            <h5 class="mb-3">Breed Information</h5>
                            <div class="accordion" id="kbDescriptionAccordion">
                                <?php foreach ($kb_descriptions as $index => $desc): $descTitle = trim($desc['title'] ?? ''); $descTitle = !empty($descTitle) ? $descTitle : 'Details ' . ($index + 1); $descContent = trim($desc['content'] ?? ''); $collapseId = 'kbDescCollapse-' . esc_attr($product_id) . '-' . $index; $headingId = 'kbDescHeading-' . esc_attr($product_id) . '-' . $index; ?>
                                    <?php if (!empty($descContent)) : ?>
                                        <div class="accordion-item"><h5 class="accordion-header" id="<?php echo esc_attr($headingId); ?>"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($collapseId); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr($collapseId); ?>"><i class="bi bi-chevron-right"></i><span><?php echo esc_html($descTitle); ?></span></button></h5><div id="<?php echo esc_attr($collapseId); ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo esc_attr($headingId); ?>" data-bs-parent="#kbDescriptionAccordion"><div class="accordion-body"><?php echo wp_kses_post(wpautop($descContent)); ?></div></div></div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php $kb_faqs = $pet_kb_data['faqs'] ?? []; ?>
                        <?php if (!empty($kb_faqs)): ?>
                        <div class="mb-4">
                            <h5 class="mb-3">Frequently Asked Questions</h5>
                            <div class="accordion" id="kbFaqAccordion">
                                <?php $valid_faqs = []; ?>
                                <?php foreach ($kb_faqs as $index => $faq): $question = trim($faq['question'] ?? ''); $answer = trim($faq['answer'] ?? ''); $collapseId = 'kbFaqCollapse-' . esc_attr($product_id) . '-' . $index; $headingId = 'kbFaqHeading-' . esc_attr($product_id) . '-' . $index; ?>
                                    <?php if (!empty($question) && !empty($answer)) : $valid_faqs[] = ['question' => $question, 'answer' => $answer]; ?>
                                        <div class="accordion-item"><h5 class="accordion-header" id="<?php echo esc_attr($headingId); ?>"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($collapseId); ?>" aria-expanded="false" aria-controls="<?php echo esc_attr($collapseId); ?>"><i class="bi bi-chevron-right"></i><span><?php echo esc_html($question); ?></span></button></h5><div id="<?php echo esc_attr($collapseId); ?>" class="accordion-collapse collapse" aria-labelledby="<?php echo esc_attr($headingId); ?>" data-bs-parent="#kbFaqAccordion"><div class="accordion-body"><?php echo wp_kses_post(wpautop($answer)); ?></div></div></div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <?php if (!empty($valid_faqs)): ?>
                                <script type="application/ld+json">
                                    <?php $schema = ['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => []]; foreach ($valid_faqs as $faq) { $schema['mainEntity'][] = ['@type' => 'Question', 'name' => wp_strip_all_tags(html_entity_decode($faq['question'])), 'acceptedAnswer' => ['@type' => 'Answer', 'text' => wp_strip_all_tags(html_entity_decode($faq['answer']))]]; } echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>
                                </script>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>

                    <?php else : ?>
                        <div class="alert alert-secondary" role="alert">
                            Detailed breed information is currently unavailable for this pet.
                            <?php if ( current_user_can('manage_options') && is_wp_error( $pet_kb_data ) ) { echo '<br><small><i>Admin Info: ' . esc_html( $pet_kb_data->get_error_message() ) . ' (Code: ' . esc_html( $pet_kb_data->get_error_code() ) . ')</i></small>'; } elseif ( current_user_can('manage_options') && empty( $pet_kb_data ) && function_exists('get_pet_kb_api_data') ) { echo '<br><small><i>Admin Info: API call succeeded but returned no data.</i></small>'; } elseif ( current_user_can('manage_options') && ! function_exists('get_pet_kb_api_data') ) { echo '<br><small><i>Admin Info: API function get_pet_kb_api_data() not found.</i></small>'; } ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <h4 class="mb-4">Pricing &amp; Inquiries</h4>
                    <p>Have questions about this puppy or the adoption process? Fill out the form below or use the contact buttons at the top of the page.</p>
                    <div class="mt-3"><?php if (shortcode_exists('gravityform')) { echo do_shortcode( '[gravityform id="2" title="false" description="false" ajax="true"]' ); } else { echo '<p class="text-danger">Contact form unavailable.</p>'; } ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="financeModal" tabindex="-1" aria-labelledby="financeModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="financeModalLabel">Financing Options</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><?php $finance_options_path = get_template_directory() . '/inc/financing-options.php'; if (file_exists($finance_options_path)) { include( $finance_options_path ); } else { echo '<p>Financing information unavailable.</p>'; } ?></div></div></div></div>
    <?php if ( $video_url ) : ?><div class="modal fade" id="videoModal" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-dialog-centered modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Watch Me Play!</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body p-0"><div class="ratio ratio-16x9"><iframe src="" title="Puppy Video" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen loading="lazy"></iframe></div></div></div></div></div><?php endif; ?>
    <div class="modal fade" id="planVisitModal" tabindex="-1" aria-labelledby="planVisitModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="planVisitModalLabel">Plan Your Visit</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><p>Interested in meeting <?php echo esc_html($pet_name); ?>? Please fill out the form below to schedule a visit.</p><?php if ( shortcode_exists( 'gravityform' ) ) { echo do_shortcode( '[gravityform id="5" title="false" description="false" ajax="true"]' ); } else { echo '<p class="text-danger">Form unavailable.</p>'; } ?></div></div></div></div>
    <?php $contact_modal_path = get_template_directory() . '/inc/modal-form.php'; if (file_exists($contact_modal_path)) { include($contact_modal_path); } ?>

    <div class="related-products-section mt-5"><?php woocommerce_output_related_products(); ?></div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const videoModal = document.getElementById('videoModal');
        if (videoModal) {
            const iframe = videoModal.querySelector('iframe');
            if (iframe) {
                videoModal.addEventListener('show.bs.modal', (event) => {
                    const button = event.relatedTarget;
                    const src = button?.getAttribute('data-src');
                    if (src) {
                        let embedSrc = src;
                        try {
                            const url = new URL(src);
                            let videoId;
                            if (url.hostname.includes('youtube.com') || url.hostname.includes('youtu.be')) {
                                videoId = url.searchParams.get('v') || url.pathname.split('/').pop();
                                if(videoId) embedSrc = `https://www.youtube-nocookie.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1`;
                            } else if (url.hostname.includes('vimeo.com')) {
                                videoId = url.pathname.split('/').pop();
                                if (videoId && /^\d+$/.test(videoId)) embedSrc = `https://player.vimeo.com/video/${videoId}?autoplay=1&title=0&byline=0&portrait=0`;
                            }
                        } catch (e) {
                            if (src.includes('/embed/')) embedSrc = src + (src.includes('?') ? '&' : '?') + 'autoplay=1';
                            console.warn('Could not parse video URL, attempting basic embed:', src);
                        }
                        iframe.src = embedSrc;
                    }
                });
                videoModal.addEventListener('hidden.bs.modal', () => { if(iframe) iframe.src = ""; });
            }
        }
        const planVisitModal = document.getElementById('planVisitModal');
        if (planVisitModal) {
            planVisitModal.addEventListener('show.bs.modal', () => {
                const petNameField = planVisitModal.querySelector('#input_5_1');
                const refIdField = planVisitModal.querySelector('#input_5_2');
                if (petNameField) petNameField.value = "<?php echo esc_js( $pet_name . ' (Ref ID: ' . $ref_id . ')' ); ?>";
                if (refIdField) refIdField.value = "<?php echo esc_js( $ref_id ); ?>";
            });
        }
        <?php if ( ! is_wp_error( $pet_kb_data ) && ! empty( $pet_kb_data ) ) : ?>
        const breedInfoTabPane = document.getElementById('nav-breedinfo');
        if (breedInfoTabPane) {
            const initializeKbCarousel = (selector) => {
                const element = breedInfoTabPane.querySelector(selector);
                if (element && element.querySelector('.carousel-item')) {
                    try {
                        if (!bootstrap.Carousel.getInstance(element)) new bootstrap.Carousel(element, { interval: false, wrap: true });
                    } catch (e) { console.error(`Error KB Carousel ${selector}:`, e); }
                }
            };
            initializeKbCarousel('#petKbImageCarousel');
            initializeKbCarousel('#petKbVideoCarousel');
            const kbAccordions = breedInfoTabPane.querySelectorAll('.accordion');
            kbAccordions.forEach(accordion => {
                accordion.querySelectorAll('.accordion-collapse').forEach(collapseElement => {
                    collapseElement.addEventListener('show.bs.collapse', event => {
                        const button = accordion.querySelector(`[data-bs-target="${'#'+event.target.id}"]`);
                        const icon = button?.querySelector('i.bi');
                        if (icon) icon.style.transform = 'rotate(90deg)';
                    });
                    collapseElement.addEventListener('hide.bs.collapse', event => {
                        const button = accordion.querySelector(`[data-bs-target="${'#'+event.target.id}"]`);
                        const icon = button?.querySelector('i.bi');
                        if (icon) icon.style.transform = 'rotate(0deg)';
                    });
                    if (collapseElement.classList.contains('show')) {
                        const button = accordion.querySelector(`[data-bs-target="${'#'+collapseElement.id}"]`);
                        const icon = button?.querySelector('i.bi');
                        if (icon) icon.style.transform = 'rotate(90deg)';
                    }
                });
            });
        }
        <?php endif; ?>
    });
</script>

<?php do_action( 'woocommerce_after_single_product' ); ?>
