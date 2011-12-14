<?php 
ob_start();
include('loop.php');

if(is_page('Gallery')): 
?>

<div id="gallery-image-container">
  <div id="gallery-image"></div>
</div>
<div id="gallery-thumbs"></div>

<script>
jQuery(function($){
  $(window).load(function(){
    var first_gallery = $('.ngg-album:first').find('a').attr('href');
    $('.ngg-album:first').find('.ngg-albumcontent').show();
    $('#gallery-thumbs').load(first_gallery + ' .entry', function(){
      setFirstImage();
    });

    $('.ngg-album:first').find('a').addClass('active-gallery');
  });

  $('#gallery-thumbs').find('a').live('click', function(){
    var gal_src = $(this).attr('href');
    $('#gallery-image').remove();
    $('#gallery-image-container').append('<div id="gallery-image"></div>');

    return false;
  });

  $('.ngg-albumtitle').find('a').click(function(){
    $('.ngg-albumtitle').find('a').removeClass('active-gallery');
    $(this).addClass('active-gallery');

    tb_remove_info();

    var href = $(this).attr('href');
    $('#gallery-thumbs').load(href + ' .entry', function(){
      setFirstImage();
    });

    $('.ngg-albumcontent').hide();
    $(this).parent('.ngg-albumtitle').next('.ngg-albumcontent').show();

    return false;
  });

  $('.ngg-description').find('p').next().hide();
});

function setFirstImage()
{
  var first_thumb = jQuery('#gallery-thumbs').find('.ngg-gallery-thumbnail:first').find('a').attr('href');
  var first_rel = jQuery('#gallery-thumbs').find('.ngg-gallery-thumbnail:first').find('a').attr('rel');

  var t = this.title || this.name || null;
	tb_show(t,first_thumb,first_rel);
}

function tb_remove_info()
{
  jQuery('#TB_ImageOff, #TB_caption, #TB_closeWindow').remove();
}
</script>

<?php
endif; 

$content = ob_get_clean();
require('template.php');
?>
