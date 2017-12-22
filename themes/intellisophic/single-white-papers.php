<?php
get_header();
the_post();
?>

<section id="page-title">
    <!-- Start Container -->
    <div class="container">
        <div class="title-with-crumbs">
            <h1><?php the_title(); ?></h1>
        </div>
        <div class="title-with-crumbs waves-breadcrumbs">
            <div id="crumbs" class="pull-right">
                <span class="crumb-item"><a href="<?php echo home_url(); ?>">Home</a></span> <span class="crumb-item current"><?php the_title(); ?></span>
                <?php get_template_part('templates/'); ?>
            </div>
        </div>
    </div>
    <!-- End Container -->
</section>

<div class="container-white">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-7">
                <div class="line-left">
                    <div class="post-content post-inte">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-5">
                <?php //echo do_shortcode('[contact-form-7 id="138" title="White paper"]') ?>
                <?php if (get_the_ID() == 96) {
                  echo do_shortcode(' [email-download download_id="116" contact_form_id="138"]');
                }elseif (get_the_ID() == 101) {
                  echo do_shortcode(' [email-download download_id="118" contact_form_id="138"]');
                } else {
                  echo do_shortcode(' [email-download download_id="120" contact_form_id="138"]');
                }
                 ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
