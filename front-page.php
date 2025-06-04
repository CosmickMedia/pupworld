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
            <a class="btn btn-primary btn-lg" href="/all-puppies">See puppies</a>
        </div>
    </section>

    <section class="adoption mb-5">
        <div class="container py-4">
        <h2 class="mb-4">Available for adoption</h2>
        <div class="row breeds">
            <article class="breed col-md-3 text-center">
                <img class="img-fluid" src="/wp-content/uploads/2025/04/golden-retreiver.jpg" alt="Golden Retriever">
                <h3>Golden Retriever</h3>
                <p>Known for their gentle nature, intelligence, and playful spirit, Goldens make the perfect family companion.</p>
            </article>
            <article class="breed col-md-3 text-center">
                <img class="img-fluid" src="/wp-content/uploads/2025/04/golden-doodle.jpg" alt="Golden Doodle">
                <h3>Golden Doodle</h3>
                <p>With their affectionate nature, intelligence, and low-shedding coats, Goldendoodles make the perfect family companion, bringing warmth, joy, and endless fun into your home.</p>
            </article>
            <article class="breed col-md-3 text-center">
                <img class="img-fluid" src="/wp-content/uploads/2025/04/rottweiler.jpg" alt="Rottweiler">
                <h3>Rottweiler</h3>
                <p>With their calm and confident demeanor, combined with a deep bond to their family, makes them not only excellent protectors but also affectionate and loving companions who thrive in a caring home.</p>
            </article>
            <article class="breed col-md-3 text-center">
                <img class="img-fluid" src="/wp-content/uploads/2025/04/yorkshire-terrier.jpg" alt="Yorkshire Terrier">
                <h3>Yorkshire Terrier</h3>
                <p>Trust us to whisk your pet off to the doctor’s for their check-up. They’ll be in safe hands, ensuring they stay healthy and happy.</p>
            </article>
        </div>
        </div>
    </section>

    <div class="container py-4">

    <section class="financing text-center py-5">
        <h2 class="display-4">Financing Options</h2>
        <p class="lead">We offer financing through IGW and Splitit, making it easier than ever to bring home your new best friend. Contact us to learn more or to get started!</p>
        <a href="/financing" class="btn btn-primary btn-lg mt-3">Learn More</a>
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
    </div>
</main>

<?php
get_footer();
