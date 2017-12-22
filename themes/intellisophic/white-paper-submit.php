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
        <h2>Request White Paper - Intellisophic</h2>
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
    $asunto = 'White Paper | Intellisophic';
    $mail->Subject = $asunto;
    $mail->Body = $contenido;
    $mail->IsHTML();

    if ($mail->Send()) {
        ?>
        <div class="alert alert-success alert-dismissible text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Good!</strong> Your message has been sent successfully.
            <p>
                "Thank you for showing interest in Intellisophic.  Attached is the white paper that you requested"
            </p>
            <?php
            $files = rwmb_meta('pdf-attachment', 'type=file');
            if (!empty($files)) {
                foreach ($files as $file) {
                    echo "<a style='color:#FFFFFF;font-size: 22px;font-weight: 600;display:inline-block;margin-top: 15px;' href='{$file['url']}' target='_blank' title='{$file['title']}'>Donwload White Paper</a>";
                }
            }
            ?>
        </div>
        <?php
    } else {
        ?>
        <div class="alert alert-danger alert-dismissible text-center" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>Houston, we have a problem!</strong> Your message could not be sent.
        </div>
        <?php
    }
}
?>