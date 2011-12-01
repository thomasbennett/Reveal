<?php if(have_posts()): ?>
  <?php while(have_posts()) : the_post(); ?>
    <article class="post">
      <h2> 
        <a href="<?php the_permalink() ?>" 
           rel="bookmark" 
           title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?> </a> 
      </h2>
      <div class="entry">  
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; ?>     
<?php endif; ?>
