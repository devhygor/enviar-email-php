<?php

    require __DIR__.'/vendor/autoload.php';

    use \App\Communication\Email;

    // Variaveis
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];
    $data_envio = date('d/m/Y');
    $hora_envio = date('H:i:s');


    // Campo E-mail
    $body = "
        <html>
            <p><b>Nome: </b>$nome</p>
            <p><b>E-mail: </b>$email</p>
            <p><b>Mensagem: </b>$mensagem</p>
            <p>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></p>
        </html>
    ";

    // Email para quem será enviado o formulario
    $destinatarios = "hygor@hygor.net";
    $assunto = "Enviado pelo site";

    $obEmail = new Email;
    $sucesso = $obEmail->sendEmail($destinatarios, $assunto, $body);

    echo $sucesso ? 'Mensagem enviada com sucesso!' : $obEmail->getError();
    echo "<meta http-equiv='refresh' content='0;URL=../index.html'>";

?>