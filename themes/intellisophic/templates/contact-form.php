<form id="contactform" action="./" role="form" method="POST">
    <?php if (!is_page('contact-us')) { ?>
        <h4>Contact us</h4>
    <?php }
    ?>
    <div class="form-md">
        <input type="text" name="name-contact" id="name-contact" class="validate[required]" >
        <label for="input" class="control-label">Name</label><i class="bar"></i>
    </div>
    <div class="form-md">
        <input type="text" name="number-phone" id="number-phone" class="validate[required]">
        <label for="input" class="control-label">Contact number</label><i class="bar"></i>
    </div>
    <div class="form-md">
        <input type="text" name="email-contact" id="email-contact" class="validate[required,custom[email]]">
        <label for="input" class="control-label">Email</label><i class="bar"></i>
    </div>
    <div class="form-md">
        <textarea class="validate[required]" name="message" id="message"></textarea>
        <label for="textarea" class="control-label">Message</label><i class="bar"></i>
    </div>
    <input type="hidden" name="honey-url" id="honey-url">
    <div class="button-container">
        <button type="submit" class="button"><span>Send message</span></button>
    </div>
</form>

<?php
get_template_part('contact-submit');
?>