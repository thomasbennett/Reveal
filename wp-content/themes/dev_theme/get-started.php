<?php /*
* Template name: Get Started
*/

ob_start();

if(have_posts()): while(have_posts()): the_post(); ?>
    <article><?php the_content(); ?></article>
<?php endwhile; endif; ?>

<style>
  input { margin: 0 2px 10px 0; }
  label { margin-right: 15px; }
  .clearnone { margin-top: 3px; }
  .required-info { background: #ddd; padding: 10px; }
  .req { color: red; font-weight: bold; }
</style>

<div id="get-started-container">
  <form id="get-started" type="post" action="">
    <div class="required-info">
      <span class="formset">
        <label for="name">Name <span class="req">*</span></label>
        <input name="name" type="text" alt="Name" class="required" />
      </span>

      <span class="formset">
        <label for="phone">Phone <span class="req">*</span></label>
        <input name="phone" type="text" alt="Phone" class="required" />
      </span>

      <span class="formset">
        <label for="email">Email <span class="req">*</span></label>
        <input name="email" type="text" alt="Email" class="required" />
      </span>

      <span class="formset">
        <label for="event_date">When is your event? <span class="req">*</span></label>
        <input name="email" type="text" alt="<?php echo ('m d Y') ?>" class="required" />
        <span><small>If unknown, enter today's date.</small></span>
      </span>
    </div>

    <span class="formset">
      <label>What type of event?</label>
      <span class="radio-buttons">
        <input type="radio" class="main-event" name="main-event" value="corporate"><label for="corporate">Corporate</label>
        <input type="radio" class="main-event" name="main-event" value="social"><label for="social">Social Gathering</label>
        <input type="radio" class="main-event" name="main-event" value="wedding"><label for="wedding">Wedding</label>
      </span>
    </span>

    <div id="corporate" class="hidden event-form">
      <span class="formset">
        <label>Specifically, what type of event?</label>
        <span class="radio-buttons">
          <input type="radio" name="corp_event_type" value="business_meeting"><label for="business_meeting">Business Meeting</label>
          <input type="radio" name="corp_event_type" value="convention"><label for="convention">Convention</label>
          <input type="radio" name="corp_event_type" value="holiday_party"><label for="holiday_party">Holiday Party</label>
          <input type="radio" name="corp_event_type" value="pharmeceutical"><label for="pharmeceutical">Pharmeceutical</label>
        </span>
      </span>
      <span class="formset">
        <label>&nbsp;</label>
        <span class="radio-buttons">
          <input type="radio" name="corp_event_type" value="corporate_reception"><label for="corporate_reception">Welcome/Thank You Reception</label>
          <input type="radio" name="corp_event_type" value="tour_group"><label for="tour_group">Tour Group</label>
          <input type="radio" name="corp_event_type" value="other"><label for="other">Other</label>
        </span>
      </span>

      <span class="formset">
        <label for="corporate_location">Have you chosen a location?</label>
        <span class="radio-buttons">
          <input type="radio" value="yes" name="corporate"><label for="corporate">Yes</label>
          <input type="radio" value="no" name="corporate"><label for="corporate">No</label>
        </span>
      </span>
    </div>

    <div id="social" class="hidden event-form">
      <span class="formset">
        <label for="occasion">What occasion are we celebrating?</label>
        <input name="occasion" type="text" alt="" />
      </span>
      <span class="formset">
        <label for="social-location">Will this event be held at a private home or venue?</label>
        <span class="radio-buttons">
          <input type="radio" value="private home" name="social_loc"><label for="home">Private Home</label>
          <input type="radio" name="social_loc" value="venue"><label for="venue">Venue</label>
        </span>
      </span>
      <span class="formset">
        <label for="when">When is your event?</label>
        <input name="when" type="text" alt="" />
      </span>
      <span class="formset">
        <label for="">Will this be a catered event?</label>
        <span class="radio-buttons">
          <input type="radio" value="yes" name="catered"><label for="catered">Yes</label>
          <input type="radio" value="no" name="catered"><label for="catered">No</label>
        </span>
      </span>
      <span class="formset">
        <label for="social_guests">How many guests are you anticipating?</label>
        <input name="social_guests" type="text" alt="" />
      </span>
      <span class="formset">
        <label for="comments">What is the experience you want to convey?</label>
        <textarea name="comments"></textarea>
      </span>
    </div>
    <div id="wedding" class="hidden event-form">
      <span class="formset">
        <label for="wedding_guests">How many guests are you expecting?</label>
        <input name="wedding_guests" type="text" alt="" />
      </span>
      <span class="formset">
        <label for="ceremony">Where is your ceremony?</label>
        <input name="ceremony" type="text" alt="" />
      </span>
      <span class="formset">
        <label for="wedding_reception">Where is your reception?</label>
        <input name="wedding_reception" type="text" alt="" />
      </span>
      <span class="formset">
        <label for="gown">Have you chosen your gown?</label>
        <span class="radio-buttons">
          <input type="radio" value="yes" name="gown"><label for="gown">Yes</label>
          <input type="radio" value="no" name="gown"><label for="gown">No</label>
        </span>
      </span>
      <span class="formset">
        <label for="color_theme">Do you have a color theme?</label>
        <span class="radio-buttons">
          <input type="radio" value="yes" name="color"><label for="color">Yes</label>
          <input type="radio" value="no" name="color"><label for="color">No</label>
        </span>
      </span>
      <span class="formset">
        <label for="wedding_style">Do you have a style preference?</label>
        <input type="text" name="wedding_style" />
      </span>
      <span class="formset">
        <label for="local">Are you local?</label>
        <span class="radio-buttons">
          <input type="radio" value="yes" name="local"><label for="local">Yes</label>
          <input type="radio" value="no" name="local"><label for="local">No</label>
        </span>
      </span>
      <span class="formset">
        <label for="localt">If not, where do you reside?</label>
        <input type="text" name="localt" alt="" />
      </span>
      <span class="formset">
        <label for="ceremony_time">What time is your ceremony?</label>
        <input name="ceremony_time" type="text" alt="" />
      </span>
      <span class="formset">
        <label for="ceremony_reception">What time is your reception?</label>
        <input name="ceremony_reception" type="text" alt="" />
      </span>
      <span class="formset">
        <label for="guest_experience">What do you want your guest's experience to be?</label>
        <textarea name="guest_experience"></textarea>
      </span>
      <span class="formset">
        <label for="priorities">What are your top three priorities?</label>
        <textarea name="priorities"></textarea>
      </span>
      <span class="formset">
        <label for="budget">Do you have a d&eacute;cor budget set?</label>
        <span class="radio-buttons">
          <input type="radio" value="yes" name="budget"><label for="budget">Yes</label>
          <input type="radio" value="no" name="budget"><label for="budget">No</label>
          <span><small>Including lights, draping, linens, decorative elemnts and thematic concepts?</small></span>
        </span>
      </span>
      <span class="formset">  
        <label for="wedding_party">How many are in your wedding party?</label>
        <input name="wedding_party" type="text" alt="" />
      </span>
      <span class="formset">
        <label for="reception_info">Is your reception in a casual or formal setting?</label>
        <span class="radio-buttons">
          <input type="radio" name="recpt_info" value="casual"><label for="casual">Casual</label>
          <input type="radio" name="recpt_info" value="formal"><label for="formal">Formal</label>
        </span>
      </span>
      <span class="formset">
        <label for="ceremony_type">What type of ceremony will you have?</label>
        <textarea name="ceremony_type"></textarea>
      </span>
      <span class="formset">
        <label for="inspiration">Do you have inspirational items you can bring to our first meeting?</label>
        <span class="radio-buttons">
          <input type="radio" value="yes" name="inspiration"><label for="inspiration">Yes</label>
          <input type="radio" value="no" name="inspiration"><label for="inspiration">No</label>
        </span>
      </span>
      <span class="formset">
        <label for="children">Will there be children needing a separate area?</label>
        <span class="radio-buttons">
          <input type="radio" value="yes" name="children"><label for="children">Yes</label>
          <input type="radio" value="no" name="children"><label for="children">No</label>
        </span>
      </span>
      <span class="formset">
        <label for="assigned_seating">Will there be assigned seating in the reception?</label>
        <span class="radio-buttons">
          <input type="radio" value="yes" name="assigned"><label for="assigned">Yes</label>
          <input type="radio" value="no" name="assigned"><label for="assigned">No</label>
        </span>
      </span>
      <span class="formset">
        <label>Will you provide a give-away gift for your guests?</label>
        <span class="radio-buttons">
          <input type="radio" value="yes" name="give"><label for="give">Yes</label>
          <input type="radio" value="no" name="give"><label for="give">No</label>
        </span>
      </span>
      <span class="formset">
        <label>Are you interested in various entertainment?</label>
        <span class="radio-buttons">
          <input type="radio" value="yes" name="ent"><label for="ent">Yes</label>
          <input type="radio" value="no" name="ent"><label for="ent">No</label>
          <span><small>i.e. Band, dancers, string quartet, chior, performance artist</small></span>
        </span>
      </span>
      <span class="formset">
        <label>Do you want traditional seating or are you open to suggestions?</label>
        <span class="radio-buttons">
          <input type="radio" value="traditional" name="suggest"><label for="suggest">Traditional</label>
          <input type="radio" value="suggest away!" name="suggest"><label for="suggest">Suggest away!</label> 
        </span>
      </span>
    </div>

    <div class="clear"></div>
    <button id="submit" type="submit"><span>Send</span></button>
    <p class="error-msg"></p>
  </form>
</div>

<script>
  jQuery(function($){
    // form toggle
    $('input.main-event').click(function(){
      var val = $(this).val();
      var id = $('#' + val);
      $('.event-form').addClass('hidden');
      id.removeClass('hidden');
    });

    // styles
    $('input[type=radio]').each(function(){
      var $radio = $(this);
      $radio.addClass('left clearnone');
      $radio.next().addClass('left clearnone');
    });

    // form validation
    $('#submit').click(function(e){
      is_valid = 1;      
      $('form#get-started').find('input.required').each(function(){      
        var val = $(this).val();      

        if(val == ''){      
          $(this).css({'border':'1px solid red'});      
          is_valid = 0;

          $('.error-msg').html('Please fill out all the required fields.');
        }      
      });

      if(is_valid){      
        var theme = location.protocol + '//' + location.hostname + '/wp-content/themes/dev_theme/';      

        $.ajax({      
          type: 'POST',      
          data: $('#get-started').serialize(),      
          url: theme + 'get-started-submit.php',      
          success: function(data){      
            $('#get-started-container').html(data);      
          }      
        });      
      }      
      e.preventDefault();      
    });
  });      
</script>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
