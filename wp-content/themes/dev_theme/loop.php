<?php if(have_posts()): ?>
  <?php while(have_posts()) : the_post(); ?>
    <article class="post <?php if(is_page('Gallery')): echo "gallery-page"; endif; ?>">
      <?php if(is_page('Gallery')): ?>
      <h2>Choose a Gallery</h2>
      <?php else: ?>
      <h2><?php the_title(); ?></h2>
      <?php endif; ?>
      <div class="entry">  
        <?php the_content(); ?>
      </div>
      <div class="clear"></div>
    </article>
  <?php endwhile; ?>     
<?php endif; ?>
