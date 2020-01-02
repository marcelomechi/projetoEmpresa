<?php
				
				use  PHPMailer \ PHPMailer \ PHPMailer ; 
				use  PHPMailer \ PHPMailer \ SMTP ; 
				use  PHPMailer \ PHPMailer \ Exception ;

				require 'PHPMailer/src/PHPMailer.php';
				require 'PHPMailer/src/SMTP.php';
				require 'PHPMailer/src/Exception.php';

                $mail = new PHPMailer(true); // instancia a classe PHPMailer

                $mail->IsSMTP();

                //configuração do email
				//$mail->SMTPOptions = array ( 'ssl' => array ( 'confirm_peer' => false , 'confirm_peer_name' => false , 'allow_self_signed' => true ) ); 
                $mail->Port = '25'; //porta
                $mail->Host = 'relaycorreio.call.br'; 
				$mail->SMTPAuth = false;
				$mail->SMTPAutoTLS = false ;
                $mail->IsHTML(true); 
                $mail->Mailer = 'smtp';                                                               
                
                // configuração do email a ver enviado.
                $mail->From = "wfm@brbpo.com.br"; 
                $mail->FromName = "WFM"; 
                $mail->addAddress("ricks.mor@gmail.com"); // email do destinatario.
                $mail->Subject = "Assunto";
                $mail->Body = "Corpo";

                if(!$mail->Send())
                {
                               echo "Erro ao enviar Email:" . $mail->ErrorInfo;
                               exit();
                }
?>
