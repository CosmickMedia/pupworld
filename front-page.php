<?php
/**
 * Custom front page rebuilt from static backup.
 *
 * @package Bark
 */

get_header();
?>

<main id="primary" class="site-main homepage">
    <section class="hero">
        <h2>Find your best friend!</h2>
    </section>

    <section class="adoption">
        <h2>Available for adoption</h2>
        <div class="breeds">
            <article class="breed">
                <h3>Golden Retriever</h3>
                <p>Known for their gentle nature, intelligence, and playful spirit, Goldens make the perfect family companion.</p>
            </article>
            <article class="breed">
                <h3>Golden Doodle</h3>
                <p>With their affectionate nature, intelligence, and low-shedding coats, Goldendoodles make the perfect family companion, bringing warmth, joy, and endless fun into your home.</p>
            </article>
            <article class="breed">
                <h3>Rottweiler</h3>
                <p>With their calm and confident demeanor, combined with a deep bond to their family, makes them not only excellent protectors but also affectionate and loving companions who thrive in a caring home.</p>
            </article>
            <article class="breed">
                <h3>Yorkshire Terrier</h3>
                <p>Trust us to whisk your pet off to the doctor’s for their check-up. They’ll be in safe hands, ensuring they stay healthy and happy.</p>
            </article>
        </div>
    </section>

    <section class="financing">
        <h2>Financing Options</h2>
        <p>Please contact us to learn more about flexible payment plans for your new puppy.</p>
    </section>

    <section class="about">
        <h2>About us</h2>
        <p>At Pupworld, we are more than just a group of breeders—we are passionate about connecting families with their perfect furry companion. With years of experience in responsible breeding and pet care.</p>
        <p>Our dedicated breeders adhere to rigorous standards fueled by their genuine affection for every puppy and parent under their care.</p>
    </section>

    <section class="mission">
        <h2>Our Mission</h2>
        <p>Our mission is simple: to bring joy to families by providing them with loyal, loving companions while ensuring the highest standards of health, care, and ethics. We believe every puppy deserves a home where they are cherished.</p>
    </section>

    <section class="reviews">
        <h2>What people are saying</h2>
        <blockquote>
            <p>&ldquo;We love our F1B Mini Bernedoodle from James and Lindy Hilty. They communicated very well thru the process and we have a delightful, smart, and healthy puppy.&rdquo;</p>
            <footer>- Jonah Collier</footer>
        </blockquote>
        <blockquote>
            <p>&ldquo;I highly recommend Four Corner Puppies. James and his family operate a safe, clean, and family oriented environment for their pups. They responded quickly to all of my questions and were very accommodating. We love our sweet Shih-tzu, Sophie. She is pure joy!&rdquo;</p>
            <footer>- Jody West Gleason</footer>
        </blockquote>
    </section>

    <section class="location">
        <h2>Where are we?</h2>
        <p>10512 Schwartz Rd, Ft Wayne, IN 46835</p>
    </section>

    <section class="news">
        <h2>News and Articles</h2>
        <?php
        $news_query = new WP_Query( array( 'posts_per_page' => 3 ) );
        if ( $news_query->have_posts() ) :
            echo '<div class="news-posts">';
            while ( $news_query->have_posts() ) :
                $news_query->the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php the_title( '<h3>', '</h3>' ); ?>
                    <div class="excerpt"><?php the_excerpt(); ?></div>
                </article>
                <?php
            endwhile;
            echo '</div>';
            wp_reset_postdata();
        endif;
        ?>
    </section>

    <section class="contact">
        <h2>Contact us</h2>
        <p>(260) 710-9103<br>01pupworld@gmail.com<br>10512 Schwartz Rd.<br>Fort Wayne, Indiana 46835</p>
        <form method="post" class="contact-form">
            <p><label>Name<br><input type="text" name="name" required></label></p>
            <p><label>Email<br><input type="email" name="email" required></label></p>
            <p><label>Message<br><textarea name="message" required></textarea></label></p>
            <p><button type="submit">Send</button></p>
        </form>
    </section>
</main>

<?php
get_footer();
