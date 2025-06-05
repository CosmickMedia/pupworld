<?php
/**
 * Reviews custom post type and functionality.
 */

// Register Custom Post Type
function pupworld_register_reviews_cpt() {
    $labels = array(
        'name' => 'Reviews',
        'singular_name' => 'Review',
        'add_new_item' => 'Add New Review',
        'edit_item' => 'Edit Review',
        'new_item' => 'New Review',
        'view_item' => 'View Review',
        'search_items' => 'Search Reviews',
        'not_found' => 'No reviews found',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_in_rest' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'menu_position' => 20,
        'menu_icon' => 'dashicons-star-filled',
    );

    register_post_type( 'review', $args );
}
add_action( 'init', 'pupworld_register_reviews_cpt' );

// Rating meta box
function pupworld_review_rating_meta_box() {
    add_meta_box(
        'pupworld_review_rating',
        'Rating',
        'pupworld_review_rating_cb',
        'review',
        'side'
    );
}
add_action( 'add_meta_boxes', 'pupworld_review_rating_meta_box' );

function pupworld_review_rating_cb( $post ) {
    $rating = get_post_meta( $post->ID, '_pupworld_review_rating', true );
    if ( ! $rating ) {
        $rating = 5;
    }
    echo '<select name="pupworld_review_rating" id="pupworld_review_rating">';
    for ( $i = 1; $i <= 5; $i++ ) {
        printf( '<option value="%1$d" %2$s>%1$d Star%3$s</option>', $i, selected( $rating, $i, false ), $i === 1 ? '' : 's' );
    }
    echo '</select>';
}

function pupworld_save_review_meta( $post_id ) {
    if ( isset( $_POST['pupworld_review_rating'] ) ) {
        update_post_meta( $post_id, '_pupworld_review_rating', intval( $_POST['pupworld_review_rating'] ) );
    }
}
add_action( 'save_post_review', 'pupworld_save_review_meta' );

function pupworld_get_review_rating_html( $rating ) {
    $output = '';
    for ( $i = 1; $i <= 5; $i++ ) {
        if ( $i <= intval( $rating ) ) {
            $output .= '<i class="fas fa-star text-warning"></i>';
        } else {
            $output .= '<i class="far fa-star text-warning"></i>';
        }
    }
    return $output;
}
