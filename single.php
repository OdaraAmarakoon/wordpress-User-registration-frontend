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

<?php endwhile;
endif; ?>

<?php get_footer(); ?>