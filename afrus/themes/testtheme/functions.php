<?php

function theme_files() {
    wp_enqueue_script('bootstrap-js', get_theme_file_uri('/assets/js/bootstrap.bundle.min.js'), array('jquery'), '1.0', true);
    wp_enqueue_script('font-awesome-js', '//kit.fontawesome.com/94be04978c.js');
    wp_enqueue_style('bootstrap-styles', get_theme_file_uri('/assets/css/dist/main.css'));
}

add_action('wp_enqueue_scripts', 'theme_files');

function frontpage_sidebar() {
    register_sidebar(array(
        'name' => 'Front page sidebar',
        'id' => 'frontpage-sidebar',
        'description' => 'Esta es la barra lateral de mi la página principal'
    ));
}
add_action('widgets_init', 'frontpage_sidebar');

function custom_recent_posts_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'number' => 5,
        'category' => '',
        'post_id' => '',
    ), $atts );

    $number = absint( $atts['number'] );
    $category = sanitize_text_field( $atts['category'] );
    $post_id = sanitize_text_field( $atts['post_id'] );

    $args = array(
        'numberposts' => $number,
        'post_status' => 'publish',
    );

    // Add category filter if provided
    if ( ! empty( $category ) ) {
        $args['category_name'] = $category;
    }

    // Add specific post IDs filter if provided
    if ( ! empty( $post_id ) ) {
        $args['post__in'] = explode( ',', $post_id );
    }

    $recent_posts = wp_get_recent_posts( $args );

    $output = '<ul class="custom-recent-posts">';

    foreach ( $recent_posts as $post ) {
        $thumbnail = get_the_post_thumbnail( $post['ID'], 'thumbnail' );
        $title = esc_html( get_the_title( $post['ID'] ) );
        $date = get_the_date( '', $post['ID'] );
        $permalink = esc_url( get_permalink( $post['ID'] ) );

        $output .= '<li>';
        $output .= '<a href="' . $permalink . '" class="nav-link">';
        $output .= '<div class="post-details">';
        $output .= '<div class="post-thumbnail">' . $thumbnail . '</div>';
        $output .= '<div class="post-body"><h3 class="post-title">' . $title . '</h3>';
        $output .= '<span class="post-date">' . $date . '</span></div>';
        $output .= '</div>';
        $output .= '</a>';
        $output .= '</li>';
    }

    $output .= '</ul>';

    return $output;
}

add_shortcode( 'custom_recent_posts', 'custom_recent_posts_shortcode' );

add_theme_support('post-thumbnails');