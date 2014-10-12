<?php
/**
 * @package themefurnace
 */

?>



<div id="post-<?php the_ID(); ?>" <?php post_class('quote'); ?>>

    <div class="postcontent">

        <?php the_content(); ?>

    </div>

</div>

<div class="postmeta postquote"><p><i class="fa fa-calendar"></i>
        <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_time(' F jS, Y') ?></a> <i class="fa fa-comment"></i><?php comments_popup_link(__('Leave a comment', 'themefurnace'), __('1 Comment', 'themefurnace'), __('% Comments', 'themefurnace')); ?>
        <i class="fa fa-folder-open"></i>
        <?php
            // Hide category and tag text for pages on Search
            if ('post' == get_post_type()) :

                /* translators: used between list items, there is a space after the comma */
                $categories_list = get_the_category_list(__(', ', 'themefurnace'));

                if ($categories_list && themefurnace_categorized_blog()) :
                    printf(__('%1$s', 'themefurnace'), $categories_list);

                endif; // End if categories

            endif; // End if 'post' == get_post_type() ?> <i class="fa fa-user"></i>
        <?php the_author_link(); ?>  <a href="<?php the_permalink(); ?>" class="posttype"><i class="fa <?php $format = get_post_format(); ?>

<?php if ($format) { ?>

format-<?php echo $format; ?>

<?php } else { ?>

format-standard

<?php } ?>"></i></a></p>

</div>