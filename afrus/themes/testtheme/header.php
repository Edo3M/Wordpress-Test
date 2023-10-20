<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="<?php echo site_url() ?>"><img src="<?php echo get_theme_file_uri('images/lorem-ipsum-logo.png') ?>"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php if (is_front_page()) echo 'active' ?>" <?php if (is_front_page()) echo 'aria-current="page"' ?> href="<?php echo site_url(); ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (is_page('about-us')) echo 'active' ?>" <?php if (is_page('about-us')) echo 'aria-current="page"' ?> href="<?php echo site_url('/about-us'); ?>">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (is_page('services')) echo 'active' ?>" <?php if (is_page('services')) echo 'aria-current="page"' ?> href="<?php echo site_url('/services'); ?>">Services</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>