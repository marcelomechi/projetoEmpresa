<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author br03206
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

class Email {

    public function enviaEmail($assunto, $mensagem, $nome, $link = null, $destinatario, $cc = null) {

        if ($assunto == 1) {
            $textoAssunto = "Solicitação de Alteração de Senha";
        }elseif($assunto == 2 || $assunto == 3 ) {
             $textoAssunto = "RES: Solicitação de acesso";
        }else{
            $textoAssunto = $assunto;
        }


        if ($mensagem == 1) { // alteração de senha
            $textoMensagem = "<div style='font-family: Calibri'><b>Olá, ".$nome."!</b><br><br>Recebemos sua solicitação, para prosseguir com a alteração, digite o token abaixo para alterar sua senha.<br><br>".$link."<br><br> Equipe M.I.S.</div>";
        }elseif ($mensagem == 2){ // liberacao de acesso convidado
            $textoMensagem = "<div style='font-family: Calibri'><b>Olá, ".$nome."!</b><br><br>Recebemos sua solicitação, seu cadastro está liberado, utilize seu CPF como usuário e senha para acesso ao sistema.<br><br>".$link."<br><br> Equipe M.I.S.</div>";
        }elseif ($mensagem == 3){ // acesso convidado negado
            $textoMensagem = "<div style='font-family: Calibri'><b>Olá, ".$nome."!</b><br><br>Recebemos sua solicitação, porém não foi possível liberar seu acesso, dúvidas entre em contato conosco.<br><br>".$link."<br><br> Equipe M.I.S.</div>";
        }else{
            $textoMensagem = $mensagem;
        }

        $emailDestinatario = explode(';', $destinatario);

        if (count($cc) > 0) {
            $ccArray = explode(';', $cc);
        }


        // Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        $mail = new PHPMailer(true); // instancia a classe PHPMailer

        $mail->IsSMTP();

        //configuração do email
        //$mail->SMTPOptions = array ( 'ssl' => array ( 'confirm_peer' => false , 'confirm_peer_name' => false , 'allow_self_signed' => true ) ); 
        $mail->CharSet = "UTF-8";
        $mail->Port = '25'; //porta
        $mail->Host = 'relaycorreio.call.br';
        $mail->SMTPAuth = false;
        $mail->SMTPAutoTLS = false;
        $mail->IsHTML(true);
        $mail->Mailer = 'smtp';

        // configuração do email a ver enviado.
        $mail->From = "workforce@brbpo.com.br";
        $mail->FromName = "WorkForce";
        foreach ($emailDestinatario as $value) {
            $mail->addAddress($value); // email do destinatario.
        }
        if (isset($ccArray) && !empty($ccArray)) {
            foreach ($ccArray as $valueCc) {
                $mail->addCC($valueCc);
            }
        }

        $mail->Subject = $textoAssunto;
        $mail->Body = $textoMensagem;

        if (!$mail->Send()) {
            echo "Erro ao enviar Email:" . $mail->ErrorInfo;
            exit();
        }else{
            return true;
        }
    }

}

?>