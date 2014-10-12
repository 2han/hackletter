<?php

/**
 * Homepage
 *
 * @package Blogly
 */

get_header(); ?>



<div id="main">



<?php if ( have_posts() ) : ?>


<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'content', get_post_format() ); ?>
<?php endwhile; ?>



<?php themefurnace_pagination(); ?>



<?php else : ?>

<?php get_template_part( 'no-results', 'index' ); ?>

<?php endif; ?>



<?php get_footer(); ?>