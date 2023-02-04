<?php

    namespace App\Communication;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception as PHPMailerException;
    

class Email{

    const HOST = 'smtp.titan.email';
    const USER = 'hygor@hygor.net';
    const PASS = '********.';
    const SECURE = 'SSL';
    const PORT = '465';
    const CHARSET = 'UTF-8';


    const FROM_EMAIL = 'hygor@hygor.net';
    const FROM_NAME = 'Hygor Rocha';

    private $error;

    public function getError(){
        return $this->error;
    }

    public function sendEmail($destinatarios, $assunto, $body, $attachments = [], $ccs = [], $bccs = []){
        // LIMPAR A MENSAGEM DE ERRO
        $this->error = '';

        // INSTANCIA DE PHPMAILER
        $obMail = new PHPMailer(true);
        try{
            // CREDENCIAIS DE ACESSO AO SMTP
            $obMail->isSMTP(true);
            $obMail->Host = self::HOST;
            $obMail->SMTPAuth = true;
            $obMail->Username = self::USER;
            $obMail->Password = self::PASS;
            $obMail->SMTPSecure = self::SECURE;
            $obMail->Port = self::PORT;
            $obMail->CharSet = self::CHARSET;

            // REMETENTE
            $obMail->setFrom(self::FROM_EMAIL, self::FROM_NAME);

            // DESTINATARIOS
            $destinatarios = is_array($destinatarios) ? $destinatarios : [$destinatarios];
            foreach($destinatarios as $destinatario){
                $obMail->addAddress($destinatario);
            }

            // ANEXOS
            $attachments = is_array($attachments) ? $attachments : [$attachments];
            foreach($attachments as $attachment){
                $obMail->addAttachment($attachment);
            }

            // CC
            $ccs = is_array($ccs) ? $ccs : [$ccs];
            foreach($ccs as $cc){
                $obMail->addCC($cc);
            }

            // BCC
            $bccs = is_array($bccs) ? $bccs : [$bccs];
            foreach($bccs as $bcc){
                $obMail->addBCC($bcc);
            }

            // CONTEUDO DO E-MAIL
            $obMail->isHTML(true);
            $obMail->Subject = $assunto;
            $obMail->Body = $body;

            // ENVIA O E-MAIL
            return $obMail->send();

        }catch(PHPMailerException $e){
            $this->error = $e->getMessage();
            return false;
        }
    }
}

?>