<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php
/**
 * Output the original block based header markup restored from the
 * database backup. The markup is stored in parts-fse/header.html and
 * contains the same block structure used when editing the theme with
 * the block editor.
 */
echo file_get_contents( get_template_directory() . '/parts-fse/header.html' );
?>
