<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Instancia um objeto PHPMailer
$mail = new PHPMailer(true);

try {
    // Configura o servidor SMTP localhost
    $mail->isSMTP();
    $mail->Host = ''; // ou outro host de sua escolha
    $mail->SMTPAuth = true;
    $mail->Username = ''; // seu usuário de Mailtrap
    $mail->Password = ''; // sua senha de Mailtrap
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465; // porta utilizada pelo Mailtrap

    // Dados do remetente
    $mail->setFrom('seu email', 'coqueiroautomacao');

    // Dados do destinatário
    $mail->addAddress($_POST['email'], 'Nome do destinatário');

    // Conteúdo do email
    $mail->isHTML(true);
    $mail->Subject = $_POST['assunto'];
    $mail->Body    = $_POST['conteudo'];
    $mail->AltBody = strip_tags($_POST['conteudo']);

    // Anexo
    if (!empty($_FILES['arquivo']['tmp_name'])) {
        $mail->addAttachment($_FILES['arquivo']['tmp_name'], $_FILES['arquivo']['name']);
    }

    // Envia o email
    $mail->send();
    echo 'Email enviado com sucesso';
} catch (Exception $e) {
    echo 'Erro ao enviar email: ', $mail->ErrorInfo;
}

?>