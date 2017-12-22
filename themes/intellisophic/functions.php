<?php
/** Constants */
defined('THEME_URI') || define('THEME_URI', get_template_directory_uri());
defined('THEME_PATH') || define('THEME_PATH', realpath(__DIR__));

include_once THEME_PATH . '/includes/functions.php';
require_once THEME_PATH . '/includes/register-sidebar.php';

// Constants
defined('DISALLOW_FILE_EDIT') || define('DISALLOW_FILE_EDIT', FALSE);
defined('TEXT_DOMAIN') || define('TEXT_DOMAIN', 'sm');
define('JPB_THEME_PATH', realpath(__DIR__));


//Theme settings
require(get_template_directory() . '/inc/theme-options.php');

//include_once __DIR__ . '/includes/register-script.php';
include_once __DIR__ . '/includes/register-script-local.php';
include_once __DIR__ . '/includes/register-style.php';
//include_once __DIR__ . '/includes/register-style-local.php';

add_action('wp_enqueue_scripts', function () {

    /* Styles */
    wp_enqueue_style('bootstrap');
    wp_enqueue_style('animate');
    wp_enqueue_style('hover');
    wp_enqueue_style('font-awesome');
    // Theme
    wp_enqueue_style('main-theme');

    /* Scripts */
    wp_enqueue_script('modernizr');
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap');
    wp_enqueue_script('jquery-form');

    // Bootstrap Alerts
    wp_register_script('bootstrap-alerts', apply_filters('js_cdn_uri', THEME_URI . '/js/bootstrap-alerts.min.js', 'bootstrap-alerts'), array('jquery', 'bootstrap'), NULL, TRUE);
    wp_enqueue_script('bootstrap-alerts');


    // Add defer atribute
    do_action('defer_script', array('jquery-form', 'bootstrap-alerts'));

    // Bootstrap complemetary text align
    wp_register_style('bs-text-align', THEME_URI . '/css/bootstrap-text-align.min.css', array('bootstrap'), '1.0');
    wp_enqueue_style('bs-text-align');

    // Wordpress Core
    wp_register_style('wordpress-core', THEME_URI . '/css/wordpress-core.min.css', array('bootstrap', 'bs-text-align'), '1.0');
    wp_enqueue_style('wordpress-core');

    if (is_child_theme()) {
        // Theme
        wp_register_style('theme', get_stylesheet_uri(), array('animate'), '1.0');
        wp_enqueue_style('theme');
    }
});

include_once __DIR__ . '/includes/theme-features.php';

/**
 * Encoded Mailto Link
 *
 * Create a spam-protected mailto link written in Javascript
 *
 * @param	string	the email address
 * @param	string	the link title
 * @param	mixed	any attributes
 * @return	string
 */
function safe_mailto($email, $title = '', $attributes = '') {
    $title = (string) $title;

    if ($title === '') {
        $title = $email;
    }

    $x = str_split('<a href="mailto:', 1);

    for ($i = 0, $l = strlen($email); $i < $l; $i++) {
        $x[] = '|' . ord($email[$i]);
    }

    $x[] = '"';

    if ($attributes !== '') {
        if (is_array($attributes)) {
            foreach ($attributes as $key => $val) {
                $x[] = ' ' . $key . '="';
                for ($i = 0, $l = strlen($val); $i < $l; $i++) {
                    $x[] = '|' . ord($val[$i]);
                }
                $x[] = '"';
            }
        } else {
            for ($i = 0, $l = strlen($attributes); $i < $l; $i++) {
                $x[] = $attributes[$i];
            }
        }
    }

    $x[] = '>';

    $temp = array();
    for ($i = 0, $l = strlen($title); $i < $l; $i++) {
        $ordinal = ord($title[$i]);

        if ($ordinal < 128) {
            $x[] = '|' . $ordinal;
        } else {
            if (count($temp) === 0) {
                $count = ($ordinal < 224) ? 2 : 3;
            }

            $temp[] = $ordinal;
            if (count($temp) === $count) {
                $number = ($count === 3) ? (($temp[0] % 16) * 4096) + (($temp[1] % 64) * 64) + ($temp[2] % 64) : (($temp[0] % 32) * 64) + ($temp[1] % 64);
                $x[] = '|' . $number;
                $count = 1;
                $temp = array();
            }
        }
    }

    $x[] = '<';
    $x[] = '/';
    $x[] = 'a';
    $x[] = '>';

    $x = array_reverse($x);

    $output = "<script type=\"text/javascript\">\n"
            . "\t//<![CDATA[\n"
            . "\tvar l=new Array();\n";

    for ($i = 0, $c = count($x); $i < $c; $i++) {
        $output .= "\tl[" . $i . "] = '" . $x[$i] . "';\n";
    }

    $output .= "\n\tfor (var i = l.length-1; i >= 0; i=i-1) {\n"
            . "\t\tif (l[i].substring(0, 1) === '|') document.write(\"&#\"+unescape(l[i].substring(1))+\";\");\n"
            . "\t\telse document.write(unescape(l[i]));\n"
            . "\t}\n"
            . "\t//]]>\n"
            . '</script>';

    return $output;
}

