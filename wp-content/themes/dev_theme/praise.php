<?php 
/* 
* Template name: Praise
*/
ob_start();
?>
<style>#content { padding-bottom: 30px; }</style>
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
    <h2 class="centered">Priase for Reveal</h2>
    <article class="praise-featured">
      <h3><?php the_title(); ?></h3>
      <?php the_post_thumbnail('praise-thumb'); ?>
      <?php the_content(); ?>
      <div class="clear"></div>
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
    <article class="praise-entry">
      <h3><?php the_title(); ?></h3>
      <?php the_content(); ?>
      <div class="clear"></div>
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
