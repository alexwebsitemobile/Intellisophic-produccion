<?php
$name = filter_input(INPUT_POST, 'name-contact');
$phone = filter_input(INPUT_POST, 'number-phone');
$email = filter_input(INPUT_POST, 'email-contact');
$message = filter_input(INPUT_POST, 'message');
$honey = filter_input(INPUT_POST, 'honey-url');
if (!empty($email) && empty($honey)) {
    ob_start();
    ?>

    <div style="color:#888">
        <h2>Contact - Intellisophic</h2>
        <p><?php echo date("d/m/Y h:i") ?></p>
        <hr>
        <p><strong>Name: </strong><?php echo $name ?> <?php echo $lastname ?> </p>
        <p><strong>Email: </strong><a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></p>
        <p><strong>Phone: </strong><?php echo $phone ?></p>
        <p><strong>Message: </strong><?php echo $message ?></p>
    </div>

    <?php
    $contenido = ob_get_clean();
    $mail_gen = get_option('theme_options_email');
    require_once ABSPATH . WPINC . '/class-phpmailer.php';
    $mail = new PHPMailer();
    $mail->AddAddress($mail_gen);
    $mail->FromName = $name;
    $asunto = 'Contact | Intellisophic';
    $mail->Subject = $asunto;
    $mail->Body = $contenido;
    $mail->IsHTML();

    if ($mail->Send()) {
        ?>
        <div class="alert alert-success alert-dismissible animated fadeInUp alert-fixed text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Good!</strong> Your message has been sent successfully.
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger alert-dismissible animated fadeInUp alert-fixed text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Houston, we have a problem!</strong> Your message could not be sent.
        </div>
        <?php
    }
} ?>