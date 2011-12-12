<?php 
/* 
* Template name: Praise
*/
ob_start();
?>

<div id="praise-container">
<?php
query_posts(array(
  'post_type'=>'praise', 
  'category_name'=>'Featured',
  'post_per_page'=>1
  )
);
if(have_posts()):
  while(have_posts()):
    the_post();
    ?>
    <article class="praise-featured">
      <?php the_post_thumbnail(); ?>
      <?php the_title(); ?>
      <?php the_content(); ?>
    </article>
  <?php
  endwhile;
endif;
wp_reset_query();

query_posts('post_type=praise&cat=-3&posts_per_page=9');
if(have_posts()):
  while(have_posts()):
    the_post();
    ?>
    <article class="praise">
      <?php the_title(); ?>
      <?php the_content(); ?>
    </article>
  <?php 
  endwhile;
endif;
wp_reset_query();
?>
</div>

<?php
$content = ob_get_clean();
require('template.php');
?>
