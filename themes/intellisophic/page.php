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
            <div class="col-xs-12">
                <div class="line-left">
                    <div class="post-content post-inte">
                        <?php the_content(); ?>
                    </div>
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


<?php get_footer(); ?>
