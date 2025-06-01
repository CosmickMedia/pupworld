<?php
/**
 * Output the original block based footer markup restored from the
 * database backup. The markup is stored in parts-fse/footer.html and
 * matches the block editor version of the footer.
 */
echo file_get_contents( get_template_directory() . '/parts-fse/footer.html' );
?>
<?php wp_footer(); ?>
</body>
</html>
