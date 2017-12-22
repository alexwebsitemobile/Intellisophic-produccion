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
        <div id="map_canvas" class="map_gray hidden-xs" style="width:100%; height:420px;"></div>
    </div>
</div>