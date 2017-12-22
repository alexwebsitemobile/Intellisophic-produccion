<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo('charset') ?>" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <?php get_template_part('icons/index') ?>
        <link rel="shortcut icon" href="<?php bloginfo('template_url') ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php bloginfo('template_url') ?>/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="<?php bloginfo('description') ?>" />

        <?php wp_head() ?>

        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php bloginfo('template_url') ?>/css/owl.theme.default.css">

        <script src="<?php bloginfo('template_url') ?>/js/owl.carousel.min.js"></script>

        <script type="text/javascript" src="https://ianlunn.co.uk/plugins/jquery-parallax/scripts/jquery.parallax-1.1.3.js"></script>
<!--
        <script src="http://www.position-relative.net/creation/formValidator/js/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>-->
        <script src="<?php bloginfo('template_url'); ?>/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
        <link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/validationEngine.jquery.css" type="text/css"/>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#main-wrap').parallax("50%", 0.1);
            });
        </script>
        
    </head>

    <body <?php body_class() ?> itemscope itemtype="http://schema.org/WebPage">

        <?php
        do_action('before_main_content');
        get_template_part('components/bs-main-navbar');
        ?>

        <header class="container-header <?php
        if (is_front_page()) {
            echo 'fixed';
        } else {
            echo 'colored';
        }
        ?>">
            <div class="container full-w">
                <div class="row">
                    <div class="col-md-3 col-sm-3 hidden-xs">
                        <div class="wrap-logo">
                            <?php
                            $logo_src = get_option('theme_options_logo_src');
                            if (!empty($logo_src)) {
                                ?>
                                <a href="<?php echo home_url(); ?>">
                                    <img src="<?php echo $logo_src; ?>" alt="<?php echo get_option('theme_options_logo_alt'); ?>" class="img-responsives">
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <?php get_template_part('templates/menu'); ?>
                    </div>
                </div>
            </div>
        </header>
