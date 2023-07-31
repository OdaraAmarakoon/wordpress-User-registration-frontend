<section class="sub-page-banner">
    <?php if ($image = get_the_post_thumbnail_url(get_the_ID())) : ?>
        <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" class="full-image">
    <?php endif; ?>
    <div class="container">
        <div class="content-wrapper">
            <?php if (!empty($args['showContent']) && $args['showContent']) : ?>
                <?php the_content(); ?>
            <?php else : ?>
                <h1 class="mb-0"><?php the_title(); ?></h1>
            <?php endif; ?>
        </div>
    </div>
</section>