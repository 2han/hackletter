

<div class="post">
	<a href="<?php the_permalink(); ?>">
		<?php if (has_post_thumbnail()): ?>
			<?php the_post_thumbnail('thumbnail'); ?>
		<?php else: ?>
		<img src="<?php echo get_template_directory_uri(); ?>/img/common/noimg.gif" width="200" height="200" alt="no image">
		<?php endif; ?>
		<div class="postmetainfo">
			<p class="metaTitle"><?php the_title(); ?></p>
			<ul class="postcategories">
				<?php $cats = get_the_category(); foreach( $cats as $cat) { echo '<li>'.$cat->cat_name.'</li>'; } ?>
			</ul>
		</div>
		
	</a>
</div>