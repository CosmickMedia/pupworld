<?php declare( strict_types = 1 ); ?>
<?php
/**
 * Title: search
 * Slug: bark/search
 * Categories: hidden
 * Inserter: no
 */
?>
<!-- wp:template-part {"slug":"header-inner-pages"} /-->

<!-- wp:group {"tagName":"main","metadata":{"name":"Main"},"align":"full","layout":{"type":"constrained"}} -->
<main class="wp-block-group alignfull"><!-- wp:spacer {"height":"var:preset|spacing|20"} -->
<div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:query-title {"type":"search","textAlign":"center","level":2,"showSearchTerm":false,"fontSize":"large"} /-->

<!-- wp:spacer {"height":"var:preset|spacing|20"} -->
<div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:search {"showLabel":false,"buttonText":"Search","buttonPosition":"button-inside","style":{"border":{"radius":"30px","style":"none","width":"0px"}},"backgroundColor":"primary","textColor":"background","fontSize":"small"} /-->

<!-- wp:spacer {"height":"var:preset|spacing|20"} -->
<div style="height:var(--wp--preset--spacing--20)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:query {"queryId":0,"query":{"perPage":10,"pages":0,"offset":"0","postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide"><!-- wp:query-no-results -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center"><?php echo __('No search results..', 'bark');?></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results -->

<!-- wp:group {"layout":{"type":"default"}} -->
<div class="wp-block-group"><!-- wp:post-template {"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"style":{"border":{"radius":"20px"},"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20","left":"var:preset|spacing|20","right":"var:preset|spacing|20"}}},"backgroundColor":"theme-1","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-theme-1-background-color has-background" style="border-radius:20px;padding-top:var(--wp--preset--spacing--20);padding-right:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20);padding-left:var(--wp--preset--spacing--20)"><!-- wp:post-featured-image {"isLink":true,"aspectRatio":"4/3","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20"}},"border":{"radius":"10px"}}} /-->

<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap"}} -->
<div class="wp-block-group"><!-- wp:post-title {"isLink":true,"fontSize":"medium"} /-->

<!-- wp:post-excerpt {"excerptLength":16,"style":{"layout":{"flexSize":"min(2.5rem, 3vw)","selfStretch":"fixed"}},"textColor":"contrast-2","fontSize":"small"} /-->

<!-- wp:spacer {"height":"0px","style":{"layout":{"flexSize":"min(2.5rem, 3vw)","selfStretch":"fixed"}}} -->
<div style="height:0px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:spacer {"height":"var:preset|spacing|40","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<div style="margin-top:0;margin-bottom:0;height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->

<!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"space-between"}} -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination --></div>
<!-- /wp:group --></div>
<!-- /wp:query --></main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer"} /-->