<?php get_header();

while (have_posts()) {
    the_post();
    ?>

    <div class="container-fluid page-banner" style="background-image: url(<?php echo has_post_thumbnail() ? get_the_post_thumbnail_url() : 'https://images.unsplash.com/photo-1503614472-8c93d56e92ce?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1111&q=80' ?>);">
        <div class="row page-banner_overflow h-100 align-items-center">
            <div class="col text-center">
                <h1><?php the_title(); ?></h1>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col py-5">
                <?php the_content(); ?>
            </div>
        </div>
    </div>

<?php }

get_footer();

?>