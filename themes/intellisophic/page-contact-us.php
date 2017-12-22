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
            <div class="col-sm-6">
                <div class="line-left">
                    <div class="post-content post-inte">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="container-form">
                    <div class="wrap-contact">
                        <?php echo do_shortcode('[contact-form-7 id="109" title="Contact Us"]') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$coor = get_option('theme_options_map');
?>
<div class="container-map">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlR-Htenvt_kOxPtq7ashFPdJw8yI1UzM" type="text/javascript"></script>
    <script type="text/javascript">

        var map = null;
        var marker = null;

        $(document).ready(function () {
            var mapOptions = {
                center: new google.maps.LatLng(40.043409, -75.479894),
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                navigationControl: false,
                scaleControl: false
                        /* HYBRID | ROADMAP | SATELLITE| TERRAIN */
            };

            map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(<?php echo $coor ?>),
                title: 'Intellisophic, Inc',
                map: map,
                icon: "<?php bloginfo('template_url') ?>/images/ico_map.png"
            });

        });
    </script>
    <div class="map">
        <div id="map_canvas" class="map_gray" style="width:100%; height:420px;"></div>
    </div>
</div>
<?php get_footer(); ?>
