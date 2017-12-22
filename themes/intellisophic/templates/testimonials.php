<div class="container-white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h2>
                    WHAT'S CLIENTS SAY
                </h2>
                <p class="text-center sec-subhead">
                    -Amazing features-
                </p>
                <div class="center-block secbar"></div>
            </div>
        </div>

        <?php
        $args = array(
            'posts_per_page' => 1,
            'post_type' => 'testimonials',
            'order' => 'ASC',
        );
        $post_testimonial = get_posts($args);
        ?>
        <?php foreach ($post_testimonial as $post) : setup_postdata($post); ?>
            <div class="row">
                <div class="col-xs-12 text-center" data-animation="fadeInUp" data-animation-delay="0">
                    <div class="icon-container">
                        <?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive car-img')); ?>
                    </div>
                </div>
                <div class="col-lg-offset-2 col-lg-8 col-xs-12 text-center">
                    <div class="car-txt"><?php the_content(); ?></div>
                    <h4 class="car-subtxt"><?php the_title(); ?></h4>
                </div>
            </div>    
            <?php
        endforeach;
        wp_reset_postdata();
        ?>
    </div>
</div>