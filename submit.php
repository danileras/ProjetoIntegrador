<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Enviar e-mail</title>
    </head>

    <body>
        <?php
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;

            require 'lib/vendor/autoload.php';

            $mail = new PHPMailer(true);

            //Configurações do server
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER; //Apresenta o debug
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();                                 //Send using SMTP
            $mail->Host       = 'smtp-mail.outlook.com';          //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                        //Enable SMTP authentication
            $mail->Username   = 'apresentacao.jaque@outlook.com';          //SMTP username
            $mail->Password   = 'Baladegoma';                    //SMTP password
            $mail->SMTPSecure = 'tsl'; //Enable implicit TLS encryption
            $mail->Port       = 587;                         //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            if(isset($_POST['namefeedback']) && !empty($_POST['namefeedback'])){
                $nome = $_POST['namefeedback'];
            }

            if(isset($_POST['emailfeedback']) && !empty($_POST['emailfeedback'])){
                $remetente = $_POST['emailfeedback'];
            }
                
            if(isset($_POST['feedback']) && !empty($_POST['feedback'])){
                $msg = $_POST['feedback'];
            }

            //Destinatário
            $mail->setFrom($mail->Username, $nome); //remetente
            $mail->addAddress('integracaopsicossocial@hotmail.com', 'Grupo 9'); //Destinatário
            $mail->addReplyTo($remetente); //E-mail para resposta

            //Conteúdo
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Feedback Projeto Integrador';
            $mail->Body    = "Nome: $nome<br> E-mail: $remetente<hr><br>" . nl2br($msg); //nl2br -> adiciona as quebras de linha do textarea
            $mail->AltBody = "Nome: $nome\n E-mail: $remetente\n" . nl2br(strip_tags($msg)); //strip_tags -> remove tags html
            
            if(!$mail->send()){
                header('location: https://projetointegrador.infinityfreeapp.com/error_page.html');
                die();
            }
            else{
                header('location: http://projetointegrador.infinityfreeapp.com/thankyou_page.html');
                die();
            }
    
        ?>
    </body>
</html>