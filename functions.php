<?php

/***********************************************************************************************************************/
/***********************************************define constants******************************************************/
/***********************************************************************************************************************/
define('THEME_SITE_URL', home_url());
define('THEME_THEMEROOT', get_stylesheet_directory_uri());
define('THEME_IMAGES', THEME_THEMEROOT . '/assets/images/');
define('THEME_JS', THEME_THEMEROOT . '/assets/js/');
define('THEME_CSS', THEME_THEMEROOT . '/assets/css/');
define('THEME_THEMEROOT_PATH', get_template_directory());

/**********************************************************************************************************************/
/****************************************defines theme supports*******************************************************/
/**********************************************************************************************************************/
if (function_exists('add_theme_support')) {
    add_theme_support('menus');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form'));
}

/*********************************************************************************************************************/
/************************************admin scripts and styles for the theme*******************************************/
/*********************************************************************************************************************/
function theme_front_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-js', THEME_JS . 'custom.min.js', array('jquery'), time(), true);
    wp_enqueue_script('fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js', array('jquery'), '', true);

    $customParams = array(
        'ADMIN_AJAX_URL' => admin_url('admin-ajax.php')
    );
    wp_localize_script('custom-js', 'CUSTOM_PARAMS', $customParams);

    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}
add_action('wp_enqueue_scripts', 'theme_front_scripts');

// custom front styles
function theme_front_styles()
{
    global $wp_styles;
    wp_enqueue_style('theme-styles', THEME_THEMEROOT . '/style.css', array(), '1.0', 'screen');
    wp_enqueue_style('master-styles', THEME_CSS . 'master.min.css', array(), time(), 'screen');
    wp_enqueue_style('fancybox-css', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css', array(), '', 'screen');
}
add_action('wp_print_styles', 'theme_front_styles');

if (!is_user_admin() && !function_exists('is_plugin_active')) {

    include_once(ABSPATH . 'wp-admin/includes/plugin.php');

    if (!isAdminUrl() && !is_plugin_active('advanced-custom-fields-pro/acf.php')) {
        wp_die('Please install Advanced custom fields pro plugin before proceeding');
    }
}

/**********************************************************************************************************************/
/*********************************************defines include*********************************************************/
//Required Plugin
require_once('inc/admin/tgm-plugin-activation/class-tgm-plugin-activation.php');
// require_once('inc/lib/Mobile_Detect.php');
require_once('vendor/autoload.php');

add_action('tgmpa_register', 'theme_required_plugins_register');
function theme_required_plugins_register()
{
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        //plugin from the WordPress Plugin Repository.
        array(
            'name'      => 'Classic Editor',
            'slug'      => 'classic-editor',
            'required'  => true,
        ),
        array(
            'name'      => 'Smush Image Compression and Optimization',
            'slug'      => 'wp-smushit',
            'required'  => true,
        ),
        array(
            'name'      => 'Forminator - Contact Form',
            'slug'      => 'forminator',
            'required'  => true,
        ),
        array(
            'name'                  => 'Advanced Custom Fields Pro', // The plugin name
            'slug'                  => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name)
            'source'                => THEME_THEMEROOT . '/inc/admin/tgm-plugin-activation/plugins/advanced-custom-fields-pro.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'          => '', // If set, overrides default API URL and points to an external URL
        ),
    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'page_title'   => __('Install Required Plugins', 'maya-creations'),
        'id'           => 'maya-creations',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug'  => 'plugins.php',            // Parent menu slug.
        'capability'   => 'manage_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

    );

    tgmpa($plugins, $config);
}

//Options Page
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

function compile_less_to_css()
{

    $less = new lessc;

    $less->compileFile(THEME_THEMEROOT_PATH . '/assets/css/less/master.less', THEME_THEMEROOT_PATH . '/assets/css/master.css');
}

use MatthiasMullie\Minify;

