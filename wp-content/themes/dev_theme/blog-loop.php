<?php $odd_or_even = 'odd'; ?> 
<?php while(have_posts()) : the_post(); ?>
  <article class="post <?php echo $odd_or_even; ?>">
  <h2>
    <a href="<?php the_permalink() ?>" 
      rel="bookmark" 
      title="Permanent Link to <?php the_title_attribute(); ?>">
      <?php the_title(); ?>
    </a>
  </h2>
  <div class="date">Published <?php echo the_date('F d, Y g:ia'); ?></div>

    <?php if(the_post_thumbnail()): ?>
    <div class="post-thumbnail">    
      <?php the_post_thumbnail(); ?>  
    </div>         
    <?php endif; ?>
  
    <div class="entry">  
        <?php $odd_or_even = ('odd' == $odd_or_even) ? 'even' : 'odd'; ?>
        <?php the_content('Read More &raquo;'); ?>
    </div>
  </article>
<?php $counter++ ?>
<?php endwhile; ?>     
