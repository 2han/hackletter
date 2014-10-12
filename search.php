<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package themefurnace
 */
get_header(); ?>
<div id="main" >
<?php if ( have_posts() ) : ?>

<!-- <div class="post"> -->
<!-- <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'themefurnace' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
</div> -->
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'content', 'search' ); ?>
<?php endwhile; ?>
<?php themefurnace_content_nav( 'nav-below' ); ?>
<?php else : ?>
<?php get_template_part( 'no-results', 'search' ); ?>
<?php endif; ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>