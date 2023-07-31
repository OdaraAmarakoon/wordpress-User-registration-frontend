<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php get_template_part('templates/sub-page', 'banner'); ?>

		<?php if (get_the_content()) : ?>
			<section class="default-page-content">
				<div class="container">
					<div class="content-wrapper"><?php the_content(); ?></div>
				</div>
			</section>
		<?php endif; ?>

		<?php if (have_rows('content')) :  while (have_rows('content')) : the_row(); ?>
				<?php if ((get_row_layout() == 'default_content') && get_sub_field('content')) :
					$image = get_sub_field('image');
					$imagePosition = get_sub_field('image_position');
				?>
					<section class="content-side-image <?php echo ($image) ? ($imagePosition == 'Left') ? 'left' : 'right' : ''; ?>">
						<div class="container">
							<div class="row">
								<?php if ($image && ($imagePosition == 'Left')) : ?>
									<div class="col-sm-12 col-lg-5">
										<div class="full-image-parent"><?php getImage($image, 'full-image'); ?></div>
									</div>
								<?php endif; ?>
								<div class="col-sm-12 col-lg-<?php echo ($image) ? '7' : '12'; ?>">
									<div class="content-wrapper"><?php the_sub_field('content'); ?></div>
								</div>
								<?php if ($image && ($imagePosition == 'Right')) : ?>
									<div class="col-sm-12 col-lg-5">
										<div class="full-image-parent"><?php getImage($image, 'full-image'); ?></div>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</section>
				<?php endif; ?>
		<?php endwhile;
		endif; ?>

<?php endwhile;
endif; ?>


<?php get_footer(); ?>