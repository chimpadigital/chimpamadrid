<?php

session_cache_limiter('nocache');
//header('Expires: ' . gmdate('r', 0));
//header('Content-type: application/json');
date_default_timezone_set('America/Argentina/Buenos_Aires');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
// Enter your email address. If you need multiple email recipes simply add a comma: email@domain.com, email2@domain.com
$to = "sprados@chimpancedigital.com.ar";

// Form Fields
$name = isset($_POST["widget-contact-form-name"]) ? $_POST["widget-contact-form-name"] : null;
$email = $_POST["widget-contact-form-email"];
$phone = isset($_POST["widget-contact-form-phone"]) ? $_POST["widget-contact-form-phone"] : null;
$company = isset($_POST["widget-contact-form-company"]) ? $_POST["widget-contact-form-company"] : null;
// $service = isset($_POST["widget-contact-form-service"]) ? $_POST["widget-contact-form-service"] : null;
$subject = isset($_POST["widget-contact-form-subject"]) ? $_POST["widget-contact-form-subject"] : 'Consulta landing tupaginaweb';
$subject_user = 'Gracias por contactarnos | Te dejamos consejos para tu empresa durante esta cuarentena';
$message = isset($_POST["widget-contact-form-message"]) ? $_POST["widget-contact-form-message"] : null;

// $recaptcha = $_POST['g-recaptcha-response'];

//inicio script grabar datos en csv
$fichero = 'tupaginaweb.csv';//nombre archivo ya creado
//crear linea de datos separado por coma
$fecha=date("Y-m-d H:i:s");
$linea = $fecha.";".$name.";".$company.";".$phone.";".$email.";".$message."\n";
// Escribir la linea en el fichero
file_put_contents($fichero, $linea, FILE_APPEND | LOCK_EX);
//fin grabar datos
$name = isset($name) ? "Nombre y Apellido: $name<br><br>" : '';
$email = isset($email) ? "Email: $email<br><br>" : '';
$company = isset($company) ? "Empresa: $company<br><br>" : '';
$phone = isset($phone) ? "Teléfono $phone<br><br>" : '';
// $service = isset($service) ? "Service: $service<br><br>" : '';
$message = isset($message) ? "Message: $message<br><br>" : '';

$cuerpo1 = $name . $email . $phone . $company . $message . '<br><br><br>Mensaje enviado de: ' . $_SERVER['HTTP_REFERER'];

$cuerpo2='
            <table width="500" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="width:500px; height:40px; padding:25px 40px;background-color:#0095c8;">
                        <h1 style="color:#ffffff">Gracias por contactarnos</h1>
                    </td>
                </tr>
                <tr>
                    <td style=""><p>Te dejamos a continuación un enlace a nuestra nota para aprender más sobre:</p></td>
                </tr>
                <tr>
                    <td><h3 style="color:#0095c8">¿Por qué tu empresa tiene que estar en Internet?</h3></td>
                </tr>
                <tr>
                    <td><a href="https://chimpancedigital.com.ar/por-que-tu-empresa-tiene-que-estar-en-internet/" style="background:#36a9e1;padding:15px 10px; width:150px; height:80px;color:white;">Ver nota</a></td>
                </tr>
                <tr>
                    <td><p>Nos comunicaremos a la brevedad</p></td>
                </tr>

            </table>
                                ';
$to1=$to;
$to2=$_POST["widget-contact-form-email"];
$asunto1=$subject;
$asunto2=$subject_user;

function enviarMail($to,$asunto,$cuerpo){
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      // Enable verbose debug output
        $mail->isSMTP();      
        
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->CharSet="UTF-8";
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "sprados@chimpancedigital.com.ar";
        $mail->Password = "Chimpance951#$";   
        // Send using SMTP
        
        //Recipients
        $mail->setFrom('sprados@chimpancedigital.com.ar', 'Chimpance Digital');
        $mail->addAddress($to);               // Name is optional
        
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpo;
        $mail->AltBody = $cuerpo;
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
if( $_SERVER['REQUEST_METHOD'] == 'POST') {
    //If you don't receive the email, enable and configure these parameters below: 
    $mail_enviado=enviarMail($to1,$asunto1,$cuerpo1);
    //echo 'envio 1 '.$mail_enviado;
    $mail_enviado2=enviarMail($to2,$asunto2,$cuerpo2);
    //echo 'envio 2 '.$mail_enviado2;
    if($mail_enviado2)
                {
                // echo "<script>location.href='../gracias.html';</script>";
                header("Location: ../gracias.html");exit;
                }
                else
                {
                    echo "no se pudo enviar".$mail_enviado2 ;
                }          
    
}
?>
