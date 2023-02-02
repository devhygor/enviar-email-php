<?php

    // Variaveis
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];
    $data_envio = date('d/m/Y');
    $hora_envio = date('H:i:s');
    $from = 'hygor@hygor.net';


    // Campo E-mail
    $arquivo = "
        <html>
            <p><b>Nome: </b>$nome</p>
            <p><b>E-mail: </b>$email</p>
            <p><b>Mensagem: </b>$mensagem</p>
            <p>Este e-mail foi enviado em <b>$data_envio</b> às <b>$hora_envio</b></p>
        </html>
    ";

    // Email para quem será enviado o formulario
    $destino = "hygor.k92@gmail.com";
    $assunto = "Email de Teste";

    // Este sempre deverá existir para garantir a exibição correta dos caracteres
    $headers = "MIME-Version: 1.1\n";
    $headers .= "Content-type: text/html; charset=utf-8\n";
    $headers .= "From: Formulario Contato <$from>\n";
    $headers .= "Return-Path: $from\n";
    $headers .= "Reply-to: $email\n";

    // Enviar
    mail($destino, $assunto, $arquivo, $headers, $from);

    echo "<meta http-equiv='refresh' content='10;URL=../contato.html'>";

?>