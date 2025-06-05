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
            <div class="row breeds">
                <article class="breed col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 text-center">
                        <img class="card-img-top img-fluid" src="/wp-content/uploads/2025/04/golden-retreiver.jpg" alt="Golden Retriever">
                        <div class="card-body">
                            <h3 class="card-title">Golden Retriever</h3>
                            <p class="card-text">Known for their gentle nature, intelligence, and playful spirit, Goldens make the perfect family companion.</p>
                        </div>
                    </div>
                </article>
                <article class="breed col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 text-center">
                        <img class="card-img-top img-fluid" src="/wp-content/uploads/2025/04/golden-doodle.jpg" alt="Golden Doodle">
                        <div class="card-body">
                            <h3 class="card-title">Golden Doodle</h3>
                            <p class="card-text">With their affectionate nature, intelligence, and low-shedding coats, Goldendoodles make the perfect family companion, bringing warmth, joy, and endless fun into your home.</p>
                        </div>
                    </div>
                </article>
                <article class="breed col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 text-center">
                        <img class="card-img-top img-fluid" src="/wp-content/uploads/2025/04/rottweiler.jpg" alt="Rottweiler">
                        <div class="card-body">
                            <h3 class="card-title">Rottweiler</h3>
                            <p class="card-text">With their calm and confident demeanor, combined with a deep bond to their family, makes them not only excellent protectors but also affectionate and loving companions who thrive in a caring home.</p>
                        </div>
                    </div>
                </article>
                <article class="breed col-lg-3 col-md-6 mb-4">
                    <div class="card h-100 text-center">
                        <img class="card-img-top img-fluid" src="/wp-content/uploads/2025/04/yorkshire-terrier.jpg" alt="Yorkshire Terrier">
                        <div class="card-body">
                            <h3 class="card-title">Yorkshire Terrier</h3>
                            <p class="card-text">Trust us to whisk your pet off to the doctor’s for their check-up. They’ll be in safe hands, ensuring they stay healthy and happy.</p>
                        </div>
                    </div>
                </article>
            </div>
            <div class="text-center mt-3">
                <a href="/all-breeds" class="btn btn-breeds">See All Breeds</a>
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
