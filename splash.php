<!DOCTYPE html>
<html>
<head>
  <title>Reveal Event Style</title>
  <!-- get jquery from google -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <!-- if Google is down, grab it from jquery -->
  <script>!window.jQuery && document.write('<script src="http://code.jquery.com/jquery-1.4.2.min.js"><\/script>');</script>

  <?php $height = 360; $width = 640; $controls = 40; ?>
  <style>
    #video-container { 
      position: absolute;
      height: <?php echo $height - $controls ?>px;
      overflow: hidden;
    }

    #video-manipulation {
      margin-left: -1px;
      margin-top: -5px;
    }
  </style>
</head>
<body>
  <div id="video-container">
    <div ij="video-manipulation">
      <!-- the video -->
      <object width="<?php echo $width ?>" height="<?php echo $height ?>">
        <param name="movie" 
          value="http://www.youtube.com/v/q_8elukfuvg?version=3&autoplay=1&autohide=1&showinfo=0&rel=0&hd=1&enablejsapi=1">
        </param>
        <param name="allowFullScreen" value="true"></param>
        <param name="allowscriptaccess" value="always"></param>
        <embed  
          src="http://www.youtube.com/v/q_8elukfuvg?version=3&autoplay=1&autohide=1&showinfo=0&rel=0&hd=1&enablejsapi=1"
          type="application/x-shockwave-flash" width="<?php echo $width ?>" height="<?php echo $height ?>" 
          allowscriptaccess="always" 
          allowfullscreen="true">
        </embed>
      </object>
    </div>
  </div>

  <script>
    jQuery(function($){
      $(window).load(function(){
        var winHeight = $(window).height();
        var winWidth = $(window).width();

        fancybox(winHeight, winWidth);

        $('#video-container').delay(3000).animate({
          height: '+<?php echo ($height + $controls); ?>'
        }, 600 );
      });

      function fancybox(winHeight, winWidth)
      {
        $('#video-container').css({
          'top': + (winHeight/2) - (<?php echo $height ?>/2) + 'px',
          'left': + (winWidth/2) - (<?php echo $width ?>/2) + 'px'
        })
        .delay(200).fadeIn(200);
      }

      $(window).resize(function(){
        var winHeight = $(window).height();
        var winWidth = $(window).width();

        fancybox(winHeight, winWidth);
      });
    });
  </script>
</body>
</html>
