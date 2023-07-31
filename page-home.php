<?php /* Template Name: Home */ ?>
<?php get_header();
?>

<section class="banner-section" id="contact">
    <?php getImage(get_field('banner_background_image'), 'full-image bg'); ?>
    <div class="container" id="schedule">
        <div class="row">
            <div class="col-sm-12 col-lg-8">
                <div class="content-wrapper">
                    <?php the_field('banner_content'); ?>
                </div>
            </div>
            <?php if ($formID = get_field('banner_form')) : ?>
                <div class="col-sm-12 col-lg-4">
                    <div class="contact-form">
                        <?php if (get_field('banner_form_title')) : ?>
                            <div class="content-wrapper"><?php the_field('banner_form_title'); ?></div>
                        <?php endif; ?>
                        <?php echo do_shortcode('[forminator_form id="' . $formID . '"]'); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php if (get_field('about_content')) : ?>
    <section class="about-section" id="welcome">
        <?php getImage(get_field('about_background_image'), 'full-image'); ?>
        <div class="container">
            <div class="content-wrapper"><?php the_field('about_content'); ?></div>
        </div>
    </section>
<?php endif; ?>

<?php if (have_rows('packages')) : ?>
    <section class="packages-section" id="our-prices">
        <div class="container">

            <?php if (get_field('packages_title')) : ?>
                <div class="content-wrapper"><?php the_field('packages_title'); ?></div>
            <?php endif; ?>

            <?php if (have_rows('packages')) : ?>
                <div class="row">
                    <?php while (have_rows('packages')) : the_row(); ?>
                        <div class="col-sm-12 col-md-6 col-lg-3">
                            <div class="item">
                                <div class="price"><span>$</span><?php the_sub_field('price'); ?></div>
                                <h5><?php the_sub_field('title'); ?></h5>
                                <?php if (get_sub_field('link')) : ?>
                                    <a href="<?php the_sub_field('link'); ?>" target="_blank" class="theme-btn">
                                        <?php the_field('packages_button_title'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<?php if (get_field('contact_content')) : ?>
    <section class="contact-section">
        <?php getImage(get_field('contact_background_image'), 'full-image'); ?>
        <div class="container">
            <div class="content-wrapper">
                <?php the_field('contact_content'); ?>
                <?php if (get_field('contact_button_text')) : ?>
                    <a href="#footer" class="theme-btn">
                        <?php the_field('contact_button_text'); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (have_rows('testimonials')) : ?>
    <section class="testimonials-section" id="what-they-say">
        <div class="container">
            <?php if (get_field('testimonials_title')) : ?>
                <div class="content-wrapper"><?php the_field('testimonials_title'); ?></div>
            <?php endif; ?>
            <div class="swiper" id="testimonialsSwiper">
                <div class="swiper-wrapper">
                    <?php while (have_rows('testimonials')) : the_row(); ?>
                        <div class="swiper-slide">
                            <div class="item">
                                <p><?php the_sub_field('testimonial'); ?></p>
                                <h5><?php the_sub_field('name'); ?></h5>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-nav">
                    <div class="swiper-btn testimonials-prev"><i class="fa-solid fa-chevron-left"></i></div>
                    <div class="swiper-btn testimonials-next"><i class="fa-solid fa-chevron-right"></i></div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if (have_rows('areas')) : ?>
    <section class="areas-section">
        <div class="container">
            <?php if (get_field('areas_title')) : ?>
                <div class="content-wrapper"><?php the_field('areas_title'); ?></div>
            <?php endif; ?>
            <div class="row">
                <?php while (have_rows('areas')) : the_row(); ?>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="item">
                            <div class="image">
                                <?php getImage(get_sub_field('image'), 'full-image'); ?>
                            </div>
                            <h3><?php the_sub_field('title'); ?></h3>
                            <?php if (get_sub_field('link')) : ?>
                                <a href="<?php the_field('link'); ?>" target="_blank" class="full-link"></a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>