require_once __DIR__ . '/admin/admin.php';

//Customize admin login

function login_stylesheet() {
    wp_enqueue_style('custom-login', get_template_directory_uri() . '/css/style-login.css');
}

add_action('login_enqueue_scripts', 'login_stylesheet');

function my_login_logo() {
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/site-login-logo.png);
            padding-bottom: 30px;
        }
    </style>
    <?php
}

add_action('login_enqueue_scripts', 'my_login_logo');

function my_login_logo_url() {
    return home_url();
}

add_filter('login_headerurl', 'my_login_logo_url');

function my_login_logo_url_title() {
    return 'Source Meridian';
}

add_filter('login_headertitle', 'my_login_logo_url_title');

add_filter('admin_footer_text', 'left_admin_footer_text_output');

function left_admin_footer_text_output($text) {
    $text = get_bloginfo();
    return $text;
}

add_filter('update_footer', 'right_admin_footer_text_output', 11);

function right_admin_footer_text_output($text) {
    $text = 'Develop by <a href="http://www.sourcemeridian.com" target="_blank">SourceMeridian.com</a>';
    return $text;
}

/**
 * Add scripts and styles to all Admin pages
 */
function jscustom_admin_scripts() {
    wp_enqueue_media();
    wp_register_script('custom-upload', get_template_directory_uri() . '/js/media-uploader.js', array('jquery'));
    wp_enqueue_script('custom-upload');
}

add_action('admin_print_scripts', 'jscustom_admin_scripts');

function register_global_menus() {
    register_nav_menus(
            array(
                'header-menu' => __('Header Menu')
            )
    );
}

add_action('init', 'register_global_menus');

// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

class Custom_Walker extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth, $args) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat("\t", $depth) : '' ); // code indent
        // depth dependent classes
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >= 2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr(implode(' ', $depth_classes));

        // passed classes
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        if (!in_array($item->object, array('custom'))) {
            $post_data = get_post($item->object_id);
            $classes[] = $post_data->post_type . '-' . $post_data->post_name;
        }

        $class_names = esc_attr(implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item)));

        // build html
        $output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

        // link attributes
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .=!empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

        $item_output = sprintf('%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s', $args->before, $attributes, $args->link_before, apply_filters('the_title', $item->title, $item->ID), $args->link_after, $args->after
        );

        // build html
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}

function rw_register_meta_box() {
    if (!class_exists('RW_Meta_Box') or ! is_admin())
        return;
    $post_ID = !empty($_POST['post_ID']) ?
            $_POST['post_ID'] :
            (!empty($_GET['post']) ? $_GET['post'] : FALSE);

    $post_name = '';
    if ($post_ID) {
        $current_post = get_post($post_ID);
        if ($current_post) {
            $current_post_type = $current_post->post_type;
            $post_name = $current_post->post_name;
        } else {
            $post_name = '';
        }
    }

    if ($post_name == 'home') {

        $meta_box[] = array(
            'id' => 'info_home',
            'title' => 'Information home',
            'pages' => array('page'),
            'context' => 'normal',
            'priority' => 'high',
            'fields' => array(
                array(
                    'name' => 'Quote',
                    'id' => 'quote_des',
                    'type' => 'wysiwyg',
                ),
                array(
                    'name' => 'Intelligent solutions (Description)',
                    'id' => 'inst_sol_des',
                    'type' => 'wysiwyg',
                ),
                array(
                    'name' => 'Intelligent solutions (Image)',
                    'id' => 'img_solutions',
                    'type' => 'image',
                    'max_file_uploads' => 1
                ),
                array(
                    'name' => 'Taxonomic content',
                    'id' => 'tax_cont_des',
                    'type' => 'wysiwyg',
                ),
                array(
                    'name' => 'Taxonomic content (Image)',
                    'id' => 'img_tax_cont',
                    'type' => 'image',
                    'max_file_uploads' => 1
                ),
        ));
    }

    $meta_box[] = array(
        'id' => 'info_white_paper',
        'title' => 'White Paper - PDF',
        'pages' => array('white-papers'),
        'context' => 'normal',
        'priority' => 'high',
        'fields' => array(
            array(
                'name' => 'PDF',
                'id' => 'pdf-attachment',
                'type' => 'file',
                'max_file_uploads' => 1
            )
    ));

    if (is_array($meta_box)) {
        foreach ($meta_box as $value) {
            new RW_Meta_Box($value);
        }
    }
}

add_action('wp_ajax_rwmb_reorder_images', array("RWMB_Image_Field", 'wp_ajax_reorder_images'));
add_action('wp_ajax_rwmb_delete_file', array("RWMB_File_Field", 'wp_ajax_delete_file'));
add_action('wp_ajax_rwmb_attach_media', array("RWMB_Image_Advanced_Field", 'wp_ajax_attach_media'));
add_action('admin_init', 'rw_register_meta_box');

