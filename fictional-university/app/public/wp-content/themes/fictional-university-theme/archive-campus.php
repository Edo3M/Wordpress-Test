<?php get_header();
pageBanner(array(
  'title' => 'Our Campuses',
  'subtitle' => "We have several conveniently located campuses."
));
?>

<div class="container container--narrow page-section">

    <div class="acf-map">

      <?php
      while (have_posts()) {
        the_post();
        $mapLocation = get_field('map_location');
      ?>
        <div class="marker" data-lat="<?php if ($mapLocation) echo $mapLocation['lat'] ?>" data-lng="<?php if ($mapLocation) echo $mapLocation['lng'] ?>"></div>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      <?php } ?>

    </div>

</div>

<?php get_footer(); ?>