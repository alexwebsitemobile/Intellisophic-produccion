<?php
get_header();
the_post();
$bg_src = get_option('theme_options_bg_src');
$img_sol = get_post_meta(get_the_ID(), 'img_solutions', true);
$int_sol = wp_get_attachment_image_src($img_sol, 'full');
$img_tax = get_post_meta(get_the_ID(), 'img_tax_cont', true);
$int_tax = wp_get_attachment_image_src($img_tax, 'full');
?>

<div class="container-home-image" id="main-wrap" style="background:url(<?php echo $bg_src; ?>) 50% 0 no-repeat fixed; background-size: cover;"> 
    <div class="wrap-home">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1  col-xs-12">
                    <div class="wrap-content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-gray">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="post-content">
                    <?php
                    $content = rwmb_meta('inst_sol_des');
                    $contents = apply_filters('the_content', $content);
                    echo $contents;
                    ?>
                </div>
            </div>
            <div class="col-md-offset-1 col-md-5 col-xs-12 text-right hidden-sm hidden-xs">
                <img src="<?php echo $int_sol[0]; ?>" class="img-responsives" alt="">
            </div>
        </div>
    </div>
</div>


<div class="container-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xs-12 hidden-sm hidden-xs">
                <img src="<?php echo $int_tax[0]; ?>" class="img-responsives" alt="" data-animation="fadeInLeft" data-animation-delay="0">
            </div>
            <div class="col-md-offset-1 col-md-5 col-xs-12">
                <div class="post-content" data-animation="fadeInLeft" data-animation-delay="100">
                    <?php
                    $content_tax = rwmb_meta('tax_cont_des');
                    $content_tax_description = apply_filters('the_content', $content_tax);
                    echo $content_tax_description;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-gray pdtb40">
    <div class="container">
        <div class="row">
            <?php
            $argswp = array(
                'posts_per_page' => 3,
                'post_type' => 'white-papers',
            );
            $post_papers = get_posts($argswp);
            ?>
            <?php foreach ($post_papers as $post) : setup_postdata($post); ?>
                <div class="col-sm-4">
                    <article class="box-white">
                        <header>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('full', array('class' => 'img-responsives')); ?>  
                            </a>
                            <h4>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                        </header>
                        <footer>
                            <div class="content">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="view-more">
                                View more
                            </a>
                        </footer>
                    </article>
                </div>
                <?php
            endforeach;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>

<?php
//Get the tertimonials (1)
//get_template_part('templates/testimonials');
//Get the contact form and map
get_template_part('templates/contact');
?>

<script>
    var $document = $(document),
            $element = $('.container-header'),
            className = 'colored';

    $document.scroll(function () {
        if ($document.scrollTop() >= 20) {
            $element.addClass(className);
        } else {
            $element.removeClass(className);
        }
    });
</script>

<!-- Container Clients -->
<div class="container-white pdtb40">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h2 class="title-black mgb15">
                    OUR CLIENTS
                </h2>
                <div class="container-logos">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php
                            $args = array(
                                'posts_per_page' => -1,
                                'post_type' => 'clients',
                            );
                            $post_clients = get_posts($args);
                            ?>
                            <div class="carousel">
                                <?php foreach ($post_clients as $post) : setup_postdata($post); ?>
                                    <div class="item">
                                        <?php the_post_thumbnail('full', array('class' => 'img-responsives')); ?>
                                    </div>
                                    <?php
                                endforeach;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>