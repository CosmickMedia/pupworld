<?php
/**
 * Custom front page rebuilt from static backup.
 *
 * @package Bark
 */

get_header();
?>

<main id="primary" class="site-main homepage">
    <?php
    echo do_blocks( '<!-- wp:pattern {"slug":"bark/home-intro"} /-->' );
    ?>

    <section class="adoption">
        <h2>Available for adoption</h2>
        <div class="breeds">
            <article class="breed">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/pexels-goochie-poochie-19145889.jpg" alt="Golden Retriever">
                <h3>Golden Retriever</h3>
                <p>Known for their gentle nature, intelligence, and playful spirit, Goldens make the perfect family companion.</p>
            </article>
            <article class="breed">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/pexels-jagheterjohann-12541401-1.jpg" alt="Golden Doodle">
                <h3>Golden Doodle</h3>
                <p>With their affectionate nature, intelligence, and low-shedding coats, Goldendoodles make the perfect family companion, bringing warmth, joy, and endless fun into your home.</p>
            </article>
            <article class="breed">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/pexels-blue-bird-7210704.jpg" alt="Rottweiler">
                <h3>Rottweiler</h3>
                <p>With their calm and confident demeanor, combined with a deep bond to their family, makes them not only excellent protectors but also affectionate and loving companions who thrive in a caring home.</p>
            </article>
            <article class="breed">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/pexels-samson-katt-5255596-1.jpg" alt="Yorkshire Terrier">
                <h3>Yorkshire Terrier</h3>
                <p>Trust us to whisk your pet off to the doctor’s for their check-up. They’ll be in safe hands, ensuring they stay healthy and happy.</p>
            </article>
        </div>
    </section>

    <section class="financing">
        <h2>Financing Options</h2>
        <p>Please contact us to learn more about flexible payment plans for your new puppy.</p>
    </section>

    <?php
    echo do_blocks( '<!-- wp:pattern {"slug":"bark/about"} /-->' );
    ?>

    <section class="mission">
        <h2>Our Mission</h2>
        <p>Our mission is simple: to bring joy to families by providing them with loyal, loving companions while ensuring the highest standards of health, care, and ethics. We believe every puppy deserves a home where they are cherished.</p>
    </section>

    <?php
    echo do_blocks( '<!-- wp:pattern {"slug":"bark/testimonials"} /-->' );
    ?>

    <section class="location">
        <h2>Where are we?</h2>
        <p>10512 Schwartz Rd, Ft Wayne, IN 46835</p>
    </section>

    <?php
    echo do_blocks( '<!-- wp:pattern {"slug":"bark/latest-posts"} /-->' );
    echo do_blocks( '<!-- wp:pattern {"slug":"bark/contact"} /-->' );
    ?>
</main>

<?php
get_footer();