function custom_tertimonials() {

    $labels = array(
        'name' => _x('Testimonials', 'Post Type General Name', 'sm'),
        'singular_name' => _x('Testimonial', 'Post Type Singular Name', 'sm'),
        'menu_name' => __('Testomonials', 'sm'),
        'name_admin_bar' => __('Testomonials', 'sm'),
        'archives' => __('Item Archives', 'sm'),
        'parent_item_colon' => __('Parent Item:', 'sm'),
        'all_items' => __('All Items', 'sm'),
        'add_new_item' => __('Add New Item', 'sm'),
        'add_new' => __('Add New', 'sm'),
        'new_item' => __('New Item', 'sm'),
        'edit_item' => __('Edit Item', 'sm'),
        'update_item' => __('Update Item', 'sm'),
        'view_item' => __('View Item', 'sm'),
        'search_items' => __('Search Item', 'sm'),
        'not_found' => __('Not found', 'sm'),
        'not_found_in_trash' => __('Not found in Trash', 'sm'),
        'featured_image' => __('Featured Image', 'sm'),
        'set_featured_image' => __('Set featured image', 'sm'),
        'remove_featured_image' => __('Remove featured image', 'sm'),
        'use_featured_image' => __('Use as featured image', 'sm'),
        'insert_into_item' => __('Insert into item', 'sm'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'sm'),
        'items_list' => __('Items list', 'sm'),
        'items_list_navigation' => __('Items list navigation', 'sm'),
        'filter_items_list' => __('Filter items list', 'sm'),
    );
    $args = array(
        'label' => __('Testimonial', 'sm'),
        'description' => __('testimonials description', 'sm'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'thumbnail',),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-chat',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('testimonials', $args);
}

add_action('init', 'custom_tertimonials', 0);

function custom_clients() {

    $labels = array(
        'name' => _x('Clients', 'Post Type General Name', 'sm'),
        'singular_name' => _x('Client', 'Post Type Singular Name', 'sm'),
        'menu_name' => __('Clients', 'sm'),
        'name_admin_bar' => __('Clients', 'sm'),
        'archives' => __('Item Archives', 'sm'),
        'parent_item_colon' => __('Parent Item:', 'sm'),
        'all_items' => __('All Items', 'sm'),
        'add_new_item' => __('Add New Item', 'sm'),
        'add_new' => __('Add New', 'sm'),
        'new_item' => __('New Item', 'sm'),
        'edit_item' => __('Edit Item', 'sm'),
        'update_item' => __('Update Item', 'sm'),
        'view_item' => __('View Item', 'sm'),
        'search_items' => __('Search Item', 'sm'),
        'not_found' => __('Not found', 'sm'),
        'not_found_in_trash' => __('Not found in Trash', 'sm'),
        'featured_image' => __('Featured Image', 'sm'),
        'set_featured_image' => __('Set featured image', 'sm'),
        'remove_featured_image' => __('Remove featured image', 'sm'),
        'use_featured_image' => __('Use as featured image', 'sm'),
        'insert_into_item' => __('Insert into item', 'sm'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'sm'),
        'items_list' => __('Items list', 'sm'),
        'items_list_navigation' => __('Items list navigation', 'sm'),
        'filter_items_list' => __('Filter items list', 'sm'),
    );
    $args = array(
        'label' => __('Client', 'sm'),
        'description' => __('clients', 'sm'),
        'labels' => $labels,
        'supports' => array('title', 'thumbnail',),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-admin-users',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('clients', $args);
}

add_action('init', 'custom_clients', 0);

function custom_white_papers() {

    $labels = array(
        'name' => _x('White Papers', 'Post Type General Name', 'sm'),
        'singular_name' => _x('White Paper', 'Post Type Singular Name', 'sm'),
        'menu_name' => __('White Papers', 'sm'),
        'name_admin_bar' => __('White Papers', 'sm'),
        'archives' => __('Item Archives', 'sm'),
        'parent_item_colon' => __('Parent Item:', 'sm'),
        'all_items' => __('All Items', 'sm'),
        'add_new_item' => __('Add New Item', 'sm'),
        'add_new' => __('Add New', 'sm'),
        'new_item' => __('New Item', 'sm'),
        'edit_item' => __('Edit Item', 'sm'),
        'update_item' => __('Update Item', 'sm'),
        'view_item' => __('View Item', 'sm'),
        'search_items' => __('Search Item', 'sm'),
        'not_found' => __('Not found', 'sm'),
        'not_found_in_trash' => __('Not found in Trash', 'sm'),
        'featured_image' => __('Featured Image', 'sm'),
        'set_featured_image' => __('Set featured image', 'sm'),
        'remove_featured_image' => __('Remove featured image', 'sm'),
        'use_featured_image' => __('Use as featured image', 'sm'),
        'insert_into_item' => __('Insert into item', 'sm'),
        'uploaded_to_this_item' => __('Uploaded to this item', 'sm'),
        'items_list' => __('Items list', 'sm'),
        'items_list_navigation' => __('Items list navigation', 'sm'),
        'filter_items_list' => __('Filter items list', 'sm'),
    );
    $args = array(
        'label' => __('White Papers', 'sm'),
        'description' => __('White Papers', 'sm'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail',),
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-format-aside',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type('white-papers', $args);
}

add_action('init', 'custom_white_papers', 0);
