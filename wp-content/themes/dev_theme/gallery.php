<?php
/*
* Template name: Gallery
*/

ob_start();

query_posts('pagename=sample-page');
if(have_posts()): while(have_posts()): the_post();
  the_content();
endwhile; endif;

$content = ob_get_clean();
require('template.php'); 

?>
