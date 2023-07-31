<footer class="main-footer" id="footer">
	<div class="container">
		<div class="row">
			<?php $formID = get_field('schedule_form', 'option'); ?>
			<div class="col-sm-12 col-lg-<?php echo ($formID) ? '7' : '12'; ?>">
				<div class="footer-left">
					<?php if ($map = get_field('google_map', 'option')) : ?>
						<div class="google-map"><?php echo $map; ?></div>
					<?php endif; ?>

					<div class="contact-details">
						<?php if (get_field('footer_contact_details_title', 'option')) : ?>
							<h3 class="footer-subheading"><?php the_field('footer_contact_details_title', 'option'); ?></h3>
						<?php endif; ?>
						<div class="inner">
							<?php if ($telephone = get_field('telephone', 'option')) : ?>
								<div class="footer-contact-row">
									<h4>Mobile</h4>
									<a href="tel:<?php echo $telephone; ?>"><?php echo $telephone; ?></a>
								</div>
							<?php endif; ?>
							<?php if ($address = get_field('address', 'option')) : ?>
								<div class="footer-contact-row">
									<h4>Location</h4>
									<p><?php echo nl2br($address); ?></p>
								</div>
							<?php endif; ?>
							<?php if ($email = get_field('email', 'option')) : ?>
								<div class="footer-contact-row">
									<h4>E Mail</h4>
									<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
								</div>
							<?php endif; ?>
						</div>
					</div>

					<?php get_template_part('templates/social', 'media'); ?>

					<div class="copyrights">
						<p class="copyrights-text"><?php echo str_replace('[year]', date('Y'), get_field('copyrights_text', 'option')); ?></p>
						<p class="maya-wrapper"><a href="https://www.maya.lk/" target="_blank">Website By <img src="<?php echo THEME_IMAGES; ?>maya.png" alt="Maya.lk"></a></p>
					</div>
				</div>
			</div>
			<?php if ($formID) : ?>
				<div class="col-sm-12 col-lg-5">
					<div class="contact-form">
						<?php if (get_field('footer_contact_title', 'option')) : ?>
							<h3><?php the_field('footer_contact_title', 'option'); ?></h3>
						<?php endif; ?>
						<?php echo do_shortcode('[forminator_form id="' . $formID . '"]'); ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</div>
</body>

</html>