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
      <img src="<?php echo $slideshow_image; ?>" alt="<?php echo the_title(); ?>" height="500" width="890" />
    </div>
  <?php
  endwhile;
endif;
?>
</section>

<section id="callouts">
<?php
$args = array('post_type'=>'callouts', 'orderby'=>'post_date', 'order'=>'ASC');
$callouts = new WP_Query($args);

// start callout loop
if($callouts->have_posts()): 
  while($callouts->have_posts()): 
    $callouts->the_post(); 
    ?>
    <div class="bucket">
      <a href="<?php echo get_the_excerpt(); ?>" class="excerpt-link">
      <?php the_post_thumbnail('buckets'); ?>
      <div class="bucket-content">
        <h2 class="h3"><?php the_title(); ?></h2>
        <span><?php the_content(); ?></span>
      </div>
      </a>
    </div>
  <?php 
  endwhile; 
endif;
?>
</section>

<script>
  jQuery(function($){
    $('#slideshow').cycle({
      fx: 'fade',
      timeout: 4500,
      speed: 500
    });

    $('.bucket:nth-child(3)').css({'margin-right':'0'});
    var link = $('#excerpt-length').attr('href');
  });
</script>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
