<?php

// themefurnace functions and definitions
if (!function_exists('themefurnace_setup')) {
    function themefurnace_setup()
    {
        load_theme_textdomain('themefurnace', get_template_directory() . '/languages');
        add_theme_support('automatic-feed-links');
    }
}
add_action('after_setup_theme', 'themefurnace_setup');

// Style the Tag Cloud
function custom_tag_cloud_widget($args) {
    $args['largest'] = 12; //largest tag
    $args['smallest'] = 12; //smallest tag
    $args['unit'] = 'px'; //tag font unit
    $args['number'] = '8'; //number of tags
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'custom_tag_cloud_widget' );

/* This code filters the Categories archive widget to include the post count inside the link */
add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links)
{
    $links = str_replace('</a> (', ' (', $links);
    $links = str_replace(')', ')</a>', $links);
    return $links;
}

/* This code filters the Archive widget to include the post count inside the link */
add_filter('get_archives_link', 'archive_count_span');
function archive_count_span($links)
{
    $links = str_replace('</a>&nbsp;(', ' (', $links);
    $links = str_replace(')', ')</a>', $links);
    return $links;
}

// Pagination

function themefurnace_pagination($pages = '', $range = 2)
{
    global $paged;
    $showitems = ($range * 2) + 1;

    if (empty($paged)) {
        $paged = 1;
    }
    if ('' == $pages) {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo '<div class="pagination">';
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
            echo '<a href="' . get_pagenum_link(1) . '">&laquo;</a>';
        }

        if ($paged > 1 && $showitems < $pages) {
            echo '<a href="' . get_pagenum_link($paged - 1) . '">&lsaquo;</a>';
        }

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? '<span class="current">' . $i . '</span>' : '<a href="' . get_pagenum_link($i) . '" class="inactive">' . $i . '</a>';
            }
        }

        if ($paged < $pages && $showitems < $pages) {
            echo '<a href="' . get_pagenum_link($paged + 1) . '">&rsaquo;</a>';
        }
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
            echo '<a href="' . get_pagenum_link($pages) . '">&raquo;</a>';
        }
        echo "</div>\n";
    }
}

//Enqueue scripts and styles
function themefurnace_scripts() {
    wp_enqueue_style( 'themefurnace-style', get_stylesheet_uri() );
    wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css', 'style' );
    wp_enqueue_style( 'open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:300', 'style' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'themefurnace-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'themefurnace-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
    }
}
add_action( 'wp_enqueue_scripts', 'themefurnace_scripts' );


  
// Load Extra Functions
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/themesetup.php';


// search form customize
add_filter( 'get_search_form', 'new_get_search_form' );

function new_get_search_form( $form ) {
 
  $form = '<form method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
    
    <p><input type="text" class="search-field" value="" name="s" placeholder="Search keywords..." /></p>
    
    
    
  </form>';
 
  return $form;
}

// eyecatch
set_post_thumbnail_size(200, 200, true);
