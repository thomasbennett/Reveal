<?php
/*
* Template name: Home
*/
?>
<?php ob_start(); ?>

<section id="slideshow">
<?php
$args = array('post_type'=>'post_type_slideshow');
$loop = new WP_Query($args);

// start slideshow loop
if($loop->have_posts()):
  while($loop->have_posts()):
    $loop->the_post();
    
    $slideshow = get_post_meta($post->ID, 'slideshow_slider', TRUE);
    $slideshow_image = get_post_meta($post->ID, 'upload_image', TRUE); 
    ?>
    <div class="slide">
      <a href="<?php echo $slideshow['slideshow_imageurl']; ?>"><img src="<?php $slideshow_image; ?>" alt="<?php echo the_title(); ?>" /></a>
      <?php echo $slideshow['slideshow_headline']; ?>
      <?php echo $slideshow['slideshow_copy']; ?>
    </div>
  <?php
  endwhile;
endif;
?>
</section>

<section id="callouts">
<?php
$args = array('post_type'=>'post_type_callouts');
$callouts = new WP_Query($args);

// start callout loop
if($callouts->have_posts()): 
  while($callouts->have_posts()): 
    $callouts->the_post(); 
    ?>
    <div class="bucket">
      <h2 class="h3"><?php the_title(); ?></h2>
      <span><?php the_content(); ?></span>
    </div>
  <?php 
  endwhile; 
endif;
?>
</section>

<script>
  jQuery(function($){
    $('#slideshow').cycle({
      fx: 'scrollLeft',
      timeout: 4500,
      speed: 500
    });
  });
</script>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
