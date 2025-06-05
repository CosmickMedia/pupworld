<?php
defined( 'ABSPATH' ) || exit;

extract( shortcode_atts( [ 
	'section_class' => 'container',
	'section_id' => '',
], $args ) );
?>
<div class="<?= $section_class ?>" id="<?= $section_id ?>">
