<?php include_once('wp-config.php'); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="no-js ie6" lang="en"><![endif]-->
<!--[if IE 7 ]>   <html class="no-js ie7" lang="en"><![endif]-->
<!--[if IE 8 ]>   <html class="no-js ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php bloginfo('name') . ' ' . wp_title(); ?></title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="author" content="Thomas Bennett for TB" />

  <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/style.css" />

  <?php if(is_singular()) wp_enqueue_script('comment-reply'); ?>
  <?php wp_enqueue_script('jquery'); ?>

  <?php get_header() ?>
  <script src="<?php bloginfo('template_directory') ?>/js/libs/modernizr-1.7.min.js"></script>
</head>

<body>
  <div id="container">
    <header>
      <nav>
        <ul class="inline">
          <li><a class="gallery" href="/gallery">Gallery</a></li>
          <li><a class="services" href="/services">Services</a></li>
          <li><a class="about" href="/about">About</a></li>
          <li class="logo-nav"><a href="/"><h1 id="logo"><?php bloginfo('name'); ?></h1></a></li>
          <li><a class="press" href="/press">Press</a></li>
          <li><a class="praise" href="/praise">Praise</a></li>
          <li><a class="contact" href="/contact">Contact</a></li>
        </ul>
      </nav>
    </header>

    <div id="content">
      <?php echo $content ?>
    </div>

    <div class="clear"></div>
  </div>

  <div class="clear"></div>

  <footer>
    <p>&copy; Copyright <?php echo date('Y'); ?> Reveal Event Design</p>
    <?php get_footer() ?>
  </footer>

  <script src="<?php bloginfo('template_directory') ?>/js/plugins.js"></script>
  <?php if(is_page('Gallery')): ?><script src="<?php bloginfo('template_directory') ?>/js/thickbox.js"></script><?php endif; ?>
  <script src="<?php bloginfo('template_directory') ?>/js/script.js"></script>

  <!--[if lt IE 7 ]>
    <script src="<?php bloginfo('template_directory') ?>/js/libs/dd_belatedpng.js"></script>
    <script>DD_belatedPNG.fix("img, .png_bg"); // Fix any <img> or .png_bg bg-images. Also, please read goo.gl/mZiyb </script>
  <![endif]-->
</body>
</html>
