<div class="blog-item">
    <div class="image">
        <?php the_post_thumbnail('full', array('class' => 'full-image')); ?>
    </div>
    <p><?php echo get_the_date('Y.m.d', get_the_ID()); ?></p>
    <h3><?php the_title(); ?></h3>
    <a href="<?php the_permalink(); ?>" class="full-link"></a>
</div>