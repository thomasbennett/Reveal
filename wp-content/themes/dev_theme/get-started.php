<?php /*
* Template name: Get Started
*/

ob_start();

if(have_posts()): while(have_posts()): the_post(); ?>
    <article><?php the_content(); ?></article>
<?php endwhile; endif; ?>
  
<form id="get-started" type="post">
  <label for="name">Name <span class="req">*</span></label>
  <input name="name" type="text" alt="Name" class="required" />

  <label for="phone">Phone <span class="req">*</span></label>
  <input name="phone" type="text" alt="Phone" class="required" />

  <label for="email">Email <span class="req">*</span></label>
  <input name="email" type="text" alt="Email" class="required" />

  <label for="event_date">When is your event? <span class="req">*</span></label>
  <input name="email" type="text" alt="<?php echo ('m d Y') ?>" class="required" />
  <span><small>If unknown, enter today's date.</small></span>

  <label>What type of event?</label>
  <input type="radio" name="corporate"><label for="corporate">Corporate</label>
  <input type="radio" name="social_gathering"><label for="social_gathering">Social Gathering</label>
  <input type="radio" name="wedding"><label for="wedding">Wedding</label>

  <div id="corporate">
    <label>Specifically, what type of event?</label>
    <input type="radio" name="business_meeting"><label for="business_meeting">Business Meeting</label>
    <input type="radio" name="convention"><label for="convention">Convention</label>
    <input type="radio" name="holiday_party"><label for="holiday_party">Holiday Party</label>
    <input type="radio" name="pharmeceutical"><label for="pharmeceutical">Pharmeceutical</label>
    <input type="radio" name="corporate_reception"><label for="corporate_reception">Welcome/Thank You Reception</label>
    <input type="radio" name="tour_group"><label for="tour_group">Tour Group</label>
    <input type="radio" name="other"><label for="other">Other</label>

    <label for="corporate_location">Have you chosen a location?</label>
    <input type="radio" name="corporate_yes"><label for="corporate_yes">Yes</label>
    <input type="radio" name="corporate_no"><label for="corporate_no">No</label>
  </div>

  <div id="social">
    <label for="occasion">What occasion are we celebrating?</label>
    <input name="occasion" type="text" alt="" />

    <label for="social-location">Will this event be held at a private home or venue?</label>
    <input type="radio" name="home"><label for="home">Private Home</label>
    <input type="radio" name="venue"><label for="venue">Venue</label>

    <label for="when">When is your event?</label>
    <input name="when" type="text" alt="" />

    <label for="">Will this be a catered event?</label>
    <input type="radio" name="catered_yes"><label for="catered_yes">Yes</label>
    <input type="radio" name="catered_no"><label for="catered_no">No</label>

    <label for="social_guests">How many guests are you anticipating?</label>
    <input name="social_guests" type="text" alt="" />

    <label for="comments">What is the experience you want to convey?</label>
    <textarea name="comments"></textarea>
  </div>

  <div id="wedding">
    <label for="wedding_guests">How many guests are you expecting?</label>
    <input name="wedding_guests" type="text" alt="" />

    <label for="ceremony">Where is your ceremony?</label>
    <input name="ceremony" type="text" alt="" />

    <label for="wedding_reception">Where is your reception?</label>
    <input name="wedding_reception" type="text" alt="" />

    <label for="gown">Have you chosen your gown?</label>
    <input type="radio" name="gown_yes"><label for="gown_yes">Yes</label>
    <input type="radio" name="gown_no"><label for="gown_no">No</label>

    <label for="color_theme">Do you have a color theme?</label>
    <input type="radio" name="color_yes"><label for="color_yes">Yes</label>
    <input type="radio" name="color_no"><label for="color_no">No</label>

    <label for="wedding_style">Do you have a style preference?</label>
    <input type="text" name="wedding_style" />

    <label for="local">Are you local?</label>
    <input type="radio" name="local_yes"><label for="local_yes">Yes</label>
    <input type="radio" name="local_no"><label for="local_no">No</label>
   
    <label for="local_not">If not, where do you reside?</label>
    <input type="text" name="local_not" alt="" />

    <label for="ceremony_time">What time is your ceremony?</label>
    <input name="ceremony_time" type="text" alt="" />

    <label for="ceremony_reception">What time is your reception?</label>
    <input name="ceremony_reception" type="text" alt="" />

    <label for="guest_experience">What do you want your guest's experience to be?</label>
    <textarea name="guest_experience"></textarea>

    <label for="priorities">What are your top three priorities?</label>
    <textarea name="priorities"></textarea>

    <label for="budget">Do you have a d&eacute;cor budget set?</label>
    <input type="radio" name="budget_yes"><label for="budget_yes">Yes</label>
    <input type="radio" name="budget_no"><label for="budget_no">No</label>
    <span><small>Including lights, draping, linens, decorative elemnts and thematic concepts?</small></span>
    
    <label for="wedding_party">How many are in your wedding party?</label>
    <input name="wedding_party" type="text" alt="" />

    <label for="reception_info">Is your reception in a casual or formal setting?</label>
    <input type="radio" name="casual"><label for="casual">Casual</label>
    <input type="radio" name="formal"><label for="formal">Formal</label>

    <label for="ceremony_type">What type of ceremony will you have?</label>
    <textarea name="ceremony_type"></textarea>

    <label for="inspiration">Do you have inspirational items you can bring to our first meeting?</label>
    <input type="radio" name="inspiration_yes"><label for="inspiration_yes">Yes</label>
    <input type="radio" name="inspiration_no"><label for="inspiration_no">No</label>

    <label for="children">Will there be children needing a separate area?</label>
    <input type="radio" name="children_yes"><label for="children_yes">Yes</label>
    <input type="radio" name="children_no"><label for="children_no">No</label>

    <label for="assigned_seating">Will there be assigned seating in the reception?</label>
    <input type="radio" name="assigned_yes"><label for="assigned_yes">Yes</label>
    <input type="radio" name="assigned_no"><label for="assigned_no">No</label>

    <label>Will you provide a give-away gift for your guests?</label>
    <input type="radio" name="give_yes"><label for="give_yes">Yes</label>
    <input type="radio" name="give_no"><label for="give_no">No</label>

    <label>Are you interested in various entertainment?</label>
    <input type="radio" name="ent_yes"><label for="ent_yes">Yes</label>
    <input type="radio" name="ent_no"><label for="ent_no">No</label>
    <span><small>i.e. Band, dancers, string quartet, chior, performance artist</small></span>

    <label>Do you want traditional seating or are you open to suggestions?</label>
    <input type="radio" name="suggest_yes"><label for="suggest_yes">Traditional</label>
    <input type="radio" name="suggest_no"><label for="suggest_no">Suggest away!</label> 
  </div>
</form>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