function minify_css_func()
{

    $minifier = new Minify\CSS(get_theme_file_path('assets/css/bootstrap.min.css'));

    // $minifier->add(get_theme_file_path('assets/css/hamburgers.min.css'));

    $minifier->add(get_theme_file_path('assets/css/fontawesome.all.min.css'));

    $minifier->add(get_theme_file_path('assets/mmenu/mmenu.css'));

    $minifier->add(get_theme_file_path('assets/css/master.css'));

    // save minified file to disk
    $minifier->minify(get_theme_file_path('assets/css/master.min.css'));
}

function minify_js_func()
{

    $minifier = new Minify\JS(get_theme_file_path('assets/js/bootstrap.bundle.min.js'));

    $minifier->add(get_theme_file_path('assets/swiper/swiper-bundle.min.js'));

    $minifier->add(get_theme_file_path('assets/mmenu/mmenu.js'));

    $minifier->add(get_theme_file_path('assets/js/custom.js'));

    // save minified file to disk
    $minifier->minify(get_theme_file_path('assets/js/custom.min.js'));
}

// Custom Functions

// ACF local json save and load functions

add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path)
{

    // return
    return get_stylesheet_directory() . '/inc/acf-json';
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');
function my_acf_json_load_point($paths)
{

    // remove original path (optional)
    unset($paths[0]);

    // append path
    $paths[] = get_stylesheet_directory() . '/inc/acf-json';

    // return
    return $paths;
}

if (function_exists('get_field')) {
    define("COMPILE_ASSETS", (get_field('compile_assets', 'option')) ?? FALSE);

    if (COMPILE_ASSETS) {
        add_action('init', 'compile_less_to_css');
        add_action('init', 'minify_css_func');
        add_action('init', 'minify_js_func');
    }
}

/**
 * Print attachement image
 *
 * @param   int         $imageID        ID of the image
 * @param   string      $class          ID of the image
 * @param   string      $alt            Alternative text
 * @param   string      $lazyLoad       Lazyload
 * @return  void
 */
function getImage($imageID = '', $class = '', $alt = '', $lazyLoad = 'lazy')
{
    if (empty($imageID)) {
        return false;
    }

    $attr = array(
        'class' => $class,
        'loading' => $lazyLoad,
    );

    if ($alt) {
        $attr['alt'] = $alt;
    }

    echo wp_get_attachment_image($imageID, 'full', false, $attr);
    return;
}

function getCurrentUrl()
{
    global $wp;
    if (is_front_page()) {
        return home_url();
    } else {
        return home_url(add_query_arg(NULL, NULL));
    }
}

function isAdminUrl()
{
    if ((strpos(getCurrentUrl(), 'wp-login.php') !== false) || (strpos(getCurrentUrl(), 'admin') !== false)) {
        return true;
    }

    return false;
}


/**
 * Get latest blog posts
 *
 * @param   int     $limit      Posts limit
 * @return  WP_Query
 */
function getLatestBlogPosts($limit = 3)
{

    return new WP_Query(array(
        'post_type' => 'post',
        'order_by'  => 'date',
        'order'     => 'DESC',
        'posts_per_page' => $limit
    ));
}

/**
 * Get social media links for menu as array
 */
function getSocialLinks()
{

    $socialMedia = [];

    if ($facebook = get_field('facebook', 'option')) {
        $socialMedia[] = "<a href='<?php echo $facebook; ?>'><i class='fab fa-facebook-f'></i></a>";
    }

    if ($twitter = get_field('twitter', 'option')) {
        $socialMedia[] = "<a href='<?php echo $twitter; ?>'><i class='fab fa-twitter'></i></a>";
    }

    if ($instagram = get_field('instagram', 'option')) {
        $socialMedia[] = "<a href='<?php echo $instagram; ?>'><i class='fab fa-instagram'></i></a>";
    }

    if ($youtube = get_field('youtube', 'option')) {
        $socialMedia[] = "<a href='<?php echo $youtube; ?>'><i class='fab fa-youtube'></i></a>";
    }

    return $socialMedia;
}
