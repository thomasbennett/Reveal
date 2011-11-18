<?php 
ob_start();
$args = array('post_type'=>'post_type_slideshow');
$loop = new WP_Query($args);
?>
<div class="slideshow">
<?php
if($loop->have_posts()):
  while($loop->have_posts()):
    $loop->the_post();
    
    $slideshow = get_post_meta($post->ID, 'slideshow_slider', TRUE);
    $slideshow_image = get_post_meta($post->ID, 'upload_image', TRUE); ?>
    <div class="slide">
      <?php 
      echo '<a href="'.$slideshow['slideshow_imageurl'].'"><img src="'. $slideshow_image .'" /></a>';
      echo $slideshow['slideshow_headline'];
      echo $slideshow['slideshow_copy'];
      ?>
    </div>
  <?php
  endwhile;
endif;
?>
</div>
<?php
$content = ob_get_clean();
require('template.php'); 
?>
